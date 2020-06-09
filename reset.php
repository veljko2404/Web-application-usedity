<?php
    session_start();
    if(isset($_SESSION['query'])){
        session_unset();
    }
    echo 'ses';
?>
