<?php
session_start();
include('session/SessionExpiry.php');// check for session expiry
if(!isset($_SESSION['uname'])){ //if login session is not set, redirect user to 401 page.
     header('HTTP/1.0 401 Unauthorized');
        header("Location: 401.php");
    exit();
}

?>