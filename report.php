<?php

$car_id = $_POST['car_id'];

$text = $_POST['text'];

$message = "
    Link to car: https://www.usedity.com/cars/?car_id=".$car_id."
    
    ".$text;

$headers = "from: report@usedity.com";

$to = "veljko.petko0022@gmail.com";

if(mail($to, "New report from usedity", $message, $headers)){
    echo 'OK';
} else {
    echo '';
}

?>