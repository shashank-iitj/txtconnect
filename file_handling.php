<?php

/*
function file_number()
{
	$no = -2;

	$fptr = fopen("/var/www/txtcnct_strap/txtcnct_2/files/num_files.txt","r");

	$no = fgets($fptr);
	fclose($fptr);

return $no+1;
}

function set_file_count($value)
{
	while(!$fptr)
		$fptr = fopen("/var/www/txtcnct_strap/txtcnct_2/files/num_files.txt","w");

	fputs($fptr,$value);
	fclose($fptr);
}
*/

function submit_message($group,$mesg)
{
	$filepath = tempnam("/var/www/txtcnct_2/files/requests/","req_");		//creates a file with unique filename



	//implement appropriate locking mechanism here
					
	$fptr = fopen($filepath,"w");

	$db = mysql_connect("localhost","root","root");
	mysql_select_db("txtcnct",$db);

	$message = '"'."[".$group."]".$mesg.'"';
	
//	echo "\nMessage:".$message;

	if($fptr){

		$query  = "SELECT member_email FROM group_member WHERE  group_name= "."'".$group."'";
		$result = mysql_query($query,$db);

		while($row=mysql_fetch_array($result)){
			$query2  = "SELECT mobileNo FROM registered_user WHERE  email = "."'".$row[0]."'";
			$result2 = mysql_query($query2,$db);
			$row2=mysql_fetch_array($result2);
			$data =$row2['mobileNo']." ".$message."\n";

			fputs($fptr,$data);
		}

		$query1  = "SELECT owner_email FROM groups WHERE  group_name= "."'".$group."'";
		$result = mysql_query($query1,$db);
		$row=mysql_fetch_array($result);

		$query  = "SELECT mobileNo FROM registered_user WHERE  email= "."'".$row['owner_email']."'";
		$result = mysql_query($query,$db);
		$row2=mysql_fetch_array($result);
		$data =$row2['mobileNo']." ".$message."\n";
		fputs($fptr,$data);

		fclose($fptr);
		echo "<div class='alert alert-success'>Your Message has been submitted</div>";
	}
	else
		return "<div class='alert alert-danger'>Sorry! Your request could not be processed</div>";
}

?>
