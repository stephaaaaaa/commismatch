<?php
    // initialize the dao w/require once
	require_once("dao.php");
	session_start();
	
	$dao = new Dao();

    function isValid($raw, $minLength, $maxLength){
        $trimmed = trim($raw);
        $isValid = false;
        if(strlen($trimmed) >= $minLength && strlen($trimmed) <= $maxLength){
            $isValid = true;
        }
		return $isValid;
	}
	
	function containsNumbers($string){
		if(preg_match('/\\d/', $string) > 0){
			return true;
		}
		return false;
	}

	function isGoodPassword($password){
		if(preg_match('[\W]', $password) && preg_match('/\\d/', $password) && preg_match("/([A-Z])/", $password)){
			return true;
		}
		return false;
	}

	function isValidEmail(){

	}

	function eighteenOrOlder($birthday, $age){
		$birthdayAsTime = strtotime($birthday);

		if(time()-$birthdayAsTime >= $age * 31536000){
			return true;
		}
		return false;
	}
	
    $email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
    $confirmedPassword = htmlspecialchars($_POST['confirmedPassword']);
	if(htmlspecialchars($_POST['acceptingCommissions']) == 'Yes'){
		$acceptingCommissions = '1';
	}else{
		$acceptingCommissions = '0';
	}
	$country = htmlspecialchars($_POST['country']);
	$city = htmlspecialchars($_POST['city']);
	$valid = true;
	$editErrors = array();

	// EMAIL VALIDATION
    if(!isValid($email, 1, 50)){
		if(filter_var($email_a, FILTER_VALIDATE_EMAIL)){
			$editErrors['email'] = "Invalid email address.";
		}else{
			$editErrors['email'] = "Please enter an email address.";
		}
	}
	// ACCEPTING COMMISSIONS VALIDATION
	if($acceptingCommissions == ""){
		$editErrors['acceptingCommissions'] = "Specify whether or not you will accept commissions for your art.";
	}
	// LOCATION VALIDATION
	if(!isValid($country, 1, 25)){
		if(containsNumbers($country)){
			$editErrors['country'] = "Country cannot contain numbers";
		}else{
			$editErrors['country'] = "Please enter a country";
		}
	}
	if(!isValid($city, 1, 25)){
		if(containsNumbers($city)){
			$editErrors['city'] = "City cannot contain numbers";
		}else{
			$editErrors['city'] = "Please enter a city";
		}
	}
	// PASSWORD VALIDATION
    if(!isValid($password, 10, 128)){
		$editErrors['password'] = "Password length must be at least 10 characters long.";
	} else if($password != $confirmedPassword){
		$editErrors['confirmedPassword'] = "Passwords do not match";
    } else if(!isGoodPassword($password)){
		$editErrors['password'] = "Password must contain at least 1 number, 1 special character, and 1 capital letter.";
	}

	// REDIRECT
	if(empty($editErrors)){
        // create a functionality to edit the current user's info
        //$dao->addUser($fName, $lName, $username, $birthday, $gender, $acceptingCommissions, $city, $country, $email, $password);
		header("Location: user.php");
	} else {
		$_SESSION['errors'] = $editErrors;
		$_SESSION['presets'] = array('username' => htmlspecialchars($username),
										'email' => htmlspecialchars($email)) ;

		header("Location: signup.php");
	}
?>