<?php
	$thisPage="HOME";
	include("navbar.php");
?>

<!DOCTYPE html>

<!-- Initializer stuff -->
<html lang="en">
<head>
  <title>Commismatch: User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css"> 
  <link rel="icon" 
      type="image/png" 
      href="favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<!-- End initializer stuff -->

<body>

	<div class="col-lg-12">
			<div class="col-lg-12">
				<div align="center" id="user" class="col-sm-3">
					<!-- User profile image, sized to 240x254, with 96 px -->
					<img src="sample_profile.png" alt="Avatar">
					<!-- User handle -->
					<h3>@yumiii_03</h3>
					<!-- Location -->
					<h5>Seoul, South Korea</h5>
					<!-- Message Icon -->
						<a href="./messages.php" class="button" style="z-index:100; position:relative;">
							<img src="letter.png">
						</a>
				</div>
				<div id="user_content" class="col-lg-9">
					<h3>"Artist's quote"</h3>
					<h5>Message regarding whether the user is accepting commissions, and if so, what kind</h5>
					<!-- Actual follow count goes here -->
					<h6>0 followers, 0 following</h6>
					<div id="posts">
						<h4>Posts</h4>
						<div id="photos">
							<!-- 130x130, 90px -->
							<div id="photo">
								<img src="yumis_cells.png" alt="firstPost">
								<img src="yumis_cells.png" alt="firstPost">
								<img src="yumis_cells.png" alt="firstPost">
								<img src="yumis_cells.png" alt="firstPost">
								<img src="yumis_cells.png" alt="firstPost">
								<img src="yumis_cells.png" alt="firstPost">
								<img src="yumis_cells.png" alt="firstPost">
								<img src="yumis_cells.png" alt="firstPost">
								<img src="yumis_cells.png" alt="firstPost">
								<img src="yumis_cells.png" alt="firstPost">
							</div>
												
						</div>
					</div>
				</div>
			</div>
	</div>
		<div class="footer">
			<h5>Stephanie Labastida. 2018</h5>
		</div>
</body>
