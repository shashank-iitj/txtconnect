<?php
	//$name = tempnam("files/requests/","test_");
	
	$filepath = "files/requests/test.txt";

	$fptr = fopen($filepath,"w");

	if(flock($fptr,LOCK_EX))
	{
		echo "lock aquired";
		sleep(20);
		echo "After Sleep!";		
		flock($fptr,LOCK_UN);
	}
	else
		echo "lock nahi mil raha";

	fclose(fptr);
?>

