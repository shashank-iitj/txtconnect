<html>
	<head>
		<title> Join a group</title>
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
	
				$query = "SELECT group_name FROM group_member WHERE member_email="."'".$_SESSION['current_user']."'";
				$result1 = mysql_query($query,$db);

				$query = "SELECT group_name FROM groups WHERE owner_email="."'".$_SESSION['current_user']."'";
				$result2 = mysql_query($query,$db);

				$i=1;
				echo "
					<table class='table table-bordered table-hover'>
						<caption>View Message History of a group</caption>
				";
				if(mysql_num_rows($result1)==0 && mysql_num_rows($result2)==0){
					echo "
						</table>
						<div class='alert'>No groups to show</div>
					";
				}
				else{
					echo "<tbody>";
					if(mysql_num_rows($result1)!=0)
					{
						while($row=mysql_fetch_array($result1)){
							echo "
								<TR>
									<TD>".$i."</TD>
									<TD>".$row[0]."</TD>
									<TD>
										<FORM ACTION='group_history.php' METHOD=POST>
											<button type='submit' class='btn btn-small' >
												View History
											</button>
											<INPUT TYPE = HIDDEN NAME='group_name' "."VALUE="."'".$row[0]."'".">
										</FORM>
									</TD>
								</TR>
							";
							$i=$i+1;
						}
					}

					if(mysql_num_rows($result2)!=0)
					{
						while($row=mysql_fetch_array($result2)){
							echo "
								<TR>
									<TD>".$i."</TD>
									<TD>".$row[0]."</TD>
									<TD>
										<FORM ACTION='group_history.php' METHOD=POST>
											<button type='submit' class='btn btn-small' >
												View History
											</button>
											<INPUT TYPE = HIDDEN NAME='group_name' "."VALUE="."'".$row[0]."'".">
										</FORM>
									</TD>
								</TR>
							";
							$i=$i+1;
						}
					}
					echo "</tbody></table>";
				}

			?>
			</div>
		</div>
	</body>
</html>
