<?php

  require '../connect.php';
  session_start();

  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $id = $user['id'];
  }

?>
<!DOCTYPE html>
<html lang="en-US">
<head>

  <link rel="stylesheet" href="../css/global.css" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" sizes="50x50" href="../photos/logo/logo50x50.png">
  <link rel="apple-touch-icon" href="../photos/logo/logo200x200.png">
  <meta name="apple-mobile-web-app-title" content="Usedity">
  <meta name="description" content="See how usedity.com works. Find out for how to: create account, change profile data, sell car, search car, contact, recover password." />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="Usedity - how it works, How usedity works" />
  <meta charset="UTF-8" />

  <title>Usedity - How it works ?</title>
  
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
      <?php if(isset($_SESSION['user'])) { ?>
      <script>

      function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
      }

    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>

    <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn" id="drpdwn">Profile &#9662;</button>
      <div id="myDropdown" class="dropdown-content">
        <a href="../profile">View profile</a>
        <a href="../profile/logout.php">Log out</a>
        <a href="../">Go back</a>
      </div>
    </div>
    <?php } else { ?>
      <p>Do you want to sell a car ? <a href="../login/">Login first</a>.</p>
      <?php } ?>
    </div>
    <div class="line"></div>
  </div>

  <div class="how">
    <h2>How usedity.com works?</h2>
    <h3>1. Creating an account</h3>
    <p>On <a href="../register">register</a> page you need to enter your name, email and password. Then go to your email account and find an email from no-reply@usedity.com (It might be in the spam folder). Click on the verification link. That's all!</p>
    <br><h3>2. Changing profile data</h3>
    <p>On <a href="../profile/edit-profile.php">edit profile</a> page you can change your name, email and password. Email need to be verified in the same way as on creating an account.</p>
    <br><h3>3. Selling car</h3>
    <p>On the <a href="../sell_car">sell car</a> page you need to enter information: make, model, price, mileage, number of doors, year, fuel type, gearbox, state, short description of car (up to 50 char.), one thumbnail image (that image will appear on search results), and up to 12 more images</p>
    <br><h3>4. Searching car</h3>
    <p>On the <a href="../">main</a> page you can search for cars by choosing details you're looking for. Also on the "search" button, you can see how many cars matches with your details. If it doesn't work you need to click on "reset search" button.</p>
    <br><h3>5. Contacting</h3>
    <p>When you post on <a href="../sell_car">sell car</a> page people will be able to contact you by sending you a message. You will receive a message on your email account (email might be in the spam folder), and on <a href="../profile/messages.php">messages </a> page. Message will contain their email and message.</p>
    <br><h3>6. Recovering password</h3>
    <p>If you forget your password you can recover it on <a href="../login/forgot_password">forgot password </a> page. When you click on "reset" button you will receive an email with verification link (It might be in the spam folder). Click on that link and enter new password.</p>
  </div>

  <?php require '../footer.php'; ?>

</div>

</body>
</html>