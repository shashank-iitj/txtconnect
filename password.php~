<?php
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	echo "<div class='page'>";
	echo "<div class='header'>";
include "header.php";
	echo "</div>";
	echo '<div class="content"><br><br>';
$reg_success=false;
$err="";
if(isset($_POST['email']) ){
	if(isset($_POST['password1']) && isset($_POST['password2'])){
		if($_POST['password1']!="" && $_POST['password2']!=""){
			if($_POST['password1']==$_POST['password2']){
				$db = mysql_connect('localhost','root','root');
				if($db){
					mysql_select_db("txtcnct",$db);
					$query = mysql_query('SELECT mobileNo FROM queued_user WHERE email = '.'"'.$_POST['email'].'"',$db);
					$row = mysql_fetch_assoc($query);
					$mobile = $row['mobileNo'];
					$isMaster = 0;
					$password = crypt($_POST['password1'],ss);
				
					//code to check whether $_POST['email'] is master or not. add a variable according and insert that into the table
					$query = mysql_query('SELECT * FROM master_table WHERE email = '.'"'.$_POST['email'].'"',$db);				
					if(mysql_num_rows($query)!=0)
						$isMaster = 1;

					mysql_query('INSERT INTO registered_user VALUES('.'"'.$_POST['email'].'"'.','.'"'.$mobile.'"'.','.'"'.$password.'"'.','.$isMaster.')');
					mysql_query('DELETE FROM queued_user WHERE mobileNo = '.'"'.$mobile.'"'.'AND email='.'"'.$_POST['email'].'"');		//________@@@@@@@@@@@_______check email also			
					echo 'Your registeration is complete now. '.'<a href="login.php">Click </a> Here to go to login page.';
					$reg_success=true;
				}
				else{
					echo "Could not connect to database";
				}
			}
			else{
				$err.="Passwords do not match. Try again.";
			}
		}
		else
		{
			$err.="You should not leave any field empty.";
		}
	}
	if(!$reg_success)
	{
		if($err)
			echo '<div class="error_area">'.$err.'</div><br>';
?>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<FORM ACTION = "password.php" METHOD="POST" class="formArea">
		<div class="form_heading">Set a password</div>
		<br>
		<TABLE class="form_table">
			<TR>
				<TD class="fieldName"> New Password </TD>
				<TD> <INPUT TYPE=PASSWORD SIZE =30 NAME="password1" class="textField"></TD>
			</TR>
			<TR>
				<TD class="fieldName"> Retype New Password </TD>
				<TD> <INPUT TYPE=PASSWORD SIZE = 30 NAME="password2" class="textField"></TD>
		</TABLE>
		<INPUT TYPE=HIDDEN NAME="email" VALUE=<?php echo $_POST['email'];?>>
		<br>
		<INPUT type="submit" class="submit" value="Continue">
	</FORM>
</body>
</html>
<?php
	}
}
else{
	echo "There is nothing to show";
}
	echo "<br><br>";	
	echo "</div>";
	include "footer.php";
?>
