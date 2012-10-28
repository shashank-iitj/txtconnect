<html>
	<head>
		<title>My groups</title>
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
					<?php
						if(isset($_SESSION['master']))
						{
					?>	
			<div class="span8 offset2">
				<div class="hero-unit">
						<button type="submit" class="btn btn-large btn-primary" onClick= "window.location.href='message_send.php'">Send Message</button>
					<?php
						}
						else
						{
					?>
			<div class="span6 offset3">
				<div class="hero-unit">
					<?php
						}
					?>
					<button type="submit" class="btn btn-large" onClick="window.location.href='history.php'">Message history</button>
					<button type="submit" class="btn btn-large" onClick="window.location.href='unfollow.php'">Unfollow a group</button>

				</div>
			</div>
		
			<div class="row">
			<?php
				$db = mysql_connect("localhost","root","root");
				mysql_select_db("txtcnct",$db);
	
				$query = "SELECT group_name FROM group_member WHERE member_email="."'".$_SESSION['current_user']."'";
				$result = mysql_query($query,$db);
	
				echo "
					<div class='span5 offset1'>
						<table class='table table-bordered table-hover'>
							<caption> Groups <font color='993300'>joined</font> by you</caption>
				    ";
				if(mysql_num_rows($result)==0){
					echo "
						</table>
					";
					echo "<div class='alert'>You have not joined any groups</div>";
					echo "</div>";				// span4 closing div
				}
				else{
					echo "
						<thead>
							<tr>
								<th>#</th>
								<th> Group Name</th>
							</tr>
						</thead>
						<tbody>
					";
					$i=1;
	
					while($row=mysql_fetch_array($result)){
						echo "
							<tr>
								<td>".$i."</td>
								<td>".$row[0]."</td>
							</tr>
						";
						$i=$i+1;
					}
					echo "</thead></table></div>";
				}
	
				$query = "SELECT group_name FROM groups WHERE owner_email="."'".$_SESSION['current_user']."'";
				$result = mysql_query($query,$db);
				echo "
					<div class='span5'>
						<table class='table table-bordered table-hover'>
							<caption> Groups <font color='993300'>owned</font> by you</caption>
				    ";
				if(mysql_num_rows($result)==0){
					echo "
						</table>
					";
					echo "<div class='alert'>You don't own any groups</div>";
					echo "</div>";				// span4 closing div
				}
				else{
					echo "
						<thead>
							<tr>
								<th>#</th>
								<th> Group Name</th>
							</tr>
						</thead>
						<tbody>
					";
					$i=1;
	
					while($row=mysql_fetch_array($result)){
						echo "
							<tr>
								<td>".$i."</td>
								<td>".$row[0]."</td>
							</tr>
						";
						$i=$i+1;
					}
					echo "</thead></table></div>";
				}

			?>
			</div>
		</div>	

	</body>
</html>
	
