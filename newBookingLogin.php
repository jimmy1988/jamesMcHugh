<?php
	//import the root varaible
	$root=$_SERVER['DOCUMENT_ROOT'];
	//$root.="/jamesMcHugh";
	if(strpos($root, "jamesMcHugh")<16){
		$root=$root."jamesMcHugh";
	}
	//check to see if the session has been set, if not start it and import all functions associated with the session
	if(!isset($_SESSION)){
		require_once($root."/php/functions/sessionFunctions.php");
	}

	//import all of the functions
	require_once($root."/php/functions/functions.php");

	//check the session to make sure that a user has been set, the expiry variable has been set and the session has not expired
	if(isset($_SESSION['uI']) && isset($_SESSION['exp']) && ($_SESSION['exp'] == "No Expiry" || time() < $_SESSION['exp'])){
		redirect_to("mainMenu.php");
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
				echo '<link type="text/css" rel="stylesheet" href="css/'.$path.'/style.css" />';
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

			<?php
				if(isset($_SESSION) && (isset($_SESSION['u']) && time()<= $_SESSION['exp'])){
					require_once($root."/php/functions/functions.php");
					redirect_to("mainMenu.php?");
				}
			?>

			<div class="clear"></div>

			<?php include($root.'/php/components/noScript.php'); ?>

			<div class="clear"></div>

			<div id="contentLayer"></div>

			<div class="clear"></div>

			<!--
				1. When the forms switch from one form to the other, the title should read between the register form and the login form
				2. Bind the switch functions to their desired functions
		-->

			<div class="main" id="content">
				<div id="innerContent" class="inner">
					<h2 id="title">
						New Quote -<br/>
						<span id="titleChange">
							<?php
								if(isset($_SESSION['form']) && $_SESSION['form'] == "register"){
									echo ucwords($_SESSION['form']);
								}else{
									echo ucwords("login");
								}

							?>
						</span>
					</h2>
					<form id="loginForm" name="loginForm" method="POST" action="php/loginUser.php" onsubmit="return validateLoginForm();" style="display:<?php if(!isset($_SESSION['form']) || $_SESSION['form'] == "login"){ echo "block"; }else{ echo "none";}?>;">
							<strong class="information">To make a new booking, you will need to login to your account</strong>
							<strong class="information">If you do not have an account <a id="switchToLogin1" href="#">click here</a></strong>
							<div class="errors" id="errorLogin">
								<?php
								if(isset($_SESSION['loginErrors']) && !empty($_SESSION['loginErrors'])){
									echo $_SESSION['loginErrors'];
									unset($_SESSION['loginErrors']);
								}
								?>
							</div>
							<div id="emailLoginSection" class="field">
								<label class="NQLRLabel">Email: </label>
								<input class="NQLREmail" name="email" autocomplete="off" type="email" id="emailLogin" value="james.mchugh1988@gmail.com" placeholder="Please Enter Your Email Address">
							</div>
							<div id="passwordLoginSection" class="field">
								<label class="NQLRLabel">Password: </label>
								<input type="password" name="password" autocomplete="off" class="NQLRPassword" id="passwordLogin" value="j4m3rs1988uK" placeholder="Please Enter Your Password">
							</div>
							<input type="hidden" name="formType" id="formTypeLogin" value="loginForm"/>
							<!--Detects whether javascript is turned off or not, login form wont submit without js-->
							<noscript>
								<input type="hidden" name="javascriptDisabled" id="javascriptDisabledIndicatorLogin" value="Yes"/>
							</noscript>

							<div id="rememberMeLoginField">
				        <p id="rememberMeLoginContainer" class="members">Remember Me! <input type="checkbox" id="rememberMeLogin" name="rememberMe" class="members" checked="true"></p>
				      </div>
							<a href="#" class="switchTo" id="switchToLogin2">Not Registered? Click Here</a>
							<a href="#" class="forgottenPassword" id="forgottenPassword1">Forgotten Password?</a>
							<input type="submit" id="submitLogin" name="submitLogin" class="submit" title="Click to attempt login" value="Login">
							<a href="#" id="spinnerContainer" class="spinnerContainers"><i id="spinner1" class="fa fa-spinner fa-spin"></i></a>
					</form>

					<form id="registerForm" name="registerForm" method="POST" action="php/registerUser.php" onsubmit="return validateRegistrationForm();" style="display:<?php if(isset($_SESSION['form']) && $_SESSION['form'] == "register"){ echo "block"; }else{ echo "none";}?>;">
						<strong class="information">To get a new quotation, you will need to sign up for a free account</strong>
						<strong class="information">All fields with a <i class="fa fa-asterisk"></i> are compulsory</strong>
						<div class="errors" id="errorsRegister">
							<?php
								if(isset($_SESSION['registerErrors']) && !empty($_SESSION['registerErrors'])){
									echo $_SESSION['registerErrors'];
									unset($_SESSION['registerErrors']);
								}
							?>
						</div>
						<fieldset>
							<legend>Account Details</legend>
							<div class="field" id="emailRegisterSection">
								<i class="fa fa-asterisk"></i>
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Email: </label>
								<input class="NQLREmail" type="email" name="emailRegister" id="emailRegister" placeholder="Please Enter Your Email Address" value="james.mchugh198826@gmail.com">
							</div>
							<div class="field" id="passwordRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Password: </label>
								<input class="NQLRPassword" type="password" name="passwordRegister" id="passwordRegister" placeholder="Enter Your Password" value="j4m3rs1406uK">
							</div>
							<div class="field" id="passwordConfirmRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Confirm Password: </label>
								<input class="NQLRPassword" type="password" name="confirmPasswordRegister" id="passwordConfirmRegister" placeholder="Please Your Confirm Password" value="j4m3rs1406uK">
							</div>
							<a href="#" class="switchTo" id="switchToRegister1">Already Registered? Click Here</a>
							<a href="#" class="forgottenPassword" id="forgottenPassword2">Forgotten Password?</a>
						</fieldset>

						<fieldset>
							<legend>Personal Details</legend>
							<strong class="information">This registration will register a new account and this person as the primary user, to make a new quotation without registering a new account ask your administrator to create an account for you first then request a new quotation</strong>
							<div class="field" id="titleRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Title: </label>
								<select class="NQLRSelect" name="title" id="titleRegister">
										<option value="No Select">Please Select..</option>
										<option value="Mr" selected="selected">Mr</option>
										<option value="Mrs">Mrs</option>
										<option value="Miss">Miss</option>
										<option value="Ms">Ms</option>
										<option value="Dame">Dame</option>
										<option value="Sir">Sir</option>
										<option value="Lord">Lord</option>
										<option value="Lady">Lady</option>
										<option value="HRH">HRH</option>
								</select>
							</div>
							<div class="field" id="forenameRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Forename: </label>
								<input class="NQLRText" type="text" name="forename" id="forenameRegister" placeholder="Please Enter Your Forename" value="James">
							</div>
							<div class="field" id="surnameRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Surname: </label>
								<input class="NQLRText" type="text" name="surname" id="surnameRegister" placeholder="Please Enter Your Surname" value="McHugh">
							</div>
							<div class="field" id="address1RegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Address 1: </label>
								<input class="NQLRText" type="text" name="address1" id="address1Register"  placeholder="Please Enter The First Line Of Your Address" value="101 St James House">
								<p class="addressSub">(Your home address)</p>
							</div>
							<div class="field" id="address2RegisterSection">
								<label class="NQLRLabel"> Address 2: </label>
								<input class="NQLRText" type="text" name="address2" id="address2Register"  placeholder="Please Enter The Second Line Of Your Address">
								<p class="addressSub">(Your home address)</p>
							</div>
							<div class="field" id="cityRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> City: </label>
								<input class="NQLRText" type="text" id="cityRegister" name="city" placeholder="Please Enter The City" value="Brighton">
								<p class="addressSub">(Your home address)</p>
							</div>
							<div class="field" id="countyRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> County/State/Province: </label>
								<input class="NQLRText" type="text" id="countyRegister" name="county" placeholder="Please Enter The County/State/Province" value="East Sussex">
								<p class="addressSub">(Your home address)</p>
							</div>
							<div class="field" id="countryRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Country: </label>
								<select  class="NQLRSelect" name="country" id="countryRegister">
										<option value="No Select">Please Select..</option>
										<option value="United Kingdom" selected="selected">United Kingdom</option>
										<option value="Afghanistan">Afghanistan</option>
										<option value="Åland Islands">Åland Islands</option>
										<option value="Albania">Albania</option>
										<option value="Algeria">Algeria</option>
										<option value="American Samoa">American Samoa</option>
										<option value="Andorra">Andorra</option>
										<option value="Angola">Angola</option>
										<option value="Anguilla">Anguilla</option>
										<option value="Antarctica">Antarctica</option>
										<option value="Antigua and Barbuda">Antigua and Barbuda</option>
										<option value="Argentina">Argentina</option>
										<option value="Armenia">Armenia</option>
										<option value="Aruba">Aruba</option>
										<option value="Australia">Australia</option>
										<option value="Austria">Austria</option>
										<option value="Azerbaijan">Azerbaijan</option>
										<option value="Bahamas">Bahamas</option>
										<option value="Bahrain">Bahrain</option>
										<option value="Bangladesh">Bangladesh</option>
										<option value="Barbados">Barbados</option>
										<option value="Belarus">Belarus</option>
										<option value="Belgium">Belgium</option>
										<option value="Belize">Belize</option>
										<option value="Benin">Benin</option>
										<option value="Bermuda">Bermuda</option>
										<option value="Bhutan">Bhutan</option>
										<option value="Bolivia">Bolivia</option>
										<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
										<option value="Botswana">Botswana</option>
										<option value="Brazil">Brazil</option>
										<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
										<option value="Brunei Darussalam">Brunei Darussalam</option>
										<option value="Bulgaria">Bulgaria</option>
										<option value="Burkina Faso">Burkina Faso</option>
										<option value="Burundi">Burundi</option>
										<option value="Cambodia">Cambodia</option>
										<option value="Cameroon">Cameroon</option>
										<option value="Canada">Canada</option>
										<option value="Cape Verde">Cape Verde</option>
										<option value="Cayman Islands">Cayman Islands</option>
										<option value="Central African Republic">Central African Republic</option>
										<option value="Chad">Chad</option>
										<option value="Chile">Chile</option>
										<option value="China">China</option>
										<option value="Christmas Island">Christmas Island</option>
										<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
										<option value="Colombia">Colombia</option>
										<option value="Comoros">Comoros</option>
										<option value="Congo">Congo</option>
										<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
										<option value="Cook Islands">Cook Islands</option>
										<option value="Costa Rica">Costa Rica</option>
										<option value="Cote D'ivoire">Cote D'ivoire</option>
										<option value="Croatia">Croatia</option>
										<option value="Cuba">Cuba</option>
										<option value="Cyprus">Cyprus</option>
										<option value="Czech Republic">Czech Republic</option>
										<option value="Denmark">Denmark</option>
										<option value="Djibouti">Djibouti</option>
										<option value="Dominica">Dominica</option>
										<option value="Dominican Republic">Dominican Republic</option>
										<option value="Ecuador">Ecuador</option>
										<option value="Egypt">Egypt</option>
										<option value="El Salvador">El Salvador</option>
										<option value="Equatorial Guinea">Equatorial Guinea</option>
										<option value="Eritrea">Eritrea</option>
										<option value="Estonia">Estonia</option>
										<option value="Ethiopia">Ethiopia</option>
										<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
										<option value="Faroe Islands">Faroe Islands</option>
										<option value="Fiji">Fiji</option>
										<option value="Finland">Finland</option>
										<option value="France">France</option>
										<option value="French Guiana">French Guiana</option>
										<option value="French Polynesia">French Polynesia</option>
										<option value="French Southern Territories">French Southern Territories</option>
										<option value="Gabon">Gabon</option>
										<option value="Gambia">Gambia</option>
										<option value="Georgia">Georgia</option>
										<option value="Germany">Germany</option>
										<option value="Ghana">Ghana</option>
										<option value="Gibraltar">Gibraltar</option>
										<option value="Greece">Greece</option>
										<option value="Greenland">Greenland</option>
										<option value="Grenada">Grenada</option>
										<option value="Guadeloupe">Guadeloupe</option>
										<option value="Guam">Guam</option>
										<option value="Guatemala">Guatemala</option>
										<option value="Guernsey">Guernsey</option>
										<option value="Guinea">Guinea</option>
										<option value="Guinea-bissau">Guinea-bissau</option>
										<option value="Guyana">Guyana</option>
										<option value="Haiti">Haiti</option>
										<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
										<option value="Honduras">Honduras</option>
										<option value="Hong Kong">Hong Kong</option>
										<option value="Hungary">Hungary</option>
										<option value="Iceland">Iceland</option>
										<option value="India">India</option>
										<option value="Indonesia">Indonesia</option>
										<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
										<option value="Iraq">Iraq</option>
										<option value="Ireland">Ireland</option>
										<option value="Isle of Man">Isle of Man</option>
										<option value="Isle of Wight">Isle of Wight</option>
										<option value="Israel">Israel</option>
										<option value="Italy">Italy</option>
										<option value="Jamaica">Jamaica</option>
										<option value="Japan">Japan</option>
										<option value="Jersey">Jersey</option>
										<option value="Jordan">Jordan</option>
										<option value="Kazakhstan">Kazakhstan</option>
										<option value="Kenya">Kenya</option>
										<option value="Kiribati">Kiribati</option>
										<option value="Kosovo">Kosovo</option>
										<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
										<option value="Korea, Republic of">Korea, Republic of</option>
										<option value="Kuwait">Kuwait</option>
										<option value="Kyrgyzstan">Kyrgyzstan</option>
										<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
										<option value="Latvia">Latvia</option>
										<option value="Lebanon">Lebanon</option>
										<option value="Lesotho">Lesotho</option>
										<option value="Liberia">Liberia</option>
										<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
										<option value="Liechtenstein">Liechtenstein</option>
										<option value="Lithuania">Lithuania</option>
										<option value="Luxembourg">Luxembourg</option>
										<option value="Macao">Macao</option>
										<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
										<option value="Madagascar">Madagascar</option>
										<option value="Malawi">Malawi</option>
										<option value="Malaysia">Malaysia</option>
										<option value="Maldives">Maldives</option>
										<option value="Mali">Mali</option>
										<option value="Malta">Malta</option>
										<option value="Marshall Islands">Marshall Islands</option>
										<option value="Martinique">Martinique</option>
										<option value="Mauritania">Mauritania</option>
										<option value="Mauritius">Mauritius</option>
										<option value="Mayotte">Mayotte</option>
										<option value="Mexico">Mexico</option>
										<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
										<option value="Moldova, Republic of">Moldova, Republic of</option>
										<option value="Monaco">Monaco</option>
										<option value="Mongolia">Mongolia</option>
										<option value="Montenegro">Montenegro</option>
										<option value="Montserrat">Montserrat</option>
										<option value="Morocco">Morocco</option>
										<option value="Mozambique">Mozambique</option>
										<option value="Myanmar">Myanmar</option>
										<option value="Namibia">Namibia</option>
										<option value="Nauru">Nauru</option>
										<option value="Nepal">Nepal</option>
										<option value="Netherlands">Netherlands</option>
										<option value="Netherlands Antilles">Netherlands Antilles</option>
										<option value="New Caledonia">New Caledonia</option>
										<option value="New Zealand">New Zealand</option>
										<option value="Nicaragua">Nicaragua</option>
										<option value="Niger">Niger</option>
										<option value="Nigeria">Nigeria</option>
										<option value="Niue">Niue</option>
										<option value="Norfolk Island">Norfolk Island</option>
										<option value="North Korea">North Korea</option>
										<option value="Northern Ireland">Northern Ireland</option>
										<option value="Northern Mariana Islands">Northern Mariana Islands</option>
										<option value="Norway">Norway</option>
										<option value="Oman">Oman</option>
										<option value="Pakistan">Pakistan</option>
										<option value="Palau">Palau</option>
										<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
										<option value="Panama">Panama</option>
										<option value="Papua New Guinea">Papua New Guinea</option>
										<option value="Paraguay">Paraguay</option>
										<option value="Peru">Peru</option>
										<option value="Philippines">Philippines</option>
										<option value="Poland">Poland</option>
										<option value="Portugal">Portugal</option>
										<option value="Puerto Rico">Puerto Rico</option>
										<option value="Qatar">Qatar</option>
										<option value="Reunion">Reunion</option>
										<option value="Romania">Romania</option>
										<option value="Russian Federation">Russian Federation</option>
										<option value="Rwanda">Rwanda</option>
										<option value="Saint Barthelemy">Saint Barthélemy</option>
										<option value="Saint Helena">Saint Helena</option>
										<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
										<option value="Saint Lucia">Saint Lucia</option>
										<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
										<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
										<option value="Samoa">Samoa</option>
										<option value="San Marino">San Marino</option>
										<option value="Sao Tome and Principe">Sao Tome and Principe</option>
										<option value="Saudi Arabia">Saudi Arabia</option>
										<option value="Senegal">Senegal</option>
										<option value="Serbia">Serbia</option>
										<option value="Seychelles">Seychelles</option>
										<option value="Sierra Leone">Sierra Leone</option>
										<option value="Singapore">Singapore</option>
										<option value="Slovakia">Slovakia</option>
										<option value="Slovenia">Slovenia</option>
										<option value="Solomon Islands">Solomon Islands</option>
										<option value="Somalia">Somalia</option>
										<option value="South Africa">South Africa</option>
										<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
										<option value="South Korea">South Korea</option>
										<option value="South Sudan">South Sudan</option>
										<option value="Spain">Spain</option>
										<option value="Sri Lanka">Sri Lanka</option>
										<option value="Sudan">Sudan</option>
										<option value="Suriname">Suriname</option>
										<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
										<option value="Swaziland">Swaziland</option>
										<option value="Sweden">Sweden</option>
										<option value="Switzerland">Switzerland</option>
										<option value="Syrian Arab Republic">Syrian Arab Republic</option>
										<option value="Taiwan, Province of China">Taiwan, Province of China</option>
										<option value="Tajikistan">Tajikistan</option>
										<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
										<option value="Thailand">Thailand</option>
										<option value="Timor-leste">Timor-leste</option>
										<option value="Togo">Togo</option>
										<option value="Tokelau">Tokelau</option>
										<option value="Tonga">Tonga</option>
										<option value="Trinidad and Tobago">Trinidad and Tobago</option>
										<option value="Tunisia">Tunisia</option>
										<option value="Turkey">Turkey</option>
										<option value="Turkmenistan">Turkmenistan</option>
										<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
										<option value="Tuvalu">Tuvalu</option>
										<option value="Uganda">Uganda</option>
										<option value="Ukraine">Ukraine</option>
										<option value="United Arab Emirates">United Arab Emirates</option>
										<option value="United States">United States</option>
										<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
										<option value="Uruguay">Uruguay</option>
										<option value="Uzbekistan">Uzbekistan</option>
										<option value="Vanuatu">Vanuatu</option>
										<option value="Venezuela">Venezuela</option>
										<option value="Vietnam">Vietnam</option>
										<option value="Virgin Islands, British">Virgin Islands, British</option>
										<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
										<option value="Wallis and Futuna">Wallis and Futuna</option>
										<option value="West Bank">West Bank</option>
										<option value="Western Sahara">Western Sahara</option>
										<option value="Yemen">Yemen</option>
										<option value="Zambia">Zambia</option>
										<option value="Zimbabwe">Zimbabwe</option>
									</select>
								<p class="addressSub">(Your home address)</p>
							</div>
							<div class="field" id="postCodeRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Post/Zip Code: </label>
								<input class="NQLRText" type="text" name="postCode" id="postCodeRegister" placeholder="Please Enter Your Post/Zip Code" value="BN2 1QY">
								<p class="addressSub">(Your home address)</p>
							</div>
						</fieldset>

						<fieldset>
							<legend>Information About Your Role</legend>
							<div class="field" id="companyNameRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Company Name: </label>
								<input class="NQLRText" type="text" name="companyName" id="companyNameRegister" placeholder="Please Enter Your Company Name" value="Home2">
							</div>
							<div class="field" id="companyProfessionRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Company Profession: </label>
								<input class="NQLRText" type="text" name="companyProfession" id="companyProfessionRegister" placeholder="Please Enter Your Company's Profession" value="Computing">
							</div>
							<div class="field" id="jobTitleRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Your Job Title: </label>
								<input class="NQLRText" type="text" name="jobTitle" id="jobTitleRegister" placeholder="Please Enter Your Job Title" value="Director">
							</div>
							<div class="field" id="departmentRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Your Department: </label>
								<input class="NQLRText" type="text" name="department" id="departmentRegister" placeholder="Please Enter Your Department" value="Media and Advertising">
							</div>
							<div class="field" id="companyAddress1RegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Address 1: </label>
								<input class="NQLRText" type="text" name="companyAddress1" id="companyAddress1Register"  placeholder="Please Enter The First Line Of Your Company Address" value="101 St James House">
								<p class="addressSub">(Your company address)</p>
							</div>
							<div class="field" id="companyAddress2RegisterSection">
								<label class="NQLRLabel"> Address 2: </label>
								<input class="NQLRText" type="text" name="companyAddress2" id="companyAddress2Register"  placeholder="Please Enter The Second Line Of Your Company Address">
								<p class="addressSub">(Your company address)</p>
							</div>
							<div class="field" id="companyCityRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> City: </label>
								<input class="NQLRText" type="text" name="companyCity" id="companyCityRegister" placeholder="Please Enter The City" value="Brighton">
								<p class="addressSub">(Your company address)</p>
							</div>
							<div class="field" id="companyCountyRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> County/State/Province: </label>
								<input class="NQLRText" type="text" name="companyCounty" id="companyCountyRegister" placeholder="Please Enter The County/State/Province" value="East Sussex">
								<p class="addressSub">(Your company address)</p>
							</div>
							<div class="field" id="companyCountryRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Country: </label>
								<select  class="NQLRSelect" name="companyCountry" id="companyCountryRegister">
										<option value="No Select">Please Select..</option>
										<option value="United Kingdom" selected="selected">United Kingdom</option>
										<option value="Afghanistan">Afghanistan</option>
										<option value="Åland Islands">Åland Islands</option>
										<option value="Albania">Albania</option>
										<option value="Algeria">Algeria</option>
										<option value="American Samoa">American Samoa</option>
										<option value="Andorra">Andorra</option>
										<option value="Angola">Angola</option>
										<option value="Anguilla">Anguilla</option>
										<option value="Antarctica">Antarctica</option>
										<option value="Antigua and Barbuda">Antigua and Barbuda</option>
										<option value="Argentina">Argentina</option>
										<option value="Armenia">Armenia</option>
										<option value="Aruba">Aruba</option>
										<option value="Australia">Australia</option>
										<option value="Austria">Austria</option>
										<option value="Azerbaijan">Azerbaijan</option>
										<option value="Bahamas">Bahamas</option>
										<option value="Bahrain">Bahrain</option>
										<option value="Bangladesh">Bangladesh</option>
										<option value="Barbados">Barbados</option>
										<option value="Belarus">Belarus</option>
										<option value="Belgium">Belgium</option>
										<option value="Belize">Belize</option>
										<option value="Benin">Benin</option>
										<option value="Bermuda">Bermuda</option>
										<option value="Bhutan">Bhutan</option>
										<option value="Bolivia">Bolivia</option>
										<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
										<option value="Botswana">Botswana</option>
										<option value="Brazil">Brazil</option>
										<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
										<option value="Brunei Darussalam">Brunei Darussalam</option>
										<option value="Bulgaria">Bulgaria</option>
										<option value="Burkina Faso">Burkina Faso</option>
										<option value="Burundi">Burundi</option>
										<option value="Cambodia">Cambodia</option>
										<option value="Cameroon">Cameroon</option>
										<option value="Canada">Canada</option>
										<option value="Cape Verde">Cape Verde</option>
										<option value="Cayman Islands">Cayman Islands</option>
										<option value="Central African Republic">Central African Republic</option>
										<option value="Chad">Chad</option>
										<option value="Chile">Chile</option>
										<option value="China">China</option>
										<option value="Christmas Island">Christmas Island</option>
										<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
										<option value="Colombia">Colombia</option>
										<option value="Comoros">Comoros</option>
										<option value="Congo">Congo</option>
										<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
										<option value="Cook Islands">Cook Islands</option>
										<option value="Costa Rica">Costa Rica</option>
										<option value="Cote D'ivoire">Cote D'ivoire</option>
										<option value="Croatia">Croatia</option>
										<option value="Cuba">Cuba</option>
										<option value="Cyprus">Cyprus</option>
										<option value="Czech Republic">Czech Republic</option>
										<option value="Denmark">Denmark</option>
										<option value="Djibouti">Djibouti</option>
										<option value="Dominica">Dominica</option>
										<option value="Dominican Republic">Dominican Republic</option>
										<option value="Ecuador">Ecuador</option>
										<option value="Egypt">Egypt</option>
										<option value="El Salvador">El Salvador</option>
										<option value="Equatorial Guinea">Equatorial Guinea</option>
										<option value="Eritrea">Eritrea</option>
										<option value="Estonia">Estonia</option>
										<option value="Ethiopia">Ethiopia</option>
										<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
										<option value="Faroe Islands">Faroe Islands</option>
										<option value="Fiji">Fiji</option>
										<option value="Finland">Finland</option>
										<option value="France">France</option>
										<option value="French Guiana">French Guiana</option>
										<option value="French Polynesia">French Polynesia</option>
										<option value="French Southern Territories">French Southern Territories</option>
										<option value="Gabon">Gabon</option>
										<option value="Gambia">Gambia</option>
										<option value="Georgia">Georgia</option>
										<option value="Germany">Germany</option>
										<option value="Ghana">Ghana</option>
										<option value="Gibraltar">Gibraltar</option>
										<option value="Greece">Greece</option>
										<option value="Greenland">Greenland</option>
										<option value="Grenada">Grenada</option>
										<option value="Guadeloupe">Guadeloupe</option>
										<option value="Guam">Guam</option>
										<option value="Guatemala">Guatemala</option>
										<option value="Guernsey">Guernsey</option>
										<option value="Guinea">Guinea</option>
										<option value="Guinea-bissau">Guinea-bissau</option>
										<option value="Guyana">Guyana</option>
										<option value="Haiti">Haiti</option>
										<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
										<option value="Honduras">Honduras</option>
										<option value="Hong Kong">Hong Kong</option>
										<option value="Hungary">Hungary</option>
										<option value="Iceland">Iceland</option>
										<option value="India">India</option>
										<option value="Indonesia">Indonesia</option>
										<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
										<option value="Iraq">Iraq</option>
										<option value="Ireland">Ireland</option>
										<option value="Isle of Man">Isle of Man</option>
										<option value="Isle of Wight">Isle of Wight</option>
										<option value="Israel">Israel</option>
										<option value="Italy">Italy</option>
										<option value="Jamaica">Jamaica</option>
										<option value="Japan">Japan</option>
										<option value="Jersey">Jersey</option>
										<option value="Jordan">Jordan</option>
										<option value="Kazakhstan">Kazakhstan</option>
										<option value="Kenya">Kenya</option>
										<option value="Kiribati">Kiribati</option>
										<option value="Kosovo">Kosovo</option>
										<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
										<option value="Korea, Republic of">Korea, Republic of</option>
										<option value="Kuwait">Kuwait</option>
										<option value="Kyrgyzstan">Kyrgyzstan</option>
										<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
										<option value="Latvia">Latvia</option>
										<option value="Lebanon">Lebanon</option>
										<option value="Lesotho">Lesotho</option>
										<option value="Liberia">Liberia</option>
										<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
										<option value="Liechtenstein">Liechtenstein</option>
										<option value="Lithuania">Lithuania</option>
										<option value="Luxembourg">Luxembourg</option>
										<option value="Macao">Macao</option>
										<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
										<option value="Madagascar">Madagascar</option>
										<option value="Malawi">Malawi</option>
										<option value="Malaysia">Malaysia</option>
										<option value="Maldives">Maldives</option>
										<option value="Mali">Mali</option>
										<option value="Malta">Malta</option>
										<option value="Marshall Islands">Marshall Islands</option>
										<option value="Martinique">Martinique</option>
										<option value="Mauritania">Mauritania</option>
										<option value="Mauritius">Mauritius</option>
										<option value="Mayotte">Mayotte</option>
										<option value="Mexico">Mexico</option>
										<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
										<option value="Moldova, Republic of">Moldova, Republic of</option>
										<option value="Monaco">Monaco</option>
										<option value="Mongolia">Mongolia</option>
										<option value="Montenegro">Montenegro</option>
										<option value="Montserrat">Montserrat</option>
										<option value="Morocco">Morocco</option>
										<option value="Mozambique">Mozambique</option>
										<option value="Myanmar">Myanmar</option>
										<option value="Namibia">Namibia</option>
										<option value="Nauru">Nauru</option>
										<option value="Nepal">Nepal</option>
										<option value="Netherlands">Netherlands</option>
										<option value="Netherlands Antilles">Netherlands Antilles</option>
										<option value="New Caledonia">New Caledonia</option>
										<option value="New Zealand">New Zealand</option>
										<option value="Nicaragua">Nicaragua</option>
										<option value="Niger">Niger</option>
										<option value="Nigeria">Nigeria</option>
										<option value="Niue">Niue</option>
										<option value="Norfolk Island">Norfolk Island</option>
										<option value="North Korea">North Korea</option>
										<option value="Northern Ireland">Northern Ireland</option>
										<option value="Northern Mariana Islands">Northern Mariana Islands</option>
										<option value="Norway">Norway</option>
										<option value="Oman">Oman</option>
										<option value="Pakistan">Pakistan</option>
										<option value="Palau">Palau</option>
										<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
										<option value="Panama">Panama</option>
										<option value="Papua New Guinea">Papua New Guinea</option>
										<option value="Paraguay">Paraguay</option>
										<option value="Peru">Peru</option>
										<option value="Philippines">Philippines</option>
										<option value="Poland">Poland</option>
										<option value="Portugal">Portugal</option>
										<option value="Puerto Rico">Puerto Rico</option>
										<option value="Qatar">Qatar</option>
										<option value="Reunion">Reunion</option>
										<option value="Romania">Romania</option>
										<option value="Russian Federation">Russian Federation</option>
										<option value="Rwanda">Rwanda</option>
										<option value="Saint Barthelemy">Saint Barthélemy</option>
										<option value="Saint Helena">Saint Helena</option>
										<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
										<option value="Saint Lucia">Saint Lucia</option>
										<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
										<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
										<option value="Samoa">Samoa</option>
										<option value="San Marino">San Marino</option>
										<option value="Sao Tome and Principe">Sao Tome and Principe</option>
										<option value="Saudi Arabia">Saudi Arabia</option>
										<option value="Senegal">Senegal</option>
										<option value="Serbia">Serbia</option>
										<option value="Seychelles">Seychelles</option>
										<option value="Sierra Leone">Sierra Leone</option>
										<option value="Singapore">Singapore</option>
										<option value="Slovakia">Slovakia</option>
										<option value="Slovenia">Slovenia</option>
										<option value="Solomon Islands">Solomon Islands</option>
										<option value="Somalia">Somalia</option>
										<option value="South Africa">South Africa</option>
										<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
										<option value="South Korea">South Korea</option>
										<option value="South Sudan">South Sudan</option>
										<option value="Spain">Spain</option>
										<option value="Sri Lanka">Sri Lanka</option>
										<option value="Sudan">Sudan</option>
										<option value="Suriname">Suriname</option>
										<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
										<option value="Swaziland">Swaziland</option>
										<option value="Sweden">Sweden</option>
										<option value="Switzerland">Switzerland</option>
										<option value="Syrian Arab Republic">Syrian Arab Republic</option>
										<option value="Taiwan, Province of China">Taiwan, Province of China</option>
										<option value="Tajikistan">Tajikistan</option>
										<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
										<option value="Thailand">Thailand</option>
										<option value="Timor-leste">Timor-leste</option>
										<option value="Togo">Togo</option>
										<option value="Tokelau">Tokelau</option>
										<option value="Tonga">Tonga</option>
										<option value="Trinidad and Tobago">Trinidad and Tobago</option>
										<option value="Tunisia">Tunisia</option>
										<option value="Turkey">Turkey</option>
										<option value="Turkmenistan">Turkmenistan</option>
										<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
										<option value="Tuvalu">Tuvalu</option>
										<option value="Uganda">Uganda</option>
										<option value="Ukraine">Ukraine</option>
										<option value="United Arab Emirates">United Arab Emirates</option>
										<option value="United States">United States</option>
										<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
										<option value="Uruguay">Uruguay</option>
										<option value="Uzbekistan">Uzbekistan</option>
										<option value="Vanuatu">Vanuatu</option>
										<option value="Venezuela">Venezuela</option>
										<option value="Vietnam">Vietnam</option>
										<option value="Virgin Islands, British">Virgin Islands, British</option>
										<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
										<option value="Wallis and Futuna">Wallis and Futuna</option>
										<option value="West Bank">West Bank</option>
										<option value="Western Sahara">Western Sahara</option>
										<option value="Yemen">Yemen</option>
										<option value="Zambia">Zambia</option>
										<option value="Zimbabwe">Zimbabwe</option>
									</select>
								<p class="addressSub">(Your company address)</p>
							</div>
							<div class="field" name="companyPostCode" id="companyPostCodeRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Post/Zip Code: </label>
								<input class="NQLRText" type="text" id="companyPostCodeRegister" name="companyPostCode" placeholder="Please Enter Your Company Post/Zip Code" value="BN2 1QY">
								<p class="addressSub">(Your company address)</p>
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
									<input class="NQLRText contact" name="landlinePrefix" id="landlinePrefixRegister" type="text" maxlength="6" value="44" placeholder="Please Enter the country code of your company">
									<input class="NQLRText contact" name="landlineExt" id="landlineExtRegister" type="text" maxlength="10" value="0" placeholder="Please enter your extension">
									<input class="NQLRText contact" name="landlineNumber" id="landlineNumberegister" type="text" maxlength="30" placeholder="Please Enter Your Landline Number">
								</span>
							</div>
							<div class="field" id="mobilelRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Mobile: </label>
								<span class="numberSpan">
									<strong class="plus">+</strong>
									<input class="NQLRText contact" name="mobilePrefix" id="mobilePrefixRegister" type="text" maxlength="6" value="44" placeholder="Please Enter the country code of your company">
									<input class="NQLRText contact" name="mobileExt" id="mobileExtRegister" type="text" maxlength="10" value="0" placeholder="Please enter your extension">
									<input class="NQLRText contact" name="mobileNumber" id="mobileNumberegister" type="text" maxlength="30" placeholder="Please Enter Your Mobile Number" value="07922955332">
								</span>
							</div>
							<div class="field" id="faxRegisterSection">
								<label class="NQLRLabel"><i class="fa fa-asterisk"></i> Fax: </label>
								<span class="numberSpan">
									<strong class="plus">+</strong>
									<input class="NQLRText contact" name="faxPrefix" id="faxPrefixRegister" type="text" maxlength="6" value="44" placeholder="Please Enter the country code of your company">
									<input class="NQLRText contact" name="faxExt" id="landlineExtRegister" type="text" maxlength="10" value="0" placeholder="Please enter your extension">
									<input class="NQLRText contact" name="faxNumber" id="faxNumberegister" type="text" maxlength="30" placeholder="Please Enter Your Fax Number">
								</span>
							</div>
						</fieldset>

						<fieldset>
							<legend>Legal Checks</legend>
							<div class="field" id="legalCheckRegisterSection">
								<p id="legal"><i class="fa fa-asterisk"></i><input type="checkbox" value="agree" name="legalChecked" id="legalCheck" Checked="checked"/>I have read and agree to the <a class="legalLink" href="legal.html">Terms and Conditions of use</a>
								<p id="dataVerify" ><i class="fa fa-asterisk"></i><input type="checkbox" value="agree" name="dataChecked" id="dataCheck" Checked="checked"/>All data here is correct and any errors made due to incorrect data will still be charged at normal rates
							</div>
						</fieldset>
						<a href="#" class="switchTo" id="switchToRegister2">Not Registered? Click Here</a>
						<a href="#" class="forgottenPassword" id="forgottenPassword1">Forgotten Password?</a>

						<!--Detects whether javascript is turned off or not, login form wont submit without js-->
						<noscript>
							<input type="hidden" name="javascriptDisabled" id="javascriptDisabledIndicatorLogin" value="Yes"/>
						</noscript>

						<input type="button" id="cancel" class="left" value="Cancel">
						<input type="submit" id="submitRegister" class="submit right" name="submitRegister" value="Submit">
					</form>
				</div>
			</div>

			<div class="clear"></div>

			<?php include($root.'/php/components/upperFooter.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/lowerFooter.php'); ?>

		</div>
		<!--End of Container-->

		<script type="text/javascript" src="/js/newBookingLogin/loginRegister.js"></script>
	</body>
</html>
<?php
	if(isset($_SESSION['form'])){
		unset($_SESSION['form']);
	}

	if(isset($_SESSION['loginErrors'])){
		unset($_SESSION['loginErrors']);
	}

	if(isset($_SESSION['registerErrors'])){
		unset($_SESSION['registerErrors']);
	}
?>
