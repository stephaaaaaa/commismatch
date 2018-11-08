<?php
	include("navbar.php");
	require_once("Dao.php");
	$dao = new Dao();
?>

<div align="left" class="edit_well col-lg-12">
	<link rel="stylesheet" href="./styles/editInfo.css">
	<form method="POST" action="editInfoHandler.php" enctype="multipart/form-data">
		<h2>Edit Information</h2>
		<div align="left" class="well col-lg-6">
			<div>
				<label class="label">Change profile picture:</label>
			</div>
			<div class="col-sm-8">
				<input type="file" name="upload">
			</div>
			<!-- Accepting commissions? -->
				<div class="col-sm-8">
					<label class="label">Will you be accepting commissions?</label>
					<div class="rad_btns">
						<div>
							<input type="radio" name="acceptingCommissions" value="Yes">Yes
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
					<input type="text" name="country" maxlength="25" class="form-control"
					value="<?=$dao->getCountry($_SESSION['currentUser']['handle'])."";?>"
					<?php 
						if(isset($_SESSION['presets']['country'])){
							echo 'value=' . "'" . $_SESSION['presets']['country'] . "'";
						}?>
					>
				</div>
				<div class="col-sm-5">
					<label class="label">City</label>
					<input type="text" name="city" maxlength="25" class="form-control" value="<?=$dao->getCity($_SESSION['currentUser']['handle'])?>"
					<?php 
						if(isset($_SESSION['presets']['city'])){
							echo 'value=' . "'" . $_SESSION['presets']['city'] . "'";
						}?>
					>
				</div>
				<div>
					<?php 
						if(isset($_SESSION['errors']['country'])) { ?>
						<p id="countryError" class="error"><?= $_SESSION['errors']['country'] ?></p>
					<?php } ?>
					<?php 
						if(isset($_SESSION['errors']['city'])) { ?>
						<p id="cityError" class="error"><?=$_SESSION['errors']['city'] ?></p>
					<?php } ?>
				</div>
				<!-- Note -->
				<div class="col-sm-8">
					<div>
						<label class="label">Note</label>
					</div>
					<textarea class="form-control noteField" name="quoteorBio" rows="4" maxlength="256"><?=$dao->getNote($_SESSION['currentUser']['handle'])?>
						<?php 
						if(isset($_SESSION['presets']['note'])){
							echo $_SESSION['presets']['note'];
						}?>
					</textArea>
				</div>
				<?php 
					if(isset($_SESSION['errors']['quoteOrBio'])) { ?>
					<p id="commissionsError" class="error"><?= $_SESSION['errors']['acceptingCommission'] ?></p>
				<?php } ?>
				<!--Email-->
				<div class="col-sm-8">
					<label class="label">Email</label>
					<input type="email" name="email" maxLength="50" class="form-control" value="<?=$dao->getEmail($_SESSION['currentUser']['handle'])?>"
						<?php 
						if(isset($_SESSION['presets']['email'])){
							echo 'value=' . "'" . $_SESSION['presets']['email'] . "'";
						}?>
					>
					<?php 
						if(isset($_SESSION['errors']['email'])) { ?>
						<p id="emailError" class="error"><?= $_SESSION['errors']['email'] ?></p>
					<?php } ?>
				</div>
				<!--Password-->
				<div class="col-sm-8">
					<label class="label">Password</label>
					<input type="password" name="password" minLength="10" class="form-control">
					<?php 
						if(isset($_SESSION['errors']['password'])) { ?>
						<p id="passwordError" class="error"><?= $_SESSION['errors']['password'] ?></p>
					<?php } ?>
				</div>
				<!--Confirmed Password-->
				<div class="col-lg-8">
					<label class="label">Confirm Password</label>
					<input type="password" name="confirmedPassword" minLength="10" maxlength="128" class="form-control">
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
		</div>
	</form>
</div>

</body>
</html>