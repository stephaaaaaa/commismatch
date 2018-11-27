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

	function eighteenOrOlder($birthday, $age){
		$birthdayAsTime = strtotime($birthday);

		if(time()-$birthdayAsTime >= $age * 31536000){
			return true;
		}
		return false;
	}
	
	$fName = htmlspecialchars($_POST['firstName']);
	$lName = htmlspecialchars($_POST['lastName']);
	$birthday = htmlspecialchars($_POST['birthday']);
	$birthday = strtotime($birthday);
	$birthday = date('Y-m-d',$birthday);
    $gender = $_POST['gender'];
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	if(htmlspecialchars($_POST['acceptingCommissions']) == 'Yes'){
		$acceptingCommissions = '1';
	}else{
		$acceptingCommissions = '0';
	}
	$country = htmlspecialchars($_POST['country']);
	$city = htmlspecialchars($_POST['city']);
	$confirmedPassword = htmlspecialchars($_POST['confirmedPassword']);
	$valid = true;
	$signupErrors = array();

	//FIRST AND LAST NAME VALIDATION
	if(!isValid($fName, 1, 25)){
		$signupErrors['fName'] = "Please enter a valid first name.";
	}
	if(containsNumbers($fName)){
		$signupErrors['fName'] = "Your first name cannot contain numbers.";
	}
	if(containsNumbers($lName)){
		$signupErrors['lName'] = "Your last name cannot contain numbers.";
	}
	if(!isValid($lName, 1, 25)){
		$signupErrors['lName'] = "Please enter a valid last name.";
	}
	// BIRTHDAY VALIDATION
	if(!eighteenOrOlder($birthday, 18)){
		$signupErrors['birthday'] = "You must be 18 or older to sign up.";
	}
	// GENDER VALIDATION
	if($gender == ""){
		$signupErrors['gender'] = "Select a gender.";
	}
	// USERNAME VALIDATION
    if(!isValid($username, 1, 25)){
		$signupErrors['username'] = "Username is required and must be at least 25 characters.";
    }
	// EMAIL VALIDATION
    if(!isValid($email, 1, 50)){
		if(filter_var($email_a, FILTER_VALIDATE_EMAIL)){
			$signupErrors['email'] = "Invalid email address.";
		}else{
			$signupErrors['email'] = "Please enter an email address.";
		}
	}
	// ACCEPTING COMMISSIONS VALIDATION
	if($acceptingCommissions == ""){
		$signupErrors['acceptingCommissions'] = "Specify whether or not you will accept commissions for your art.";
	}
	// LOCATION VALIDATION
	if(!isValid($country, 1, 25)){
		if(containsNumbers($country)){
			$signupErrors['country'] = "Country cannot contain numbers";
		}else{
			$signupErrors['country'] = "Please enter a country";
		}
	}
	if(!isValid($city, 1, 25)){
		if(containsNumbers($city)){
			$signupErrors['city'] = "City cannot contain numbers";
		}else{
			$signupErrors['city'] = "Please enter a city";
		}
	}
	// PASSWORD VALIDATION
    if(!isValid($password, 10, 128)){
		$signupErrors['password'] = "Password length must be at least 10 characters long.";
	} else if($password != $confirmedPassword){
		$signupErrors['confirmedPassword'] = "Passwords do not match";
    } else if(!isGoodPassword($password)){
		$signupErrors['password'] = "Password must contain at least 1 number, 1 special character, and 1 capital letter.";
	}
	
	
	$usernameExists = $dao->userExists($username);
	if($usernameExists){
		echo "username exists";
		$signupErrors['username'] = "A user with this handle already exists";
	}

	// REDIRECT
	if(empty($signupErrors)){
		$blankPhotoPath = "./logos_icons/blank.jpg";
		echo $blankPhotoPath;
		$dao->addUser($fName, $lName, $username, $birthday, $gender, $acceptingCommissions, $city, $country, $email, $password, $blankPhotoPath);

		// if($dao->validateUser($username, $password)){
			// echo "inside validate user";
			$_SESSION['access_granted'] = true;
			$_SESSION['currentUser'] = $dao->getUserHandle($username);
			session_regenerate_id(true);

			header("Location: feed.php");
		// }else{
			// echo "error validating user";
		// }
	} else {
		$_SESSION['errors'] = $signupErrors;

		$_SESSION['presets'] = array('firstName' => htmlspecialchars($fName),
										'lastName' => htmlspecialchars($lName),
										'birthday' => htmlspecialchars($birthday),
										// 'gender' => htmlspecialchars($gender),
										'email' => htmlspecialchars($email),
										'username' => htmlspecialchars($username),
										// 'acceptingCommissions' => htmlspecialchars($acceptingCommissions),
										'country' => htmlspecialchars($country),
										'city' => htmlspecialchars($city));
		if($gender == "male"){
			$_SESSION['presets']['gender'] = "male";
		}else if($gender == "female"){
			$_SESSION['presets']['gender'] = "female";
		}else{
			$_SESSION['presets']['gender'] = "other";
		}

		if($acceptingCommissions == "Yes"){
			$_SESSION['presets']['acceptingCommissions'] = "Yes";
		}else{
			$_SESSION['presets']['acceptingCommissions'] = "No";
		}

		echo $_SESSION['presets']['gender'];

		header("Location: signup.php");
	}
?>