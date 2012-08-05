
<?php
include "header.php";

session_start();
session_destroy();
echo 'You have been logged out.'.'<a href="login.php">Click 	</a>'.'here to got to login page'; 
?>
