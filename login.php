<?php
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	echo "<div class='page'>";
	echo "<div class='header'>";
include "header.php";
include "navigation.php";
	echo "</div>";
	echo '<div class="content"><br><br>';
if($_POST){
	$err="";
	if(!$_POST['email'] or !$_POST['password']){
		$err.="all the fields must be filled";
	}
	else{
		$db=mysql_connect('localhost','root','root');
		if($db){
			mysql_select_db('txtcnct',$db);
			$query = mysql_query('SELECT password,isMaster from registered_user WHERE email='.'"'.$_POST['email'].'"');
			if(mysql_num_rows($query)!=0){
				$row = mysql_fetch_assoc($query);
			
				$password = crypt($_POST['password'],ss);				

				if($row['password']==$password){
					session_start();
					$_SESSION['current_user']=$_POST['email'];
					if($row['isMaster'])
						$_SESSION['master']=1;
					header('Location:index.php');
				}
				else{
					$err.="Incorrect username or password";
				}
			}
			else{
				$err.='The entered email '.'"'.$_POST['email'].'"'.' has not yet been registered.';
			}
		}
	}
	if($err)
		echo '<link rel="stylesheet" type="text/css" href="style.css"><div class="error_area">'.$err.'</div><br>';
}
?>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<div class="form_heading">Login</div>
<FORM ACTION='login.php' METHOD=POST class="formArea">
	<br>
	<TABLE class="form_table">
		<TR>
			<TD class="fieldName">Email</TD>
			<TD> <INPUT TYPE=TEXT NAME='email' size="30" class="textField"></TD>
		</TR>
		<TR>
			<TD class="fieldName">Password</TD>
			<TD> <INPUT TYPE=password NAME='password' size="30" class="textField"></TD>
		</TR>
	</TABLE>
	<br>
	<INPUT type="submit" class="submit" value="Login">
</FORM>
</FORM>
</body>
</html>

<?php
echo '<br><br></div>';
include "footer.php";
?>
