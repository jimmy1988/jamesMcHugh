<?php
  if(!isset($_SESSION)){
    require_once("functions/sessionFunctions.php");
  }

  require_once("functions/functions.php");

  session_unset();
  session_destroy();
  redirect_to("../newBookingLogin.php");
?>
