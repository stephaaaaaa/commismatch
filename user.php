


<?php
    include("navbar.php");
    require_once("dao.php");
    $dao = new Dao();
?>

<div class="col-lg-12">
<link rel="stylesheet" href="./styles/user.css"> 
			<div class="col-lg-12">
				<div align="center" id="user" style="position:fixed;" class="col-sm-3">
					<!-- User profile image, sized to 240x254, with 96 px -->
					<img src=<?=$dao->getProfilePic($_SESSION['currentUser']['handle'])?> id="profile_pic" alt="Avatar">
					<!-- User handle -->
					<h3>@<?= $_SESSION['currentUser']['handle']?></h3>
					<!-- Location -->
					<h5><?=$dao->getUserCity($_SESSION['currentUser']['handle'])?>, <?=$dao->getUserCountry($_SESSION['currentUser']['handle'])?></h5>
					<!-- Accepting Status -->
					<h5><?=$dao->getAcceptingStatus($_SESSION['currentUser']['handle'])?></h5>
				</div>
				<div id="user_content" class="col-lg-9">
					<h3>A note from the artist:</h3>
					<h5>"<?=$dao->getArtistQuote($_SESSION['currentUser']['handle'])?>"</h5>
					<!-- Message Icon -->
					<a href="./messages.php" class="button" id="icon">
						<img src="./logos_icons/letter.png">
					</a>
					<a	href="./editInfo.php" class="button" id="icon">
							<img src="./logos_icons/editIcon.png">
					</a>
					<a	href="./addPost.php" class="button" id="icon">
							<img src="./logos_icons/plus.png">
					</a>

					<div id="posts">
						<h4>Posts</h4>
						<div id="photos">
							<!-- 130x130, 90px -->
							<div id="photo">
								<?=$dao->retrievePhotos($_SESSION['currentUser']['handle']);?>
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