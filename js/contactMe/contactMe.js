function isValid(){
		clearErrorMessages();
		$("#submit").css({ "display":"none"});
		$("#spinnerContainer").css({"display":"block"});

		var firstNameCheck = checkTextBoxDefault($("#firstName").val(),$(".error"), $("#firstName").attr('id'), $("#firstName"), false);
		var surnameCheck = checkTextBoxDefault($("#surname").val(),$("#surname_error"), $("#surname").attr('id'), $("#surname"), false);
		var emailCheck = checkEmail($("#email").val(),$("#email_error"),$("#email").attr('id'), $("#email"), false);
		var messageCheck = checkTextBoxDefault($("#message").val(),$("#message_error"), $("#message").attr('id'), $("#message"), false);

		if ( !emailCheck || !firstNameCheck || !surnameCheck || !messageCheck){
			$(".errors").html(displayErrors());
			$("#spinnerContainer").css({"display":"none"});
			$("#submit").css({ "display":"block"});
			return false;
		}else{
			$("#submit").css({ "display":"none"});
			$("#spinnerContainer").css({"display":"block"});
			//send to server
			return true;
		}
}
