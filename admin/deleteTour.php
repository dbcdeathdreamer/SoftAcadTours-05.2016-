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
    header('Location: toursListing.php');
}

$tour = getTourById($_GET['id'], $connection);

if (empty($tour)) {
    header('Location: toursListing.php');
}


unlink('uploads/'.$tour[0]['image']);
deleteTour($_GET['id'], $connection);


header('Location: toursListing.php');
