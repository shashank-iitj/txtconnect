<?php
include "Mail.php";

	$sender="sumitsharma0999@gmail.com";
	$recipient = "sumit@iitj.ac.in";

    	echo "recipient : ".$recipient."<br>";

	
	$subject   = "Text Connect Registeration";
	$body      = "Your email confirmation code is: 1234";

		   // Identify the mail server, username, password, and port
	$server   = "ssl://smtp.gmail.com";
	$username = "sumitsharma0999@gmail.com";
	$password = "";
	$port     = "465";

		   // Set up the mail headers
       $headers = array(
	      "From"    => $sender,
	      "To"      => $recipient,
	      "Subject" => $subject
	   );

		   // Configure the mailer mechanism
	$smtp = Mail::factory("smtp",
	      array(
		"host"     => $server,
		"username" => $username,
		"password" => $password,
		"auth"     => true,
		"port"     => 465
	      )
	   );

		   // Send the message
	$mail = $smtp->send($recipient, $headers, $body);

	   if (PEAR::isError($mail)) {
	      echo ($mail->getMessage());
	   }

?>
