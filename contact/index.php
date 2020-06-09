<?php

  require '../connect.php';
  session_start();

  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $id = $user['id'];
  }

  if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['message'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    if(!empty($name)&&!empty($email)&&!empty($message)&&strlen($message)<1001){
      $email_to = "veljko.petko0022@gmail.com";
      $headers = "from: ".$email;
      if(mail($email_to, "New message from Usedity.com", $message, $headers)){
        $success = "Message was sent successfuly.";
      } else {
        $error = "Error occured";
      }
    } else {
      $error = "All fields must be filled in!";
    }
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
  <meta name="description" content="If you have any question, contact us!" />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="Usedity - contact, contact, sell car, buy car" />
  <meta charset="UTF-8" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <title>Usedity - Contact Us</title>
  
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

  <div class="contact">
		<form action="index.php" method="post">
      <h1>Contact us</h1>
      <span id="s_name">Name</span>
      <input type="text" name="name" id="name" value="<?php  ?>"><br>
      <span id="s_email">Email</span>
      <input type="email" name="email" id="email" value="<?php  ?>"><br>
      <span id="s_message">Message</span>
      <textarea name="message" rows="5" id="message" maxlength="1000"></textarea>
      <input type="submit" id="submit" value="Send Message">
      <?php if(isset($success)){echo "<p style='color:green;text-align:center;'>".$success."</p>";}
            if(isset($error)){echo "<p style='color:red;text-align:center;'>".$error."</p>";}
      ?>
		</form>
  </div>
  
  <script type="text/javascript">
  
     $(document).ready(function(){
      $("#s_email").click(function(){
        $("#email").focusin();
        $("#email").focus();
      });
    });
    $(document).ready(function(){
      $("#s_message").click(function(){
        $("#message").focusin();
        $("#message").focus();
      });
    });
    $(document).ready(function(){
      $("#s_name").click(function(){
        $("#name").focusin();
        $("#name").focus();
      });
    });
  
    $(document).ready(function(){
      $("#name").focusin(function(){
        $("#s_name").addClass("move");
      });
        $("#name").focusout(function(){
          var val = $("#name").val();
          if(val == ''){
            $("#s_name").removeClass("move");
          }
      });
    });
    $(document).ready(function(){
      $("#email").focusin(function(){
        $("#s_email").addClass("move");
      });
        $("#email").focusout(function(){
          var val = $("#email").val();
          if(val == ''){
            $("#s_email").removeClass("move");
          }
      });
    });
    $(document).ready(function(){
      $("#message").focusin(function(){
        $("#s_message").addClass("move");
      });
        $("#message").focusout(function(){
          var val = $("#message").val();
          if(val == ''){
            $("#s_message").removeClass("move");
          }
      });
    });
  </script>
  <?php require '../footer.php'; ?>

</div>

</body>
</html>
