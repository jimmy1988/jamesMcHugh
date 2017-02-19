function showHideMenu(event){
  event.preventDefault();
  $("#advancedMainMenu").slideToggle(200, function(){
      var cascade=$("#advancedMainMenu").css("display");
      if($("#advancedMainMenu").css("display") != "none"){
        $("#showHideMenu").html("Hide Menu");
      }else{
        $("#showHideMenu").html("Show Menu");
      }
  });
}

$(document).ready(function(){
  $("#showHideMenu").on("click", showHideMenu);
});
