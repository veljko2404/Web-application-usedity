<?php 

    require '../connect.php';
    session_start();
    
    if(isset($_SESSION['verify'])||(isset($_GET['verify'])&&isset($_GET['email']))){

     if(isset($_POST['submit'])){
        $em = $_SESSION['verify'];
        $query = "SELECT * FROM `users` WHERE `email` = '$em'";
        $query_run = mysqli_query($conn, $query);
        $email_q = mysqli_fetch_assoc($query_run);
        $email = $email_q['email'];
        $code = $email_q['code'];
        $message = '
              Click on this link: 
              https://usedity.com/register/verify.php?verify='.$code.'&email='.$email;
            $headers = "from: no-reply@usedity.com";

            if(mail($email, 'Usedity - Verification code', $message, $headers)){
                $success = "Email was sent again to ".$email;
            } else {
                $success = 'Problem occured';
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
  <meta name="description" content="Search for used cars by: price, year, mileage, state, fuel type, gearbox, doors..." />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="Used cars register, buying used car, selling used car" />
  <meta charset="UTF-8" />

  <title>Usedity - Verify</title>

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

    <div class="login" style="width:90%;max-width:960px;margin:150px auto 0;">
        <?php if(isset($_GET['verify'])&&isset($_GET['email'])){
            include '../val.php';
            $code = validate($_GET['verify']);
            $email = validate($_GET['email']);
            $query = "SELECT `code` FROM `users` WHERE `email`='$email'";
            $query_run = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($query_run);
            if($row['code']==$code){
                $verify_query = "UPDATE `users` SET `code`=1 WHERE `email`='$email'";
                if(mysqli_query($conn, $verify_query)){
                    echo '<h3>Code verified. You can login <a href="../login">here</a>.</h3>';
                }else {
                    echo 'problem occured';
                }
            }
        }  else if(isset($_SESSION['verify'])){
                if(isset($success)){
                    echo '<h3>Verification link has been sent to your email account. To verify, go and click on the link. You may have to wait a few minutes for email. If you have not received the email yet, click on resend button: <form action="verify.php" method="post"><input name="submit" style="cursor:pointer;color:#fff; background-color:#2d9940;" type="submit" value="resend"></form></h3><p style="text-align:center;">'.$success.'</p>';
                } else {
                    echo '<h3>Verification link has been sent to your email account. To verify, go and click on the link. You may have to wait a few minutes for email. If you have not received the email yet, click on resend button: <form action="verify.php" method="post"><input name="submit" style="cursor:pointer;color:#fff; background-color:#2d9940;" type="submit" value="resend"></form></h3>';
                }
                    
            }
            
            ?>

    </div>
    <?php require '../footer.php'; ?>

  </div>

</body>
</html>
<?php } else {
    header("Location: ../index.php");
}?>