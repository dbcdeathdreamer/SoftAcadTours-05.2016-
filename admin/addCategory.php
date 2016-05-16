<?php require_once 'common/header.php';?>
<?php
if (!loggedIn()) {
    header('Location: login.php');
}
?>

<?php
$data = array(
    'name' => '',
    'description' => ''
);

$errors = array();
if (isset($_POST['submit'])) {
    if(strlen(trim($_POST['name'])) < 3 || strlen(trim($_POST['name'])) > 255) {
        $errors['name'] = 'Invalid category name length';
    }
    if(strlen(trim($_POST['description'])) < 3 || strlen(trim($_POST['description'])) > 500) {
        $errors['description'] = 'Invalid category description length';
    }
    $data = array(
        'name' => trim($_POST['name']),
        'description' => trim($_POST['description']),
    );

    if (empty($errors)) {
        insertCategory($connection, $data);
        header('Location: categoriesListing.php');
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


    <form class="form-horizontal" action="" method="post">
        <fieldset>
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
                <input type="submit" name="submit" value="Add Category" />
                <button type="reset" class="btn">Cancel</button>
            </div>
        </fieldset>
    </form>


</div>



<?php require_once 'common/footer.php';?>
