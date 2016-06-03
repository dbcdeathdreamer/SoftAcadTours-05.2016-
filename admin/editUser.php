
<?php require_once 'common/header.php'?>
<?php
if (!loggedIn()) {
    header('Location: login.php');
}
?>

<?php
if (!isset($_GET['id'])) {
    header('Location: usersListing.php');
}

$userCollection = new UsersCollection();
$user = $userCollection->getOne($_GET['id']);

if (empty($user)) {
    header('Location: usersListing.php');
}

$data = array(
    'id'    => $user->getId(),
    'username' => $user->getUsername(),
    'email'    => $user->getEmail(),
    'description' => $user->getDescription(),
);

?>

<?php
$errors = array();

if (isset($_POST['submit'])) {
    $data = array(
        'id'    => $_GET['id'],
        'username' => $_POST['username'],
        'email'    => $_POST['email'],
        'description' => $_POST['description'],
    );


    if (strlen(trim($_POST['username'])) < 5 || strlen(trim($_POST['username'])) > 50) {
        $errors['username'] = 'Username must be between 5 and 50 chars';
    }

    if (empty($errors)) {
        
        $entity = new UserEntity();
        $entity->init($data);

        $userCollection->save($entity);

        header('Location: usersListing.php');
    }

}


?>




<?php require_once 'common/sidebar.php'?>


    <!-- start: Content -->
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
                <div class="control-group">
                    <label class="control-label" for="username">Username</label>
                    <div class="controls">
                        <input type="text" class="span6" id="username" name="username" value="<?php echo $data['username']; ?>" />
                        <p class="help-block"></p>
                    </div>
                </div>
               
                <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                        <input type="text" class="span6" id="email" name="email" value="<?php echo $data['email']; ?>" />
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="description">Description</label>
                    <div class="controls">
                        <textarea name="description" id="description" cols="30" rows="10"><?php echo $data['description']; ?></textarea>
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="form-actions">
                    <input type="submit" name="submit" value="Add User" />
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
        </form>


    </div><!--/.fluid-container-->

<?php require_once 'common/footer.php'?>