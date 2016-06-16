<?php require_once 'header.php'; ?>
<?php require_once 'nav.php'; ?>

<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">One Column Portfolio
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a>
                </li>
                <li class="active">One Column Portfolio</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <?php  foreach ($tours as $tour): ?>
        <!-- Project One -->
        <div class="row">
            <div class="col-md-7">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-hover" src="admin/uploads/<?php echo $tour->getImage(); ?>" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h3><?php echo $tour->getName(); ?></h3>
                <p><?php echo $tour->getDescription(); ?></p>
                <a class="btn btn-primary" href="index.php?c=tours&m=show&id=<?php echo $tour->getId(); ?>">View Project</i></a>
            </div>
        </div>
        <!-- /.row -->
        <hr>
    <?php endforeach; ?>

    <?php echo $paginator->create(); ?>
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
