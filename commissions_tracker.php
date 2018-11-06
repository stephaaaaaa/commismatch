<?php
	$thisPage="HOME";
	include("navbar.php");
?>

<!DOCTYPE html>

<!-- Initializer stuff -->
<html lang="en">
<head>
  <title>Commismatch: Commissions Tracker</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./styles/users_commissions.css">
  <link rel="icon"
      type="image/png"
      href="favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<!-- End initializer stuff -->

<body>

	<div class="col-lg-12" id="body">
			<div class="col-lg-12">
				<div align="center" id="user" class="col-lg-3">
					<h1>Commissions Tracker</h1>
					<!-- Number of commissions in progress -->
					<h4>2 commission in progress</h4>
					<!-- Number of past commissions -->
					<h4>0 past commissions</h4>
				</div>
				<div id="user_content" class="col-lg-9">
					<div id="commissions">
						<h4>Current Commissions</h4>
							<!-- 130x130, 90px -->
							<div id="current">
								<img id="image" src="art1.png" alt="firstCommission">
								<div id="description">
									<h5>"Statues Part 1", Painting</h5>
									<h6>By @hhinrichsart</h6>
									<h6>Delivery date: 10-12-2018</h6>
								</div>
								<img id="image" src="art3.png" alt="secondCommission">
								<div id="description">
									<h5>"Witch", Shirt</h5>
									<h6>By @jacquelindeleon</h6>
									<h6>Delivery date: 10-03-2018</h6>
								</div>
							</div>
						<h4>Past Commissions</h4>
							<!-- If no past commissions, blank -->
							<div id="commissions_post">
								<p>No past commissions!</p>
							</div>
					</div>
				</div>
			</div>
	</div>
		<div class="footer">
			<h5>Stephanie Labastida. 2018</h5>
		</div>
</body>