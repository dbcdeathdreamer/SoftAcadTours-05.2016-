<?php
session_start();

$_SESSION['logged_in'] = 0;
$_SESSION['user'] = '';

header('Location: login.php');
