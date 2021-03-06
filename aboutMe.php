<!DOCTYPE html>
<html>
	<head>
		<?php
			$path=basename(__FILE__,'.php');

			$pathString=str_split($path);

			include('components/layout/header/header.php');
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
				echo '<link type="text/css" rel="stylesheet" href="css/'.$path.'/' . $path . '.css?' . date('d-m-Y_h:i:s') .'" />';
			}
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>

		<!--Start of container-->
		<div id="container">

			<?php include('components/layout/top/top.php'); ?>

			<div class="clear"></div>

			<?php include('components/layout/menu/menu.php'); ?>

			<div class="clear"></div>

			<?php include('components/layout/noScript/noScript.php'); ?>

			<div class="clear"></div>

			<div id="contentLayer"></div>

			<div class="clear"></div>

			<div class="main" id="content">
				<div id="innerContent" class="inner">
					<h1>About Me</h1>

					<div id="mainIntroductionAboutMe">
						<h4 id="aboutMeMainIntroductionTitle">Introduction</h4>
						I have a passion for computing, particularly web design, development and able to programming. <br/>
						I love being develop websites that can bring clients closer to their customers and enhance a company's image. I love bringing new designs to the table and creating them, experimentation is a big thing I like to as well as this help to experiment with new features, tool and techniques to help enhance the user experience and help with the development process.<br/>
						I first started developing websites within Frontpage and Dreamweaver and then moved into HTML and CSS. Once I had learned these skills I then moved into javascript where I was excited to learn new skills to improve user experience and harness the power of the web.
						Since then my knowledge has exploded into learning PHP, jQuery, SASS and LESS, Git and GitHub. I have never stopped learning new skills and I take advice regularly from developers onboard everytime I meet them, this gives me a unique opportunity to progress and develop into new skills.
					</div>

					<div id="keySkills">
						<h4 id="aboutMeKeySkillsTitle">Skills</h4>
						<p>So far I have acquired the following skills:</p>
						<ul id="skillList">
							<li>HTML(5), CSS(3) and JavaScript(ES5)</li>
							<li>SASS and LESS</li>
							<li>jQuery</li>
							<li>PHP</li>
							<li>Version Control (Git and GitHub)</li>
						</ul>
					</div>

					<div id="myClients">
						<h4 id="myClientsTitle">My Clients</h4>
						<a id="theMarineTavernLogo" href="http://www.marinetavern.co.uk"><img id="marineTavernLogoImage" src="images/clientLogos/theMarineTavern.png"/></a>
					</div>
				</div>
			</div>

			<div class="clear"></div>

			<?php include('components/layout/upperFooter/upperFooter.php'); ?>
			<div class="clear"></div>

			<?php include('components/layout/lowerFooter/lowerFooter.php'); ?>

		</div>
		<!--End of Container-->

	</body>
</html>
