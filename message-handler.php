<?php
    // initialize the dao w/require once
	require_once("dao.php");
	session_start();
	
    $dao = new Dao();
    
    $sender = $_SESSION['currentUser']['handle'];
    $recipient = htmlspecialchars($_POST['recipient']);
    $message = htmlspecialchars($_POST['message']);
    $sendTime = date("YYYY-mm-dd hh:ii:ss");
    $messageErrors = array();

    function isValid($raw, $minLength, $maxLength){
        $trimmed = trim($raw);
        $isValid = false;
        if(strlen($trimmed) >= $minLength && strlen($trimmed) <= $maxLength){
            $isValid = true;
        }
		return $isValid;
	}

    if(!isValid($message, 1, 400)){
        $messageErrors['message'] = "Message error, invalid length. Message must be between 1 and 400 characters.";
    }

   	// REDIRECT
	if(empty($messageErrors)){
        // send message here or somethin
        header("Location: user.php?".$_SESSION['currentPage']['currentID']);
        unset($_SESSION['currentPage']);
	} else {
		$_SESSION['errors'] = $messageErrors;
		$_SESSION['presets'] = array('message' => htmlspecialchars($message));
        header("Location: user.php?".$_SESSION['currentPage']['currentID']);
    }
?>