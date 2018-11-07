<?php
	include("navbar.php");
	
	// if($_SESSION['currentUser'] == ""){
	// 	echo "</br></br></br></br></br></br>".$_SESSION['currentUser'];
	// 	header("Location: landing.html");
	// }

	$thisPage="HOME";
	require_once("Dao.php");
	$dao = new Dao();
?>

<!DOCTYPE html>

<!-- Bootstrap and other scripts -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./styles/feed.css"> 
  <link rel="icon" 
      type="image/png" 
      href="favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Initializer stuff -->
<html lang="en">
<head>
  <title>Commismatch: Feed</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<!-- End initializer stuff -->

<body>
	<?php var_dump($_SESSION);?>

	<div class="col-lg-12">
		<div id="body" class="welcome col-lg-12">
			<h1>Welcome, <?= $_SESSION['currentUser']['handle']?>!</h1>
			<!-- Use actual followers + following -->
			<h5></h5>

			<h2>Popular Artists</h2>
			
			<h2>Popular Commissions</h2>

			<h2>Featured Artists</h2>
			
			<h2>In Your Area</h2>
			
			<h2>Following</h2>

			<h2>Feed</h2>
		</div>
	</div>
</body>