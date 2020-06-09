<?php

  if(loggedin()) {

    header("Location: ../profile");

  } else {

  if(isset($_POST["email"])&&isset($_POST["password"])) {

    function validate($data) {
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      
    $email = validate($_POST["email"]);
    $pass = validate($_POST["password"]);
    $password = md5($pass);

    if(!empty($email)&&!empty($password)) {

      $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";

      if($query_run = mysqli_query($conn, $query)) {

        $query_num_rows = mysqli_num_rows($query_run);

        if($query_num_rows==0) {

          $error = "Wrong email or password.";

        } else if($query_num_rows==1) {
            $user_id = mysqli_fetch_assoc($query_run);
          if($user_id['code']==1){
            $_SESSION["user"] = $user_id;
            header("Location: ../profile");
          } else {
              $error = "Email is not verified"; 
          }
        }
      }
    } else {

      $error = "All fields must be filled in !";

    }
      
  }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="../css/global.css" />
  <link rel="icon" sizes="50x50" href="../photos/logo/logo50x50.png">
  <link rel="apple-touch-icon" href="../photos/logo/logo200x200.png">
  <meta name="apple-mobile-web-app-title" content="Usedity">
  <meta name="description" content="Login to your profile on usedity.com to sell car!" />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="login, Used cars login, buying used car, selling used car" />
  <meta charset="UTF-8" />

  <title>Usedity - Login</title>
  
 <!--ICONS-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!--
  
    UU   UU   UUUU  UUUUUUU  UUUUUU    UU  UUUUUUUU  UU    UU
    UU   UU  UU     UU       UU    UU  UU     UU     UU    UU
    UU   UU  UU     UU       UU    UU  UU     UU     UU    UU
    UU   UU   UUU   UUUUUU   UU    UU  UU     UU       UUUUUU
    UU   UU     UU  UU       UU    UU  UU     UU           UU
    UU   UU     UU  UU       UU    UU  UU     UU     UU    UU
     UUUUU   UUUU   UUUUUU   UUUUUU    UU     UU      UUUUUU
  
  -->

</head>
<body>

  <div class="full-page">

    <div class="header">
      <div class="logo">
        <a href="../index.php"><img src="../photos/logo/logo.png" alt="Logo"></a>
      </div>
      <div class="header-text">
        <p>Don't have an account ? <a href="../register">Register here</a>.</p>
      </div>
      <div class="line"></div>
    </div>

    <div class="login">

      <h1 class='content-text'>Login</h1>

      <form action="<?php echo "index.php"; ?>" method="POST">
        <input type="email" name="email" autofocus <?php if(isset($email)){echo "value=".$email;} ?> placeholder="Enter email..."><br><br>
        <input type="password" name="password" placeholder="Enter password..."><br>
        <p><a href="forgot_password">Forgot password ?</a></p>
        <input type="submit" value="Login" id="last">
        <?php if(isset($error)) { ?>
          <p class="error"><?php echo $error; ?></p>
        <?php } ?>
      </form>

    </div>

    <?php require '../footer.php'; ?>

  </div>

</body>
</html>
<?php } ?>
