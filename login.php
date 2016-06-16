<?php require_once 'header.php'; ?>

<?php 

$errors = array();
if (isset($_POST['submit'])) {
    if (strlen(trim($_POST['username'])) > 60 || strlen(trim($_POST['username'])) < 3) {
        $errors['error'] = 'Wrong credentials';
    }

    if (strlen(trim($_POST['password'])) > 50 || strlen(trim($_POST['password'])) < 3) {
        $errors['error'] = 'Wrong credentials';
    }
    
    if (empty($errors)) {
        $db = DB::getInstance();
        $where = array('username' => htmlspecialchars(trim($_POST['username'])));
        $client = $db->get('clients', $where);
        if (!empty($client)) {
            if ($client[0]['password'] == sha1(trim($_POST['password']))) {
                $_SESSION['client'] = $client;
                header('Location: index.php');
            } else {
                $errors['error'] = 'Wrong credentials';
            }
        } else {
            $errors['error'] = 'Wrong credentials';
        }
    }
    
}

?>

<?php require_once 'nav.php'; ?>
<!-- Header Carousel -->





<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Login
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="common/views/frontend/home.php">Home</a>
                </li>
                <li class="active">Login</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Intro Content -->
    <div class="row">
        <div class="col-md-12">
            <div class = "container">
                <div class="wrapper">
                    <form action="" method="post" name="Login_Form" class="form-signin">
                        <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
                        <hr class="colorgraph"><br>
                        <?php echo (array_key_exists('error', $errors))? $errors['error'] : ''; ?>
                        <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
                        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>

                        <input type="submit" class="btn btn-lg btn-primary btn-block"  name="submit" value="Login"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->



<?php require_once 'footer.php'; ?>
