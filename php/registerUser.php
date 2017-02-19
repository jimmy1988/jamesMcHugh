<?php
  //Processing script to check that a company and a user exists before registering both of them into the database

  require_once("functions/validationFunctions.php");
  require_once("functions/functions.php");

  if(isset($_POST) && isset($_POST['submitRegister']) && !empty($_POST['submitRegister']) && $_POST['submitRegister'] == "Submit"){
    global $root;
    require_once("components/database/dbConn.php");
    require_once("components/database/secureDatabase.php");

    //prepare the data
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
      'companyName'=>prepareString($_POST['companyName']),
      'companyProfession'=>prepareString($_POST['companyProfession']),
      'jobTitle'=>prepareString($_POST['jobTitle']),
      'department'=>prepareString($_POST['department']),
      'companyAddress1'=>prepareString($_POST['companyAddress1']),
      'companyAddress2'=>prepareString($_POST['companyAddress2']),
      'companyCity'=>prepareString($_POST['companyCity']),
      'companyCounty'=>prepareString($_POST['companyCounty']),
      'companyCountry'=>prepareString($_POST['companyCountry']),
      'companyPostCode'=>prepareString($_POST['companyPostCode']),
      'landlinePrefix'=>prepareString($_POST['landlinePrefix']),
      'landlineExt'=>prepareString($_POST['landlineExt']),
      'landlineNumber'=>prepareString($_POST['landlineNumber']),
      'mobilePrefix'=>prepareString($_POST['mobilePrefix']),
      'mobileExt'=>prepareString($_POST['mobileExt']),
      'mobileNumber'=>prepareString($_POST['mobileNumber']),
      'faxPrefix'=>prepareString($_POST['faxPrefix']),
      'faxExt'=>prepareString($_POST['faxExt']),
      'faxNumber'=>prepareString($_POST['faxNumber']),
      'dataChecked'=>prepareString($_POST['legalChecked']),
      'legalChecked'=>prepareString($_POST['dataChecked'])
    );

    if($data['dataChecked'] == "agree"){
      $data['dataChecked'] = 1;
    }else{
      $data['dataChecked'] = $data['dataChecked'];
    }

    if($data['legalChecked'] == "agree"){
      $data['legalChecked'] = 1;
    }else{
      $data['legalChecked'] = $data['legalChecked'];
    }

    //check that data validates
    if(validateRegistrationData($data)){
      if(userExists($data['email']) || companyExists($data['companyName'])){
        //user and company already exists, generate error and redirect to the registration page
        $_SESSION['form']="register";
        $_SESSION['registerErrors'] = "<p>Please fix the following errors: </p><ul><li>Username and/or company name already exists</li></ul>";
        redirect_to("../newBookingLogin.php");
      }else{
        $companyID=registerNewCompany($data);
        if($companyID == false){
          //generate error, redirect to registration page
          $_SESSION['form']="register";
          $_SESSION['registerErrors'] = "<p>Please fix the following errors: </p><ul><li>Company Registration Failed, Please Check The Details and Try Again</li></ul>";
          redirect_to("../newBookingLogin.php");
        }else{
          //next stage
          $userID=registerNewUser($data, $companyID);
          if($userID == false){
            //generate error, redirect to registration page
            $_SESSION['form']="register";
            $_SESSION['registerErrors'] = "<p>Please fix the following errors: </p><ul><li>User Registration Failed, Please Check The Details and Try Again</li></ul>";
            redirect_to("../newBookingLogin.php");
          }else{
            $_SESSION['uI']=$userID;
            $_SESSION['exp']=time()*2*60;
            redirect_to("../newQuoteAndCreateProject.php");
          }
        }
      }
    }else{
      //error already generated, just redirect
      redirect_to("../newBookingLogin.php");
    }
    //close down the database connection
    require_once("components/database/closedbConn.php");

  }else{
    //no point in generating error as post is not set, just redirect
    redirect_to("../newBookingLogin.php");
  }

  ?>
