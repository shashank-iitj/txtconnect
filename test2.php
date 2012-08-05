<?php
	include "session.php";
	include "header.php";
	include "upper.php";
	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);
	$query = "SELECT group_name FROM group_member WHERE member_email="."'".$_SESSION['current_user']."'"." UNION "."SELECT group_name FROM groups WHERE owner_email="."'".$_SESSION['current_user']."'";;
	echo $query;
	$result = mysql_query($query,$db);
	
	
	echo "<FORM ACTION='message_send.php' METHOD=POST>
			<TABLE align='center'>
				<TR>
					<TD>To:</TD>
					<TD><select>";
	while($row=mysql_fetch_array($result)){
					echo "<option>".$row['group_name']."</option>";}
					echo"</select></TD></TR></TABLE><FORM>";

?>
