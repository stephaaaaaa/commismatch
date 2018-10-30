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
  <link rel="icon" 
      type="image/png" 
      href="favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

	<form action="login-handler.php" method="POST">
		<body>
			<div align="center" class="login_signup_well col-lg-6">
				<div align="left" class="well col-lg-6">
					<div class="col-lg-12">
						<label class="label">Username</label>
						<input type="text" name="loginUsername" class="form-control"
						>
						<?php
							if(isset($_SESSION['errors']['loginUsername'])) { ?>
								<p id="userNameError" minlength="1" class="error"><?= $_SESSION['errors']['loginUsername'] ?></p>
							<?php } 
						?>
					</div>
					<div class="col-lg-12">
						<label class="label">Password</label>
						<input type="password" name="loginPassword" class="form-control"
						>
						<?php
							if(isset($_SESSION['errors']['loginPassword'])) { ?>
								<p id="signInPasswordError" minlength="1" class="error"><?= $_SESSION['errors']['loginPassword'] ?></p>
							<?php } 
						?>
					</div>
					<!-- Unset errors -->
					<?php if(isset($_SESSION['errors']['message'])){ ?>
						<p> <span id="Error" class="error"><?= $_SESSION['errors']['message'] ?></span></p>
					<?php 	} 
						unset($_SESSION['errors']);
					?>

					<!-- Submit button -->
					<div align="center" class="col-sm-6">
						<button 
							align="center" 
							class="form-control login_signup_btn">
							Sign In
						</button>
					</div>
				</div>
			</div>
		</body>
	</form>
</html>