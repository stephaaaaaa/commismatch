<?php
	include("navbar.php");
	require_once("Dao.php");
	$dao = new Dao();
?>

		<div align="left" class="edit_well col-lg-12">
			<link rel="stylesheet" href="./styles/addPost.css">
			<form method="POST" action="addPostHandler.php" enctype="multipart/form-data">
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
					
					<div>
						<?php if(isset($_SESSION['errors']['message'])){ ?>
							<p> 
								<span id="Error" class="error"><?= $_SESSION['errors']['message'] ?></span>
							</p>
						<?php 	} 
							unset($_SESSION['errors']);
						?>
					</div>
				
				</div>
			</form>
		</div>
	</body>
</html>