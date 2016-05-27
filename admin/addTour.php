<?php require_once 'common/header.php';?>
<?php
if (!loggedIn()) {
    header('Location: login.php');
}
?>

<?php
$categories = getAllCategories($connection);

$errors = array();
$data = array(
    'category_id' => '',
    'name'        => '',
    'description' => '',
    'image'       => '',
);

if (isset($_POST['submit'])) {
    $data = array(
        'category_id' => $_POST['category'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'image'       => ''
    );

    if (strlen(trim($_POST['name'])) < 3 || strlen(trim($_POST['name']) > 255) ) {
        $errors['name'] = 'Invalid name length';
    }

    if (strlen(trim($_POST['description'])) < 3 || strlen(trim($_POST['description']) > 500) ) {
        $errors['description'] = 'Invalid description length';
    }

    $imageErrors = array();
    if (isset($_FILES['image'])) {
        $imageName = $_FILES['image']['name'];

        $imageType = $_FILES['image']['type'];
        $imageSize = $_FILES['image']['size'];
        $imagePath = $_FILES['image']['tmp_name'];
        $extension = strtolower(end(explode('/', $imageType)));
        $imageName = sha1(sha1(time())+sha1($imageName)).'.'.$extension;
        $allow = array('gif', 'jpg', 'jpeg', 'png');

        if (!in_array($extension, $allow)) {
            $imageErrors['extension'] = 'Wrong extension';
        }
        if ($imageSize > 100000) {
            $imageErrors['size'] = 'Image is too big!';
        }
    }

    if (empty($errors) && empty($imageErrors)) {
        if (isset($_FILES['image'])) {
            $data['image'] = $imageName;
        }

        insertTour($connection, $data);

        if (isset($_FILES['image'])) {
            move_uploaded_file($imagePath, 'uploads/' . $imageName);
        }

        header('Location: toursListing.php');
    }
}




?>

<?php require_once 'common/sidebar.php';?>



<div id="content" class="span10">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Dashboard</a></li>
    </ul>

    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="category">Select Category</label>
                <div class="controls ">
                    <select name="category" id="category">
                        <?php foreach($categories as $category) { ?>
                            <option value="<?php echo  $category['id']; ?>">
                                <?php echo $category['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="image">Image</label>
                <div class="controls ">
                    <input type="file" class="span6" id="image" name="image" />
                </div>
            </div>


            <div class="control-group <?php echo (array_key_exists('name', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="name">Name</label>
                <div class="controls ">
                    <input type="text" class="span6" id="name" name="name" value="<?php echo $data['name']; ?>" />
                    <p class="help-block"><?php echo (array_key_exists('name', $errors))? $errors['name'] : ''; ?></p>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('description', $errors))? 'error' : ''; ?> ">
                <label class="control-label" for="description">Description</label>
                <div class="controls">
                    <textarea name="description" id="description" cols="30" rows="10"><?php echo $data['description']; ?></textarea>
                    <p class="help-block"><?php echo (array_key_exists('description', $errors))? $errors['description'] : ''; ?></p>
                </div>
            </div>

            <div class="form-actions">
                <input type="submit" name="submit" value="Add Tour" />
                <button type="reset" class="btn">Cancel</button>
            </div>
        </fieldset>
    </form>



</div>



<?php require_once 'common/footer.php';?>
