<?php

  require '../connect.php';

  $id_car = $_POST['id_car'];
  $user = $_POST['id_user'];

  $sec_query = "SELECT thumb, images, id_user FROM `cars` WHERE `id_car` = '$id_car'";
  $query_run = mysqli_query($conn, $sec_query);
  $row = mysqli_fetch_assoc($query_run);
  $thumb = $row['thumb'];
  $images = $row['images'];
  $id_user = $row['id_user'];
  if($user == $id_user){
    $img = explode("|", $images);
    unlink("../uploads/thumbs/".$row['id_user']."/".$thumb);
    for($i=0; $i<count($img);$i++){
      unlink("../uploads/images/".$row['id_user']."/".$img[$i]);
    }
    $query = "DELETE FROM `cars` WHERE `id_car` = '$id_car'";
echo $_POST['id_user'];
    if(mysqli_query($conn, $query)){
    echo 'ok';
    } else {
      echo '';
     }
  } else {
      echo '';
  }
?>
