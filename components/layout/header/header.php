<?php
  $root=$_SERVER['DOCUMENT_ROOT'];
  //$root.="/jamesMcHugh";
  if(strpos($root, "jamesMcHugh")<16){
    $root=$root."jamesMcHugh";
  }

  //cache control - prevents the browser from caching the page
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
?>

<meta charset="UTF-8"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="expires" content="-1"/>
<link rel="icon" type="image/png" href="images/favicon.ico">
<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/layout/style.css"/>
<?php include($root.'/php/components/javascript.php'); ?>
<?php


  require_once($root."/php/components/database/dbConn.php");
  require_once($root."/php/functions/validationFunctions.php");
  require_once($root."/php/functions/functions.php");
  if(!isset($_SESSION)){
    require_once($root."/php/functions/sessionFunctions.php");
  }

?>