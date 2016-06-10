<?php
require_once('common/header.php');
?>
<?php

if (!isset($_GET['id'])) {
    header('Location: toursListing.php');
}

$db = DB::getInstance();
$where = array('id' => (int)$_GET['id']);
$tour = $db->get('tours', $where);

if (empty($tour)) {
    header('Location: toursListing.php');
}

$tour = $tour[0];

$where = array('tours_id' => $_GET['id']);
$images = $db->get('tours_images', $where);


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

    if (empty($imageErrors)) {
        $data = array(
            'tours_id' => $_GET['id'],
            'image'    => $imageName
        );
        $db->insert('tours_images', $data);
        move_uploaded_file($imagePath, 'uploads/tours/' . $imageName);
        header("Location: tourImages.php?id={$_GET['id']}");
    }

}

?>
    <link id="bootstrap-style" href="css/images.css" rel="stylesheet">
<?php require_once('common/sidebar.php'); ?>
    <!-- start: Content -->
    <div id="content" class="span10" xmlns="http://www.w3.org/1999/html">

        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="dashboard.php">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Tour Images</a></li>
        </ul>

        <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="fileInput">File input</label>
                    <div class="controls">
                        <input class="input-file uniform_on" id="fileInput" name="image" type="file">
                        <input type="submit" name="createTour" value="Add Tour" class="btn btn-primary"/>
                    </div>
                </div>

            </fieldset>
        </form>


        <div class="container">
            <div class="row">
                <?php foreach($images as $image): ?>
                    <div class="span3 ">
                        <a href="deleteTourImage.php?id=<?php echo $image['id']; ?>" class="btn btn-mini btn-danger ">Delete</a>
                        <img style="width:270px; height:220px;" class="img-responsive" src="uploads/tours/<?php echo $image['image'] ?>" />
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>


<?php
require_once('common/footer.php');
?>