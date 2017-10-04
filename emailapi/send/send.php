<?php

	require_once '/home/argalon/public_html/foreign_resident/emailapi/PHPMailerAutoload.php';

		/*
			$rahulname 		=	"Rahul Yadav";
			
			$sendemailname
			
			$rahulsub 		=	"Support ".rand();

			$rahulhtmlbody 	=	$rahulbody	=	"
													Hi,
														Kindly go ahead and delete it.
														Thanks
												";
					sendemailname							
		*/
		
			/*	
				define following variable to use this file
				
						$sendemailto
						$sendemailname
						$sendemailsub
						$sendemailhtmlbody
						$sendemailaddreplyto
						$sendemailaddreplytoname
						
			*/
		
		
			$to				=	$sendemailto;
			$subject		=	$sendemailsub ;
			$message 		=	$sendemailhtmlbody;
			$addreplyto		=	$sendemailaddreplyto;
			$addreplytoname	=	$sendemailaddreplytoname;
	/*
		*
		* This example shows making an SMTP connection with authentication.
		*
	*/

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that

	date_default_timezone_set('Etc/UTC');
	
	$template	=	file_get_contents('/home/argalon/public_html/foreign_resident/emailapi/email.template');


	$message = str_replace("{{content}}",$message,$template);

	
	try 
		{
			// echo "Message Sent OK\n";
			
			
			//Create a new PHPMailer instance
				$mail = new PHPMailer;
			//Tell PHPMailer to use SMTP
				$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;


			/* new line added */
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			/* new line added */


			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			//Set the hostname of the mail server
			$mail->Host = MAILHOST;
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port = MAILPORT;
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			//Username to use for SMTP authentication
			$mail->Username = MAILUSERNAME;
			//Password to use for SMTP authentication
			$mail->Password = MAILPASSWORD;
			//Set who the message is to be sent from
			//$mail->setFrom(MAILSETFROM, MAILSETFROMNAME);
			$mail->setFrom(MAILSETFROM, $addreplytoname);
			//Set an alternative reply-to address
			$mail->addReplyTo($addreplyto, $addreplytoname);
			//Set who the message is to be sent to
			$mail->addAddress($to, $sendemailname);
			//Set the subject line
			$mail->Subject = $subject;
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($message);
			//Replace the plain text body with one created manually
			$mail->AltBody = $message;
			//Attach an image file
			// $mail->addAttachment('images/phpmailer_mini.png');

			//send the message, check for errors

				if(!$mail->Send()) 
					{
						$mailnotsent = 0;
						$emailsendres	=	"Message not sent successfully, please check the SMTP Details.";
					} else {
						$emailsendres	=	"Message Successfully sent.";
						$mailnotsent = 1; 
					}

		} catch (phpmailerException $e) {
			$mailnotsent = 0;
			$emailsendres	=	$e->errorMessage(); 
			//Pretty error messages from PHPMailer
		} catch (Exception $e) {
			$mailnotsent = 0;
			$emailsendres	=	$e->getMessage(); //Boring error messages from anything else!
		}
	
		
?>