<?php

require '../login/core.php';

require '../connect.php';

include '../val.php';

  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $id = $user['id'];
    
    if(isset($_POST['password'])&&isset($_POST['s_password'])) {

      $pass = validate($_POST['password']);
      $password = md5($pass);
      if(!empty($_POST['password'])) {
        $query_password = "SELECT password FROM users WHERE id=".$id;
        if($query_run_password = mysqli_query($conn, $query_password)) {
          $db_password_q = mysqli_fetch_assoc($query_run_password);
          $db_password = $db_password_q['password'];
          if($password == $db_password) {
            $error_password = "Password must be different.";
          } else {
            $query_password_edit = "UPDATE `users` SET `password` = '".$password."' WHERE `id` = ".$id."";
            if(mysqli_query($conn, $query_password_edit)) {
              $success_password = "Password changed";
            } else {
              $error_password = "Error occured";
            }
          }
        }
      } else {
        $error_password = "Field can't be empty";
      }

    }

    if(isset($_POST['name'])&&isset($_POST['s_name'])) {

      $name = validate($_POST['name']);
      if(!empty($name)) {
        $query_name = "SELECT name FROM users WHERE id=".$id;
        if($query_run_name = mysqli_query($conn, $query_name)) {
          $db_name_q = mysqli_fetch_assoc($query_run_name);
          $db_name = $db_name_q['name'];
          if($name == $db_name) {
            $error_name = "Name must be different.";
          } else {
            $query_name_edit = "UPDATE `users` SET `name` = '".$name."' WHERE `id` = ".$id."";
            if(mysqli_query($conn, $query_name_edit)) {
              $success_name = "Name changed";
              $name = "";
            } else {
              $error_name = "Error occured";
            }
          }
        }
      } else {
        $error_name = "Field can't be empty";
      }

    }

    if(isset($_POST['email'])&&isset($_POST['s_email'])) {

      $email = validate($_POST['email']);
      if(!empty($email)) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $query_email = "SELECT email FROM users";
          if($query_run_email = mysqli_query($conn, $query_email)) {
            while($db_email = mysqli_fetch_assoc($query_run_email)){
                if($db_email['email'] == $email){
                    $ok = 1;
                } 
            }
                if($ok == 1){
                    $error_email = "That email is already registered!";
                } else {
                $code_r = rand();
                $code = md5($code_r);
              $query_email_edit = "UPDATE `users` SET `new_email` = '".$code."' WHERE `id` = ".$id."";
              if(mysqli_query($conn, $query_email_edit)) {
                $_SESSION['verify_email'] = "ok";
                $message = 'Click here to verify new email adress: 
                    https://www.usedity.com/profile/verify_email.php?new_email='.$code.'&email='.$email;
                    mail($email, 'Usedity - verify email', $message, 'from: no-reply@usedity.com');
                    header("Location: verify_email.php");
              } else {
                $error_email = "Error occured";
                $email = "";
              }
            }
          }
        } else {
          $error_email = "Enter valid email";
        }
      } else {
        $error_email = "Field can't be empty";
      }

    }

    $query_info = "SELECT * FROM users WHERE `id`='".$id."'";
    $query_run_info = mysqli_query($conn, $query_info);
    $user_info = mysqli_fetch_assoc($query_run_info);

?>
<!DOCTYPE html>
<html lang="en-US">
<head>

  <link rel="stylesheet" href="css/edit.css" />
  <link rel="stylesheet" href="../css/global.css" />
  <link rel="icon" sizes="50x50" href="../photos/logo/logo50x50.png">
  <link rel="apple-touch-icon" href="../photos/logo/logo200x200.png">
  <meta name="apple-mobile-web-app-title" content="Usedity">
  <meta name="description" content="Search for used cars by: price, year, mileage, state, fuel type, gearbox, doors..." />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="Edit profile Used cars, buying used car, selling used car" />
  <meta charset="UTF-8" />

  <title>Usedity - Edit profile</title>
  
    <!--
  
    UU   UU   UUUU  UUUUUUU  UUUUUU    UU  UUUUUUUU  UU    UU
    UU   UU  UU     UU       UU    UU  UU     UU     UU    UU
    UU   UU  UU     UU       UU    UU  UU     UU     UU    UU
    UU   UU   UUU   UUUUUU   UU    UU  UU     UU       UUUUUU
    UU   UU     UU  UU       UU    UU  UU     UU           UU
    UU   UU     UU  UU       UU    UU  UU     UU     UU    UU
     UUUUU   UUUU   UUUUUU   UUUUUU    UU     UU      UUUUUU
  
  -->
  
  <!--ICONS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

  <div class="full-page">

    <div class="header">
      <div class="logo">
        <a href="../index.php"><img src="../photos/logo/logo.png" alt="Logo"></a>
      </div>
      <div class="header-text">
        <p>To go back to profile, <a href="index.php">Click here</a>.</p>
      </div>
      <div class="line"></div>
    </div>

    <div class="profile">
      <h1>Edit profile</h1><br>
      <form action="edit-profile.php" method="post">
        <label>Edit name</label>
        <input type="text" name="name" value="<?php if(isset($name)){echo $name;} ?>" placeholder="<?php echo $user_info['name']; ?>"><input class="submit" type="submit" value="" name="s_name"><br>
        <p class="error"><?php if(isset($error_name)){echo $error_name;} ?> </p>
        <p class="success"><?php if(isset($success_name)){echo $success_name;} ?> </p>
        <label>Edit email</label>
        <input type="email" name="email" value="<?php if(isset($email)){echo $email;} ?>" placeholder="<?php echo $user_info['email']; ?>"><input class="submit" type="submit" value="" name="s_email"><br>
        <p class="error"><?php if(isset($error_email)){echo $error_email;} ?></p>
        <p class="success"><?php if(isset($success_email)){echo $success_email;} ?> </p>
        <label>Edit password</label>
        <input type="password" name="password"><input class="submit" type="submit" name="s_password" value=""><br>
        <p class="error"><?php if(isset($error_password)){echo $error_password;} ?></p>
        <p class="success"><?php if(isset($success_password)){echo $success_password;} ?> </p>
      </form>

    </div>

    <?php require '../footer.php'; ?>

  </div>

</body>
</html>
<?php } else {
  header("Location: ../login");
} ?>
