<?php
  require_once("functions/functions.php");
  require_once("functions/validationFunctions.php");
  require_once("functions/sessionFunctions.php");
  //checks the input data to make sure we can send a message to it

  //modify this to not connect to the database (when application is in construction)

  //lock the form, so that
  if(isset($_POST) && isset($_POST['submit']) && $_POST['submit'] == 'Submit'){
    $errors=array();

    $firstName=$_POST['firstName'];
    $surname=$_POST['surname'];
    $email=$_POST['email'];
    $message=$_POST['message'];

    $error=false;

    if(!has_presence($firstName)){
      $error=true;
      array_push($errors, "First Name cannot be blank");
    }

    if(!has_presence($surname)){
      $error=true;
      array_push($errors, "Surname cannot be blank");
    }

    if(!has_presence($email)){
      $error=true;
      array_push($errors, "Email cannot be blank");
    }else{
      $response = checkEmail($email);
      if($response != true){
        $error=true;
        array_push($errors, $response);
      }
    }

    if(!has_presence($message)){
      $error=true;
      array_push($errors, "Message cannot be blank");
    }

    if($error){
      $_SESSION['contactFormErrors'] = form_errors($errors);
      $_SESSION['firstName'] = $firstName;
      $_SESSION['surname'] = $surname;
      $_SESSION['email'] = $email;
      $_SESSION['message'] = $message;
      redirect_to("../contactMe.php");
    }else{

      if(sendEmailToClient($firstName, $surname, $email, $message)){
        if(sendEmailToHost($firstName, $surname, $email, $message)){
          redirect_to("../thankYou.php");
        }else{
          redirect_to("../sendMessageError.php");
        }
      }else{
        redirect_to("../sendMessageError.php");
      }
    }
  }else{
    $errors = array('You have tried to open a document that needs data, please submit the data and try again');
    $_SESSION['contactFormErrors'] = form_errors($errors);
    redirect_to("../contactMe.php");
  }


?>
