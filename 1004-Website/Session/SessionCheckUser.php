<?php
session_start();
include('../Session/SessionExpiry.php');// check for session expiry
if(!isset($_SESSION['uname'])){ //if login session is not set, redirect user to 401 page.
    header("Location: 401.php");
    exit();
}

?>