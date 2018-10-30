<?php
    function isAccessGranted(){
        if(isset($_SESSION['access_granted']) && ($_SESSION['access_granted'] === true)){
            return true;
        } else {
            return false;
        }
    }
    function logoutUser()
    {
        session_unset();
        session_regenerate_id(true);
        session_destroy();
        header("Location: login.php");
    }
?>