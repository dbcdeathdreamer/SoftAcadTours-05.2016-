<?php
require_once 'common/header.php';
//proverka dali ima podadeno ID
if (!isset($_GET['id'])) {
    header('Location: toursListing.php');
}

//Proverka dali ima Image s takova id
$db = DB::getInstance();
$image = $db->get('tours_images', array('id' => (int)$_GET['id']));
if(empty($image)) {
    header('Location: toursListing.php');
}

//Iztriwane na Image ot bazata kato zapis
$db->delete('tours_images', (int)$_GET['id']);

//Iztrivane na Image Fizicheski
unlink("uploads/tours/{$image[0]['image']}");
header("Location: tourImages.php?id={$image[0]['tours_id']}");