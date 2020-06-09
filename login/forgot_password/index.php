<?php

  require '../core.php';

  require '../../connect.php';

  if(loggedin()) {
    header("Location: ../../profile");
  }

  if(isset($_POST['email'])) {

    $email = $_POST['email'];
    if(!empty($email)) {
        $query = "SELECT `email` FROM `users` WHERE `email`='$email'";
        if($query_run = mysqli_query($conn, $query)){
        if(mysqli_num_rows($query_run)==1){
         $code_r = rand();
         $code = md5($code_r);
         $query = "UPDATE `users` SET `reset`='$code' WHERE email='".$email."'";
         if($query_run=mysqli_query($conn, $query)) {
           $message = '
            Click here to reset password: 
            http://www.usedity.com/login/forgot_password/reset.php?reset='.$code.'&email='.$email;
            if(mail($email, 'Usedity - Reset your password', $message, 'from: no-reply@usedity.com')){
                $success = "Verification link has been sent to your email.";
            } else {
                $error = "Something went wrong";
            }
        }
        } else {
            $error = "Your email was not found!";
        }
      }
    } else {
      $error = "This field can't be empty";
    }

  }

?>
<!DOCTYPE html>
<html lang="en-US">
<head>

  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../../css/global.css" />
  <link rel="icon" sizes="50x50" href="../../photos/logo/logo50x50.png">
  <link rel="apple-touch-icon" href="../../photos/logo/logo200x200.png">
  <meta name="apple-mobile-web-app-title" content="Usedity">
  <meta name="description" content="Search for used cars by: price, year, mileage, state, fuel type, gearbox, doors..." />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="Used cars forgot password, buying used car, selling used car" />
  <meta charset="UTF-8" />

  <title>Usedity - Forgot password ?</title>
  
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

  <style>
    @media only screen and (max-width:768px) {
      .content-text {
        font-size:1.5em;
      }
    }
  </style>

</head>
<body>

  <div class="full-page">

    <div class="header">
      <div class="logo">
        <a href="../../index.php"><img src="../../photos/logo/logo.png" alt="Logo"></a>
      </div>
      <div class="header-text">
        <p>Don't have an account ? <a href="../../register">Register here</a>.</p>
      </div>
      <div class="line"></div>
    </div>

    <div class="login">

      <h1 class='content-text'>Enter your email to reset your password.</h1>

      <form action="index.php" method="post">

        <input type="email" name="email" value="<?php if(isset($email)) {echo $email;} ?>" placeholder="Enter Email..."><br><br>
        <input type="submit" value="Reset" id="last">
        <?php if(isset($success)){echo "<p style='color:#2d9940;'>".$success."</p>"; } 
            if(isset($error)){echo "<p style='color:red;'>".$error."</p>"; } 
        ?>

      </form>

    </div>
    <?php require '../../footer.php'; ?>

  </div>

</body>
</html>
