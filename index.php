<html>
	<head>
		<title> Text Connect</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<style type="text/css">
		      body {
        		padding-top: 60px;
		        padding-bottom: 40px;
		      }
    		</style>
	</head>

	<body>
		<?php
			include "session.php";
			include "upper.php";
		?>
		<div class="container">
			You are logged in as <b><?php echo $_SESSION['current_user'];?></b><br> <br>
			
			<div class='row'>
				<div class="span8 offset2">
					<div class="hero-unit">
						<a href='join_group.php'>
							<h2>Join a Group</h2>
						</a>
						<p>Start following a group to start receiveing updates about that group</p>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class="span8 offset2">
					<div class="hero-unit">
						<a href='groups.php'>
							<h2>My Groups</h2>
						</a>
						<p>See which groups you are currently follwing,view message history,unfollow a group etc.</p>
					</div>
				</div>
			</div>
		<?php
			if(isset($_SESSION['master']))
			{
		?>
			<div class='row'>
				<div class="span8 offset2">
					<div class="hero-unit">
						<a href='new_group.php'>
							<h2>New Group</h2>
						</a>
						<p>Create a new Group</p>
					</div>
				</div>
			</div>
		<?php
			}
		?>
		</div>
	</body>
</html>
