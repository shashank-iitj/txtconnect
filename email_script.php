<?php
// =====This Script For Sending an Email ====
 
// ===== Recieving Data From Form =====
 
$to = $_POST['to'];
$from = $_POST['from'];
$subject= $_POST['subject'];
$message= $_POST['message'];
 
//=======It is better to include Headers in your email to make it easy understandable for your recipient =====
 
$header = "From ".$from;
 
if(isset($_POST['btnSend']))
{
$res = mail($to,$subject,$message,$header);
if($res)
{
echo 'Message Sent to '.$to.'';
}
else
{
echo 'Correct your Errors';
}
 
 
}
?>
