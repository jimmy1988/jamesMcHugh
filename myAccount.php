<?php
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

	//import all of the functions
	require_once($root."/php/functions/functions.php");

	//check if a user has been set and whether the session has expired
	if(isset($_SESSION['uI']) && !sessionExpired()){
		//proceed onto the page, session is then refreshed
		$_SESSION['exp']=time()+10*60;

		//import database connections and functions
		require_once("php/components/database/dbConn.php");
		require_once("php/components/database/secureDatabase.php");

		$userDetails=getUserDetailsByID($_SESSION['uI']);
		if(!$userDetails){
			redirect_to("mainMenu.php");
		}

		$companyDetails=getCompanyDetailsByID($userDetails['company_id']);

		if(!$companyDetails){
			redirect_to("mainMenu.php");
		}
	}else{
		//session either was not set or has expired, redirect back to the login screen
		$_SESSION['loginErrors']  = "<p>Your session has expired after 10 minutes of inactivity, please relogin to gain access to the system</p>";
		redirect_to("newBookingLogin.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			global $root;
			$path=basename(__FILE__,'.php');

			$pathString=str_split($path);

			include($root.'/php/components/header.php');
			$newString="";
			$i=0;
			for($j=0; $j <= count($pathString); $j++){

				if($j == count($pathString)){
					$arrayPath[$i]=$newString;
					$newString=null;
					$i=null;
					$newString=null;
				}else{
					if( ($pathString[$j] == strtoupper($pathString[$j])) ){
						$arrayPath[$i]=$newString;
						$i++;
						$newString="";
						$newString=$newString.$pathString[$j];

					}else{
						$newString = $newString.$pathString[$j];
					}
				}

			}

			$string;

			for($i=0;$i< count($arrayPath);$i++){
				if($i==0){
					$string=ucwords($arrayPath[0]);
				}else{
					$string=$string." ".ucwords($arrayPath[$i]);
				}
			}

			if($path == 'basic'){
				echo '<title>James McHugh Freelance Web Developer</title>';
			}else{
				if($path =='index'){
					echo '<title>James McHugh Freelance Web Developer</title>';
				}else{
					echo '<title>'.$string.' - James McHugh Freelance Web Developer</title>';
				}
			}

			if($path!="basic"){
				echo '<link type="text/css" rel="stylesheet" href="css/'.$path.'/style.css?"'. date('l jS \of F Y h:i:s A') .' />';
			}
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>

		<!--Start of container-->
		<div id="container">

			<?php include($root.'/php/components/top.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/menu.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/membersBar.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/noScript.php'); ?>

			<div class="clear"></div>

			<div id="contentLayer"></div>

			<div class="clear"></div>

			<div class="main" id="content">
				<div id="innerContent" class="inner">
					<h2 id="title">My Account</h2>
					<p id="pageInstructions"><em>Here you can modify your details and save them to the system and keep them up to date</em></p>

					<form id="userDetails" name="userDetails" method="post" action="php/saveUser.php">
						<strong class="information">All fields with a <i class="fa fa-asterisk"></i> are compulsory</strong>
						<div class="errors" id="errorsUserDetails">
							<?php
								if(isset($_SESSION['userDetailsErrors']) && !empty($_SESSION['userDetailsErrors'])){
									echo $_SESSION['userDetailsErrors'];
									unset($_SESSION['userDetailsErrors']);
								}
							?>
						</div>
						<fieldset>
							<legend>Account Details</legend>
							<div class="field" id="emailRegisterSection">
								<i class="fa fa-asterisk"></i>
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Email: </label>
								<input class="NQLREmail" type="email" name="emailRegister" id="emailRegister" autocomplete="off" placeholder="Please Enter Your Email Address" value="<?php echo $userDetails['email_address']; ?>">
							</div>
							<div class="field" id="passwordRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i>New Password: </label>
								<input class="NQLRPassword" type="password" name="passwordRegister" id="passwordRegister" autocomplete="off" placeholder="Enter Your Password" value="">
								<strong class="information">Fill In This Field When You Are Intending to Change Your Password</strong>
							</div>
						</fieldset>

						<fieldset>
							<legend>Contact information</legend>
							<em>Country codes are filled in automatically when you fill in the country field, if this is incorrect you can choose to enter them manually. <br/>
									Please enter an extension to reach you on, if hou do not have one just enter &quot;0&quot;
							</em>
							<div class="field" id="landlineRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Landline: </label>
								<span class="numberSpan">
									<strong class="plus">+</strong>
									<input class="NQLRText contact" name="landlinePrefix" id="landlinePrefixRegister" type="text" maxlength="6" value="<?php if(!empty($userDetails['landline_prefix'])){ echo $userDetails['landline_prefix']; }else{ echo "0"; } ?>" placeholder="Please Enter the country code of your company">
									<input class="NQLRText contact" name="landlineExt" id="landlineExtRegister" type="text" maxlength="10" value="<?php if(!empty($userDetails['landline_ext'])){ echo $userDetails['landline_ext']; }else{ echo "0"; } ?>" placeholder="Please enter your extension">
									<input class="NQLRText contact" name="landlineNumber" id="landlineNumberegister" type="text" maxlength="30" value="<?php if(!empty($userDetails['landline_number'])){ echo $userDetails['landline_number']; }else{ echo "0"; } ?>" placeholder="Please Enter Your Landline Number">
								</span>
							</div>
							<div class="field" id="mobilelRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Mobile: </label>
								<span class="numberSpan">
									<strong class="plus">+</strong>
									<input class="NQLRText contact" name="mobilePrefix" id="mobilePrefixRegister" type="text" maxlength="6" value="<?php if(!empty($userDetails['mobile_prefix'])){ echo $userDetails['mobile_prefix']; }else{ echo "0"; } ?>" placeholder="Please Enter the country code of your company">
									<input class="NQLRText contact" name="mobileExt" id="mobileExtRegister" type="text" maxlength="10" value="<?php if(!empty($userDetails['mobile_ext'])){ echo $userDetails['mobile_ext']; }else{ echo "0"; } ?>" placeholder="Please enter your extension">
									<input class="NQLRText contact" name="mobileNumber" id="mobileNumberegister" type="text" maxlength="30" placeholder="Please Enter Your Mobile Number" value="<?php if(!empty($userDetails['mobile_number'])){ echo $userDetails['mobile_number']; }else{ echo "0"; } ?>">
								</span>
							</div>
							<div class="field" id="faxRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Fax: </label>
								<span class="numberSpan">
									<strong class="plus">+</strong>
									<input class="NQLRText contact" name="faxPrefix" id="faxPrefixRegister" type="text" maxlength="6" value="<?php if(!empty($userDetails['fax_prefix'])){ echo $userDetails['fax_prefix']; }else{ echo "0"; } ?>" placeholder="Please Enter the country code of your company">
									<input class="NQLRText contact" name="faxExt" id="landlineExtRegister" type="text" maxlength="10" value="<?php if(!empty($userDetails['fax_ext'])){ echo $userDetails['fax_ext']; }else{ echo "0"; } ?>" placeholder="Please enter your extension">
									<input class="NQLRText contact" name="faxNumber" id="faxNumberegister" type="text" maxlength="30" placeholder="Please Enter Your Fax Number" value="<?php if(!empty($userDetails['fax_number'])){ echo $userDetails['fax_number']; }else{ echo "0"; } ?>">
								</span>
							</div>
						</fieldset>

						<fieldset>
							<legend>Personal Details</legend>
							<div class="field" id="titleRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Title: </label>
								<select class="NQLRSelect" name="title" id="titleRegister">
										<option value="No Select" <?php if($userDetails['title'] == "No Select" || !isset($userDetails['title'])){ echo "selected=selected"; }?>>Please Select..</option>
										<option value="Mr" <?php if($userDetails['title'] == "Mr"){ echo "selected=selected"; }?>>Mr</option>
										<option value="Mrs" <?php if($userDetails['title'] == "Mrs"){ echo "selected=selected"; }?>>Mrs</option>
										<option value="Miss" <?php if($userDetails['title'] == "Miss"){ echo "selected=selected"; }?>>Miss</option>
										<option value="Ms" <?php if($userDetails['title'] == "Ms"){ echo "selected=selected"; }?>>Ms</option>
										<option value="Dame" <?php if($userDetails['title'] == "Dame"){ echo "selected=selected"; }?>>Dame</option>
										<option value="Sir" <?php if($userDetails['title'] == "Sir"){ echo "selected=selected"; }?>>Sir</option>
										<option value="Lord" <?php if($userDetails['title'] == "Lord"){ echo "selected=selected"; }?>>Lord</option>
										<option value="Lady" <?php if($userDetails['title'] == "Lady"){ echo "selected=selected"; }?>>Lady</option>
										<option value="HRH" <?php if($userDetails['title'] == "HRH"){ echo "selected=selected"; }?>>HRH</option>
								</select>
							</div>
							<div class="field" id="forenameRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Forename: </label>
								<input class="NQLRText" type="text" name="forename" id="forenameRegister" placeholder="Please Enter Your Forename" value="<?php echo $userDetails['forename']; ?>">
							</div>
							<div class="field" id="surnameRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Surname: </label>
								<input class="NQLRText" type="text" name="surname" id="surnameRegister" placeholder="Please Enter Your Surname" value="<?php echo $userDetails['surname']; ?>">
							</div>
							<div class="field" id="address1RegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Address 1: </label>
								<input class="NQLRText" type="text" name="address1" id="address1Register"  placeholder="Please Enter The First Line Of Your Address" value="<?php echo $userDetails['address1']; ?>">
								<p class="addressSub">(Your home address)</p>
							</div>
							<div class="field" id="address2RegisterSection">
								<label class="NQLRLabel"> Address 2: </label>
								<input class="NQLRText" type="text" name="address2" id="address2Register"  placeholder="Please Enter The Second Line Of Your Address" value="<?php echo $userDetails['address2']; ?>">
								<p class="addressSub">(Your home address)</p>
							</div>
							<div class="field" id="cityRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> City: </label>
								<input class="NQLRText" type="text" id="cityRegister" name="city" placeholder="Please Enter The City" value="<?php echo $userDetails['city']; ?>">
								<p class="addressSub">(Your home address)</p>
							</div>
							<div class="field" id="countyRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> County/State/Province: </label>
								<input class="NQLRText" type="text" id="countyRegister" name="county" placeholder="Please Enter The County/State/Province" value="<?php echo $userDetails['county']; ?>">
								<p class="addressSub">(Your home address)</p>
							</div>
							<div class="field" id="countryRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Country: </label>
								<select  class="NQLRSelect" name="country" id="countryRegister">
										<option value="No Select" <?php if($userDetails['country'] == "No Select" || !isset($userDetails['country'])){ echo "selected = selected" ; } ?>>Please Select..</option>
										<option value="United Kingdom" <?php if($userDetails['country'] == "United Kingdom"){ echo "selected = selected" ; } ?>>United Kingdom</option>
										<option value="Afghanistan" <?php if($userDetails['country'] == "Afghanistan"){ echo "selected = selected" ; } ?>>Afghanistan</option>
										<option value="Åland Islands" <?php if($userDetails['country'] == "Åland Islands"){ echo "selected = selected" ; } ?>>Åland Islands</option>
										<option value="Albania" <?php if($userDetails['country'] == "Albania"){ echo "selected = selected" ; } ?>>Albania</option>
										<option value="Algeria" <?php if($userDetails['country'] == "Algeria"){ echo "selected = selected" ; } ?>>Algeria</option>
										<option value="American Samoa" <?php if($userDetails['country'] == "American Samoa"){ echo "selected = selected" ; } ?>>American Samoa</option>
										<option value="Andorra" <?php if($userDetails['country'] == "Andorra"){ echo "selected = selected" ; } ?>>Andorra</option>
										<option value="Angola" <?php if($userDetails['country'] == "Angola"){ echo "selected = selected" ; } ?>>Angola</option>
										<option value="Anguilla" <?php if($userDetails['country'] == "Anguilla"){ echo "selected = selected" ; } ?>>Anguilla</option>
										<option value="Antarctica" <?php if($userDetails['country'] == "Antarctica"){ echo "selected = selected" ; } ?>>Antarctica</option>
										<option value="Antigua and Barbuda" <?php if($userDetails['country'] == "Antigua and Barbuda"){ echo "selected = selected" ; } ?>>Antigua and Barbuda</option>
										<option value="Argentina" <?php if($userDetails['country'] == "Argentina"){ echo "selected = selected" ; } ?>>Argentina</option>
										<option value="Armenia" <?php if($userDetails['country'] == "Armenia"){ echo "selected = selected" ; } ?>>Armenia</option>
										<option value="Aruba" <?php if($userDetails['country'] == "Aruba"){ echo "selected = selected" ; } ?>>Aruba</option>
										<option value="Australia" <?php if($userDetails['country'] == "Australia"){ echo "selected = selected" ; } ?>>Australia</option>
										<option value="Austria" <?php if($userDetails['country'] == "Austria"){ echo "selected = selected" ; } ?>>Austria</option>
										<option value="Azerbaijan" <?php if($userDetails['country'] == "Azerbaijan"){ echo "selected = selected" ; } ?>>Azerbaijan</option>
										<option value="Bahamas" <?php if($userDetails['country'] == "Bahamas"){ echo "selected = selected" ; } ?>>Bahamas</option>
										<option value="Bahrain" <?php if($userDetails['country'] == "Bahrain"){ echo "selected = selected" ; } ?>>Bahrain</option>
										<option value="Bangladesh" <?php if($userDetails['country'] == "Bangladesh"){ echo "selected = selected" ; } ?>>Bangladesh</option>
										<option value="Barbados" <?php if($userDetails['country'] == "Barbados"){ echo "selected = selected" ; } ?>>Barbados</option>
										<option value="Belarus" <?php if($userDetails['country'] == "Belarus"){ echo "selected = selected" ; } ?>>Belarus</option>
										<option value="Belgium" <?php if($userDetails['country'] == "Belgium"){ echo "selected = selected" ; } ?>>Belgium</option>
										<option value="Belize" <?php if($userDetails['country'] == "Belize"){ echo "selected = selected" ; } ?>>Belize</option>
										<option value="Benin" <?php if($userDetails['country'] == "Benin"){ echo "selected = selected" ; } ?>>Benin</option>
										<option value="Bermuda" <?php if($userDetails['country'] == "Bermuda"){ echo "selected = selected" ; } ?>>Bermuda</option>
										<option value="Bhutan" <?php if($userDetails['country'] == "Bhutan"){ echo "selected = selected" ; } ?>>Bhutan</option>
										<option value="Bolivia" <?php if($userDetails['country'] == "Bolivia"){ echo "selected = selected" ; } ?>>Bolivia</option>
										<option value="Bosnia and Herzegovina" <?php if($userDetails['country'] == "Bosnia and Herzegovina"){ echo "selected = selected" ; } ?>>Bosnia and Herzegovina</option>
										<option value="Botswana" <?php if($userDetails['country'] == "Botswana"){ echo "selected = selected" ; } ?>>Botswana</option>
										<option value="Brazil" <?php if($userDetails['country'] == "Brazil"){ echo "selected = selected" ; } ?>>Brazil</option>
										<option value="British Indian Ocean Territory" <?php if($userDetails['country'] == "British Indian Ocean Territory"){ echo "selected = selected" ; } ?>>British Indian Ocean Territory</option>
										<option value="Brunei Darussalam" <?php if($userDetails['country'] == "Brunei Darussalam"){ echo "selected = selected" ; } ?>>Brunei Darussalam</option>
										<option value="Bulgaria" <?php if($userDetails['country'] == "Bulgaria"){ echo "selected = selected" ; } ?>>Bulgaria</option>
										<option value="Burkina Faso" <?php if($userDetails['country'] == "Burkina Faso"){ echo "selected = selected" ; } ?>>Burkina Faso</option>
										<option value="Burundi" <?php if($userDetails['country'] == "Burundi"){ echo "selected = selected" ; } ?>>Burundi</option>
										<option value="Cambodia" <?php if($userDetails['country'] == "Cambodia"){ echo "selected = selected" ; } ?>>Cambodia</option>
										<option value="Cameroon" <?php if($userDetails['country'] == "Cameroon"){ echo "selected = selected" ; } ?>>Cameroon</option>
										<option value="Canada" <?php if($userDetails['country'] == "Canada"){ echo "selected = selected" ; } ?>>Canada</option>
										<option value="Cape Verde" <?php if($userDetails['country'] == "Cape Verde"){ echo "selected = selected" ; } ?>>Cape Verde</option>
										<option value="Cayman Islands" <?php if($userDetails['country'] == "Cayman Islands"){ echo "selected = selected" ; } ?>>Cayman Islands</option>
										<option value="Central African Republic" <?php if($userDetails['country'] == "Central African Republic"){ echo "selected = selected" ; } ?>>Central African Republic</option>
										<option value="Chad" <?php if($userDetails['country'] == "Chad"){ echo "selected = selected" ; } ?>>Chad</option>
										<option value="Chile" <?php if($userDetails['country'] == "Chile"){ echo "selected = selected" ; } ?>>Chile</option>
										<option value="China" <?php if($userDetails['country'] == "China"){ echo "selected = selected" ; } ?>>China</option>
										<option value="Christmas Island" <?php if($userDetails['country'] == "Christmas Island"){ echo "selected = selected" ; } ?>>Christmas Island</option>
										<option value="Cocos (Keeling) Islands" <?php if($userDetails['country'] == "Cocos (Keeling) Islands"){ echo "selected = selected" ; } ?>>Cocos (Keeling) Islands</option>
										<option value="Colombia" <?php if($userDetails['country'] == "Colombia"){ echo "selected = selected" ; } ?>>Colombia</option>
										<option value="Comoros" <?php if($userDetails['country'] == "Comoros"){ echo "selected = selected" ; } ?>>Comoros</option>
										<option value="Congo" <?php if($userDetails['country'] == "Congo"){ echo "selected = selected" ; } ?>>Congo</option>
										<option value="Congo, The Democratic Republic of The" <?php if($userDetails['country'] == "Congo, The Democratic Republic of The"){ echo "selected = selected" ; } ?>>Congo, The Democratic Republic of The</option>
										<option value="Cook Islands" <?php if($userDetails['country'] == "Cook Islands"){ echo "selected = selected" ; } ?>>Cook Islands</option>
										<option value="Costa Rica" <?php if($userDetails['country'] == "Costa Rica"){ echo "selected = selected" ; } ?>>Costa Rica</option>
										<option value="Cote D'ivoire" <?php if($userDetails['country'] == "Cote D'ivoire"){ echo "selected = selected" ; } ?>>Cote D'ivoire</option>
										<option value="Croatia" <?php if($userDetails['country'] == "Croatia"){ echo "selected = selected" ; } ?>>Croatia</option>
										<option value="Cuba" <?php if($userDetails['country'] == "Cuba"){ echo "selected = selected" ; } ?>>Cuba</option>
										<option value="Cyprus" <?php if($userDetails['country'] == "Cyprus"){ echo "selected = selected" ; } ?>>Cyprus</option>
										<option value="Czech Republic" <?php if($userDetails['country'] == "Czech Republic"){ echo "selected = selected" ; } ?>>Czech Republic</option>
										<option value="Denmark" <?php if($userDetails['country'] == "Denmark"){ echo "selected = selected" ; } ?>>Denmark</option>
										<option value="Djibouti" <?php if($userDetails['country'] == "Djibouti"){ echo "selected = selected" ; } ?>>Djibouti</option>
										<option value="Dominica" <?php if($userDetails['country'] == "Dominica"){ echo "selected = selected" ; } ?>>Dominica</option>
										<option value="Dominican Republic" <?php if($userDetails['country'] == "Dominican Republic"){ echo "selected = selected" ; } ?>>Dominican Republic</option>
										<option value="Ecuador" <?php if($userDetails['country'] == "Ecuador"){ echo "selected = selected" ; } ?>>Ecuador</option>
										<option value="Egypt" <?php if($userDetails['country'] == "Egypt"){ echo "selected = selected" ; } ?>>Egypt</option>
										<option value="El Salvador" <?php if($userDetails['country'] == "El Salvador"){ echo "selected = selected" ; } ?>>El Salvador</option>
										<option value="Equatorial Guinea" <?php if($userDetails['country'] == "Equatorial Guinea"){ echo "selected = selected" ; } ?>>Equatorial Guinea</option>
										<option value="Eritrea" <?php if($userDetails['country'] == "Eritrea"){ echo "selected = selected" ; } ?>>Eritrea</option>
										<option value="Estonia" <?php if($userDetails['country'] == "Estonia"){ echo "selected = selected" ; } ?>>Estonia</option>
										<option value="Ethiopia" <?php if($userDetails['country'] == "Ethiopia"){ echo "selected = selected" ; } ?>>Ethiopia</option>
										<option value="Falkland Islands (Malvinas)" <?php if($userDetails['country'] == "Falkland Islands (Malvinas)"){ echo "selected = selected" ; } ?>>Falkland Islands (Malvinas)</option>
										<option value="Faroe Islands" <?php if($userDetails['country'] == "Faroe Islands"){ echo "selected = selected" ; } ?>>Faroe Islands</option>
										<option value="Fiji" <?php if($userDetails['country'] == "Fiji"){ echo "selected = selected" ; } ?>>Fiji</option>
										<option value="Finland" <?php if($userDetails['country'] == "Finland"){ echo "selected = selected" ; } ?>>Finland</option>
										<option value="France" <?php if($userDetails['country'] == "France"){ echo "selected = selected" ; } ?>>France</option>
										<option value="French Guiana" <?php if($userDetails['country'] == "French Guiana"){ echo "selected = selected" ; } ?>>French Guiana</option>
										<option value="French Polynesia" <?php if($userDetails['country'] == "No Select"){ echo "selected = selected" ; } ?>>French Polynesia</option>
										<option value="French Southern Territories" <?php if($userDetails['country'] == "French Polynesia"){ echo "selected = selected" ; } ?>>French Southern Territories</option>
										<option value="Gabon" <?php if($userDetails['country'] == "Gabon"){ echo "selected = selected" ; } ?>>Gabon</option>
										<option value="Gambia" <?php if($userDetails['country'] == "Gambia"){ echo "selected = selected" ; } ?>>Gambia</option>
										<option value="Georgia" <?php if($userDetails['country'] == "Georgia"){ echo "selected = selected" ; } ?>>Georgia</option>
										<option value="Germany" <?php if($userDetails['country'] == "Germany"){ echo "selected = selected" ; } ?>>Germany</option>
										<option value="Ghana" <?php if($userDetails['country'] == "Ghana"){ echo "selected = selected" ; } ?>>Ghana</option>
										<option value="Gibraltar" <?php if($userDetails['country'] == "Gibraltar"){ echo "selected = selected" ; } ?>>Gibraltar</option>
										<option value="Greece" <?php if($userDetails['country'] == "Greece"){ echo "selected = selected" ; } ?>>Greece</option>
										<option value="Greenland" <?php if($userDetails['country'] == "Greenland"){ echo "selected = selected" ; } ?>>Greenland</option>
										<option value="Grenada" <?php if($userDetails['country'] == "Grenada"){ echo "selected = selected" ; } ?>>Grenada</option>
										<option value="Guadeloupe" <?php if($userDetails['country'] == "Guadeloupe"){ echo "selected = selected" ; } ?>>Guadeloupe</option>
										<option value="Guam" <?php if($userDetails['country'] == "Guam"){ echo "selected = selected" ; } ?>>Guam</option>
										<option value="Guatemala" <?php if($userDetails['country'] == "Guatemala"){ echo "selected = selected" ; } ?>>Guatemala</option>
										<option value="Guernsey" <?php if($userDetails['country'] == "Guernsey"){ echo "selected = selected" ; } ?>>Guernsey</option>
										<option value="Guinea" <?php if($userDetails['country'] == "Guinea"){ echo "selected = selected" ; } ?>>Guinea</option>
										<option value="Guinea-bissau" <?php if($userDetails['country'] == "Guinea-bissau"){ echo "selected = selected" ; } ?>>Guinea-bissau</option>
										<option value="Guyana" <?php if($userDetails['country'] == "Guyana"){ echo "selected = selected" ; } ?>>Guyana</option>
										<option value="Haiti" <?php if($userDetails['country'] == "No Select"){ echo "selected = selected" ; } ?>>Haiti</option>
										<option value="Holy See (Vatican City State)" <?php if($userDetails['country'] == "Haiti"){ echo "selected = selected" ; } ?>>Holy See (Vatican City State)</option>
										<option value="Honduras" <?php if($userDetails['country'] == "Honduras"){ echo "selected = selected" ; } ?>>Honduras</option>
										<option value="Hong Kong" <?php if($userDetails['country'] == "Hong Kong"){ echo "selected = selected" ; } ?>>Hong Kong</option>
										<option value="Hungary" <?php if($userDetails['country'] == "Hungary"){ echo "selected = selected" ; } ?>>Hungary</option>
										<option value="Iceland" <?php if($userDetails['country'] == "Iceland"){ echo "selected = selected" ; } ?>>Iceland</option>
										<option value="India" <?php if($userDetails['country'] == "India"){ echo "selected = selected" ; } ?>>India</option>
										<option value="Indonesia" <?php if($userDetails['country'] == "Indonesia"){ echo "selected = selected" ; } ?>>Indonesia</option>
										<option value="Iran, Islamic Republic of" <?php if($userDetails['country'] == "Iran, Islamic Republic of"){ echo "selected = selected" ; } ?>>Iran, Islamic Republic of</option>
										<option value="Iraq" <?php if($userDetails['country'] == "Iraq"){ echo "selected = selected" ; } ?>>Iraq</option>
										<option value="Ireland" <?php if($userDetails['country'] == "Ireland"){ echo "selected = selected" ; } ?>>Ireland</option>
										<option value="Isle of Man" <?php if($userDetails['country'] == "Isle of Man"){ echo "selected = selected" ; } ?>>Isle of Man</option>
										<option value="Isle of Wight" <?php if($userDetails['country'] == "Isle of Wight"){ echo "selected = selected" ; } ?>>Isle of Wight</option>
										<option value="Israel" <?php if($userDetails['country'] == "Israel"){ echo "selected = selected" ; } ?>>Israel</option>
										<option value="Italy" <?php if($userDetails['country'] == "Italy"){ echo "selected = selected" ; } ?>>Italy</option>
										<option value="Jamaica" <?php if($userDetails['country'] == "Jamaica"){ echo "selected = selected" ; } ?>>Jamaica</option>
										<option value="Japan" <?php if($userDetails['country'] == "Japan"){ echo "selected = selected" ; } ?>>Japan</option>
										<option value="Jersey" <?php if($userDetails['country'] == "Jersey"){ echo "selected = selected" ; } ?>>Jersey</option>
										<option value="Jordan" <?php if($userDetails['country'] == "Jordan"){ echo "selected = selected" ; } ?>>Jordan</option>
										<option value="Kazakhstan" <?php if($userDetails['country'] == "Kazakhstan"){ echo "selected = selected" ; } ?>>Kazakhstan</option>
										<option value="Kenya" <?php if($userDetails['country'] == "Kenya"){ echo "selected = selected" ; } ?>>Kenya</option>
										<option value="Kiribati" <?php if($userDetails['country'] == "Kiribati"){ echo "selected = selected" ; } ?>>Kiribati</option>
										<option value="Kosovo" <?php if($userDetails['country'] == "Kosovo"){ echo "selected = selected" ; } ?>>Kosovo</option>
										<option value="Korea, Democratic People's Republic of" <?php if($userDetails['country'] == "Korea, Democratic People's Republic of"){ echo "selected = selected" ; } ?>>Korea, Democratic People's Republic of</option>
										<option value="Korea, Republic of" <?php if($userDetails['country'] == "Korea, Republic of"){ echo "selected = selected" ; } ?>>Korea, Republic of</option>
										<option value="Kuwait" <?php if($userDetails['country'] == "Kuwait"){ echo "selected = selected" ; } ?>>Kuwait</option>
										<option value="Kyrgyzstan" <?php if($userDetails['country'] == "Kyrgyzstan"){ echo "selected = selected" ; } ?>>Kyrgyzstan</option>
										<option value="Lao People's Democratic Republic" <?php if($userDetails['country'] == "Lao People's Democratic Republic"){ echo "selected = selected" ; } ?>>Lao People's Democratic Republic</option>
										<option value="Latvia" <?php if($userDetails['country'] == "Latvia"){ echo "selected = selected" ; } ?>>Latvia</option>
										<option value="Lebanon" <?php if($userDetails['country'] == "Lebanon"){ echo "selected = selected" ; } ?>>Lebanon</option>
										<option value="Lesotho" <?php if($userDetails['country'] == "Lesotho"){ echo "selected = selected" ; } ?>>Lesotho</option>
										<option value="Liberia" <?php if($userDetails['country'] == "Liberia"){ echo "selected = selected" ; } ?>>Liberia</option>
										<option value="Libyan Arab Jamahiriya" <?php if($userDetails['country'] == "Libyan Arab Jamahiriya"){ echo "selected = selected" ; } ?>>Libyan Arab Jamahiriya</option>
										<option value="Liechtenstein" <?php if($userDetails['country'] == "Liechtenstein"){ echo "selected = selected" ; } ?>>Liechtenstein</option>
										<option value="Lithuania" <?php if($userDetails['country'] == "Lithuania"){ echo "selected = selected" ; } ?>>Lithuania</option>
										<option value="Luxembourg" <?php if($userDetails['country'] == "Luxembourg"){ echo "selected = selected" ; } ?>>Luxembourg</option>
										<option value="Macao" <?php if($userDetails['country'] == "Macao"){ echo "selected = selected" ; } ?>>Macao</option>
										<option value="Macedonia, The Former Yugoslav Republic of" <?php if($userDetails['country'] == "Macedonia, The Former Yugoslav Republic of"){ echo "selected = selected" ; } ?>>Macedonia, The Former Yugoslav Republic of</option>
										<option value="Madagascar" <?php if($userDetails['country'] == "Madagascar"){ echo "selected = selected" ; } ?>>Madagascar</option>
										<option value="Malawi" <?php if($userDetails['country'] == "Malawi"){ echo "selected = selected" ; } ?>>Malawi</option>
										<option value="Malaysia" <?php if($userDetails['country'] == "Malaysia"){ echo "selected = selected" ; } ?>>Malaysia</option>
										<option value="Maldives" <?php if($userDetails['country'] == "Maldives"){ echo "selected = selected" ; } ?>>Maldives</option>
										<option value="Mali" <?php if($userDetails['country'] == "Mali"){ echo "selected = selected" ; } ?>>Mali</option>
										<option value="Malta" <?php if($userDetails['country'] == "Malta"){ echo "selected = selected" ; } ?>>Malta</option>
										<option value="Marshall Islands" <?php if($userDetails['country'] == "Marshall Islands"){ echo "selected = selected" ; } ?>>Marshall Islands</option>
										<option value="Martinique" <?php if($userDetails['country'] == "Martinique"){ echo "selected = selected" ; } ?>>Martinique</option>
										<option value="Mauritania" <?php if($userDetails['country'] == "Mauritania"){ echo "selected = selected" ; } ?>>Mauritania</option>
										<option value="Mauritius" <?php if($userDetails['country'] == "Mauritius"){ echo "selected = selected" ; } ?>>Mauritius</option>
										<option value="Mayotte" <?php if($userDetails['country'] == "Mayotte"){ echo "selected = selected" ; } ?>>Mayotte</option>
										<option value="Mexico" <?php if($userDetails['country'] == "Mexico"){ echo "selected = selected" ; } ?>>Mexico</option>
										<option value="Micronesia, Federated States of" <?php if($userDetails['country'] == "Micronesia, Federated States of"){ echo "selected = selected" ; } ?>>Micronesia, Federated States of</option>
										<option value="Moldova, Republic of" <?php if($userDetails['country'] == "Moldova, Republic of"){ echo "selected = selected" ; } ?>>Moldova, Republic of</option>
										<option value="Monaco" <?php if($userDetails['country'] == "Monaco"){ echo "selected = selected" ; } ?>>Monaco</option>
										<option value="Mongolia" <?php if($userDetails['country'] == "Mongolia"){ echo "selected = selected" ; } ?>>Mongolia</option>
										<option value="Montenegro" <?php if($userDetails['country'] == "Montenegro"){ echo "selected = selected" ; } ?>>Montenegro</option>
										<option value="Montserrat" <?php if($userDetails['country'] == "Montserrat"){ echo "selected = selected" ; } ?>>Montserrat</option>
										<option value="Morocco" <?php if($userDetails['country'] == "Morocco"){ echo "selected = selected" ; } ?>>Morocco</option>
										<option value="Mozambique" <?php if($userDetails['country'] == "Mozambique"){ echo "selected = selected" ; } ?>>Mozambique</option>
										<option value="Myanmar" <?php if($userDetails['country'] == "Myanmar"){ echo "selected = selected" ; } ?>>Myanmar</option>
										<option value="Namibia" <?php if($userDetails['country'] == "Namibia"){ echo "selected = selected" ; } ?>>Namibia</option>
										<option value="Nauru" <?php if($userDetails['country'] == "Nauru"){ echo "selected = selected" ; } ?>>Nauru</option>
										<option value="Nepal" <?php if($userDetails['country'] == "Nepal"){ echo "selected = selected" ; } ?>>Nepal</option>
										<option value="Netherlands" <?php if($userDetails['country'] == "Netherlands"){ echo "selected = selected" ; } ?>>Netherlands</option>
										<option value="Netherlands Antilles" <?php if($userDetails['country'] == "Netherlands Antilles"){ echo "selected = selected" ; } ?>>Netherlands Antilles</option>
										<option value="New Caledonia" <?php if($userDetails['country'] == "New Caledonia"){ echo "selected = selected" ; } ?>>New Caledonia</option>
										<option value="New Zealand" <?php if($userDetails['country'] == "New Zealand"){ echo "selected = selected" ; } ?>>New Zealand</option>
										<option value="Nicaragua" <?php if($userDetails['country'] == "Nicaragua"){ echo "selected = selected" ; } ?>>Nicaragua</option>
										<option value="Niger" <?php if($userDetails['country'] == "Niger"){ echo "selected = selected" ; } ?>>Niger</option>
										<option value="Nigeria" <?php if($userDetails['country'] == "Nigeria"){ echo "selected = selected" ; } ?>>Nigeria</option>
										<option value="Niue" <?php if($userDetails['country'] == "Niue"){ echo "selected = selected" ; } ?>>Niue</option>
										<option value="Norfolk Island" <?php if($userDetails['country'] == "Norfolk Island"){ echo "selected = selected" ; } ?>>Norfolk Island</option>
										<option value="North Korea" <?php if($userDetails['country'] == "North Korea"){ echo "selected = selected" ; } ?>>North Korea</option>
										<option value="Northern Ireland" <?php if($userDetails['country'] == "Northern Ireland"){ echo "selected = selected" ; } ?>>Northern Ireland</option>
										<option value="Northern Mariana Islands" <?php if($userDetails['country'] == "Northern Mariana Islands"){ echo "selected = selected" ; } ?>>Northern Mariana Islands</option>
										<option value="Norway" <?php if($userDetails['country'] == "Norway"){ echo "selected = selected" ; } ?>>Norway</option>
										<option value="Oman" <?php if($userDetails['country'] == "Oman"){ echo "selected = selected" ; } ?>>Oman</option>
										<option value="Pakistan" <?php if($userDetails['country'] == "Pakistan"){ echo "selected = selected" ; } ?>>Pakistan</option>
										<option value="Palau" <?php if($userDetails['country'] == "Palau"){ echo "selected = selected" ; } ?>>Palau</option>
										<option value="Palestinian Territory, Occupied" <?php if($userDetails['country'] == "Palestinian Territory, Occupied"){ echo "selected = selected" ; } ?>>Palestinian Territory, Occupied</option>
										<option value="Panama" <?php if($userDetails['country'] == "Panama"){ echo "selected = selected" ; } ?>>Panama</option>
										<option value="Papua New Guinea" <?php if($userDetails['country'] == "Papua New Guinea"){ echo "selected = selected" ; } ?>>Papua New Guinea</option>
										<option value="Paraguay" <?php if($userDetails['country'] == "Paraguay"){ echo "selected = selected" ; } ?>>Paraguay</option>
										<option value="Peru" <?php if($userDetails['country'] == "Peru"){ echo "selected = selected" ; } ?>>Peru</option>
										<option value="Philippines" <?php if($userDetails['country'] == "Philippines"){ echo "selected = selected" ; } ?>>Philippines</option>
										<option value="Poland" <?php if($userDetails['country'] == "Poland"){ echo "selected = selected" ; } ?>>Poland</option>
										<option value="Portugal" <?php if($userDetails['country'] == "Portugal"){ echo "selected = selected" ; } ?>>Portugal</option>
										<option value="Puerto Rico" <?php if($userDetails['country'] == "Puerto Rico"){ echo "selected = selected" ; } ?>>Puerto Rico</option>
										<option value="Qatar" <?php if($userDetails['country'] == "Qatar"){ echo "selected = selected" ; } ?>>Qatar</option>
										<option value="Reunion" <?php if($userDetails['country'] == "Reunion"){ echo "selected = selected" ; } ?>>Reunion</option>
										<option value="Romania" <?php if($userDetails['country'] == "Romania"){ echo "selected = selected" ; } ?>>Romania</option>
										<option value="Russian Federation" <?php if($userDetails['country'] == "Russian Federation"){ echo "selected = selected" ; } ?>>Russian Federation</option>
										<option value="Rwanda" <?php if($userDetails['country'] == "Rwanda"){ echo "selected = selected" ; } ?>>Rwanda</option>
										<option value="Saint Barthelemy" <?php if($userDetails['country'] == "Saint Barthelemy"){ echo "selected = selected" ; } ?>>Saint Barthélemy</option>
										<option value="Saint Helena" <?php if($userDetails['country'] == "Saint Helena"){ echo "selected = selected" ; } ?>>Saint Helena</option>
										<option value="Saint Kitts and Nevis" <?php if($userDetails['country'] == "Saint Kitts and Nevis"){ echo "selected = selected" ; } ?>>Saint Kitts and Nevis</option>
										<option value="Saint Lucia" <?php if($userDetails['country'] == "Saint Lucia"){ echo "selected = selected" ; } ?>>Saint Lucia</option>
										<option value="Saint Pierre and Miquelon" <?php if($userDetails['country'] == "Saint Pierre and Miquelon"){ echo "selected = selected" ; } ?>>Saint Pierre and Miquelon</option>
										<option value="Saint Vincent and The Grenadines" <?php if($userDetails['country'] == "Saint Vincent and The Grenadines"){ echo "selected = selected" ; } ?>>Saint Vincent and The Grenadines</option>
										<option value="Samoa" <?php if($userDetails['country'] == "Samoa"){ echo "selected = selected" ; } ?>>Samoa</option>
										<option value="San Marino" <?php if($userDetails['country'] == "San Marino"){ echo "selected = selected" ; } ?>>San Marino</option>
										<option value="Sao Tome and Principe" <?php if($userDetails['country'] == "Sao Tome and Principe"){ echo "selected = selected" ; } ?>>Sao Tome and Principe</option>
										<option value="Saudi Arabia" <?php if($userDetails['country'] == "Saudi Arabia"){ echo "selected = selected" ; } ?>>Saudi Arabia</option>
										<option value="Senegal" <?php if($userDetails['country'] == "Senegal"){ echo "selected = selected" ; } ?>>Senegal</option>
										<option value="Serbia" <?php if($userDetails['country'] == "Serbia"){ echo "selected = selected" ; } ?>>Serbia</option>
										<option value="Seychelles" <?php if($userDetails['country'] == "Seychelles"){ echo "selected = selected" ; } ?>>Seychelles</option>
										<option value="Sierra Leone" <?php if($userDetails['country'] == "Sierra Leone"){ echo "selected = selected" ; } ?>>Sierra Leone</option>
										<option value="Singapore" <?php if($userDetails['country'] == "Singapore"){ echo "selected = selected" ; } ?>>Singapore</option>
										<option value="Slovakia" <?php if($userDetails['country'] == "Slovakia"){ echo "selected = selected" ; } ?>>Slovakia</option>
										<option value="Slovenia" <?php if($userDetails['country'] == "Slovenia"){ echo "selected = selected" ; } ?>>Slovenia</option>
										<option value="Solomon Islands" <?php if($userDetails['country'] == "Solomon Islands"){ echo "selected = selected" ; } ?>>Solomon Islands</option>
										<option value="Somalia" <?php if($userDetails['country'] == "Somalia"){ echo "selected = selected" ; } ?>>Somalia</option>
										<option value="South Africa" <?php if($userDetails['country'] == "South Africa"){ echo "selected = selected" ; } ?>>South Africa</option>
										<option value="South Georgia and The South Sandwich Islands" <?php if($userDetails['country'] == "South Georgia and The South Sandwich Islands"){ echo "selected = selected" ; } ?>>South Georgia and The South Sandwich Islands</option>
										<option value="South Korea" <?php if($userDetails['country'] == "South Korea"){ echo "selected = selected" ; } ?>>South Korea</option>
										<option value="South Sudan" <?php if($userDetails['country'] == "South Sudan"){ echo "selected = selected" ; } ?>>South Sudan</option>
										<option value="Spain" <?php if($userDetails['country'] == "Spain"){ echo "selected = selected" ; } ?>>Spain</option>
										<option value="Sri Lanka" <?php if($userDetails['country'] == "Sri Lanka"){ echo "selected = selected" ; } ?>>Sri Lanka</option>
										<option value="Sudan" <?php if($userDetails['country'] == "Sudan"){ echo "selected = selected" ; } ?>>Sudan</option>
										<option value="Suriname" <?php if($userDetails['country'] == "Suriname"){ echo "selected = selected" ; } ?>>Suriname</option>
										<option value="Svalbard and Jan Mayen" <?php if($userDetails['country'] == "Svalbard and Jan Mayen"){ echo "selected = selected" ; } ?>>Svalbard and Jan Mayen</option>
										<option value="Swaziland" <?php if($userDetails['country'] == "Swaziland"){ echo "selected = selected" ; } ?>>Swaziland</option>
										<option value="Sweden" <?php if($userDetails['country'] == "Sweden"){ echo "selected = selected" ; } ?>>Sweden</option>
										<option value="Switzerland" <?php if($userDetails['country'] == "Switzerland"){ echo "selected = selected" ; } ?>>Switzerland</option>
										<option value="Syrian Arab Republic" <?php if($userDetails['country'] == "Syrian Arab Republic"){ echo "selected = selected" ; } ?>>Syrian Arab Republic</option>
										<option value="Taiwan, Province of China" <?php if($userDetails['country'] == "Taiwan, Province of China"){ echo "selected = selected" ; } ?>>Taiwan, Province of China</option>
										<option value="Tajikistan" <?php if($userDetails['country'] == "Tajikistan"){ echo "selected = selected" ; } ?>>Tajikistan</option>
										<option value="Tanzania, United Republic of" <?php if($userDetails['country'] == "Tanzania, United Republic of"){ echo "selected = selected" ; } ?>>Tanzania, United Republic of</option>
										<option value="Thailand" <?php if($userDetails['country'] == "Thailand"){ echo "selected = selected" ; } ?>>Thailand</option>
										<option value="Timor-leste" <?php if($userDetails['country'] == "Timor-leste"){ echo "selected = selected" ; } ?>>Timor-leste</option>
										<option value="Togo" <?php if($userDetails['country'] == "Togo"){ echo "selected = selected" ; } ?>>Togo</option>
										<option value="Tokelau" <?php if($userDetails['country'] == "Tokelau"){ echo "selected = selected" ; } ?>>Tokelau</option>
										<option value="Tonga" <?php if($userDetails['country'] == "Tonga"){ echo "selected = selected" ; } ?>>Tonga</option>
										<option value="Trinidad and Tobago" <?php if($userDetails['country'] == "Trinidad and Tobago"){ echo "selected = selected" ; } ?>>Trinidad and Tobago</option>
										<option value="Tunisia" <?php if($userDetails['country'] == "Tunisia"){ echo "selected = selected" ; } ?>>Tunisia</option>
										<option value="Turkey" <?php if($userDetails['country'] == "Turkey"){ echo "selected = selected" ; } ?>>Turkey</option>
										<option value="Turkmenistan" <?php if($userDetails['country'] == "Turkmenistan"){ echo "selected = selected" ; } ?>>Turkmenistan</option>
										<option value="Turks and Caicos Islands" <?php if($userDetails['country'] == "Turks and Caicos Islands"){ echo "selected = selected" ; } ?>>Turks and Caicos Islands</option>
										<option value="Tuvalu" <?php if($userDetails['country'] == "Tuvalu"){ echo "selected = selected" ; } ?>>Tuvalu</option>
										<option value="Uganda" <?php if($userDetails['country'] == "Uganda"){ echo "selected = selected" ; } ?>>Uganda</option>
										<option value="Ukraine" <?php if($userDetails['country'] == "Ukraine"){ echo "selected = selected" ; } ?>>Ukraine</option>
										<option value="United Arab Emirates" <?php if($userDetails['country'] == "United Arab Emirates"){ echo "selected = selected" ; } ?>>United Arab Emirates</option>
										<option value="United States" <?php if($userDetails['country'] == "United States"){ echo "selected = selected" ; } ?>>United States</option>
										<option value="United States Minor Outlying Islands" <?php if($userDetails['country'] == "United States Minor Outlying Islands"){ echo "selected = selected" ; } ?>>United States Minor Outlying Islands</option>
										<option value="Uruguay" <?php if($userDetails['country'] == "Uruguay"){ echo "selected = selected" ; } ?>>Uruguay</option>
										<option value="Uzbekistan" <?php if($userDetails['country'] == "Uzbekistan"){ echo "selected = selected" ; } ?>>Uzbekistan</option>
										<option value="Vanuatu" <?php if($userDetails['country'] == "Vanuatu"){ echo "selected = selected" ; } ?>>Vanuatu</option>
										<option value="Venezuela" <?php if($userDetails['country'] == "Venezuela"){ echo "selected = selected" ; } ?>>Venezuela</option>
										<option value="Vietnam" <?php if($userDetails['country'] == "Vietnam"){ echo "selected = selected" ; } ?>>Vietnam</option>
										<option value="Virgin Islands, British" <?php if($userDetails['country'] == "Virgin Islands, British"){ echo "selected = selected" ; } ?>>Virgin Islands, British</option>
										<option value="Virgin Islands, U.S." <?php if($userDetails['country'] == "Virgin Islands, U.S."){ echo "selected = selected" ; } ?>>Virgin Islands, U.S.</option>
										<option value="Wallis and Futuna" <?php if($userDetails['country'] == "Wallis and Futuna"){ echo "selected = selected" ; } ?>>Wallis and Futuna</option>
										<option value="West Bank" <?php if($userDetails['country'] == "West Bank"){ echo "selected = selected" ; } ?>>West Bank</option>
										<option value="Western Sahara" <?php if($userDetails['country'] == "Western Sahara"){ echo "selected = selected" ; } ?>>Western Sahara</option>
										<option value="Yemen" <?php if($userDetails['country'] == "Yemen"){ echo "selected = selected" ; } ?>>Yemen</option>
										<option value="Zambia" <?php if($userDetails['country'] == "Zambia"){ echo "selected = selected" ; } ?>>Zambia</option>
										<option value="Zimbabwe" <?php if($userDetails['country'] == "Zimbabwe"){ echo "selected = selected" ; } ?>>Zimbabwe</option>
									</select>
								<p class="addressSub">(Your home address)</p>
							</div>
							<div class="field" id="postCodeRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Post/Zip Code: </label>
								<input class="NQLRText" type="text" name="postCode" id="postCodeRegister" placeholder="Please Enter Your Post/Zip Code" value="<?php echo $userDetails['postCode']; ?>">
								<p class="addressSub">(Your home address)</p>
							</div>
						</fieldset>

						<fieldset>
							<legend>Information About Your Role</legend>
							<div class="field" id="companyNameRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Company Name: </label>
								<input class="NQLRText" type="text" name="companyName" disabled="true" id="companyNameRegister" placeholder="Please Enter Your Company Name" value="<?php echo $companyDetails['company_name']; ?>">
							</div>
							<div class="field" id="companyProfessionRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Company Profession: </label>
								<input class="NQLRText" type="text" name="companyProfession"  disabled="true" id="companyProfessionRegister" placeholder="Please Enter Your Company's Profession" value="<?php echo $companyDetails['profession']; ?>">
							</div>
							<div class="field" id="jobTitleRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Your Job Title: </label>
								<input class="NQLRText" type="text" name="jobTitle" id="jobTitleRegister" placeholder="Please Enter Your Job Title" value="<?php echo $userDetails['job_title']; ?>">
							</div>
							<div class="field" id="departmentRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Your Department: </label>
								<input class="NQLRText" type="text" name="department" id="departmentRegister" placeholder="Please Enter Your Department" value="<?php echo $userDetails['department']; ?>">
							</div>
							<div class="field" id="companyAddress1RegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Address 1: </label>
								<input class="NQLRText" type="text" name="companyAddress1"  disabled="true" id="companyAddress1Register"  placeholder="Please Enter The First Line Of Your Company Address" value="<?php echo $companyDetails['address_1']; ?>">
								<p class="addressSub">(Your company address)</p>
							</div>
							<div class="field" id="companyAddress2RegisterSection">
								<label class="NQLRLabel"> Address 2: </label>
								<input class="NQLRText" type="text" name="companyAddress2" disabled="true" id="companyAddress2Register"  placeholder="Please Enter The Second Line Of Your Company Address" value="<?php echo $companyDetails['address_2']; ?>">
								<p class="addressSub">(Your company address)</p>
							</div>
							<div class="field" id="companyCityRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> City: </label>
								<input class="NQLRText" type="text" name="companyCity" disabled="true" id="companyCityRegister" placeholder="Please Enter The City" value="<?php echo $companyDetails['city']; ?>">
								<p class="addressSub">(Your company address)</p>
							</div>
							<div class="field" id="companyCountyRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> County/State/Province: </label>
								<input class="NQLRText" type="text" name="companyCounty" disabled="true" id="companyCountyRegister" placeholder="Please Enter The County/State/Province" value="<?php echo $companyDetails['county']; ?>">
								<p class="addressSub">(Your company address)</p>
							</div>
							<div class="field" id="companyCountryRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Country: </label>
								<select  class="NQLRSelect" name="companyCountry" id="companyCountryRegister"  disabled="true" >
									<option value="No Select" <?php if($companyDetails['country'] == "No Select" || !isset($companyDetails['country'])){ echo "selected = selected" ; } ?>>Please Select..</option>
									<option value="United Kingdom" <?php if($companyDetails['country'] == "United Kingdom"){ echo "selected = selected" ; } ?>>United Kingdom</option>
									<option value="Afghanistan" <?php if($companyDetails['country'] == "Afghanistan"){ echo "selected = selected" ; } ?>>Afghanistan</option>
									<option value="Åland Islands" <?php if($companyDetails['country'] == "Åland Islands"){ echo "selected = selected" ; } ?>>Åland Islands</option>
									<option value="Albania" <?php if($companyDetails['country'] == "Albania"){ echo "selected = selected" ; } ?>>Albania</option>
									<option value="Algeria" <?php if($companyDetails['country'] == "Algeria"){ echo "selected = selected" ; } ?>>Algeria</option>
									<option value="American Samoa" <?php if($companyDetails['country'] == "American Samoa"){ echo "selected = selected" ; } ?>>American Samoa</option>
									<option value="Andorra" <?php if($companyDetails['country'] == "Andorra"){ echo "selected = selected" ; } ?>>Andorra</option>
									<option value="Angola" <?php if($companyDetails['country'] == "Angola"){ echo "selected = selected" ; } ?>>Angola</option>
									<option value="Anguilla" <?php if($companyDetails['country'] == "Anguilla"){ echo "selected = selected" ; } ?>>Anguilla</option>
									<option value="Antarctica" <?php if($companyDetails['country'] == "Antarctica"){ echo "selected = selected" ; } ?>>Antarctica</option>
									<option value="Antigua and Barbuda" <?php if($companyDetails['country'] == "Antigua and Barbuda"){ echo "selected = selected" ; } ?>>Antigua and Barbuda</option>
									<option value="Argentina" <?php if($companyDetails['country'] == "Argentina"){ echo "selected = selected" ; } ?>>Argentina</option>
									<option value="Armenia" <?php if($companyDetails['country'] == "Armenia"){ echo "selected = selected" ; } ?>>Armenia</option>
									<option value="Aruba" <?php if($companyDetails['country'] == "Aruba"){ echo "selected = selected" ; } ?>>Aruba</option>
									<option value="Australia" <?php if($companyDetails['country'] == "Australia"){ echo "selected = selected" ; } ?>>Australia</option>
									<option value="Austria" <?php if($companyDetails['country'] == "Austria"){ echo "selected = selected" ; } ?>>Austria</option>
									<option value="Azerbaijan" <?php if($companyDetails['country'] == "Azerbaijan"){ echo "selected = selected" ; } ?>>Azerbaijan</option>
									<option value="Bahamas" <?php if($companyDetails['country'] == "Bahamas"){ echo "selected = selected" ; } ?>>Bahamas</option>
									<option value="Bahrain" <?php if($companyDetails['country'] == "Bahrain"){ echo "selected = selected" ; } ?>>Bahrain</option>
									<option value="Bangladesh" <?php if($companyDetails['country'] == "Bangladesh"){ echo "selected = selected" ; } ?>>Bangladesh</option>
									<option value="Barbados" <?php if($companyDetails['country'] == "Barbados"){ echo "selected = selected" ; } ?>>Barbados</option>
									<option value="Belarus" <?php if($companyDetails['country'] == "Belarus"){ echo "selected = selected" ; } ?>>Belarus</option>
									<option value="Belgium" <?php if($companyDetails['country'] == "Belgium"){ echo "selected = selected" ; } ?>>Belgium</option>
									<option value="Belize" <?php if($companyDetails['country'] == "Belize"){ echo "selected = selected" ; } ?>>Belize</option>
									<option value="Benin" <?php if($companyDetails['country'] == "Benin"){ echo "selected = selected" ; } ?>>Benin</option>
									<option value="Bermuda" <?php if($companyDetails['country'] == "Bermuda"){ echo "selected = selected" ; } ?>>Bermuda</option>
									<option value="Bhutan" <?php if($companyDetails['country'] == "Bhutan"){ echo "selected = selected" ; } ?>>Bhutan</option>
									<option value="Bolivia" <?php if($companyDetails['country'] == "Bolivia"){ echo "selected = selected" ; } ?>>Bolivia</option>
									<option value="Bosnia and Herzegovina" <?php if($companyDetails['country'] == "Bosnia and Herzegovina"){ echo "selected = selected" ; } ?>>Bosnia and Herzegovina</option>
									<option value="Botswana" <?php if($companyDetails['country'] == "Botswana"){ echo "selected = selected" ; } ?>>Botswana</option>
									<option value="Brazil" <?php if($companyDetails['country'] == "Brazil"){ echo "selected = selected" ; } ?>>Brazil</option>
									<option value="British Indian Ocean Territory" <?php if($companyDetails['country'] == "British Indian Ocean Territory"){ echo "selected = selected" ; } ?>>British Indian Ocean Territory</option>
									<option value="Brunei Darussalam" <?php if($companyDetails['country'] == "Brunei Darussalam"){ echo "selected = selected" ; } ?>>Brunei Darussalam</option>
									<option value="Bulgaria" <?php if($companyDetails['country'] == "Bulgaria"){ echo "selected = selected" ; } ?>>Bulgaria</option>
									<option value="Burkina Faso" <?php if($companyDetails['country'] == "Burkina Faso"){ echo "selected = selected" ; } ?>>Burkina Faso</option>
									<option value="Burundi" <?php if($companyDetails['country'] == "Burundi"){ echo "selected = selected" ; } ?>>Burundi</option>
									<option value="Cambodia" <?php if($companyDetails['country'] == "Cambodia"){ echo "selected = selected" ; } ?>>Cambodia</option>
									<option value="Cameroon" <?php if($companyDetails['country'] == "Cameroon"){ echo "selected = selected" ; } ?>>Cameroon</option>
									<option value="Canada" <?php if($companyDetails['country'] == "Canada"){ echo "selected = selected" ; } ?>>Canada</option>
									<option value="Cape Verde" <?php if($companyDetails['country'] == "Cape Verde"){ echo "selected = selected" ; } ?>>Cape Verde</option>
									<option value="Cayman Islands" <?php if($companyDetails['country'] == "Cayman Islands"){ echo "selected = selected" ; } ?>>Cayman Islands</option>
									<option value="Central African Republic" <?php if($companyDetails['country'] == "Central African Republic"){ echo "selected = selected" ; } ?>>Central African Republic</option>
									<option value="Chad" <?php if($companyDetails['country'] == "Chad"){ echo "selected = selected" ; } ?>>Chad</option>
									<option value="Chile" <?php if($companyDetails['country'] == "Chile"){ echo "selected = selected" ; } ?>>Chile</option>
									<option value="China" <?php if($companyDetails['country'] == "China"){ echo "selected = selected" ; } ?>>China</option>
									<option value="Christmas Island" <?php if($companyDetails['country'] == "Christmas Island"){ echo "selected = selected" ; } ?>>Christmas Island</option>
									<option value="Cocos (Keeling) Islands" <?php if($companyDetails['country'] == "Cocos (Keeling) Islands"){ echo "selected = selected" ; } ?>>Cocos (Keeling) Islands</option>
									<option value="Colombia" <?php if($companyDetails['country'] == "Colombia"){ echo "selected = selected" ; } ?>>Colombia</option>
									<option value="Comoros" <?php if($companyDetails['country'] == "Comoros"){ echo "selected = selected" ; } ?>>Comoros</option>
									<option value="Congo" <?php if($companyDetails['country'] == "Congo"){ echo "selected = selected" ; } ?>>Congo</option>
									<option value="Congo, The Democratic Republic of The" <?php if($companyDetails['country'] == "Congo, The Democratic Republic of The"){ echo "selected = selected" ; } ?>>Congo, The Democratic Republic of The</option>
									<option value="Cook Islands" <?php if($companyDetails['country'] == "Cook Islands"){ echo "selected = selected" ; } ?>>Cook Islands</option>
									<option value="Costa Rica" <?php if($companyDetails['country'] == "Costa Rica"){ echo "selected = selected" ; } ?>>Costa Rica</option>
									<option value="Cote D'ivoire" <?php if($companyDetails['country'] == "Cote D'ivoire"){ echo "selected = selected" ; } ?>>Cote D'ivoire</option>
									<option value="Croatia" <?php if($companyDetails['country'] == "Croatia"){ echo "selected = selected" ; } ?>>Croatia</option>
									<option value="Cuba" <?php if($companyDetails['country'] == "Cuba"){ echo "selected = selected" ; } ?>>Cuba</option>
									<option value="Cyprus" <?php if($companyDetails['country'] == "Cyprus"){ echo "selected = selected" ; } ?>>Cyprus</option>
									<option value="Czech Republic" <?php if($companyDetails['country'] == "Czech Republic"){ echo "selected = selected" ; } ?>>Czech Republic</option>
									<option value="Denmark" <?php if($companyDetails['country'] == "Denmark"){ echo "selected = selected" ; } ?>>Denmark</option>
									<option value="Djibouti" <?php if($companyDetails['country'] == "Djibouti"){ echo "selected = selected" ; } ?>>Djibouti</option>
									<option value="Dominica" <?php if($companyDetails['country'] == "Dominica"){ echo "selected = selected" ; } ?>>Dominica</option>
									<option value="Dominican Republic" <?php if($companyDetails['country'] == "Dominican Republic"){ echo "selected = selected" ; } ?>>Dominican Republic</option>
									<option value="Ecuador" <?php if($companyDetails['country'] == "Ecuador"){ echo "selected = selected" ; } ?>>Ecuador</option>
									<option value="Egypt" <?php if($companyDetails['country'] == "Egypt"){ echo "selected = selected" ; } ?>>Egypt</option>
									<option value="El Salvador" <?php if($companyDetails['country'] == "El Salvador"){ echo "selected = selected" ; } ?>>El Salvador</option>
									<option value="Equatorial Guinea" <?php if($companyDetails['country'] == "Equatorial Guinea"){ echo "selected = selected" ; } ?>>Equatorial Guinea</option>
									<option value="Eritrea" <?php if($companyDetails['country'] == "Eritrea"){ echo "selected = selected" ; } ?>>Eritrea</option>
									<option value="Estonia" <?php if($companyDetails['country'] == "Estonia"){ echo "selected = selected" ; } ?>>Estonia</option>
									<option value="Ethiopia" <?php if($companyDetails['country'] == "Ethiopia"){ echo "selected = selected" ; } ?>>Ethiopia</option>
									<option value="Falkland Islands (Malvinas)" <?php if($companyDetails['country'] == "Falkland Islands (Malvinas)"){ echo "selected = selected" ; } ?>>Falkland Islands (Malvinas)</option>
									<option value="Faroe Islands" <?php if($companyDetails['country'] == "Faroe Islands"){ echo "selected = selected" ; } ?>>Faroe Islands</option>
									<option value="Fiji" <?php if($companyDetails['country'] == "Fiji"){ echo "selected = selected" ; } ?>>Fiji</option>
									<option value="Finland" <?php if($companyDetails['country'] == "Finland"){ echo "selected = selected" ; } ?>>Finland</option>
									<option value="France" <?php if($companyDetails['country'] == "France"){ echo "selected = selected" ; } ?>>France</option>
									<option value="French Guiana" <?php if($companyDetails['country'] == "French Guiana"){ echo "selected = selected" ; } ?>>French Guiana</option>
									<option value="French Polynesia" <?php if($companyDetails['country'] == "No Select"){ echo "selected = selected" ; } ?>>French Polynesia</option>
									<option value="French Southern Territories" <?php if($companyDetails['country'] == "French Polynesia"){ echo "selected = selected" ; } ?>>French Southern Territories</option>
									<option value="Gabon" <?php if($companyDetails['country'] == "Gabon"){ echo "selected = selected" ; } ?>>Gabon</option>
									<option value="Gambia" <?php if($companyDetails['country'] == "Gambia"){ echo "selected = selected" ; } ?>>Gambia</option>
									<option value="Georgia" <?php if($companyDetails['country'] == "Georgia"){ echo "selected = selected" ; } ?>>Georgia</option>
									<option value="Germany" <?php if($companyDetails['country'] == "Germany"){ echo "selected = selected" ; } ?>>Germany</option>
									<option value="Ghana" <?php if($companyDetails['country'] == "Ghana"){ echo "selected = selected" ; } ?>>Ghana</option>
									<option value="Gibraltar" <?php if($companyDetails['country'] == "Gibraltar"){ echo "selected = selected" ; } ?>>Gibraltar</option>
									<option value="Greece" <?php if($companyDetails['country'] == "Greece"){ echo "selected = selected" ; } ?>>Greece</option>
									<option value="Greenland" <?php if($companyDetails['country'] == "Greenland"){ echo "selected = selected" ; } ?>>Greenland</option>
									<option value="Grenada" <?php if($companyDetails['country'] == "Grenada"){ echo "selected = selected" ; } ?>>Grenada</option>
									<option value="Guadeloupe" <?php if($companyDetails['country'] == "Guadeloupe"){ echo "selected = selected" ; } ?>>Guadeloupe</option>
									<option value="Guam" <?php if($companyDetails['country'] == "Guam"){ echo "selected = selected" ; } ?>>Guam</option>
									<option value="Guatemala" <?php if($companyDetails['country'] == "Guatemala"){ echo "selected = selected" ; } ?>>Guatemala</option>
									<option value="Guernsey" <?php if($companyDetails['country'] == "Guernsey"){ echo "selected = selected" ; } ?>>Guernsey</option>
									<option value="Guinea" <?php if($companyDetails['country'] == "Guinea"){ echo "selected = selected" ; } ?>>Guinea</option>
									<option value="Guinea-bissau" <?php if($companyDetails['country'] == "Guinea-bissau"){ echo "selected = selected" ; } ?>>Guinea-bissau</option>
									<option value="Guyana" <?php if($companyDetails['country'] == "Guyana"){ echo "selected = selected" ; } ?>>Guyana</option>
									<option value="Haiti" <?php if($companyDetails['country'] == "No Select"){ echo "selected = selected" ; } ?>>Haiti</option>
									<option value="Holy See (Vatican City State)" <?php if($companyDetails['country'] == "Haiti"){ echo "selected = selected" ; } ?>>Holy See (Vatican City State)</option>
									<option value="Honduras" <?php if($companyDetails['country'] == "Honduras"){ echo "selected = selected" ; } ?>>Honduras</option>
									<option value="Hong Kong" <?php if($companyDetails['country'] == "Hong Kong"){ echo "selected = selected" ; } ?>>Hong Kong</option>
									<option value="Hungary" <?php if($companyDetails['country'] == "Hungary"){ echo "selected = selected" ; } ?>>Hungary</option>
									<option value="Iceland" <?php if($companyDetails['country'] == "Iceland"){ echo "selected = selected" ; } ?>>Iceland</option>
									<option value="India" <?php if($companyDetails['country'] == "India"){ echo "selected = selected" ; } ?>>India</option>
									<option value="Indonesia" <?php if($companyDetails['country'] == "Indonesia"){ echo "selected = selected" ; } ?>>Indonesia</option>
									<option value="Iran, Islamic Republic of" <?php if($companyDetails['country'] == "Iran, Islamic Republic of"){ echo "selected = selected" ; } ?>>Iran, Islamic Republic of</option>
									<option value="Iraq" <?php if($companyDetails['country'] == "Iraq"){ echo "selected = selected" ; } ?>>Iraq</option>
									<option value="Ireland" <?php if($companyDetails['country'] == "Ireland"){ echo "selected = selected" ; } ?>>Ireland</option>
									<option value="Isle of Man" <?php if($companyDetails['country'] == "Isle of Man"){ echo "selected = selected" ; } ?>>Isle of Man</option>
									<option value="Isle of Wight" <?php if($companyDetails['country'] == "Isle of Wight"){ echo "selected = selected" ; } ?>>Isle of Wight</option>
									<option value="Israel" <?php if($companyDetails['country'] == "Israel"){ echo "selected = selected" ; } ?>>Israel</option>
									<option value="Italy" <?php if($companyDetails['country'] == "Italy"){ echo "selected = selected" ; } ?>>Italy</option>
									<option value="Jamaica" <?php if($companyDetails['country'] == "Jamaica"){ echo "selected = selected" ; } ?>>Jamaica</option>
									<option value="Japan" <?php if($companyDetails['country'] == "Japan"){ echo "selected = selected" ; } ?>>Japan</option>
									<option value="Jersey" <?php if($companyDetails['country'] == "Jersey"){ echo "selected = selected" ; } ?>>Jersey</option>
									<option value="Jordan" <?php if($companyDetails['country'] == "Jordan"){ echo "selected = selected" ; } ?>>Jordan</option>
									<option value="Kazakhstan" <?php if($companyDetails['country'] == "Kazakhstan"){ echo "selected = selected" ; } ?>>Kazakhstan</option>
									<option value="Kenya" <?php if($companyDetails['country'] == "Kenya"){ echo "selected = selected" ; } ?>>Kenya</option>
									<option value="Kiribati" <?php if($companyDetails['country'] == "Kiribati"){ echo "selected = selected" ; } ?>>Kiribati</option>
									<option value="Kosovo" <?php if($companyDetails['country'] == "Kosovo"){ echo "selected = selected" ; } ?>>Kosovo</option>
									<option value="Korea, Democratic People's Republic of" <?php if($companyDetails['country'] == "Korea, Democratic People's Republic of"){ echo "selected = selected" ; } ?>>Korea, Democratic People's Republic of</option>
									<option value="Korea, Republic of" <?php if($companyDetails['country'] == "Korea, Republic of"){ echo "selected = selected" ; } ?>>Korea, Republic of</option>
									<option value="Kuwait" <?php if($companyDetails['country'] == "Kuwait"){ echo "selected = selected" ; } ?>>Kuwait</option>
									<option value="Kyrgyzstan" <?php if($companyDetails['country'] == "Kyrgyzstan"){ echo "selected = selected" ; } ?>>Kyrgyzstan</option>
									<option value="Lao People's Democratic Republic" <?php if($companyDetails['country'] == "Lao People's Democratic Republic"){ echo "selected = selected" ; } ?>>Lao People's Democratic Republic</option>
									<option value="Latvia" <?php if($companyDetails['country'] == "Latvia"){ echo "selected = selected" ; } ?>>Latvia</option>
									<option value="Lebanon" <?php if($companyDetails['country'] == "Lebanon"){ echo "selected = selected" ; } ?>>Lebanon</option>
									<option value="Lesotho" <?php if($companyDetails['country'] == "Lesotho"){ echo "selected = selected" ; } ?>>Lesotho</option>
									<option value="Liberia" <?php if($companyDetails['country'] == "Liberia"){ echo "selected = selected" ; } ?>>Liberia</option>
									<option value="Libyan Arab Jamahiriya" <?php if($companyDetails['country'] == "Libyan Arab Jamahiriya"){ echo "selected = selected" ; } ?>>Libyan Arab Jamahiriya</option>
									<option value="Liechtenstein" <?php if($companyDetails['country'] == "Liechtenstein"){ echo "selected = selected" ; } ?>>Liechtenstein</option>
									<option value="Lithuania" <?php if($companyDetails['country'] == "Lithuania"){ echo "selected = selected" ; } ?>>Lithuania</option>
									<option value="Luxembourg" <?php if($companyDetails['country'] == "Luxembourg"){ echo "selected = selected" ; } ?>>Luxembourg</option>
									<option value="Macao" <?php if($companyDetails['country'] == "Macao"){ echo "selected = selected" ; } ?>>Macao</option>
									<option value="Macedonia, The Former Yugoslav Republic of" <?php if($companyDetails['country'] == "Macedonia, The Former Yugoslav Republic of"){ echo "selected = selected" ; } ?>>Macedonia, The Former Yugoslav Republic of</option>
									<option value="Madagascar" <?php if($companyDetails['country'] == "Madagascar"){ echo "selected = selected" ; } ?>>Madagascar</option>
									<option value="Malawi" <?php if($companyDetails['country'] == "Malawi"){ echo "selected = selected" ; } ?>>Malawi</option>
									<option value="Malaysia" <?php if($companyDetails['country'] == "Malaysia"){ echo "selected = selected" ; } ?>>Malaysia</option>
									<option value="Maldives" <?php if($companyDetails['country'] == "Maldives"){ echo "selected = selected" ; } ?>>Maldives</option>
									<option value="Mali" <?php if($companyDetails['country'] == "Mali"){ echo "selected = selected" ; } ?>>Mali</option>
									<option value="Malta" <?php if($companyDetails['country'] == "Malta"){ echo "selected = selected" ; } ?>>Malta</option>
									<option value="Marshall Islands" <?php if($companyDetails['country'] == "Marshall Islands"){ echo "selected = selected" ; } ?>>Marshall Islands</option>
									<option value="Martinique" <?php if($companyDetails['country'] == "Martinique"){ echo "selected = selected" ; } ?>>Martinique</option>
									<option value="Mauritania" <?php if($companyDetails['country'] == "Mauritania"){ echo "selected = selected" ; } ?>>Mauritania</option>
									<option value="Mauritius" <?php if($companyDetails['country'] == "Mauritius"){ echo "selected = selected" ; } ?>>Mauritius</option>
									<option value="Mayotte" <?php if($companyDetails['country'] == "Mayotte"){ echo "selected = selected" ; } ?>>Mayotte</option>
									<option value="Mexico" <?php if($companyDetails['country'] == "Mexico"){ echo "selected = selected" ; } ?>>Mexico</option>
									<option value="Micronesia, Federated States of" <?php if($companyDetails['country'] == "Micronesia, Federated States of"){ echo "selected = selected" ; } ?>>Micronesia, Federated States of</option>
									<option value="Moldova, Republic of" <?php if($companyDetails['country'] == "Moldova, Republic of"){ echo "selected = selected" ; } ?>>Moldova, Republic of</option>
									<option value="Monaco" <?php if($companyDetails['country'] == "Monaco"){ echo "selected = selected" ; } ?>>Monaco</option>
									<option value="Mongolia" <?php if($companyDetails['country'] == "Mongolia"){ echo "selected = selected" ; } ?>>Mongolia</option>
									<option value="Montenegro" <?php if($companyDetails['country'] == "Montenegro"){ echo "selected = selected" ; } ?>>Montenegro</option>
									<option value="Montserrat" <?php if($companyDetails['country'] == "Montserrat"){ echo "selected = selected" ; } ?>>Montserrat</option>
									<option value="Morocco" <?php if($companyDetails['country'] == "Morocco"){ echo "selected = selected" ; } ?>>Morocco</option>
									<option value="Mozambique" <?php if($companyDetails['country'] == "Mozambique"){ echo "selected = selected" ; } ?>>Mozambique</option>
									<option value="Myanmar" <?php if($companyDetails['country'] == "Myanmar"){ echo "selected = selected" ; } ?>>Myanmar</option>
									<option value="Namibia" <?php if($companyDetails['country'] == "Namibia"){ echo "selected = selected" ; } ?>>Namibia</option>
									<option value="Nauru" <?php if($companyDetails['country'] == "Nauru"){ echo "selected = selected" ; } ?>>Nauru</option>
									<option value="Nepal" <?php if($companyDetails['country'] == "Nepal"){ echo "selected = selected" ; } ?>>Nepal</option>
									<option value="Netherlands" <?php if($companyDetails['country'] == "Netherlands"){ echo "selected = selected" ; } ?>>Netherlands</option>
									<option value="Netherlands Antilles" <?php if($companyDetails['country'] == "Netherlands Antilles"){ echo "selected = selected" ; } ?>>Netherlands Antilles</option>
									<option value="New Caledonia" <?php if($companyDetails['country'] == "New Caledonia"){ echo "selected = selected" ; } ?>>New Caledonia</option>
									<option value="New Zealand" <?php if($companyDetails['country'] == "New Zealand"){ echo "selected = selected" ; } ?>>New Zealand</option>
									<option value="Nicaragua" <?php if($companyDetails['country'] == "Nicaragua"){ echo "selected = selected" ; } ?>>Nicaragua</option>
									<option value="Niger" <?php if($companyDetails['country'] == "Niger"){ echo "selected = selected" ; } ?>>Niger</option>
									<option value="Nigeria" <?php if($companyDetails['country'] == "Nigeria"){ echo "selected = selected" ; } ?>>Nigeria</option>
									<option value="Niue" <?php if($companyDetails['country'] == "Niue"){ echo "selected = selected" ; } ?>>Niue</option>
									<option value="Norfolk Island" <?php if($companyDetails['country'] == "Norfolk Island"){ echo "selected = selected" ; } ?>>Norfolk Island</option>
									<option value="North Korea" <?php if($companyDetails['country'] == "North Korea"){ echo "selected = selected" ; } ?>>North Korea</option>
									<option value="Northern Ireland" <?php if($companyDetails['country'] == "Northern Ireland"){ echo "selected = selected" ; } ?>>Northern Ireland</option>
									<option value="Northern Mariana Islands" <?php if($companyDetails['country'] == "Northern Mariana Islands"){ echo "selected = selected" ; } ?>>Northern Mariana Islands</option>
									<option value="Norway" <?php if($companyDetails['country'] == "Norway"){ echo "selected = selected" ; } ?>>Norway</option>
									<option value="Oman" <?php if($companyDetails['country'] == "Oman"){ echo "selected = selected" ; } ?>>Oman</option>
									<option value="Pakistan" <?php if($companyDetails['country'] == "Pakistan"){ echo "selected = selected" ; } ?>>Pakistan</option>
									<option value="Palau" <?php if($companyDetails['country'] == "Palau"){ echo "selected = selected" ; } ?>>Palau</option>
									<option value="Palestinian Territory, Occupied" <?php if($companyDetails['country'] == "Palestinian Territory, Occupied"){ echo "selected = selected" ; } ?>>Palestinian Territory, Occupied</option>
									<option value="Panama" <?php if($companyDetails['country'] == "Panama"){ echo "selected = selected" ; } ?>>Panama</option>
									<option value="Papua New Guinea" <?php if($companyDetails['country'] == "Papua New Guinea"){ echo "selected = selected" ; } ?>>Papua New Guinea</option>
									<option value="Paraguay" <?php if($companyDetails['country'] == "Paraguay"){ echo "selected = selected" ; } ?>>Paraguay</option>
									<option value="Peru" <?php if($companyDetails['country'] == "Peru"){ echo "selected = selected" ; } ?>>Peru</option>
									<option value="Philippines" <?php if($companyDetails['country'] == "Philippines"){ echo "selected = selected" ; } ?>>Philippines</option>
									<option value="Poland" <?php if($companyDetails['country'] == "Poland"){ echo "selected = selected" ; } ?>>Poland</option>
									<option value="Portugal" <?php if($companyDetails['country'] == "Portugal"){ echo "selected = selected" ; } ?>>Portugal</option>
									<option value="Puerto Rico" <?php if($companyDetails['country'] == "Puerto Rico"){ echo "selected = selected" ; } ?>>Puerto Rico</option>
									<option value="Qatar" <?php if($companyDetails['country'] == "Qatar"){ echo "selected = selected" ; } ?>>Qatar</option>
									<option value="Reunion" <?php if($companyDetails['country'] == "Reunion"){ echo "selected = selected" ; } ?>>Reunion</option>
									<option value="Romania" <?php if($companyDetails['country'] == "Romania"){ echo "selected = selected" ; } ?>>Romania</option>
									<option value="Russian Federation" <?php if($companyDetails['country'] == "Russian Federation"){ echo "selected = selected" ; } ?>>Russian Federation</option>
									<option value="Rwanda" <?php if($companyDetails['country'] == "Rwanda"){ echo "selected = selected" ; } ?>>Rwanda</option>
									<option value="Saint Barthelemy" <?php if($companyDetails['country'] == "Saint Barthelemy"){ echo "selected = selected" ; } ?>>Saint Barthélemy</option>
									<option value="Saint Helena" <?php if($companyDetails['country'] == "Saint Helena"){ echo "selected = selected" ; } ?>>Saint Helena</option>
									<option value="Saint Kitts and Nevis" <?php if($companyDetails['country'] == "Saint Kitts and Nevis"){ echo "selected = selected" ; } ?>>Saint Kitts and Nevis</option>
									<option value="Saint Lucia" <?php if($companyDetails['country'] == "Saint Lucia"){ echo "selected = selected" ; } ?>>Saint Lucia</option>
									<option value="Saint Pierre and Miquelon" <?php if($companyDetails['country'] == "Saint Pierre and Miquelon"){ echo "selected = selected" ; } ?>>Saint Pierre and Miquelon</option>
									<option value="Saint Vincent and The Grenadines" <?php if($companyDetails['country'] == "Saint Vincent and The Grenadines"){ echo "selected = selected" ; } ?>>Saint Vincent and The Grenadines</option>
									<option value="Samoa" <?php if($companyDetails['country'] == "Samoa"){ echo "selected = selected" ; } ?>>Samoa</option>
									<option value="San Marino" <?php if($companyDetails['country'] == "San Marino"){ echo "selected = selected" ; } ?>>San Marino</option>
									<option value="Sao Tome and Principe" <?php if($companyDetails['country'] == "Sao Tome and Principe"){ echo "selected = selected" ; } ?>>Sao Tome and Principe</option>
									<option value="Saudi Arabia" <?php if($companyDetails['country'] == "Saudi Arabia"){ echo "selected = selected" ; } ?>>Saudi Arabia</option>
									<option value="Senegal" <?php if($companyDetails['country'] == "Senegal"){ echo "selected = selected" ; } ?>>Senegal</option>
									<option value="Serbia" <?php if($companyDetails['country'] == "Serbia"){ echo "selected = selected" ; } ?>>Serbia</option>
									<option value="Seychelles" <?php if($companyDetails['country'] == "Seychelles"){ echo "selected = selected" ; } ?>>Seychelles</option>
									<option value="Sierra Leone" <?php if($companyDetails['country'] == "Sierra Leone"){ echo "selected = selected" ; } ?>>Sierra Leone</option>
									<option value="Singapore" <?php if($companyDetails['country'] == "Singapore"){ echo "selected = selected" ; } ?>>Singapore</option>
									<option value="Slovakia" <?php if($companyDetails['country'] == "Slovakia"){ echo "selected = selected" ; } ?>>Slovakia</option>
									<option value="Slovenia" <?php if($companyDetails['country'] == "Slovenia"){ echo "selected = selected" ; } ?>>Slovenia</option>
									<option value="Solomon Islands" <?php if($companyDetails['country'] == "Solomon Islands"){ echo "selected = selected" ; } ?>>Solomon Islands</option>
									<option value="Somalia" <?php if($companyDetails['country'] == "Somalia"){ echo "selected = selected" ; } ?>>Somalia</option>
									<option value="South Africa" <?php if($companyDetails['country'] == "South Africa"){ echo "selected = selected" ; } ?>>South Africa</option>
									<option value="South Georgia and The South Sandwich Islands" <?php if($companyDetails['country'] == "South Georgia and The South Sandwich Islands"){ echo "selected = selected" ; } ?>>South Georgia and The South Sandwich Islands</option>
									<option value="South Korea" <?php if($companyDetails['country'] == "South Korea"){ echo "selected = selected" ; } ?>>South Korea</option>
									<option value="South Sudan" <?php if($companyDetails['country'] == "South Sudan"){ echo "selected = selected" ; } ?>>South Sudan</option>
									<option value="Spain" <?php if($companyDetails['country'] == "Spain"){ echo "selected = selected" ; } ?>>Spain</option>
									<option value="Sri Lanka" <?php if($companyDetails['country'] == "Sri Lanka"){ echo "selected = selected" ; } ?>>Sri Lanka</option>
									<option value="Sudan" <?php if($companyDetails['country'] == "Sudan"){ echo "selected = selected" ; } ?>>Sudan</option>
									<option value="Suriname" <?php if($companyDetails['country'] == "Suriname"){ echo "selected = selected" ; } ?>>Suriname</option>
									<option value="Svalbard and Jan Mayen" <?php if($companyDetails['country'] == "Svalbard and Jan Mayen"){ echo "selected = selected" ; } ?>>Svalbard and Jan Mayen</option>
									<option value="Swaziland" <?php if($companyDetails['country'] == "Swaziland"){ echo "selected = selected" ; } ?>>Swaziland</option>
									<option value="Sweden" <?php if($companyDetails['country'] == "Sweden"){ echo "selected = selected" ; } ?>>Sweden</option>
									<option value="Switzerland" <?php if($companyDetails['country'] == "Switzerland"){ echo "selected = selected" ; } ?>>Switzerland</option>
									<option value="Syrian Arab Republic" <?php if($companyDetails['country'] == "Syrian Arab Republic"){ echo "selected = selected" ; } ?>>Syrian Arab Republic</option>
									<option value="Taiwan, Province of China" <?php if($companyDetails['country'] == "Taiwan, Province of China"){ echo "selected = selected" ; } ?>>Taiwan, Province of China</option>
									<option value="Tajikistan" <?php if($companyDetails['country'] == "Tajikistan"){ echo "selected = selected" ; } ?>>Tajikistan</option>
									<option value="Tanzania, United Republic of" <?php if($companyDetails['country'] == "Tanzania, United Republic of"){ echo "selected = selected" ; } ?>>Tanzania, United Republic of</option>
									<option value="Thailand" <?php if($companyDetails['country'] == "Thailand"){ echo "selected = selected" ; } ?>>Thailand</option>
									<option value="Timor-leste" <?php if($companyDetails['country'] == "Timor-leste"){ echo "selected = selected" ; } ?>>Timor-leste</option>
									<option value="Togo" <?php if($companyDetails['country'] == "Togo"){ echo "selected = selected" ; } ?>>Togo</option>
									<option value="Tokelau" <?php if($companyDetails['country'] == "Tokelau"){ echo "selected = selected" ; } ?>>Tokelau</option>
									<option value="Tonga" <?php if($companyDetails['country'] == "Tonga"){ echo "selected = selected" ; } ?>>Tonga</option>
									<option value="Trinidad and Tobago" <?php if($companyDetails['country'] == "Trinidad and Tobago"){ echo "selected = selected" ; } ?>>Trinidad and Tobago</option>
									<option value="Tunisia" <?php if($companyDetails['country'] == "Tunisia"){ echo "selected = selected" ; } ?>>Tunisia</option>
									<option value="Turkey" <?php if($companyDetails['country'] == "Turkey"){ echo "selected = selected" ; } ?>>Turkey</option>
									<option value="Turkmenistan" <?php if($companyDetails['country'] == "Turkmenistan"){ echo "selected = selected" ; } ?>>Turkmenistan</option>
									<option value="Turks and Caicos Islands" <?php if($companyDetails['country'] == "Turks and Caicos Islands"){ echo "selected = selected" ; } ?>>Turks and Caicos Islands</option>
									<option value="Tuvalu" <?php if($companyDetails['country'] == "Tuvalu"){ echo "selected = selected" ; } ?>>Tuvalu</option>
									<option value="Uganda" <?php if($companyDetails['country'] == "Uganda"){ echo "selected = selected" ; } ?>>Uganda</option>
									<option value="Ukraine" <?php if($companyDetails['country'] == "Ukraine"){ echo "selected = selected" ; } ?>>Ukraine</option>
									<option value="United Arab Emirates" <?php if($companyDetails['country'] == "United Arab Emirates"){ echo "selected = selected" ; } ?>>United Arab Emirates</option>
									<option value="United States" <?php if($companyDetails['country'] == "United States"){ echo "selected = selected" ; } ?>>United States</option>
									<option value="United States Minor Outlying Islands" <?php if($companyDetails['country'] == "United States Minor Outlying Islands"){ echo "selected = selected" ; } ?>>United States Minor Outlying Islands</option>
									<option value="Uruguay" <?php if($companyDetails['country'] == "Uruguay"){ echo "selected = selected" ; } ?>>Uruguay</option>
									<option value="Uzbekistan" <?php if($companyDetails['country'] == "Uzbekistan"){ echo "selected = selected" ; } ?>>Uzbekistan</option>
									<option value="Vanuatu" <?php if($companyDetails['country'] == "Vanuatu"){ echo "selected = selected" ; } ?>>Vanuatu</option>
									<option value="Venezuela" <?php if($companyDetails['country'] == "Venezuela"){ echo "selected = selected" ; } ?>>Venezuela</option>
									<option value="Vietnam" <?php if($companyDetails['country'] == "Vietnam"){ echo "selected = selected" ; } ?>>Vietnam</option>
									<option value="Virgin Islands, British" <?php if($companyDetails['country'] == "Virgin Islands, British"){ echo "selected = selected" ; } ?>>Virgin Islands, British</option>
									<option value="Virgin Islands, U.S." <?php if($companyDetails['country'] == "Virgin Islands, U.S."){ echo "selected = selected" ; } ?>>Virgin Islands, U.S.</option>
									<option value="Wallis and Futuna" <?php if($companyDetails['country'] == "Wallis and Futuna"){ echo "selected = selected" ; } ?>>Wallis and Futuna</option>
									<option value="West Bank" <?php if($companyDetails['country'] == "West Bank"){ echo "selected = selected" ; } ?>>West Bank</option>
									<option value="Western Sahara" <?php if($companyDetails['country'] == "Western Sahara"){ echo "selected = selected" ; } ?>>Western Sahara</option>
									<option value="Yemen" <?php if($companyDetails['country'] == "Yemen"){ echo "selected = selected" ; } ?>>Yemen</option>
									<option value="Zambia" <?php if($companyDetails['country'] == "Zambia"){ echo "selected = selected" ; } ?>>Zambia</option>
									<option value="Zimbabwe" <?php if($companyDetails['country'] == "Zimbabwe"){ echo "selected = selected" ; } ?>>Zimbabwe</option>
								</select>
									</select>
								<p class="addressSub">(Your company address)</p>
							</div>
							<div class="field" name="companyPostCode" id="companyPostCodeRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Post/Zip Code: </label>
								<input class="NQLRText" type="text" id="companyPostCodeRegister" name="companyPostCode" placeholder="Please Enter Your Company Post/Zip Code" value="<?php echo $companyDetails['postcode']; ?>"  disabled="true" >
								<p class="addressSub">(Your company address)</p>
							</div>
						</fieldset>

						<fieldset>
							<legend>Legal Check Information</legend>
							<!--Just state whether they have or have not read them-->
							<div class="field" id="legalCheckRegisterSection">
								<p id="legal">Our records indicate that you <?php if($userDetails['legal_check'] == "1"){ echo "have"; }else{ echo "have not"; }?> read the <a class="legalLink" href="legal.html">Terms and Conditions of use</a></p>
								<p id="dataVerify">Our records indicate that you <?php if($userDetails['data_check'] == "1"){ echo "have"; }else{ echo "have not"; }?> checked all the data when you submitted it when you registered, please note that any incorrect data that is produced may incur charges</p>
							</div>
						</fieldset>
						<a href="mainMenu.php" id="backMainMenu" class="left">Back to Main Menu</a>
						<input type="submit" id="submitChange" class="submit right" name="submitChange" value="Submit">
					</form>
				</div>
			</div>

			<div class="clear"></div>

			<?php include($root.'/php/components/upperFooter.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/lowerFooter.php'); ?>

		</div>
		<!--End of Container-->

	</body>
</html>
<?php
	if(isset($_SESSION['userDetailsErrors'])){
			unset($_SESSION['userDetailsErrors']);
	}
?>
<?php require_once("php/components/database/closedbConn.php");?>
