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

				if($_POST){
		
					$query = "SELECT message,sender,time FROM message_history WHERE to_group="."'".$_POST['group_name']."'";
					$result = mysql_query($query,$db);
		
					echo "
						<table class='table table-bordered table-hover'>
							<caption>Showing history for "."'".$_POST['group_name']."'</caption>
					";
					if(mysql_num_rows($result)==0)
					{
						echo "</table>";
						echo "<div class='alert'>There are no messages to show</div>";
					}
					else{
						echo "<tbody>";
						while($row=mysql_fetch_array($result))
							echo "
								<tr class='row_element'>
									<TD>".$row['time']."</TD>
									<td>".$row['message']."</td>
									<TD>".$row['sender']."</TD>
								</TR>
							";
						echo "</tbody></table>";
					}
				}
				?>
			</div>
		</div>
	</body>
</html>
		
