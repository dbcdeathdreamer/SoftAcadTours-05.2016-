<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: clients.php');
}

$db = DB::getInstance();
$user = $db->get('clients', array("id" => $_GET['id']));
if(is_null($user)) {
    header('Location: clients.php');
}

$insertInfo = array(
    'username' => $user[0]['username'],
    'password' => '',
    'email'    => $user[0]['email'],
);

$errors = array();

if(isset($_POST['editUser'])) {

    $insertInfo = array(
        'username' => (isset($_POST['username']))? $_POST['username'] : '',
        'password' => (isset($_POST['password']))? $_POST['password'] : '',
        'email'    => (isset($_POST['email']))? $_POST['email'] : '',
    );

    $errors = validateUserInput($insertInfo);
    if (empty($errors)) {
        $db->update('clients', $user[0]['id'], $insertInfo);
        $_SESSION['flashMessage'] = 'You have 1 affected row';
        header('Location: clients.php');
    }


} ?>


<?php

require_once('common/sidebar.php');

?>

    <!-- start: Content -->
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="dashboard.php">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Dashboard</a></li>
        </ul>


        <form action="" method="post"  class="form-horizontal">
            <fieldset>
                <div class="control-group <?php echo (array_key_exists('username', $errors))? 'error' : ''; ?>">
                    <label class="control-label" for="inputError">Username</label>
                    <div class="controls">
                        <input type="text" id="inputError" name="username" value="<?php echo $insertInfo['username']; ?>">
                        <?php if (array_key_exists('username', $errors)): ?>
                            <span class="help-inline"><?php echo $errors['username']; ?></span>
                        <?php  endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo (array_key_exists('password', $errors))? 'error' : ''; ?>">
                    <label class="control-label" for="inputError">Password</label>
                    <div class="controls">
                        <input type="password" id="inputError" name="password">
                        <?php if (array_key_exists('password', $errors)): ?>
                            <span class="help-inline"><?php echo $errors['password']; ?></span>
                        <?php  endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo (array_key_exists('email', $errors))? 'error' : ''; ?>">
                    <label class="control-label" for="inputError">Email</label>
                    <div class="controls">
                        <input type="text" id="inputError" name="email" value="<?php echo $insertInfo['email']; ?>">
                        <?php if (array_key_exists('email', $errors)): ?>
                            <span class="help-inline"><?php echo $errors['email']; ?></span>
                        <?php  endif; ?>
                    </div>
                </div>

                <div class="form-actions">
                    <input type="submit" name="editUser" value="Update Client" class="btn btn-primary"/>
                </div>
            </fieldset>
        </form>




    </div>


<?php
require_once('common/footer.php');
?>