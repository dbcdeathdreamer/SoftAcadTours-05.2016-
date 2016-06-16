<?php
require_once(__DIR__.'/../../../../admin/common/header.php');
?>
<link id="bootstrap-style" href="css/images.css" rel="stylesheet">
<?php require_once(__DIR__.'/../../../../admin/common/sidebar.php'); ?>
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
                        <a href="index.php?c=tours&m=tourImageDelete&id=<?php echo $image->getId(); ?>" class="btn btn-mini btn-danger ">Delete</a>
                        <img style="width:270px; height:220px;" class="img-responsive" src="uploads/tours/<?php echo $image->getImage(); ?>" />
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>


<?php
require_once(__DIR__.'/../../../../admin/common/footer.php');
?>