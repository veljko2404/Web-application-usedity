<?php

  require 'connect.php';

  $query = "SELECT * FROM cars WHERE id_car > ".$_POST['last_id']." LIMIT 10";
  $id = $_POST['last_id'];
  $len = strlen($id);
  $id = substr_replace($id, '',2, $len-2);
  $output = '';
  $query_run = mysqli_query($conn, $query);
  $num = mysqli_num_rows($query_run);
  if($num>0){
    while($row = mysqli_fetch_array($query_run)){
      $id++;
      if($row['gearbox']=="semi-automatic"){$style = 'bottom:-20px';} else {$style = '';}
    $output .= '
    <a href="cars/?car_id='.$row['id_car'].'">
      <div class="live">
        <div class="image">
          <img src="uploads/thumbs/'.$row['id_user'].'/'.$row['thumb'].'" alt="">
        </div>
        <div class="details">
          <div class="title">
            <p class="hover"><span id="make">'.$row['make'].' </span><span id="model">'.$row['model'].' | </span>  <span id="year">'.$row['year'].'</span><span id="date" style="float:right; font-size:.6em;">'.$row['date'].'</span> </p>
          </div>
          <div class="desc">
            <p><span id="desc">'.$row['desc'].'</span></p>
          </div>
          <div class="price">
            <p>$<span id="price">'.$row['price'].'</span></p>
          </div>
          <div class="more-info">
            <p>Fuel type:<span id="fuel">'.$row['fuel_type'].'</span></p>
            <p id="gear">Gearbox:<span id="gearbox">'.$row['gearbox'].'</span></p>
            <p id="door">Doors:<span id="doors">'.$row['doors'].'</span><span id="state" style="float:right;'.$style.'">'.$row['state'].'</span></p>
          </div>
        </div>
      </div>
    </a>
    ';
    }
    if($num>9){
      $output .= '<button id="btn" data-id="'.$id.'">Load more</button>';
    }
  }
  echo $output;

?>
