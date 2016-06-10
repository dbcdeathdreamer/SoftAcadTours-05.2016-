<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: blogListing.php');
}

$blogCollection = new BlogCollection();
$blog = $blogCollection->getOne($_GET['id']);

if(is_null($blog->getId())) {
    header('Location: blogListing.php');
}

$blogCollection->delete($blog->getId());
header('Location: blogListing.php');
