<?php

require '../connect.php';

$id = $_POST['id'];
$user_id = $_POST['user_id'];

$query = "DELETE from `messages` WHERE `id`='$id' && `id_user`='$user_id'";

if(mysqli_query($conn, $query)){
    echo 'ok';
} else {
    echo '';
}

?>