<?php
	$thisPage="HOME";
	include("navbar.php");
	require_once("dao.php");
    $dao = new Dao();
?>
<!DOCTYPE html>

<!-- Initializer stuff -->
<html lang="en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="./styles/feed.css"> 
	<link rel="icon" 
		type="image/png" 
		href="favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<!-- End initializer stuff -->

<body>
<div class="col-lg-12">
			<div id="body" class="welcome col-lg-12">
				<h1>Welcome, <?= $_SESSION['currentUser']['handle']?>!</h1>
				<!-- Use actual followers + following -->
				<h5></h5>
					<div id="headers">
						<h2>Artists in your area</h2>
						<div id="locals">
							<?php
								$dao->getLocalUsers($_SESSION['currentUser']['handle']);
							?>
						</div>
						<h2>Artists in your country</h2>
						<div id="national">
							<?php
								$dao->getSameCountryUsers($_SESSION['currentUser']['handle']);
							?>
						</div>
						<h2>International artists</h2>
						<div id="international">
							<?php
								$dao->getForeignUsers($_SESSION['currentUser']['handle']);
							?>
						</div>
			</div>
		</div>
</body>

<script>
	console.log("not in a function yet");
	$(window).load("load", function(){
		console.log("In function");
		$(this).find("#body").fadeTo(200, 1);
		$("#body").fadeIn(1000);
	});

	$(window).scroll(function(){
		$(this).find("#body").fadeTo(200, 1);
		$(this).find("#body").fadeIn(9000);
	});
</script>