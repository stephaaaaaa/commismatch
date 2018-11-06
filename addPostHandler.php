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
    
    $caption = htmlspecialchars($_POST['caption']);
	$valid = true;
	$postErrors = array();

    // CAPTION VALIDATION
    if(!isValid($caption, 0, 256)){
        $postErrors['caption'] = "Caption is over the character limit.";
    }

    if(isset($_FILES['upload']))
	{
        echo "uploading files   ";

		// file name, type, size, temporary name
		$file_name = $_FILES['upload']['name'];
		$file_type = $_FILES['upload']['type'];
		$file_tmp_name = $_FILES['upload']['tmp_name'];
		$file_size = $_FILES['upload']['size'];
 
		// target directory
		$target_dir = "uploads/";
	
		// uploding file
        if(move_uploaded_file($file_tmp_name,$target_dir.$file_name))
		{
            $dao->uploadPost($_SESSION['currentUser']['handle'], "$target_dir$file_name", $caption);
		}
		else
		{
            $postErrors['post'] = "File could not be uploaded.";
        }
    }

	// REDIRECT
	if(empty($postErrors)){
		header("Location: user.php");
	} else {
		$_SESSION['errors'] = $postErrors;
		$_SESSION['presets'] = array('username' => htmlspecialchars($username),
										'email' => htmlspecialchars($email)) ;

		header("Location: addPost.php");
	}
?>