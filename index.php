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
				echo '<link type="text/css" rel="stylesheet" href="css/'.$path.'/' . $path .'.css" />';
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

			<?php include('components/pages/index/slider/index-slider.php'); ?>

			<div class="clear"></div>

			<?php include('components/pages/index/contactMe/index-contactMe.php'); ?>

			<div class="clear"></div>

			<?php include('components/pages/index/myServices/index-myServices.php'); ?>

			<div class="clear"></div>

			<!--Start of Main Content-->
			<div class="main" id="content">
			  <div id="innerContent" class="inner">
			    <div id="summary">
			      <h2 name="aboutme">About Me</h2>
			      <p>
			      Hi, I'm James McHugh and I am a freelance web designer, developer and tester. <br/>
			      I studied at the University of Brighton on a Bsc (Hons) Computer Science (Software Engineering) course.
			      I left in the second year because I felt the level teaching was not to the standard I required, so I took the knowledge I learned so far and started to develop it further by practising what I have learnt and learning new skills including gain more experience in the field,
			      I haven't looked back since.
			      </p>
			      <p>
			        My main skills are in website design and coding of the front end (HTML, CSS, JavaScript, AJAX and jQuery) with some back end coding involvement (PHP and MySQL),
			        but due to a high demand off my clients, I am now training to do more back end development and then into logo and graphics design. Another area of
			        key interest of mine that I am now exploring is responsive web design
			      </p>
			      <p>
			        I have a passion for web design, development, programming and user interface design. I make sure that the end user has the best experience with my websites, the user interface is appealing and is simple to use.
			        I love being able to design user interfaces, build them and use existing technologies to solve complex and everyday problems.
			        In addition to this am passionate about the quality of my work, as this will gave a knock on effect to stages that proceed the previous.
			      </p>
			      <p>I love learning new skills, especially in computing because I have a thirst for knowledge and love being diverse within my skill sets. I have the ability to learn new skills with others and at home, an example of this is when I have studied at home to learn PHP and jQuery.</p>
			      <a href="bio.html" class="yes" id="more" title="Go to my Biography">Find Out More</a>
			    </div>
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
