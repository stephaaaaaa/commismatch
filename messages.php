<!DOCTYPE html>
<?php
	$thisPage="MY_MESSAGES";
	include("navbar.php");

	require_once("dao.php");
	$dao = new Dao();

	$userID = $dao->getIDFromHandle($_SESSION['currentUser']['handle']);
	$numMessages = $dao->getMessageCount($userID);
?>

<!-- Initializer stuff -->
<html lang="en">
<head>
  <title>Commismatch: Messages</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./styles/messages.css">
  <link rel="icon"
      type="image/png"
      href="favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<!-- End initializer stuff -->

<body>

	<div class="col-lg-12">

			<div class="col-lg-12" id="body">
				<div align="center" id="user" class="col-lg-3">					
					<h1>@<?=$_SESSION['currentUser']['handle']?>'s Messages</h1>
					<!-- Number of total -->
					<h4><?=$numMessages?> Total Messages</h4>
				</div>
				<div id="user_content" class="col-lg-9">
					<div id="commissions">
							<!-- 130x130, 90px -->
							<div id="commissions_post">
								<table>
									<tr>
										<th>Message Content</th>
										<th>Sent By</th>
										<th>Timestamp</th>
									</tr>
									<?php
										for(){
											
										}
									?>
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