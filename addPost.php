<?php
	$thisPage="HOME";
	include("navbar.php");
	require_once("Dao.php");
	$dao = new Dao();
?>

<!DOCTYPE html>
<!-- Initializer stuff -->
<html lang="en">
	<head>
		<title>Commismatch</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="./styles/addPost.css">
		<link rel="icon" type="image/png" href="favicon.ico">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<!-- End initializer stuff -->

	<body>
		<form method="POST" action="addPostHandler.php" enctype="multipart/form-data">
			<div align="left" class="edit_well col-lg-12">
                <h2>Upload Post</h2>
                <div align="left" class="well col-lg-6">
					<h4>Please keep image size at 224x224 for best quality!</h4>
                    <!-- File upload link -->
                    <div class="col-sm-8">
                        <input type="file" name="upload">
                    </div>
                    <!-- Caption -->
                    <div class="col-sm-12">
                        <div>
                            <label class="label">Caption</label>
                        </div>
                        <textarea class="form-control noteField" name="caption" rows="4" maxlength="256"></textArea>
                    </div>
                    <?php 
                        if(isset($_SESSION['errors']['quoteOrBio'])) { ?>
                        <p id="commissionsError" class="error"><?= $_SESSION['errors']['acceptingCommission'] ?></p>
					<?php } ?>
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
				</div>
		</form>
	</body>
</html>