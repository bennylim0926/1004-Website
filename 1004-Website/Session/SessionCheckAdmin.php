<?php
session_start();
include('session/SessionExpiry.php');// check for session expiry
//  CHECK IF ADMIN IS SIGNED IN
if (($_SESSION['admin']) == false || !isset($_SESSION['uname']))
{ 
    printf(($_SESSION['admin']));
    header("Location: 401.php");
    exit();
    die("Unauthorized");//terminate script
}

?>