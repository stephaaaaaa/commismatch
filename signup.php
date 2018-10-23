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
		<link rel="stylesheet" href="styles.css">
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
					<div class="col-lg-6">
						<label class="label">First Name</label>
						<input type="text" name="firstName" class="form-control" maxLength="25" required
							<?php
								if(isset($_SESSION['presets']['firstName'])){
									echo 'value=' . "'" . $_SESSION['presets']['firstName']. "'";
								}
							?>
						>
						<?php 
							if(isset($_SESSION['errors']['fName'])) { ?>
							<p id="firstNameError" class="error"><?= $_SESSION['errors']['fName'] ?> yo</p>
						<?php } ?>
					</div>
					<!--Last name*/-->
					<div class="col-lg-6">
						<label class="label">Last Name</label>
						<input type="text" name="lastName" class="form-control" maxLength="25" required
						<?php
								if(isset($_SESSION['presets']['lastName'])){
									echo 'value=' . "'" . $_SESSION['presets']['lastName']. "'";
								}
						?>
						>
						<?php 
							if(isset($_SESSION['errors']['lastName'])) { ?>
							<span id="lastNameError" class="error"><?= $_SESSION['errors']['lastName'] ?></span>
						<?php } ?>
					</div>
					<!--Birthday-->
					<div class="col-lg-6">
						<label class="label">Birthday</label>
						<input type="date" name="birthday" class="form-control" required>
					</div>
					<!--Radio buttons-->
					<div class="col-lg-12">
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
						</div>
					</div>
					<!--Email-->
					<div class="col-lg-8">
						<label class="label">Email</label>
						<input type="email" name="email" maxLength="50" class="form-control" required>
					</div>
					<!--Handle-->
					<div class="col-lg-8">
						<label class="label">Username/Handle</label>
						<input type="text" name="username" maxLength="25" class="form-control" required>
					</div>
					<!--Password-->
					<div class="col-lg-8">
						<label class="label">Password</label>
						<input type="password" name="password" minLength="10" class="form-control" required>
					</div>
					<!--Confirmed Password-->
					<div class="col-lg-8">
						<label class="label">Confirm Password</label>
						<input type="password" name="confirmedPassword" minLength="10" maxlength="128" class="form-control" required>
					</div>

					<div class="col-sm-12">
						<div class="col-sm-3">
							<input type="submit" class="form-control signup_btn">
						</div>
					</div>

					<div class="icon col-lg-12">
						<div align="center">
							<img src="logo_signup.png" alt="logo" />
						</div>
					</div>
				</div>
		</form>
	</body>
</html>