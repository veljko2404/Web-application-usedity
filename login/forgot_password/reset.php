<?php

  require '../core.php';

  require '../../connect.php';
  
  include '../../val.php';

  if(loggedin()) {
    header("Location: ../../profile");
  }
  
  if(isset($_POST['password'])){
      $password = $_POST['password'];
      if(!empty($password)){
          if(strlen($password)>7){
              $pass = md5($password);
              $email = $_SESSION['email'];
              $query = "UPDATE `users` SET `password`='$pass', `reset`=1 WHERE `email`='$email'";
              if(mysqli_query($conn, $query)){
                  $success = "Password was successfuly changed!  <a href='../../login'>Login</a>";
              } else { $error = "Error occured"; }
          } else {
              $error = "Password must be at least 8 characters!";
          }
          } else { $error = "Field can't be empty!"; }
          require "resetpage.php";
  } else {
  
  if(isset($_GET['reset'])&&isset($_GET['email'])){
      
      $reset_code = validate($_GET['reset']);
      $email = validate($_GET['email']);
      $_SESSION['email'] = $email;
      
      $query = "SELECT `reset` FROM `users` WHERE `email`='$email'";
      
      $query_run = mysqli_query($conn, $query);
      
      if(mysqli_num_rows($query_run)==1){
          $row = mysqli_fetch_assoc($query_run);
          if($row['reset']==$reset_code){
              include "resetpage.php";
          } else {echo 'Wrong link';}
          
      } else {
          header("Location: ../../");
      }
      
  } else {
      header("Location: ../../");
  }

}
?>