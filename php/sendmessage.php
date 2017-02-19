<?php
  global $root;
  require_once($root."/php/components/database/dbConn.php");
  require_once($root."/php/components/functions/functions.php");
  require_once($root."/php/components/functions/validationFunctions.php");
  require_once($root."/php/components/database/secureDatabase.php");

  if(isset($_POST["firstName"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["message"])){

      //take in the values from the post request and secure the values to be placed in the database
      $firstName=prepareString($_POST["firstName"]);
      $surname=prepareString($_POST["surname"]);
      $email=prepareString($_POST["email"]);
      $message=prepareString($_POST["message"]);

      //save to database and redirect to the thank you page
      $databaseSave = saveMessage($firstName, $surname, $email, $message);

      if($databaseSave){
        //send a message to the client
        $mailClient=sendEmailToClient($firstName, $surname, $email, $message);
        if($mailClient){
          //send a notification to myself
          $mailHost = sendEmailToHost($firstName, $surname, $email, $message);
          if($mailHost){
            echo "success";
            //redirect_to("sendMessageConfirm.php");
          }else{
            echo "send message to host failure";
            //redirect_to("sendMessageDeny.php");
          }
        }else{
          echo "send message to client failure";
          //redirect_to("sendMessageDeny.php");
        }
      }else{
        echo "database save fail";
        //redirect_to("sendMessageDeny.php");
      }

  }else{
    die ("data not set correctly");
  }

  require_once($root."/php/components/php/database/closedbConn.php");
?>
