<?php

require 'connect.php';
session_start();
if(isset($_SESSION['query'])){
  $q_query = $_SESSION['query'];
} else {
  $q_query = array();
}
if(isset($_GET['make'])){
  $make = $_GET['make'];
  $q_make = "make = '$make'";
  if(empty($q_query)){
    $q_query = array('make' => $q_make);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    if(array_search('make', $keys)>=0){
      unset($q_query["make"]);
      $q_query = $q_query + array('make' => $q_make);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('make' => $q_make);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['model'])){
  $model = $_GET['model'];
  $q_model = "model = '$model'";
  if(empty($q_query)){
    $q_query = array('model' => $q_model);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('model', $keys);
    if(array_search('model', $keys)>=0){
      $num = count($q_query);
      unset($q_query["model"]);
      $q_query = $q_query + array('model' => $q_model);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('model' => $q_model);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['min_price'])){
  $min_price = $_GET['min_price'];
  $q_min_price = 'price > '.$min_price;
  if(empty($q_query)){
    $q_query = array('min_price' => $q_min_price);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('min_price', $keys);
    if(array_search('min_price', $keys)>=0){
      $num = count($q_query);
      unset($q_query["min_price"]);
      $q_query = $q_query + array('min_price' => $q_min_price);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('min_price' => $q_min_price);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['max_price'])){
  $max_price = $_GET['max_price'];
  $q_max_price = 'price < '.$max_price;
  if(empty($q_query)){
    $q_query = array('max_price' => $q_max_price);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('max_price', $keys);
    if(array_search('max_price', $keys)>=0){
      $num = count($q_query);
      unset($q_query["max_price"]);
      $q_query = $q_query + array('max_price' => $q_max_price);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('min_price' => $q_max_price);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['year_from'])){
  $year_from = $_GET['year_from'];
  $q_year_from = 'year > '.$year_from;
  if(empty($q_query)){
    $q_query = array('year_from' => $q_year_from);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('year_from', $keys);
    if(array_search('year_from', $keys)>=0){
      $num = count($q_query);
      unset($q_query["year_from"]);
      $q_query = $q_query + array('year_from' => $q_year_from);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('year_from' => $q_year_from);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['year_to'])){
  $year_to = $_GET['year_to'];
  $q_year_to = 'year < '.$year_to;
  if(empty($q_query)){
    $q_query = array('year_to' => $q_year_to);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('year_to', $keys);
    if(array_search('year_to', $keys)>=0){
      $num = count($q_query);
      unset($q_query["year_to"]);
      $q_query = $q_query + array('year_to' => $q_year_to);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('year_to' => $q_year_to);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['mileage_from'])){
  $mileage_from = $_GET['mileage_from'];
  $q_mileage_from = 'mileage > '.$mileage_from;
  if(empty($q_query)){
    $q_query = array('mileage_from' => $q_mileage_from);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('mileage_from', $keys);
    if(array_search('mileage_from', $keys)>=0){
      $num = count($q_query);
      unset($q_query["mileage_from"]);
      $q_query = $q_query + array('mileage_from' => $q_mileage_from);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('mileage_from' => $q_mileage_from);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['mileage_to'])){
  $mileage_to = $_GET['mileage_to'];
  $q_mileage_to = 'mileage < '.$mileage_to;
  if(empty($q_query)){
    $q_query = array('mileage_to' => $q_mileage_to);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('mileage_to', $keys);
    if(array_search('mileage_to', $keys)>=0){
      $num = count($q_query);
      unset($q_query["mileage_to"]);
      $q_query = $q_query + array('mileage_to' => $q_mileage_to);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('mileage_to' => $q_mileage_to);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['state'])){
  $state = $_GET['state'];
  $q_state = "state = '$state'";
  if(empty($q_query)){
    $q_query = array('state' => $q_state);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('state', $keys);
    if(array_search('state', $keys)>=0){
      $num = count($q_query);
      unset($q_query["state"]);
      $q_query = $q_query + array('state' => $q_state);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('state' => $q_state);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['fuel_type'])){
  $fuel_type = $_GET['fuel_type'];
  $q_fuel_type = "fuel_type = '$fuel_type'";
  if(empty($q_query)){
    $q_query = array('fuel_type' => $q_fuel_type);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('fuel_type', $keys);
    if(array_search('fuel_type', $keys)>=0){
      $num = count($q_query);
      unset($q_query["fuel_type"]);
      $q_query = $q_query + array('fuel_type' => $q_fuel_type);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('fuel_type' => $q_fuel_type);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['doors'])){
  $doors = $_GET['doors'];
  $q_doors = 'doors = '.$doors;
  if(empty($q_query)){
    $q_query = array('doors' => $q_doors);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('doors', $keys);
    if(array_search('doors', $keys)>=0){
      $num = count($q_query);
      unset($q_query["doors"]);
      $q_query = $q_query + array('doors' => $q_doors);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('doors' => $q_doors);
      $_SESSION['query'] = $q_query;
    }
  }
}
if(isset($_GET['gearbox'])){
  $gearbox = $_GET['gearbox'];
  $q_gearbox = "gearbox = '$gearbox'";
  if(empty($q_query)){
    $q_query = array('gearbox' => $q_gearbox);
    $_SESSION['query'] = $q_query;
  } else {
    $keys = array_keys($q_query);
    $num = array_search('gearbox', $keys);
    if(array_search('gearbox', $keys)>=0){
      $num = count($q_query);
      unset($q_query["gearbox"]);
      $q_query = $q_query + array('gearbox' => $q_gearbox);
      $_SESSION['query'] = $q_query;
    } else {
      $q_query = $q_query + array('gearbox' => $q_gearbox);
      $_SESSION['query'] = $q_query;
    }
  }
}

$query_final = "SELECT `id_car` FROM `cars` WHERE ";

$e = 0;
foreach($q_query as $key){
  if($e==1){
    $query_final = $query_final." && ".$key;
  } else {
    $query_final = $query_final.$key;
    $e++;
  }
}
$query_run = mysqli_query($conn, $query_final);
$rows = mysqli_num_rows($query_run);
echo $rows;

?>
