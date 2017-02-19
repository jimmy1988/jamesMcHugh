<?php
  global $root;
  if(!isset($_SESSION)){
    require_once($root."/php/functions/sessionFunctions.php");
  }

  $u = getValueOfKey("u");


?>
