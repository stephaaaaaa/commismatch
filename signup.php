<?php
	// define variables and initialize with empty values
	session_start();

	$nameErr = "";
	$name = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["name"])) {
			$nameErr = "Missing";
		}
		else {
			$name = $_POST["name"];
		}
	}
?>

<!DOCTYPE html>
<!-- Initializer stuff -->
<html lang="en">
	<head>
		<title>Commismatch</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="./styles/signup.css">
		<link rel="icon" type="image/png" href="favicon.ico">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<!-- End initializer stuff -->

	<body>
		<form method="POST" action="signup-handler.php">
			<div align="left" class="signup_well col-lg-12">
				<div align="left" class="well col-lg-6">
					<!--First name-->
					<div class="col-sm-8">
						<label class="label">First Name</label>
						<input type="text" name="firstName" class="form-control" maxLength="25" required
							<?php
								if(isset($_SESSION['presets']['fName'])){
									echo 'value=' . "'" . $_SESSION['presets']['fName']. "'";
								}
							?>
						>
						<?php 
							if(isset($_SESSION['errors']['fName'])) { ?>
							<p id="firstNameError" class="error"><?= $_SESSION['errors']['fName'] ?></p>
						<?php } ?>
					</div>
					<!--Last name*/-->
					<div class="col-sm-8">
						<label class="label">Last Name</label>
						<input type="text" name="lastName" class="form-control" maxLength="25" required
						<?php
								if(isset($_SESSION['presets']['lName'])){
									echo 'value=' . "'" . $_SESSION['presets']['lName']. "'";
								}
						?>
						>
						<?php 
							if(isset($_SESSION['errors']['lName'])) { ?>
							<span id="lastNameError" class="error"><?= $_SESSION['errors']['lName'] ?></span>
						<?php } ?>
					</div>
					<!--Birthday-->
					<div class="col-sm-6">
						<label class="label">Birthday</label>
						<input type="date" name="birthday" class="form-control" required>
						<?php 
							if(isset($_SESSION['errors']['birthday'])) { ?>
							<p id="birthdayError" class="error"><?= $_SESSION['errors']['birthday'] ?></p>
						<?php } ?>
					</div>
					<!--Radio buttons-->
					<div class="col-sm-12">
						<label class="label">I am a:</label>
						<div class="rad_btns">
							<div>
								<input type="radio" name="gender" value="male" required>Male
							</div>
							<div>
								<input type="radio" name="gender" value="female">Female
							</div>
							<div>
								<input type="radio" name="gender" value="other">Other
							</div>
							<?php 
							if(isset($_SESSION['errors']['gender'])) { ?>
							<p id="genderError" class="error"><?= $_SESSION['errors']['gender'] ?></p>
						<?php } ?>
						</div>
					</div>
					<!--Email-->
					<div class="col-sm-8">
						<label class="label">Email</label>
						<input type="email" name="email" maxLength="50" class="form-control" required>
						<?php 
							if(isset($_SESSION['errors']['email'])) { ?>
							<p id="emailError" class="error"><?= $_SESSION['errors']['email'] ?></p>
						<?php } ?>
					</div>
					<!--Handle-->
					<div class="col-sm-8">
						<label class="label">Username/Handle</label>
						<input type="text" name="username" maxLength="25" class="form-control" required>
						<?php 
							if(isset($_SESSION['errors']['username'])) { ?>
							<p id="usernameError" class="error"><?= $_SESSION['errors']['username'] ?></p>
						<?php } ?>
					</div>
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

					<div class="icon col-lg-12">
						<div align="center">
							<a href="./landing.html">
								<img src="./logos_icons/logo_signup.png" alt="logo" />
							</a>
						</div>
					</div>
				</div>
		</form>
	</body>
</html>