<?php
$db = mysql_connect("localhost","root","root");
if($db)
	echo "success";
else
	echo "failure";
?>
