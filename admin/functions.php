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

?>


