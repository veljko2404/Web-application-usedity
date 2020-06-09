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
  <meta name="keywords" content="Used cars reset password, buying used car, selling used car" />
  <meta charset="UTF-8" />

  <title>Usedity - Reset password</title>

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
<?php if(isset($success)){echo"<p style='color:#2d9940;'>".$success."</p>"; } else {  ?>
      <h1 class='content-text'>Enter new password.</h1>

      <form action="reset.php" method="post">
        <input type="password" name="password" placeholder="Enter new password..."><br><br>
        <input type="submit" id="last" value="Reset">
        <?php }
            if(isset($error)){echo "<p style='color:red;'>".$error."</p>"; } 
        ?>

      </form>

    </div>
    <?php require '../../footer.php'; ?>

  </div>

</body>
</html>