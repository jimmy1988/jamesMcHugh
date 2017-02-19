function bindEvents1(){

	$("#submit").on("click", function(event){
		clearErrorMessages();
		var firstNameCheck = checkTextBoxDefault($("#firstName").val(),$("#firstName_error"), $("#firstName").attr('id'), $("#firstName"));
		var surnameCheck = checkTextBoxDefault($("#surname").val(),$("#surname_error"), $("#surname").attr('id'), $("#surname"));
		var emailCheck = checkEmail($("#email").val(),$("#email_error"),$("#email").attr('id'), $("#email"));
		var messageCheck = checkTextBoxDefault($("#message").val(),$("#message_error"), $("#message").attr('id'), $("#message"));

		if ( !emailCheck || !firstNameCheck || !surnameCheck || !messageCheck){
			$("#errors").html(displayErrors());
		}else{
			var firstName=prepareString($("#firstName").val());
			var surname=prepareString($("#surname").val());
			var email=prepareString($("#email").val());
			var message=prepareString($("#message").val());

			$("#submit").css({ "display":"none"});
			$("#spinnerContainer").css({"display":"block"});
			//send to server
			sendRequest(firstName, surname, email, message);
		}
	});

}

$("document").ready(function(){
	bindEvents1();
});
