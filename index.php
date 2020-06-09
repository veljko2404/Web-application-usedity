<?php

  require 'connect.php';
  session_start();
  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
  }

?>
<!DOCTYPE html>
<html lang="en-US">
<head>

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="icon" sizes="50x50" href="photos/logo/logo50x50.png">
  <link rel="apple-touch-icon" href="photos/logo/logo200x200.png">
  <meta name="apple-mobile-web-app-title" content="Usedity">
  <meta name="description" content="Search for used cars by price, year, mileage, all states, fuel type, gearbox, doors, model. Also, you can sell your used car for FREE! When selling the car you can see a live preview of your post." />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="Usedity, sell car usa, buy car usa, Used cars usa, buying used car usa, selling used car usa, application for used car usa" />
  <meta charset="UTF-8" />

  <title>Usedity - Application for Selling or Buying Used Car in USA</title>
  
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

  <!--ICONS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script type="text/javascript">
    function findmatch(e) {
      document.getElementById('reset').style.display = "block";
      document.getElementById('search_btn').disabled = false;
      document.getElementById('search_btn').value= "Loading...";
      var name = e.name;
      var val = e.value;
      if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
      }
      xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById('search_btn').value = "Search " + xmlhttp.responseText;
        }
      }
      xmlhttp.open('GET', "search.php?" + name + "=" + val, true);
      xmlhttp.send();
    }
    </script>
  <script>
	$(document).ready(function () {
    $("#selectcar").change(function () {
        var val = $(this).val();

        if (val == "AUDI") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='A1'>A1</option><option value='A2'>A2</option><option value='A3'>A3</option><option value='A4'>A4</option><option value='A5'>A5</option><option value='A6'>A6</option><option value='A7'>A7</option><option value='A8'>A8</option><option value='Q2'>Q2</option><option value='Q3'>Q3</option><option value='Q5'>Q5</option><option value='Q7'>Q7</option><option value='R8'>R8</option><option value='RS3'>RS3</option><option value='RS4'>RS4</option><option value='RS5'>RS5</option><option value='RS6'>RS6</option><option value='RS7'>RS7</option><option value='S3'>S3</option><option value='S4'>S4</option><option value='S5'>S5</option><option value='S6'>S6</option><option value='S7'>S7</option><option value='S8'>S8</option><option value='TT'>TT</option><option value='OTHER'>Other</option>");
        }

        else if (val == "BENTLEY") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='ARANGE'>Arange</option><option value='CONTINENTAL'>Continental</option><option value='FLYING SPUR'>Flying Spur</option><option value='TURBO R'>Turbo R</option><option value='OTHER'>Other</option>");
        }

        else if (val == "BMW") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='SERIES 1'>Series 1</option><option value='SERIES 2'>Series 2</option><option value='SERIES 3'>Series 3</option><option value='SERIES 4'>Series 4</option><option value='SERIES 5'>Series 5</option><option value='SERIES 6'>Series 6</option><option value='SERIES 7'>Series 7</option><option value='SERIES 8'>Series 8</option><option value='M2'>M2</option><option value='M3'>M3</option><option value='M4'>M4</option><option value='M5'>M5</option><option value='M6'>M6</option><option value='X2'>X2</option><option value='X3'>X3</option><option value='X4'>X4</option><option value='X5'>X5</option><option value='X6'>X6</option><option value='OTHER'>Other</option>");
        }

        else if (val == "BUGATTI") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='VEYRON'>Veyron</option><option value='OTHER'>Other</option>");
        }

        else if (val == "CHEVROLET") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='CAMARO'>Camaro</option><option value='CORVETE'>Corvete</option><option value='ORLANDO'>Orlando</option><option value='SPARK'>Spark</option><option value='OTHER'>Other</option>");
        }

        else if (val == "FERRARI") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='360'>360</option><option value='458'>458</option><option value='599'>599</option><option value='CALIFORNIA'>California</option><option value='F430'>F430</option><option value='OTHER'>Other</option>");
        }

        else if (val == "FIAT") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='500'>500</option><option value='500L'>500L</option><option value='500X'>500X</option><option value='BRAVO'>Bravo</option><option value='PUNTO'>Punto</option><option value='TIPO'>Tipo</option><option value='OTHER'>Other</option>");
        }

        else if (val == "FORD") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='ESCORT'>Escort</option><option value='FIESTA'>Fiesta</option><option value='FOCUS'>Focus</option><option value='GALAXY'>Galaxy</option><option value='OTHER'>Other</option>");
        }

        else if (val == "JEEP") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='COMPASS'>Compass</option><option value='GRAND CHEROKEE'>Grand Cherokee</option><option value='RENEGADE'>Renegade</option><option value='OTHER'>Other</option>");
        }

        else if (val == "KIA") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='PICANTO'>Picanto</option><option value='RIO'>Rio</option><option value='SPORTAGE'>Sportage</option><option value='OTHER'>Other</option>");
        }

        else if (val == "LAMBORGHINI") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='AVENTADOR'>Aventador</option><option value='GALLARDO'>Gallardo</option><option value='HURACAN'>Huracan</option><option value='MURCIELAGO'>Murcielago</option><option value='URUS'>Urus</option><option value='OTHER'>Other</option>");
        }

        else if (val == "MERCEDES-BENZ") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='A CLASS'>A Class</option><option value='AMG'>AMG</option><option value='B CLASS'>B Class</option><option value='C CLASS'>C Class</option><option value='CL'>CL</option><option value='CLS'>CLS</option><option value='E CLASS'>E Class</option><option value='G CLASS'>G CLASS</option><option value='GLA CLASS'>GLA Class</option><option value='S CLASS'>S Class</option><option value='X CLASS'>X Class</option><option value='OTHER'>Other</option>");
        }

        else if (val == "NISSAN") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='ALMERA'>Almera</option><option value='ELGRAND'>Elgrand</option><option value='GT-R'>GT-R</option><option value='JUKE'>Juke</option><option value='QASHQAI'>Qashqai</option><option value='X-TRAIL'>X-Trail</option><option value='OTHER'>Other</option>");
        }

        else if (val == "OPEL") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='ASTRA'>Astra</option><option value='OMEGA'>Omega</option><option value='OTHER'>Other</option>");
        }

        else if (val == "PEUGEOT") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='206'>206</option><option value='207'>207</option><option value='208'>208</option><option value='307'>307</option><option value='308'>307</option><option value='407'>407</option><option value='508'>508</option><option value='607'>607</option><option value='807'>807</option><option value='OTHER'>Other</option>");
        }

        else if (val == "PORSCHE") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='718'>718</option><option value='911'>911</option><option value='BOXTER'>Boxter</option><option value='CARRERA'>Carrera</option><option value='CAYENNE'>Cayenne</option><option value='CAYMAN'>Cayman</option><option value='MACAN'>Macan</option><option value='PANAMARA'>Panamera</option><option value='OTHER'>Other</option>");
        }

        else if (val == "RENAULT") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='CLIO'>Clio</option><option value='MEGANE'>Megane</option><option value='SCENIC'>Scenic</option><option value='TWINGO'>Twingo</option><option value='ZOE'>Zoe</option><option value='OTHER'>Other</option>");
        }

        else if (val == "VOLKSWAGEN") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='GOLF 1'>Golf 1</option><option value='GOLF 2'>Golf 2</option><option value='GOLF 3'>Golf 3</option><option value='GOLF 4'>Golf 4</option><option value='GOLF 5'>Golf 5</option><option value='GOLF 6'>Golf 6</option><option value='GOLF 7'>Golf 7</option><option value='GOLF 8'>Golf 8</option><option value='JETTA'>Jetta</option><option value='PASSAT'>Passat</option><option value='TIGUAN'>Tiguan</option><option value='TUAREG'>Tuareg</option><option value='TOURAN'>Touran</option><option value='OTHER'>Other</option>");
        }

        else if (val == "VOLVO") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='C30'>C30</option><option value='S40'>S40</option><option value='S50'>S50</option><option value='S60'>S60</option><option value='V40'>V40</option><option value='V50'>V50</option><option value='V60'>V60</option><option value='V70'>V90</option><option value='XC60'>XC60</option><option value='XC90'>XC90</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "ALFA ROMEO") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='164'>164</option><option value='4C'>4C</option><option value='8C'>8C</option><option value='Giuila'>Giuila</option><option value='Spider'>Spider</option><option value='Stelvio'>Stelvio</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "ASTON MARTIN") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='DB'>DB</option><option value='Rapide'>Rapide</option><option value='Vintage'>Vintage</option><option value='Vanquish'>Vanquish</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "CHRYSLER") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='200'>200</option><option value='300'>300</option><option value='Aspen'>Aspen</option><option value='Cirrus'>Cirrus</option><option value='Paciffica'>Paciffica</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "DODGE") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='Avenger'>Avenger</option><option value='Caravan'>Caravan</option><option value='D'>D</option><option value='Magnum'>Magnum</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "HONDA") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='Accord'>Accord</option><option value='Civic'>Civic</option><option value='CR'>CR</option><option value='Fit'>Fit</option><option value='HR'>HR</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "HYUNDAI") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='Accent'>Accent</option><option value='Azera'>Azera</option><option value='Elantra'>Elantra</option><option value='Excel'>Excel</option><option value='Genesis'>Genesis</option><option value='Ioniq'>Ioniq</option><option value='Santa'>Santa</option><option value='Sonata'>Sonata</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "JAGUAR") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='E-Pace'>E-Pace</option><option value='F'>F</option><option value='I'>I</option><option value='S'>S</option><option value='Super V8'>Super V8</option><option value='X Types'>X Types</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "LAND ROVER") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='Defender'>Defender</option><option value='Discovery'>Discovery</option><option value='Freelander'>Freelander</option><option value='LR'>LR</option><option value='Ranger Rover'>Ranger Rover</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "MAZDA") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='323'>323</option><option value='626'>626</option><option value='929'>929</option><option value='B Series'>B Series</option><option value='CX'>CX</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='Speed'>Speed</option><option value='MX'>MX</option><option value='RX'>RX</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "ROLLS-ROYCE") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='Dawn'>Dawn</option><option value='Ghost'>Ghost</option><option value='Phantom'>Phantom</option><option value='Silver'>Silver</option><option value='Wraith'>Wraith</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "TESLA") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='Model 3'>Model 3</option><option value='Model S'>Model S</option><option value='Model X'>Model X</option><option value='Roadster'>Roadster</option><option value='OTHER'>Other</option>");
        }
        
        else if (val == "TOYOTA") {
            $("#modelcar").html("<option value='ALL'>Any</option><option value='Camry'>Camry</option><option value='Corolla'>Corolla</option><option value='Highlander'>Highlander</option><option value='Land Cruiser'>Land Cruiser</option><option value='Matrix'>Matrix</option><option value='Miral'>Miral</option><option value='OTHER'>Other</option>");
        }
    });
  });
  $(document).ready(function () {
    $("#min-price").change(function () {
        var price = $(this).val();

        if(price == "500"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='1000'>$1000</option><option value='1500'>$1500</option><option value='2000'>$2000</option><option value='2500'>$2500</option><option value='3000'>$3000</option><option value='4000'>$4000</option><option value='5000'>$5000</option><option value='6000'>$6000</option><option value='7000'>$7000</option><option value='8000'>$8000</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "1000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='1500'>$1500</option><option value='2000'>$2000</option><option value='2500'>$2500</option><option value='3000'>$3000</option><option value='4000'>$4000</option><option value='5000'>$5000</option><option value='6000'>$6000</option><option value='7000'>$7000</option><option value='8000'>$8000</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "1500"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='2000'>$2000</option><option value='2500'>$2500</option><option value='3000'>$3000</option><option value='4000'>$4000</option><option value='5000'>$5000</option><option value='6000'>$6000</option><option value='7000'>$7000</option><option value='8000'>$8000</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "2000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='2500'>$2500</option><option value='3000'>$3000</option><option value='4000'>$4000</option><option value='5000'>$5000</option><option value='6000'>$6000</option><option value='7000'>$7000</option><option value='8000'>$8000</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "2500"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='3000'>$3000</option><option value='4000'>$4000</option><option value='5000'>$5000</option><option value='6000'>$6000</option><option value='7000'>$7000</option><option value='8000'>$8000</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "3000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='4000'>$4000</option><option value='5000'>$5000</option><option value='6000'>$6000</option><option value='7000'>$7000</option><option value='8000'>$8000</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "4000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='5000'>$5000</option><option value='6000'>$6000</option><option value='7000'>$7000</option><option value='8000'>$8000</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "5000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='6000'>$6000</option><option value='7000'>$7000</option><option value='8000'>$8000</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "6000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='7000'>$7000</option><option value='8000'>$8000</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "7000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='8000'>$8000</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "8000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='9000'>$9000</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "9000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='10000'>$10000</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "10000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='12000'>$12000</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "12000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='15000'>$15000</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "15000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='20000'>$20000</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "20000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='25000'>$25000</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "25000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='30000'>$30000</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "30000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='40000'>$40000</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "40000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='50000'>$50000</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "50000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='70000'>$70000</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "70000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='100000'>$100000</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "100000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='150000'>$150000</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "150000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='200000'>$200000</option><option value='500000'>$500000</option>");
        }

        if(price == "200000"){
          $("#max-price").html("<option value='ALL'>Any</option><option value='500000'>$500000</option>");
        }

        if(price == "500000"){
          $("#max-price").html("<option value='ALL'>Any</option>");
        }

      });
    });
    $(document).ready(function () {
      $("#year-from").change(function () {
          var year = $(this).val();

          if(year == "1996"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option><option value='2002'>2002</option><option value='2001'>2001</option><option value='2000'>2000</option><option value='1999'>1999</option><option value='1998'>1998</option><option value='1997'>1997</option>");
          }

          if(year == "1997"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option><option value='2002'>2002</option><option value='2001'>2001</option><option value='2000'>2000</option><option value='1999'>1999</option><option value='1998'>1998</option>");
          }

          if(year == "1998"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option><option value='2002'>2002</option><option value='2001'>2001</option><option value='2000'>2000</option><option value='1999'>1999</option>");
          }

          if(year == "1999"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option><option value='2002'>2002</option><option value='2001'>2001</option><option value='2000'>2000</option>");
          }

          if(year == "2000"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option><option value='2002'>2002</option><option value='2001'>2001</option>");
          }

          if(year == "2001"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option><option value='2002'>2002</option>");
          }

          if(year == "2002"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option>");
          }

          if(year == "2003"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option>");
          }

          if(year == "2004"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option>");
          }

          if(year == "2005"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option>");
          }

          if(year == "2006"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option>");
          }

          if(year == "2007"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option>");
          }

          if(year == "2008"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option>");
          }

          if(year == "2009"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option>");
          }

          if(year == "2010"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option>");
          }

          if(year == "2011"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option>");
          }

          if(year == "2012"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option>");
          }

          if(year == "2013"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option>");
          }

          if(year == "2014"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option>");
          }

          if(year == "2015"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option>");
          }

          if(year == "2016"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option><option value='2017'>2017</option>");
          }

          if(year == "2017"){
            $("#year-to").html("<option value='ALL'>Any</option><option value='2018'>2018</option>");
          }

          if(year == "2018"){
            $("#year-to").html("<option value='ALL'>Any</option>");
          }

      });
    });
    $(document).ready(function () {
      $("#mileage-from").change(function() {
          var mileage = $(this).val();
          if(mileage == "0"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='5000'>5000</option><option value='10000'>10000</option><option value='20000'>20000</option><option value='30000'>30000</option><option value='40000'>40000</option><option value='50000'>50000</option><option value='60000'>60000</option><option value='70000'>70000</option><option value='80000'>80000</option><option value='90000'>90000</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "5000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='10000'>10000</option><option value='20000'>20000</option><option value='30000'>30000</option><option value='40000'>40000</option><option value='50000'>50000</option><option value='60000'>60000</option><option value='70000'>70000</option><option value='80000'>80000</option><option value='90000'>90000</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "10000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='20000'>20000</option><option value='30000'>30000</option><option value='40000'>40000</option><option value='50000'>50000</option><option value='60000'>60000</option><option value='70000'>70000</option><option value='80000'>80000</option><option value='90000'>90000</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "20000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='30000'>30000</option><option value='40000'>40000</option><option value='50000'>50000</option><option value='60000'>60000</option><option value='70000'>70000</option><option value='80000'>80000</option><option value='90000'>90000</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "30000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='40000'>40000</option><option value='50000'>50000</option><option value='60000'>60000</option><option value='70000'>70000</option><option value='80000'>80000</option><option value='90000'>90000</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "40000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='50000'>50000</option><option value='60000'>60000</option><option value='70000'>70000</option><option value='80000'>80000</option><option value='90000'>90000</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "50000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='60000'>60000</option><option value='70000'>70000</option><option value='80000'>80000</option><option value='90000'>90000</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "60000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='70000'>70000</option><option value='80000'>80000</option><option value='90000'>90000</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "70000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='80000'>80000</option><option value='90000'>90000</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "80000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='90000'>90000</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "90000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='100000'>100000</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "100000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='120000'>120000</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "120000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='150000'>150000</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "150000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='180000'>180000</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "180000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='200000'>200000</option><option value='250000'>250000</option>");
          }
          if(mileage == "200000"){
            $("#mileage-to").html("<option value='ALL'>Any</option><option value='250000'>250000</option>");
          }
          if(mileage == "250000"){
            $("#mileage-to").html("<option value='ALL'>Any</option>");
          }
      });
    });
	</script>

<style>

</style>

</head>
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
      <button onclick="myFunction()" class="dropbtn">Profile &#9662;</button>
      <div id="myDropdown" class="dropdown-content">
        <a href="profile">View profile</a>
        <a href="profile/logout.php">Log out</a>
        <a href="sell_car">Sell a car</a>
      </div>
    </div>

      <?php } else { ?>
      <p>Do you want to sell a car ? <a href="login/">Login first</a>.</p>
      <?php } ?>
    </div>
    <div class="line"></div>
  </div>

  <div class="content-text">
    <h1>What type of car are you looking for? Fill in some fields and find your match.</h1>
  </div>

  <div class="content-form" id="formdiv">
    <form action="search_results.php" method="get">
      <div class="input-1">
        <div>
          <p class="text-input">Make</p><!--All-->
          <select name="make" id="selectcar" onchange="findmatch(make)">

          <option value="ALL">Any</option>
          
          <option value="ALFA ROMEO">Alfa Romeo</option>
          
          <option value="ASTON MARTIN">Aston Martin</option>

          <option value="AUDI">Audi</option>

          <option value="BENTLEY">Bentley</option>

          <option value="BMW">BMW</option>

          <option value="BUGATTI">Bugatti</option>

          <option value="CHEVROLET">Chevrolet</option>
          
          <option value="CHRYSLER">Chrysler</option>
          
          <option value="DODGE">Dodge</option>

          <option value="FERRARI">Ferrari</option>

          <option value="FIAT">Fiat</option>
          
          <option value="FORD">Ford</option>
          
          <option value="HONDA">Honda</option>
          
          <option value="HYUNDAI">Hyundai</option>
          
          <option value="JAGUAR">Jaguar</option>

          <option value="JEEP">Jeep</option>

          <option value="KIA">Kia</option>

          <option value="LAMBORGHINI">Lamborghini</option>
          
          <option value="LAND ROVER">Land Rover</option>
          
          <option value="MAZDA">Mazda</option>

          <option value="MERCEDES-BENZ">Mercedes-Benz</option>

          <option value="NISSAN">Nissan</option>

          <option value="OPEL">Opel</option>

          <option value="PEUGEOT">Peugeot</option>

          <option value="PORSCHE">Porsche</option>

          <option value="RENAULT">Renault</option>
          
          <option value="ROLLS-ROYCE">Rolls-Royce</option>
          
          <option value="TESLA">Telsa</option>
          
          <option value="TOYOTA">Toyota</option>
          
          <option value="VOLKSWAGEN">Volkswagen</option>

          <option value="VOLVO">Volvo</option>

          </select>
        </div>
      </div>
      <div class="input-2">
        <div>
          <p class="text-input">Model</p>
          <select name="model" id="modelcar" onchange="findmatch(model)">
            <option value="ALL">Any</option>
          </select>
        </div>
      </div>
      <div class="input-3">
        <div>
          <p class="text-input">Min price</p>
          <select name="min_price" id="min-price" onchange="findmatch(min_price)"><!--All-->
            <option value="ALL">Any</option>
            <option value="500">$500</option>
            <option value="1000">$1000</option>
            <option value="1500">$1500</option>
            <option value="2000">$2000</option>
            <option value="2500">$2500</option>
            <option value="3000">$3000</option>
            <option value="4000">$4000</option>
            <option value="5000">$5000</option>
            <option value="6000">$6000</option>
            <option value="7000">$7000</option>
            <option value="8000">$8000</option>
            <option value="9000">$9000</option>
            <option value="10000">$10000</option>
            <option value="12000">$12000</option>
            <option value="15000">$15000</option>
            <option value="20000">$20000</option>
            <option value="25000">$25000</option>
            <option value="30000">$30000</option>
            <option value="40000">$40000</option>
            <option value="50000">$50000</option>
            <option value="70000">$70000</option>
            <option value="100000">$100000</option>
            <option value="150000">$150000</option>
            <option value="200000">$200000</option>
            <option value="500000">$500000</option>
          </select>
        </div>
      </div>
      <div class="input-4">
        <div>
          <p class="text-input">Max price</p>
          <select name="max_price" id="max-price" onchange="findmatch(max_price)"><!--All-->
            <option value="ALL">Any</option>
            <option value="500">$500</option>
            <option value="1000">$1000</option>
            <option value="1500">$1500</option>
            <option value="2000">$2000</option>
            <option value="2500">$2500</option>
            <option value="3000">$3000</option>
            <option value="4000">$4000</option>
            <option value="5000">$5000</option>
            <option value="6000">$6000</option>
            <option value="7000">$7000</option>
            <option value="8000">$8000</option>
            <option value="9000">$9000</option>
            <option value="10000">$10000</option>
            <option value="12000">$12000</option>
            <option value="15000">$15000</option>
            <option value="20000">$20000</option>
            <option value="25000">$25000</option>
            <option value="30000">$30000</option>
            <option value="40000">$40000</option>
            <option value="50000">$50000</option>
            <option value="70000">$70000</option>
            <option value="100000">$100000</option>
            <option value="150000">$150000</option>
            <option value="200000">$200000</option>
            <option value="500000">$500000</option>
          </select>
        </div>
      </div>
      <div class="input-5">
        <div>
          <p class="text-input">Year from</p>
          <select name="year_from" id="year-from" onchange="findmatch(year_from)"><!--All-->
    <option value="ALL">Any</option>
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
      <div class="input-6">
        <div>
          <p class="text-input">Year to</p>
          <select name="year_to" id="year-to" onchange="findmatch(year_to)"><!--All-->
    <option value="ALL">Any</option>
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
      <div class="input-7">
        <div>
          <p class="text-input">Mileage from</p>
          <select name="mileage_from" id="mileage-from" onchange="findmatch(mileage_from)"><!--All-->
            <option value="ALL">Any</option>
            <option value="0">0</option>
            <option value="5000">5000</option>
            <option value="10000">10000</option>
            <option value="20000">20000</option>
            <option value="30000">30000</option>
            <option value="40000">40000</option>
            <option value="50000">50000</option>
            <option value="60000">60000</option>
            <option value="70000">70000</option>
            <option value="80000">80000</option>
            <option value="90000">90000</option>
            <option value="100000">100000</option>
            <option value="120000">120000</option>
            <option value="150000">150000</option>
            <option value="180000">180000</option>
            <option value="200000">200000</option>
            <option value="250000">250000</option>
          </select>
        </div>
      </div>
      <div class="input-8">
        <div>
          <p class="text-input">Mileage to</p>
            <select name="mileage_to" id="mileage-to" onchange="findmatch(mileage_to)"><!--All-->
              <option value="ALL">Any</option>
              <option value="5000">5000</option>
              <option value="10000">10000</option>
              <option value="20000">20000</option>
              <option value="30000">30000</option>
              <option value="40000">40000</option>
              <option value="50000">50000</option>
              <option value="60000">60000</option>
              <option value="70000">70000</option>
              <option value="80000">80000</option>
              <option value="90000">90000</option>
              <option value="100000">100000</option>
              <option value="120000">120000</option>
              <option value="150000">150000</option>
              <option value="180000">180000</option>
              <option value="200000">200000</option>
              <option value="250000">250000</option>
              <option value="300000">300000</option>
            </select>
          </div>
      </div>
      <div class="input-9">
        <div>
          <p class="text-input">State</p>
            <select name="state" onchange="findmatch(state)">
	            <option value="ALL">Select</option>
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
      <div class="input-10">
        <div>
          <p class="text-input">Fuel type</p>
          <select name="fuel_type" onchange="findmatch(fuel_type)">
            <option value="ALL">Any</option>
            <option value="Diesel">Diesel</option>
            <option value="Electric">Electric</option>
            <option value="Hybrid">Hybrid</option>
            <option value="Petrol">Petrol</option>
          </select>
        </div>
      </div>
      <div class="input-11">
        <div>
          <p class="text-input">Gearbox</p>
          <select name="gearbox" onchange="findmatch(gearbox)">
            <option value="ALL">Any</option>
            <option value="Manual">Manual</option>
            <option value="Automatic">Automatic</option>
            <option value="Semi-automatic">Semi-automatic</option>
          </select>
        </div>
      </div>
      <div class="input-12">
        <div>
          <p class="text-input">Doors <i class="fa fa-info-circle tooltip"><span class="tooltiptext">Trunk counts as the door too</span></i></p>
          <select name="doors" onchange="findmatch(doors)">
            <option value="ALL">Any</option>
            <option value="3">3</option>
            <option value="5">5</option>
          </select>
        </div>
      </div>
      <div class="input-13">
        <p id="reset">Reset search</p>
        <div class="last">
          <?php
            $query_run = mysqli_query($conn, "SELECT `id_car` FROM `cars`");
            $rows = mysqli_num_rows($query_run);
          ?>
          <input type="submit" id="search_btn" value="Search<?php echo " ".$rows; ?>" disabled>

          <br><br>
        </div>

    <script>
        $(document).ready(function(){
          $(document).on('click', '#reset', function(){
            $("#reset").text("Loading...");
            var text = $("#reset").text();
           $.ajax({
              url:"reset.php",
              method:"GET",
              data:{text:text},
              dataType:"text",
              success:function(data){
                 $("#reset").text("Reset search");
                 $("#reset").css("display" , "none");
                 $("select").val("ALL");
              }
            });
          });
        });
    </script>

      </div>
    </form>
  </div>

  <?php require "footer.php" ?>

</div>
</body>
</html>
