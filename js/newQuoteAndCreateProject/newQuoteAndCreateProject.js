//prepare variables
var message="";
var errors=new Array();

var components=new Array();
var projectName=null;
var websites=null;
var databases=null;
var logos=null;
var graphics=null;
var other=null;
var projectDetails=null;
var newProjectDetails = null;
var xhrProject=null;
var xhrDestroySession=null;

//clear the error field
function clearErrorMessages(){
	$(".errors").empty();
}

//reset all the component boxes in that field
function resetComponentsOnly(){
	$("#componentSelection").removeClass("noDisplay");
	showNext("#componentSelection");
	$("#projectName").val("");
	$("#websiteCheck").prop("checked",false);
	$("#databaseCheck").prop("checked",false);
	$("#logoCheck").prop("checked",false);
	$("#graphicsCheck").prop("checked",false);
	$("#otherCheck").prop("checked",false);

	$("#errorsProject").html("");

	message="";
	errors=null;
	errors=new Array();
	components=null;
	components=new Array();
	projectName=null;
}

//reset the websites fieldset
function resetWebsitesOnly(){
	$("#nextWEB").addClass("noDisplay");
	$("#otherDetailsWeb").val("");
	$("#otherDetailsWebsiteSection").addClass("noDisplay");
	hideNext("#otherDetailsWebsiteSection");
	$("#debugItDetailsWeb").val("");
	$("#debugItDetailsWebsiteSection").addClass("noDisplay");
	hideNext("#debugItDetailsWebsiteSection");
	$("#maintainItDetailsWeb").val("");
	$("#maintainItWebsiteDetailsSection").addClass("noDisplay");
	hideNext("#maintainItWebsiteDetailsSection");
	$("#buildItDetailsWeb").val("");
	$("#numberOfPages").val("");
	$("#buildItWebsiteDetailsSection").addClass("noDisplay");
	hideNext("#buildItWebsiteDetailsSection");
	$("#otherOptionWEB").prop("checked",false);
	$("#debugItOptionWEB").prop("checked",false);
	$("#maintainItOptionWEB").prop("checked",false);
	$("#buildItOptionWEB").prop("checked",false);
	$("#websitesSelectFieldset").addClass("noDisplay");
	hideNext("#websitesSelectFieldset");

	$("#errorsProject").html("");

	message="";
	errors=null;
	errors=new Array();

	websites=null;
}

//reset the databases fieldset
function resetDatabasesOnly(){
	$("#nextDB").addClass("noDisplay");
	$("#otherDetailsDB").val("");
	$("#otherDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#otherDatabaseDetailsSection");
	$("#debugItDetailsDB").val("");
	$("#debugItDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#debugItDatabaseDetailsSection");
	$("#maintainItDetailsDB").val("");
	$("#maintainItDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#maintainItDatabaseDetailsSection");
	$("#buildItDetailsDB").val("");
	$("#designCheck").prop("checked",false);
	$("#relationalCheck").prop("checked",false);
	$("#buildItDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#buildItDatabaseDetailsSection");
	$("#otherOptionDB").prop("checked",false);
	$("#debugItOptionDB").prop("checked",false);
	$("#maintainItOptionDB").prop("checked",false);
	$("#buildItOptionDB").prop("checked",false);
	$("#databaseSelectFieldset").addClass("noDisplay");
	hideNext("#databaseSelectFieldset");

	$("#errorsProject").html("");

	message="";
	errors=null;
	errors=new Array();

	databases=null;
}

//reset the logos fieldset
function resetLogosOnly(){
	$("#nextLogo").addClass("noDisplay");
	$("#otherDetailsLogo").val("");
	$("#otherLogoDetailsSection").addClass("noDisplay");
	hideNext("#otherLogoDetailsSection");
	$("#adjustThemDetailsLogo").val("");
	$("#adjustThemLogoDetailsSection").addClass("noDisplay");
	hideNext("#adjustThemLogoDetailsSection");
	$("#buildItDetailsLogo").val("");
	$("#buildItLogoDetailsSection").addClass("noDisplay");
	hideNext("#buildItLogoDetailsSection");
	$("#otherOptionLOGO").prop("checked",false);
	$("#adjustItOptionLOGO").prop("checked",false);
	$("#buildItOptionLOGO").prop("checked",false);
	$("#logoSelectFieldset").addClass("noDisplay");
	hideNext("#logoSelectFieldset");

	$("#errorsProject").html("");

	message="";
	errors=null;
	errors=new Array();

	logos=null;
}
7//reset the graphics fieldset
function resetGraphicsOnly(){
	$("#nextGraphics").addClass("noDisplay");
	$("#otherDetailsGRA").val("");
	$("#otherGraphicsDetailsSection").addClass("noDisplay");
	hideNext("#otherGraphicsDetailsSection");
	$("#adjustThemDetailsGRA").val("");
	$("#adjustThemGraphicsDetailsSection").addClass("noDisplay");
	hideNext("#adjustThemGraphicsDetailsSection");
	$("#buildItDetailsGRA").val("");
	$("#buildItGraphicsDetailsSection").addClass("noDisplay");
	hideNext("#buildItGraphicsDetailsSection");
	$("#otherOptionGRA").prop("checked",false);
	$("#adjustThemOptionGRA").prop("checked",false);
	$("#buildItOptionGRA").prop("checked",false);
	$("#graphicsSelectFieldset").addClass("noDisplay");
	hideNext("#graphicsSelectFieldset");

	$("#errorsProject").html("");

	message="";
	errors=null;
	errors=new Array();

	graphics=null;
}

//reset the other details fieldset
function resetOtherOnly(){
	$("#otherInfo").val("");
	$("#otherSelectFieldset").addClass("noDisplay");
	hideNext("#otherSelectFieldset");

	$("#errorsProject").html("");

	message="";
	errors=null;
	errors=new Array();

	other=null;
}

//reset the project details fieldset
function resetProjectDetailsOnly(){
	$("#projectDetails").val("");
	$("#projectDetailsFieldset").addClass("noDisplay");
	hideNext("#projectDetailsFieldset");

	$("#errorsProject").html("");

	message="";
	errors=null;
	errors=new Array();

	projectDetails=null;
}

//reset all fieldsets
function resetAll(){
	$("#projectDetails").val("");
	$("#projectDetailsFieldset").addClass("noDisplay");
	hideNext("#projectDetailsFieldset");

	$("#otherInfo").val("");
	$("#otherSelectFieldset").addClass("noDisplay");
	hideNext("#otherSelectFieldset");

	$("#nextGraphics").addClass("noDisplay");
	$("#otherDetailsGRA").val("");
	$("#otherGraphicsDetailsSection").addClass("noDisplay");
	hideNext("#otherGraphicsDetailsSection");
	$("#adjustThemDetailsGRA").val("");
	$("#adjustThemGraphicsDetailsSection").addClass("noDisplay");
	hideNext("#adjustThemGraphicsDetailsSection");
	$("#buildItDetailsGRA").val("");
	$("#buildItGraphicsDetailsSection").addClass("noDisplay");
	hideNext("#buildItGraphicsDetailsSection");
	$("#otherOptionGRA").prop("checked",false);
	$("#adjustThemOptionGRA").prop("checked",false);
	$("#buildItOptionGRA").prop("checked",false);
	$("#graphicsSelectFieldset").addClass("noDisplay");
	hideNext("#graphicsSelectFieldset");

	$("#nextLogo").addClass("noDisplay");
	$("#otherDetailsLogo").val("");
	$("#otherLogoDetailsSection").addClass("noDisplay");
	hideNext("#otherLogoDetailsSection");
	$("#adjustThemDetailsLogo").val("");
	$("#adjustThemLogoDetailsSection").addClass("noDisplay");
	hideNext("#adjustThemLogoDetailsSection");
	$("#buildItDetailsLogo").val("");
	$("#buildItLogoDetailsSection").addClass("noDisplay");
	hideNext("#buildItLogoDetailsSection");
	$("#otherOptionLOGO").prop("checked",false);
	$("#adjustItOptionLOGO").prop("checked",false);
	$("#buildItOptionLOGO").prop("checked",false);
	$("#logoSelectFieldset").addClass("noDisplay");
	hideNext("#logoSelectFieldset");

	$("#nextDB").addClass("noDisplay");
	$("#otherDetailsDB").val("");
	$("#otherDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#otherDatabaseDetailsSection");
	$("#debugItDetailsDB").val("");
	$("#debugItDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#debugItDatabaseDetailsSection");
	$("#maintainItDetailsDB").val("");
	$("#maintainItDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#maintainItDatabaseDetailsSection");
	$("#buildItDetailsDB").val("");
	$("#designCheck").prop("checked",false);
	$("#relationalCheck").prop("checked",false);
	$("#buildItDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#buildItDatabaseDetailsSection");
	$("#otherOptionDB").prop("checked",false);
	$("#debugItOptionDB").prop("checked",false);
	$("#maintainItOptionDB").prop("checked",false);
	$("#buildItOptionDB").prop("checked",false);
	$("#databaseSelectFieldset").addClass("noDisplay");
	hideNext("#databaseSelectFieldset");

	$("#nextWEB").addClass("noDisplay");
	$("#otherDetailsWeb").val("");
	$("#otherDetailsWebsiteSection").addClass("noDisplay");
	hideNext("#otherDetailsWebsiteSection");
	$("#debugItDetailsWeb").val("");
	$("#debugItDetailsWebsiteSection").addClass("noDisplay");
	hideNext("#debugItDetailsWebsiteSection");
	$("#maintainItDetailsWeb").val("");
	$("#maintainItWebsiteDetailsSection").addClass("noDisplay");
	hideNext("#maintainItWebsiteDetailsSection");
	$("#buildItDetailsWeb").val("");
	$("#numberOfPages").val("");
	$("#buildItWebsiteDetailsSection").addClass("noDisplay");
	hideNext("#buildItWebsiteDetailsSection");
	$("#otherOptionWEB").prop("checked",false);
	$("#debugItOptionWEB").prop("checked",false);
	$("#maintainItOptionWEB").prop("checked",false);
	$("#buildItOptionWEB").prop("checked",false);
	$("#websitesSelectFieldset").addClass("noDisplay");
	hideNext("#websitesSelectFieldset");

	$("#componentSelection").removeClass("noDisplay");
	showNext("#componentSelection");
	$("#projectName").val("");
	$("#websiteCheck").prop("checked",false);
	$("#databaseCheck").prop("checked",false);
	$("#logoCheck").prop("checked",false);
	$("#graphicsCheck").prop("checked",false);
	$("#otherCheck").prop("checked",false);

	$("#errorsProject").html("");

	message="";
	errors=null;
	errors=new Array();
	components=null;
	components=new Array();
	projectName=null;
	websites=null;
	databases=null;
	logos=null;
	graphics=null;
	other=null;
	projectDetails=null;
}

//response function for submitting the project to the server
// function responseProject(){
//   if(xhrProject.readyState == 4 && xhrProject.status == 200){
// 		var response=xhrProject.responseText;
//
// 		switch(response){
// 			case("success"):
// 			$("#errorsProject").html("");
// 				resetProjectDetailsOnly();
// 				resetOther();
// 				resetGraphics();
// 				resetLogo()
// 				resetDatabases();
// 				resetWebsites();
// 				resetComponents();
// 				redirectTo("mainMenu.php");
// 				break;
// 			case("project not registered"):
// 			case("website not registered"):
// 			case("database not registered"):
// 			case("logo not registered"):
// 			case("graphics not registered"):
// 			case("other not registered"):
// 			case("quotation not registered"):
// 				message="The quotation has not been registered due to an unknown error, please check the data you have submitted and try again";
// 				addError(message);
// 				$("#errorsProject").html(displayErrors(message));
// 				var conf = confirm("The quotation has not been registered, an unknown error occured, do you wish to reset the form to try again?");
// 				if(conf){
// 					$("#errorsProject").html("");
// 					resetProjectDetails();
// 					resetOther();
// 					resetGraphics();
// 					resetLogo()
// 					resetDatabases();
// 					resetWebsites();
// 					resetComponents();
// 					hideNext($("#projectDetailsFieldset"));
// 					showNext($("#componentSelection"));
// 				}
// 				break;
// 			default:
// 				message="There was an unknown error on the server: [Message] "+response;
// 				addError(message);
// 				$("#errorsProject").html(displayErrors(message));
// 		 		break;
// 		}
//   }
// }
//
//request function for submitting the project to the server
// function requestProject(){
//   if(window.XMLHttpRequest){
//     xhrProject=new XMLHttpRequest();
//   }else{
//     xhrProject=new ActiveXObject("Microsoft.XMLHTTP");
//   }
//
//   if(xhrProject !=null){
//
//     var theData="projectName=" + prepareString(projectName) + "&";
//         theData=theData.concat("website=" + prepareString(components[0]) + "&");
//
//     if (components[0] == 1){
//       theData=theData.concat("websiteAction="+ websites[0] + "&");
//       theData=theData.concat("numberOfPages="+ websites[1] + "&");
//       theData=theData.concat("websiteDetails="+ websites[2] + "&");
//     }
//
//     theData=theData.concat("database=" + prepareString(components[1]) + "&");
//
//     if (components[1] == 1){
//       theData=theData.concat("databaseAction="+ databases[0] + "&");
//       theData=theData.concat("relational="+ databases[1] + "&");
//       theData=theData.concat("dbDesign="+ databases[2] + "&");
//       theData=theData.concat("numberOfTables="+ databases[3] + "&");
//       theData=theData.concat("databaseDetails="+ databases[4] + "&");
//     }
//
//     theData=theData.concat("logo=" + prepareString(components[2]) + "&");
//
//     if (components[2] == 1){
//       theData=theData.concat("logoAction="+ logos[0] + "&");
//       theData=theData.concat("logoDetails="+ logos[1] + "&");
//     }
//
//     theData=theData.concat("graphics=" + prepareString(components[3]) + "&");
//
//     if (components[3] == 1){
//       theData=theData.concat("graphicsAction="+ graphics[0] + "&");
//       theData=theData.concat("graphicsDetails="+ graphics[1] + "&");
//     }
//
//     theData=theData.concat("other=" + prepareString(components[4]) + "&");
//
//     if (components[4] == 1){
//       theData=theData.concat("otherDetails="+ other + "&");
//     }
//
//     theData=theData.concat("projectDetails=" + prepareString(newProjectDetails));
//
//     xhrProject.open("POST", "php/registerNewProject.php", true);
//     xhrProject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
//     xhrProject.send(theData);
//
//     xhrProject.onreadystatechange=responseProject;
//   }else{
//     message="There was a problem communicating with the server, please try again";
//     addError(message);
//     $("#errorsProject").html(displayErrors(message));
//   }
// }

//saves the components to the components array
function saveComponents(){
  var projectDetailsBlank=$("#projectName").val();
  var websiteChecked=$("#websiteCheck").prop("checked");
  var databaseChecked=$("#databaseCheck").prop("checked");
  var logoChecked=$("#logoCheck").prop("checked");
  var graphicsChecked=$("#graphicsCheck").prop("checked");
  var otherChecked=$("#otherCheck").prop("checked");

  if(projectDetailsBlank!="" && (websiteChecked || databaseChecked || logoChecked || graphicsChecked || otherChecked)){
    projectName=$("#projectName").val();
    components[0]=convertBoolean(websiteChecked);
    components[1]=convertBoolean(databaseChecked);
    components[2]=convertBoolean(logoChecked);
    components[3]=convertBoolean(graphicsChecked);
    components[4]=convertBoolean(otherChecked);
    if(components[0]==1){
      hideNext($("#componentSelection"));
      showNext($("#websitesSelectFieldset"));
    }else{
      if(components[1]==1){
        hideNext($("#componentSelection"));
        showNext($("#databaseSelectFieldset"));
      }else{
        if(components[2]==1){
          hideNext($("#componentSelection"));
          showNext($("#logoSelectFieldset"));
        }else{
          if(components[3]==1){
            hideNext($("#componentSelection"));
            showNext($("#graphicsSelectFieldset"));
          }else{
            hideNext($("#componentSelection"));
            showNext($("#otherSelectFieldset"));
          }
        }
      }
    }
  }else{
    message="You need to fill in the project name and make a selection in order to proceed";
    addError(message);
    $("#errorsProject").html(displayErrors(message));
  }
}

//shows the website details fields
function showWebDetails(){
	$("#otherDetailsWeb").val("");
	$("#otherDetailsWebsiteSection").addClass("noDisplay");
	hideNext("#otherDetailsWebsiteSection");
	$("#debugItDetailsWeb").val("");
	$("#debugItDetailsWebsiteSection").addClass("noDisplay");
	hideNext("#debugItDetailsWebsiteSection");
	$("#maintainItDetailsWeb").val("");
	$("#maintainItWebsiteDetailsSection").addClass("noDisplay");
	hideNext("#maintainItWebsiteDetailsSection");
	$("#buildItDetailsWeb").val("");
	$("#numberOfPages").val("");
	$("#buildItWebsiteDetailsSection").addClass("noDisplay");
	hideNext("#buildItWebsiteDetailsSection");

	if($("#buildItOptionWEB").prop("checked")==true){
		showNext("#buildItWebsiteDetailsSection");
		$("#buildItWebsiteDetailsSection").removeClass("noDisplay");
		showNext("#nextWEB");
		$("#nextWEB").removeClass("noDisplay");
	}

	if($("#maintainItOptionWEB").prop("checked")==true){
		showNext("#maintainItWebsiteDetailsSection");
		$("#maintainItWebsiteDetailsSection").removeClass("noDisplay");
		showNext("#nextWEB");
		$("#nextWEB").removeClass("noDisplay");
	}

	if($("#debugItOptionWEB").prop("checked")==true){
		showNext("#debugItDetailsWebsiteSection");
		$("#debugItDetailsWebsiteSection").removeClass("noDisplay");
		showNext("#nextWEB");
		$("#nextWEB").removeClass("noDisplay");
	}

	if($("#otherOptionWEB").prop("checked")==true){
		showNext("#otherDetailsWebsiteSection");
		$("#otherDetailsWebsiteSection").removeClass("noDisplay");
		showNext("#nextWEB");
		$("#nextWEB").removeClass("noDisplay");
	}
}

//saves the website details
function saveWebsites(){
  var buildItChecked=$("#buildItOptionWEB").prop("checked");
  var maintainItChecked=$("#maintainItOptionWEB").prop("checked");
  var debugItChecked=$("#debugItOptionWEB").prop("checked");
  var otherChecked=$("#otherOptionWEB").prop("checked");

	websites=new Array();

  if(buildItChecked || maintainItChecked || debugItChecked || otherChecked){
    if(buildItChecked){
      websites[0]="Build It";
			websites[1]=$("#numberOfPages").val();
			websites[2]=$("#buildItDetailsWeb").val();
    }
    if(maintainItChecked){
      websites[0]="Maintain It";
			websites[1]=0;
			websites[2]=$("#maintainItDetailsWeb").val();
    }
    if(debugItChecked){
      websites[0]="Debug It";
			websites[1]=0;
			websites[2]=$("#debugItDetailsWeb").val();
    }
    if(otherChecked){
      websites[0]="Other";
			websites[1]=0;
			websites[2]=$("#otherDetailsWeb").val();
    }

    if(websites[0] != null || websites[0] != undefined){
      if(components[1] == 1){
        hideNext($("#websitesSelectFieldset"));
        showNext($("#databaseSelectFieldset"));
      }else{
        if(components[2] == 1){
          hideNext($("#websitesSelectFieldset"));
          showNext($("#logoSelectFieldset"));
        }else{
          if(components[3] == 1){
            hideNext($("#websitesSelectFieldset"));
            showNext($("#graphicsSelectFieldset"));
          }else{
            if(components[4] == 1){
              hideNext($("#websitesSelectFieldset"));
              showNext($("#otherSelectFieldset"));
            }else{
              hideNext($("#websitesSelectFieldset"));
              showNext($("#projectDetailsFieldset"));
            }
          }
        }
      }
    }else{
      message="You need to make a selection in order to proceed";
      addError(message);
      $("#errorsProject").html(displayErrors(message));
    }

  }else{
    message="You need to make a selection in order to proceed";
    addError(message);
    $("#errorsProject").html(displayErrors(message));
  }
}

//saves the website details
function showDatabaseDetails(){
	$("#otherDetailsDB").val("");
	$("#otherDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#otherDatabaseDetailsSection");
	$("#debugItDetailsDB").val("");
	$("#debugItDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#debugItDatabaseDetailsSection");
	$("#maintainItDetailsDB").val("");
	$("#maintainItDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#maintainItDatabaseDetailsSection");
	$("#buildItDetailsDB").val("");
	$("#designCheck").prop("checked",false);
	$("#relationalCheck").prop("checked",false);
	$("#buildItDatabaseDetailsSection").addClass("noDisplay");
	hideNext("#buildItDatabaseDetailsSection");

	if($("#buildItOptionDB").prop("checked")==true){
		showNext("#buildItDatabaseDetailsSection");
		$("#buildItDatabaseDetailsSection").removeClass("noDisplay");
		showNext("#nextDB");
		$("#nextDB").removeClass("noDisplay");
	}

	if($("#maintainItOptionDB").prop("checked")==true){
		showNext("#maintainItDatabaseDetailsSection");
		$("#maintainItDatabaseDetailsSection").removeClass("noDisplay");
		showNext("#nextDB");
		$("#nextDB").removeClass("noDisplay");
	}

	if($("#debugItOptionDB").prop("checked")==true){
		showNext("#debugItDetailsDatabaseSection");
		$("#debugItDetailsDatabaseSection").removeClass("noDisplay");
		showNext("#nextDB");
		$("#nextDB").removeClass("noDisplay");
	}

	if($("#otherOptionDB").prop("checked")==true){
		showNext("#otherDetailsDatabaseSection");
		$("#otherDetailsDatabaseSection").removeClass("noDisplay");
		showNext("#nextDB");
		$("#nextDB").removeClass("noDisplay");
	}
}

//saves the details of the database
function saveDatabases(){
  var buildItChecked=$("#buildItOptionDB").prop("checked");
  var maintainItChecked=$("#maintainItOptionDB").prop("checked");
  var debugItChecked=$("#debugItOptionDB").prop("checked");
  var otherChecked=$("#otherOptionDB").prop("checked");


	databases=new Array();
  if(buildItChecked || maintainItChecked || debugItChecked || otherChecked){
    if(buildItChecked){
      databases[0]="Build It";
      databases[1]=convertBoolean($("#relationalCheck").prop("checked"));
      databases[2]=convertBoolean($("#designCheck").prop("checked"));
			databases[3]=$("#numberOfTables").val();
			databases[4]=$("#buildItDetailsDB").val();
    }
    if(maintainItChecked){
      databases[0]="Maintain It";
			databases[1]=0;
			databases[2]=0;
			databases[3]=0;
			databases[4]=$("#maintainItDetailsDB").val();
    }
    if(debugItChecked){
      databases[0]="Debug It";
			databases[1]=0;
			databases[2]=0;
			databases[3]=0;
			databases[4]=$("#debugItDetailsDB").val();
    }
    if(otherChecked){
      databases[0]="Other";
			databases[1]=0;
			databases[2]=0;
			databases[3]=0;
			databases[4]=$("#otherDetailsDB").val();
    }

    if(databases[0] != null || databases[0] != undefined){
      if(components[2] == 1){
        hideNext($("#databaseSelectFieldset"));
        showNext($("#logoSelectFieldset"));
      }else{
        if(components[3] == 1){
          hideNext($("#databaseSelectFieldset"));
          showNext($("#graphicsSelectFieldset"));
        }else{
          if(components[4] == 1){
            hideNext($("#databaseSelectFieldset"));
            showNext($("#otherSelectFieldset"));
          }else{
            hideNext($("#databaseSelectFieldset"));
            showNext($("#projectDetailsFieldset"));
          }
        }
      }
    }else{
      message="You need to make a selection in order to proceed";
      addError(message);
      $("#errorsProject").html(displayErrors(message));
    }
  }else{
    message="You need to make a selection in order to proceed";
    addError(message);
    $("#errorsProject").html(displayErrors(message));
  }
}

//show the logo details fields
function showLogoDetails(){
	$("#otherDetailsLogo").val("");
	$("#otherLogoDetailsSection").addClass("noDisplay");
	hideNext("#otherLogoDetailsSection");
	$("#adjustThemDetailsLogo").val("");
	$("#adjustThemLogoDetailsSection").addClass("noDisplay");
	hideNext("#adjustThemLogoDetailsSection");
	$("#buildItDetailsLogo").val("");
	$("#buildItLogoDetailsSection").addClass("noDisplay");
	hideNext("#buildItLogoDetailsSection");

	if($("#buildItOptionLOGO").prop("checked")==true){
		showNext("#buildItLogoDetailsSection");
		$("#buildItLogoOptionDetailsSection").removeClass("noDisplay");
		showNext("#nextLogo");
		$("#nextLogo").removeClass("noDisplay");
	}

	if($("#adjustItOptionLOGO").prop("checked")==true){
		showNext("#adjustItLogoDetailsSection");
		$("#adjustItLogoDetailsSection").removeClass("noDisplay");
		showNext("#nextLogo");
		$("#nextLogo").removeClass("noDisplay");
	}

	if($("#otherOptionLOGO").prop("checked")==true){
		showNext("#otherDetailsSection");
		$("#otherLogoDetailsSection").removeClass("noDisplay");
		showNext("#nextLogo");
		$("#nextLogo").removeClass("noDisplay");
	}
}

//saves the logo to the logo array
function saveLogo(){
	var buildItChecked=$("#buildItOptionLOGO").prop("checked");
	var adjustItChecked=$("#adjustThemOptionLOGO").prop("checked");
	var otherChecked=$("#otherOptionLOGO").prop("checked");
	logos=new Array();

	if(buildItChecked || adjustItChecked || otherItChecked){
		if(buildItChecked){
			logos[0]="Build It";
			logos[1]=$("#buildItDetailsLogo").val();
		}
		if(adjustItChecked){
			logos[0]="Adjust It";
			logos[1]=$("#adjustThemDetailsLogo").val();
		}
		if(otherChecked){
			logos[0]="Other";
			logos[1]=$("#otherDetailsLogo").val();
		}

		if(logos[0] != null || logos[0] != undefined){
			if(components[3] == 1){
				hideNext($("#logoSelectFieldset"));
				showNext($("#graphicsSelectFieldset"));
			}else{
				if(components[4] == 1){
					hideNext($("#logoSelectFieldset"));
					showNext($("#otherSelectFieldset"));
				}else{
					hideNext($("#logoSelectFieldset"));
					showNext($("#projectDetailsFieldset"));
				}
			}
		}else{
			message="You need to make a selection in order to proceed";
			addError(message);
			$("#errorsProject").html(displayErrors(message));
		}
	}else{
		message="You need to make a selection in order to proceed";
		addError(message);
		$("#errorsProject").html(displayErrors(message));
	}
}

//show the graphics details field
function showGraphicsDetails(){
	$("#otherDetailsGRA").val("");
	$("#otherGraphicsDetailsSection").addClass("noDisplay");
	hideNext("#otherGraphicsDetailsSection");
	$("#adjustThemDetailsGRA").val("");
	$("#adjustThemGraphicsDetailsSection").addClass("noDisplay");
	hideNext("#adjustThemGraphicsDetailsSection");
	$("#buildItDetailsGRA").val("");
	$("#buildItGraphicsDetailsSection").addClass("noDisplay");
	hideNext("#buildItGraphicsDetailsSection");

	if($("#buildItOptionGRA").prop("checked")==true){
		showNext("#buildItGraphicsDetailsSection");
		$("#buildItGraphicsOptionDetailsSection").removeClass("noDisplay");
		showNext("#nextGraphics");
		$("#nextGraphics").removeClass("noDisplay");
	}

	if($("#adjustThemOptionGRA").prop("checked")==true){
		showNext("#adjustThemGraphicsOptionDetailsSection");
		$("#adjustItGraphicsOptionDetailsSection").removeClass("noDisplay");
		showNext("#nextGraphics");
		$("#nextGraphics").removeClass("noDisplay");
	}

	if($("#otherOptionGRA").prop("checked")==true){
		showNext("#otherGraphicsOptionDetailsSection");
		$("#otherGraphicsOptionDetailsSection").removeClass("noDisplay");
		showNext("#nextGraphics");
		$("#nextGraphics").removeClass("noDisplay");
	}
}

//save the graphics details to the graphics array
function saveGraphics(){
	var buildItChecked=$("#buildItOptionGRA").prop("checked");
  var adjustThemChecked=$("#adjustThemOptionGRA").prop("checked");
  var otherItChecked=$("#otherOptionGRA").prop("checked");

	graphics=new Array();
  if(buildItChecked || adjustThemChecked || otherItChecked){
    if(buildItChecked){
      graphics[0]="Build It";
			graphics[1]=$("#buildItDetailsGRA").val();
    }
    if(adjustThemChecked){
      graphics[0]="Adjust Them";
			graphics[1]=$("#adjustThemDetailsGRA").val();
    }
    if(otherItChecked){
      graphics[0]="Other";
			graphics[1]=$("#otherDetailsGRA").val();
    }

    if(graphics[0] != null){
      if(components[4] == 1){
        hideNext($("#graphicsSelectFieldset"));
        showNext($("#otherSelectFieldset"));
      }else{
        hideNext($("#graphicsSelectFieldset"));
        showNext($("#projectDetailsFieldset"));
      }
    }else{
      message="You need to make a selection in order to proceed";
      addError(message);
      $("#errorsProject").html(displayErrors(message));
    }
  }else{
    message="You need to make a selection in order to proceed";
    addError(message);
    $("#errorsProject").html(displayErrors(message));
  }
}

//saves the other details to the other array
function saveOther(){
	other=$("#otherInfo").val();

  if(other != null || other!= undefined || other != ""){
    hideNext($("#otherSelectFieldset"));
	  showNext($("#projectDetailsFieldset"));
  }else{
    message="The text field must be filled in for you you to proceed";
    addError(message);
    $("#errorsProject").html(displayErrors(message));
  }
}

//saves the project details to the project details array
function saveProjectDetails(){
  projectDetails = $("#projectDetails").val();

  if(projectDetails != null || projectDetails!=undefined || projectDetails != ""){
		requestProject();
  }else{
    message="The text field must be filled in for you you to proceed";
    addError(message);
    $("#errorsProject").html(displayErrors(message));
  }
}

//prepares the document
$(document).ready(function(){

	//clear all fields and reset the form
	$("#clearComponents, #resetAllWEB, #resetAllDB, #resetAllGraphics, #resetAllLogo, #resetAllOther, #resetAllProjectDetails").on("click", resetAll);
	$("#resetProjectDetails").on("click", resetProjectDetailsOnly);
	$("#resetOther").on("click", resetOtherOnly);
	$("#resetGraphics").on("click", resetGraphicsOnly);
	$("#resetLogo").on("click", resetLogosOnly);
	$("#resetDB").on("click", resetDatabasesOnly);
	$("#resetWEB").on("click", resetWebsitesOnly);
	$("#skip").on("click", skipForm);

	//confirms that the details are correct and then submits the details to the server
	$("#next").on("click", function(){
		var conf=null;
		conf=confirm("Is this data correct?");
		if (conf){
			$("#errorsProject").html("");
			saveComponents();
		}
	});

	//binds the showWebDetails function to the following IDs
	$("#buildItOptionWEB, #maintainItOptionWEB, #debugItOptionWEB, #otherOptionWEB").on("click", showWebDetails);

	//checks that the web details are correct before saving the details
	$("#nextWEB").on("click", function(){
		var conf=null;
		conf=confirm("Is this data correct?");
		if (conf){
			$("#errorsProject").html("");
			saveWebsites();
		}
	});

	//binds the showDatabaseDetails function to the following IDs
	$("#buildItOptionDB, #maintainItOptionDB, #debugItOptionDB, #otherOptionDB").on("click", showDatabaseDetails);

	
	$("#nextDB").on("click", function(){
		var conf=null;
		conf=confirm("Is this data correct?");
		if (conf){
			$("#errorsProject").html("");
			saveDatabases();
		}
	});

	$("#buildItOptionLOGO, #adjustItOptionLOGO, #otherOptionLOGO").on("click", showLogoDetails);

	$("#nextLogo").on("click", function(){
		var conf=null;
		conf=confirm("Is this data correct?");
		if (conf){
			$("#errorsProject").html("");
			saveLogo();
		}
	});

	$("#buildItOptionGRA, #adjustThemOptionGRA, #otherOptionGRA").on("click", showGraphicsDetails);

	$("#nextGraphics").on("click", function(){
		var conf=null;
		conf=confirm("Is this data correct?");
		if (conf){
			$("#errorsProject").html("");
			saveGraphics();
		}
	});


	$("#nextOther").on("click", function(){
		var conf=null;
		conf=confirm("Is this data correct?");
		if (conf){
			$("#errorsProject").html("");
			saveOther();
		}
	});

	$("#nextProjectDetails").on("click", function(){
		var conf=null;
		conf=confirm("Is this data correct?");
		if (conf){
			$("#errorsProject").html("");
			saveProjectDetails();
		}
	});
});
