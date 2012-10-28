<html>
	<head>
		<title>Set Password for your account</title>
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
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="span4 offset4">

<?php
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
				
										$query = mysql_query('SELECT * FROM master_table WHERE email = '.'"'.$_POST['email'].'"',$db);				
										if(mysql_num_rows($query)!=0)
											$isMaster = 1;

										mysql_query('INSERT INTO registered_user VALUES('.'"'.$_POST['email'].'"'.','.'"'.$mobile.'"'.','.'"'.$password.'"'.','.$isMaster.')');
										mysql_query('DELETE FROM queued_user WHERE mobileNo = '.'"'.$mobile.'"'.'AND email='.'"'.$_POST['email'].'"');				
										echo '<div class="alert alert-success"> Your registeration is complete now.</div>';
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
						?>	
							<FORM ACTION = "password.php" METHOD="POST">
								<legend>Set your Password</legend>
						
								<?php
									if($err)
										echo '<div class="alert alert-error">'.$err.'</div><br>';
								?>
								<label>Password</label>
								<input type="password" name="password1"">

								<label>Retype password</label>
								<input type="password" name="password2">
			
								<INPUT TYPE=HIDDEN NAME="email" VALUE="<?php echo $_POST['email'];?>">
								<br>
								<button type="submit" class="btn btn-primary btn-small">Submit</button>
							</FORM>
						<?php
						}
					}
					else{
						header('Location:index.php');
					}
?>
	</body>
</html>
