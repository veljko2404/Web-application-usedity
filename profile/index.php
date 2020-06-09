<?php

  require '../connect.php';
  
  session_start();
  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $id = $user['id'];

    $query_id = "SELECT `id_car` FROM `cars` WHERE `id_user`=".$id;
    $query_run_id = mysqli_query($conn, $query_id);
    if(mysqli_num_rows($query_run_id)>0){
      $num = mysqli_num_rows($query_run_id);
      $footer = $num * 250;
    } else {
      $footer = 120;
    }
    
    $query_messages = "SELECT * FROM `messages` WHERE `id_user`=".$id;
    $query_messgaes_run = mysqli_query($conn, $query_messages);
    if(mysqli_num_rows($query_messgaes_run)>0){
      $messages_num = mysqli_num_rows($query_messgaes_run);
      $messages = mysqli_fetch_assoc($query_messgaes_run); 
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
  <meta name="description" content="Login to your profile to see or change your information, or to delete a car you've post." />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="usedity profile, change porifle usedity, profile edit, profile information" />
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    @media only screen and (max-width:768px) {
      .footer{
        margin-top:<?php echo $footer; ?>px !important;
      }
    }
  </style>
  <title>Usedity - <?php echo $user['name']; ?></title>
  
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

  <div class="full-page">

    <div class="header">
      <div class="logo">
        <a href="../index.php"><img src="../photos/logo/logo.png" alt="Logo"></a>
      </div>
      <div class="header-text">
        <p>Do you want to sell a car ? <a href="../sell_car">Click here</a>.</p>
      </div>
      <div class="line"></div>
    </div>

    <div class="profile">
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
        <button onclick="myFunction()" class="dropbtn">Your Profile &#9662;</button>
        <div id="myDropdown" class="dropdown-content">
          <a href="logout.php">Log out</a>
          <a href="edit-profile.php">Edit profile <span class="pen-image"><img src="../photos/pen.png" width="20px" alt=""></span></a>
          <a href="messages.php">Messages <?php if(isset($messages_num)){echo "<span class='badge'>".$messages_num."</span>";} ?></a>
          <a href="../how_it_works">How it works</a>
          <a href="../sell_car">Sell a car</a>
          <a href="../">Go to main page</a>
        </div>
      </div>

      <div class="profile-info">
          <h2>Name: <span><?php echo $user['name']; ?></span></h2>
          <h2>Email: <span><?php echo $user['email']; ?></span></h2>
      </div>
      <?php
        if(mysqli_num_rows($query_run_id)>0){
          $ids = array();
          while($row = mysqli_fetch_assoc($query_run_id)){
            $ids_car = $row['id_car'];
            array_push($ids, $ids_car);
          }
          $array_info = array();
            if(count($ids)>0){
              for($i=0; $i<count($ids); $i++){
                $query = "SELECT * FROM `cars` WHERE `id_car`=".$ids[$i];
                $query_run = mysqli_query($conn, $query);
                $info = mysqli_fetch_assoc($query_run);
                ?>
                <a href="<?php echo "../cars/?car_id=".$info['id_car']; ?>" id="<?php echo $info["id_car"]; ?>">
                  <div class="live">
                    <div class="image">
                      <img src="<?php echo "../uploads/thumbs/".$id."/".$info['thumb']; ?>" alt="">
                    </div>
                    <div class="details">
                      <div class="title">
                        <p class="hover"><span id="make"><?php echo $info['make']." "; ?></span><span id="model"><?php echo $info['model']." | "; ?></span>  <span id="year"><?php echo $info['year']; ?></span><span id="date" style="float:right; font-size:.6em;"><?php echo $info['date']; ?></span> </p>
                      </div>
                      <div class="desc">
                        <p><span id="desc"><?php echo $info['desc']; ?></span><i class="fa fa-trash-o tooltip" data-id-user="<?php echo $info["id_user"]; ?>" data-id="<?php echo $info["id_car"]; ?>" id="del" style="font-size:24px"><span class="tooltiptext">Delete car</span></i></p>
                      </div>
                      <div class="price">
                        <p>$<span id="price"><?php echo $info['price']; ?></span></p>
                      </div>
                      <div class="more-info">
                        <p>Fuel type:<span id="fuel"><?php echo $info['fuel_type']; ?></span></p>
                        <p>Mileage:<span id="mileage"><?php echo $info['mileage']; ?></span></p>
                        <p id="door">Doors:<span id="doors"><?php echo $info['doors']; ?></span><span id="state" style="float:right;" class="tooltip">State<span class="tooltiptext" id="tip"><?php echo $info['state']; ?></span></span></p>
                      </div>
                    </div>
                  </div>
                </a>
                <?php
              }
            }
        } else {
          ?>
            <div width="100%">
              <h3 class="posts">You haven't posted any car yet.</h3>
            </div>
          <?php
        }
      ?>
      <script>
        $(document).ready(function(){
          $(document).on('click', '#del', function(event){
            event.preventDefault();
            var id_car = $(this).data("id");
            var make = $("#make").text();
            var id_user = $(this).data("id-user");;
            $.ajax({
              url:"delete.php",
              method:"POST",
              data:{id_car:id_car, id_user:id_user},
              dataType:"text",
              success:function(data){
                if(data != '') {
                  $("#" + id_car).remove();
                  alert("You've successfuly deleted " + make);
                } else {
                  alert("Something went wrong");
                }
              }
            });
          });
        });
      </script>
    </div>

    <?php require '../footer.php'; ?>

  </div>

</body>
</html>
<?php } else {
  header("Location: ../login");
} ?>
