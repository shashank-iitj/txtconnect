<html>
	<head>
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
							<li class="active"><a href='login.php' >Login </a></li>
							<li ><a href='reg_confirm.php'>Confirm Registeration</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<br>
				<br> 
				<div class="span4 offset1">
					<img src="usage.png" />
					<h4>Spread the word</h4>
					<p>Stay update with important information via text sms</p>
				</div>
				<div class="span4 offset2">
					<form action='default_home.php' method='post'>
						<legend>Sign In</legend>
<?php
						if($_POST)
						{
							$err="";
							if(!$_POST['email'] or !$_POST['password'])
								$err.="All the fields must be filled";
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
											$err.="Incorrect email or password";
										}
									}
									else{
										$err.='The entered email '.'"'.$_POST['email'].'"'.' has not yet been registered.';
									}
								}
							}
							if($err)
								echo '<div class="alert alert-error">'.$err.'</div>';
						}
?>
						<label>Email</label>
						<input type="text" name="email">

						<label>Password</label>
						<input type="password" name="password">

						<br>
						<button type="submit" class="btn-small">Submit</button>
					</form>
				</div>
			</div>

			<hr>			

			<footer>
				Text-connect(beta)
			</footer>
		</div>	
	</body>
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap-transition.js"></script>
	<script src="js/bootstrap-alert.js"></script>
</html>
