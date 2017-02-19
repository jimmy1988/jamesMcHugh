<?php
	//import the root varaible
	$root=$_SERVER['DOCUMENT_ROOT'];
	//$root.="/jamesMcHugh";
	if(strpos($root, "jamesMcHugh")<16){
		$root=$root."jamesMcHugh";
	}

	//check if the sesssion has already been set, if not import it and start it
	if(!isset($_SESSION)){
		require_once($root."/php/functions/sessionFunctions.php");
	}

	//import all of the functions
	require_once($root."/php/functions/functions.php");

	//check if a user has been set and whether the session has expired
	if(isset($_SESSION['uI']) && !sessionExpired()){
		//proceed onto the page, session is then refreshed
		$_SESSION['exp']=time()+10*60;

		//import database connections and functions
		require_once("php/components/database/dbConn.php");
		require_once("php/components/database/secureDatabase.php");
		//get all of the user priveleges
		$userPrivileges=getUserPriveleges($_SESSION['uI']);

		if(!$userPrivileges){
			$_SESSION['loginErrors']  = "<p>Your session has expired after 10 minutes of inactivity, please relogin to gain access to the system</p>";
			redirect_to("newBookingLogin.php");
		}
	}else{
		//session either was not set or has expired, redirect back to the login screen
		$_SESSION['loginErrors']  = "<p>Your session has expired after 10 minutes of inactivity, please relogin to gain access to the system</p>";
		redirect_to("newBookingLogin.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			$path=basename(__FILE__,'.php');

			$pathString=str_split($path);

			include($root.'/php/components/header.php');
			$newString="";
			$i=0;
			for($j=0; $j <= count($pathString); $j++){

				if($j == count($pathString)){
					$arrayPath[$i]=$newString;
					$newString=null;
					$i=null;
					$newString=null;
				}else{
					if( ($pathString[$j] == strtoupper($pathString[$j])) ){
						$arrayPath[$i]=$newString;
						$i++;
						$newString="";
						$newString=$newString.$pathString[$j];

					}else{
						$newString = $newString.$pathString[$j];
					}
				}

			}

			$string;

			for($i=0;$i< count($arrayPath);$i++){
				if($i==0){
					$string=ucwords($arrayPath[0]);
				}else{
					$string=$string." ".ucwords($arrayPath[$i]);
				}
			}

			if($path == 'basic'){
				echo '<title>James McHugh Freelance Web Developer</title>';
			}else{
				if($path =='index'){
					echo '<title>James McHugh Freelance Web Developer</title>';
				}else{
					echo '<title>'.$string.' - James McHugh Freelance Web Developer</title>';
				}
			}

			if($path!="basic"){
				echo '<link type="text/css" rel="stylesheet" href="css/'.$path.'/style.css" />';
			}
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>

		<!--Start of container-->
		<div id="container">

			<?php include($root.'/php/components/top.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/menu.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/membersBar.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/noScript.php'); ?>

			<div class="clear"></div>

			<div id="contentLayer"></div>

			<div class="clear"></div>

			<div class="main" id="content">
				<div id="innerContent" class="inner">
					<h2 id="title">Main Menu</h2>
					<p id="welcome">Hello&nbsp;<span id="user"><?php echo getForenameAndSurname($_SESSION['uI']); ?></span>!</p>

					<!--Everyday tasks for users to use-->
					<div id="everydayTasksMenu" class="tasksMenuMain">
						<p id="everydayTasksMenuLabel" class="tasksMenuLabel">Everyday Tasks</p>
						<p id="everydayTasksInfo" class="tasksMenuInfo"><em>These tasks are open to all users, if you wish to have more priveleges please consult a primary user, supervisor or contact admin to open up these priveleges</em></p>
						<div id="everydayTasksMenuContainer" class="tasksMenuContainer">
							<a href="#" id="addNotes" class="buttonDefault">Add Notes to Project</a>
							<a href="yourProjects.php" id="manageProjects" class="buttonDefault">Manage Projects</a>
							<a href="#" id="workloadManager" class="buttonDefault">Workload Manager</a>
							<a href="myAccount.php" id="manageAccount" class="buttonDefault">Manage My Account</a>
							<a href="php/logOutUser.php" id="logOut" class="buttonDefault">Log Out</a>
						</div>
					</div>

					<?php
						if($userPrivileges['Admin'] == 1){
							//Edit company project details - Admin priveleges needed
							if($userPrivileges['addProjects'] == 1 || $userPrivileges['editProjects'] == 1 || $userPrivileges['deleteProjects'] == 1){
								echo "<div id=\"projectsMenu\" class=\"tasksMenuMain\">
									<p id=\"projectsMenuLabel\" class=\"tasksMenuLabel\">Project Details Admin</p>
									<p id=\"projectsInfo\" class=\"tasksMenuInfo\">
										<em>If you wish to have more privileges please consult a primary user, supervisor or contact admin to open up these priveleges</em>
									</p>
									<div id=\"projectsMenuContainer\" class=\"subMenuContainer\">";

									if($userPrivileges['addProjects'] == 1){
										echo "<a href=\"newQuoteAndCreateProject.php\" id=\"addProjectsDetails\" class=\"buttonDefault\">Add Project</a>";
									}

									if($userPrivileges['editProjects'] == 1){
										echo "<a href=\"#\" id=\"editProjectsDetails\" class=\"buttonDefault\">Edit Project</a>";
									}

									if($userPrivileges['deleteProjects'] == 1){
										echo "<a href=\"#\" id=\"deleteProjectsDetails\" class=\"buttonDefault\">Delete Project</a>";
									}

								echo"</div></div>";
							}

							//Edit users details - Admin priveleges needed
							if($userPrivileges['addUsers'] == 1 || $userPrivileges['editUsers'] == 1 || $userPrivileges['deleteUsers'] == 1){
								echo "<div id=\"usersMenu\" class=\"tasksMenuMain\">
									<p id=\"usersMenuLabel\" class=\"tasksMenuLabel\">User Details Admin</p>
									<p id=\"usersInfo\" class=\"tasksMenuInfo\">
										<em>If you wish to have more privileges please consult a primary user, supervisor or contact admin to open up these priveleges</em>
									</p>
									<div id=\"usersMenuContainer\" class=\"subMenuContainer\">";

									if($userPrivileges['addUsers'] == 1){
										echo "<a href=\"#\" id=\"addUsersDetails\" class=\"buttonDefault\">Add User</a>";
									}

									if($userPrivileges['editUsers'] == 1){
										echo "<a href=\"#\" id=\"editUsersDetails\" class=\"buttonDefault\">Edit User</a>";
									}

									if($userPrivileges['deleteUsers'] == 1){
										echo "<a href=\"#\" id=\"deleteUsersDetails\" class=\"buttonDefault\">Delete User</a>";
									}
								echo "</div></div>";
							}

							//Edit company card details - Admin priveleges needed
							if($userPrivileges['addCards'] == 1 || $userPrivileges['editCards'] == 1 || $userPrivileges['deleteCards'] == 1){
								echo "<div id=\"cardsMenu\" class=\"tasksMenuMain\">
									<p id=\"cardsMenuLabel\" class=\"tasksMenuLabel\">Card Details Admin</p>
									<p id=\"cardsInfo\" class=\"tasksMenuInfo\">
										<em>If you wish to have more privileges please consult a primary user, supervisor or contact admin to open up these priveleges</em>
									</p>
									<div id=\"cardsMenuContainer\" class=\"subMenuContainer\">";

									if($userPrivileges['addCards'] == 1){
										echo "<a href=\"#\" id=\"addCardDetails\" class=\"buttonDefault\">Add Card</a>";
									}

									if($userPrivileges['editCards'] == 1){
										echo "<a href=\"#\" id=\"editCardDetails\" class=\"buttonDefault\">Edit Card</a>";
									}

									if($userPrivileges['deleteCards'] == 1){
										echo "<a href=\"#\" id=\"deleteCardDetails\" class=\"buttonDefault\">Delete Card</a>";
									}

								echo "	</div></div>";
							}
						}
					?>
				</div>
			</div>

			<div class="clear"></div>

			<?php include($root.'/php/components/upperFooter.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/lowerFooter.php'); ?>

		</div>
		<!--End of Container-->

		<script type="text/javascript" src="/js/mainMenu/mainMenu.js"></script>
	</body>
</html>
<?php require_once("php/components/database/closedbConn.php");?>
