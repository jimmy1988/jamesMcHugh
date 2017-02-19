<?php
  $root=$_SERVER['DOCUMENT_ROOT'];
  //$root.="/jamesMcHugh";
  if(strpos($root, "jamesMcHugh")<16){
    $root=$root."jamesMcHugh";
  }

  //check to see if the session has been set, if not start it and import all functions associated with the session
  if(!isset($_SESSION)){
    require_once($root."/php/functions/sessionFunctions.php");
  }

  //import all of the functions
  require_once($root."/php/functions/functions.php");

  $_SESSION['form'] = "register";

  redirect_to("../newBookingLogin.php");
?>
