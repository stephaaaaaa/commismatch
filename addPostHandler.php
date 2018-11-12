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
	
	function isValidType($filetype){
		if($filetype == "image/jpg"){
			return true;
		}else if($filetype == "image/jpeg"){
			return true;
		}else if($filetype == "image/png"){
			return true;
		}
		return false;
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

		$_FILES['upload']['name'] = strtolower($_FILES['upload']['name']);
		// file name, type, size, temporary name
		$file_name = $_FILES['upload']['name'];
		echo "</br>File name: ".$file_name."</br>";
		$file_type = $_FILES['upload']['type'];
		echo "File type: ".$file_type."</br>";
		$file_tmp_name = $_FILES['upload']['tmp_name'];
		echo "Tmp name: ".$file_tmp_name."</br>";
		$file_size = $_FILES['upload']['size'];
		echo "File size: ".$file_size."</br>";

		//phpinfo();

		if(empty($_FILES['upload']['size'])){
			$postErrors['post'] = "The file is not within the appropriate size range. Too big.";
		}else{
			if(empty($_FILES['upload']['tmp_name'])){
				echo $_FILES['upload']['tmp_name'];
				$postErrors['post'] = "File location could not be found.";
			}

			if(isValidType($_FILES['upload']['type'])){
				$target_dir = $_SERVER['DOCUMENT_ROOT']."//uploads/";
				//$target_dir = $_SERVER['DOCUMENT_ROOT']."https://commismatch.herokuapp.com/uploads/";

				// uploding file
				if(move_uploaded_file($file_tmp_name, $target_dir.$file_name))
				{
					$dao->uploadPost($_SESSION['currentUser']['handle'], "$target_dir$file_name", $caption);
					move_uploaded_file($_FILES['upload']['tmp_name'], "$target_dir$file_name");
				}
				else
				{
					$postErrors['post'] = "File could not be uploaded.";
				}
			}else{
				$postErrors['post'] = "File is of invalid type. Please upload files with extensions '.jpeg', '.jpg', or '.png'.";
			}
		}
		print_r($_FILES['upload']['error']);

    }

	// REDIRECT
	if(empty($postErrors)){
		header("Location: user.php");
	} else {
		$_SESSION['errors'] = $postErrors;
		//print_r($_SESSION['errors']);
		print_r($_SESSION['errors']);

		//header("Location: addPost.php");
	}
?>