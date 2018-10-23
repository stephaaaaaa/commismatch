<?php
    // initialize the dao w/require once

    session_start();

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
	
	$fName = htmlspecialchars($_POST['firstName']);
	$lName = htmlspecialchars($_POST['lastName']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $gender = $_POST['gender'];
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
	$confirmedPassword = htmlspecialchars($_POST['confirmedPassword']);
	$valid = true;
	$errors = array();

	//FIRST AND LAST NAME VALIDATION
	if(containsNumbers($fName)){
		$errors['fName'] = "Your first name cannot contain numbers.";
	}
	if(containsNumbers($lName)){
		$errors['lName'] = "Your last name cannot contain numbers.";
	}
	// USERNAME VALIDATION
    if(!isValid($username, 1, 25)){
		$errors['username'] = "Username is required and must be at least 25 characters.";
    }
	// // EMAIL VALIDATION
    if(!isValid($email, 1, 50)){
		$errors['email'] = "Email is required and must be less than 50 characters.";
	}
	// // PASSWORD VALIDATION
    if(!isValid($password, 10, 128)){
		$errors['password'] = "Password length must be at least 10 characters long.";
	} else if($password != $confirmedPassword){
		$errors['confirmedPassword'] = "Passwords do not match";
    } else if(!isGoodPassword($password)){
		$errors['password'] = "Password must contain at least 1 number, 1 special character, and 1 capital letter.";
	}
    
	// $usernameExists = $dao->userExists($userName);
	// if($usernameExists){
	// 	$errors['userName'] = "A user with this username already exists";
	// }
	// $emailExists = $dao->userExistsByEmail($email);
	// if($emailExists){
	// 	$errors['email'] = "A user with this email already exists";
	// }

	// REDIRECT
	if(empty($errors)){
		// $dao->addUser($email, $password, $userName);
		header("Location: feed.html");
	} else {
		$_SESSION['errors'] = $errors;
		$_SESSION['presets'] = array('username' => htmlspecialchars($username),
										'email' => htmlspecialchars($email)) ;
		foreach($errors as &$value){
			echo $value;
		}
		header("Location: signup.php");
	}
?>