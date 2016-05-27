<?php
session_start();
require_once 'common/header.php';
require_once 'functions.php';

if (!loggedIn()) {
    header('Location: login.php');
}
?>

<?php
if (!isset($_GET['id'])) {
    header('Location: usersListing.php');
}

$db = DB::getInstance();

$user = $db->get('users', array('id' => $_GET['id']));

if (empty($user)) {
    header('Location: usersListing.php');
}

$db->delete('users', $_GET['id']);
header('Location: usersListing.php');
