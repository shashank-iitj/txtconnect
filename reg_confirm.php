<html>
	<head>
		<title>Confirm registeration on text connect</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<style type="text/css">
		      body {
        		padding-top: 60px;
		        padding-bottom: 40px;
		      }
    		</style>
	</head>

	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand" href="index.php">Text Connect</a>
					<div class="nav-collapse collapse">
						<ul class="nav nav-tabs pull-right">
							<li ><a href='register.php'>Register</a></li>
							<li ><a href='login.php' >Login </a></li>
							<li class="active"><a href='reg_confirm.php'>Confirm Registeration</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<div class="container">
		<div class="row">
			<div class="span4 offset4">

<?php
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
								while($row = mysql_fetch_array($query)){
									if($row['email_code']==$email_confirm && $row['mobile_code'] == $mobile_confirm){
										echo "<div class='alert alert-success'>You can set your password now.</div>";
										$success=true;
			
										$query =  "delete from queued_user where email="."'".$email."'"." OR mobileNo="."'".$mobile."'";										
				
										break;					
									}
								}
								if($success);
								else{
									$err.="Incorrect Confirmation codes";
								}
							}
							else{
								//echo "You have not registered yet";
								//Click here to go to registeration page.
								$err.="The specified email has not been registered yet";
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

				if(!$success)
				{
				?>
					<FORM ACTION="reg_confirm.php" METHOD=POST>
						<legend>Confirm your registeration</legend>
						
						<?php
							if($err)
								echo '<div class="alert alert-error">'.$err.'</div><br>';
						?>
						<label>Email</label>
						<input type="text" name="email"">

						<label>Mobile Confimation Code</label>
						<input type="text" name="mobile_confirm">
			
						<label>Email Confimation Code</label>
						<input type="text" name="email_confirm">
	
						<br>
						<button type="submit" class="btn btn-primary btn-small">Submit</button>
					</FORM>
				<?php
				}
				else
				{
				?>
					<FORM ACTION = "password.php" METHOD = POST>
						<INPUT TYPE=HIDDEN NAME="email" VALUE=<?php echo $_POST['email'];?>>
						<button type="submit" class="btn btn-success">Continue</button>
					</FORM>
				<?php
				}
				
?>
	</body>
</html>
