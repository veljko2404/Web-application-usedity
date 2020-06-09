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
  <meta name="description" content="About usedity.com. Find out who made this website and when" />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="Usedity - about, about, sell car, buy car" />
  <meta charset="UTF-8" />

  <title>Usedity - About</title>
  
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

  <div class="about">
    <h1>About Usedity.com</h1>
    <p>Usedity.com is an online web application that helps to connect car buyers and sellers. Founded in July 2018 by Veljko Petkovic. If you want to cantact us, click <a href="https://www.usedity.com/contact/">here</a>.</p>
  </div>

  <?php require '../footer.php'; ?>

</div>

</body>
</html>
