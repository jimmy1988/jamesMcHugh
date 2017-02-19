//Declare message variable if not already declared
if(message==undefined || message==null || message==""){
	var message="";
}

//Declare message variable if not already declared
if(errors == undefined || errors == null || errors==""){
	var errors=new Array();
}

//redirect to a selected page
function redirectTo(location){
	window.location=location;
}

//encode string to be sent to the server
function prepareString(string){
	 return encodeURIComponent(string);
}

//add an error to the error array
function addError(error){
	errors.push(error);
	message="";
}

//clears the errors variable
function clearErrors(){
	for(var j = errors.length-1; j >= 0;j--){
		errors.pop();
	}
}

//take the errors array and generate an error message in the form of html to the page
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


//convert a boolean value to a 1 or 0
function convertBoolean(boolean){
  //converts a boolean value from true/false to 1/0
  if(boolean==true || boolean == "1" || boolean == 1){
    boolean=1;
  }else{
    boolean=0;
  }
  return boolean;
}

//show the next element
function showNext(element){
	$(element).fadeIn(1000).removeClass("noDisplay").addClass("display");
}

//hide the previous element
function hideNext(element){
	$(element).fadeOut(1000).removeClass("display").addClass("noDisplay");
}

//skip the new project form and go to the main menu
function skipForm(){
	redirectTo("mainMenu.php");
}
