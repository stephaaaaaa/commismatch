<?php
	$thisPage="HOME";
	include("navbar.php");
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
						<h2>Popular Artists</h2>
						
						<h2>Popular Commissions</h2>

						<h2>Featured Artists</h2>
						<h2>In Your Area</h2>
						
						<h2>Following</h2>
					</div>
					<div id="headers2">
						<h2>Feed</h2>
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