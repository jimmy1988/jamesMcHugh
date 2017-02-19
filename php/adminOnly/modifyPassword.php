<?php
  require_once($root."/php/components/database/dbConn.php");
  require_once($root."/php/components/database/secureDatabase.php");

  $id=1;
  $newPassword="j4m3rs1988uK";
  $newPassword=prepareString($newPassword);
  $newPassword=securePassword($newPassword);

  global $connection;
  $dbtable="users";

  $query = "UPDATE $dbtable SET ";
  $query.= "password = '{$newPassword}' ";
  $query.= "WHERE user_id={$id}";

  $result=mysqli_query($connection, $query);

  if(!$result){
    echo "fail";
  }else{
    echo "success";
  }

  require_once($root."/php/components/database/closedbConn.php");
?>
