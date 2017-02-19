<?php
  $root=$_SERVER['DOCUMENT_ROOT'];
  //$root.="/jamesMcHugh";
  if(strpos($root, "jamesMcHugh")<16){
    $root=$root."jamesMcHugh";
  }

  if(!isset($_SESSION)){
    require_once("sessionFunctions.php");
  }

  require_once("validationFunctions.php");
  $phpMailerMain=$root."/php/components/phpMailer/class.phpmailer.php";
  $phpMailerSMTP=$root."/php/components/phpMailer/class.smtp.php";
  require_once($phpMailerMain);
  require_once($phpMailerSMTP);

  function getCompanyDetailsByID($companyID){
    global $connection;

    $dbtable = "companies";

    $query="SELECT * FROM $dbtable WHERE company_id = {$companyID}";

    $result = mysqli_query($connection, $query);

    if($result){
      $row=mysqli_fetch_assoc($result);
      return $row;
    }else{
      return false;
    }
  }

  function getUserDetailsByID($userID){
    global $connection;

    $dbtable = "users";

    $query="SELECT * FROM $dbtable WHERE user_id = {$userID}";

    $result=mysqli_query($connection, $query);

    if($result){
      $row=mysqli_fetch_assoc($result);
      return $row;
    }else{
      return false;
    }

  }

  function getUserPriveleges($userID){
    global $connection;

    $dbtable = "users";

    $fields= "primaryUser,
              Admin,
              addCards,
              editCards,
              deleteCards,
              addCompanies,
              editCompanies,
              deleteCompanies,
              editContactFormMessages,
              deleteContactFormMessages,
              addDatabases,
              editDatabases,
              deleteDatabases,
              addGraphics,
              editGraphics,
              deleteGraphics
              addLogos,
              editLogos,
              deleteLogos,
              addNotes,
              editNotes,
              deleteNotes,
              addOther,
              editOther,
              deleteOther,
              addProjects,
              editProjects,
              deleteProjects,
              addServices,
              editServices,
              deleteServices,
              addUsers,
              editUsers,
              deleteUsers,
              addWebsites,
              editWebsites,
              deleteWebsites,
              account_status
              ";

    $query = "SELECT $fields FROM $dbtable WHERE user_id={$userID} LIMIT 1";

    $result=mysqli_query($connection, $query);

    if($result){
      $row=mysqli_fetch_assoc($result);
      return $row;
    }else{
      return false;
    }
  }

  //gets the forename and username and returns it
  function getForenameAndSurname($userID=null){

    if(isset($userID) && !empty($userID)){
      global $connection;

      $dbtable = "users";

      $query = "SELECT forename, surname FROM {$dbtable} WHERE user_id={$userID} LIMIT 1";

      $result=mysqli_query($connection, $query);

      if($result){
        $row=mysqli_fetch_assoc($result);
        return $row['forename'] . " " . $row['surname'];
      }else{
        //sql failed or no user detected
        return "Guest - SQL Failed";
      }
    }else{
      //No user defined
      return "Guest - No User";
    }
  }

  //takes all errors as an array and outputs them to the user as html output
	function form_errors($errors=array()){
		//output for the errors starts out blank and fills in if there are errors
		$output="";
		//tests to see if errors are not empty, if there are errors they are displayed to the user
		if(!empty($errors)){
			//start of div
			$output ="<div class = \"error\">";
			//error message
			$output.="Please fix the following errors:";
			//start the list of errors
			$output.="<ul>";
			foreach($errors as $key => $error){
				$output.="<li>";
				$output.=htmlentities($error);
				$output.="</li>";
			}
			//end of list
			$output.="</ul>";
			//end of div
			$output.="</div>";

		}
		//returns the output as a string
		return $output;
	}

  function validateData($email, $password){
  	if(hasPresence($email) && hasPresence($password)){
  		if(emailIsCorrectFormat($email) && passwordCorrectFormat($password)){
  			return true;
  		}else{
  			return false;
  		}
  	}else{
  		return false;
  	}
  }

  //check that the phone numbers are valid
  function checkPhoneNumbers($landlinePrefix, $landlineExt, $landlineNumber, $mobilePrefix, $mobileExt, $mobileNumber, $faxPrefix, $faxExt, $faxNumber){
    $valid=true;

    if( ( !isset($landlinePrefix) && !isset($landlineNumber) ) && ( !isset($mobilePrefix) && !isset($mobileNumber) ) && ( !isset($faxPrefix) && !isset($faxNumber) ) ){
      return false;
    }else{
      if($valid && (isset($landlineNumber) && !empty($landlineNumber))){
        if(hasPresence($landlinePrefix) && hasPresence($landlineNumber)){
          $valid=true;
        }else{
          $valid=false;
        }
      }

      if($valid && (isset($mobileNumber) && !empty($mobileNumber))){
        if(hasPresence($mobilePrefix) && hasPresence($mobileNumber)){
          $valid=true;
        }else{
          $valid=false;
        }
      }

      if($valid && (isset($faxNumber) && !empty($faxNumber))){
        if(hasPresence($faxPrefix) && hasPresence($faxNumber)){
          $valid=true;
        }else{
          $valid=false;
        }
      }
    }

    return $valid;
  }

  //check that adddress 2 is valid
  function checkAddress2($address2){
    if(isset($address2) && !empty($address2)){
      if(hasPresence($address2)){
        return true;
      }else{
        return false;
      }
    }else{
      return true;
    }
  }

  //check that 2 passwords match
  function passwordsMatch($password1, $password2){
    return $password1 == $password2;
  }

  //validates all data that has been submitted
  function validateRegistrationData($data){

    //check if each field is not blank
    if(
       hasPresence($data['email']) &&
       hasPresence($data['password']) &&
       hasPresence($data['confirmPassword']) &&
       hasPresence($data['title']) &&
       hasPresence($data['forename']) &&
       hasPresence($data['surname']) &&
       hasPresence($data['address1']) &&
       checkAddress2($data['address2']) &&
       hasPresence($data['city']) &&
       hasPresence($data['county']) &&
       hasPresence($data['country']) &&
       hasPresence($data['postCode']) &&
       hasPresence($data['companyName']) &&
       hasPresence($data['companyProfession']) &&
       hasPresence($data['jobTitle']) &&
       hasPresence($data['department']) &&
       hasPresence($data['companyAddress1']) &&
       checkAddress2($data['companyAddress2']) &&
       hasPresence($data['companyCity']) &&
       hasPresence($data['companyCounty']) &&
       hasPresence($data['companyCountry']) &&
       hasPresence($data['companyPostCode']) &&
       checkPhoneNumbers($data['landlinePrefix'],$data['landlineExt'],$data['landlineNumber'],$data['mobilePrefix'],$data['mobileExt'],$data['mobileNumber'],$data['faxPrefix'],$data['faxExt'],$data['faxNumber']) &&
       hasPresence($data['dataChecked']) &&
       hasPresence($data['legalChecked'])
     )
     {

      //check that the email field is of the correct format
      if(emailIsCorrectFormat($data['email'])){
        //check that the password are both of the correct format
        if(passwordCorrectFormat($data['password'])){
          //check that the confirm password field is of the correct format
          if(passwordCorrectFormat($data['confirmPassword'])){
            //check that both passwords match
            if(passwordsMatch($data['password'], $data['confirmPassword'])){
              //data has validated ok
              return true;
            }else{
              //data validation failed, generate errors and redirect back to the registration page
              $_SESSION['form']="register";
              $_SESSION['registerErrors'] = "<p>Please fix the following errors: </p><ul><li>Passwords do not match</li></ul>";
              return false;
            }
          }else{
            //data validation failed, generate errors and redirect back to the registration page
            $_SESSION['form']="register";
            $_SESSION['registerErrors'] = "<p>Please fix the following errors: </p><ul><li>Confirm Password not correct format</li></ul>";
            return false;
          }
        }else{
          //data validation failed, generate errors and redirect back to the registration page
          $_SESSION['form']="register";
          $_SESSION['registerErrors'] = "<p>Please fix the following errors: </p><ul><li>Password not correct format</li></ul>";
          return false;
        }
      }else{
        //data validation failed, generate errors and redirect back to the registration page
        $_SESSION['form']="register";
        $_SESSION['registerErrors'] = "<p>Please fix the following errors: </p><ul><li>Email not correct format</li></ul>";
        return false;
      }
    }
  }


  function redirect_to($newLocation){
    header("Location: ".$newLocation);
  }

  function sendEmailToClient($firstName, $surname, $email, $sendMessage){
    $to_name=$firstName." ".$surname;
    $to=$email;
    $subject="Thank you for your enquiry";

    $message="<html xmlns=\"http://www.w3.org/1999/xhtml\">
                <body style=\"margin:0; padding:0; color:#FFF; font-family:'Comic Sans MS', cursive; background-color:#FFF;\">
                  <table bgcolor=\"#544747\" style=\"width:50%; height:100%; margin:25px 25%; padding:15px;\" cellpadding=\"0\" cellspacing=\"0\">
                    <tbody>
                      <tr>
                        <td style=\"padding-top:0; padding-bottom:25px;\"><img align=\"left\" alt=\"James McHugh Freelance Web Developer Logo\" src=\"images/logo.png\"/></td>
                      </tr>
                      <tr>
                        <td height=\"50px\">Hello ".$firstName." ".$surname."</td>
                      </tr>
                      <tr>
                        <td height=\"75px\">Thank you for your recent enquiry, your message has been recieved and saved to my system.
                            I will aim to get a reply back to you within 14 working days, this maybe sooner depending on the volume of responses I recieve.</td>
                      </tr>
                      <tr>
                        <td height=\"75px\">However, if you wish for a quicker response or wish to contact me about an urgent matter please send an email to
                          <a style=\"color: #7b818c; text-decoration:none; cursor:pointer\" href=\"mailto:james.mchugh.webdeveloper@gmail.com\">james.mchugh.webdeveloper@gmail.com</a>.</td>
                      </tr>
                      <tr>
                        <td height=\"75px\">Do you have an account with us?</td>
                      </tr>
                      <tr>
                        <td align=\"center\" height=\"100px\">
                          <a href=\"#\" style=\"height:50px; text-decoration:none; background-color:#FFF; border:3px solid #FFF; color: #7b818c; padding:15px 60px; margin-right:50px;\">Login</a>
                          <a href=\"#\" style=\"height:50px; text-decoration:none; background-color:#FFF; border:3px solid #FFF; color: #7b818c; padding:15px 50px; \">Register</a>
                        </td>
                      </tr>
                      <tr>
                        <td height=\"50px\">If you register for an account you can setup and manage projects for free or you can login to your account for the link above.</td>
                      </tr>
                      <tr>
                        <td height=\"75px\">Kind Regards</td>
                      </tr>
                      <tr>
                        <td height=\"50px;\" style=\"padding-left:125px;\">James McHugh</td>
                      </tr>
                  </tbody>
                </table>
              </body>
            </html>";

    $message=wordwrap($message, 70);

    $from_name="James McHugh Web Developer";
    $from="james.mchugh.webdeveloper@gmail.com";

    $mail=new PHPMailer();

    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username ="james.mchugh.webdeveloper";
    $mail->Password="j4m3rs1988uk";

    $mail->FromName=$from_name;
    $mail->From=$from;

    $mail->IsHTML(true);

    $mail->AddAddress($to, $to_name);
    $mail->Subject=$subject;
    $mail->Body=$message;


    $result=$mail->Send();

    if($result){
      return true;
    }else{
      return false;
    }
  }

  function sendEmailToHost($firstName, $surname, $email, $sendMessage){
    $to_name="James McHugh";
  	$to="james.mchugh.webdeveloper@gmail.com";
  	$subject="New message from client";

    $message="<html xmlns=\"http://www.w3.org/1999/xhtml\">
              <body style=\"margin:0; padding:0; color:#FFF; font-family:'Comic Sans MS', cursive; background-color:#FFF;\">
              <table bgcolor=\"#544747\" style=\"width:50%; height:100%; margin:25px 25%; padding:15px;\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody>
                  <tr>
                    <td style=\"padding-top:0; padding-bottom:25px;\"><img align=\"left\" alt=\"James McHugh Freelance Web Developer Logo\" src=\"images/logo.png\"/></td>
                  </tr>
                  <tr>
                    <td height=\"50px\">Hello!</td>
                  </tr>
                  <tr>
                    <td height=\"75px\">You have a new message on the server, please log in to the system to view and reply to this message</td>
                  </tr>
                  <tr>
                    <td height=\"75px\">The message details are as follows: </td>
                  </tr>
                  <tr>
                    <td height=\"75px\">Customer Name: ".$firstName." ".$surname."</td>
                  </tr>
                  <tr>
                    <td height=\"75px\">Email Address: <a href=\"mailto:".$email ."\" style=\"color: #7b818c; text-decoration:none; cursor:pointer\">".$email."</a></td>
                  </tr>
                  <tr>
                    <td height=\"75px\">Comment/Message: ".$sendMessage."</td>
                  </tr>
                  <tr>
                    <td height=\"75px\">Kind Regards</td>
                  </tr>
                  <tr>
                    <td height=\"50px;\" style=\"padding-left:125px;\">Admin</td>
                  </tr>
                </tbody>
              </table>
            </body>
          </html>";


  	$message=wordwrap($message, 70);

  	$from_name="ADMIN ENQUIRY";
  	$from="james.mchugh.webdeveloper@gmail.com";

  	$mail=new PHPMailer();

  	$mail->IsSMTP();
  	$mail->Host = "smtp.gmail.com";
  	$mail->Port = 587;
  	$mail->SMTPAuth = true;
  	$mail->Username ="james.mchugh.webdeveloper";
  	$mail->Password="j4m3rs1988uk";

  	$mail->FromName=$from_name;
  	$mail->From=$from;

    $mail->IsHTML(true);

  	$mail->AddAddress($to, $to_name);

  	$mail->Subject=$subject;
  	$mail->Body=$message;


  	$result=$mail->Send();

    if($result){
      return true;
    }else{
      return false;
    }

  }

  function saveMessage($firstName, $surname, $email, $message){
    global $connection;

    $dbtable="contactformmessages";
    $status="unread";

    $query="INSERT INTO $dbtable ";
    $query.="(firstName, surname, email, message, status)";
    $query.=" VALUES (";
    $query.="'{$firstName}', '{$surname}', '{$email}', '{$message}', '{$status}'";
    $query.=")";

    $result=mysqli_query($connection, $query);

    if(!$result){
      return $result;
    }else{
      return true;
    }
  }

  function getName($userID){
    global $connection;
    $dbtable="users";

    $query="SELECT * ";
    $query.="FROM $dbtable ";
    $query.="WHERE user_id='{$userID}'";

    $result=mysqli_query($connection, $query);

    if($result){
      $row=mysqli_fetch_array($result);
      return $row['forename'] ." ".$row['surname'];
    }else{
      return "User Undefined";
    }
  }


  function loginUser($email, $password){
    //make sure you have imported the database connection before using this function
    //this function logs a user into the system
    global $connection;

    //query setup
    $dbtable="users";

    $query="SELECT * FROM {$dbtable} ";
    $query.="WHERE email_address = '{$email}'";

    //query the database
    $result=mysqli_query($connection, $query);

    //check result
    if(!$result){
      return false;
    }else{
      while($row = mysqli_fetch_array($result)){
        //check password
        $passwordCheck=password_check($password, $row['password']);
        if ($row['email_address']==$email && $passwordCheck) {

          $userID=$row['user_id'];
          $companyID=$row['company_id'];
          setSessionKey("u", $userID);
          setSessionKey("c", $companyID);
          //session expires within 5 mins
          $expires=time()+5*60;
          setSessionKey("exp", null);
          setSessionKey("exp", $expires);
          return true;
        }else{
          return false;
        }
      }
    }
  }

  function companyExists($companyName){
    global $connection;

    $dbtable="companies";

    $query="SELECT company_name FROM {$dbtable} ";
    $query.="WHERE company_name='{$companyName}' ";
    $query.="LIMIT 1";

    $result=mysqli_query($connection, $query);

    if($result){
      $rows=mysqli_num_rows($result);
      if($rows > 0){
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  function userExists($email){
    //make sure you have imported the database connection before using this function
    //this function checks that a user exists within the database
    global $connection;

    $dbtable="users";

    $query="SELECT email_address FROM {$dbtable} ";
    $query.="WHERE email_address='{$email}' ";
    $query.="LIMIT 1";

    $result=mysqli_query($connection, $query);

    if($result){
      $rows=mysqli_num_rows($result);
      if($rows>0){
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  function deleteCompany($companyID){
    global $connection;

    $dbtable="companies";

    $query="ALTER TABLE {$dbtable} AUTO_INCREMENT = {$companyID}";

    $query2="DELETE FROM {$dbtable}";
    $query2.=" WHERE company_id = {$companyID}";

    $result=mysqli_query($connection, $query);

    if($result){

      $result2=mysqli_query($connection, $query2);

      if($result2){
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  function registerNewCompany($data){
    //make sure you have imported the database connection before using this functiom
    //this function registers a new company onto the database
    global $connection;

    $dbtable="companies";

    $query="INSERT INTO {$dbtable} ";
    $query.="(company_name, profession, address_1, address_2, city, county, country, postcode)";
    $query.=" VALUES ";
    $query.="('{$data['companyName']}','{$data['companyProfession']}','{$data['companyAddress1']}','{$data['companyAddress2']}','{$data['companyCity']}','{$data['companyCounty']}','{$data['companyCountry']}','{$data['companyPostCode']}')";

    $result=mysqli_query($connection, $query);

    if($result){
      $query2="SELECT company_id FROM {$dbtable} WHERE company_name = '{$data['companyName']}'";
      $result2=mysqli_query($connection, $query2);
      if($result2){
        $row = mysqli_fetch_assoc($result2);
        return $row['company_id'];
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  function registerNewUser($data,  $companyID){
    //make sure you have imported the database connection before using this function
    //this function registers a new user onto the database
    global $connection;

    $dbtable="users";

    //secures the password
    $securedPassword=securePassword($data['password']);

    $query="INSERT INTO {$dbtable} ";
    $query.="(
              company_id,
              email_address,
              password,
              title,
              forename,
              surname,
              address1,
              address2,
              city,
              county,
              country,
              postCode,
              job_title,
              department,
              landline_prefix,
              landline_ext,
              landline_number,
              mobile_prefix,
              mobile_ext,
              mobile_number,
              fax_prefix,
              fax_ext,
              fax_number,
              legal_check,
              data_check,
              primaryUser,
              Admin,
              addCards,
              editCards,
              deleteCards,
              addCompanies,
              editCompanies,
              deleteCompanies,
              editContactFormMessages,
              deleteContactFormMessages,
              addDatabases,
              editDatabases,
              deleteDatabases,
              addGraphics,
              editGraphics,
              deleteGraphics,
              addLogos,
              editLogos,
              deleteLogos,
              addNotes,
              editNotes,
              deleteNotes,
              addOther,
              editOther,
              deleteOther,
              addProjects,
              editProjects,
              deleteProjects,
              addServices,
              editServices,
              deleteServices,
              addUsers,
              editUsers,
              deleteUsers,
              addWebsites,
              editWebsites,
              deleteWebsites,
              account_status
            )";
    $query.=" VALUES ";
    $query.="(
                {$companyID},
                '{$data['email']}',
                '{$securedPassword}',
                '{$data['title']}',
                '{$data['forename']}',
                '{$data['surname']}',
                '{$data['address1']}',
                '{$data['address2']}',
                '{$data['city']}',
                '{$data['county']}',
                '{$data['country']}',
                '{$data['postCode']}',
                '{$data['jobTitle']}',
                '{$data['department']}',
                '{$data['landlinePrefix']}',
                '{$data['landlineExt']}',
                '{$data['landlineNumber']}',
                '{$data['mobilePrefix']}',
                '{$data['mobileExt']}',
                '{$data['mobileNumber']}',
                '{$data['faxPrefix']}',
                '{$data['faxExt']}',
                '{$data['faxNumber']}',
                {$data['legalChecked']},
                {$data['dataChecked']},
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                1,
                'active'
              )";

    $result=mysqli_query($connection, $query);

    if($result){
      if(isset($_SESSION['u'])){
        session_unset();
        session_destroy();
        session_start();
      }

      $query2="SELECT user_id FROM {$dbtable} WHERE email_address = '{$data['email']}'";
      $result2=mysqli_query($connection, $query2);

      if($result2){
        $row = mysqli_fetch_assoc($result2);
        return $row['user_id'];
      }else{
        return false;
      }
    }else{
      // die(mysqli_error($connection) . "<br/>" . $query);
      return false;
    }
  }

  function validateNewProjectData($data){
    $valid=false;

    if(isset($data['projectName'])){
      if($data['projectName']=="" || $data['projectName'] == null){
        $valid=false;
      }else{
        $valid=true;
      }
    }else{
      $valid=false;
    }

    if(isset($data['website']) && $data['website'] != "" && $data['website']!=null){
      if($data['website'] == 1 || $data['website'] == "1"){
        if(isset($data['websiteAction']) && $data['websiteAction'] != "" && $data['websiteAction'] !=null){
          $valid=true;
        }else{
          $valid=false;
        }
        if(isset($data['numberOfPages']) && $data['numberOfPages'] != "" && $data['numberOfPages'] !=null){
          $valid=true;
        }else{
          $valid=false;
        }
        if(isset($data['numberOfPages']) && $data['numberOfPages'] != "" && $data['numberOfPages'] !=null){
          $valid=true;
        }else{
          $valid=false;
        }
      }else{
        $valid=true;
      }
    }else{
      $valid=false;
    }

    if(isset($data['database']) && $data['database'] !="" && $data['database'] != null){
      if($data['database'] == 1 || $data['database'] == "1"){
        if(isset($data['databaseAction']) && $data['databaseAction'] != "" && $data['databaseAction'] !=null){
          $valid=true;
        }else{
          $valid=false;
        }
        if(isset($data['relational']) && $data['relational'] != "" && $data['relational'] !=null){
          $valid=true;
        }else{
          $valid=false;
        }
        if(isset($data['dbDesign']) && $data['dbDesign'] != "" && $data['dbDesign'] !=null){
          $valid=true;
        }else{
          $valid=false;
        }
        if(isset($data['numberOfTables']) && $data['numberOfTables'] != "" && $data['numberOfTables'] !=null){
          $valid=true;
        }else{
          $valid=false;
        }
        if(isset($data['databaseDetails']) && $data['databaseDetails'] != "" && $data['databaseDetails'] !=null){
          $valid=true;
        }else{
          $valid=false;
        }
      }else{
        $valid=true;
      }
    }else{
      $valid=false;
    }

    if(isset($data['logo']) && $data['logo'] != "" && $data['logo'] != null){
      if($data['logo'] == 1 || $data['logo'] == "1"){
        if(isset($data['logoAction']) && $data['logoAction'] != "" && $data['logoAction'] != null){
            $valid=true;
        }else{
          $valid=false;
        }
        if(isset($data['logoDetails']) && $data['logoDetails'] != "" && $data['logoDetails'] != null){
            $valid=true;
        }else{
          $valid=false;
        }
      }else{
        $valid=false;
      }
    }else{
      $valid=false;
    }

    if(isset($data['graphics']) && $data['graphics'] != "" && $data['graphics'] != null){
      if(isset($data['graphicsAction']) && $data['graphicsAction'] == "" && $data['graphicsAction'] == null){
        $valid=true;
      }else{
        $valid=false;
      }
      if(isset($data['graphicsDetails']) && $data['graphicsDetails'] == "" && $data['graphicsDetails'] == null){
        $valid=true;
      }else{
        $valid=false;
      }
    }else{
      $valid=false;
    }

    if(isset($data['other']) && $data['other'] !="" && $data['other'] != null){
      if($data['other'] == 1 || $data['other'] =="1"){
        if(isset($data['otherDetails']) &&   $data['otherDetails'] != "" &&   $data['otherDetails'] !=null){
          $valid=true;
        }else{
          $valid=false;
        }
      }else{
        $valid=false;
      }
    }else{
      $valid=false;
    }

    if(isset($data['projectDetails']) && $data['projectDetails'] !="" && $data['projectDetails'] != null){
      $valid=true;
    }else{
      $valid=false;
    }

    return $valid;

  }

  function resetOther($projectID){
    global $connection;
    // delete the last record
    //select all from the database to get the number of rows
    //reset the auto increment [2 queries]

    $dbtableOther="other";

    $query1="DELETE FROM $dbtableOther ";
    $query1.="WHERE project_id={$projectID}";

    $result1=mysqli_query($connection, $query1);

    if($result1){
      $query2="SELECT * FROM $dbtableOther";
      $result2=mysqli_query($connection, $query2);
      if($result2){
        $numRows=mysqli_num_rows($result2);
        $numRows++;
        $query3="ALTER TABLE $dbtableOther AUTO_INCREMENT=$numRows";
        $result3=mysqli_query($connection, $query3);
        if($result3){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }else{
      return false;
    }

  }

  function newOther($data, $projectID){
    global $connection;
    $status="in progress";
    $dbtableOther="other";

    //data here
    $otherDetails=$data['otherDetails'];

    $query="INSERT INTO $dbtableOther ";
    $query.="(project_id, details, status)";
    $query.=" VALUES ";
    $query.="('{$projectID}', '{$otherDetails}','{$status}')";

    $result=mysqli_query($connection, $query);

    if($result){
      return true;
    }else{
      return false;
    }
  }

  function resetGraphics($projectID, $dbtableGraphics){
    global $connection;
    // delete the last record
    //select all from the database to get the number of rows
    //reset the auto increment [2 queries]

    $dbtableGraphics="graphics";

    $query1="DELETE FROM $dbtableGraphics ";
    $query1.="WHERE project_id={$projectID}";

    $result1=mysqli_query($connection, $query1);

    if($result1){
      $query2="SELECT * FROM $dbtableGraphics";
      $result2=mysqli_query($connection, $query2);
      if($result2){
        $numRows=mysqli_num_rows($result2);
        $numRows++;
        $query3="ALTER TABLE $dbtableGraphics AUTO_INCREMENT=$numRows";
        $result3=mysqli_query($connection, $query3);
        if($result3){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }else{
      return false;
    }

  }

  function newGraphics($data, $projectID){
    global $connection;
    $status="in progress";
    $dbtableGraphics="graphics";

    //data here
    $graphicsAction=$data['graphicsAction'];
    $graphicsDetails=$data['graphicsDetails'];

    $query="INSERT INTO $dbtableGraphics ";
    $query.="(project_id, action_to_be_taken, details, status)";
    $query.=" VALUES ";
    $query.="('{$projectID}','{$graphicsAction}','{$graphicsDetails}', '{$status}')";

    $result=mysqli_query($connection, $query);

    if($result){
      return true;
    }else{
      return false;
    }
  }

  function resetLogo($projectID){
    global $connection;
    // delete the last record
    //select all from the database to get the number of rows
    //reset the auto increment [2 queries]

    $dbtableLogos="logos";

    $query1="DELETE FROM $dbtableLogos ";
    $query1.="WHERE project_id={$projectID}";

    $result1=mysqli_query($connection, $query1);

    if($result1){
      $query2="SELECT * FROM $dbtableLogos";
      $result2=mysqli_query($connection, $query2);
      if($result2){
        $numRows=mysqli_num_rows($result2);
        $numRows++;
        $query3="ALTER TABLE $dbtableLogos AUTO_INCREMENT=$numRows";
        $result3=mysqli_query($connection, $query3);
        if($result3){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }else{
      return false;
    }

  }

  function newLogo($data, $projectID){
    global $connection;
    $status="in progress";
    $dbtableLogos="logos";

    //data here
    $logosAction=$data['logoAction'];
    $logosDetails=$data['logoDetails'];

    $query="INSERT INTO $dbtableLogos ";
    $query.="(project_id, action_to_be_taken, details, status)";
    $query.=" VALUES ";
    $query.="('{$projectID}','{$logosAction}','{$logosDetails}','{$status}')";

    $result=mysqli_query($connection, $query);

    if($result){
      return true;
    }else{
      return false;
    }
  }

  function resetDatabase($projectID){
    global $connection;
    // delete the last record
    //select all from the database to get the number of rows
    //reset the auto increment [2 queries]

    $dbtableDatabases="databasesDB";

    $query1="DELETE FROM $dbtableDatabases ";
    $query1.="WHERE project_id={$projectID}";

    $result1=mysqli_query($connection, $query1);

    if($result1){
      $query2="SELECT * FROM $dbtableDatabases";
      $result2=mysqli_query($connection, $query2);
      if($result2){
        $numRows=mysqli_num_rows($result2);
        $numRows++;
        $query3="ALTER TABLE $dbtableDatabases AUTO_INCREMENT=$numRows";
        $result3=mysqli_query($connection, $query3);
        if($result3){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }else{
      return false;
    }

  }

  function newDatabase($data, $projectID){
    global $connection;
    $status="in progress";
    $dbtableDatabases="databasesDB";

    //data here
    $databasesAction=$data['databaseAction'];
    $relational=$data['relational'];
    $dbDesign=$data['dbDesign'];
    $numberOfTables=$data['numberOfTables'];
    $databaseDetails=$data['databaseDetails'];

    $query="INSERT INTO $dbtableDatabases ";
    $query.="(project_id, action_to_be_taken, relational, dbDesign, numberOfTables, details, status)";
    $query.=" VALUES ";
    $query.="('{$projectID}','{$databasesAction}',{$relational},{$dbDesign},{$numberOfTables},'{$databaseDetails}','{$status}')";

    $result=mysqli_query($connection, $query);

    if($result){
      return true;
    }else{
      return false;
    }

  }

  function resetWebsite($projectID){
    global $connection;
    // delete the last record
    //select all from the database to get the number of rows
    //reset the auto increment [2 queries]

    $dbtableWebsites="websites";

    $query1="DELETE FROM $dbtableWebsites ";
    $query1.="WHERE project_id={$projectID}";

    $result1=mysqli_query($connection, $query1);

    if($result1){
      $query2="SELECT * FROM $dbtableWebsites";
      $result2=mysqli_query($connection, $query2);
      if($result2){
        $numRows=mysqli_num_rows($result2);
        $numRows++;
        $query3="ALTER TABLE $dbtableWebsites AUTO_INCREMENT=$numRows";
        $result3=mysqli_query($connection, $query3);
        if($result3){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }else{
      return false;
    }

  }

  function newWebsite($data, $projectID){
    //sets up a new website

    global $connection;
    $status="in progress";
    $dbtableWebsites="websites";

    $websitesAction=$data['websiteAction'];
    $numberOfPages=$data['numberOfPages'];
    $websitesDetails=$data['websiteDetails'];

    $query="INSERT INTO $dbtableWebsites ";
    $query.="(project_id, action_to_be_taken, numberOfPages, details, status)";
    $query.=" VALUES ";
    $query.="('{$projectID}','{$websitesAction}',{$numberOfPages},'{$websitesDetails}','{$status}')";

    $result=mysqli_query($connection, $query);

    if($result){
      return true;
    }else{
      return false;
    }
  }

  function resetProject($projectID){
    global $connection;
    // delete the last record
    //select all from the database to get the number of rows
    //reset the auto increment [3 queries]

    $dbtableProjects="projects";

    $query1="DELETE FROM $dbtableProjects ";
    $query1.="WHERE project_id={$projectID}";

    $result1=mysqli_query($connection, $query1);

    if($result1){
      $query2="SELECT * FROM $dbtableProjects";
      $result2=mysqli_query($connection, $query2);
      if($result2){
        $numRows=mysqli_num_rows($result2);
        $numRows++;
        $query3="ALTER TABLE $dbtableProjects AUTO_INCREMENT=$numRows";
        $result3=mysqli_query($connection, $query3);
        if($result3){
          unsetSessionKey("p");
          return true;
        }else{
          unsetSessionKey("p");
          return false;
        }
      }else{
        unsetSessionKey("p");
        return false;
      }
    }else{
      unsetSessionKey("p");
      return false;
    }
  }

  function newProject($data){
    //sets up a new project

    global $connection;

    if(isset($_SESSION['c'])){
      $companyID=$_SESSION['c'];
    }else{
      // $companyID=0;
      $companyID=1;
    }

    $projectName=$data['projectName'];
    $websites=$data['website'];
    $databases=$data['database'];
    $logos=$data['logo'];
    $graphics=$data['graphics'];
    $other=$data['other'];
    $projectDetails=$data['projectDetails'];
    $status="in progress";
    $dateCreated=gmdate("Y-m-d");

    $dbtableProjects="projects";

    $query="INSERT INTO $dbtableProjects ";
    $query.="(company_id, project_name, websites, databasesDB, logos, graphics, project_details, date_created, status)";
    $query.=" VALUES ";
    $query.="('{$companyID}', '{$projectName}','{$websites}','{$databases}','{$logos}','{$graphics}','{$projectDetails}','{$dateCreated}','{$status}')";

    $result=mysqli_query($connection, $query);

    if($result){
      $id= mysqli_insert_id($connection);
      setSessionKey("p", $id);
      return $id;
    }else{
      return "no id";
    }
  }

  function registerNewProjectFull($data){
    global $connection;
    $response=false;

    $projectID=newProject($data);
    if($projectID=="no id"){
      $response="project not registered";
      die($response);
    }else{
      if($data['website'] ==1 || $data['website'] =="1"){
        $websiteRegistered=newWebsite($data, $projectID);
        if($websiteRegistered){
          $response=true;
        }else{
          resetWebsite($projectID);
          resetQuotation($projectID);
          resetProject($projectID);
          $response=null;
          $response = "website not registered";
          die($response);
        }
      }

      if($data['database'] ==1 || $data['database'] == "1"){
        $databaseRegistered=newDatabase($data, $projectID);
        if($databaseRegistered){
          $response=true;
        }else{
          resetWebsite($projectID);
          resetDatabase($projectID);
          resetProject($projectID);
          $response=null;
          $response="database not registered";
          die($response);
        }
      }

      if($data['logo']==1 || $data['logo'] ==  "1"){
        $logoRegistered=newLogo($data, $projectID);
        if($logoRegistered){
          $response=true;
        }else{
          resetQuotation($projectID);
          resetProject($projectID);
          resetWebsite($projectID);
          resetDatabase($projectID);
          resetLogo($projectID);
          resetProject($projectID);
          $response=null;
          $response="logo not registered";
          die($response);
        }
      }

      if($data['graphics']==1 || $data['graphics'] ="1"){
        $graphicsRegistered=newGraphics($data, $projectID);
        if($graphicsRegistered){
          $response=true;
        }else{
          resetWebsite($projectID);
          resetDatabase($projectID);
          resetLogo($projectID);
          resetGraphics($projectID, $dbtableGraphics);
          resetProject($projectID);
          $response=null;
          $response="graphics not registered";
          die($response);
        }
      }

      if($data['other']==1 || $data['other']="1"){
        $otherRegistered=newOther($data, $projectID);
        if($otherRegistered){
          $response=true;
        }else{
          resetWebsite($projectID);
          resetDatabase($projectID);
          resetLogo($projectID);
          resetGraphics($projectID, $dbtableGraphics);
          resetOther($projectID);
          resetProject($projectID);
          $response=null;
          $response="other not registered";
          die($response);
        }
      }
    }

    return $response;
    // extend functionality to provide a reset when a failure occurs
    //any data in the previous tables must be deleted, including any projects/quotations
  }
?>
