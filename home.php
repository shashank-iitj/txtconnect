<?php 
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	echo "<div class='page'>";
include "session.php";
	echo "<div class='header'>";
include "header.php";
include "upper.php";
	echo "</div>";


	echo '<br><br>You are logged in as '.'<b>'.$_SESSION['current_user'].'</b> <br><br><br>';
?>
<br>
	<div class='tiles'>
		<ul>
			<li><a href='join_group.php'>Join a Group</a></li>
			<li><a href='groups.php'>My groups</a></li>
<?php
	if(isset($_SESSION['master']))
			echo "<li><a href='new_group.php'>Create New Group</a></li>";
	echo "</ul>";
	echo "</div>";
	echo "</div>";
?>

