<?php
  global $root;
  require_once($root."/php/functions/functions.php");
  if(!isset($_SESSION)){
    require_once($root."/php/functions/sessionFunctions.php");
  }

  if(isset($_GET['AJAX'])){
    if($_GET['AJAX']=="true"){
      if(isset($_SESSION['u']) && isset($_SESSION['exp'])){
    		if(time()<= $_SESSION['exp']){
          echo "Redirect";
          $_SESSION['exp']=time()+10*60;
    		}else{
    		    echo "No Redirect4";
    		}
    	}else{
    	   echo "No Redirect3";
    	}
    }else{
      echo "No Redirect2";
    }
  }else{
    echo "No Redirect1";
  }

?>
