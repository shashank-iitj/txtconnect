<html>
	<head>
		<title>Unfollow a group</title>
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
			<div class="span6 offset2">
<?php
	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);
	
	if($_POST)
	{
			$query = "delete from group_member where group_name="."'".$_POST['group_name']."'"." and member_email="."'".$_SESSION['current_user']."'";
			mysql_query($query,$db);
			echo "
				<div class='alert alert-success'>
					<b>"."'".$_POST['group_name']."'"."</b> removed succesfully from your groups.
				</div>			
			";
			//header('location:unfollow.php');

	}
?>

	
		<table class="table table-bordered table-hover">
			<caption>
					Unfollow a group from your list
			</caption>
			
<?php

	$query = "SELECT group_name FROM group_member WHERE member_email="."'".$_SESSION['current_user']."'";
	$result = mysql_query($query,$db);
	
	if(mysql_num_rows($result)==0){
		echo "</table>";
		echo "<div class='alert'>You have not joined any groups</div>";
	}
	else{
		echo "
			<tbody>
		";
		$i=1;
			while($row = mysql_fetch_array($result)){
				echo "
					<tr>
						<TD>".$row[0]."</TD>
						<td>
							<FORM ACTION='unfollow.php' METHOD='POST'>
									<INPUT TYPE = HIDDEN NAME='group_name' "."VALUE="."'".$row[0]."'".">
									<button type='submit' class='btn btn-small btn-danger'>Unfollow</button>
							</FORM>
						</td>
					<tr>
				";
			}
		echo "</tbody></table>";
	
	}
?>

			</div>
		</div>
	</body>
</html>
