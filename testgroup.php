<?php include "session.php";?>
<?php
if($_POST){
	$err="";
	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);
		
	if($_POST['group_name']){
		$err.="You must enter a Group Name <br>";
	}
	if($_POST['group_name']){
		$query  = mysql_query('SELECT * FROM groups WHERE  groupName= '.'"'.$_POST['group_name'].'"');
		if(mysql_num_rows($query)!=0)
			$err.="sorry! A group with this name is already present. Choose a different name for group";

	}
	if($err){
		echo $err;
?>
		
		<FORM ACTION='new_group.php' METHOD=POST>
			<TABLE>
				<TR>
					<TD>Group Name</TD>
					<TD><INPUT TYPE=TEXT SIZE=40 HEIGHT=30 NAME="group_name"></TD>
				</TR>
			</TABLE>
			<INPUT TYPE=SUBMIT VALUE="Check for availability">
		</FORM>
<?php
	}
	else{
		$query1 = "INSERT INTO groups VALUES(".$_POST['group_name'].",".$_SESSION['current_user'].")";
		mysql_query($query1,$db);
		echo "New group has been created";
	}
}
else{
?>
<FORM ACTION='new_group.php' METHOD=POST>
	<TABLE>
		<TR>
			<TD>Group Name</TD>
			<TD><INPUT TYPE=TEXT SIZE=40 HEIGHT=30 NAME="group_name"></TD>
		</TR>
	</TABLE>
	<INPUT TYPE=SUBMIT VALUE="Check for availability">
</FORM>
<?php
}
?>

