var minutes;
var secondsRemaining;
var intervalHandle;
var refresh;
var nav=false;
var xhrnav1=null,  xhrnav2=null, xhrnav3=null, xhrnav4=null, xhrnav5=null;

function tick() {
    // grab the h1
    var timeDisplay = $("#time");
    
    // turn seconds into mm:ss
    var min = Math.floor(secondsRemaining / 60);
    var sec = secondsRemaining - (min * 60);
    
    // add a leading zero (as a string value) if seconds less than 10
    if (sec < 10) {
        sec = "0" + sec;
    }
    // concatenate with colon
    var message = min + ":" + sec;
	
	// now change the display
    timeDisplay.html(message);
	
    // stop if down to zero
    if (secondsRemaining === 0) {
        
        destroySession();
    }
    // subtract from seconds remaining
    secondsRemaining--;
}

function responseDestroy(){
	if(xhrnav1.readyState==4 && xhrnav1.status==200){
		var responsenav1=xhrnav1.responseText;
		if(responsenav1=="destroyed" || responsenav1 !="destroyed"){
			nav=true;
			alert("Session Expired: You are logged out!");
			window.location.href="loginNewAccount.html"
		}
	}
}

function destroySession(){
	$("time").html();
	$("#resetSession").off("click",  resetSession);
	clearInterval(intervalHandle);
	
	if(window.XMLHttpRequest){
		xhrnav1=new XMLHttpRequest();
	}else{
		xhrnav1= new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if (xhrnav1!=null){
		xhrnav1.open("GET", "http://localhost/php/sessionDestroy.php", true);
		xhrnav1.send();
		
		xhrnav1.onreadystatechange=responseDestroy;
	}else{
		nav=true;
		alert("Unable to communicate with the server at this time, try again later");
		window.location.href="loginNewAccount.html";
	}
}

function responseReset(){
	if(xhrnav2.readyState==4 && xhrnav2.status==200){
		var responsenav2=xhrnav2.responseText;
		if (responsenav2=="reset"){
			minutes=10;
			secondsRemaining=minutes*60;
			$("#resetSession").on("click", resetSession);
			intervalHandle = setInterval(tick, 1000);
		}else{
			if (responsenav2=="unset"){
				nav=true;
				window.location.href="loginNewAccount.html";
			}else{
				nav=true;
				window.location.href="loginNewAccount.html";
			}
		}
	}
}

function resetSession(){
	$("time").html();
	$("#resetSession").off("click",  resetSession);
	clearInterval(intervalHandle);
	
	if(window.XMLHttpRequest){
		xhrnav2=new XMLHttpRequest();
	}else{
		xhrnav2= new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if (xhrnav2!=null){
		xhrnav2.open("GET", "php/sessionReset.php", true);
		xhrnav2.send();
		
		xhrnav2.onreadystatechange=responseReset;
	}else{
		nav=true;
		alert("Unable to communicate with the server at this time, try again later");
		window.location.href="loginNewAccount.html";
	}	
}

function navigateToNewProject(){
	nav=true;
	resetSession();
	
	window.location.href="newProject.php";
}

function navigateToMyProjects(){
	nav=true;
	resetSession();
	
	window.location.href="viewProjects.php";
}

function navigateToNewUser(){
	nav=true;
	resetSession();
	
	window.location.href="newUser.php";
}

function navigateToUserMenu(){
	nav=true;
	resetSession();
	
	window.location.href="viewUsers.php";
}

function navigateToNewCard(){
	nav=true;
	resetSession();
	
	window.location.href="newCard.php";
}

function navigateToCardMenu(){
	nav=true;
	resetSession();
	
	window.location.href="viewCards.php";
}

function navigateToMyDetails(){
	nav=true;
	resetSession();
	
	window.location.href="viewEditAccountDetails.php";
}

function navigateToNewNote(){
	nav=true;
	resetSession();
	
	window.location.href="newNote.php";
}

function navigateToMainMenu(){
	nav=true;
	resetSession();
	
	window.location.href="mainMenu.php";
}

function navigateToContactMe(){
	var r =confirm("You are about to be logged out and sent to the contact form, do you wish to continue?");
	if(r){
		nav=true;
		resetSession();
		
		window.location.href="contactMe.html";
	}else{
		return false;
	}
}

function logOff(){
	var r =confirm("Are you sure you wish to log off?");
	if(r){
		nav=true;
		destroySession();
		
		window.location.href="loginNewAccount.html";
		alert("You are now logged out");
	}else{
		return false;
	}
}

function  goToNotesMenu(elem){
	var projectid=parseInt($(elem).attr("id"));
	if(window.XMLHttpRequest){
		xhrnav3=new XMLHttpRequest();
	}else{
		xhrnav3=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if(xhrnav3!=null){
		resetSession();
		var data="projectid="+projectid;
		xhrnav3.open("GET", "php/setProjectIDInSession.php?"+data, true);
		xhrnav3.send();
		
		xhrnav3.onreadystatechange=responsegoToNotesMenu;
	}else{
		nav=true;
		alert("Unable to communicate with the server at this time, try again later");
		window.location.href="mainMenu.php";
	}
}

function responsegoToNotesMenu(){
	if (xhrnav3.readyState==4 && xhrnav3.status==200){
		var responsenav3=xhrnav3.responseText;
		if(responsenav3=="ok"){
			nav=true;
			resetSession();
			
			window.location.href="projectsNotesMenu.php";
		}else{
			if(responsenav3=="logoff"){
				nav=true;
				destroySession();
				
				window.location.href="loginNewAccount.html";
			}else{
				return false;
			}
			
		}
	}
}

function goToViewEditProject(elem){	
	var projectid=parseInt($(elem).attr("id"));
	if(window.XMLHttpRequest){
		xhrnav4=new XMLHttpRequest();
	}else{
		xhrnav4=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if(xhrnav4!=null){
		resetSession();
		var data="projectid="+projectid;
		xhrnav4.open("GET", "php/setProjectIDInSession.php?"+data, true);
		xhrnav4.send();
		
		xhrnav4.onreadystatechange=responsegoToNotesMenu;
	}else{
		nav=true;
		alert("Unable to communicate with the server at this time, try again later");
		window.location.href="mainMenu.php";
	}
}


function responsegoToViewEditProject(){
	if (xhrnav4.readyState==4 && xhrnav4.status==200){
		var responsenav4=xhrnav4.responseText;
		if(responsenav4=="ok"){
			nav=true;
			resetSession();
			
			window.location.href="viewEditProject.php";
		}else{
			if(responsenav4=="logoff"){
				nav=true;
				destroySession();
				
				window.location.href="loginNewAccount.html";
			}else{
				return false;
			}
			
		}
	}
}

function deleteProject(elem){
	var projectid=parseInt($(elem).attr("id"));

	if(window.XMLHttpRequest){
		xhrnav5=new XMLHttpRequest();
	}else{
		xhrnav5=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if(xhrnav5!=null){
		resetSession();
		var data="projectid="+projectid;
		xhrnav5.open("GET", "php/deleteProject.php?"+data, true);
		xhrnav5.send();
		
		xhrnav5.onreadystatechange=responsedeleteProject;
	}else{
		nav=true;
		alert("Unable to communicate with the server at this time, try again later");
		window.location.href="mainMenu.php";
	}
}

function responsedeleteProject(){
	if (xhrnav5.readyState==4 && xhrnav5.status==200){
		var responsenav5=xhrnav5.responseText;
		if(responsenav5=="ok"){
			alert("Project Deleted");
		}else{
			if(responsenav5=="logoff"){
				nav=true;
				destroySession();
				
				window.location.href="loginNewAccount.html";
			}else{
				return false;
			}
		}
	}
}

function responsegoToViewNote(){
	if (xhrnav6.readyState==4 && xhrnav6.status==200){
		var responsenav6=xhrnav6.responseText;
		if(responsenav6=="ok"){
			nav=true;
			resetSession();
			
			window.location.href="viewNote.php";
		}else{
			if(responsenav6=="logoff"){
				nav=true;
				destroySession();
				
				window.location.href="loginNewAccount.html";
			}else{
				return false;
			}
		}
	}
}

function goToViewNote(elem){
	var noteid=$(elem).attr("id");
	
	if(window.XMLHttpRequest){
		xhrnav6=new XMLHttpRequest();
	}else{
		xhrnav6=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if(xhrnav6!=null){
		resetSession();
		var data="noteid="+noteid;
		xhrnav6.open("GET", "php/setNoteID.php?"+data, true);
		xhrnav6.send();
		
		xhrnav6.onreadystatechange= responsegoToViewNote;
	}else{
		nav=true;
		alert("Unable to communicate with the server at this time, try again later");
		window.location.href="mainMenu.php";
	}
}

function responsemarkAsReadUnread(){
	if (xhrnav7.readyState==4 && xhrnav7.status==200){
		var responsenav7=xhrnav7.responseText;
		if(responsenav7=="ok"){
			getData();
			refresh = setInterval(getData, 1000);
			return true;
		}else{
			if(responsenav7=="logoff"){
				nav=true;
				destroySession();
				
				window.location.href="loginNewAccount.html";
			}else{
				return false;
			}
		}
	}
}

function markAsReadUnread(elem){
	var noteid=parseInt($(elem).attr("id"));
	
	if(window.XMLHttpRequest){
		xhrnav7=new XMLHttpRequest();
	}else{
		xhrnav7=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if(xhrnav7!=null){
		$(".command").html("Please Wait");
		clearInterval(refresh);
		resetSession();
		var data="noteid="+noteid;
		xhrnav7.open("GET", "php/markNoteAsRead.php?"+data, true);
		xhrnav7.send();
		
		xhrnav7.onreadystatechange=responsemarkAsReadUnread;
	}else{
		nav=true;
		alert("Unable to communicate with the server at this time, try again later");
		window.location.href="mainMenu.php";
	}
}

function responsedeleteNote(){
	if (xhrnav8.readyState==4 && xhrnav8.status==200){
		var responsenav8=xhrnav8.responseText;
		if(responsenav8=="ok"){
			alert("Note Deleted");
			return true;
		}else{
			if(responsenav8=="logoff"){
				nav=true;
				destroySession();
				
				window.location.href="loginNewAccount.html";
			}else{
				return false;
			}
		}
	}
}

function deleteNote(elem){
	var noteid=parseInt($(elem).attr("id"));
	
	if(window.XMLHttpRequest){
		xhrnav8=new XMLHttpRequest();
	}else{
		xhrnav8=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if(xhrnav8!=null){
		resetSession();
		var data="noteid="+noteid;
		xhrnav8.open("GET", "php/deleteNote.php?"+data, true);
		xhrnav8.send();
		
		xhrnav8.onreadystatechange=responsedeleteNote;
	}else{
		nav=true;
		alert("Unable to communicate with the server at this time, try again later");
		window.location.href="mainMenu.php";
	}
}

/* function bindEvents(){

	$("#mainMenu").on("click", navigateToMainMenu);
	
	$("#newProject").on("click", navigateToNewProject);
	$("#manageProjects").on("click", navigateToNewProject);

	$("#newNote").on("click", navigateToNewNote);
	//$("noteMenu").on("click",navigateToNoteMenu);
	
	$("#newUser").on("click", navigateToNewUser);
	$("#manageUsers").on("click", navigateToUserMenu);
	
	$("#newCard").on("click", navigateToNewCard);
	$("#manageCards").on("click", navigateToCardMenu);
	
	$("#viewEditMyDetails").on("click", navigateToMyDetails);
	$("#contactMe").on("click", navigateToContactMe);
	
	$("#logOff").on("click", logOff);
} */

window.onbeforeunload = function (evt){ 
	if(nav==false){
		if (typeof evt == 'undefined') { 
			evt = window.event; 
		} 
		
		if (evt) {
			destroySession();
		} else{
			resetSession();
		}
		
		nav=true;
	}
    
} 