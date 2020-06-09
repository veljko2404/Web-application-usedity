<?php

  require '../login/core.php';
  session_destroy();
  header("Location: ../index.php");

?>
