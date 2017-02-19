<?php
  require_once("functions/validationFunctions.php");
  require_once("functions/functions.php");

  //import the root varaible
	$root=$_SERVER['DOCUMENT_ROOT'];
	//$root.="/jamesMcHugh";
	if(strpos($root, "jamesMcHugh")<16){
		$root=$root."jamesMcHugh";
	}

	//check if the sesssion has already been set, if not import it and start it
	if(!isset($_SESSION)){
		require_once($root."/php/functions/sessionFunctions.php");
	}

  if(isset($_SESSION['uI']) && !sessionExpired()){
    if(isset($_POST) && isset($_POST['submitChange']) && !empty($_POST['submitChange']) && $_POST['submitChange'] == "Submit"){
      require_once("components/database/dbConn.php");
      require_once("components/database/secureDatabase.php");

      $data=array(
        'email'=>prepareString($_POST['emailRegister']),
        'password'=>prepareString($_POST['passwordRegister']),
        'confirmPassword'=>prepareString($_POST['confirmPasswordRegister']),
        'title'=>prepareString($_POST['title']),
        'forename'=>prepareString($_POST['forename']),
        'surname'=>prepareString($_POST['surname']),
        'address1'=>prepareString($_POST['address1']),
        'address2'=>prepareString($_POST['address2']),
        'city'=>prepareString($_POST['city']),
        'county'=>prepareString($_POST['county']),
        'country'=>prepareString($_POST['country']),
        'postCode'=>prepareString($_POST['postCode']),
        'jobTitle'=>prepareString($_POST['jobTitle']),
        'department'=>prepareString($_POST['department']),
        'landlinePrefix'=>prepareString($_POST['landlinePrefix']),
        'landlineExt'=>prepareString($_POST['landlineExt']),
        'landlineNumber'=>prepareString($_POST['landlineNumber']),
        'mobilePrefix'=>prepareString($_POST['mobilePrefix']),
        'mobileExt'=>prepareString($_POST['mobileExt']),
        'mobileNumber'=>prepareString($_POST['mobileNumber']),
        'faxPrefix'=>prepareString($_POST['faxPrefix']),
        'faxExt'=>prepareString($_POST['faxExt']),
        'faxNumber'=>prepareString($_POST['faxNumber'])
      );


    }else{
      $_SESSION['userDetailsErrors']="The form was not submitted correctly, please try again, if the problem persists email support";
      redirect_to("../myAccount.php");
    }
  }else{
    //no point in generating error as post is not set, just redirect
    $_SESSION['loginErrors'] = "A User was not submitted or your session expired, please try again";
    redirect_to("../newBookingLogin.php");
  }


?>
