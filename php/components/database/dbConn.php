<?php
defined("DBHOST") ? null : define("DBHOST", "localhost");
defined("DBUSER") ? null : define("DBUSER", "james");
defined("DBPASSWORD") ? null : define("DBPASSWORD", "j4m3rs1406uk");
defined("DB_NAME") ? null : define("DB_NAME", "jamesmchughadmin");

	$connection=mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DB_NAME);

	if(mysqli_connect_errno()){
		die("Database connection failed: " .
			mysqli_connect_error() .
			" (" . mysqli_connect_errno() . ")"

			);

	}
?>
