<?php
function getAllUsers($connection) {
    $sql = 'SELECT * FROM users';
    $result = mysqli_query($connection, $sql);
    $users = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}

function loggedIn(){
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != 1 || !isset($_SESSION['user'])) {
       return false;
    }
    return true;
}

function getUserByUsername($username, $connection) {
    $sql = "SELECT * FROM `users` WHERE `username` = '{$username}'";

    $result = mysqli_query($connection, $sql);
    $users = array();
    WhiLe ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    return $users;
}

function insertUser($data, $connection) {
    $password = sha1($data['password']);
    $sql = "
        INSERT INTO users
        SET 
          `username` = '{$data['username']}',
          `password` = '{$password}',
          `email`    = '{$data['email']}',
          `description` = '{$data['description']}'
    ";

    return mysqli_query($connection, $sql);
}

function updateUser($id, $data, $connection) {
    $sql = "
        UPDATE users
        SET 
          `username` = '{$data['username']}',
          `email`    = '{$data['email']}',
          `description` = '{$data['description']}'
        WHERE
          `id` = '{$id}'        
    ";

    return mysqli_query($connection, $sql);
}




function getUserById($id, $connection) {
    $sql = "SELECT * FROM `users` WHERE `id` = '{$id}'";

    $result = mysqli_query($connection, $sql);
    $users = array();
    WhiLe ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}

function deleteUser($id, $connection) {
    $sql = "DELETE FROM users Where id = '{$id}' ";
    mysqli_query($connection, $sql);
}


?>


