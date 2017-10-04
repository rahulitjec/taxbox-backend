<?php

	Class EmailModel extends CI_Model
		{
			
			function __construct()
				{
					// require_once '/home/argalon/public_html/feedbackbrain/emailapi/PHPMailerAutoload.php';
					$sql	=	"	SELECT * FROM  `smtpsettings` ORDER BY `id` DESC LIMIT 0,1	";
						$data	=	$this->db->query($sql);
							$data	=	$data->result_array();
								if(!empty($data))
									{
										$value = $data[0];
											define(	"MAILHOST"				,	$value['smtpserver']	);
											define(	"MAILPORT"				,	$value['smtpport']		);
											define(	"MAILUSERNAME"			,	$value['smtpuser']		);
											define(	"MAILPASSWORD"			,	$value['smtppassword']	);
											define(	"MAILSMTPTYPE"			,	$value['smtptype']		);
											define(	"MAILSETFROM"			,	EMAILFROM				);
											define(	"MAILSETFROMNAME"		,	EMAILFROMNAME			);
									} else {
											define(	"MAILHOST"				,	""	);
											define(	"MAILPORT"				,	""	);
											define(	"MAILUSERNAME"			,	""	);
											define(	"MAILPASSWORD"			,	""	);
											define(	"MAILSMTPTYPE"			,	""	);
											define(	"MAILSETFROM"			,	""	);
											define(	"MAILSETFROMNAME"		,	""	);
									}
				}
		
			
				
				public function sendselleremail($email,$subject,$message,$sendname,$sendemail)
                {	 

							if(!empty($email) && !empty($message)) 
								{
									$sendemailname 				=	"";
									$sendemailto 				=	$email;
									$sendemailsub 				=	$subject;
									$sendemailhtmlbody 			=	$message;
									$sendemailaddreplytoname	=	$sendname;
									$sendemailaddreplyto 		=	$sendemail;
									
										require FCPATH."emailapi/send/send.php";
									
												if($mailnotsent)
													{	
														$data['status']		=	1;
														$data['message']	=	$emailsendres;
														return json_encode($data);

													} else {
														$data['status']		=	0;
														$data['message']	=	$emailsendres;
														return json_encode($data);
													}
								} else {
									$data['status']		=	0;
									$data['message']	=	'Something Wents Wrong !!!';
									return json_encode($data);
								}
					}
				
			
					

		}

?>