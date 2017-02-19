<?php

  // This is a processing script to make sure that the user gets logged in correctly
  if(
    isset($_POST) &&
    isset($_POST['submitLogin']) &&
    !empty($_POST['submitLogin']) &&
    $_POST['submitLogin'] == "Login"
    )
    {

    if(!isset($_SESSION)){
      require_once("functions/sessionFunctions.php");
    }

    require_once("functions/validationFunctions.php");
    require_once("functions/functions.php");

    if(isset($_POST['javascriptDisabled'])){
      $_SESSION['form']=="login";
      $_SESSION['loginErrors'] = "<p>Please fix the following errors: </p><ul><li>Javascript is not enabled, therefore we cannot log you in, please enable javascript and try again</li></ul>";
      redirect_to($root."/newBookingLogin.php");
    }else{
      $root=$_SERVER['DOCUMENT_ROOT'];
      //$root.="/jamesMcHugh";
      if(strpos($root, "jamesMcHugh")<16){
        $root=$root."jamesMcHugh";
      }

  		require_once("components/database/dbConn.php");
  		require_once("components/database/secureDatabase.php");
  		unset($_SESSION['loginErrors']);

  		//takes in the values from the POST request
  		//trims any spaces
  		//escapes any special characters to prevent sql injection
  		$email=prepareString($_POST['email']);
  		$password=prepareString($_POST['password']);

    		if(validateData($email,$password)){

    			if(loginUser($email,$password)){
    				global $connection;
    				$dbtable="users";
    				$query="SELECT user_id FROM $dbtable ";
    				$query.="WHERE email_address = '$email' LIMIT 1";
    				$resultSession=mysqli_query($connection,$query);

    				if(mysqli_num_rows($resultSession)>0){
              //check that remember me is ticked - if so do not set exp
    					$data=mysqli_fetch_assoc($resultSession);

              //replace this with the user ID
              $_SESSION['uI']=$data['user_id'];

              if(isset($_POST['rememberMe']) && $_POST['rememberMe'] == "agree"){
                $_POST['rememberMe'] = true;
              }

              if(!isset($_POST['rememberMe']) || $_POST['rememberMe'] = false){
                $_SESSION['exp']=time()*2*60;
              }else{
                $_SESSION['exp'] = "No Expiry";
              }

              if(isset($_POST['formType']) && $_POST['formType'] == "membersBar"){
                redirect_to("../../mainMenu.php");
              }else{
                redirect_to("../newQuoteAndCreateProject.php");
              }

    				}else{
              $_SESSION['form']=="login";
    					$_SESSION['loginErrors'] = "<p>Please fix the following errors: </p><ul><li>Username and/or Password was Incorrect</li></ul>";
              redirect_to($root."/newBookingLogin.php");
            }
    			}else{
            $_SESSION['form']=="login";
    				$_SESSION['loginErrors'] = "<p>Please fix the following errors: </p><ul><li>Username and/or Password was Incorrect</li></ul>";
            redirect_to($root."/newBookingLogin.php");
          }
    		}else{
          $_SESSION['form']="login";
    			$_SESSION['loginErrors'] = "<p>Please fix the following errors: </p><ul><li>User Validation failed</li></ul>";
          redirect_to($root."/newBookingLogin.php");
        }
      require_once("components/database/closedbConn.php");

    }

  }else{
    $_SESSION['loginErrors'] = "<p>Please fix the following errors: </p><ul><li>You have to submit login details first, this is a violation of terms and conditions</li></ul>";
    redirect_to($root."/newBookingLogin.php");
  }


?>
