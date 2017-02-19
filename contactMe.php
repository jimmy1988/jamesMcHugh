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
				echo '<link type="text/css" rel="stylesheet" href="css/'.$path.'/' . $path . '.css" />';
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
					<h1>Contact Me</h1>
						<div class="leftOverride">
							<form id="contactForm">
								<h2>Send me a Message</h2>
								<em id="instructions">Please fill in all fields, then click submit to send me a message</em>
								<div id="errors"></div>
								<div id="firstName_section">
									<label class="contactFormLabel">Your First Name: </label>
									<input type="text" class="contactFormText" name="firstName" value="<?php if(isset($_POST["firstName"])){echo $_POST["firstName"];}  ?>" id="firstName"/>
								</div>
								<div id="surname_section">
									<label class="contactFormLabel">Your Surname: </label>
									<input type="text" class="contactFormText" name="surname" value="<?php if(isset($_POST["surname"])){echo $_POST["surname"];} ?>" id="surname"/>
								</div>
								<div id="email_section">
									<label class="contactFormLabel">Your E-mail Address: </label>
									<input type="email" class="contactFormEmail" name="email" value="<?php if(isset($_POST["email"])){echo $_POST["email"];} ?>" id="email"/>
								</div>
								<div id="message_section">
									<label class="contactFormLabel">Your Comment/Message: </label>
									<textarea id="message" class="contactFormTextarea" name="message" rows="10"><?php if(isset($_POST["message"])){echo $_POST["message"];}?></textarea>
								</div>
								<input type="button" id="submit" name="submit" value="Submit"/>
								<a href="#" id="spinnerContainer"><i id="spinner" class="fa fa-spinner fa-spin"></i></a>
							</form>
						</div>
						<div class="rightOverride">
							<div class="contactOther" id="socialLinks">
								<h2>Add me</h2>
								<div>
									<a href="#"><i class="fa fa-facebook-square"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-google-plus"></i></a>
									<a href="#"><i class="fa fa-pinterest-p"></i></a>
								</div>
							</div>
							<div class="contactOther" id="mailLink">
								<h2>Send me an E-mail</h2>
								<div>
									<a href="mailto:james.mchugh.webdeveloper@gmail.com"><i class="fa fa-envelope-o"></i></a>
								</div
							</div>
						</div>
				</div>
			</div>

			<div class="clear"></div>

			<?php include('components/layout/upperFooter/upperFooter.php'); ?>

			<div class="clear"></div>

			<?php include('components/layout/lowerFooter/lowerFooter.php'); ?>

		</div>
		<!--End of Container-->
		<script type="text/javascript" src="<?php echo $root; ?>js/contactMe/contactMe.js"></script>

	</body>
</html>
