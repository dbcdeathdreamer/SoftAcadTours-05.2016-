<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="common/views/frontend/home.php">Start Bootstrap</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Destination <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        $categories = $this->getNavigationParams();

                        ?>
                        <li>
                            <a href="index.php?c=tours&m=toursByCategory&categoryId=0">All Categories</a>
                        </li>
                        <?php foreach ($categories as $category): ?>
                            <li>
                                <a href="index.php?c=tours&m=toursByCategory&categoryId=<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></a>
                            </li>
                        <?php endforeach; ?>
                       
                    </ul>
                </li>
                <li>
                    <a href="about.php">About</a>
                </li>
                <li>
                    <a href="login.php">Login</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>