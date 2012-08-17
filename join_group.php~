<?php
session_start();
if(!isset($_SESSION['current_user'])){
	//die('You must be logged in to see this page.'.'<br><br><h3><a href="login.php">Login</a> now</h3>');
	include "default_home.php";
}
else
{
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	echo "<div class='page'>";
include "session.php";
	echo "<div class='header'>";
include "header.php";
include "upper.php";
	echo "</div>";
	echo '<div class="content"><br><br>';


	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);
	
	if($_POST){
		$query = "INSERT INTO group_member VALUES("."'".$_POST['group_name']."'".","."'".$_SESSION['current_user']."'".")";
			mysql_query($query,$db);
			echo "<b>"."'".$_POST['group_name']."'"."</b>"." added to your groups succesfully.<br>";
	}	
	$query  = "SELECT group_name FROM groups where group_name not in ( SELECT group_name FROM group_member where member_email="."'".$_SESSION['current_user']."'"." UNION SELECT group_name FROM groups where owner_email="."'".$_SESSION['current_user']."')";
	$result = mysql_query($query,$db);
	
	if(mysql_num_rows($result)==0)
		echo "There are no more groups to join.";
	else{
		echo "<table class='list_area'><thead><tr><th colspan='2'>Join a group</th></tr></thead>";
		echo "<tbody>";
		while($row = mysql_fetch_array($result)){
		echo "
			<tr class='row_element'>
				<TD >".$row[0]."</TD>
				<td>
					<FORM ACTION='join_group.php' METHOD='POST'>
						</INPUT><INPUT TYPE = 'submit' class='small_submit' value='Join'></INPUT>
						<INPUT TYPE = HIDDEN NAME='group_name' "."VALUE="."'".$row[0]."'".">
					</FORM>
				</td>
			</tr>
			";
		}
		echo "</tbody></table>";

	}
	echo "<br><br></div>";
include 'footer.php';
	echo "</div>";
}
?>
