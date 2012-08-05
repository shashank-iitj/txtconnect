<CENTER>
<?php
include "header.php";
$success=false;
$err = "";
if($_POST){
	$email = $_POST['email'];
	$email_confirm = $_POST['email_confirm'];
	$mobile_confirm = $_POST['mobile_confirm'];
	if($email && $email_confirm && $mobile_confirm){
		$db = mysql_connect('localhost','root','root');
		if($db){
			mysql_select_db("txtcnct",$db);
			$query = mysql_query('SELECT email_code,mobile_code FROM queued_user WHERE email = '.'"'.$email.'"',$db);
			
			if(mysql_num_rows($query)!=0){
				$row = mysql_fetch_assoc($query);
				if($row['email_code']==$email_confirm && $row['mobile_code'] == $mobile_confirm){
					echo "Congratulation !!! You can set your password now.";
					$success=true;					
				}
				else{
				//echo '<link rel="stylesheet" type="text/css" href="style.css"><div class="error_area"> Incorrect confirmation codes</div><br>';
				$err.="Incorrect Confirmation codes";
				}
			}
			else{
				//echo "You have not registered yet";
				//Click here to go to registeration page.
				$err.="The specified has not been registered yet";
			}
		}
		else{
		echo "Could not connect to database";
		}
	}
	else{
	//echo "You must fill all the fields";
	$err.="All the fields must be filled";
	}
}
if($err)
{
	echo '<link rel="stylesheet" type="text/css" href="style.css"><div class="error_area">'.$err.'</div><br>';
}
if(!$success)
{
?>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<FORM ACTION = "reg_confirm.php" class="formArea" METHOD = POST>
			<div class="form_heading">Confirm Registeration</div>
			<br>
			<TABLE class="form_table">
			<TR>
				<TD class="fieldName">Email </TD>
				<TD><INPUT TYPE = TEXT SIZE=30 NAME ="email" class="textField" onfocus="this.select();"></TD>
			</TR>
			<TR>
				<TD class="fieldName">Email Confirmation Code </TD>
				<TD><INPUT TYPE = TEXT SIZE = 4 NAME="email_confirm" class="textField" onfocus="this.select();"></TD>
			</TR>
			<TR>
				<TD class="fieldName">Mobile Confirmation Code </TD>
				<TD><INPUT TYPE =   TEXT SIZE = 4 NAME="mobile_confirm" class="textField" onfocus="this.select();"></TD>
			</TR>
		</TABLE>
		<br>
		<INPUT type="submit" class="submit" value="Submit">
	</FORM>
<?php
}
else
{
?>
	<FORM ACTION = "password.php" METHOD = POST>
		<INPUT TYPE=HIDDEN NAME="email" VALUE=<?php echo $_POST['email'];?>>
		<INPUT type="submit" class="submit" value="Continue">
	</FORM>
<?php
}
include "upper2.php";
?>
</CENTER>
