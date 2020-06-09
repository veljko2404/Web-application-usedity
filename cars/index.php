<?php

  require '../connect.php';
  session_start();

  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $id = $user['id'];
  }
  
  $car_id = $_GET['car_id'];
  $query = "SELECT * FROM `cars` WHERE `id_car`=".$car_id;
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run)>0){
  $info = mysqli_fetch_assoc($query_run);
  $images = explode("|", $info['images']);

  if(isset($_POST['email'])&&isset($_POST['message'])) {
    $email = $_POST['email'];
    $message = $_POST['message'];
    if(!empty($email)&&!empty($message)) {
      if(strlen($message)<100){
        $query_person = "SELECT `email` FROM `users` WHERE id=".$info['id_user'];
        $query_person_run = mysqli_query($conn, $query_person);
        $row = mysqli_fetch_assoc($query_person_run);
        $email_to = $row['email'];
        $subject = "Usedity.com - Someone might be interested in buying car!";
        $body = "
        Sent by: ".$email."
        
        Message: ".$message
        ;
        $headers = "from: notification@usedity.com";
        
        $id_message_to = $info['id_user'];
        $query_message = "INSERT INTO `messages` VALUES(DEFAULT,'$id_message_to','$email','$message')";
        
        if(mail($email_to, $subject, $body, $headers)){
          $note = "Message has successfully sent";
          mysqli_query($conn, $query_message);
        } else {
          $note = "Problem occured while sending email";
        }
      } else {
        echo "<script>alert('Message must be under 100 characters !');</script>";
      }
    } else {
      echo "<script>alert('Both fields must be filled in !');</script>";
    }
  }

?>
<!DOCTYPE html>
<html lang="en-US">
<head>

  <link rel="stylesheet" href="../css/global.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" sizes="50x50" href="../photos/logo/logo50x50.png">
  <link rel="apple-touch-icon" href="../photos/logo/logo200x200.png">
  <meta name="apple-mobile-web-app-title" content="Usedity">
  <meta name="description" content="Usedity - buy car: <?php echo $info['make']." ".$info['model']." $".number_format($info['price']).", year:".$info['year'].", ".$info['mileage']." miles "; ?>" />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content= "used car usa, buy used car usa, usa, <?php echo $info['make']." ".$info['model']." $".number_format($info['price']).", year:".$info['year'].", ".$info['mileage']." miles "; ?>" />
  <meta charset="UTF-8" />

  <title>Usedity - <?php echo $info['make']." ".$info['model']." $".number_format($info['price']); ?></title>
  
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
  .column_slide {
    float: left;
    width: <?php $pic = count($images)+1;
    if($pic==0){echo 0;} else { echo 100 / $pic; } ?>%;
    padding: 0 5px;
  }
  @media only screen and (max-width:600px){
    .column_slide {width:<?php if($pic==7||8){echo 25;} else if($pic==9||10){echo 20;}else if($pic==11||12){echo 16.666;}?>% !important;
    padding-top:2px !important;
    }
  }
  </style>
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

  <div class="row">
    <h3>Photos (<?php echo count($images)+1; ?>)</h3>
  <div class="column">
    <img src="<?php echo "../uploads/thumbs/".$info['id_user']."/".$info['thumb']; ?>" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
  </div>
  <?php if(count($images)<4){$num = count($images);} else {
    $num = 3;
  } ?>
  <?php for($i=0;$i<$num;$i++) { ?>
  <div class="column">
    <img src="<?php echo "../uploads/images/".$info['id_user']."/".$images[$i]; ?>" onclick="openModal();currentSlide(<?php echo $i+2; ?>)" class="hover-shadow cursor">
  </div>
  <?php } ?>
</div>

<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">
    <div class="mySlides">
      <div class="numbertext" style="text-shadow: 2px 2px 4px #000000;">1 / <?php echo count($images)+1; ?></div>
      <img src="<?php echo "../uploads/thumbs/".$info['id_user']."/".$info['thumb']; ?>" style="width:100%">
      <img src="logo.png" class="logo_png">
    </div>
    <?php for($i=0;$i<count($images);$i++) {
      $source = "../uploads/images/".$info['id_user']."/".$images[$i];

    ?>
    <div class="mySlides">
      <div class="numbertext" style="text-shadow: 2px 2px 4px #000000;"><?php echo $i+2; ?> / <?php echo count($images)+1; ?></div>
      <img src="<?php echo $source; ?>" style="width:100%">
      <img src="logo.png" class="logo_png">
    </div>
  <?php } ?>

    <a class="prev" style="color:#2d9940 !important;" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" style="color:#2d9940 !important;" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>

    <div class="column_slide">
      <img class="demo cursor" src="<?php echo "../uploads/thumbs/".$info['id_user']."/".$info['thumb']; ?>" style="width:100%" onclick="currentSlide(1)" alt="<?php echo $info['make']." ".$info['model']; ?>">
    </div>
    <?php for($i=0;$i<count($images);$i++) { ?>
    <div class="column_slide">
      <img class="demo cursor" src="<?php echo "../uploads/images/".$info['id_user']."/".$images[$i]; ?>" style="width:100%" onclick="currentSlide(<?php echo $i+2; ?>)" alt="<?php echo $info['make']." ".$info['model']; ?>">
    </div>
  <?php } ?>
  </div>
</div>
<div class="line line2" style="margin-top:-30px;" media="max-device-height"></div>
<div class="about">
  <div class="car">
    <img src="icons/car.png" alt="car">
    <h3><?php echo $info['make']." ".$info['model']; ?></h3>
  </div>
  <div class="price">
    <img src="icons/price.png" alt="price">
    <h3><?php echo "$".number_format($info['price']); ?></h3>
  </div>
  <div class="mileage">
    <img src="icons/mileage.png" alt="mileage">
    <h3><?php echo $info['mileage']." miles"; ?></h3>
  </div>
  <div class="gearbox">
    <img src="icons/gearbox.png" alt="gearbox">
    <h3><?php echo ucfirst($info['gearbox']); ?></h3>
  </div>
  <div class="fuel">
    <img src="icons/fuel.png" alt="fuel">
    <h3><?php echo ucfirst($info['fuel_type']); ?></h3>
  </div>
  <div class="door">
    <img src="icons/door.png" alt="door">
    <h3><?php echo $info['doors']." doors"; ?></h3>
  </div>
  <div class="state">
    <img src="icons/state.png" alt="state">
    <h3><?php echo $info['state']; ?></h3>
  </div>
  <div class="time">
    <img src="icons/time.png" alt="time">
    <h3><?php echo $info['date']; ?></h3>
  </div>
  <div class="desc">
    <img src="icons/desc.png" alt="door">
    <h3><?php echo $info['desc']; ?></h3>
  </div>
</div>
<div class="contact">
  <form action="<?php echo $_SERVER['SCRIPT_NAME']."?car_id=".$info['id_car']; ?>" method="post">
    <h3>Send message to the seller</h3>
    <input type="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" placeholder="Enter your email..."><br>
    <input type="text" name="message" maxlength="100" value="<?php if(isset($_POST['message'])){echo $_POST['message'];} ?>" placeholder="Enter your message"></textarea><br>
    <input type="submit" id="submit" value="Send">
    <?php if(isset($note)){echo "<p>".$note."</p>";} ?>
  </form>
</div>
<script>

function openModal() {
  document.getElementById('myModal').style.display = "block";
  document.getElementById('drpdwn').style.display = "none";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
  document.getElementById('drpdwn').style.display = "block";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

    <?php require '../footer.php'; ?>

</div>

</body>
</html>
<?php } else {
  ?>
  
  <!DOCTYPE html>
<html lang="en-US">
<head>

  <link rel="stylesheet" href="../css/global.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" sizes="50x50" href="../photos/logo/logo50x50.png">
  <link rel="apple-touch-icon" href="../photos/logo/logo200x200.png">
  <meta name="apple-mobile-web-app-title" content="Usedity">
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta charset="UTF-8" />

  <title>Usedity - car not found</title>
  
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

    <div class="row">
        <h2 style="text-align:center;margin-top:100px">Car not found, go <a href="../">back</a>.</h2>
    </div>

    <?php require '../footer.php'; ?>

</div>

</body>
</html>
  
  <?php
}
