 <?php require_once 'header.php'; ?>
 <?php require_once 'nav.php'; ?>
    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active">
                  </li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('http://www.londonblacktaxitours.net/wp-content/ata-images/header/DSC_4582.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 1</h2>

                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://car-tours.ch/wp-content/uploads/2015/10/car-tours-griechenland_angebot2.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://www.greatvaluetrips.com/wp-content/themes/greatvaluetrips/images/inner.png');"></div>
                <div class="carousel-caption">
                    <h2>Caption 3</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Soft Tours
                </h1>
            </div>
            <?php foreach ($lastBlogPosts as $lastBlogPost): ?>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4><i class="fa fa-fw fa-check"></i><?php echo $lastBlogPost->getName(); ?></h4>
                        </div>
                        <div class="panel-body">
                            <img class="img-responsive" src="http://www.spiritofindiatours.com/images/Rajasthan-tours.jpg" alt="">
                            <p><?php echo $lastBlogPost->getDescription(); ?></p>
                            <a href="#" class="btn btn-default">Learn More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <?php foreach ($randomTours as $randomTour): ?>
                <div class="col-md-4 img-portfolio">
                    <a href="portfolio-item.html">
                        <img  class="img-responsive img-hover" src="admin/uploads/<?php echo $randomTour->getImage() ?>" alt="">
                    </a>
                    <h3>
                        <a href="portfolio-item.html"><?php echo $randomTour->getName(); ?></a>
                    </h3>
                    <p><?php echo $randomTour->getDescription(); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- /.row -->


        <!-- /.row -->

        <hr>



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
    <!-- /.container -->

  <?php require_once 'footer.php'; ?>

