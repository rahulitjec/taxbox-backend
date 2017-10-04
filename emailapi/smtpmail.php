<?php
		/*
		  $rahulto = "rahulitjec@gmail.com";
		  $rahulsub = "Support ".rand();
		  $rahulhtmlbody = $rahulbody = "Hi,
		  Kindly go ahead and delete it.
		  Thanks";
		*/

$to = $rahulto;
$subject = $rahulsub ;

$message = $rahulhtmlbody;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <no-reply@argalon.net>' . "\r\n";

			if(mail($to,$subject,$message,$headers))
				{
					$mailnotsent = "true";
				} else {
					$mailnotsent = "false"; 
				}

 /*
require 'PHPMailerAutoload.php';
require 'vendor/autoload.php';

$mail = new PHPMailerOAuth;
$mail->isSMTP();
$mail->SMTPDebug = 0; // 3 ro 0
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->SMTPSecure = true;

$mail->Username   = "rahulitjec@gmail.com"; // SMTP account username18.
$mail->Password   = "Sanam@143#";

$mail->From = "rahulitjec@gmail.com";
$mail->FromName = "No reply";
//$mail->AddAddress("m", "myname");
$mail->AddAddress($rahulto);  // Add a recipient

$mail->WordWrap = 50;                                 // set word wrap to 50 characters
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = $rahulsub;
$mail->Body    = $rahulhtmlbody;
$mail->AltBody = $rahulbody;

if(!$mail->Send()) 
	{
		$mailnotsent = "false";

	} else {
		$mailnotsent = "true"; 
}
*/
	
?>
