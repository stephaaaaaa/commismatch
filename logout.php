<?php
	require_once('sessionFunctions.php');
	session_start();
	logoutUser();
	header("Location: landing.html");
?>