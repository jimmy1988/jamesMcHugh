function redirectTo(location){
	window.location=location;
}

function prepareString(string){
	 return encodeURIComponent(string);
}

function convertBoolean(boolean){
  //converts a boolean value from true/false to 1/0
  if(boolean==true || boolean == "1" || boolean == 1){
    boolean=1;
  }else{
    boolean=0;
  }
  return boolean;
}

function showNext(element){
	$(element).fadeIn(1000).removeClass("noDisplay").addClass("display");
}

function hideNext(element){
	$(element).fadeOut(1000).removeClass("display").addClass("noDisplay");
}
