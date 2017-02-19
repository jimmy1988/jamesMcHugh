function hideShowMenu(){
	
	$("a.projectMenu").slideToggle("slow");
	var name=$("#button").html();
		
		if(name=="Hide"){
			$("#button").html("Show");
		}else{
			$("#button").html("Hide");
		}
}

$("document").ready(function (){
	
	hideShowMenu();
	$("#button").on("click", function (e){
	
	e.preventDefault();
	$("a.projectMenu").slideToggle("slow");
	var name=$("#button").html();
		
		if(name=="Hide"){
			$("#button").html("Show");
		}else{
			$("#button").html("Hide");
		}
});
	
});