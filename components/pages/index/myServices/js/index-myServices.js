$(document).ready(function(){
  $("#openCloseConsultations").on("click", function(){
    event.preventDefault();
    if($("#consultationInformation").css("display") == "none"){
      $("#consultationInformation").slideDown(500, function(){
        $("#openCloseConsultations").html("-");
      });
    }else{
      $("#consultationInformation").slideUp(500, function(){
        $("#openCloseConsultations").html("+");
      });
    }
  });

  $("#openCloseProjects").on("click", function(){
    event.preventDefault();
    if($("#projectInformation").css("display") == "none"){
      $("#projectInformation").slideDown(500, function(){
        $("#openCloseProjects").html("-");
      });
    }else{
      $("#projectInformation").slideUp(500, function(){
        $("#openCloseProjects").html("+");
      });
    }
  });
});
