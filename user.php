<?php
    include("navbar.php");
    require_once("dao.php");
	$dao = new Dao();
	
	$userID = $dao->getUserIDFromHandle($_SESSION['currentUser']['handle']);
	$url_string = $_SERVER['REQUEST_URI'];
	$nativeUser = true; // you
	if(strpos($url_string, '?')){
		// check if it has the '?' or not
		$nativeUser = false;
		$url_pieces = explode("?", $url_string);
		$urlID = $url_pieces[1];
		if($userID == $urlID){
			$nativeUser = true;
		}
		$_SESSION['currentPage']['currentID'] = $urlID;
	}
?>

<div class="col-lg-12">
<link rel="stylesheet" href="./styles/user.css"> 
			<div class="col-lg-12">
				<div align="center" id="user" style="position:fixed;" class="col-sm-3">
					<!-- User profile image, sized to 240x254, with 96 px -->
					<img 
						src=
						<?php
							if($nativeUser){
								echo $dao->getProfilePic($_SESSION['currentUser']['handle']);
							}else{
								echo $dao->getProfilePicFromID($urlID);
							}
						?> 
						id="profile_pic" alt="Avatar"
					>
					<!-- User handle -->
					<h3>
						@<?php 
							if($nativeUser){
								echo $_SESSION['currentUser']['handle'];	
							}else{
								echo $dao->getHandleFromID($urlID);
							}
						?>
					</h3>
					<!-- Location -->
					<h5>
						<?php
							if($nativeUser){
								echo $dao->getUserCity($_SESSION['currentUser']['handle']);
							}else{
								echo $dao->getUserCityByID($urlID);
							}
						?>, 
						<?php
							if($nativeUser){
								echo $dao->getUserCountry($_SESSION['currentUser']['handle']);
							}else{
								echo $dao->getUserCountryByID($urlID);
							}
						?>
					</h5>
					<!-- Accepting Status -->
					<h5>
						<?php
							if($nativeUser){
								echo $dao->getAcceptingStatus($_SESSION['currentUser']['handle']);
							}else{
								echo $dao->getAcceptingStatusFromID($urlID);
							}
						?>
					</h5>
				</div>
				<div id="user_content" class="col-lg-9">
					<h3>A note from the artist:</h3>
					<h5>
						<?php
							if($nativeUser){
								echo "\"".$dao->getArtistQuote($_SESSION['currentUser']['handle'])."\"";
							}else{
								echo "\"".$dao->getArtistQuoteByID($urlID)."\"";
							}
						?>
						
					</h5>
					<?php // message icon
						if($nativeUser){
							echo "<a href=\"./messages.php\" class=\"button\" id=\"icon\">
							<img src=\"./logos_icons/letter.png\"> </a>"; // check your messages

							echo "<a href=\"./editInfo.php\" class=\"button\" id=\"icon\">
							<img src=\"./logos_icons/editIcon.png\"> </a>"; // edit your page

							echo "<a href=\"./addPost.php\" class=\"button\" id=\"icon\">
							<img src=\"./logos_icons/plus.png\"> </a>"; // add a post
						}else{
							$rightUser = $dao->getHandleFromID($urlID);
							echo "<button type=\"button\" data-toggle=\"modal\" data-target=\"#Modal\" data-whatever=\"@$rightUser\">
							<img src=\"./logos_icons/letter.png\"></button>";
						}
					?>
					<!-- Modal -->
					<form method="POST" action="message-handler.php">
						<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="ModalLabel">New message</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form>
										<div class="form-group">
											<div>
												<h5>Sending from: <?=$dao->getHandleFromID($userID)?>. Please make your message between 1 and 400 characters.</h5>
											</div>
											<label for="recipient-name" class="col-form-label">Recipient:</label>
											<input name="recipient" type="text" readonly="true" class="form-control" id="recipient-name">
										</div>
										<div class="form-group">
											<label for="message-text" class="col-form-label">Message:</label>
											<textarea minLength=1 maxLength=400 name="message" class="form-control" id="message-text">
												<?php
													if(isset($_SESSION['presets']['message'])){
														echo $_SESSION['presets']['message'];
													}
												?>
											</textarea>
										</div>
										</form>
									</div>
									<div class="modal-footer">
										<input id="submitBtn" type="submit" value="Send Message" class="form-control col-sm-3">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									<div> <!--Error div-->
										<?php
											if(isset($_SESSION['errors']['message'])){?>
												<p id="error" class="error"><?=$_SESSION['errors']['message']?></p>
											<?php
											} 
											unset($_SESSION['errors']);
											?>
									</div>
								</div>
							</div>
						</div>
					</form>
					<!-- End Modal -->

					<div id="posts">
						<h4>Posts</h4>
						<div id="photos">
							<!-- 130x130, 90px -->
							<div id="photo">
								<?php
									if($nativeUser){
										echo $dao->retrievePhotos($_SESSION['currentUser']['handle']);
									}else{
										echo $dao->retrievePhotosByID($urlID);
									}
								?>
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
</html>

<script>
    $('#Modal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var recipient = button.data('whatever') // Extract info from data-* attributes
		var modal = $(this)
		modal.find('.modal-title').text('New message to ' + recipient)
		modal.find('.modal-body input').val(recipient)
		});

	$('#submitBtn').click(function(){
		if(!$.trim($("#message-text").val())) {
    		// textarea is empty or contains only white-space
			alert("Your message will not send. It must be between 1 and 400 characters.");
		}
		if(!$.trim($("#message-text")).length > 400){
			alert("Your message will not send. It must be between 1 and 400 characters.");
		}
	});

	$('#message-text').on('keyup', function(event) {
   		var len = $('#message-text').val().length;
   		if (len >= 400) {
     		$(this).val($(this).val().substring(0, len-1));
		}
	});
</script>