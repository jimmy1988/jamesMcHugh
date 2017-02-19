<?php
//stores the errors in an array
//the array is empty because no errors exist yet
$errors=array();

//displays a field as the correct formatted text
function field_name_as_text($fieldname){
	//replaces all underscore with a space
	$fieldname=str_replace("_", " ", $fieldname);
	//converts the first letter of the string to upper case
	$fieldname =ucfirst($fieldname);
	//returns the formatted field name
	return $fieldname;
}
//* presence
//use trim() so empty spaces dont count
//use === to avoid false positives
//empty would consider "0" to be empty
function has_presence($value){
	//makes sure the current field is set and is not blank
	//returns a true or false value
	return isset($value) && $value !== "";
}

//validates that a field has presence
function validate_presences($required_fields){
	//import errors from the global scope
	global $errors;

	//each field is evaluated for presence, if blank an error message is blank
	foreach ($required_fields as $field){
		//trims all spaces
		$value =trim($_POST[$field]);
		//check for presence
		if (!has_presence($value)){
			//if no presence is detected, generate error
			$errors[$field]=field_name_as_text($field). " can't be blank";
		}
	}
}

//checks that the string length does not exceed the stated length
//takes in a max length parameter to detect what length it should be
function has_max_length($value,$max){
	return strlen($value)<=$max;
}

//validates that the field is of the correct max length
function validate_max_lengths($fields_with_max_lengths){
	//imports the errors array from the global scope
	global $errors;
	//Expects an assoc array
	foreach($fields_with_max_lengths as $field =>$max){
		//trim spaces
		$value = trim($_POST[$field]);
		//validate the length
		if(!has_max_length($value,$max)){
			//generate error message if too long
			$errors[$field] = field_name_as_text($field)." is too long";
		}
	}
}

function checkEmail($email){
	global $errors;
	//check for @
	//check for . after @
	//check for at least 2 chars after last .
	$firstAtPos=strpos($email, "@");

	if($firstAtPos){

		$newEmail = substr($email, $firstAtPos+1);
		$atRepeat = strpos($newEmail, "@");
		if(!$atRepeat){

			$dot1Pos=strpos($email, ".", $firstAtPos);

			if ($dot1Pos){
				$suffix=substr($email, $dot1Pos+1);
				$suffixLength=strlen($suffix);
				if($suffixLength > 1 ){
					return true;
				}else{
					$errors['email'] = "Email is of an incorrect format";
				}
			}else{
				$errors['email'] = "Email is of an incorrect format";
			}
		}else{
			$errors['email'] = "Email is of an incorrect format";
		}
	}else{
		$errors['email'] = "Email is of an incorrect format";
	}
}

//inclusion in a set
function has_inclusion_in($value,$set){
	return in_array($value,$set);
}

function checkErrors($required_fields){
	global $errors;

	validate_presences($required_fields);
	if(empty($errors)){
		$email=$_POST["email"];
		checkEmail($email);
		if(empty($errors)){
			return true;
		}
	}
}



	function hasPresence($field){
		//check to see if the data in the field is present
		if(isset($field)){
			if($field!=""){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function emailIsCorrectFormat($email){
		//check for @
		//check for . after @
		//check for at least 2 chars after last .
		$firstAtPos=strpos($email, "@");

		if($firstAtPos){

			$newEmail = substr($email, $firstAtPos+1);
			$atRepeat = strpos($newEmail, "@");
			if(!$atRepeat){

				$dot1Pos=strpos($email, ".", $firstAtPos);

				if ($dot1Pos){
					$suffix=substr($email, $dot1Pos+1);
					$suffixLength=strlen($suffix);
					if($suffixLength > 1 ){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function isCorrectLength($data, $min, $max){
		if (strlen($data) >= $min && strlen($data) <=$max){
			return true;
		}else{
			return false;
		}
	}

	function capitalLetterIsPresent($data){
		$dataArray=str_split($data);
		$valid=false;
		for($i=0; $i<count($dataArray);$i++){
			if(is_numeric($dataArray[$i])){
				if($dataArray[$i] == strtoupper($dataArray[$i])){
					$valid=true;
				}else{
					$valid=false;
				}
			}else{
				continue;
			}
		}

		return $valid;

	}

	function convertStringToNumber($string){
		switch($string){
			case("0"):
				$string=0;
			case("1"):
				$string=1;
			case("2"):
				$string=2;
			case("3"):
				$string=3;
			case("4"):
				$string=4;
			case("5"):
				$string=5;
			case("6"):
				$string=6;
			case("7"):
				$string=7;
			case("8"):
				$string=8;
			case("9"):
				$string=9;
			default:
				break;
		}

		return $string;
	}

	function numberIsPresent($data){
		$dataArray=str_split($data);
		$valid=false;
		for($j=0;$j<count($dataArray);$j++){
			$number=convertStringToNumber($dataArray[$j]);
			if(is_numeric($number)){
				continue;
			}else{
				$valid=true;
			}
		}

		return $valid;
	}

	function passwordCorrectFormat($password){
		if(isCorrectLength($password, 5, 12)){
			//check for capital letter
			//check for numbers

			if (capitalLetterIsPresent($password) && numberIsPresent($password)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function password_check($password, $existing_hash){
		//existing hash contains format and salt at start
		$hash = crypt($password, $existing_hash);
		//checks the encrypted password attempt against the one that is encrypted in the database
		if ($hash==$existing_hash){
			//password matches
			return true;
		}else{
			//password does not match
			return false;
		}
	}

?>
