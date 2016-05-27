
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

$db = new DB();
$where = array('id' => $_GET['id']);
$user = $db->get('users', $where);

if (empty($user)) {
    header('Location: usersListing.php');
}
$user = $user[0];
$data = array(
    'username' => $user['username'],
    'email'    => $user['email'],
    'description' => $user['description'],
    
);

?>

<?php
$errors = array();

if (isset($_POST['submit'])) {
    $data = array(
        'username' => $_POST['username'],
        'email'    => $_POST['email'],
        'description' => $_POST['description'],
    );


    if (strlen(trim($_POST['username'])) < 5 || strlen(trim($_POST['username'])) > 50) {
        $errors['username'] = 'Username must be between 5 and 50 chars';
    }

    if (empty($errors)) {
        $db->update('users', $_GET['id'], $data);
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