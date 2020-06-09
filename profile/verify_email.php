<?php 

    require '../connect.php';
    session_start();
    if(isset($_SESSION['verify_email'])||(isset($_GET['new_email'])&&isset($_GET['email']))){

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

    <div class="login" style="width:90%;max-width:960px;margin:150px auto 0;">
        <?php if(isset($_GET['new_email'])&&isset($_GET['email'])){
            $code = $_GET['new_email'];
            $email = $_GET['email'];
            $query = "SELECT `new_email` FROM `users` WHERE `new_email`='$code'";
            $query_run = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($query_run);
            if($row['new_email']==$code){
                $verify_query = "UPDATE `users` SET `email`='$email' WHERE `new_email`='$code'";
                if(mysqli_query($conn, $verify_query)){
                    echo '<h3>Email successfully changed!</h3>';
                }else {
                    echo 'problem occured';
                }
            }
        }  else if(isset($_SESSION['verify_email'])){
                echo '<h3>Verification link has been sent to your new email. To verify, go and click on link. You may have to wait few minutes for email.</h3>';
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