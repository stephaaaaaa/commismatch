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

    function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
        return $dst;
    }

	function eighteenOrOlder($birthday, $age){
		$birthdayAsTime = strtotime($birthday);

		if(time()-$birthdayAsTime >= $age * 31536000){
			return true;
		}
		return false;
	}
    
    $handle = $_SESSION['currentUser']['handle'];
    $email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$confirmedPassword = htmlspecialchars($_POST['confirmedPassword']);

	if(!empty($_POST['acceptingCommissions'])){
		$acceptingCommissions = htmlspecialchars($_POST['acceptingCommissions']);
		if(htmlspecialchars($_POST['acceptingCommissions']) == 'Yes'){
			$acceptingCommissions = '1';
		}else{
			$acceptingCommissions = '0';
		}
	}

	$country = htmlspecialchars($_POST['country']);
    $city = htmlspecialchars($_POST['city']);
    $quoteOrBio = htmlspecialchars($_POST['quoteorBio']);
	$valid = true;
	$editErrors = array();

	// EMAIL VALIDATION
    if(!isValid($email, 0, 50)){
		if(filter_var($email_a, FILTER_VALIDATE_EMAIL)){
			$editErrors['email'] = "Invalid email address.";
		}else{
			$editErrors['email'] = "Please enter an email address.";
		}
	}
	// ACCEPTING COMMISSIONS VALIDATION
	// if(!empty($acceptingCommissions)){
	// 	if($acceptingCommissions == ""){
	// 		$editErrors['acceptingCommissions'] = "Specify whether or not you will accept commissions for your art.";
	// 	}
	// }
	// LOCATION VALIDATION
	if(!isValid($country, 0, 25)){
		if(containsNumbers($country)){
			$editErrors['country'] = "Country cannot contain numbers";
		}else{
			$editErrors['country'] = "Please enter a country";
		}
	}
	if(!isValid($city, 0, 25)){
		if(containsNumbers($city)){
			$editErrors['city'] = "City cannot contain numbers";
		}else{
			$editErrors['city'] = "Please enter a city";
		}
    }
    // BIO VALIDATION
    if(!isValid($quoteOrBio, 0, 256)){
        $editErrors['quoteOrBio'] = "Note is over the character limit.";
    }

    if(!empty($_FILES['upload']['name']))
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
            $dao->uploadProfilePic($handle, "$target_dir$file_name");
            $imagePath = "$target_dir$file_name";
            $_SESSION['currentUser']['picture'] = $imagePath;
		}
		else
		{
			echo "nfdhj";
            $editErrors['profilePic'] = "File could not be uploaded.";
        }
    }
	
	if($password != ""){
		// PASSWORD VALIDATION
		if(!isValid($password, 10, 128)){
			$editErrors['password'] = "Password length must be at least 10 characters long.";
		} else if($password != $confirmedPassword){
			$editErrors['confirmedPassword'] = "Passwords do not match";
		} else if(!isGoodPassword($password)){
			$editErrors['password'] = "Password must contain at least 1 number, 1 special character, and 1 capital letter.";
		}
	}

	function prepopulateIfEmpty(){
		global $dao;
		global $handle;
		global $acceptingCommissions;
		global $city;
		global $country;
		global $quoteOrBio;
		global $email;
		global $password;

		if(empty($acceptingCommissions)){
			$valInDB = $dao->getAcceptingStatusAsBool($handle);
			if($valInDB == 1){
				$acceptingCommissions = "Yes";
			}else{
				$acceptingCommissions = "No";
			}
		}
		if(empty($city)){
			$valInDB = $dao->getCity($handle);
			$city = $valInDB;
		}
		if(empty($country)){
			$valInDB = $dao->getCountry($handle);
			$country = $valInDB;
		}
		if(empty($quoteOrBio)){
			$valInDB = $dao->getNote($handle);
			$quoteOrBio = $valInDB;
		}
		if(empty($email)){
			$valInDB = $dao->getEmail($handle);
			$email = $valInDB;
		}
		if(empty($password)){
			$valInDB = $dao->getPassword($handle);
			$password = $valInDB;
		}
	}

	// REDIRECT
	if(empty($editErrors)){
		prepopulateIfEmpty();
		$dao->editUser($handle, $acceptingCommissions, $city, $country, $quoteOrBio, $email, $password);
		header("Location: user.php");
	} else {
		$_SESSION['errors'] = $editErrors;
		$_SESSION['presets'] = array('country' => htmlspecialchars($country),
										'city' => htmlspecialchars($city),
										'note' => htmlspecialchars($quoteOrBio),
										'email' => htmlspecialchars($email)) ;
		header("Location: editInfo.php");
	}
?>