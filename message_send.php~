<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>

<?php

include "session.php";
include "header.php";
include "upper.php";
	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);
	
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	
if($_POST){
	$required = array("to"  => "Group Name",
					  "message" => "message field");
	$err = "";
	foreach($required as $field => $label) {
	  if (!$_POST[$field]) {
		$err .= "".$label." is a required field <br>";
	  }
	 }

	if(!$err){
		$query  = "SELECT * FROM groups WHERE  group_name= "."'".$_POST['to']."'";
		$result = mysql_query($query,$db);
		
		if(mysql_num_rows($result)==0)
			$err.="There is no group named ".$_POST['to'];
	}
	if($err){
		echo $err;
			
	$query = "SELECT group_name FROM group_member WHERE member_email="."'".$_SESSION['current_user']."'"." UNION "."SELECT group_name FROM groups WHERE owner_email="."'".$_SESSION['current_user']."'";;
		$result = mysql_query($query,$db);
		echo '<FORM ACTION="message_send.php" METHOD=POST>
			<TABLE align="center">
			<TR>
				<TD>To:</TD>
				<TD>
					<select name="to">';
		while($row=mysql_fetch_array($result)){
						echo "<option>".$row['group_name']."</option>";}
		echo "</select></TD></TR>
			<TR>
				<TD>Message:</TD>";
		echo "<TD><TEXTAREA name="."\""."message"."\""." cols='30' rows='6' onKeyDown="."\""."limitText(this.form.message,this.form.countdown,160)"."\""." value=".$_POST['message']."></TEXTAREA></TD>"."</TR>
		</TABLE>
		<center><font size='2'>(Maximum characters: 160)<br>Charcters left<input readonly type='text' name='countdown',size='2' value='160'><br></font>
		<INPUT TYPE='submit' class='submit' value='Send'></INPUT></center>
	</FORM>";
	}
	else{
		$query  = "SELECT member_email FROM group_member WHERE  group_name= "."'".$_POST['to']."'"." and member_email!="."'".$_SESSION['current_user']."'";
		$result = mysql_query($query,$db);
		while($row=mysql_fetch_array($result)){
			$query2  = "SELECT mobileNo FROM registered_user WHERE  email = "."'".$row[0]."'";
			$result2 = mysql_query($query2,$db);
			$row2=mysql_fetch_array($result2);
			$command ='./gsm '.$row2['mobileNo'].' "'.$_POST['message'].'"';
			//$command = './gsm '.$row2['mobileNo'].' "'.$_POST['message'].'"';
			exec($command);//execute program with this command.
			//echo $command."<br><br>";
		}
		$query  = "SELECT mobileNo FROM groups,registered_user WHERE  group_name= "."'".$_POST['to']."'"." and owner_email!="."'".$_SESSION['current_user']."'"." and owner_email=email";
		//echo $query;
		$result = mysql_query($query,$db);
		$row=mysql_fetch_array($result);
		$command ='./gsm '.$row['mobileNo'].' "'.$_POST['message'].'"';
		exec($command);//execute program with this command.
		//echo $command."<br>";
		//execute program with this command.
		echo "<center><font size='3'>Your message has been successfully submitted.</font></center>";
		//$time=date('H:i:s');
		//$date=date('Y-m-d');
		//echo $date." ".$time;
		$query = 'INSERT INTO message_history(message,sender,to_group) VALUES('.'"'.$_POST['message'].'"'.','.'"'.$_SESSION['current_user'].'",'.'"'.$_POST['to'].'"'.')';
		mysql_query($query,$db);
		}
		
}
else{
	$query = "SELECT group_name FROM group_member WHERE member_email="."'".$_SESSION['current_user']."'"." UNION "."SELECT group_name FROM groups WHERE owner_email="."'".$_SESSION['current_user']."'";;
	$result = mysql_query($query,$db);
	echo '<FORM ACTION="message_send.php" METHOD=POST>
		<TABLE align="center">
		<TR>
			<TD>To:</TD>
			<TD>
				<select name="to">';
	while($row=mysql_fetch_array($result)){
					echo "<option>".$row['group_name']."</option>";}
	echo "</select></TD></TR>
		<TR>
			<TD>Message:</TD>";
	echo "<TD><TEXTAREA name="."\""."message"."\""." cols='30' rows='6' onKeyDown="."\""."limitText(this.form.message,this.form.countdown,160)"."\""."></TEXTAREA></TD>"."</TR>
	</TABLE>
	<center><font size='2'>(Maximum characters: 160)<br>Charcters left<input readonly type='text' name='countdown',size='2' value='159'><br></font>
	<INPUT TYPE='submit' class='submit' value='Send'></INPUT></center>
</FORM>";
}
?>
	


	
			
			
			
