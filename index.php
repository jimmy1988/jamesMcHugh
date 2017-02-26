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

			<?php //include('components/pages/index/slider/index-slider.php'); ?>

			<!-- <div class="clear"></div> -->

			<?php //include('components/pages/index/myServices/index-myServices.php'); ?>

			<!-- <div class="clear"></div> -->

			<!--Start of Main Content-->
			<div class="main" id="content">
			  <div id="innerContent" class="inner">
			    <p id="mainIntroduction">
						Hi! I'm James and I am a Freelance Web Developer Based in Brighton.
					</p>
					<p id="summary">
						
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
