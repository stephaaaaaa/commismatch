<?php
	$thisPage="HOME";
	include("navbar.php");
?>
<!DOCTYPE html>

<!-- Initializer stuff -->
<html lang="en">
<head>
  <title>Commismatch: Your Commissions</title>
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
					<h1>Your Commissions</h1>
					<!-- Number of you need to do -->
					<h4>1 current commission</h4>
					<!-- Number of past commissions -->
					<h4>1 past commissions</h4>
				</div>
				<div id="user_content" class="col-lg-9">
					<div id="commissions">
						<h4>Incomplete Commissions</h4>
							<!-- 130x130, 90px -->
							<div id="commissions_post">
								<img id="image" src="yumis_cells.png" alt="inProg1">
								<div id="description">
									<h5>"Yumi's Cells", Print</h5>
									<h6>Commissioned by @hhinrichsart</h6>
									<h6>Delivery Date: 10-11-2018</h6>
								</div>
							</div>
						<h4>Completed Commissions</h4>
							<!-- If no past commissions, blank -->
							<div id="commissions_post">
								<img id="image" src="yumis_cells.png" alt="completed1">
								<div id="description">
									<h5>"Yumi's Cells", Print</h5>
									<h6>Commissioned by @picolo</h6>
									<h6>Delivered: 09-21-2018</h6>
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