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
			echo '<br><link rel="stylesheet" type="text/css" href="style.css">';
			echo "<center><div class='history_area'>";
			echo "<table class='row_element'><tr><th width='400'>Message</Th><Th align='center' width='150'>sender</Th><Th width='150' align='center'>Time</Th></TR></TABLE>";
			while($row=mysql_fetch_array($result))
				echo "<table class='row_element'><tr><td width='400'>".$row['message']."</TD><TD align='center' width='150'>".$row['sender']."</TD><TD width='150' align='center'>".$row['time']."</TD></TR></TABLE>";
		}
		echo "</div></center>";
	}
?>
		