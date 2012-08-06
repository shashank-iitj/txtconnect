<?php 
include "session.php";
include "header.php";
include "upper.php";


	echo '<br><br>You are logged in as '.'<b>'.$_SESSION['current_user'].'</b> ';
?>
<br>
<html>
	<body>
	<CENTER>
		<FONT size=5>
			<a href='join_group.php'>Join a Group</a><br>
			<a href='groups.php'>My groups</a><br>
<?php
	if(isset($_SESSION['master']))
			echo "<a href='new_group.php'>Create New Group</a><br>";
?>
		</FONT>
	</CENTER>
	</body>
</html>

