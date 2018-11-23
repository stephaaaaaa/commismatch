<?php
    include("navbar.php");
    require_once("dao.php");
	$dao = new Dao();
	
	$url_string = $_SERVER['REQUEST_URI'];
	$url_pieces = explode("?", $url_string);
	$urlID = $url_pieces[1];
	$userID = $dao->getUserIDFromHandle($_SESSION['currentUser']['handle']);
?>

<div class="col-lg-12">
<link rel="stylesheet" href="./styles/user.css"> 
			<div class="col-lg-12">
				<div align="center" id="user" style="position:fixed;" class="col-sm-3">
					<!-- User profile image, sized to 240x254, with 96 px -->
					<img 
						src=
						<?php
							if($userID == $urlID){
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
							if($userID == $urlID){
								echo $_SESSION['currentUser']['handle'];	
							}else{
								echo $dao->getHandleFromID($urlID);
							}
						?>
					</h3>
					<!-- Location -->
					<h5>
						<?php
							if($userID == $urlID){
								echo $dao->getUserCity($_SESSION['currentUser']['handle']);
							}else{
								echo $dao->getUserCityByID($urlID);
							}
						?>, 
						<?php
							if($userID == $urlID){
								echo $dao->getUserCountry($_SESSION['currentUser']['handle']);
							}else{
								echo $dao->getUserCountryByID($urlID);
							}
						?>
					</h5>
					<!-- Accepting Status -->
					<h5>
						<?php
							if($userID == $urlID){
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
							if($userID == $urlID){
								echo "\"".$dao->getArtistQuote($_SESSION['currentUser']['handle'])."\"";
							}else{
								echo "\"".$dao->getArtistQuoteByID($urlID)."\"";
							}
						?>
						
					</h5>
					<?php // message icon
						if($userID == $urlID){
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
											<label for="recipient-name" class="col-form-label">Recipient:</label>
											<input type="text" readonly="true" class="form-control" id="recipient-name">
										</div>
										<div class="form-group">
											<label for="message-text" class="col-form-label">Message:</label>
											<textarea class="form-control" id="message-text"></textarea>
										</div>
										</form>
									</div>
									<div class="modal-footer">
										<input type="submit" value="Send Message" class="form-control col-sm-3">
										<!-- <button type="button" class="btn">Send message</button> -->
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
									if($userID == $urlID){
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
</script>