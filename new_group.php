

<?php 
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	echo "<div class='page'>";
include "session.php";
include "master_session.php";
	echo "<div class='header'>";
include "header.php";
include "upper.php";
	echo "</div>";

if($_POST){
	$err="";
	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);
		
	if(!$_POST['group_name']){
		$err.="You must enter a Group Name <br>";
	}
	if($_POST['group_name']){
		$query  = "SELECT * FROM groups WHERE  group_name= "."'".$_POST['group_name']."'";
		$result = mysql_query($query,$db);
		if(mysql_num_rows($result)!=0)
			$err.="sorry! A group with this name is already present. Choose a different name for group";
		
	}
	if($err){
		echo $err;
	}
	else{
		$query1 = "INSERT INTO groups VALUES("."'".$_POST['group_name']."'".","."'".$_SESSION['current_user']."'".")";
		mysql_query($query1,$db);
		echo "The group <b>".$_POST['group_name']."</b> has been created<br><br>";
	}
?>
		
		<FORM ACTION='new_group.php' METHOD=POST>
			<TABLE BORDER=0 bgcolor='C0C0C0'>
				<TR>
					<TD>Group Name</TD>
					<TD><INPUT TYPE=TEXT SIZE=40 HEIGHT=30 NAME="group_name"></TD>
				</TR>
			</TABLE>
			<INPUT TYPE=SUBMIT class='submit' VALUE="Create">
		</FORM>
<?php
}
else{
?>
<FORM ACTION='new_group.php' class="formArea" METHOD=POST>
	<div class="form_heading">Create a new Group</div><br>
	<TABLE class="form_table">
		<TR>
			<TD class="fieldName">Group Name</TD>
			<TD><INPUT TYPE=TEXT class="textField" SIZE=30 NAME="group_name"></TD>
		</TR>
	</TABLE>
	<br>
	<INPUT TYPE=SUBMIT class='submit' VALUE="Create">
</FORM>
<?php
	echo "</div>";
}
?>
