<CENTER>
<?php
//require 'Mail.php';
include "header.php";
if($_POST)
{
	$required = array("mobile"  => "Mobile No",
					  "email" => "Email Address");
	$err = "";
	foreach($required as $field => $label) {
	  if (!$_POST[$field]) {
		$err .= "".$label." is a required field <br>";
	  }
	}
	if($_POST['mobile']){
		if(!is_numeric($_POST['mobile'])){
			$err.='Mobile Number should contain only digits from 0-9.';
		}
		else{
			if(strlen($_POST['mobile'])!=10){
				$err.="Mobile no should be of 10 digits.";
			}
		}
	}
	$db = mysql_connect("localhost","root","root");
	if($_POST['email'] && $_POST['mobile'])
	if($db){
		mysql_select_db("txtcnct",$db);
		$query1 = mysql_query('SELECT * FROM registered_user WHERE email = '.'"'.$_POST['email'].'"',$db);
		$query2 = mysql_query('SELECT * FROM registered_user WHERE mobileNo = '.'"'.$_POST['mobile'].'"',$db);
		$r1 = mysql_num_rows($query1);
		$r2 = mysql_num_rows($query2);
		if($r1!=0)
			$err.='The email '.$_POST['email'].' is already registered <br>';
		if($r2!=0)
			$err.='Mobile No '.$_POST['mobile'].' is already registered <br>';
		}
	else{
		echo "could not connect to database";
	}
	
	if ($err) {
		echo '<link rel="stylesheet" type="text/css" href="style.css"><div class="error_area">'.$err.'</div><br>';
?>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<FORM ACTION="register.php" class="formArea" METHOD=POST>
		<div class="form_heading">Register</div>
		<br>
		<TABLE class="form_table">
		<TR>
		  <TD class="fieldName">Email Address</TD>
		  <TD><INPUT TYPE="TEXT" SIZE=30 NAME="email" class = "textField" onfocus="this.select();" VALUE="<?php echo $_POST["email"];?>"></TD>
		</TR>
		<TR>
		  <TD class="fieldName">Mobile</TD>
		  <TD><INPUT TYPE="TEXT" SIZE=30 NAME="mobile" class = "textField" onfocus="this.select();" VALUE="<?php echo $_POST["mobile"];?>"></TD>
		</TR>
		</TABLE>
		<br>
		<INPUT type="submit" class="submit" value="Register">
	</FORM>
</body>
</html>
	<?php
	}
	else {
		  //$query3 = mysql_query('SELECT mobileNo FROM queued_user WHERE email = '.'"'.$_POST['email'].'"');
		  //$query1 = mysql_query('SELECT email FROM queued_user WHERE mobile = '.'"'.$_POST['mobile'].'"');
		  
		  $mobile = "'".$_POST["mobile"]."'";
		  $email = "'".$_POST["email"]."'";

		  $confirmation1 = rand(1,1000);
		  $confirmation2 = rand(1,1000);
			
         	  $query = 'INSERT INTO queued_user VALUES('.$email.','.$mobile.','.$confirmation1.','.$confirmation2.')';
		  mysql_query($query,$db);
		
		/*
		   // Identify the sender, recipient, mail subject, and body
		   $sender    = "sumitsharma0999@gmail.com";
		   $recipient = $_POST['email'];
		   echo "recipient : ".$recipient."<br>";
		   $subject   = "Text Connect Registeration";
		   $body      = "Your email confirmation code is: ".$confirmation1;

		   // Identify the mail server, username, password, and port
		   $server   = "ssl://smtp.gmail.com";
		   $username = "sumitsharma0999@gmail.com";
		   $password = "";
		   $port     = "465";

		   // Set up the mail headers
		   $headers = array(
		      "From"    => $sender,
		      "To"      => $recipient,
		      "Subject" => $subject
		   );

		   // Configure the mailer mechanism
		   $smtp = Mail::factory("smtp",
		      array(
			"host"     => $server,
			"username" => $username,
			"password" => $password,
			"auth"     => true,
			"port"     => 465
		      )
		   );

		   // Send the message
		   $mail = $smtp->send($recipient, $headers, $body);

		   if (PEAR::isError($mail)) {
		      echo ($mail->getMessage());
		   }
		  $command ='./gsm '.$_POST['mobile'].' "'.'Your text connect registeration code is '.$confirmation2.'"';
		  echo $command;
		  echo exec($command);
		  */
		  echo "Thank you for registering";
		  echo "Confirmation codes have been sent at "."'".$email."'".' and Mobile No :'.$mobile.'.'.'<br> <a href="reg_confirm.php">Click</a> Here to go to confirmation page.';
	}
	
}
else
{
?>
</CENTER>
<html>
<link rel="stylesheet" type="text/css" href="style.css">

<body>
<CENTER>
<FORM ACTION="register.php" class="formArea" METHOD="POST";>
	<div class="form_heading">Register</div>
	<br>
	<TABLE class="form_table">
	<TR>
	  <TD class="fieldName">Email Address</TD>
	  <TD><INPUT TYPE="TEXT" class = "textField" SIZE=30 NAME="email" onfocus="this.select();" onblur=""></TD>
	</TR>
	<TR>
	  <TD class="fieldName">Mobile </TD>
	  <TD><INPUT TYPE="TEXT" class = "textField" SIZE=30 onfocus="this.select();" NAME="mobile"></TD>
	</TR>
	</TABLE>
	<br>
	<INPUT type="submit" class="submit" value="Register">
</FORM>
</CENTER>
</body>
</html>
<?php
}
include "upper2.php";
?>
