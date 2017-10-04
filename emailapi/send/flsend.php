<?php
	exit(0);
	$sendemailto  				=	"support@freelancer.com";
	// $sendemailto  				=	"rahulitjec@gmail.com";
	
		$sendemailname  			=	"Ricardo Benitez";
			
			$sendemailsub  				=	"Support";
			
	$sendemailhtmlbody  		=	"
										Hi,  \r\n
										I want to delete my feedback that I provided to freelancer for Project ID: 11351476 \r\n \r\n 
										Thanks
									";
									
	$sendemailaddreplyto  		=	"lagarto691@gmail.com";
	
	$sendemailaddreplytoname  	=	"Ricardo Benitez";  
		
			$to				=	$sendemailto;
			$subject		=	$sendemailsub ;
			$message 		=	$sendemailhtmlbody;
			$addreplyto		=	$sendemailaddreplyto;
			$addreplytoname	=	$sendemailaddreplytoname;
	

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
// $headers .= 'From: Rahul Yadav<rahulitjec@gmail.com>' . "\r\n";
$headers .= "From: $sendemailaddreplytoname<$sendemailaddreplyto>" . "\r\n";
$headers .= "Reply-to: $sendemailaddreplytoname<$sendemailaddreplyto>" . "\r\n";
// $headers .= 'Bcc: Priyanka Shinde<prashushinde9@gmail.com>' . "\r\n";


			if(mail($to,$subject,$message,$headers))
				{
					echo "done";
				} else {
					echo "not done";
				}

?>