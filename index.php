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
				echo '<link type="text/css" rel="stylesheet" href="css/'.$path.'/' . $path .'.css?' . date('d-m-Y_h:i:s') . '" />';
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

			<!--Start of Main Content-->
			<div class="main" id="content">
			  <div id="innerContent" class="inner">
			    <p id="mainIntroduction">
						Hi! I'm James and I am a Freelance Web Developer Based in Brighton.
					</p>
					<p id="summary">
						<span>I am a very down to earth guy who has a passion for computing especially web design, development and programming.</span>
						<br/>
						<span>I have worked hard to achieve what I have achieved so far and plan to continue this with all of my future projects. I love being able to take a client's idea or problem and turn it into a working solution using a computer as the tools to help their dreams become reality.</span>
						<br/>
						<span>I pride myself on getting to know the client and their idea or business first before commencing any form of design or specification. Once this is completed I can draft up a design and specifictaion for the project and get this signed off by the client, from that point forward the project can get built.</span>
					</p>
					<p id="keySkills">
						I have knowledge in the following aspects of website design, development and programming:
						<ul id="skillsList">
							<li>HTML(5) and CSS(3)</li>
							<li>JavaScript</li>
							<li>jQuery</li>
							<li>PHP and MySQL</li>
							<li>SQL</li>
							<li>Version Control through Git and GitHub</li>
							<li>Microsoft and Linux servers</li>
						</ul>
					</p>
					<p id="summaryPart2">
						Even if these skill sets do not mean much to you, you can be reassured that I have the skills to create a fully functional and visually pleasing website. All websites are standards compliant and are codes in the latest programming languages to guarantee security, they are also programmed to adapt to all browsers.
						<br/>
						Any advice that is given is genuine and researched for the latest information before it is given.
					</p>
					<a href="#" id="readMore">Read More</a>
			  </div>
			</div>
			<!--End of Main Content-->

			<div class="clear"></div>

			<?php include('components/layout/upperFooter/upperFooter.php'); ?>

			<div class="clear"></div>

			<?php include('components/layout/lowerFooter/lowerFooter.php'); ?>

		</div>
		<!--End of Container-->

	</body>
</html>
