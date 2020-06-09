<?php

require '../connect.php';
session_start();
  if(isset($_SESSION['user'])) {
    header("Location: ../profile");
  } else {

  if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['password'])) {
    include '../val.php';
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    $pass_r = validate($_POST['password_r']);
    $password = md5($pass);
    $date = date("Y-m-d");

    if(!empty($name)&&!empty($email)&&!empty($_POST['password'])) {
      if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
      if(strlen($pass)>7){
      if($pass_r == $pass){
      $query = "SELECT email FROM users WHERE email='$email'";
      $query_run = mysqli_query($conn, $query);

      if(mysqli_num_rows($query_run)==1) {

        $error = 'This email is already registered !';

      } else {
        $code_r = rand();
        $code = md5($code_r);
        $query = "INSERT INTO users VALUES (DEFAULT,'$name','$email','$password','$date','$code','','')";

        if(mysqli_query($conn, $query)) {
            
            $message = '
              Click on this link: 
              https://usedity.com/register/verify.php?verify='.$code.'&email='.$email;
            $headers = "from: no-reply@usedity.com";

            if(mail($email, 'Usedity - Verification code', $message, $headers)){
                $_SESSION['verify'] = $email;
                header("Location: verify.php");
            } else {
                echo '<script>alert("problem occured")</script>';
            }
        } else {
            echo '<script>alert("Something went wrong");</script>';
        }

        }
      }  else {
      $error = "Passwords don't match!";
        }
     } else {
       $error = "Password must be more than 8 characters";
     }
   } else {
     $error = "Please, enter valid email";
   }
    } else {

      $error = 'All fields must be filled in !';

    }
  }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>

  <link rel="stylesheet" href="../login/css/style.css" />
  <link rel="stylesheet" href="../css/global.css" />
  <link rel="icon" sizes="50x50" href="../photos/logo/logo50x50.png">
  <link rel="apple-touch-icon" href="../photos/logo/logo200x200.png">
  <meta name="apple-mobile-web-app-title" content="Usedity">
  <meta name="description" content="Create an account on usedity.com to sell car" />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="register, Used cars register, buying used car, selling used car" />
  <meta charset="UTF-8" />

  <title>Usedity - Create an account</title>
  
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
        <p>Already have an account ? <a href="../login">Login here</a>.</p>
      </div>
      <div class="line"></div>
    </div>

    <div class="login">

      <h1 class='content-text'>Registration</h1>

      <form action="index.php" method="post">
        <input type="name" autofocus name="name" value="<?php if(isset($name)) {echo $name;} ?>" placeholder="Enter your name..."><br><br>
        <input type="email" name="email" value="<?php if(isset($email)) {echo $email;} ?>" placeholder="Enter your Email..."><br><br>
        <input type="password" name="password" placeholder="Enter your password..."><br><br>
        <input type="password" name="password_r" placeholder="Retype your password..."><br><br>
        <a href="../how_it_works" target="_blank">How it works?</a><br>
        <input type="submit" value="Register" id="last">
        <?php if(isset($error)) { ?>
        <p class='error'><?php echo $error; ?></p>
        <?php } ?>
      </form>

    </div>
    <?php require '../footer.php'; ?>

  </div>

</body>
</html>
<?php } ?>
