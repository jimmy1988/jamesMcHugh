function changeTitles(text){
  $("#titleChange").html(" "+text);
  document.title = "New Quote "+ text + " - James McHugh Freelance Web Developer";
}

function hideElement(element){
  $(element).css({
    "display":"none"
  });
}

function showElement(element){
  $(element).css({
    "display":"block"
  })
}

function switchToLoginForm(e){
	e.preventDefault();
	$("#registerForm").fadeOut(1000,function(){
		hideElement($("#registerForm"));
		$("#loginForm").fadeIn(1000, function(){
			showElement($("#loginForm"));
			changeTitles("Login");
		});
	});
}

function switchToRegisterForm(e){
	e.preventDefault();
	$("#loginForm").fadeOut(1000, function(){
		hideElement($("#loginForm"));
		$("#registerForm").fadeIn(1000, function(){
			showElement($("#registerForm"));
			changeTitles("Register");
		});
	});
}

function validateRegistrationForm(){
	$(".errors").html("");

	var emailField=$("#emailRegister");
	var passwordField = $("#passwordRegister");
	var confirmPasswordField = $("#passwordConfirmRegister");
	var titleField = $("#titleRegister");
	var forenameField = $("#forenameRegister");
	var surnameField = $("#surnameRegister");
	var address1Field = $("#address1Register");
	var address2Field = $("#address2Register");
	var cityField = $("#cityRegister");
	var countyField = $("#countyRegister");
	var countryField = $("#countryRegister");
	var postCodeField = $("#postCodeRegister");
	var companyNameField=$("#companyNameRegister");
	var companyProfessionField=$("#companyProfessionRegister");
	var jobTitleField = $("#jobTitleRegister");
	var departmentField = $("#departmentRegister");
	var companyAddress1Field=$("#companyAddress1Register");
	var companyAddress2Field=$("#companyAddress2Register");
	var companyCityField=$("#companyCityRegister");
	var companyCountyField=$("#companyCountyRegister");
	var companyCountryField=$("#companyCountryRegister");
	var companyPostCodeField=$("#companyPostCodeRegister");
	var legalCheckField = $("#legalCheck");
	var dataCheckField = $("#dataCheck");

	var emailValid = checkTextBoxDefault($(emailField).val(),$("#errorRegister"), $(emailField).attr("id"), $(emailField));
	var passwordValid = checkTextBoxDefault($(passwordField).val(),$("#errorRegister"), $(passwordField).attr("id"), $(passwordField));
	var confirmPasswordValid = checkTextBoxDefault($(confirmPasswordField).val(),$("#errorRegister"), $(confirmPasswordField).attr("id"), $(confirmPasswordField));
	var titleValid = checkComboBoxDefault($(titleField).val(),$("#errorRegister"), $(titleField).attr("id"), $(titleField));
	var forenameValid = checkTextBoxDefault($(forenameField).val(),$("#errorRegister"), $(forenameField).attr("id"), $(forenameField));
	var surnameValid = checkTextBoxDefault($(surnameField).val(),$("#errorRegister"), $(surnameField).attr("id"), $(surnameField));
	var address1Valid = checkTextBoxDefault($(address1Field).val(),$("#errorRegister"), $(address1Field).attr("id"), $(address1Field));
	var address2Valid =checkAddess2($(address2Field));
	var cityValid = checkTextBoxDefault($(cityField).val(),$("#errorRegister"), $(cityField).attr("id"), $(cityField));
	var countyValid = checkTextBoxDefault($(countyField).val(),$("#errorRegister"), $(countyField).attr("id"), $(countyField));
	var countryValid = checkComboBoxDefault($(countryField).val(),$("#errorRegister"), $(countryField).attr("id"), $(countryField));
	var postCodeValid = checkTextBoxDefault($(postCodeField).val(),$("#errorRegister"), $(postCodeField).attr("id"), $(postCodeField));
	var companyNameValid=checkTextBoxDefault($(companyNameField).val(),$("#errorRegister"), $(companyNameField).attr("id"), $(companyNameField));
	var companyProfessionValid = checkTextBoxDefault($(companyProfessionField).val(),$("#errorRegister"), $(companyProfessionField).attr("id"), $(companyProfessionField));
	var jobTitleValid = checkTextBoxDefault($(jobTitleField).val(),$("#errorRegister"), $(jobTitleField).attr("id"), $(jobTitleField));
	var departmentValid = checkTextBoxDefault($(departmentField).val(),$("#errorRegister"), $(departmentField).attr("id"), $(departmentField));
	var companyAddress1Valid = checkTextBoxDefault($(companyAddress1Field).val(),$("#errorRegister"), $(companyAddress1Field).attr("id"), $(companyAddress1Field));
	var companyAddress2Valid = checkAddess2($(companyAddress2Field));
	var companyCityValid = checkTextBoxDefault($(companyCityField).val(),$("#errorRegister"), $(companyCityField).attr("id"), $(companyCityField));
	var companyCountyValid = checkTextBoxDefault($(companyCountyField).val(),$("#errorRegister"), $(companyCountyField).attr("id"), $(companyCountyField));
	var companyCountryValid = checkTextBoxDefault($(companyCountryField).val(),$("#errorRegister"), $(companyCountryField).attr("id"), $(companyCountryField));
	var companyPostCodeValid = checkTextBoxDefault($(companyPostCodeField).val(),$("#errorRegister"), $(companyPostCodeField).attr("id"), $(companyPostCodeField));
	var phoneNumbersValid=checkPhoneNumbers();
	var legalCheckValid = checkCheckBoxdefault($(legalCheckField).val(),$("#errorRegister"), $(legalCheckField).attr("id"), $(legalCheckField));
	var dataCheckValid = checkCheckBoxdefault($(dataCheckField).val(),$("#errorRegister"), $(dataCheckField).attr("id"), $(dataCheckField));

	//modify the above procedures and validate them as before in the login
	//extend the functionality of the phone numbers to detect which ones are filled

	if(emailValid &&
		passwordValid &&
		confirmPasswordValid &&
		titleValid &&
		forenameValid &&
		surnameValid &&
		address1Valid &&
		address2Valid &&
		cityValid &&
		countyValid &&
		countryValid &&
		postCodeValid &&
		companyNameValid &&
		companyProfessionValid &&
		jobTitleValid &&
		departmentValid &&
		companyAddress1Valid &&
		companyAddress2Valid &&
		companyCityValid &&
		companyCountyValid &&
		companyCountryValid &&
		companyPostCodeValid &&
		phoneNumbersValid &&
		legalCheckValid &&
		dataCheckValid)
	{

		//check email address format
		//check both passwords for format
		//check that passswords match
		emailValid="";
		passwordValid="";
		confirmPasswordValid="";

		emailValid=checkEmail($(emailField).val(), $("#errorRegister"), $(emailField).attr("id"),  $(emailField));
		passwordValid=validatePassword($(passwordField).val(), $("#errorRegister"), $(passwordField).attr("id"),  $(passwordField));
		confirmPasswordValid=validatePassword($(confirmPasswordField).val(), $("#errorRegister"), $(confirmPasswordField).attr("id"),  $(confirmPasswordField));

		if(emailValid && passwordValid && confirmPasswordValid){
			if(checkPasswords($(passwordField).val(), $(confirmPasswordField).val())){
				var dataChecked=changeCheckValue($("#dataCheck").prop("checked"));
				var legalChecked=changeCheckValue($("#legalCheck").prop("checked"));

				var data=new Array();
				data[0]=prepareString($(emailField).val());
				data[1]=prepareString($(passwordField).val());
				data[2]=prepareString($(confirmPasswordField).val());
				data[3]=prepareString($(titleField).val());
				data[4]=prepareString($(forenameField).val());
				data[5]=prepareString($(surnameField).val());
				data[6]=prepareString($(address1Field).val());
				data[7]=prepareString($("#address2Register").val());
				data[8]=prepareString($(cityField).val());
				data[9]=prepareString($(countyField).val());
				data[10]=prepareString($(countryField).val());
				data[11]=prepareString($(postCodeField).val());
				data[12]=prepareString($(companyNameField).val());
				data[13]=prepareString($(companyProfessionField).val());
				data[14]=prepareString($(jobTitleField).val());
				data[15]=prepareString($(departmentField).val());
				data[16]=prepareString($(companyAddress1Field).val());
				data[17]=prepareString($(companyAddress2Field).val());
				data[18]=prepareString($(companyCityField).val());
				data[19]=prepareString($(companyCountyField).val());
				data[20]=prepareString($(companyCountryField).val());
				data[21]=prepareString($(companyPostCodeField).val());
				data[22]=prepareString($("#landlinePrefixRegister").val());
				data[23]=prepareString($("#landlineExtRegister").val());
				data[24]=prepareString($("#landlineNumberRegister").val());
				data[25]=prepareString($("#mobilePrefixRegister").val());
				data[26]=prepareString($("#mobileExtRegister").val());
				data[27]=prepareString($("#mobileNumberRegister").val());
				data[28]=prepareString($("#faxPrefixRegister").val());
				data[29]=prepareString($("#faxExtRegister").val());
				data[30]=prepareString($("#faxNumberRegister").val());
				data[31]=prepareString(dataChecked);
				data[32]=prepareString(legalChecked);
				registerUser(data);
			}else{
				message = "Passwords do not match";
				addError(message);
				$("#errorsRegister").html(displayErrors());
				scrollTo("errorsRegister");
			}
		}else{
			$("#errorsRegister").html(displayErrors());
			scrollTo("errorsRegister");
		}
	}else{
		$("#errorsRegister").html(displayErrors());
		scrollTo("errorsRegister");
	}

}

function validateLoginForm(){

	$(".errors").html("");

	var emailField=$("#emailLogin");
	var passwordField = $("#passwordLogin");
	var emailValid = checkTextBoxDefault($(emailField).val(),$("#errorLogin"), $(emailField).attr("id"), $(emailField));
	var passwordValid = checkTextBoxDefault($(passwordField).val(),$("#errorLogin"), $(passwordField).attr("id"), $(passwordField));

	if(emailValid && passwordValid){
		//next stage of validation
		emailValid="";
		passwordValid="";
		emailValid=checkEmail($(emailField).val(), $("#errorLogin"), $(emailField).attr("id"),  $(emailField));
		passwordValid=validatePassword($(passwordField).val(), $("#errorLogin"), $(passwordField).attr("id"),  $(passwordField));
		if (emailValid && passwordValid){
			//next stage
			return true;
		}else{
			//generate error
			$("#errorLogin").html(displayErrors());
			scrollTo("errorLogin");
			return false;
		}
	}else{
		//generate error
		$("#errorLogin").html(displayErrors());
		scrollTo("errorLogin");
		return false;
	}
}


$(document).ready(function(){

	$("#countryRegister").on("change", updateCountryCode);

  $("#switchToLogin1, #switchToLogin2").on("click",switchToRegisterForm);
  $("#switchToRegister1,#switchToRegister2").on("click",switchToLoginForm);

});
