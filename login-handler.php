<?php
    // initialize the dao w/require once

    session_start();

	function isGoodPassword($password){
		if(preg_match('[\W]', $password) && preg_match('/\\d/', $password) && preg_match("/([A-Z])/", $password)){
			return true;
		}
		return false;
	}
	
    $loginUsername = htmlspecialchars($_POST['loginUsername']);
    $loginPassword = htmlspecialchars($_POST['loginPassword']);
	$loginErrors = array();

    // USERNAME VALIDATION
    if(strlen($loginUsername) < 1){
        $loginErrors['loginUsername'] = "Please type a username";
    }
    // do stuff for if the username exists in the database

    // PASSWORD VALIDATION
    if(strlen($loginPassword) < 1){
        $loginErrors['loginPassword'] = "Please type a password"; 
    }
    // do stuff for if the password associated with the user matches
	
	
	// $usernameExists = $dao->userExists($userName);
	// if($usernameExists){
	// 	$loginErrors['userName'] = "A user with this username already exists";
	// }
	// $emailExists = $dao->userExistsByEmail($email);
	// if($emailExists){
	// 	$loginErrors['email'] = "A user with this email already exists";
	// }

	// REDIRECT
	if(empty($loginErrors)){
		// $dao->addUser($email, $loginPassword, $userName);
		header("Location: feed.html");
	} else {
		$_SESSION['errors'] = $loginErrors;
		$_SESSION['presets'] = array('username' => htmlspecialchars(loginUsername),
										'email' => htmlspecialchars($email)) ;
		foreach($loginErrors as &$value){
			echo $value;
        }
        // is this bad for getting rid of the errors??
        unset($loginErrors);
        $loginErrors = array();
		header("Location: login.php");
	}
?>