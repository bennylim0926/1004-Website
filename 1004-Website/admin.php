<?php
/* [INIT] */
session_start();

// PROTECT THE ADMIN FUNCTIONS!
// E.G. CHECK IF ADMIN IS SIGNED IN
if (!isset($_SESSION['admin'])) {
  die("ERR");
}


?>