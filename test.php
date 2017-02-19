<?php
  require_once("php/classes/class.database.php");
  if(isset($database)){
    echo "TRUE";
  }else{
    echo "FALSE";
  }

  echo $database->escape_value("It's here!!");
?>
