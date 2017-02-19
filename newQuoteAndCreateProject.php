<?php
	//import the root varaible
	$root=$_SERVER['DOCUMENT_ROOT'];
	//$root.="/jamesMcHugh";
	if(strpos($root, "jamesMcHugh")<16){
		$root=$root."jamesMcHugh";
	}

	if(!isset($_SESSION)){
		require_once($root."/php/functions/sessionFunctions.php");
	}

	//import database connections and functions
	require_once("php/components/database/dbConn.php");
	require_once("php/components/database/secureDatabase.php");
	require_once($root."/php/functions/functions.php");

	//check if a user has been set and whether the session has expired
	if(isset($_SESSION['uI']) && !sessionExpired()){
		//proceed onto the page, session is then refreshed
		//checks that the user has priveleges to create a new project
		$newProjectPrivilege=getUserPriveleges($_SESSION['uI']);
		if($newProjectPrivilege['addProjects'] == 1){
			$_SESSION['exp']=time()+10*60;
		}else{
			redirect_to("mainMenu.php");
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
					<h2 id="mainTitle">New Quote -<br/><span id="titleChange"> Create Project</span></h2>
					<p id="welcome">Hello&nbsp;<span id="user"><?php echo getForenameAndSurname($_SESSION['uI']); ?></span>!</p>
					<form>
						<div id="errorsProject" class="errors"></div>
						<fieldset id="componentSelection" class="section">
							<legend>Project Name &amp; Components Needed</legend>
							<div class="groupSelection" id="groupSelection0">
								<div>
									<label>Project Name: </label>
									<input type="text" id="projectName" class="text">
								</div>
							</div>
							<h3>What components would you like in your project?</h3>
							<em>Select as many or as few as you like</em>
							<div class="groupSelection" id="groupSelection1">
								<span id="websiteSelectMain" class="selectComponent">
									<p class="title">Website</p>
									<i class="fa fa-globe"></i>
									<input type="checkbox" id="websiteCheck" class="check" value="website">
								</span>
								<span id="databaseSelectMain" class="selectComponent">
									<p class="title">Database</p>
									<i class="fa fa-database"></i>
									<input type="checkbox" id="databaseCheck" class="check" value="database">
								</span>
								<span id="logoSelectMain" class="selectComponent">
									<p class="title">Logo</p>
									<i class="fa fa-magic"></i>
									<input type="checkbox" id="logoCheck" class="check" value="logo">
								</span>
								<span id="graphicsSelectmain" class="selectComponent">
									<p class="title">Graphics</p>
									<i class="fa fa-picture-o"></i>
									<input type="checkbox" id="graphicsCheck" class="check" value="graphics">
								</span>
								<span id="otherSelectMain" class="selectComponent">
									<p class="title">Other</p>
									<i class="fa fa-question-circle"></i>
									<input type="checkbox" id="otherCheck" class="check" value="other">
								</span>
							</div>
							<div id="controlPanel1" class="controlPanel">
								<em>Select all the components needed for you project from the selections above then click &quot;Next&quot; to proceed</em>
								<div>
									<input type="button" id="clearComponents" class="controlPanelButton" value="Clear">
									<input type="button" id="next" class="controlPanelButton" value="Next">
								</div>
							</div>
						</fieldset>

						<!--
						each one displays one in turn depending on what has been selected
						all selections are saved to an array
					-->
						<fieldset id="websitesSelectFieldset" class="section noDisplay">
							<legend>Website Specification Options</legend>
							<h3>What would you like me to do on your website?</h3>
							<em>Please only select one, you will be asked for more information after</em>
								<div class="groupSelection" id="groupSelection2">
									<span id="buildItContainerWEB" class="websiteOption">
										<p class="title">Build It!</p>
										<i class="fa fa-rocket"></i>
										<input type="radio" id="buildItOptionWEB" name="websiteOptionSelect" class="option" value="buildItWEB">
									</span>
									<span id="maintainItContainerWEB" class="websiteOption">
										<p class="title">Maintain It!</p>
										<i class="fa fa-heart"></i>
										<input type="radio" id="maintainItOptionWEB" name="websiteOptionSelect" class="option" value="maintainItWEB">
									</span>
									<span id="debugItContainerWEB" class="websiteOption">
										<p class="title">Debug It!</p>
										<i class="fa fa-bug"></i>
										<input type="radio" id="debugItOptionWEB" name="websiteOptionSelect" class="option" value="debugItWEB">
									</span>
									<span id="otherContainerWEB" class="websiteOption">
										<p class="title">Other</p>
										<i class="fa fa-question-circle"></i>
										<input type="radio" id="otherOptionWEB" name="websiteOptionSelect" class="option" value="otherWEB">
									</span>
								</div>

								<div id="moreDetailsWeb">
									<div id="buildItWebsiteDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelOther" id="label1SpanWeb">Amount of pages required: (Type &quot;0&quot; if unknown)</span>
											<input type="text" id="numberOfPages">
										</p>
										<p>
											<span class="labelTextArea" id="label2SpanWeb">Please include as many details about your website as possible: </span>
											<textarea id="buildItDetailsWeb"></textarea>
										</p>
									</div>
									<div id="maintainItWebsiteDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label3SpanWeb">Please include as many details on what work needs to be done: </span>
											<textarea id="maintainItDetailsWeb"></textarea>
										</p>
									</div>
									<div id="debugItDetailsWebsiteSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label4SpanWeb">Please include as many details on what work needs to be done: </span>
											<textarea id="debugItDetailsWeb"></textarea>
										</p>
									</div>
									<div id="otherDetailsWebsiteSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label5SpanWeb">Please include as many details on what work needs to be done: </span>
											<textarea id="otherDetailsWeb"></textarea>
										</p>
									</div>
								</div>

								<div id="controlPanel2" class="controlPanel">
									<em>Select the option from the selections above then click &quot;Next&quot; to proceed</em>
									<div>
										<input type="button" id="resetAllWEB" class="controlPanelButton" value="Reset All">
										<input type="button" id="resetWEB" class="controlPanelButton" value="Reset">
										<input type="button" id="nextWEB" class="controlPanelButton noDisplay" value="Next">
									</div>
								</div>
						</fieldset>

						<fieldset id="databaseSelectFieldset" class="section noDisplay">
							<legend>Database Specification Options</legend>
							<h3>What would you like me to do with your database?</h3>
							<em>Please only select one, you will be asked for more information after</em>
								<div class="groupSelection" id="groupSelection3">
									<span id="buildItContainerDB" class="databaseOption">
										<p class="title">Build It!</p>
										<i class="fa fa-rocket"></i>
										<input type="radio" id="buildItOptionDB" name="databaseOptionSelect" class="option" value="buildItDB">
									</span>
									<span id="maintainItContainerDB" class="databaseOption">
										<p class="title">Maintain It!</p>
										<i class="fa fa-heart"></i>
										<input type="radio" id="maintainItOptionDB" name="databaseOptionSelect" class="option" value="maintainItDB">
									</span>
									<span id="debugItContainerDB" class="databaseOption">
										<p class="title">Debug It!</p>
										<i class="fa fa-bug"></i>
										<input type="radio" id="debugItOptionDB" name="databaseOptionSelect" class="option" value="debugItDB">
									</span>
									<span id="otherContainerDB" class="databaseOption">
										<p class="title">Other</p>
										<i class="fa fa-question-circle"></i>
										<input type="radio" id="otherOptionDB" name="databaseOptionSelect" class="option" value="otherDB">
									</span>
								</div>

								<div id="moreDetailsDB">
									<div id="buildItDatabaseDetailsSection" class="moreDetailsSection noDisplay">
										<p class="relationalCheckSection">
											<input type="checkbox" value="None" id="relationalCheck" name="check" />
											<label for="relationalCheck"></label>
											<span class="labelTextArea" id="label1SpanDB">Do you wish to have a relational database? (Each table references the other)</span>
										</p>
										<p class="designCheckSection">
											<input type="checkbox" value="None" id="designCheck" name="check" />
											<label for="designCheck"></label>
											<span class="labelOther" id="label2SpanDB">Do you wish to have your database designed for you? </span>
										</p>
										<p>
											<span class="labelOther" id="label3SpanDB">Amount of tables required: (Type &quot;0&quot; if unknown)</span>
											<input type="text" id="numberOfTables">
										</p>
										<p>
											<span class="labelTextArea" id="label4SpanDB">Please include as many details about your database as possible: </span>
											<textarea id="buildItDetailsDB"></textarea>
										</p>
									</div>

									<div id="maintainItDatabaseDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label3SpanDB">Please include as many details about your database as possible: </span>
											<textarea id="maintainItDetailsDB"></textarea>
										</p>
									</div>

									<div id="debugItDatabaseDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label3SpanDB">Please include as many details about your database as possible: </span>
											<textarea id="debugItDetailsDB"></textarea>
										</p>
									</div>

									<div id="otherDatabaseDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label3SpanDB">Please include as many details about your database as possible: </span>
											<textarea id="otherDetailsDB"></textarea>
										</p>
									</div>
								</div>

								<div id="controlPanel3" class="controlPanel">
									<em>Select the option from the selections above then click &quot;Next&quot; to proceed</em>
									<div>
										<input type="button" id="resetAllDB" class="controlPanelButton" value="Reset All">
										<input type="button" id="resetDB" class="controlPanelButton" value="Reset">
										<input type="button" id="nextDB" class="controlPanelButton noDisplay" value="Next">
									</div>
								</div>
						</fieldset>

						<fieldset id="logoSelectFieldset" class="section noDisplay">
							<legend>Logo Specification Options</legend>
							<h3>What would you like me to do with your logo?</h3>
							<em>Please only select one, you will be asked for more information after</em>
								<div class="groupSelection" id="groupSelection4">
									<span id="buildItContainerLOGO" class="logoOption">
										<p class="title">Build It!</p>
										<i class="fa fa-rocket"></i>
										<input type="radio" id="buildItOptionLOGO" name="logoOptionSelect" class="option" value="buildItLOGO">
									</span>
									<span id="adjustItLOGO" class="logoOption">
										<p class="title">Adjust It!</p>
										<i class="fa fa-adjust"></i>
										<input type="radio" id="adjustItOptionLOGO" name="logoOptionSelect" class="option" value="maintainItLOGO">
									</span>
									<span id="otherContainerLOGO" class="logoOption">
										<p class="title">Other</p>
										<i class="fa fa-question-circle"></i>
										<input type="radio" id="otherOptionLOGO" name="logoOptionSelect" class="option" value="otherLOGO">
									</span>
								</div>

								<div id="moreDetailslogo">
									<div id="buildItLogoDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label1SpanLogo">Please include as many details about your database as possible: </span>
											<textarea id="buildItDetailsLogo"></textarea>
										</p>
									</div>

									<div id="adjustThemLogoDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label2SpanLogo">Please include as many details about your database as possible: </span>
											<textarea id="adjustThemDetailsLogo"></textarea>
										</p>
									</div>

									<div id="otherLogoDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label2SpanLogo">Please include as many details about your database as possible: </span>
											<textarea id="otherDetailsLogo"></textarea>
										</p>
									</div>
								</div>

								<div id="controlPanel4" class="controlPanel">
									<em>Select the option from the selections above then click &quot;Next&quot; to proceed</em>
									<div>
										<input type="button" id="resetAllLogo" class="controlPanelButton" value="Reset All">
										<input type="button" id="resetLogo" class="controlPanelButton" value="Reset">
										<input type="button" id="nextLogo" class="controlPanelButton noDisplay" value="Next">
									</div>
								</div>
						</fieldset>
						<fieldset id="graphicsSelectFieldset" class="section noDisplay">
							<legend>Graphics Specification Options</legend>
							<h3>What work would you like done on your graphics?</h3>
							<em>Please only select one, you will be asked for more information after</em>
								<div class="groupSelection" id="groupSelection5">
									<span id="buildItContainerGRA" class="graphicsOption">
										<p class="title">Build It!</p>
										<i class="fa fa-rocket"></i>
										<input type="radio" id="buildItOptionGRA" name="graphicsOptionSelect" class="option" value="buildItGRA">
									</span>
									<span id="adjustThemGRA" class="graphicsOption">
										<p class="title">Adjust Them!</p>
										<i class="fa fa-adjust"></i>
										<input type="radio" id="adjustThemOptionGRA" name="graphicsOptionSelect" class="option" value="maintainThemGRA">
									</span>
									<span id="otherContainerGRA" class="graphicsOption">
										<p class="title">Other</p>
										<i class="fa fa-question-circle"></i>
										<input type="radio" id="otherOptionGRA" name="graphicsOptionSelect" class="option" value="otherGRA">
									</span>
								</div>

								<div id="moreDetailsGRA">
									<div id="buildItGraphicsDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label1SpanLogo">Please include as many details about your database as possible: </span>
											<textarea id="buildItDetailsGRA"></textarea>
										</p>
									</div>

									<div id="adjustThemGraphicsDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label2SpanLogo">Please include as many details about your database as possible: </span>
											<textarea id="adjustThemDetailsGRA"></textarea>
										</p>
									</div>

									<div id="otherGraphicsDetailsSection" class="moreDetailsSection noDisplay">
										<p>
											<span class="labelTextArea" id="label2SpanLogo">Please include as many details about your database as possible: </span>
											<textarea id="otherDetailsGRA"></textarea>
										</p>
									</div>
								</div>

								<div id="controlPanel5" class="controlPanel">
									<em>Select the option from the selections above then click &quot;Next&quot; to proceed</em>
									<div>
										<input type="button" id="resetAllGraphics" class="controlPanelButton" value="Reset All">
										<input type="button" id="resetGraphics" class="controlPanelButton" value="Reset">
										<input type="button" id="nextGraphics" class="controlPanelButton noDisplay" value="Next">
									</div>
								</div>
						</fieldset>
						<fieldset id="otherSelectFieldset" class="section noDisplay">
							<legend>Other Specification Options</legend>
							<h3>What other components can I help with or advise on?</h3>
							<em class="adviceSet">Please specify in as much detail as possible</em>
							<em class="adviceSet" id="pointsToConsider">
								Points to consider:
							</em>
								<ul id="adviceList">
									<li>What is it?</li>
									<li>What is it supposed to do?</li>
									<li>How is it supposed work?</li>
									<li>How is it supposed fit in with your day to day lives and existing components?</li>
									<li>Why is there a need for this component?</li>
								</ul>
							<textarea id="otherInfo"></textarea>
							<div id="controlPanel6" class="controlPanel">
								<em>Select enter the information above and click &quot;Next&quot; to proceed</em>
								<div>
									<input type="button" id="resetAllOther" class="controlPanelButton" value="Reset All">
									<input type="button" id="resetOther" class="controlPanelButton" value="Reset">
									<input type="button" id="nextOther" class="controlPanelButton" value="Next">
								</div>
							</div>
						</fieldset>

						<!--displays regardless-->
						<fieldset id="projectDetailsFieldset" class="section noDisplay">
							<legend>Project Details</legend>
							<h3>Please enter the full project specification below</h3>
							<em id="uploadInstructions">
								As our upload terminal for files is unavailble at the moment, please archive all files into a zip directory and <a href="mailTo:james.mchugh.webdeveloper@gmail.com">send them to me.</a><br>
								Alternatively you can upload them to the cloud and send them in the same way, you can then <a href="mailTo:james.mchugh.webdeveloper@gmail.com">send me the link</a> as normal.
							</em>
							<textarea id="projectDetails"></textarea>
							<div id="controlPanel7" class="controlPanel">
								<em>You are now ready to go click &quot;Next&quot; to proceed</em>
								<div>
									<input type="button" id="resetAllProjectDetails" class="controlPanelButton" value="Reset All">
									<input type="button" id="resetProjectDetails" class="controlPanelButton" value="Reset">
									<input type="submit" name="submit" id="nextProjectDetails" class="controlPanelButton" value="Next">
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>

			<div class="clear"></div>

			<?php include($root.'/php/components/upperFooter.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/lowerFooter.php'); ?>

		</div>
		<!--End of Container-->

		<script type="text/javascript" src="/js/newQuoteAndCreateProject/newQuoteAndCreateProject.js"></script>
	</body>
</html>
