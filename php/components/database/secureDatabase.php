<?php

	function prepareString($string){
		global $connection;
		$string=trim($string);
		$string=mysqli_real_escape_string($connection, $string);
		return $string;
	}

	function generateSalt($length){
		$unique_random_string = md5(uniqid(mt_rand(), true));
		$base64_string= base64_encode($unique_random_string);
		$modified_base64_string=str_replace("+",".", $base64_string);
		$salt = substr($modified_base64_string, 0, $length);
		return $salt;
	}

	function securePassword($password){

		//encrypt
		$hash_format="$2y$10$";
		$salt=generateSalt(22);

		$format_and_salt=$hash_format . $salt;

		$hash=crypt($password, $format_and_salt);

		return $hash;

		//decrypt

		/* $hash2=crypt($password, $hash); */
	}
?>
