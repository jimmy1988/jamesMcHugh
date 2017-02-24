var errors = new Array();
var message="";

function addError(error){
	errors.push(error);
	message="";
}

function clearErrors(){
	for(var j = errors.length-1; j >= 0;j--){
		errors.pop();
	}
}

function clearErrorMessages(classElement){
	if(classElement == undefined){
		classElement = ".errors";
	}
	$(classElement).empty();
}

function displayErrors(){
	var o;
	o="<p>Please fix the following errors: </p><ul>";
	for(var i=0;i<errors.length;i++){
	 	o = o + "<li>" + errors[i] + "</li>";
	}

	o.concat("</ul>");
	clearErrors();
	return o;
}

function checkEmpty(fieldValue){
	return fieldValue=="";
}

function checkEmailFormat(fieldValue){
	var at =fieldValue.indexOf("@")
	if (at==-1){
			return false;
	}else{
		var dot = fieldValue.indexOf(".", at);
		if ( dot==-1){
			return false;
		}else{
			var field2 = fieldValue.slice(dot+1);
			if ((field2.length) <= 2 ){
				return false;
			}else{
				return true;
			}
		}
	}
}

function checkEmail(fieldValue, errorField, id, field) {

	if(checkEmpty(fieldValue)){
		message=id + " cannot be blank";
		addError(message);
		return false;
	}else{

		if (!checkEmailFormat(fieldValue)){
			message = id + " has an Incorrect format for the field";
			addError(message);
			return false;
		}else{
			return true;
		}

	}
}

function checkPasswords(password1, password2){
	return password1==password2;
}

function switchID(id){
	switch(id){

		case("emailLogin"):
			id="Email";
			break
		case("passwordLogin"):
			id="Password";
			break;
		case("emailRegister"):
			id="Email";
			break;
		case("passwordRegister"):
			id="Password";
			break;
		case("passwordConfirmRegister"):
			id="Confirm Password";
			break;
		case("titleRegister"):
      id="Title";
      break;
		case("forenameRegister"):
			id="Forename";
			break;
		case("surnameRegister"):
			id="Surname";
			break;
		case("address1Register"):
			id="Address 1";
			break;
		case("address2Register"):
			id="Address 2";
			break;
		case("cityRegister"):
			id="City";
			break;
		case("countyRegister"):
			id="County";
			break;
		case("postCodeRegister"):
			id="PostCode";
			break;
		case("companyNameRegister"):
			id="Company Name";
			break;
		case("jobTitleRegister"):
			id="Job Title";
			break;
		case("departmentRegister"):
			id="Department";
			break;
		case("companyAddress1Register"):
			id="Address 1";
			break;
		case("companyAddress2Register"):
			id="Address 2";
			break;
		case("companyCityRegister"):
			id="City";
			break;
		case("companyCountyRegister"):
			id="County";
			break;
		case("companyCountryRegister"):
			id="Country";
			break;
		case("companyPostCodeRegister"):
			id="Post Code";
			break;
		case("landlinePrefixRegister"):
			id="Landline Prefix";
			break;
		case("landlineExtRegister"):
			id="Landline Extension";
			break;
		case("landlineNumberegister"):
			id="Landline Prefix";
			break;
		case("mobilePrefixRegister"):
			id="Mobile Prefix";
			break;
		case("mobileExtRegister"):
			id="Mobile Extension";
			break;
		case("mobileNumberegister"):
			id="Mobile Number";
			break;
		case("faxPrefixRegister"):
			id="Fax Prefix";
			break;
		case("faxExtRegister"):
			id="Fax Extension";
			break;
		case("faxNumberegister"):
			id="Fax Number";
			break;
    case("countryRegister"):
      id="Country";
      break;
		case("legalCheck"):
      id="Legal Check";
      break;
    case("dataCheck"):
      id="Data Protection";
      break;
		default:
			id="unknown";
			break;
	}
	return id;
}

function checkEmailFormat(fieldValue){
	// check for duplicate @ signs
	var at = fieldValue.indexOf("@");
	if (at==-1){
			return false;
	}else{
		//indicates a duplicate @ sign
		var newString = fieldValue.slice(at+1);
		var at2=newString.indexOf("@");
		 if(at2==-1){
			var dot = fieldValue.indexOf(".", at);
			if (dot==-1){
				return false;
			}else{
				var field2 = fieldValue.slice(dot+1);
				if ((field2.length) <= 2 ){
					return false;
				}else{
					return true;
				}
			}
		}else{
			return false;
		}
	}
}

function checkLength(field, id, min, max){
  if(field.length >= min && field.length <= max){
    return true;
  }else{
    message = id + " must be more than + " + min + " characters and less than " + max + " characters long";
    addError(message);
    return false;
  }
}

function convertStringToNumber(string){
	switch(string){
		case("0"):
			string=0;
			break;
		case("1"):
			string=1;
			break;
		case("2"):
			string=2;
			break;
		case("3"):
			string=3;
			break;
		case("4"):
			string=4;
			break;
		case("5"):
			string=5;
			break;
		case("6"):
			string=6;
			break;
		case("7"):
			string=7;
			break;
		case("8"):
			string=8;
			break;
		case("9"):
			string=9;
			break;
		default:
			break;
	}

	return string;
}

function validatePassword(fieldValue, errorField, id, field){

	//changes over the id
	if(id=="passwordConfirmRegister"){
		id="Confirm Password";
	}else{
		id="Password";
	}

  if (checkLength(fieldValue, id, 5, 12)){
    //next stage, search for capital letter
		var valid1 = false;
		var string = fieldValue.split("");
		for(var i=0;i<string.length;i++){
			if(isNaN(string[i])){
				if(string[i] == string[i].toUpperCase()){
					valid1=true;
					break;
				}else{
					valid1=false;
				}
			}else{
				continue;
			}
		}

		if (valid1=true){
			var valid2=false;
			for(var k=0;k<string.length;k++){
				string[k] = convertStringToNumber(string[k]);
				if(isNaN(string[k])){
					valid2=false;
				}else{
					valid2=true;
					break;
				}
			}

			if (valid2=true){
				return valid2;
			}else{
				message=id + " needs to have a number letter within it";
				addError(message);
				return valid2;
			}
		}else{
			return false;
		}
  }else{
		message=id + " needs to have a capital letter within it";
		addError(message);
    return false;
  }
}

function checkEmail(fieldValue, errorField, id, field) {

	if(checkEmpty(fieldValue)){
		message=id + " cannot be blank";
		addError(message);
		return false;
	}else{

		if (!checkEmailFormat(fieldValue)){
			message = id + " has an incorrect format for the field";
			addError(message);
			return false;
		}else{
			return true;
		}
	}
}

function checkCheckBoxdefault(fieldValue,errorField, id, field, switchID){

	if(switchID == undefined){
		switchID=true;
	}

	if(switchID=true){
		id=switchID(id);
	}

  if ($(field).attr("Checked") == false){
    message=id + " Needs to be Checked";
    addError(message);
    return false;
  }else{
    return true;
  }
}

function checkComboBoxDefault(fieldValue,errorField, id, field, switchID){

	if(switchID == undefined){
		switchID=true;
	}

	if(switchID=true){
		id=switchID(id);
	}

  if ($(field).val()=="No Select"){
    message=id + " Needs a Selection";
    addError(message);
    return false;
  }else{
    return true;
  }
}

//check and modify if necessary
function checkTextBoxDefault(fieldValue, errorField, id, field, switchID){

	if(switchID == undefined){
		switchID=true;
	}

	if(switchID=true){
		id=switchID(id);
	}

	if (checkEmpty(fieldValue)){
		message=id + " cannot be blank";
		addError(message);
		return false;
	}else{
		return true;
	}
}

function getCountryCode(country){
	var code;

	switch(country){
			case ("Afghanistan"):
				code= "93";
				break;
			case ("Åland Islands"):
				code= "358";
				break;
			case ("Albania"):
				code= "355";
				break;
			case ("Algeria"):
				code= "213";
				break;
			case ("American Samoa"):
				code= "1684";
				break;
			case ("Andorra"):
				code= "376";
				break;
			case ("Angola"):
				code= "244";
				break;
			case ("Anguilla"):
				code= "1264";
				break;
			case ("Antarctica"):
				code= "6721";
				break;
			case ("Antigua and Barbuda"):
				code= "1268";
				break;
			case ("Argentina"):
				code= "54";
				break;
			case ("Armenia"):
				code= "374";
				break;
			case ("Aruba"):
				code= "297";
				break;
			case ("Australia"):
				code= "61";
				break;
			case ("Austria"):
				code= "43";
				break;
			case ("Azerbaijan"):
				code= "994";
				break;
			case ("Bahamas"):
				code= "1242";
				break;
			case ("Bahrain"):
				code= "973";
				break;
			case ("Bangladesh"):
				code= "880";
				break;
			case ("Barbados"):
				code= "1246";
				break;
			case ("Belarus"):
				code= "375";
				break;
			case ("Belgium"):
				code= "32";
				break;
			case ("Belize"):
				code= "";
				break;
			case ("Benin"):
				code= "501";
				break;
			case ("Bermuda"):
				code= "1441";
				break;
			case ("Bhutan"):
				code= "975";
				break;
			case ("Bolivia"):
				code= "591";
				break;
			case ("Bosnia and Herzegovina"):
				code= "387";
				break;
			case ("Botswana"):
				code= "267";
				break;
			case ("Brazil"):
				code= "55";
				break;
			case ("British Indian Ocean Territory"):
				code= "246";
				break;
			case ("Brunei Darussalam"):
				code= "673";
				break;
			case ("Bulgaria"):
				code= "359";
				break;
			case ("Burkina Faso"):
				code= "226";
				break;
			case ("Burundi"):
				code= "257";
				break;
			case ("Cambodia"):
				code= "855";
				break;
			case ("Cameroon"):
				code= "237";
				break;
			case ("Canada"):
				code= "1";
				break;
			case ("Cape Verde"):
				code= "238";
				break;
			case ("Cayman Islands"):
				code= "1345";
				break;
			case ("Central African Republic"):
				code= "236";
				break;
			case ("Chad"):
				code= "235";
				break;
			case ("Chile"):
				code= "56";
				break;
			case ("China"):
				code= "86";
				break;
			case ("Christmas Island"):
				code= "61";
				break;
			case ("Cocos (Keeling) Islands"):
				code= "891";
				break;
			case ("Colombia"):
				code= "57";
				break;
			case ("Comoros"):
				code= "269";
				break;
			case ("Congo"):
				code= "242";
				break;
			case ("Congo, The Democratic Republic of The"):
				code= "243";
				break;
			case ("Cook Islands"):
				code="682";
				break;
			case ("Costa Rica"):
				code= "506";
				break;
			case ("Cote D'ivoire"):
				code= "";
				break;
			case ("Cuba"):
				code= "";
				break;
			case ("Cyprus"):
				code= "";
				break;
			case ("Czech Republic"):
				code= "225";
				break;
			case ("Denmark"):
				code= "45";
				break;
			case ("Djibouti"):
				code= "253";
				break;
			case ("Dominica"):
				code= "1767";
				break;
			case ("Dominican Republic"):
				code= "1809";
				break;
			case ("Ecuador"):
				code= "670";
				break;
			case ("Egypt"):
				code= "20";
				break;
			case ("El Salvador"):
				code= "503";
				break;
			case ("Equatorial Guinea"):
				code= "240";
				break;
			case ("Eritrea"):
				code= "291";
				break;
			case ("Estonia"):
				code= "372";
				break;
			case ("Ethiopia"):
				code= "251";
				break;
			case ("Falkland Islands (Malvinas)"):
				code= "500";
				break;
			case ("Faroe Islands"):
				code= "298";
				break;
			case ("Fiji"):
				code= "679";
				break;
			case ("Finland"):
				code= "358";
				break;
			case ("France"):
				code= "33";
				break;
			case ("French Guiana"):
				code= "594";
				break;
			case ("French Polynesia"):
				code= "689";
				break;
			case ("French Southern Territories"):
				code= "3166";
				break;
			case ("Gabon"):
				code= "241";
				break;
			case ("Gambia"):
				code= "220";
				break;
			case ("Georgia"):
				code= "995";
				break;
			case ("Germany"):
				code= "49";
				break;
			case ("Ghana"):
				code= "233";
				break;
			case ("Gibraltar"):
				code= "350";
				break;
			case ("Greece"):
				code= "30";
				break;
			case ("Greenland"):
				code= "299";
				break;
			case ("Grenada"):
				code= "1473";
				break;
			case ("Guadeloupe"):
				code= "590";
				break;
			case ("Guam"):
				code= "1671";
				break;
			case ("Guatemala"):
				code= "502";
				break;
			case ("Guernsey"):
				code= "44";
				break;
			case ("Guinea"):
				code= "224";
				break;
			case ("Guinea-bissau"):
				code= "245";
				break;
			case ("Guyana"):
				code= "592";
				break;
			case ("Haiti"):
				code= "509";
				break;
			case ("Holy See (Vatican City State)"):
				code= "379";
				break;
			case("Honduras"):
				code="504";
				break;
			case ("Hong Kong"):
				code= "852";
				break;
			case ("Hungary"):
				code= "36";
				break;
			case ("Iceland"):
				code= "354";
				break;
			case ("India"):
				code= "91";
				break;
			case ("Indonesia"):
				code= "62";
				break;
			case ("Iran, Islamic Republic of"):
				code= "98";
				break;
			case ("Iraq"):
				code= "964";
				break;
			case ("Ireland"):
				code= "353";
				break;
			case ("Isle of Man"):
				code= "44";
				break;
			case ("Isle of Wight"):
				code= "44";
				break;
			case ("Israel"):
				code= "972";
				break;
			case ("Italy"):
				code= "39";
				break;
			case ("Jamaica"):
				code= "1876";
				break;
			case ("Japan"):
				code= "81";
				break;
			case ("Jersey"):
				code= "44";
				break;
			case ("Jordan"):
				code= "962";
				break;
			case ("Kazakhstan"):
				code= "7";
				break;
			case ("Kenya"):
				code= "254";
				break;
			case ("Kiribati"):
				code= "686";
				break;
			case ("Korea, Democratic People's Republic of"):
				code= "850";
				break;
			case ("Korea, Republic of"):
				code= "82";
				break;
			case ("Kosovo"):
				code="377";
				break;
			case ("Kuwait"):
				code= "965";
				break;
			case ("Kyrgyzstan"):
				code= "996";
				break;
			case ("Lao People's Democratic Republic"):
				code= "856";
				break;
			case ("Latvia"):
				code= "371";
				break;
			case ("Lebanon"):
				code= "961";
				break;
			case ("Lesotho"):
				code= "266";
				break;
			case ("Liberia"):
				code= "231";
				break;
			case ("Libyan Arab Jamahiriya"):
				code= "218";
				break;
			case ("Liechtenstein"):
				code= "423";
				break;
			case ("Lithuania"):
				code= "370";
				break;
			case ("Luxembourg"):
				code= "352";
				break;
			case ("Macao"):
				code= "853";
				break;
			case ("Macedonia, The Former Yugoslav Republic of"):
				code= "389";
				break;
			case ("Madagascar"):
				code= "261";
				break;
			case ("Malawi"):
				code= "265";
				break;
			case ("Malaysia"):
				code= "60";
				break;
			case ("Maldives"):
				code= "960";
				break;
			case ("Mali"):
				code= "223";
				break;
			case ("Malta"):
				code= "356";
				break;
			case ("Marshall Islands"):
				code= "692";
				break;
			case ("Martinique"):
				code= "596";
				break;
			case ("Mauritania"):
				code= "222";
				break;
			case ("Mauritius"):
				code= "230";
				break;
			case ("Mayotte"):
				code= "262";
				break;
			case ("Mexico"):
				code= "52";
				break;
			case ("Micronesia, Federated States of"):
				code= "691";
				break;
			case ("Moldova, Republic of"):
				code= "373";
				break;
			case ("Monaco"):
				code= "377";
				break;
			case ("Mongolia"):
				code= "376";
				break;
			case ("Montenegro"):
				code= "382";
				break;
			case ("Montserrat"):
				code= "1664";
				break;
			case ("Morocco"):
				code= "212";
				break;
			case ("Mozambique"):
				code= "258";
				break;
			case ("Myanmar"):
				code= "95";
				break;
			case ("Namibia"):
				code= "264";
				break;
			case ("Nauru"):
				code= "674";
				break;
			case ("Nepal"):
				code= "677";
				break;
			case ("Netherlands"):
				code= "31";
				break;
			case ("Netherlands Antilles"):
				code= "599";
				break;
			case ("New Caledonia"):
				code= "687";
				break;
			case ("New Zealand"):
				code= "64";
				break;
			case ("Nicaragua"):
				code= "505";
				break;
			case ("Niger"):
				code= "227";
				break;
			case ("Nigeria"):
				code= "234";
				break;
			case ("Niue"):
				code= "683";
				break;
			case ("Norfolk Island"):
				code= "2723";
				break;
			case("North Korea"):
				code="850";
				break;
			case ("Northern Ireland"):
				code="44";
				break;
			case ("Northern Mariana Islands"):
				code= "1670";
				break;
			case ("Norway"):
				code= "47";
				break;
			case ("Oman"):
				code= "968";
				break;
			case ("Pakistan"):
				code= "92";
				break;
			case ("Palau"):
				code= "980";
				break;
			case ("Palestinian Territory, Occupied"):
				code= "970";
				break;
			case ("Panama"):
				code= "507";
				break;
			case ("Papua New Guinea"):
				code= "675";
				break;
			case ("Paraguay"):
				code= "595";
				break;
			case ("Peru"):
				code= "51";
				break;
			case ("Philippines"):
				code= "63";
				break;
			case ("Poland"):
				code= "48";
				break;
			case ("Portugal"):
				code= "351";
				break;
			case ("Puerto Rico"):
				code= "1787";
				break;
			case ("Qatar"):
				code= "974";
				break;
			case ("Reunion"):
				code= "262";
				break;
			case ("Romania"):
				code= "40";
				break;
			case ("Russian Federation"):
				code= "7";
				break;
			case ("Rwanda"):
				code= "250";
				break;
			case ("Saint Barthelemy"):
				code = "590";
				break;
			case ("Saint Helena"):
				code= "290";
				break;
			case ("Saint Kitts and Nevis"):
				code= "1869";
				break;
			case ("Saint Lucia"):
				code= "1758";
				break;
			case ("Saint Pierre and Miquelon"):
				code= "508";
				break;
			case ("Saint Vincent and The Grenadines"):
				code= "1784";
				break;
			case ("Samoa"):
				code= "685";
				break;
			case ("San Marino"):
				code= "378";
				break;
			case ("Sao Tome and Principe"):
				code= "239";
				break;
			case ("Saudi Arabia"):
				code= "966";
				break;
			case ("Senegal"):
				code= "221";
				break;
			case ("Serbia"):
				code= "381";
				break;
			case ("Seychelles"):
				code= "248";
				break;
			case ("Sierra Leone"):
				code= "232";
				break;
			case ("Singapore"):
				code= "65";
				break;
			case ("Slovakia"):
				code= "";
				break;
			case ("Slovenia"):
				code= "386";
				break;
			case ("Solomon Islands"):
				code= "677";
				break;
			case ("Somalia"):
				code= "252";
				break;
			case ("South Africa"):
				code= "27";
				break;
			case ("South Georgia and The South Sandwich Islandscase"):
				code= "3166";
				break;
			case ("South Korea"):
				code="82";
				break;
			case ("South Sudan"):
				code="211";
				break;
			case ("Spain"):
				code= "34";
				break;
			case ("Sri Lanka"):
				code= "94";
				break;
			case ("Sudan"):
				code= "249";
				break;
			case ("Suriname"):
				code= "597";
				break;
			case ("Svalbard and Jan Mayen"):
				code= "3166";
				break;
			case ("Swaziland"):
				code= "268";
				break;
			case ("Sweden"):
				code= "46";
				break;
			case ("Switzerland"):
				code= "41";
				break;
			case ("Syrian Arab Republic"):
				code= "963";
				break;
			case ("Taiwan, Province of China"):
				code= "886";
				break;
			case ("Tajikistan"):
				code= "992";
				break;
			case ("Tanzania, United Republic of"):
				code= "255";
				break;
			case ("Thailand"):
				code= "66";
				break;
			case ("Timor-leste"):
				code= "670";
				break;
			case ("Togo"):
				code= "228";
				break;
			case ("Tokelau"):
				code= "690";
				break;
			case ("Tonga"):
				code= "676";
				break;
			case ("Trinidad and Tobago"):
				code= "1868";
				break;
			case ("Tunisia"):
				code= "216";
				break;
			case ("Turkey"):
				code= "90";
				break;
			case ("Turkmenistan"):
				code= "993";
				break;
			case ("Turks and Caicos Islands"):
				code= "1649";
				break;
			case ("Tuvalu"):
				code= "688";
				break;
			case ("Uganda"):
				code= "256";
				break;
			case ("Ukraine"):
				code= "380";
				break;
			case ("United Arab Emirates"):
				code= "971";
				break;
			case ("United Kingdom"):
				code= "44";
				break;
			case ("United States"):
				code= "1";
				break;
			case ("United States Minor Outlying Islands"):
				code= "3166";
				break;
			case ("Uruguay"):
				code= "598";
				break;
			case ("Uzbekistan"):
				code= "998";
				break;
			case ("Vanuatu"):
				code= "678";
				break;
			case ("Venezuela"):
				code= "58";
				break;
			case ("Vietnam"):
				code= "84";
				break;
			case ("Virgin Islands, British"):
				code= "1";
				break;
			case ("Virgin Islands, U.S."):
				code= "1340";
				break;
			case ("Wallis and Futuna"):
				code= "681";
				break;
			case ("West Bank"):
				code="970";
				break;
			case ("Western Sahara"):
				code= "212";
				break;
			case ("Yemen"):
				code= "967";
				break;
			case ("Zambia"):
				code= "260";
				break;
			case ("Zimbabwe"):
				code= "263";
				break;
			default:
				code="00";
				break;
	}
	return code;
}

function checkAddess2(address2){
	var	address2Field = address2;
	var address2Valid=false;

	if($(address2Field).val() != ""){
		if(checkTextBoxDefault($(address2Field).val(),$("#errorRegister"), $(address2Field).attr("id"), $(address2Field))){
			address2Valid=true;
		}else{
			address2Valid=false;
		}
	}else{
		address2Valid=true;
	}
	return address2Valid;
}

function updateCountryCode(){

	var data=$("#countryRegister").val();
	var code = getCountryCode(data);

	//clear all fields
	$("#landlinePrefixRegister").val();
	$("#mobilePrefixRegister").val();
	$("#faxPrefixRegister").val();

	//update the codes
	$("#landlinePrefixRegister").val(code);
	$("#mobilePrefixRegister").val(code);
	$("#faxPrefixRegister").val(code);
}

function checkPhoneNumbers(){
	//extend functionality to account for extension numbers

	var landlineValid=false;
	var mobileValid=false;
	var faxValid=false;
	var valid=false;

	var landlinePrefixField = $("#landlinePrefixRegister");
	var landlineExtField = $("#landlineExtRegister");
	var landlineNumberField = $("#landlineNumberRegister");
	var mobilePrefixField = $("#mobilePrefixRegister");
	var mobileExtField = $("#mobileExtRegister");
	var mobileNumberField = $("#mobileNumberRegister");
	var faxPrefixField = $("#faxPrefixRegister");
	var faxExtField = $("#faxExtRegister");
	var faxNumberField = $("#faxNumberRegister");

	if ($(landlineNumberField).val()!=""){
		var landlinePrefixValid = checkTextBoxDefault($(landlinePrefixField).val(),$("#errorRegister"), $(landlinePrefixField).attr("id"), $(landlinePrefixField));
		var landlineExtValid = checkTextBoxDefault($(landlineExtField).val(),$("#errorRegister"), $(landlineExtField).attr("id"), $(landlineExtField));
		var landlineNumberValid = checkTextBoxDefault($(landlineNumberField).val(),$("#errorRegister"), $(landlineNumberField).attr("id"), $(landlineNumberField));

		if(landlinePrefixValid && landlineExtValid && landlineNumberValid){
			landlineValid=true
		}else{
			landlineValid=false;
		}
	}else{
		landlineValid=true;
		$(landlinePrefixField).val($(landlinePrefixField).val());
		$(landlineExtField).val($(landlineExtField).val());
		$(landlineNumberField).val("0");
	}

	if($(mobileNumberField).val()!=""){
		var mobilePrefixValid = checkTextBoxDefault($(mobilePrefixField).val(),$("#errorRegister"), $(mobilePrefixField).attr("id"), $(mobilePrefixField));
		var mobileExtValid = checkTextBoxDefault($(mobileExtField).val(),$("#errorRegister"), $(mobileExtField).attr("id"), $(mobileExtField));
		var mobileNumberValid = checkTextBoxDefault($(mobileNumberField).val(),$("#errorRegister"), $(mobileNumberField).attr("id"), $(mobileNumberField));

		if(mobilePrefixValid && mobileExtValid && mobileNumberValid){
			mobileValid=true;
		}else{
			mobileValid = false;
		}
	}else{
		mobileValid=true;
		$(mobilePrefixField).val($(mobilePrefixField).val());
		$(mobileExtField).val($(mobileExtField).val());
		$(mobileNumberField).val("0");
	}

	if($(faxNumberField).val()==""){
		var faxPrefixValid = checkTextBoxDefault($(faxPrefixField).val(),$("#errorRegister"), $(faxPrefixField).attr("id"), $(faxPrefixField));
		var faxExtValid = checkTextBoxDefault($(faxExtField).val(),$("#errorRegister"), $(faxExtField).attr("id"), $(faxExtField));
		var faxNumberValid = checkTextBoxDefault($(faxNumberField).val(),$("#errorRegister"), $(faxNumberField).attr("id"), $(faxNumberField));

		if(faxPrefixValid && faxExtValid && faxNumberValid){
			faxValid=true;
		}else{
			faxValid=false;
			$(faxPrefixField).val($(mobilePrefixField).val());
			$(faxExtField).val($(mobileExtField).val());
			$(faxNumberField).val("0");
		}
	}else{
		faxValid=true;
	}

	//validate all three

	if(
			$(faxNumberField).val()=="" &&
			$(mobileNumberField).val()!=="" &&
			$(landlineNumberField).val()!==""
		)
	{
		valid=false;
	}else{
		if(landlineValid && mobileValid && faxValid){
			valid=true;
		}else{
			valid=false;
		}
	}
	return valid;
}

function changeCheckValue(value){
	if (value=true){
		value=1;
	}else{
		value=0;
	}
	return value;
}
