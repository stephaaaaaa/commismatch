<?php
	// initialize the dao w/require once
	require_once("dao.php");
    session_start();

	$dao = new Dao();

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
	if(!$dao->userExists($loginUsername)){ // does username exist in db?
		$loginErrors['loginPassword'] = "Invalid username or password"; 
	}

    // PASSWORD VALIDATION
    if(strlen($loginPassword) < 1){
        $loginErrors['loginPassword'] = "Please type a password"; 
	}
	if($dao->passwordCorrect($loginUsername, $loginPassword) == false){ // is password correct for user?
		$loginErrors['loginPassword'] = "Invalid username or password";
	}

	// REDIRECT
	if(empty($loginErrors)){
		header("Location: feed.html");
	} else {
		$_SESSION['errors'] = $loginErrors;
		$_SESSION['presets'] = array('loginUsername' => htmlspecialchars($loginUsername));
		foreach($loginErrors as &$value){
			echo $value;
        }
		header("Location: login.php");
	}
?>