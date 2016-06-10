<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
   die;
}

if(!isset($_GET['id'])) {
    header('Location: clients.php');
    exit(0);
}

$clientsCollection = new ClientsCollection();
$client = $clientsCollection->getOne($_GET['id']);

if(is_null($client->getId())) {
    header('Location: clients.php');
    exit(0);
}

$clientsCollection->delete($client->getId());
header('Location: clients.php');
