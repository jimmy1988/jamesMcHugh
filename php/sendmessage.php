<?php
  require_once("functions/functions.php");
  require_once("functions/validationFunctions.php");
  require_once("functions/sessionFunctions.php");
  //checks the input data to make sure we can send a message to it

  //modify this to not connect to the database (when application is in construction)

  //lock the form, so that
  if(isset($_POST) && isset($_POST['submit']) && $_POST['submit'] == 'Submit'){
    echo "success";
  }else{
    $errors = array('You have tried to open a document that needs data, please submit the data and try again');
    $_SESSION['errors'] = form_errors($errors);
    redirect_to("../contactMe.php");
  }


?>
