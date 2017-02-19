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
					<h1 id="title">Thank You For Your Enquiry</h1>
					<p title="mainPara">Your message has been recieved, an email has been sent to the email address provided.<br/>
						I will aim to get back to you within 14 working days, this maybe sooner depending on the volume of enquiries.
						If you wish to have a quick response, please feel free to <a <a href="mailto:james.mchugh.webdeveloper@gmail.com" id="mailTo">send me an email</a>.
					</p>
					<h4 id="nextAction">What would you like to do now?</h4>
					<a href="index.php" id="goHome" class="btn">Go to The Home Page</a>
					<a href="login.php" id="loginAccount" class="btn">Login to My Account</a>
					<a href="contactMe.php" id="sendMessage" class="btn">Send Another Message</a>
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
