<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    require_once('sessionFunctions.php');
?>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <link rel="icon"
      type="image/png"
      href="favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div id="banner" class="col-lg-12">
	<a href="./feed.php" class="button">Home</a>
	<a href="./commissions_tracker.php" class="button">Commissions Tracker</a>
	<a href="./users_commissions.php" class="button">My Commissions</a>
	<a href="./messages.php" class="button">Messages</a>
	<span id="profile">
		<a href="./user.php" class="button">My Profile</a>
		<img src="sample_profile_sm.png" alt="logo"/> <!--User's profile pic-->
        <a href="./logout.php" class="button">Log out</a>
	</span>
</div>