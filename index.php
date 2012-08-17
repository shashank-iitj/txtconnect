<?php
session_start();
if(!isset($_SESSION['current_user'])){
	//die('You must be logged in to see this page.'.'<br><br><h3><a href="login.php">Login</a> now</h3>');
	include "default_home.php";
}
else{
 
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	echo "<div class='page'>";
	echo "<div class='header'>";
include "header.php";
include "upper.php";
	echo "</div>";
	echo '<div class="content"><br><br>';


	echo '<br><br>You are logged in as '.'<b>'.$_SESSION['current_user'].'</b> <br><br>';
?>
<br>
	<div class='tiles'>
		<a href='join_group.php'>
			<div class="tile_head">Join a Group</div>
			<div class="description">Start following a group to start receiveing updates about that group</div>
		</a>
		<a href='groups.php'>
			<div class="tile_head">My Groups</div>	
			<div class="description">See which groups you are currently follwing,view message history,unfollow a group etc.</div>	
		</a>
<?php
	if(isset($_SESSION['master']))
	{
?>
	<a href='new_group.php'>
		<div class="tile_head">Create New Group</div>
		<div class="description">not available</div>
	</a>
<?php
	}

	echo "</ul>";
	echo "</div>";
	echo "</div>";
	include "footer.php";
	echo "</div>";
}
?>

