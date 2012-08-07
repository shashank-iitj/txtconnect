<?php
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	echo "<div class='page'>";
include "session.php";
	echo "<div class='header'>";
include "header.php";
include "upper.php";
	echo "</div>";

	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);
	
	$query = "SELECT group_name FROM group_member WHERE member_email="."'".$_SESSION['current_user']."'";
	$result1 = mysql_query($query,$db);
	$i=1;
	echo "<center><font size='3'>Click on <font color='993300'>View History </font> to show history of a group</font></center><br><br>";
	if(mysql_num_rows($result1)==0){
		//echo "<center>You have not joined any groups</center>";
	}
	else{
		while($row=mysql_fetch_array($result1)){
			echo "<center><TABLE BORDER='1' bgcolor='E0E0E0' width='500'><TR><TD align='center' width='50'>".$i."</TD><TD width='350' align='center'>".$row[0]."</TD><TD><FORM ACTION='group_history.php' METHOD=POST><INPUT TYPE = submit class='history_button' value='View History'><INPUT TYPE = HIDDEN NAME='group_name' "."VALUE="."'".$row[0]."'"."></FORM></TD></TR></TABLE></center>";
			$i=$i+1;
		}
	}
	
	$query = "SELECT group_name FROM groups WHERE owner_email="."'".$_SESSION['current_user']."'";
	$result2 = mysql_query($query,$db);
	if(mysql_num_rows($result2)==0){
		//echo "<center><font size='3'>You don't own any groups.</font></center>";
	}
	else{

		while($row=mysql_fetch_array($result1)){
			echo "<center><TABLE BORDER='1' bgcolor='E0E0E0' width='350'><TR><TD align='center' width='50'>".$i."</TD><TD width='350' align='center'>".$row[0]."</TD><TD><FORM ACTION='group_history.php' METHOD=POST><INPUT TYPE = submit value='View History'><INPUT TYPE = HIDDEN NAME='group_name' "."VALUE="."'".$row[0]."'"."></FORM></TD></TR></TABLE></center>";
			$i=$i+1;
		}
	}
	
	if(mysql_num_rows($result2)==0 && mysql_num_rows($result1)==0)
		echo "There are no groups to show.";
	echo "</div>";
?>
