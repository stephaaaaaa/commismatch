<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    require_once("dao.php");
    $dao = new Dao();
    require_once('sessionFunctions.php');

    // if(!isset($_SESSION['currentUser']['handle'])){
    //     header("Location: landing.html");
    // }
?>
<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/navbar.css">
    <link rel="icon"
        type="image/png"
        href="favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div id="banner" class="col-lg-12">
            <a href="./feed.php" class="button">Feed</a>
            <!-- <a href="./commissions_tracker.php" class="button">Commissions Tracker</a>
            <a href="./users_commissions.php" class="button">My Commissions</a> -->
            <a href="./messages.php" class="button">Messages</a>
            <span id="profile">
                <?php
                    $url_string = "./user.php?".$dao->getUserIDFromHandle($_SESSION['currentUser']['handle']);
                    //echo $url_string;
                ?>
                <a href=<?=$url_string?> class="button"><?=$_SESSION['currentUser']['handle']?></a>
                <img src="./logos_icons/home.png" alt="logo"/>
                <a href="./logout.php" class="button">Log out</a>
            </span>
        </div>
