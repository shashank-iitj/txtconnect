<?php 
include "session.php";
include "header.php";
include "upper.php";
	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);
	
if($_POST)
{
		$query = "delete from group_member where group_name="."'".$_POST['group_name']."'"." and member_email="."'".$_SESSION['current_user']."'";
		mysql_query($query,$db);
		echo "<b>"."'".$_POST['group_name']."'"."</b>"." removes succesfully from your groups.";
		//header('location:unfollow.php');

}
?>
		<table align="center" bgcolor='C0C0C0' cellpadding='3' colspan='5'>
			<tr>
				<td>
					Click on unfollow to remove a group from your joined list
				</td>
			</tr>
		</table>
	</FORM>
<?php

	$query = "SELECT group_name FROM group_member WHERE member_email="."'".$_SESSION['current_user']."'";
	$result = mysql_query($query,$db);
	
	echo "<center><font size='5'>Groups <font color='993300'>joined </font> by you</font></center>";
	if(mysql_num_rows($result)==0){
		echo "<center><br>---> You have not joined any groups</center>";
	}
	else{
		$i=1;
			while($row = mysql_fetch_array($result)){
				echo "<FORM ACTION='unfollow.php' METHOD=POST>
					<TABLE border='1' width='350' align='center'><tr><TD width='300' align='center'>".$row[0]."</TD>
					<td></INPUT><INPUT TYPE = submit value='Unfollow'></INPUT></td>
					<INPUT TYPE = HIDDEN NAME='group_name' "."VALUE="."'".$row[0]."'"."
					</tr>
					</table>
					</FORM>";
			}
	
	}
?>
