<?php
session_start();
if(!isset($_SESSION['master'])){
	die('You must be master user to see this page.'.'<br><br>');
}
?>
