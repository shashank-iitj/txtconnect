<?php
include "session.php";
include "header.php";
include "upper.php";

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
	
	while($row = mysql_fetch_array($result)){
		echo "<FORM ACTION='join_group.php' METHOD=POST>
			<center><TABLE border='1'><tr><TD align='center' width='200' bgcolor='C0C0C0'>".$row[0]."</TD>
			<td align='left'></INPUT><INPUT TYPE = submit value='Join'></INPUT></td>
			<INPUT TYPE = HIDDEN NAME='group_name' "."VALUE="."'".$row[0]."'".">
			</tr>
			</table></center>
		</FORM>";
	}
?>