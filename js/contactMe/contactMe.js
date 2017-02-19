function isValid(){
		clearErrorMessages();
		$("#submit").css({ "display":"none"});
		$("#spinnerContainer").css({"display":"block"});

		var firstNameCheck = checkTextBoxDefault($("#firstName").val(),$("#firstName_error"), $("#firstName").attr('id'), $("#firstName"));
		var surnameCheck = checkTextBoxDefault($("#surname").val(),$("#surname_error"), $("#surname").attr('id'), $("#surname"));
		var emailCheck = checkEmail($("#email").val(),$("#email_error"),$("#email").attr('id'), $("#email"));
		var messageCheck = checkTextBoxDefault($("#message").val(),$("#message_error"), $("#message").attr('id'), $("#message"));

		if ( !emailCheck || !firstNameCheck || !surnameCheck || !messageCheck){
			$(".errors").html(displayErrors());
			$("#submit").css({ "display":"block"});
			$("#spinnerContainer").css({"display":"none"});
			return false;
		}else{
			$("#submit").css({ "display":"none"});
			$("#spinnerContainer").css({"display":"block"});
			//send to server
			return true;
		}
	});

}
