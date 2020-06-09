<?php

  require '../connect.php';
  session_start();
  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $id = $user['id'];
    if(isset($_POST['make'])&&isset($_POST['model'])&&isset($_POST['desc'])&&isset($_POST['price'])&&isset($_POST['year'])&&isset($_POST['state'])&&isset($_POST['fuel_type'])&&isset($_POST['gearbox'])&&isset($_POST['doors'])&&isset($_POST['mileage'])) {
      include '../val.php';
      $make = validate($_POST['make']);
      $model = validate($_POST['model']);
      $price = validate($_POST['price']);
      $year = validate($_POST['year']);
      $state = validate($_POST['state']);
      $fuel_type = validate($_POST['fuel_type']);
      $gearbox = validate($_POST['gearbox']);
      $doors = validate($_POST['doors']);
      $desc = validate($_POST['desc']);
      $date = validate(date("m/d/Y"));
      $images = $_FILES['images'];
      $thumb = $_FILES['thumb'];
      $mileage = validate($_POST['mileage']);
      if(!empty($make)&&!empty($model)&&!empty($desc)&&!empty($price)&&!empty($year)&&!empty($state)&&!empty($fuel_type)&&!empty($gearbox)&&!empty($doors)&&!empty($images)&&!empty($thumb)&&!empty($mileage)) {
        $namefile_t = $_FILES['thumb']['name'];
        $extension_t = strtolower(substr($namefile_t, strpos($namefile_t, '.') + 1));
        $ok = 1;
          if(($extension_t == 'jpg' || 'jpeg')&& $namefile_t == 'image/jpg') {
            echo '<script>alert("Thumbnail is  not a picture");</script>';
            $ok = 0;
          }
          $namefile_i = $_FILES['images']['name'];
          for($s=1; $s<count($namefile_i); $s++){
            $extension_i = strtolower(substr($namefile_i[$s], strpos($namefile_i[$s], '.') + 1));
            if(($extension_i == 'jpg' || 'jpeg')&& $_FILES['images']['name'][$s] == 'image/jpg') {
              echo '<script>alert("Images are not pictures");</script>';
              $ok = 0;
            }
          }
          if($ok == 1) {
            // FOR IMAGES
            $images_name = array();
            $images = array();
            $time = time();

            if(isset($_FILES['images'])){
              if(!is_dir("../uploads/images/".$id)){
                mkdir("../uploads/images/".$id);
              }
              if(!is_dir("../uploads/thumbs/".$id)){
                mkdir("../uploads/thumbs/".$id, 0777);
              }
              // THUMB
              $name_thumb = $_FILES['thumb']['name'];
        			$img_thumb = $_FILES['thumb']['tmp_name'];
        			$new_name_thumb = "../uploads/thumbs/".$id."/".$time.$name_thumb;
        			rename($img_thumb, $new_name_thumb);
        			$name_thumb = $time.$name_thumb;
              @move_uploaded_file($img_thumb, "../uploads/thumbs/".$id);
              chmod("../uploads/thumbs/".$id."/".$name_thumb, 0755);
              // IMAGES
              for($i=0; $i<count($_FILES['images']['name']); $i++){
                $name = $_FILES['images']['name'][$i];
                $img = $_FILES['images']['tmp_name'][$i];
                $new_name = "../uploads/images/".$id."/".$time.$name;
                rename($img, $new_name);
                $name = $time.$name;

                array_push($images_name, $name);
                array_push($images, $img);
              }
              $c = count($images);
              for($i=0; $i<$c; $i++){
                $dir = "../uploads/images/".$id;
                if(@move_uploaded_file($images[$i], $dir)){
                }
                chmod($dir."/".$images_name[$i], 0755);
              }
              $img_name = implode("|", $images_name);
            }

            $query = "INSERT INTO `cars` VALUES(DEFAULT,'$id','$make','$model','$price','$year','$mileage','$state','$fuel_type','$gearbox','$doors','$desc','$name_thumb','$img_name','$date')";
            echo $query;

            if(mysqli_query($conn, $query)){
              header("Location: ../profile/");
            } else {
              echo '<script>alert("ERROR");</script>';
            }
          }
      } else {
        echo '<script>alert("All fields must be filled in");</script>';
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
  <meta name="description" content="Sell your car on usedity.com. Car details needed: make, model, price, year, state, fuel type, gearbox, doors, mileage, description, and photos." />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="Sell used car, selling used car" />
  <meta charset="UTF-8" />

  <title>Usedity - Sell Used Car</title>

  <!--
  
    UU   UU   UUUU  UUUUUUU  UUUUUU    UU  UUUUUUUU  UU    UU
    UU   UU  UU     UU       UU    UU  UU     UU     UU    UU
    UU   UU  UU     UU       UU    UU  UU     UU     UU    UU
    UU   UU   UUU   UUUUUU   UU    UU  UU     UU       UUUUUU
    UU   UU     UU  UU       UU    UU  UU     UU           UU
    UU   UU     UU  UU       UU    UU  UU     UU     UU    UU
     UUUUU   UUUU   UUUUUU   UUUUUU    UU     UU      UUUUUU
  
  -->
  
  <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!--Icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script type="text/javascript" src="js/live.js"></script>

  <script type="text/javascript">
  $(document).ready(function () {
    $("#selectcar").change(function () {
        $("#modelcar").html("<option value='0'>Select</option>");
        $("#model").text("Model");
        var val = $(this).val();
        $("#make").text(val);
        if (val == "Audi") {
    $("#modelcar").html("<option value='0'>Select</option><option value='A1'>A1</option><option value='A2'>A2</option><option value='A3'>A3</option><option value='A4'>A4</option><option value='A5'>A5</option><option value='A6'>A6</option><option value='A7'>A7</option><option value='A8'>A8</option><option value='Q2'>Q2</option><option value='Q3'>Q3</option><option value='Q5'>Q5</option><option value='Q7'>Q7</option><option value='R8'>R8</option><option value='RS3'>RS3</option><option value='RS4'>RS4</option><option value='RS5'>RS5</option><option value='RS6'>RS6</option><option value='RS7'>RS7</option><option value='S3'>S3</option><option value='S4'>S4</option><option value='S5'>S5</option><option value='S6'>S6</option><option value='S7'>S7</option><option value='S8'>S8</option><option value='TT'>TT</option><option value='Other'>Other</option>");
}

else if (val == "Bentley") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Arange'>Arange</option><option value='Continental'>Continental</option><option value='Flying Spur'>Flying Spur</option><option value='Turbo R'>Turbo R</option>");
}

else if (val == "BMW") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Series 1'>Series 1</option><option value='Series 2'>Series 2</option><option value='Series 3'>Series 3</option><option value='Series 4'>Series 4</option><option value='Series 5'>Series 5</option><option value='Series 6'>Series 6</option><option value='Series 7'>Series 7</option><option value='Series 8'>Series 8</option><option value='M2'>M2</option><option value='M3'>M3</option><option value='M4'>M4</option><option value='M5'>M5</option><option value='M6'>M6</option><option value='X2'>X2</option><option value='X3'>X3</option><option value='X4'>X4</option><option value='X5'>X5</option><option value='X6'>X6</option><option value='Other'>Other</option>");
}

else if (val == "Bugatti") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Veyron'>Veyron</option><option value='Other'>Other</option>");
}

else if (val == "Chevrolet") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Camaro'>Camaro</option><option value='Corvete'>Corvete</option><option value='Orlando'>Orlando</option><option value='Spark'>Spark</option><option value='Other'>Other</option>");
}

else if (val == "Ferrari") {
    $("#modelcar").html("<option value='0'>Select</option><option value='360'>360</option><option value='458'>458</option><option value='488'>488</option><option value='599'>599</option><option value='California'>California</option><option value='F430'>F430</option><option value='Other'>Other</option>");
}

else if (val == "Fiat") {
    $("#modelcar").html("<option value='0'>Select</option><option value='500'>500</option><option value='500L'>500L</option><option value='500X'>500X</option><option value='Bravo'>Bravo</option><option value='Punto'>Punto</option><option value='Tipo'>Tipo</option><option value='Other'>Other</option>");
}

else if (val == "Ford") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Escort'>Escort</option><option value='Fiesta'>Fiesta</option><option value='Focus'>Focus</option><option value='Galaxy'>Galaxy</option><option value='Other'>Other</option>");
}

else if (val == "Jeep") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Compass'>Compass</option><option value='Grand Cherokee'>Grand Cherokee</option><option value='Renegade'>Renegade</option><option value='Other'>Other</option>");
}

else if (val == "Kia") {
    $("#modelcar").html("<option value='0'>Select</option><option value='PICANTO'>Picanto</option><option value='Rio'>Rio</option><option value='Sportage'>Sportage</option><option value='Other'>Other</option>");
}

else if (val == "Lamborghini") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Aventador'>Aventador</option><option value='Galardo'>Galardo</option><option value='Huracan'>Huracan</option><option value='Murcielago'>Murcielago</option><option value='Urus'>Urus</option><option value='Other'>Other</option>");
}

else if (val == "Mercedes-Benz") {
    $("#modelcar").html("<option value='0'>Select</option><option value='A Class'>A Class</option><option value='AMG'>AMG</option><option value='B Class'>B Class</option><option value='C Class'>C Class</option><option value='CL'>CL</option><option value='CLS'>CLS</option><option value='E Class'>E Class</option><option value='G Class'>G Class</option><option value='GLA Class'>GLA Class</option><option value='S Class'>S Class</option><option value='X Class'>X Class</option><option value='Other'>Other</option>");
}

else if (val == "Nissan") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Almera'>Almera</option><option value='Elgrand'>Elgrand</option><option value='GT-R'>GT-R</option><option value='Juke'>Juke</option><option value='Qashqai'>Qashqai</option><option value='X-Trail'>X-Trail</option><option value='Other'>Other</option>");
}

else if (val == "Opel") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Astra'>Astra</option><option value='Omega'>Omega</option><option value='Other'>Other</option>");
}

else if (val == "Peugeot") {
    $("#modelcar").html("<option value='0'>Select</option><option value='206'>206</option><option value='207'>207</option><option value='208'>208</option><option value='307'>307</option><option value='308'>307</option><option value='407'>407</option><option value='508'>508</option><option value='607'>607</option><option value='807'>807</option><option value='Other'>Other</option>");
}

else if (val == "Porsche") {
    $("#modelcar").html("<option value='0'>Select</option><option value='718'>718</option><option value='911'>911</option><option value='Boxter'>Boxter</option><option value='Carrera'>Carrera</option><option value='Cayenne'>Cayenne</option><option value='Cayman'>Cayman</option><option value='Macan'>Macan</option><option value='Panamera'>Panamera</option><option value='Other'>Other</option>");
}

else if (val == "Renault") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Clio'>Clio</option><option value='Megane'>Megane</option><option value='Scenic'>Scenic</option><option value='Twingo'>Twingo</option><option value='Zoe'>Zoe</option><option value='Other'>Other</option>");
}

else if (val == "Volkswagen") {
    $("#modelcar").html("<option value='0'>Select</option><option value='Golf 1'>Golf 1</option><option value='Golf 2'>Golf 2</option><option value='Golf 3'>Golf 3</option><option value='Golf 4'>Golf 4</option><option value='Golf 5'>Golf 5</option><option value='Golf 6'>Golf 6</option><option value='Golf 7'>Golf 7</option><option value='Golf 8'>Golf 8</option><option value='Jetta'>Jetta</option><option value='Passat'>Passat</option><option value='Tiguan'>Tiguan</option><option value='Tuareg'>Tuareg</option><option value='Touran'>Touran</option><option value='Other'>Other</option>");
}

else if (val == "Volvo") {
    $("#modelcar").html("<option value='0'>Select</option><option value='C30'>C30</option><option value='S40'>S40</option><option value='S50'>S50</option><option value='S60'>S60</option><option value='V40'>V40</option><option value='V50'>V50</option><option value='V60'>V60</option><option value='V70'>V90</option><option value='XC60'>XC60</option><option value='XC90'>XC90</option><option value='Other'>Other</option>");
}
        
        else if (val == "Alfa Romeo") {
            $("#modelcar").html("<option value='0'>Select</option><option value='164'>164</option><option value='4C'>4C</option><option value='8C'>8C</option><option value='Giuila'>Giuila</option><option value='Spider'>Spider</option><option value='Stelvio'>Stelvio</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Aston Martin") {
            $("#modelcar").html("<option value='0'>Select</option><option value='DB'>DB</option><option value='Rapide'>Rapide</option><option value='Vintage'>Vintage</option><option value='Vanquish'>Vanquish</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Chrysler") {
            $("#modelcar").html("<option value='0'>Select</option><option value='200'>200</option><option value='300'>300</option><option value='Aspen'>Aspen</option><option value='Cirrus'>Cirrus</option><option value='Paciffica'>Paciffica</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Dodge") {
            $("#modelcar").html("<option value='0'>Select</option><option value='Avenger'>Avenger</option><option value='Caravan'>Caravan</option><option value='D'>D</option><option value='Magnum'>Magnum</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Honda") {
            $("#modelcar").html("<option value='0'>Select</option><option value='Accord'>Accord</option><option value='Civic'>Civic</option><option value='CR'>CR</option><option value='Fit'>Fit</option><option value='HR'>HR</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Hyundai") {
            $("#modelcar").html("<option value='0'>Select</option><option value='Accent'>Accent</option><option value='Azera'>Azera</option><option value='Elantra'>Elantra</option><option value='Excel'>Excel</option><option value='Genesis'>Genesis</option><option value='Ioniq'>Ioniq</option><option value='Santa'>Santa</option><option value='Sonata'>Sonata</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Jaguar") {
            $("#modelcar").html("<option value='0'>Select</option><option value='E-Pace'>E-Pace</option><option value='F'>F</option><option value='I'>I</option><option value='S'>S</option><option value='Super V8'>Super V8</option><option value='X Types'>X Types</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Land Rover") {
            $("#modelcar").html("<option value='0'>Select</option><option value='Defender'>Defender</option><option value='Discovery'>Discovery</option><option value='Freelander'>Freelander</option><option value='LR'>LR</option><option value='Ranger Rover'>Ranger Rover</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Mazda") {
            $("#modelcar").html("<option value='0'>Select</option><option value='323'>323</option><option value='626'>626</option><option value='929'>929</option><option value='B Series'>B Series</option><option value='CX'>CX</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='Speed'>Speed</option><option value='MX'>MX</option><option value='RX'>RX</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Rolls-Royce") {
            $("#modelcar").html("<option value='0'>Select</option><option value='Dawn'>Dawn</option><option value='Ghost'>Ghost</option><option value='Phantom'>Phantom</option><option value='Silver'>Silver</option><option value='Wraith'>Wraith</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Telsa") {
            $("#modelcar").html("<option value='0'>Select</option><option value='Model 3'>Model 3</option><option value='Model S'>Model S</option><option value='Model X'>Model X</option><option value='Roadster'>Roadster</option><option value='Other'>Other</option>");
        }
        
        else if (val == "Toyota") {
            $("#modelcar").html("<option value='0'>Select</option><option value='Camry'>Camry</option><option value='Corolla'>Corolla</option><option value='Highlander'>Highlander</option><option value='Land Cruiser'>Land Cruiser</option><option value='Matrix'>Matrix</option><option value='Miral'>Miral</option><option value='Other'>Other</option>");
        }
    });
  });

  </script>

<body>

  <div class="full-page">

    <div class="header">
      <div class="logo">
        <a href="../index.php"><img src="../photos/logo/logo.png" alt="Logo"></a>
      </div>
      <div class="header-text">
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
        <button onclick="myFunction()" class="dropbtn">Profile &#9662;</button>
        <div id="myDropdown" class="dropdown-content">
          <a href="../profile">View profile</a>
          <a href="../profile/logout.php">Log out</a>
          <a href="../">Go back</a>
        </div>
      </div>
      </div>
      <div class="line"></div>
    </div>

    <h1>To sell your car, enter some information bellow:</h1>

    <div class="sell">

      <form action="index.php" method="post" enctype="multipart/form-data" id="form">

        <div class="input">
          <div>
            <p>Make</p>
            <select name="make" id="selectcar">

          <option value="0">Select</option>

          <option value="Alfa Romeo">Alfa Romeo</option>
          
          <option value="Aston Martin">Aston Martin</option>

          <option value="Audi">Audi</option>

          <option value="Bentley">Bentley</option>

          <option value="BMW">BMW</option>

          <option value="Bugatti">Bugatti</option>

          <option value="Chevrolet">Chevrolet</option>
          
          <option value="Chrysler">Chrysler</option>
          
          <option value="Dodge">Dodge</option>

          <option value="Ferrari">Ferrari</option>

          <option value="Fiat">Fiat</option>
          
          <option value="Ford">Ford</option>
          
          <option value="Honda">Honda</option>
          
          <option value="Hyundai">Hyundai</option>
          
          <option value="Jaguar">Jaguar</option>

          <option value="Jeep">Jeep</option>

          <option value="Kia">Kia</option>

          <option value="Lamborghini">Lamborghini</option>
          
          <option value="Land Rover">Land Rover</option>
          
          <option value="Mazda">Mazda</option>

          <option value="Mercedes-Benz">Mercedes-Benz</option>

          <option value="Nissan">Nissan</option>

          <option value="Opel">Opel</option>

          <option value="Peugeot">Peugeot</option>

          <option value="Porsche">Porsche</option>

          <option value="Renault">Renault</option>
          
          <option value="Rolls-Royce">Rolls-Royce</option>
          
          <option value="Telsa">Telsa</option>
          
          <option value="Toyota">Toyota</option>
          
          <option value="Volkswagen">Volkswagen</option>

          <option value="Volvo">Volvo</option>

            </select>
          </div>
        </div>

        <div class="input">
          <div>
            <p>Model</p>
            <select name="model" id="modelcar">
              <option value="0">Select</option>
            </select>
          </div>
        </div>

        <div class="input">
          <div>
            <p>Price</p>
              <input type="number" name="price" placeholder="Enter price ($)" id="price_s" value="<?php if(isset($_POST['price'])){ echo $_POST['price']; } ?>">
          </div>
        </div>

        <div class="input">
          <div>
            <p>Year</p>
            <select name="year" id="year_s">
              <option value="0">Select</option>
              <option value="2018">2018</option>
              <option value="2017">2017</option>
              <option value="2016">2016</option>
              <option value="2015">2015</option>
              <option value="2014">2014</option>
              <option value="2013">2013</option>
              <option value="2012">2012</option>
              <option value="2011">2011</option>
              <option value="2010">2010</option>
              <option value="2009">2009</option>
              <option value="2008">2008</option>
              <option value="2007">2007</option>
              <option value="2006">2006</option>
              <option value="2005">2005</option>
              <option value="2004">2004</option>
              <option value="2003">2003</option>
              <option value="2002">2002</option>
              <option value="2001">2001</option>
              <option value="2000">2000</option>
              <option value="1999">1999</option>
              <option value="1998">1998</option>
              <option value="1997">1997</option>
              <option value="1996">1996</option>
            </select>
          </div>
        </div>

        <div class="input">
          <div>
            <p>State</p>
            <select name="state" id="state_s">
              <option value="0">Select</option>
              <option value="Alabama">Alabama</option>
            	<option value="Alaska">Alaska</option>
            	<option value="Arizona">Arizona</option>
            	<option value="Arkansas">Arkansas</option>
            	<option value="California">California</option>
            	<option value="Colorado">Colorado</option>
            	<option value="Connecticut">Connecticut</option>
            	<option value="Delaware">Delaware</option>
            	<option value="District Of Columbia">District Of Columbia</option>
            	<option value="Florida">Florida</option>
            	<option value="Georgia">Georgia</option>
            	<option value="Hawaii">Hawaii</option>
            	<option value="Idaho">Idaho</option>
            	<option value="Illinois">Illinois</option>
            	<option value="Indiana">Indiana</option>
            	<option value="Iowa">Iowa</option>
            	<option value="Kansas">Kansas</option>
            	<option value="Kentucky">Kentucky</option>
            	<option value="Louisiana">Louisiana</option>
            	<option value="Maine">Maine</option>
            	<option value="Maryland">Maryland</option>
            	<option value="Massachusetts">Massachusetts</option>
            	<option value="Michigan">Michigan</option>
            	<option value="Minnesota">Minnesota</option>
            	<option value="Mississippi">Mississippi</option>
            	<option value="Missouri">Missouri</option>
            	<option value="Montana">Montana</option>
            	<option value="Nebraska">Nebraska</option>
            	<option value="Nevada">Nevada</option>
            	<option value="New Hampshire">New Hampshire</option>
            	<option value="New Jersey">New Jersey</option>
            	<option value="New Mexico">New Mexico</option>
            	<option value="New York">New York</option>
            	<option value="North Carolina">North Carolina</option>
            	<option value="North Dakota">North Dakota</option>
            	<option value="Ohio">Ohio</option>
            	<option value="Oklahoma">Oklahoma</option>
            	<option value="Oregon">Oregon</option>
            	<option value="Pennsylvania">Pennsylvania</option>
            	<option value="Rhode Island">Rhode Island</option>
            	<option value="South Carolina">South Carolina</option>
            	<option value="South Dakota">South Dakota</option>
            	<option value="Tennessee">Tennessee</option>
            	<option value="Texas">Texas</option>
            	<option value="Utah">Utah</option>
            	<option value="Vermont">Vermont</option>
            	<option value="Virginia">Virginia</option>
            	<option value="Washington">Washington</option>
            	<option value="West Virginia">West Virginia</option>
            	<option value="Wisconsin">Wisconsin</option>
            	<option value="Wyoming">Wyoming</option>
            </select>
          </div>
        </div>

        <div class="input">
          <div>
            <p id="f">Fuel type</p>
            <select name="fuel_type" id="fuel_s">
              <option value="0">Select</option>
              <option value="diesel">Diesel</option>
              <option value="electric">Electric</option>
              <option value="hybrid">Hybrid</option>
              <option value="petrol">Petrol</option>
            </select>
          </div>
        </div>

        <div class="input">
          <div>
            <p>Gearbox</p>
            <select name="gearbox" id="gearbox_s">
              <option value="0">Select</option>
              <option value="manual">Manual</option>
              <option value="automatic">Automatic</option>
              <option value="semi-automatic">Semi-automatic</option>
            </select>
          </div>
        </div>

        <div class="input">
          <div>
            <p id="drs">Doors <i class="fa fa-info-circle tooltip"><span class="tooltiptext">Trunk counts as the door too</span></i></p>
            <select name="doors" id="doors_s">
              <option value="0">Select</option>
              <option value="3">3</option>
              <option value="5">5</option>
            </select>
          </div>
        </div>
        <div class="input">
          <div>
            <p>Mileage</p>
              <input type="number" id="mileage_s" name="mileage" placeholder="Enter mileage" value="<?php if(isset($_POST['mileage'])){ echo $_POST['mileage']; } ?>">
          </div>
        </div>
        <div class="input last">
          <div>
            <p>Short description of car | <span style="font-size:.7em;">50 char. max</span></p>
            <input type="text" name="desc" value="<?php if(isset($_POST['desc'])) { echo $_POST['desc']; } ?>" maxlength="50" placeholder="Ex. 2.0 TDI, 150 HP ..." id="desc_s">
          </div>
        </div><br><br>
        <p style="text-align:center;">Live preview:</p>
        <div class="live">
          <script src="js/upload.js"></script>
          <div class="image">
            <input type="file" id="thumb" accept='.jpg, .jpeg, .png' id='images_upl' name="thumb" onchange="upload();">
            <label for="thumb" class="label">Upload image</label>
            <div class="img-preview">
              <span id="close">&times;</span>
            </div>
          </div>
          <script>
            $(document).ready(function(){
              $("#close").click(function(){
                $(".image").empty();
                $('.image').html("<input type='file' id='thumb' accept='.jpg, .jpeg, .png' multiple id='images_upl' name='thumb' onchange='upload();'><label for='thumb' class='label' style='display:block;'>Upload image</label><div class='img-preview' style='display:none;'><span id='close'>&times;</span></div>");
              });
            });
          </script>
          <div class="details">
            <div class="title">
              <p><span id="make">Make</span> <span id="model">Model</span> | <span id="year">Year</span><span id="date" style="float:right; font-size:.6em;"><?php echo date("m/d/Y"); ?></span> </p>
            </div>
            <div class="desc">
              <p><span id="desc">Description</span></p>
            </div>
            <div class="price">
              <p>$<span id="price"></span></p>
            </div>
            <div class="more-info">
              <p>Fuel type: <span id="fuel"></span></p>
              <p>Mileage: <span id="mileage"></span></p>
              <p id="door">Doors: <span id="doors"></span><span id="state" style="float:right;" class="tooltip">State<span class="tooltiptext" id="tip">State</span></span></p>
            </div>
          </div>
        </div><br>
        <div class="images">
          <input type="file" name="images[]" accept='.jpg, .jpeg, .png' multiple id='images_upl' multiple id="images_upl" onchange="img();">
          <label for="images_upl" class="label2">Upload more images</label>
          <p id="photos-max">Max 12 photos<span id="close_btn">&times;</span></p>
          <div id="imgs">

          </div>
        </div>
        <script>
          $(document).ready(function(){
            $("#close_btn").click(function(){
              $(".images").empty();
              $('.images').html("<input type='file' name='images' accept='.jpg, .jpeg, .png' multiple id='images_upl' onchange='img();'><label for='images_upl' class='label2'>Upload more images</label><p id='photos-max'>Max 12 photos<span id='close_btn'>&times;</span></p><div id='imgs'></div>");
            });
          });

          $(document).ready(function(){
            $("#submit_btn").hover(function(){
              var btn = $("#submit_btn");
              var p = $("#empty");
              var img_upl = $("#images_upl").val();
              var thumb = $("#thumb").val();
              var selectcar = $("#selectcar").val();
              var modelcar = $("#modelcar").val();
              var year = $("#year_s").val();
              var price = $("#price_s").val();
              var state = $("#state_s").val();
              var fuel = $("#fuel_s").val();
              var gearbox = $("#gearbox_s").val();
              var doors = $("#doors_s").val();
              var desc = $("#desc_s").val();
              var mileage = $("#mileage_s").val();
              var ok = 0;
              if(img_upl){
                $(".label2").removeClass("red");
              } else {
                  ok++;
                  $(".label2").addClass("red");
              } if(thumb){
                $(".label").removeClass("red");
              } else {
                  ok++;
                  $(".label").addClass("red");
              } if(selectcar !== "0"){
                $("#selectcar").removeClass("red");
              } else {
                  ok++;
                  $("#selectcar").addClass("red");
              } if(modelcar !== "0"){
                $("#modelcar").removeClass("red");
              } else {
                  ok++;
                  $("#modelcar").addClass("red");
              } if(year !== "0"){
                $("#year_s").removeClass("red");
              } else {
                  ok++;
                  $("#year_s").addClass("red");
              } if(price !== ""){
                $("#price_s").removeClass("red");
              } else {
                  ok++;
                  $("#price_s").addClass("red");
              } if(state !== "0"){
                $("#state_s").removeClass("red");
              } else {
                  ok++;
                  $("#state_s").addClass("red");
              } if(fuel !== "0"){
                $("#fuel_s").removeClass("red");
              } else {
                  ok++;
                  $("#fuel_s").addClass("red");
              } if(gearbox !== "0"){
                $("#gearbox_s").removeClass("red");
              } else {
                  ok++;
                  $("#gearbox_s").addClass("red");
              } if(doors !== "0"){
                $("#doors_s").removeClass("red");
              } else {
                  ok++;
                  $("#doors_s").addClass("red");
              } if(desc !== ""){
                $("#desc_s").removeClass("red");
              } else {
                  ok++;
                  $("#desc_s").addClass("red");
              }
              if(mileage){
                $("#mileage_s").removeClass("red");
              } else {
                  ok++;
                  $("#mileage_s").addClass("red");
              }
               if(ok > 0) {
                p.css("display","block");
                p.text("Fill in " + ok + " more fields!");
                btn.css("cursor", "not-allowed");
              } else if(ok == 0) {
                btn.css("cursor", "pointer");
                p.empty();
              }
            });
          });
        </script>
        <input type="submit" value="Sell car" id="submit_btn" name="submit" onclick="loading()">
        <p id="empty" style="display:none;color:#D14D4D;"></p>
      </form>
    </div>
    <script>
        function loading() {
            document.getElementById("submit_btn").value = "Loading...";
        }
    </script>
    <?php require '../footer.php'; ?>

  </div>
</body>
</html>
<?php } else {
  header("Location: ../");
} ?>
