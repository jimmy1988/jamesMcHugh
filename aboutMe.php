<!DOCTYPE html>
<html>
	<head>
		<?php
			global $root;
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
					<h1>Biography</h1>
					<div id="quickLinks">
						<h3>Quick Links</h3>
						<em>Click on a link to go to the relevant section</em>
						<ul>
							<li><a href="#skills">My Skills</a><li>
							<li><a href="#userInterface">How I Design User Interfaces</a><li>
							<li><a href="#code">How I code web sites</a><li>
							<li><a href="#education">My Education and Employment</a><li>
						</ul>
					</div>
					<div class="mainSection">
						<div name="skills" id="skills">
							<div><h3>My Skills</h3><a href="#container">Go to top</a></div>
								<p>I posses many skills from university, which are:
									<ul>
										<li>Core Programming Concepts (in Java, Assembly and C)</li>
										<li>HTML &amp; CSS Web Design</li>
										<li>JavaScript Core Knowledge</li>
										<li>AJAX</li>
										<li>Data Structures and Algorithms Development (no longer used)</li>
										<li>PHP and MySQL Development (including website security)</li>
										<li>Database Design and construction</li>
									</ul>
								</p>
								<p>The skills I have or are yet to aquire, these will come with more study and experience:
									<ul>
										<li>Responsive Web Design (learning-in progress)</li>
										<li>jQuery (learning-nearly complete)</li>
										<li>WordPress(learning)</li>
										<li>PHP  - securing websites (on going module - security threats change, so does the counter attacks)</li>
										<li>Other JavaScript Libraries (node.js, angular.js e.t.c - these will be started once jQuery has been established as a skill)</li>
									</ul>
								</p>
							</div>
							<div name="userInterface" id="userInterface">
							<div><h3>How I Design User Interfaces</h3><a href="#container">Go to top</a></div>
								<p>Using the skills I have and some I am yet to acquire, I can build user interfaces that are simple and easy to use as well as makiing sure they are appealing.
									One method of I like to use for implementing this solution is providing help on the screen via pop-ups, tooltips, help menus and help documentaion.
									These methods are readily available to the user but are not forced upon them, therefore the initial state of the website or web application is as if the user
									has been using the system as normal.
								</p>
							</div>
							<div name="code" id="code">
								<div><h3>How I code web sites</h3><a href="#container">Go to top</a></div>
								<p>As far as coding is concerned, all code is adhered to by my strict coding practices. All code is commented upon, with what
									the piece of code is supposed to do and/or what it is. In addition strict naming conventions are used, by using camel case to identify multiple phrases
									and underscores to identify the section it belongs to. I use indentation to assist with readabilty with my code but as far as automatically generating code is concered indentation is out of my control.<br/>
									These methods are used because I want other developers to take ehat I have done and follow it, if any changes need to be done they can build on the existing code what I have done.
								</p>
							</div>
							<div name="education" id="education">
								<div><h3>My Education and Employment</h3><a href="#container">Go to top</a></div>
								<p>I started using computers when I was 8 years old, I started by using them to create custom pictures in paint. From there I started playing with each program to ge to grips with the software.
								The kind of things I used to create were paint drawings, clip art effects, word, excel and access documents and then onto playing games.<br/>
								For the GCSE years I started creating and munipulating Excel spreadsheets, Access Databases, Word Documents, powerpoint presentations and paint projects.
								This is how i started to learn how to use the internet properly to get the information I wanted fo my projects.<br/>
								During the IT projects I created a project to promote a local event in the area, I had to create posters, brochures, presentations and business cards using word and powerpoint.
								After this we had to construct the Excel Spreadsheet that would keep track of income for the event and a database for a list of all the members ad their address.
								A mail shot was created to send a letter to all members of the event to thank them for their custom thus informing them of other upcoming events taht had been arranged.
								 I enjoyed this project as I got to diversify my skills in Word and Powerpoint.
								 </p>
								<p>As soon as left secondary school, I enrolled on a course to take me from the basics in my IT courses at school to Advanced Level, the course took me all directions from learning the structure of organisations,
								designing systems, designing and creating websites, databases, excel spreadsheets and programs, I even got the chance to improve my mathemtics skills whilst on the course.<br/>
								This where I started to get passionate for programming and web development but since the skills were fairly basic, this soon wore off and I went into employment.
								</p>
								<p>From 2005 to 2008, I have been employed twice as an administrator, once as Decommissioning Engineer and Volunteered to perform computing tasks for people.
								During thsi time whilst unemployed, I battled with financial debt and depression, but came through stronger than before.
								</p>
								<p>After 5 years of being in employment and moving from one job to the other plus being unemployed for a year and a half due to the recession, I decided enough was enough and I enrolled back in college again to get into university and
								update all of my skills. I enrolled on an Adult Access to Higher Eductation Course in Software Design, this is where all of my existing skills were updated including English and Maths, in addition I learned new skills in Games Programming and Web Server Scripting
								, this is where the passion for programming and web development started to gain pace and therefore I started to have a bigger passion for the subjects I wanted to study. From the course I got all Distinctions, Merits and Passes, which are all the highest marks achievable on the course.
								During this course I applied to university, which I managed to secure a place and get onto the course I had wanted, at this point I was at a point in my development that I wanted to be.
								</p>
								<p>After finishing college, I worked during the summer non-stop at Tesco to gain the money I needed for the deposit for my new flat, the moving costs and to pay for spending whilst I was in the first week.<br/>
								Then after the summer had ended, I moved to Brighton, where I started University, the first and second years where hard as alot of the study work had to be self taught, which took alot of energy and hours to study, but  I got there in the end.
								During the two years I was there I enjoyed the learning experience but the teaching experience I did not enjoy, these reasons are personal.
								After the second year, I dropped out and started self study from home to become a web developer, this concept I enjoy more than any other subject because of the creativity aspect of it.<br/>
								At a later date I can come back to programming and software development, if I wish but at tyhe moment I am having too much fun being a web developer.
								</p>
								<p>
								Now I am constantly finding ways to use my existing skills to better myself and find new skills to learn because now I have skills that people want and also I can share with others.
								</p>
							</div>
					</div>
				</div>
			</div>

			<div class="clear"></div>

			<?php include($root.'/php/components/upperFooter.php'); ?>

			<div class="clear"></div>

			<?php include($root.'/php/components/lowerFooter.php'); ?>

		</div>
		<!--End of Container-->

	</body>
</html>
