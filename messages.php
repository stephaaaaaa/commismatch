<!DOCTYPE html>
<?php
	$thisPage="MY_MESSAGES";
	include("navbar.php");
?>

<!-- Initializer stuff -->
<html lang="en">
<head>
  <title>Commismatch: Messages</title>
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
				<div align="center" id="user" class="col-lg-3">					
					<h1>Your Messages</h1>
					<!-- Number of unread -->
					<h4>1 Unread</h4>
					<!-- Number of total -->
					<h4>0 Total</h4>
				</div>
				<div id="user_content" class="col-lg-9">
					<div id="commissions">
						<h4>Unread</h4>
							<!-- 130x130, 90px -->
							<div id="commissions_post">
								<table>
									<tr>
										<th>Sent date/time</th>
										<th>Subject</th>
										<th>Sent by</th>
									</tr>
								</table>
							</div>
							</div>
					<div id="commissions">
						<h4>Read</h4>
						<!-- 130x130, 90px -->
						<div id="commissions_post">
							<table>
								<tr>
									<th>Sent date/time</th>
									<th>Subject</th>
									<th>Sent by</th>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
	</div>
		<div class="footer">
			<h5>Stephanie Labastida. 2018</h5>
		</div>
</body>