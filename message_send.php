<html>
	<head>
		<title> Send Message</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<style type="text/css">
		      body {
        		padding-top: 60px;
		        padding-bottom: 40px;
		      }
    		</style>
	</head>

	<!--find the right place to put javascript-->
	<script language="javascript" type="text/javascript">
		function limitText(limitField, limitCount, limitNum) {
			if (limitField.value.length > limitNum) {
				limitField.value = limitField.value.substring(0, limitNum);
			} else {
				limitCount.value = limitNum - limitField.value.length;
			}
		}
	</script>

	<body>
	<?php
		include "session.php";
		if(!isset($_SESSION['master']))
			header('Location:index.php');
		include "upper.php";
		include "file_handling.php";
	?>
		<div class="container">
			<div class="span6 offset2">
				<?php 
				
				$db = mysql_connect("localhost","root","root");
				mysql_select_db("txtcnct",$db);
	
				if($_POST){
					$err="";
					if(!$_POST['to'])
						$err.="Please select a group from list";
					else if(!$_POST['message'])
						$err.="You can not send empty message";

					if($err)
						echo "<div class='alert'>".$err."</div>";
					else
					{
						$to = $_POST['to'];
						$message = $_POST['message'];
						//echo "\n-----".$message."--------\n";
						submit_message($to,$message);
						//set_file_count($no);
		
						$query = 'INSERT INTO message_history(message,sender,to_group) VALUES('.'"'.$_POST['message'].'"'.','.'"'.$_SESSION['current_user'].'",'.'"'.$_POST['to'].'"'.')';
						mysql_query($query,$db);
					}
	
				}
				
				$query = "SELECT group_name FROM group_member WHERE member_email="."'".$_SESSION['current_user']."'"." UNION "."SELECT group_name FROM groups WHERE owner_email="."'".$_SESSION['current_user']."'";;
				$result = mysql_query($query,$db);

				echo '
					<FORM ACTION="message_send.php" METHOD=POST>
						<legend>Send message to a group </legend>

						<label>To</label>
						<select name="to">
							<option></option>
				';
				
				while($row=mysql_fetch_array($result)){
						echo "<option>".$row['group_name']."</option>";}
				echo "
						</select>

						<label>Message</label>
						<textarea name='message' cols='30' rows='6' onKeyDown='limitText(this.form.message,this.form.countdown,160)'></textarea>
			
				(Maximum characters: 160)<br>
						<label>Charcters left</label>
						<input readonly type='text' name='countdown',size='2' value='160'><br>
				
						<button type='submit' class='btn btn-primary'>Send</button>
					</FORM>
				";
				
				?>
			</div>
		</div>
	</body>
</html>
			
	


	
			
			
			
