<?php
session_start();
require_once 'connection.php';
require_once 'functions.php';

if (!loggedIn()) {
    header('Location: login.php');
}
?>

<?php
if (!isset($_GET['id'])) {
    header('Location: usersListing.php');
}

$user = getUserById($_GET['id'], $connection);

if (empty($user)) {
    header('Location: usersListing.php');
}

deleteUser($_GET['id'], $connection);
header('Location: usersListing.php');
