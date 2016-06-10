<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: toursListing.php');
}

$toursCollection = new ToursCollection();
$tour = $toursCollection->getOne($_GET['id']);

if(is_null($tour->getId())) {
    header('Location: toursListing.php');
}

$toursCollection->delete($tour->getId());
header('Location: toursListing.php');
