<?php
session_start();
if(!isset($_SESSION['current_user'])){
	die('You must be logged in to see this page.'.'<br><br><h3><a href="login.php">Login</a> now</h3>');
}
?>
