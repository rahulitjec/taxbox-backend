<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once( APPPATH . 'php-graph/src/Facebook/autoload.php' );
 class User_controller extends MY_Controller {
 
   
	   /*
		*	Login SALT
	 */
	private static $_salt = 'lrrjHHxA6V';
	private static $_fb = null;
	
	private static $_redirect_url = 'http://www.argalon.net/foreign_resident/fbresponse';

	public function __construct() 
    {
          parent::__construct();     
         
          $this->load->model('Common_model');
		  $this->load->library('Facebook');
	    
		  if(self::$_fb != ''){
			//self::$_fb = $fb;
		}else{
				 $fb = new Facebook\Facebook([
                   'app_id' => '1675185009221173',
                   'app_secret' => '9cef8fa21a8fd092e9f4b60a66b9fbaa',
                   'default_graph_version' => 'v2.8',
                         ]); 
			
				self::$_fb = $fb;
		   }  
	}

    public function userLogin()
	{ 
	 $data=array();
	 $data['data']['fb_login_url'] = $this->login_url();	 
	 $this->load->view('front/userlogin/login',$data);
		
	}
	public function userLoginAction()
	{
		     //echo 'test';die;
	          $this->form_validation->set_error_delimiters('<p class="text text-danger error" style="color:#e73d4a !important;">', '</p>');
	   	      $this->form_validation->set_rules('email', 'Email', 'trim|required');
	   	      $this->form_validation->set_rules('password','Password', 'trim|required');
	 
			 if($this->form_validation->run() == false) 
			  {	

					$error = array(
						'email'    => form_error('email'),
						'password' => form_error('password')
					);

					$return = array('status' => false, 'message' => 'All fields are required', 'data' => $error);
			   } 
		  else{ 
			    
				 	$email    =  $this->input->post('email');
					$pass     = md5($this->input->post('password'));	
					$where    = array('email' => $email);
				//checking if user exists
					$check = $this->Common_model->select_data('users',$where );
					
					if(!empty($check)) { 
					$db_p = $check[0]->password;
					//$dec_p = $this->password($db_p, null, 'decrypt');
						
						if($db_p == $pass){
							$session_userInfo = array(
							'user_id'	=>	base64_encode($check[0]->user_id),
							'email'	=>	$check[0]->email,
							'name'	=>	$check[0]->name
						);
							$this->session->set_userdata('logged_in',$session_userInfo);
							
							$return = array(
								'status' 	=> true,
								'message'	=> 'You have logged in successfully...',
								'data' 	=> ''
							);
						}else{
							  $return = array(
								'status' 	=> false,
								'message'	=> 'Invalid email and password combination',
								'data' 	=> ''
							 );
						    }
					} else {
						      $return = array(
								'status' 	=> false,
								'message'	=> 'No such user exists.',
								'data' 	=> ''
						   );
                         } 
		    }
	
			  echo json_encode($return);

		
	}
	public function userRegister()
	{

			 $this->form_validation->set_error_delimiters('<p class="text text-danger error" style="color:#e73d4a !important;">', '</p>');
			 $this->form_validation->set_rules('firstname','First name','trim|required');
			 $this->form_validation->set_rules('lastname','Last name','trim|required');
			 $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
			 $this->form_validation->set_rules('phone','Phone','trim|required');
			 $this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
			 $this->form_validation->set_rules('cpassword','Confirm password','trim|required|matches[password]');
			

           if ($this->form_validation->run() == FALSE) 
            {
						 $error = array(
						 
						'firstname'=> form_error('firstname'),
						'lastname' => form_error('lastname'),
						'email'    => form_error('email'),
						'phone'    => form_error('phone'),
						'password' => form_error('password'),
						'cpassword'=> form_error('cpassword') 
					);
						 
			     $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
            }
        else 
            {         
                       $firstname = $this->input->post('firstname'); 
                       $lastname  = $this->input->post('lastname'); 
					   $name      =  $firstname.'&nbsp'.$lastname; 
                       $email     = $this->input->post('email');
                       $phone     = $this->input->post('phone');
                       $password  = md5($this->input->post('password')); 
					   //$pass     = $this->password($password,self::$_salt,'encrypt');
                     
                       $data= array('name'    => $name,
                                    'email'   => $email,
                                    'phone'   => $phone, 
                                    'password'=> $password,
                                    'fbuser'  => 0
                                  );
                             
                         $info    = $this->Common_model->insert_data('users',$data);
                         $return  = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...',  'data' => $info);
            }

            echo json_encode($return);


		
	}
	 public function forgotPasswordAction()
	 {
				  $this->form_validation->set_error_delimiters('<p class="text text-danger error" style="font-size:15px;">','</p>');
				  $this->form_validation->set_rules('email','Email','trim|required|valid_email');
				 
				if($this->form_validation->run() == FALSE)
				{
				
					$error = array(
								'email'        => form_error('email')
								);
				
					$return  = array('status' => false, 'message' => 'All fields are required', 'data' => $error);
				} 
			else {
				  
					$email         = $this->input->post('email');
					$where         = array('email'=>$email);
										
					$check         = $this->Common_model->select_data("users",$where);
					if($check)
				   { 
						$cmail     = $check[0]->email;
						$name      = $check[0]->name;
						$password  = rand(100000,999999);
						$pass      = $password;
						
						
						$subject="Your password has been reset Sucessfully..";
						$message='<div class="title" style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 600; color: #374550;">Hello, '.$name.'</div>
							<br />
							<div class="title" style="font-family: Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 400; color: #374550;">'.$subject.'</div>
							<br />
							<div class="title" style="font-family: Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 400; color: #374550;">Your New password generated is <b>'.$password.'</b></div>
							<br />
							<div class="body-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: left; color: #333333;">Please login here following link '.base_url().' </div>
							<div class="body-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: left; color: #333333;">&nbsp;</div>';
										
						
							$this->load->model("EmailModel");  
							$this->EmailModel->sendselleremail($email,$subject,$message,'onlineform',EMAILFROM); 
							if($mailnotsent = 1)
							   {	
									
									$return = array(
												'status'	=> true, 
												'message'	=> 'Send your email sucessfully and your new password is generated. please check your mail..',
												'data' => ''
												);
							   }
							else{
									 $return = array(
												'status'	=> false, 
												'message'	=> 'Mail not send',				
												'data'      => ''
											);
							   } 
								 $data=array('password'=>$pass);
								$this->Common_model->update_data("users",$where,$data); 
							
				   }else{
						   $return = array(
								'status'	=> false, 
								'message'	=> 'Yours Mail does not match',				
								'data'      => ''
							);
					  }
										 
				}
				
					echo json_encode($return);
		
	 }
	 
			 /**
		   * Returns the login URL for facebook login
		   */
		   public function login_url()
		  {       
				// Add `use Facebook\FacebookRedirectLoginHelper;` to top of file
				$helper = self::$_fb->getRedirectLoginHelper();
				$permissions = ['email','user_likes']; // optional
				$loginUrl = $helper->getLoginUrl(self::$_redirect_url, $permissions);
			 	//echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
				return $loginUrl;
			
		  } 

		  /**
		  *	Callback page for facebook sign in response
		  *
		  *
		  */
		   public function fb_callback()
			  {    

					$helper = self::$_fb->getRedirectLoginHelper();
					try {
					  $accessToken = $helper->getAccessToken();
					} catch(Facebook\Exceptions\FacebookResponseException $e) {
					  // When Graph returns an error
					  echo 'Graph returned an error: ' . $e->getMessage();
					  exit;
					} catch(Facebook\Exceptions\FacebookSDKException $e) {
					  // When validation fails or other local issues
					  echo 'Facebook SDK returned an error: ' . $e->getMessage();
					  
					}

					 if (isset($accessToken)) {
						 /*if ($helper->getError()) {
						header('HTTP/1.0 401 Unauthorized');
						echo "Error: " . $helper->getError() . "\n";
						echo "Error Code: " . $helper->getErrorCode() . "\n";
						echo "Error Reason: " . $helper->getErrorReason() . "\n";
						echo "Error Description: " . $helper->getErrorDescription() . "\n";
					} else {
						header('HTTP/1.0 400 Bad Request');
						echo 'Bad request';
					}
					exit; */
						$this->session->set_userdata('fb_token_user', $accessToken) ;
						//redirect('Dashboard_controller/login');
						$this->login();
					  // Now you can redirect to another page and use the
					  // access token from $_SESSION['facebook_access_token']
					}

			}
			
			
    	    /**
				*	Gets users data from facebook is fb_token is set
				*
				*/
	 public function get_user()
	
			  {
				    
					if ( $this->session->userdata('fb_token_user'))
					{
						$token = $this->session->userdata('fb_token_user');
						self::$_fb->setDefaultAccessToken($token);
                       
					  try {
							  $response = self::$_fb->get('/me?fields=email,name,gender');
							  $userNode = $response->getGraphUser();
							  return $userNode;
							} catch(Facebook\Exceptions\FacebookResponseException $e) {
							  // When Graph returns an error
							  $userNode = 'Graph returned an error: ' . $e->getMessage();
							} catch(Facebook\Exceptions\FacebookSDKException $e) {
							  // When validation fails or other local issues
							  $userNode = 'Facebook SDK returned an error: ' . $e->getMessage();
							}
					}
					return false;
			  } 


			  
		  public function login($type = null)
			 {
					$user = $this->get_user();
				//print_r($user);die;
					if($user != false)
					{
					   if(!empty($user['email']))
					   {
									 $result = $this->Common_model->select_data( 'users', array('email'=> $user['email'] ));
									  if ( ! $result ){
										// Not registered.
										
										$data= array(
													'fb_id'  => $user['id'],
													'name'   => $user['name'],
													'email'  => $user['email'],
													'fbuser' => 1
												  );
										$ret= $this->Common_model->insert_data('users',$data );
										if($ret != false){
									   $data = $this->Common_model->select_data('users', array('email'=>$data['email'],'fbuser'=>$data['fbuser']));
									   $session = array(
											'user_id' => $data[0]->user_id,
											'email'   => $data[0]->email,
											'name'    => $data[0]->name
										  );
										  //setting session
										  $this->session->set_userdata('logged_in',$session);
										  redirect('vendordetails'); 
										}
									   
										
									  }else{
										  $datas= array(
												   'name'   => $user['name'],
													'email'  => $user['email'],
													'fbuser' => 1
												  );
										  $where=array('fb_id'=>$user['id']);
										  $this->Common_model->update_data('users',$where,$datas);
										  $user_data = $this->Common_model->select_data('users',array('email'=>$result[0]->email));
										if ( $user_data ){
											$session = array(
												'user_id' => base64_encode($user_data[0]->user_id),
												'email'  => $user_data[0]->email,
												'name'  =>  $user_data[0]->name
											);
											$this->session->set_userdata('logged_in',$session);
										  redirect('vendordetails');
										}else{
										  die( 'Unable to login!' );
										  redirect( base_url() );
										}
									  }
							 }else{
								     $data['user'] = $user;
									$this->load->view('front/userlogin/social_view',$data); 
								  }
									  
						}else{
							die('No data received!');
						} 
			} 
	
        /*      public function socialview()
	   {  
			$user = $this->get_user();
			
			$data['userdata'] = $user;
			$this->load->view('front/userlogin/social_view',$data);
		
	   } */
	    public function socialview_action(){
			 $this->form_validation->set_error_delimiters('<p class="text text-danger error" style="color:#e73d4a !important;">', '</p>');
			 $this->form_validation->set_rules('email','Email ','trim|required||valid_email|is_unique[users.email]');
			 
           if ($this->form_validation->run() == FALSE) 
            {
						 $error = array(
						'email'=> form_error('email')	
					  );
						 
			     $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
            }
        else 
            {         
                       $fb_id     = $this->input->post('fb_id'); 
                       $name      = $this->input->post('name'); 
                       $email     = $this->input->post('email');
                       
                       $data= array('fb_id'    => $fb_id,
                                    'name'   => $name,
                                    'email'   => $email, 
                                    'fbuser'  => 1
                                  );
                             
                         $this->Common_model->insert_data('users',$data);
						 $datas = $this->Common_model->select_data('users', array('email'=>$data['email'],'fbuser'=>$data['fbuser']));
									   $session = array(
											'user_id' => $datas[0]->user_id,
											'email'   => $datas[0]->email,
											'name'    => $datas[0]->name
										  );
										  //setting session
										  $this->session->set_userdata('logged_in',$session);
										 
                         $return  = array('status' =>true, 'message' => 'Congrats added sucessfuly ...');
            }

            echo json_encode($return);

			
		}
	   
	    
	 public function logout_user() 
   	{       
   		    $this->session->unset_userdata('logged_in');
            $this->session->sess_destroy();
            redirect('userlogin');
   	}
	
        


}


