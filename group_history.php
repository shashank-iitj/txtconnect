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
		
		$query = "SELECT message,sender,time FROM message_history WHERE to_group="."'".$_POST['group_name']."'";
		$result = mysql_query($query,$db);
		
		if(mysql_num_rows($result)==0)
			echo "There are no messages to show";
		else{
			echo "<table class='list_area'>
				<thead>					
					<tr>
						<th width='400'>Message</Th>
						<Th align='center' width='250'>sender</Th>
						<Th width='200' align='center'>Time</Th>
					</tr>
				</thead>
			      	<tbody>";
			while($row=mysql_fetch_array($result))
				echo "<tr class='row_element'>
						<td width='400'>".$row['message']."</TD>
						<TD align='center' width='250'>".$row['sender']."</TD>
						<TD width='200' align='center'>".$row['time']."</TD>
				     </TR>";
			echo "</tbody></table>";
		}
	}
	echo "<br><br></div>";
include 'footer.php';
	echo "</div>";
}
?>
		
