<?php 
include "session.php";
include "header.php";
include "upper.php";

	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);

	if($_POST){
		
		$query = "SELECT message,sender,time FROM message_history WHERE to_group="."'".$_POST['group_name']."'";
		$result = mysql_query($query,$db);
		
		if(mysql_num_rows($result)==0)
			echo "There are no messages to show";
		else{
			while($row=mysql_fetch_array($result)){
				echo "<center><TABLE BORDER='1' bgcolor='E0E0E0' width='600'><TR><TD align='center' width='400'>".$row['message']."</TD><TD>".$row['sender']."</TD><TD width='150'>".$row['timestamp']."</TD></TR></TABLE></center>";
		}
	}
?>
		
