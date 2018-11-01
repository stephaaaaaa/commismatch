<?php
	$thisPage="HOME";
	include("navbar.php");
	require_once("Dao.php");
	$dao = new Dao();
?>

<!DOCTYPE html>

<!DOCTYPE html>
<!-- Initializer stuff -->
<html lang="en">
	<head>
		<title>Commismatch</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="styles.css">
		<link rel="icon" type="image/png" href="favicon.ico">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<!-- End initializer stuff -->

	<body>
		<form method="POST" action="signup-handler.php">
			<div align="left" class="edit_well col-lg-12">
				<div align="left" class="well col-lg-6">
	
					<!-- Accepting commissions? -->
					<div class="col-sm-8">
						<label class="label">Will you be accepting commissions?</label>
						<div class="rad_btns">
							<div>
								<input type="radio" name="acceptingCommissions" value="Yes" required>Yes
							</div>
							<div>
								<input type="radio" name="acceptingCommissions" value="No">No
							</div>
						</div>
						<?php 
							if(isset($_SESSION['errors']['acceptingCommissions'])) { ?>
							<p id="commissionsError" class="error"><?= $_SESSION['errors']['acceptingCommission'] ?></p>
						<?php } ?>
					</div>
					<!-- Location info -->
					<div class="col-sm-5">
						<label class="label">Country</label>
						<input type="text" name="country" maxlength="25" class="form-control" required>
					</div>
					<div class="col-sm-5">
						<label class="label">City</label>
						<input type="text" name="city" maxlength="25" class="form-control" required>
					</div>
					<div>
						<?php 
							if(isset($_SESSION['errors']['country'])) { ?>
							<p id="countryError" class="error"><?= $_SESSION['errors']['country'] ?></p>
						<?php } ?>
						<?php 
							if(isset($_SESSION['errors']['city'])) { ?>
							<p id="cityError" class="error"><?= $_SESSION['errors']['city'] ?></p>
						<?php } ?>
					</div>
					<!--Password-->
					<div class="col-sm-8">
						<label class="label">Password</label>
						<input type="password" name="password" minLength="10" class="form-control" required>
						<?php 
							if(isset($_SESSION['errors']['password'])) { ?>
							<p id="passwordError" class="error"><?= $_SESSION['errors']['password'] ?></p>
						<?php } ?>
					</div>
					<!--Confirmed Password-->
					<div class="col-lg-8">
						<label class="label">Confirm Password</label>
						<input type="password" name="confirmedPassword" minLength="10" maxlength="128" class="form-control" required>
						<?php 
							if(isset($_SESSION['errors']['confirmedPassword'])) { ?>
							<p id="confirmedPasswordError" class="error"><?= $_SESSION['errors']['confirmedPassword'] ?></p>
						<?php } ?>
					</div>
					<!-- Signup button -->
					<div class="col-sm-12">
						<div class="col-sm-3">
							<input type="submit" class="form-control signup_btn">
						</div>
					</div>

					<?php if(isset($_SESSION['errors']['message'])){ ?>
						<p> <span id="Error" class="error"><?= $_SESSION['errors']['message'] ?></span></p>
					<?php 	} 
						unset($_SESSION['errors']);
					?>

					<!-- <div class="icon col-lg-12">
						<div align="center">
							<img src="logo_signup.png" alt="logo" />
						</div>
					</div> -->
				</div>
		</form>
	</body>
</html>