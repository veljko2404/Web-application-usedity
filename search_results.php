<?php

  session_start();
  require 'connect.php';

  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
  }

  if(isset($_GET['make'])||isset($_GET['model'])||isset($_GET['min_price'])||isset($_GET['max_price'])||isset($_GET['year_from'])||isset($_GET['year_to'])||isset($_GET['mileage_from'])||isset($_GET['mileage_to'])||isset($_GET['state'])||isset($_GET['fuel_type'])||isset($_GET['gearbox'])||isset($_GET['doors'])){
    function validate($data) {
      $data = addslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $arr = array();
    $arr = $arr + array('make' => validate($_GET['make']));
    $arr = $arr + array('model' => validate($_GET['model']));
    $arr = $arr + array('min_price' => validate($_GET['min_price']));
    $arr = $arr + array('max_price' => validate($_GET['max_price']));
    $arr = $arr + array('year_from' => validate($_GET['year_from']));
    $arr = $arr + array('year_to' => validate($_GET['year_to']));
    $arr = $arr + array('mileage_from' => validate($_GET['mileage_from']));
    $arr = $arr + array('mileage_to' => validate($_GET['mileage_to']));
    $arr = $arr + array('state' => validate($_GET['state']));
    $arr = $arr + array('fuel_type' => validate($_GET['fuel_type']));
    $arr = $arr + array('gearbox' => validate($_GET['gearbox']));
    $arr = $arr + array('doors' => validate($_GET['doors']));
    $data_arr = array();
    foreach($arr as $keys => $values) {
      if($values !== "All" && $values !== "ALL") {
        $data_arr = $data_arr + array($keys => $values);
      }
    }

    // MAKE QUERY

    $query = "SELECT * FROM `cars` WHERE ";

    foreach($data_arr as $name => $val){

      if(!isset($query_search)){
        if($name == 'min_price'||$name == 'year_from'||$name == 'mileage_from') {
          $query_search = '';
          $query_search = $query_search.$name." > ".$val;
        } elseif($name == 'max_price'||$name == 'year_to'||$name == 'mileage_to') {
          $query_search = '';
          $query_search = $query_search.$name." < ".$val;
        } else {
          $query_search = '';
          $query_search = $query_search.$name." = '$val'";
        }
      } else {
        if($name == 'min_price'||$name == 'year_from'||$name == 'mileage_from') {
          $query_value = " && ".$name.">".$val;
          $query_search = $query_search.$query_value;
        } elseif($name == 'max_price'||$name == 'year_to'||$name == 'mileage_to') {
          $query_value = " && ".$name."<".$val;
          $query_search = $query_search.$query_value;
        } else {
          $query_value = " && ".$name."='$val'";
          $query_search = $query_search.$query_value;
        }
      }
    }
    $query_search = ' '.$query_search;
    // MAKIING price_min to price, etc.
  if($len = strpos($query_search, 'min_price')){
    $query_search = substr_replace($query_search, "price", $len, 9);
  }
  if($len = strpos($query_search, 'max_price')){
    $query_search = substr_replace($query_search, "price", $len, 9);
  }
  if($len = strpos($query_search, 'year_from')){
    $query_search = substr_replace($query_search, "year", $len, 9);
  }
  if($len = strpos($query_search, 'year_to')){
    $query_search = substr_replace($query_search, "year", $len, 7);
  }
  if($len = strpos($query_search, 'mileage_from')){
    $query_search = substr_replace($query_search, "mileage", $len, 12);
  }
  if($len = strpos($query_search, 'mileage_to')){
    $query_search = substr_replace($query_search, "mileage", $len, 10);
  }

    $query = $query.$query_search;

    @$query_run = mysqli_query($conn, $query);

    @$num_rows = mysqli_num_rows($query_run);
    if($num_rows>9){

      @$query_run = mysqli_query($conn, $query." LIMIT 10");

    }

  } else {
    echo "<script>alert('No results')</script>";
    header("Location: index.php");
  }

?>
<!DOCTYPE html>
<html lang="en-US">
<head>

  <link rel="stylesheet" href="css/search.css" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="icon" sizes="50x50" href="photos/logo/logo50x50.png">
  <link rel="apple-touch-icon" href="photos/logo/logo200x200.png">
  <meta name="apple-mobile-web-app-title" content="Usedity">
  <meta name="description" content="With Usedity search engine you can search for car by: make, model, price, year, mileage, gearbox, number of doors, fuel type, and state" />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="search results, search engine, car reseach, Used cars, buying used car, selling used car" />
  <meta charset="UTF-8" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Search results (<?php echo $num_rows; ?>) - Usedity</title>
  
  <!--
  
    UU   UU   UUUU  UUUUUUU  UUUUUU    UU  UUUUUUUU  UU    UU
    UU   UU  UU     UU       UU    UU  UU     UU     UU    UU
    UU   UU  UU     UU       UU    UU  UU     UU     UU    UU
    UU   UU   UUU   UUUUUU   UU    UU  UU     UU       UUUUUU
    UU   UU     UU  UU       UU    UU  UU     UU           UU
    UU   UU     UU  UU       UU    UU  UU     UU     UU    UU
     UUUUU   UUUU   UUUUUU   UUUUUU    UU     UU      UUUUUU
  
  -->

<body>

  <div class="full-page">

    <div class="header">
      <div class="logo">
        <a href="index.php"><img src="photos/logo/logo.png" alt="Logo"></a>
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
          <a href="profile">View profile</a>
          <a href="profile/logout.php">Log out</a>
          <a href="index.php">Go back</a>
        </div>
      </div>
      <?php } else { ?>
        <p>Do you want to sell a car ? <a href="login/">Login first</a>.</p>
        <?php } ?>
      </div>
      <div class="line"></div>
    </div>

    <div class="search">
      <h3>Results found: <?php echo $num_rows; ?></h3>
      <?php while ($info = mysqli_fetch_assoc($query_run)) { $id_car = $info['id_car']; ?>
      <a href="<?php echo "cars/?car_id=".$info['id_car']; ?>">
        <div class="live">
          <div class="image">
            <img src="<?php echo "uploads/thumbs/".$info['id_user']."/".$info['thumb']; ?>" alt="">
          </div>
          <div class="details">
            <div class="title">
              <p class="hover"><span id="make"><?php echo $info['make']." "; ?></span><span id="model"><?php echo $info['model']." | "; ?></span>  <span id="year"><?php echo $info['year']; ?></span><span id="date" style="float:right; font-size:.6em;"><?php echo $info['date']; ?></span> </p>
            </div>
            <div class="desc">
              <p><span id="desc"><?php echo $info['desc']; ?></span><i class="fa fa-warning tooltip" data-id="<?php echo $info["id_car"]; ?>" id="report<?php echo $info["id_car"]; ?>" style="font-size:24px"><span class="tooltiptext">Report car</span></i></p>
            </div>
            <div class="price">
              <p>$<span id="price"><?php echo $info['price']; ?></span></p>
            </div>
            <div class="more-info">
              <p>Fuel type:<span id="fuel"><?php echo $info['fuel_type']; ?></span></p>
              <p>Mileage:<span id="mileage"><?php echo $info['mileage']; ?></span></p>
              <p id="door">Doors:<span id="doors"><?php echo $info['doors']; ?></span><span id="state" class="tooltip" style="float:right;">State<span class="tooltiptext" id="tip"><?php echo $info['state'] ?></span></span></p>            
            </div>
          </div>
        </div>
      </a>
      <script>
        $(document).ready(function(){
          $("#report<?php echo $info["id_car"]; ?>").click(function(event){
               event.preventDefault();
               $(".modal").css("display","block");
               var car_id = $(this).data("id");
               $("#hidden").val(car_id);
          });
        });
      </script>
    <?php } if($num_rows>10){
      ?><button id="btn" data-id="<?php echo $id_car; ?>">Load more</button>
      <script>
        $(document).ready(function(){
          $(document).on('click', '#btn', function(){
            var last_id = $("#btn").data("id") + "<?php echo " && ".$query_search; ?>";
            $("#btn").html("Loading...");
            $.ajax({
              url:"load_data.php",
              method:"POST",
              data:{last_id:last_id},
              dataType:"text",
              success:function(data){
                if(data != '') {
                  $("#btn").remove();
                  $(".search").append(data);
                } else {
                  $("#btn").remove();
                }
              }
            });
          });
        });
      </script>
      <?php
    }?>
    </div>
    <script>
        $(document).ready(function(){
           $("#reportBtn").click(function(){
              var car_id = $("#hidden").val();
              var text = $("#textInput").val();
              $("#reportBtn").html("Loading...");
              $.ajax({
                  url:"report.php",
                  method:"POST",
                  data:{car_id:car_id, text:text},
                  dataType:"text",
                  success:function(info){
                      if(info !== ""){
                          $("#reportBtn").html("Sent!");
                      } else {
                          $("#reportBtn").html("Failed");
                      }
                  }
              });
           });
           $(".close").click(function(){
               $(".modal").css("display","none");
           });
        });
    </script>
    
 <div class="modal" id="myModal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Report this car</h2>
    </div>
    <div class="modal-body">
      <p>Why do you want to report this car?</p>
      <input type="text" placeholder="Write here..." id="textInput" maxlength="100">
      <input type="hidden" value="" id="hidden">
      <button id="reportBtn">Send</button>
    </div>
    <div class="modal-footer">
      <h3>Thank you for helping us!</h3>
    </div>
  </div>
 </div>

  <?php require 'footer.php'; ?>

  </div>
</body>
</html>
