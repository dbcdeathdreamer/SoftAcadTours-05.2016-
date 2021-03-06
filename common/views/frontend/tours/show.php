<?php require_once  'header.php'; ?>
<?php require_once 'nav.php'; ?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Portfolio Item
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a>
                </li>
                <li class="active">Portfolio Item</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Portfolio Item Row -->
    <div class="row">

        <div class="col-md-8">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="img-responsive" src="admin/uploads/<?php echo $tour->getImage(); ?>" alt="">
                    </div>

                   <?php foreach ($toursImages as $tourImage): ?>
                       <div class="item">
                           <img class="img-responsive" src="admin/uploads/tours/<?php echo $tourImage->getImage(); ?>" alt="">
                       </div>
                    <?php endforeach; ?>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <h3><?php echo $tour->getName(); ?></h3>
            <p><?php echo $tour->getDescription(); ?></p>

        </div>

    </div>
    <!-- /.row -->

    <!-- Related Projects Row -->
    <div class="row">

        <div class="col-lg-12">
            <h3 class="page-header">Related Tours</h3>
        </div>

        <?php foreach ($randomResults as $randomResult): ?>
        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive img-hover img-related" src="admin/uploads/<?php echo $randomResult->getImage(); ?>" alt="">
            </a>
        </div>
        
        <?php endforeach; ?>






    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>

</div>



<?php require_once 'footer.php'; ?>

