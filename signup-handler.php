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
	if(containsNumbers($fName)){
		$signupErrors['fName'] = "Your first name cannot contain numbers.";
	}
	if(containsNumbers($lName)){
		$signupErrors['lName'] = "Your last name cannot contain numbers.";
	}
	// BIRTHDAY VALIDATION
	if(!eighteenOrOlder($birthday, 18)){
		$signupErrors['birthday'] = "You must be 18 or older to sign up.";
	}

	// USERNAME VALIDATION
    if(!isValid($username, 1, 25)){
		$signupErrors['username'] = "Username is required and must be at least 25 characters.";
    }
	// EMAIL VALIDATION
    if(!isValid($email, 1, 50)){
		$signupErrors['email'] = "Invalid email.";
	}
	// PASSWORD VALIDATION
    if(!isValid($password, 10, 128)){
		$signupErrors['password'] = "Password length must be at least 10 characters long.";
	} else if($password != $confirmedPassword){
		$signupErrors['confirmedPassword'] = "Passwords do not match";
    } else if(!isGoodPassword($password)){
		$signupErrors['password'] = "Password must contain at least 1 number, 1 special character, and 1 capital letter.";
	}
	
	
	// $usernameExists = $dao->userExists($userName);
	// if($usernameExists){
	// 	$signupErrors['userName'] = "A user with this username already exists";
	// }
	// $emailExists = $dao->userExistsByEmail($email);
	// if($emailExists){
	// 	$signupErrors['email'] = "A user with this email already exists";
	// }

	// REDIRECT
	if(empty($signupErrors)){
		echo "\nFINAL:" . $fName . $lName . $username . $birthday . $gender . $acceptingCommissions . $city . $country . $email . $password;
		$dao->addUser($fName, $lName, $username, $birthday, $gender, $acceptingCommissions, $city, $country, $email, $password);
		//header("Location: feed.html");
	} else {
		$_SESSION['errors'] = $signupErrors;
		$_SESSION['presets'] = array('username' => htmlspecialchars($username),
										'email' => htmlspecialchars($email)) ;
		foreach($signupErrors as &$value){
			echo $value;
		}
		unset($signupErrors);
		$signupErrors = array();

		//header("Location: signup.php");
	}
?>