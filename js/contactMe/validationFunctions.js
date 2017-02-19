var errors = [];
var message="";
var xhr=null;

function redirectTo(location){
	window.location=location;
}

function addError(error){
	errors.push(error);
	message="";
}

function clearErrors(){
	for(var j = errors.length-1; j >= 0;j--){
		errors.pop();
	}
}

function clearErrorMessages(){
	$("#errors").empty();
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

//check and modify if necessary
function checkTextBoxDefault(fieldValue,errorField, id, field){

	switch(id){
		case("firstName"):
			id="first name";
			break;
		case("surname"):
			id="surname";
			break;
		case("email"):
			id="email";
			break;
		case("message"):
			id="message";
			break;
		default:
			id="unknown";
			break;
	}

	if (checkEmpty(fieldValue)){
		message=id + " cannot be blank";
		addError(message);
		return false;
	}else{
		return true;
	}
}

function prepareString(string){
	 return encodeURIComponent(string);
}

function getResponse(){
	if(xhr.readyState==4 && xhr.status == 200){
		var response=xhr.responseText;

		switch(response){
			case "data not set correctly":
				message="There was a error setting the data for the server, please check the fields and resend the request";
				addError(message);
				break;
			case "send message to host failure":
			case "send message to client failure":
			case "database save fail":
				redirectTo("sendMessageError.php");
				break;
			case "success":
				redirectTo("thankYou.php");
				break;
			default:
				message="An unknown error occured while recieving a response from the server, please try again";
				break;
		}

		addError(message);
		$("#errors").html(displayErrors());
		$("#spinnerContainer").css({"display":"none"});
		$("#submit").css({"display":"block"});
	}
}

function sendRequest(firstName, surname, email, message){
	if(window.XMLHttpRequest){
		xhr=new XMLHttpRequest();
	}else{
		xhr=new ActiveXObject("Microsoft.XMLHTTP");
	}

	if(xhr!=null){
		var data=	"firstName=" + firstName + "&" +
							"surname=" + surname + "&" +
							"email=" + email + "&" +
							"message=" + message;

		xhr.open("POST", "php/sendMessage.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(data);

		xhr.onreadystatechange=getResponse;

	}else{
		message="Sorry, there was an error communicating with the server";
		addError(message);

		$("#spinnerContainer").css({"display":"none"});
		$("#submit").css({"display":"block"});
		$("#errors").html(displayErrors());
	}

}

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
