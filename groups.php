<?php
include "session.php";
include "header.php";
include "upper.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
	<FORM ACTION='groups.php' METHOD=POST>
		<center>
		<table width='500' bgcolor='C0C0C0' align="CENTER"> 
			<center>
<?php
	if(isset($_SESSION['master']))
	{
?>
				<tr>
				<TD align = "center">
				<input type="button" value = "Send Message to Group" onClick="window.location.href='message_send.php'"></input>
				</TD>
			</tr>
			<br>
<?php
	}
?>
			<tr>
				<TD align="center">
				<input type="button" value = "Message_history" onClick="window.location.href='history.php'"></input>
				</TD>
			</tr><br>
			<tr>
				<TD align="center">
				<input type="button" value = "Unfollow a group" onClick="window.location.href='unfollow.php'"></input>
				<TD>
			</tr>
			</center>
		</table>
		</center>
	</FORM>
<?php
	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);
	
	$query = "SELECT group_name FROM group_member WHERE member_email="."'".$_SESSION['current_user']."'";
	$result = mysql_query($query,$db);
	
	echo "<center><font size='5'>Groups <font color='993300'>joined </font> by you</font></center>";
	if(mysql_num_rows($result)==0){
		echo "<center>You have not joined any groups</center>";
	}
	else{
		$i=1;
		echo "<center><div class='grouplist_area'>";
		while($row=mysql_fetch_array($result)){
			echo "<table class='row_element'><tr><td class='list_count' width='20'>".$i."</td><td width='280'>".$row[0]."</td></tr></table>";
			$i=$i+1;
		}
		echo "</div></center>";
	}
	
	$query = "SELECT group_name FROM groups WHERE owner_email="."'".$_SESSION['current_user']."'";
	$result = mysql_query($query,$db);
	echo "<br><br><center><font size='5'>Groups <font color='993300'>owned </font>by you</font></center>";
	if(mysql_num_rows($result)==0){
		echo "<center><font size='3'>You don't own any groups.</font></center>";
	}
	else{
		$i=1;
		echo "<center><div class='grouplist_area'>";
		while($row=mysql_fetch_array($result)){
			echo "<table class='row_element'><tr><td class='list_count' width='20'>".$i."</td><td width='280'>".$row[0]."</td></tr></table>";
			$i=$i+1;
		}
		echo "</div></center>";
	}
	
?>
	
