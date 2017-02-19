<?php
  $root=$_SERVER['DOCUMENT_ROOT'];
  //$root.="/jamesMcHugh";
  if(strpos($root, "jamesMcHugh")<16){
    $root=$root."jamesMcHugh";
  }

  if(!isset($_SESSION)){
    require_once($root."php/functions/sessionFunctions.php");
  }
?>

<!--Section used for identifying if users have signed in or not-->
<link type="text/css" rel="stylesheet" href="php/components/css/membersBar/style.css">
<div id="membersBar" class="main">
  <div id="innerMembersBar" class="inner">
    <!--menu should be:
      main menu
      new quote
      resume quote
      new project
      my details
      log out
    -->
<?php
  //replace with session variables
  //from the session we are going to talk to the database to get the user details

  if(isset($_SESSION['u']) && time()<= $_SESSION['exp']){
    $newProjectPrivilege=getUserPriveleges($_SESSION['u']);
    $newProjectPrivilege=$newProjectPrivilege['addProjects'];
    //place links for my account and and manage projects
    echo "<div id=\"welcomeUser\">
      <p id=\"welcomeBack\">Hello <span id=\"name\">".getForenameAndSurname($_SESSION['uI'])."</span>!</p>
      <a href=\"mainMenu.php\" id=\"goToMyAccount\" class=\"userNavLinks\">Main Menu</a>
      <a href=\"myAccount.php\" id=\"myAccount\" class=\"userNavLinks\">My Account</a>
      <a href=\"yourProjects.php\" id=\"ManageProjects\" class=\"userNavLinks\">Manage Projects</a>";

      if($newProjectPrivilege == 1){
        echo "<a href=\"newQuoteAndCreateProject.php\" id=\"newProject\" class=\"userNavLinks\">New Project</a>";
      }

      echo "<a href=\"php/logOutUser.php\" id=\"logOut\" class=\"userNavLinks\">Log Out</a>
    </div>";

  }else{
    echo "<form id=\"membersForm\" action=\"php/loginUser.php\" method=\"POST\">
      <div id=\"emailField\" class=\"mainField\">
        <label class=\"membersLabel\">Email: </label>
        <input type=\"email\" class=\"members\" name=\"email\" id=\"emailLoginMain\"/>
      </div>
      <div id=\"passwordField\" class=\"mainField members\">
        <label class=\"membersLabel\">Password: </label>
        <input type=\"password\" name=\"password\" id=\"passwordLoginMain\"/>
      </div>
      <input type=\"hidden\" name=\"formType\" id=\"formTypeMembers\" value=\"membersBar\"/>
      <input type=\"submit\" name=\"submitLogin\" id=\"login\" value=\"Login\"/>
      <div id=\"rememberMeField\" class=\"mainField members\">
        <p id=\"rememberMeContainer\" class=\"members\">Remember Me!&nbsp;
        <input type=\"checkbox\" name=\"rememberMe\" id=\"rememberMe\" class=\"members\" checked=\"true\"></p>
      </div>
      <div id=\"registerField\" class=\"members\">
        <a href=\"php/changeForm.php\" id=\"registerLink\" class=\"members\">Not a member? click here</a>
      </div>
    </form>";
  }
?>
  </div>
</div>

<script type="text/javascript" src="php/components/js/menuBar.js"></script>
