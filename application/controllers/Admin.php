<?php 
		defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends MY_Controller 
		{

			public function __construct()
				{
					parent::__construct();					
				    $this->load->model('Common_model');
					$this->load->model("AdminModel");						
					$this->load->model("UserModel");						
				}
						
			public function index()
				{
					$checkloggedin =	$this->AdminModel->checkloggedin();
						if($checkloggedin==1)
							{
								redirect("Admin/dashboard");
							}
					$this->load->view("back/Admin/admin_login");	
				}
					 		
		
			public function dashboard()
				{  
				
					
					$checkloggedin = $this->AdminModel->checkloggedin();
						if($checkloggedin==0)
							{
								redirect("admin");
							}
						$data = array();
						$seo  = array();
						 $adminid 			      =  $this->session->userdata('token');
					     $id 			          =   base64_decode($adminid);
						 if($id!=1){
						 $subadmin_usercount = $this->AdminModel->allvendor_by_id($id);
						 foreach($subadmin_usercount as $info){
							   $sub_usercount[] = $info;	
							  }					  
						 $sub_usercount = array_reduce($sub_usercount,
						 function($counter,$entry){						
							if(!isset($counter[$entry->user_id]))
							{
									$counter[$entry->user_id] = array(
											'user_id' => $entry->user_id,	
											'email' => $entry->email,	
											'phone' => $entry->phone,	
											'count' => 1
										);							
							}else{
								$counter[$entry->user_id]['count']++;
							}
								return $counter;
							}, array()
						);
						
						$tformsubmit       = $this->AdminModel->allvendor_by_id($id);
						foreach($tformsubmit as $totalsubmit_data){
							
							$countsubmitform[] =   $this->Common_model->select_data('vendor_form',array('id'=>$totalsubmit_data->id,'is_complete'=> 1));	
							
						}
						       $subadmin_userlist = $this->AdminModel->allvendor_by_id($id,5,'user_id');
									  foreach($subadmin_userlist as $info){
							   $sub_userlist[] = $info;	
							  }					  
						 $sub_usercount = array_reduce($sub_userlist,
						 function($counter,$entry){						
							if(!isset($counter[$entry->user_id]))
							{
									$counter[$entry->user_id] = array(
											'user_id' => $entry->user_id,	
											'name' => $entry->name,	
											'email' => $entry->email,	
											'phone' => $entry->phone,	
											'count' => 1
										);							
							}else{
								$counter[$entry->user_id]['count']++;
							}
								return $counter;
							}, array()
						);
						$data['usercount_subadmin'] = $sub_usercount;
						$data['countsubmitform']     = array_filter($countsubmitform);   
						$data['vendorcount_subadmin']= $this->AdminModel->allvendor_by_id($id);
						$data['latestvendor_subadmin']= $this->AdminModel->allvendor_by_id($id,5,'user_id'); 
						}else{}
					    $data['usercount_data']   =   $this->Common_model->select_data('users');	 	
					    $data['latestuser']       =   $this->Common_model->select_data('users',null,5,null,'user_id');	
					    $data['vendorcount_data'] =   $this->Common_model->select_data('vendor_form');	
					    $data['submitcount_data'] =   $this->Common_model->select_data('vendor_form',array('is_complete'=> 1));	
					    $data['latestvendor']     =   $this->Common_model->select_data('vendor_form',null,5,null,'id');	
						$seo['url']				  =	  site_url("Admin/dashboard");
						$seo['title']			  =	  "Dashboard";
						$seo['metatitle']		  =	  "Dashboard";
						$seo['metadescription']	  =	  "Dashboard";
						$data['data']['seo']	  =   $seo;    
						  
						$data['layout'] = $this->adminLayout($data);
						$this->load->view("back/Admin/dashboard/dashboard_view" ,$data); 
											
				}  
				 
			public function subadmincreate()
			{
					$checkloggedin =	$this->AdminModel->checkloggedin();
						if($checkloggedin==0)
							{
								redirect("admin");
							}						
						
					$data = array();
					$seo  = array();
					$seo['url']				=	site_url("admin/subadmincreate");
					$seo['title']			=	"Subadmin Create";
					$seo['metatitle']		=	"Subadmin Create";
					$seo['metadescription']	=	"Subadmin Create";

					$data['data']['seo'] = $seo;				
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/Admin/subadmin/create_subadmin" ,$data );					
			}
            public function subadmincreate_action()
         {
               
					  $this->form_validation->set_error_delimiters('<p class="text text-danger error">', '</p>');
					  $this->form_validation->set_rules('title','title ', 'trim|required');
					  $this->form_validation->set_rules('fullname','fullname ', 'trim|required');
					  $this->form_validation->set_rules('email','email','trim|required|valid_email|is_unique[admin.email]');
					  $this->form_validation->set_rules('contact_no','contact no','trim|required');
					  $this->form_validation->set_rules('address','address','trim|required');
					  $this->form_validation->set_rules('country','country','trim|required');
					  $this->form_validation->set_rules('abn_no','abn no','trim|required');
					  //$this->form_validation->set_rules('business_name','business name','trim|required');
					  $this->form_validation->set_rules('taxagent_no','taxagent no','trim|required');
					 
		  
					 if($this->form_validation->run() == FALSE)
					 {
					
						$error = array(
									'title'         => form_error('title'),
									'fullname'      => form_error('fullname'),
									'email'         => form_error('email'),
									'contact_no'    => form_error('contact_no'),
									'address'       => form_error('address'),
									'country'       => form_error('country'),
									'abn_no'        => form_error('abn_no'),
									'taxagent_no'   => form_error('taxagent_no')
								   );
					
						$return=array('status' => false, 'message' => 'All fields are required', 'data' => $error);
					} 
				 else{
							 $data= array(
											'title'         => $this->input->post('title'),
											'fullname'      => $this->input->post('fullname'),
											'email'         => $this->input->post('email'),
											'contact_no'    => $this->input->post('contact_no'),
											'address'       => $this->input->post('address'),
											'country'       => $this->input->post('country'),
											'abn_no'        => $this->input->post('abn_no'),
											'business_name' => $this->input->post('business_name'),
											'taxagent_no'   => $this->input->post('taxagent_no'),
											'logintype'     => 2,
											'status'        => 1,
											'email_verify'  => 0
										    );
											
							            $stat    = $this->Common_model->insert_data('admin',$data);
										$where   = array('email'=>$this->input->post('email'));
										$check   = $this->Common_model->select_data('admin',$where);
					if(!empty($check))
				   { 
						$cmail     = $check[0]->email;
						$mail      = base64_encode($cmail);
						$name      = $check[0]->fullname;
						$admin_id  = $check[0]->admin_id;
						$password  = md5(time().$admin_id);
						$info      = array('password'=>$password);
						$this->Common_model->update_data('admin',$where,$info);
						
						$subject="Complete your registration..";
						$message='<div class="title" style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 600; color: #374550;">Hello, '.$name.'</div>
							<br />
							<div class="title" style="font-family: Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 400; color: #374550;">'.$subject.'</div>
							<br />
							<div class="body-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: left; color: #333333;">Please verify your link '.base_url('admin/resetpassword_subadmin?pass='.$password.'&email='.$mail).' </div>
							<div class="body-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: left; color: #333333;">&nbsp;</div>';
										
						    $this->load->model("EmailModel");  
							$this->EmailModel->sendselleremail($cmail,$subject,$message,'onlineform',EMAILFROM); 
							
							if($mailnotsent = 1)
							   {	
									
									$return = array(
												'status'	=> true, 
												'message'	=> 'Registration sucessfully. and please check your email for reset password..',
												'data' => ''
												);
							   }
							else{
									 $return = array(
												'status'	=> false, 
												'message'	=> 'please try again registration not sucessfully..',				
												'data'      => ''
											);
							   } 
								 
							
				   }else{
						   $return = array(
								'status'	=> false, 
								'message'	=> 'Somthing went wrong...',				
								'data'      => ''
							);
					  }
										 
				}
			       
					  echo json_encode($return);
			
	   }
	     public function resetpassword_subadmin()
		 {			$data['getpass'] = $this->input->get('pass');
				    $email   = $this->input->get('email');
					$data['email'] = $email;
					$where         = array('email'=>base64_decode($email));					
					$check   = $this->Common_model->select_data('admin',$where);
					if($check[0]->email_verify==1){
						   
						    $this->load->view("back/Admin/settings/link_expire");
					}else{
					       $this->load->view("back/Admin/subadmin/resetpassword_subadmin",$data);
					     }
		 } 
		 public function resetpassword_subadmin_action()
		 {
			        $this->form_validation->set_error_delimiters('<p style="color:#e73d4a !important;" class="text text-danger error">', '</p>');
					$this->form_validation->set_rules('password','password ','trim|required');
					$this->form_validation->set_rules('cpassword','Confirm password ','trim|required|matches[password]');
				  
				 if($this->form_validation->run() == FALSE)
				 {
				
				    $error = array(
						 'password' => form_error('password'),
						 'cpassword' => form_error('cpassword'),
						  );
				
				     $return=array('status' => false, 'message' => 'All fields are required', 'data' => $error);
				} 
			  else
			  {
				   $password= $this->input->post('password');
				   $data= array(
								 'password'     => md5($password),
								 'email_verify' => 1
							   );
				        $getpass = $this->input->post('pass');
						$email   = base64_decode($this->input->post('email'));
					    $where   = array('email'=>$email);
										
					    $check   = $this->Common_model->select_data('admin',$where);
					if(!empty($check))
				   {      
			          
						$passwrd = $check[0]->password;
						
						if($getpass == $passwrd){
							
				  	      $result= $this->Common_model->update_data('admin',$where,$data);
						  
						  $return=array('status' => true, 'message' => 'Change password successfully...', 'data' => $result);
						}else{
							 
							 $return=array('status' => false,'message' => 'password not chanege');
							}	
				  }else{
					      $return=array('status' => false, 'message' => 'Something went wrong...');
					   } 
			  }
			   echo json_encode($return);
			 
		 }
	     public function allocateform_subadmin()
			{
					$checkloggedin =	$this->AdminModel->checkloggedin();
					if($checkloggedin==0)
					{
								redirect("admin");
					}
					$data = array();
					$seo  = array();		
				    $list                   =   $this->AdminModel->allvendor();	
				    $data['totalsubadmin']  =   $this->Common_model->select_data('admin',array('logintype'=>2));	
				    $i= 0;
				 if(!empty($list)){	
				foreach($list as $l){
					
					$c  = $this->AdminModel->get_name_by_id($l->vendor_type, 'type_name');
					$list[$i]->type_name = $c->vendor_type;
					
					$i++;
				} 
				 }else{}
				  
					$data['vendor_data']    =   $list;
					$seo['url']				=	site_url("admin/registereduser_list");
					$seo['title']			=	"Allocate form subadmin";
					$seo['metatitle']		=	"Allocate form subadmin";
					$seo['metadescription']	=	"Allocate form subadmin";

				    $data['data']['seo'] = $seo;					
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/Admin/subadmin/allocateform_subadmin",$data);					
			}
	public function allocateform_subadmin_action()
      {
					$this->form_validation->set_error_delimiters('<p class="text text-danger error">', '</p>');
					$this->form_validation->set_rules('subadmin_data','subadmin ', 'trim|required');
				  
				 if($this->form_validation->run() == FALSE)
				 {
				
				  $error = array(
						 'subadmin_data' => form_error('subadmin_data')
						);
				
				  $return=array('status' => false, 'message' => 'All fields are required', 'data' => $error);
				} 
			  else
			  {
				
				  $data = array();
				   $adminid     =  $this->session->userdata('token');
				   $id 			=   base64_decode($adminid);
				  $subadmin_id  = $this->input->post('subadmin_data');
				  $vendor_id    = $this->input->post('vendor_id');
				  $vendordata=$this->Common_model->select_data('allocate_form',array('subadmin_id'=>$subadmin_id));
				  
                  if(!empty($vendor_id && $subadmin_id))
				  {
						  if(!empty($vendordata))
						  { 
						     foreach($vendor_id as $data)
												   {
													 $data=array('vendor_id'=>$data,'subadmin_id'=>$subadmin_id,'allocate_by'=>$id);
													  $this->Common_model->insert_data('allocate_form',$data);
													  $this->Common_model->insert_data('assign_subadmin',$data);
												   }
										 $return=array('status' => true, 'message' => 'Saved successully....'); 
									
							}else{
								        foreach($vendor_id as $data)
											   {
												$data=array('vendor_id'=>$data,'subadmin_id'=>$subadmin_id,'allocate_by'=>$id);
												$this->Common_model->insert_data('allocate_form',$data);
												$this->Common_model->insert_data('assign_subadmin',$data);
											   }
									      $return=array('status' => true, 'message' => 'Saved successully....'); 
								 }
				 }else{

                        $return=array('status' => false, 'message' => 'Something went wrong....'); 
                      }
		  }
					echo json_encode($return);
        
      }
	          public function list_subadmin()
			{
					$checkloggedin =	$this->AdminModel->checkloggedin();
					if($checkloggedin==0)
					{
								redirect("admin");
					}
					$data = array();
					$seo  = array();		
				    $adminid 			    =  $this->session->userdata('token');
					$id 			        =   base64_decode($adminid);
				    $data['showing_subadmin'] =  $this->Common_model->select_data('admin',array('admin_id !='=>$id));	
				
					
					$seo['url']				=	site_url("admin/list_subadmin");
					$seo['title']			=	"List subadmin";
					$seo['metatitle']		=	"List subadmin";
					$seo['metadescription']	=	"List subadmin";

				    $data['data']['seo'] = $seo;					
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/Admin/subadmin/list_subadmin",$data);					
			}
			
		  public function allocateform_subadmin_selected($id='')
		  {
			    $data=array();
				$where=array('subadmin_id'=>$id);
				  $info=$this->Common_model->select_data('allocate_form',$where);
				  foreach($info as $targetvalue){

					$data[]=$targetvalue->vendor_id;
				  }
			  
			   
				$return=array('status' => true, 'message' => 'Saved successully....', 'data' => $data);
			
				echo json_encode($return);
			
		  }	
		  
		       public function listallocateform_subadmin()
			{
					$checkloggedin =	$this->AdminModel->checkloggedin();
					if($checkloggedin==0)
					{
								redirect("admin");
					}
					$data = array();
					$seo  = array();		
				    $adminid 			      =  $this->session->userdata('token');
					 $id 			          =   base64_decode($adminid);
				   $list                   =   $this->AdminModel->list_allocateform_subadmin($id);	
				   if(!empty($list)){
				   $i= 0;
				foreach($list as $l){
					
					$c  = $this->AdminModel->get_name_by_id($l->vendor_type, 'type_name');
					$list[$i]->type_name = $c->vendor_type;
					
					$i++;
				} 
				   }else{ }
					$data['subadmin_data']  =   $list;
					$seo['url']				=	site_url("admin/registereduser_list");
					$seo['title']			=	"Allocate form subadmin";
					$seo['metatitle']		=	"Allocate form subadmin";
					$seo['metadescription']	=	"Allocate form subadmin";

				    $data['data']['seo'] = $seo;					
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/Admin/subadmin/list_allocateform_subadmin",$data);					
			}
			
			public function allocateform_subadmin_delete($id='')
			{       
				  $where  = array('vendor_id'=>base64_decode($id));
				  $result=$this->Common_model->delete_data('allocate_form',$where);
				  if($result==1){
				  $return  = array('status' =>true, 'message' => 'Deleted sucessfuly ...' ,'data'=>$result);
				  }
				echo json_encode($return);
						 
		    }
				public function registereduser_list()
			{ 
					$checkloggedin =	$this->AdminModel->checkloggedin();
						if($checkloggedin==0)
							{
								redirect("admin");
							}
					$data = array();
					$seo  = array();		
				    $data['user_data']=$this->Common_model->select_data('users');	
					
					$seo['url']				=	site_url("admin/registereduser_list");
					$seo['title']			=	"List Of Registered User";
					$seo['metatitle']		=	"List Of Registered User";
					$seo['metadescription']	=	"List Of Registered User";

				    $data['data']['seo'] = $seo;					
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/Admin/user/list_registered_user",$data);					
			}
			public function submittedforms_list()
			{
					$checkloggedin =	$this->AdminModel->checkloggedin();
						if($checkloggedin==0)
							{
								redirect("admin");
							}
					$data = array();
					$seo  = array();
					$where = array('is_complete'=> 1);
				    $data['submitted_data'] = $this->Common_model->select_data('vendor_form',$where);	
					
					$seo['url']				=	site_url("admin/submittedforms_list");
					$seo['title']			=	"List of submitted form";
					$seo['metatitle']		=	"List of submitted form";
					$seo['metadescription']	=	"List of submitted form";

				    $data['data']['seo'] = $seo;					
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/Admin/user/list_submittedform",$data);					
			}
			public function notsubmittedforms_list()
			{
					$checkloggedin =	$this->AdminModel->checkloggedin();
						if($checkloggedin==0)
							{
								redirect("admin");
							}
					$data = array();
					$seo  = array();
					$where = array('is_complete'=> 0);
				    $data['submitted_data'] = $this->Common_model->select_data('vendor_form',$where);	
					
					$seo['url']				=	site_url("admin/notsubmittedforms_list");
					$seo['title']			=	"List of not submitted form";
					$seo['metatitle']		=	"List of not submitted form";
					$seo['metadescription']	=	"List of not submitted form";

				    $data['data']['seo'] = $seo;					
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/Admin/user/list_notsubmittedform",$data);					
			}
			  public function edit_submittedform($id='',$vendor_type='')
	       {    
			
				$checkloggedin =	$this->AdminModel->checkloggedin();
						if($checkloggedin==0)
							{
								redirect("admin");
							}
					$data = array();
					$seo  = array();
					$id= base64_decode($id);
					//print_r($id);die;
					$vendor_type= base64_decode($vendor_type);
					if(!empty($id)){
						$this->session->set_userdata('vendorId',$id);
						
					}else{
						$this->session->unset_userdata('vendorId');
						
					} 
				      
					$data['vendor_data']    =   $this->UserModel->vendor_fulldata($id,$vendor_type);
				    $data['vendortype']     =   $this->Common_model->select_data('vendor_type');
					$seo['url']				=	site_url("admin/edit_submittedform");
					$seo['title']			=	"Edit submitted form";
					$seo['metatitle']		=	"Edit submitted form";
					$seo['metadescription']	=	"Edit submitted form";

				    $data['data']['seo'] = $seo;					
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/Admin/user/edit_submittedform",$data);	
	      } 
		     public function check_default($post_string)
		    {

		       return $post_string == '0' ? FALSE : TRUE;
		    }
               
			 public function ValidateTFN($tfn='')
		{
					$weights = array(10, 7, 8, 4, 6, 3, 5, 2, 1);
				 //echo $tfn; die;
					// strip anything other than digits
					$tfn = preg_replace("/[^\d]/","",$tfn);
				 
					// check length is 9 digits
					if (strlen($tfn)==9) {
						$sum = 0;
						foreach ($weights as $position=>$weight) {
							$digit = $tfn[$position];
							$sum += $weight * $digit;
						}
						return ($sum % 11)==0;
					} 
					return false;
		}
        public function ValidateABN($abn='') 
		{
				$weights = array(10, 1, 3, 5, 7, 9, 11, 13, 15, 17, 19);
			 
				// strip anything other than digits
				$abn = preg_replace("/[^\d]/","",$abn);
			 
				// check length is 11 digits
				if (strlen($abn)==11) {
					// apply ato check method 
					$sum = 0;
					foreach ($weights as $position=>$weight) {
						$digit = $abn[$position] - ($position ? 0 : 1);
						$sum += $weight * $digit;
					}
					return ($sum % 89)==0;
				} 
				return false;
		}	
			
	   public function edit_submittedform_action($iscomplete='')
	 
   {           
            $this->form_validation->set_error_delimiters('<p class="text text-danger error">', '</p>');
		    $tax_no = $this->input->post('tax_no'); 
			  if($tax_no){
			 $this->form_validation->set_rules('tax_no','tax no','trim|required|callback_ValidateTFN');
			 $this->form_validation->set_message('ValidateTFN', 'Please select valid tax file number...');
			  }else{
				  $this->form_validation->set_rules('abn_no','abn no','trim|required|callback_ValidateABN');
			      $this->form_validation->set_message('ValidateABN', 'Please select valid ABN number...');
			  }
			 
			 $this->form_validation->set_rules('fullname','full name','trim|required');
            $this->form_validation->set_rules('vendor_type','vendor_type','required|callback_check_default');
            $this->form_validation->set_message('check_default', 'Please select vendor type.');
            $this->form_validation->set_rules('email','email','trim|required|valid_email');
			$this->form_validation->set_message('valid_email', 'Please provide an acceptable email address.');
            $this->form_validation->set_rules('phone_no','phone no ','trim|required');
			$this->form_validation->set_rules('addr_vendor','addr vendor','trim|required');
			$this->form_validation->set_rules('contact_date','contact date','trim|required');
			$this->form_validation->set_rules('expected_date','expected date','trim|required');
			$this->form_validation->set_rules('residency_status','residency status','trim|required|callback_check_default');
			$this->form_validation->set_rules('australian_tax','australian tax','trim|required|callback_check_default');
			$this->form_validation->set_rules('holding_property','holding property','trim|required|callback_check_default');
			

           if ($this->form_validation->run() == FALSE) 
            {


						 $error = array(
						 
						'tax_no'          => form_error('tax_no'),
						'abn_no'          => form_error('abn_no'),
						'fullname'        => form_error('fullname'),
						'vendor_type'     => form_error('vendor_type'),
						'email'           => form_error('email'),
						'contact_date'    => form_error('contact_date'),
						'expected_date'   => form_error('expected_date'),
						'phone_no'        => form_error('phone_no'),
						'addr_vendor'     => form_error('addr_vendor'),
						'residency_status'=> form_error('residency_status'),
						'australian_tax'  => form_error('australian_tax'),
						'holding_property'=> form_error('holding_property')
					);

			     $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
            }
        else
            {                   
                       $user_id                  = $this->input->post('user_id');  
                       $tax_no                   = $this->input->post('tax_no');  
                       $abn_no                   = $this->input->post('abn_no');
                       $fullname                 = $this->input->post('fullname');
                       $vendortype               = $this->input->post('vendor_type');
                       $email                    = $this->input->post('email');
                       $phone_no                 = $this->input->post('phone_no');
                       $addr_vendor              = $this->input->post('addr_vendor');
                       $contact_date             = $this->input->post('contact_date');
                       $expected_date            = $this->input->post('expected_date');
                       $residency_status         = $this->input->post('residency_status');
                       $australian_tax           = $this->input->post('australian_tax');
                       $holding_property         = $this->input->post('holding_property');
					   /*individual data post*/
                       $individual_date_birth    = $this->input->post('individual_date_birth');
                       $migrating_australia      = $this->input->post('migrating_settling_australia');
                       $returning_live_australia = $this->input->post('returning_live_australia');
                       $employment_contract      = $this->input->post('employment_contract_permanent_employment');
                       $exchange_program         = $this->input->post('exchange_program');
                       $full_time_education      = $this->input->post('full_time_education');
                       $holiday_casual_employmen = $this->input->post('holidaying_or_casual_employmen');
                       $visiting_relatives       = $this->input->post('visiting_friends_or_relatives');
                       $other                    = $this->input->post('other');
                       $stayed_or_intend_stay    = $this->input->post('have_you_stayed_or_do_you_intend_stay');
                       $australia_family_friends = $this->input->post('live_in_australia_family_friends');
                       $australia_Hotel_motel    = $this->input->post('live_in_australia_hotel_motel');
                       $aus_university_campus    = $this->input->post('live_in_australia_university_campus');
                      $aus_own_buying_home       = $this->input->post('live_in_australia_own_buying_home');
                      $renting_leasing_accomm    = $this->input->post('live_in_australia_renting_leasing_accommodation');
					  
                      $spouse_dependant_children= $this->input->post('spouse_dependant_children');
                      $currently_living_with_you= $this->input->post('currently_living_with_you');
                      $remaining_overseas       = $this->input->post('remaining_overseas');
                      $coming_to_live_with_you  = $this->input->post('coming_to_live_with_you');
                      $some_remaining_overseas  = $this->input->post('some_with_you_and_remaining_overseas');
                      $hold_majority_assets     = $this->input->post('hold_majority_of_your_assets');
                      $churches_community       =$this->input->post('are_you_member_of_any_clubs_churches_community');
                      $aus_six_month            = $this->input->post('have_you_stayed_or_do_you_intend_stay_australia_six_month');
                      $social_or_economic       = $this->input->post('social_or_economic_ties_to_country');
                      $aus_intermittently       = $this->input->post('intermittently_183day');
                      $place_of_abode_aus       = $this->input->post('place_of_abode_outside_australia');
                      $intend_takeup_residence  = $this->input->post('intend_to_takeup_residence_in_australia');
                       /*trust data post*/
					  $name_of_trustee          = $this->input->post('name_of_trustee');  
					  $is_this_unit_trust       = $this->input->post('is_this_unit_trust');  
					  $property_situated_aus     = $this->input->post('property_situated_australia');  
					  $trust_carry_business_aus  = $this->input->post('trust_carry_business_australia');  
					  $trust_management_control  = $this->input->post('trust_management_control');  
					  $australian_resident       = $this->input->post('australian_resident');  
					  $is_trustee_aus_resident   = $this->input->post('is_trustee_aus_resident');  
					  $management_control_aus    = $this->input->post('management_control_aus');  
					   /*company data post*/
					  $incorporated_australia    = $this->input->post('is_company_incorporated_in_australia');
					  $property_situated_aust    = $this->input->post('property_situated_aust');
					  $company_carry_business_aus= $this->input->post('company_carry_business_aus');
					  $company_management_aus    = $this->input->post('company_management_aus');
					  $controlled_shareholder_aus= $this->input->post('controlled_shareholders_aus');
					  /*superfund data post*/
					   $superannuation_fund      = $this->input->post('superannuation_fund');
					   $fund_estab_asset_fund    = $this->input->post('fund_estab_asset_fund');
					   $fund_control_aus         = $this->input->post('fund_control_aus');
					   $fund_have_any_member     = $this->input->post('fund_have_any_member');
					   $do_either_following_apply= $this->input->post('do_either_following_apply');
					    $is_complete              =  (!empty($iscomplete)) ? 1 : 0 ; 
                       $data= array(
					   'user_id'                 => $user_id, 
					   'tax_file_no'             => $tax_no,
                       'abn_no'                  => $abn_no,
                       'full_name'               => $fullname,
                       'vendor_type'             => $vendortype,
                       'email_address'           => $email,
                       'phone_no'                => $phone_no,
                       'address_of_vendor'       => $addr_vendor,
                       'contact_date'            => $contact_date,
                       'expected_date'           => $expected_date,
                       'residency_status_changed'=> $residency_status,
                       'lodged_australian_tax'   => $australian_tax,
                       'holding_property'        => $holding_property,
                        'is_complete'             => $is_complete
                        	 );
                         
						$individual_data= array( 
					   
					   'user_id'                                         => $user_id,
					   'date_of_birth'                                   => $individual_date_birth,
                       'migrating_settling_australia'                    => $migrating_australia,
                       'returning_live_australia'                        => $returning_live_australia,
                      'employment_contract_permanent_employment'        => isset($employment_contract) ? 'true' : 'false',
                       'exchange_program'                                => isset($exchange_program) ? 'true' : 'false',
                       'full_time_education'                             => isset($full_time_education) ? 'true' :'false',
                       'holidaying_or_casual_employmen'                  => isset($holiday_casual_employmen) ? 'true' : 'false',
                       'visiting_friends_or_relatives'                   => isset($visiting_relatives) ? 'true' : 'false',
                       'other'                                           => isset($other) ? 'true' : 'false',
                       'have_you_stayed_or_do_you_intend_stay'           => $stayed_or_intend_stay,
                       'live_in_australia_family_friends'                => isset($australia_family_friends) ? 'true' : 'false',
                       'live_in_australia_hotel_motel'                   => isset($australia_Hotel_motel) ? 'true' : 'false',
                       'live_in_australia_university_campus'             => isset($aus_university_campus) ? 'true' : 'false',
                       'live_in_australia_own_buying_home'               => isset($aus_own_buying_home) ? 'true' : 'false',
                       'live_in_australia_renting_leasing_accommodation'  => isset($renting_leasing_accomm) ? 'true' : 'false',
                       'spouse_dependant_children'                        => $spouse_dependant_children,
                       'currently_living_with_you'                        => isset($currently_living_with_you) ? 'true' : 'false',
                       'remaining_overseas'                               => isset($remaining_overseas) ? 'true' : 'false', 
                       'coming_to_live_with_you'                          => isset($coming_to_live_with_you) ? 'true' : 'false',
                       'some_with_you_and_remaining_overseas'             => isset($some_remaining_overseas) ? 'true' : 'false',
                       'hold_majority_of_your_assets'                     => $hold_majority_assets,
                       'are_you_member_of_any_clubs_churches_community'            => $churches_community,
                       'have_you_stayed_or_do_you_intend_stay_australia_six_month' => $aus_six_month,
                       'social_or_economic_ties_to_country'                        => $social_or_economic,
                       'australia_either_continue_intermittently_183day'           => $aus_intermittently,
                       'place_of_abode_outside_australia'                          => $place_of_abode_aus,
                       'intend_to_takeup_residence_in_australia'                   => $intend_takeup_residence
                                   
                         );
						$trust_data= array(
					   'user_id'                                                       => $user_id,
                       'name_of_trustee'                                                => $name_of_trustee,
                       'is_this_unit_trust'                                             => $is_this_unit_trust,
                       'any_property_of_the_trust_situated_in_australia'                => $property_situated_aus,
                       'trust_carry_on_business_in_australia'                           => $trust_carry_business_aus,
                       'trust_central_management_control'                               => $trust_management_control,
                       'australian_resident_hold_more_than_50percent_beneficial_interes'=> $australian_resident,
                       'is_trustee_of_the_trust_australian_resident'                    => $is_trustee_aus_resident,
                       'is_trust_central_management_control_in_australia'               => $management_control_aus
                                   
                         );	
								 
						$company_data= array(
					    'user_id'                                                      => $user_id,
                       'is_company_incorporated_in_australia'                          => $incorporated_australia,
                       'property_of_company_situated_in_australia'                     => $property_situated_aust,
                       'does_the_company_carry_on_business_in_australia'               => $company_carry_business_aus,
                       'company_central_management_and_control_in_australia'           => $company_management_aus,
                       'voting_power_controlled_shareholders_who_are_resident_in_aus'  => $controlled_shareholder_aus
                       
                       );			 
					  $superfund_data= array(
					   'user_id'                                                    => $user_id,
                       'is_entity_australian_superannuation_fund'                   => $superannuation_fund,
                       'fund_established_in_australia_or_is_any_asset_of_the_fund'  => $fund_estab_asset_fund,
                       'fund_central_management_control_in_australia'               => $fund_control_aus,
                       'fund_have_any_member'                                       => $fund_have_any_member,
                       'do_either_of_the_following_apply'                           => $do_either_following_apply
                       
                        );	
             	         
					 if(!empty($vendortype == 4)){
							 if(!empty($this->session->userdata('vendorId'))){
								$vendorid = $this->session->userdata('vendorId');
							 }
						 if(!empty($vendorid))
						 {
					
						  $this->form_validation->set_rules('migrating_settling_australia',' ','required|callback_check_default');
						  $this->form_validation->set_message('check_default','Please select migrating settling australia.');
	                    
	                      if ($this->form_validation->run() == FALSE) 
						        {
		                              $error = array(
									     'migrating_settling_australia' => form_error('migrating_settling_australia'));

		                                 $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);

		                         }
		           else{
                                
						
	                      if($migrating_australia==1){
						 if($aus_intermittently==0){
	                     $this->form_validation->set_rules('intermittently_183day','intermittently 183day','required|callback_check_default');
	                     $this->form_validation->set_message('check_default', 'Please select intermittently 183day.');
	                       if($this->form_validation->run() == FALSE)

	                                 $error = array(
								      'intermittently_183day'             => form_error('intermittently_183day')
	                                 );
	                             $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);

							}elseif($place_of_abode_aus==0){
								$this->form_validation->set_rules('place_of_abode_outside_australia','place of abode outside australia','required|callback_check_default');
	                           
	                       if($this->form_validation->run() == FALSE)

	                                 $error = array(
								      'place_of_abode_outside_australia' => form_error('place_of_abode_outside_australia')
	                                 );
	                             $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
								
								
								 
	                        }elseif($place_of_abode_aus==2) {
	                              $this->form_validation->set_rules('place_of_abode_outside_australia','place of abode outside australia','required|callback_check_default');
	                               $this->form_validation->set_message('check_default', 'Please select place of abode outside australia');
	                       if($this->form_validation->run() == FALSE){

	                               $error = array(
								      'place_of_abode_outside_australia' => form_error('place_of_abode_outside_australia')
	                                 );
	                                 $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
	                            }else{
	                                   $where = array('user_id'=>$user_id,'id'=>$vendorid);	
										      $this->Common_model->update_data('vendor_form',$where,$data);
										      $this->Common_model->update_data('vendor_individual',$where,$individual_data);
										   
										     $return  = array('status' =>true, 'message' => 'Your Information updated Sucessfuly ...'
										     );
	                                  }

                                  }else{
									  $this->form_validation->set_rules('intend_to_takeup_residence_in_australia','intend to takeup residence in australia','required|callback_check_default');

                                       if($this->form_validation->run() == FALSE){

			                                $error = array(
										      'intend_to_takeup_residence_in_australia' => form_error('intend_to_takeup_residence_in_australia')
			                                 );
			                                 $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
				                           }else{
				                                   $where = array('user_id'=>$user_id,'id'=>$vendorid);	
													      $this->Common_model->update_data('vendor_form',$where,$data);
													      $this->Common_model->update_data('vendor_individual',$where,$individual_data);
													   
													     $return  = array('status' =>true, 'message' => 'Your Information updated Sucessfuly ...'
													     );
				                                  }

                                  }        

                              }else{

                                   if($returning_live_australia==0){
                                      
                                     $this->form_validation->set_rules('returning_live_australia','returning live australia ','required|callback_check_default');
                              $this->form_validation->set_message('check_default', 'Please select returning live australia.');
                                 if($this->form_validation->run() == FALSE)


									 $error = array(
									
									 'returning_live_australia'       => form_error('returning_live_australia') );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
                                 

                                   }elseif($returning_live_australia==2){
                             

		                             $this->form_validation->set_rules('have_you_stayed_or_do_you_intend_stay_australia_six_month','have you stayed or do you intend stay australia six month','required|callback_check_default');
		                             $this->form_validation->set_rules('social_or_economic_ties_to_country','social or economic ties to country','required|callback_check_default');
		                             $this->form_validation->set_rules('intermittently_183day','intermittently 183day','required|callback_check_default');
		                            
                                           if($this->form_validation->run() == FALSE){
                                            $error = array('have_you_stayed_or_do_you_intend_stay_australia_six_month' => form_error('have_you_stayed_or_do_you_intend_stay_australia_six_month'),
                                            'social_or_economic_ties_to_country' => form_error('social_or_economic_ties_to_country'),
                                            'intermittently_183day' => form_error('intermittently_183day')
                                             );
									 $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									}else{

                                          $where = array('user_id'=>$user_id,'id'=>$vendorid);	
									      $this->Common_model->update_data('vendor_form',$where,$data);
									      $this->Common_model->update_data('vendor_individual',$where,$individual_data);
									   
									     $return  = array('status' =>true, 'message' => 'Your Information updated Sucessfuly ...'
									     );

									}
                                   
                                 }else{
                                   if($other=='true'){
                                 $this->form_validation->set_rules('have_you_stayed_or_do_you_intend_stay','have you stayed or do you intend stay ','required|callback_check_default');
                                $this->form_validation->set_rules('spouse_dependant_children','spouse dependant children ','required|callback_check_default');
                                $this->form_validation->set_rules('hold_majority_of_your_assets','hold majority of your assets ','required|callback_check_default');
                                $this->form_validation->set_rules('are_you_member_of_any_clubs_churches_community','are you member of any clubs churches community ','required|callback_check_default');
                            
                                 if($this->form_validation->run() == FALSE){


									  $error = array(
									 'have_you_stayed_or_do_you_intend_stay'=> form_error('have_you_stayed_or_do_you_intend_stay'),'spouse_dependant_children' => form_error('spouse_dependant_children') ,'hold_majority_of_your_assets' => form_error('hold_majority_of_your_assets') ,'are_you_member_of_any_clubs_churches_community' => form_error('are_you_member_of_any_clubs_churches_community') 

									);

                                          $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									  }else{

                                            $where = array('user_id'=>$user_id,'id'=>$vendorid);	
									      $this->Common_model->update_data('vendor_form',$where,$data);
									      $this->Common_model->update_data('vendor_individual',$where,$individual_data);
									   
									     $return  = array('status' =>true, 'message' => 'Your Information updated Sucessfuly ...'
									     );
									   }
								     }else{
										   $where = array('user_id'=>$user_id,'id'=>$vendorid);	
									       $this->Common_model->update_data('vendor_form',$where,$data);
									       $this->Common_model->update_data('vendor_individual',$where,$individual_data);
									       $return  = array('status' =>true, 'message' => 'Your Information updated Sucessfuly ...'
									       );
										}
									}
                                 
                                }
						     }
						 }else{  
							    $this->form_validation->set_rules('migrating_settling_australia',' ','required|callback_check_default');
						  $this->form_validation->set_message('check_default', 'Please select migrating settling australia.');
	                    
	                      if ($this->form_validation->run() == FALSE) 
						        {
		                              $error = array(
									     'migrating_settling_australia'      => form_error('migrating_settling_australia'));

		                                 $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);

		                         }
		           else{
                                
						
	                      if($migrating_australia==1){
						 if($aus_intermittently==0){
	                     $this->form_validation->set_rules('intermittently_183day','intermittently 183day','required|callback_check_default');
	                     $this->form_validation->set_message('check_default', 'Please select intermittently 183day.');
	                       if($this->form_validation->run() == FALSE)

	                                 $error = array(
								      'intermittently_183day' => form_error('intermittently_183day')
	                                 );
	                             $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);

							}elseif($place_of_abode_aus==0){
								$this->form_validation->set_rules('place_of_abode_outside_australia','place of abode outside australia','required|callback_check_default');
	                           
	                       if($this->form_validation->run() == FALSE)

	                                 $error = array(
								      'place_of_abode_outside_australia' => form_error('place_of_abode_outside_australia')
	                                 );
	                             $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
								
								
								 
	                        }elseif($place_of_abode_aus==2) {
	                              $this->form_validation->set_rules('place_of_abode_outside_australia','place of abode outside australia','required|callback_check_default');
	                               $this->form_validation->set_message('check_default', 'Please select place of abode outside australia');
	                       if($this->form_validation->run() == FALSE){

	                               $error = array(
								      'place_of_abode_outside_australia' => form_error('place_of_abode_outside_australia')
	                                 );
	                                 $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
	                            }else{
	                                      $this->Common_model->insert_data('vendor_form',$data);
										   $individual_data['id']= $this->db->insert_id();
										   $this->session->set_userdata('vendorId',$this->db->insert_id());
										   $this->Common_model->insert_data('vendor_individual',$individual_data);
										   $return   = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...');
	                                  }

                                  }else{
									  $this->form_validation->set_rules('intend_to_takeup_residence_in_australia','intend to takeup residence in australia','required|callback_check_default');

                                       if($this->form_validation->run() == FALSE){

			                                $error = array(
										      'intend_to_takeup_residence_in_australia' => form_error('intend_to_takeup_residence_in_australia')
			                                 );
			                                 $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
				                           }else{
				                                   $this->Common_model->insert_data('vendor_form',$data);
												   $individual_data['id']= $this->db->insert_id();
												   $this->session->set_userdata('vendorId',$this->db->insert_id());
												   $this->Common_model->insert_data('vendor_individual',$individual_data);
												   $return   = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...');
				                                  }

                                  }        

                              }else{

                                   if($returning_live_australia==0){
                                      
                                     $this->form_validation->set_rules('returning_live_australia','returning live australia ','required|callback_check_default');
                              $this->form_validation->set_message('check_default', 'Please select returning live australia.');
                                 if($this->form_validation->run() == FALSE)


									 $error = array(
									
									 'returning_live_australia'       => form_error('returning_live_australia') );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
                                 

                                   }elseif($returning_live_australia==2){
                             

		                             $this->form_validation->set_rules('have_you_stayed_or_do_you_intend_stay_australia_six_month','have you stayed or do you intend stay australia six month','required|callback_check_default');
		                              $this->form_validation->set_rules('social_or_economic_ties_to_country','social or economic ties to country','required|callback_check_default');
		                              $this->form_validation->set_rules('intermittently_183day','intermittently 183day','required|callback_check_default');
		                             
                                           if($this->form_validation->run() == FALSE){
                                            $error = array('have_you_stayed_or_do_you_intend_stay_australia_six_month' => form_error('have_you_stayed_or_do_you_intend_stay_australia_six_month'),
                                             'social_or_economic_ties_to_country' => form_error('social_or_economic_ties_to_country'),
                                             'intermittently_183day' => form_error('intermittently_183day')

												  );
									 $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									}else{

                                           $this->Common_model->insert_data('vendor_form',$data);
										   $individual_data['id']= $this->db->insert_id();
										   $this->session->set_userdata('vendorId',$this->db->insert_id());
										   $this->Common_model->insert_data('vendor_individual',$individual_data);
										   $return   = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...');

									}
                                   
                                 }else{
                                 if($other=='true'){
                                $this->form_validation->set_rules('have_you_stayed_or_do_you_intend_stay','have you stayed or do you intend stay ','required|callback_check_default');
                                $this->form_validation->set_rules('spouse_dependant_children','spouse dependant children ','required|callback_check_default');
                                $this->form_validation->set_rules('hold_majority_of_your_assets','hold majority of your assets ','required|callback_check_default');
                                $this->form_validation->set_rules('are_you_member_of_any_clubs_churches_community','are you member of any clubs churches community ','required|callback_check_default');
                            
                                 if($this->form_validation->run() == FALSE){


									  $error = array(
									 'have_you_stayed_or_do_you_intend_stay'=> form_error('have_you_stayed_or_do_you_intend_stay'),'spouse_dependant_children' => form_error('spouse_dependant_children') ,'hold_majority_of_your_assets' => form_error('hold_majority_of_your_assets') ,'are_you_member_of_any_clubs_churches_community' => form_error('are_you_member_of_any_clubs_churches_community') 

									);

                                          $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									  }else{

                                           $this->Common_model->insert_data('vendor_form',$data);
										   $individual_data['id']= $this->db->insert_id();
										   $this->session->set_userdata('vendorId',$this->db->insert_id());
										   $this->Common_model->insert_data('vendor_individual',$individual_data);
										   $return   = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...');
									   }
									   
									  }else{
										    $this->Common_model->insert_data('vendor_form',$data);
										    $individual_data['id']= $this->db->insert_id();
										    $this->session->set_userdata('vendorId',$this->db->insert_id());
										    $this->Common_model->insert_data('vendor_individual',$individual_data);
										    $return   = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...');
										  
									      }
							       }     
                                 
                                }
						     }
							 
						  }
						     
						 }elseif(!empty($vendortype== 1)){
							 if(!empty($this->session->userdata('vendorId'))){
								$vendorid = $this->session->userdata('vendorId');
							 }
							 if(!empty($vendorid)){
								 
							   if($is_this_unit_trust==0){
                                      
                                    $this->form_validation->set_rules('is_this_unit_trust','is this unit trust ','required|callback_check_default');
                                    $this->form_validation->set_message('check_default', 'Please select unit trust.');
                                    if($this->form_validation->run() == FALSE)


									 $error = array(
									'is_this_unit_trust'       => form_error('is_this_unit_trust') );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
                                 

                                   }elseif($is_this_unit_trust==1)
								  {
                                     $this->form_validation->set_rules('name_of_trustee','name of trustee','required|callback_check_default');
                                    $this->form_validation->set_rules('property_situated_australia','property situated australia','required|callback_check_default');
		                            $this->form_validation->set_rules('trust_carry_business_australia','trust carry business australia','required|callback_check_default');
									$this->form_validation->set_rules('trust_management_control','trust management control','required|callback_check_default');
									$this->form_validation->set_rules('australian_resident','australian resident','required|callback_check_default');
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('name_of_trustee' => form_error('name_of_trustee'),
                                           'property_situated_australia' => form_error('property_situated_australia'),
                                             'trust_carry_business_australia'=> form_error('trust_carry_business_australia'),
                                             'trust_management_control'=> form_error('trust_management_control'),
                                             'australian_resident' => form_error('australian_resident') 
											 );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									}else{

                                             $where = array('user_id'=>$user_id,'id'=>$vendorid);  
											 $this->Common_model->update_data('vendor_form',$where,$data);
											 $this->Common_model->update_data('vendor_trust',$where,$trust_data);
											
										  $return  = array('status' =>true, 'message' => 'Your Information updated Sucessfuly ...'
										  );
                                         } 
								}else{
									
									 $this->form_validation->set_rules('name_of_trustee','name of trustee','required|callback_check_default');
		                            $this->form_validation->set_rules('is_trustee_aus_resident','is trustee aus resident','required|callback_check_default');
		                            $this->form_validation->set_rules('management_control_aus','management control aus','required|callback_check_default');
									
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('name_of_trustee' => form_error('name_of_trustee'),
                                                           'is_trustee_aus_resident' => form_error('is_trustee_aus_resident'),
                                                           'management_control_aus'=> form_error('management_control_aus')
                                             );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									}else{

                                           $vendordata   = $this->Common_model->insert_data('vendor_form',$data);
										   $trust_data['id']= $this->db->insert_id();
										   $this->session->set_userdata('vendorId',$this->db->insert_id());
										   $this->Common_model->insert_data('vendor_trust',$trust_data);
										   $return  = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...'  );
                                         }
										
								} 
						  
						  
						 }else{
							   if($is_this_unit_trust==0){
                                      
                                     $this->form_validation->set_rules('name_of_trustee','name of trustee ','required|callback_check_default');
                                     $this->form_validation->set_rules('is_this_unit_trust','is this unit trust ','required|callback_check_default');
                                    $this->form_validation->set_message('check_default', 'Please select unit trust.');
                                    if($this->form_validation->run() == FALSE)


									 $error = array(
									
									 'name_of_trustee'         => form_error('name_of_trustee'),
									 'is_this_unit_trust'       => form_error('is_this_unit_trust') );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
                                 

                                   }elseif($is_this_unit_trust==1)
								  {
                             
                                    $this->form_validation->set_rules('name_of_trustee','name of trustee','required|callback_check_default');
		                            $this->form_validation->set_rules('property_situated_australia','property situated australia','required|callback_check_default');
		                            $this->form_validation->set_rules('trust_carry_business_australia','trust carry business australia','required|callback_check_default');
									$this->form_validation->set_rules('trust_management_control','trust management control','required|callback_check_default');
									$this->form_validation->set_rules('australian_resident','australian resident','required|callback_check_default');
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('name_of_trustee' => form_error('name_of_trustee'),
                                            'property_situated_australia' => form_error('property_situated_australia'),
                                             'trust_carry_business_australia'=> form_error('trust_carry_business_australia'),
                                             'trust_management_control'=> form_error('trust_management_control'),
                                             'australian_resident' => form_error('australian_resident') 
											 );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									}else{

                                           $vendordata   = $this->Common_model->insert_data('vendor_form',$data);
										   $trust_data['id']= $this->db->insert_id();
										   $this->session->set_userdata('vendorId',$this->db->insert_id());
											 $this->Common_model->insert_data('vendor_trust',$trust_data);
										   $return  = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...'  );
                                         }
                                   
								}else{
									
									$this->form_validation->set_rules('name_of_trustee','name of trustee','required|callback_check_default');
		                            $this->form_validation->set_rules('is_trustee_aus_resident','is trustee aus resident','required|callback_check_default');
		                            $this->form_validation->set_rules('management_control_aus','management control aus','required|callback_check_default');
									
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('name_of_trustee'   => form_error('name_of_trustee'),
                                                     'is_trustee_aus_resident' => form_error('is_trustee_aus_resident'),
                                                      'management_control_aus' => form_error('management_control_aus')
                                             );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									}else{

                                           $vendordata   = $this->Common_model->insert_data('vendor_form',$data);
										   $trust_data['id']= $this->db->insert_id();
										   $this->session->set_userdata('vendorId',$this->db->insert_id());
										   $this->Common_model->insert_data('vendor_trust',$trust_data);
										   $return  = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...'  );
                                         }
										
								}  
							 
						    }
					
						}elseif(!empty($vendortype== 2)){
							 
							if(!empty($this->session->userdata('vendorId'))){
								$vendorid = $this->session->userdata('vendorId');
							 }
							 if(!empty($vendorid)){
								 if($incorporated_australia==0){
                                      
                                     $this->form_validation->set_rules('is_company_incorporated_in_australia','is company incorporated in australia ','required|callback_check_default');
                                    $this->form_validation->set_message('check_default', 'Please select company incorporated in australia.');
                                    if($this->form_validation->run() == FALSE)


									 $error = array(
									
									 'is_company_incorporated_in_australia'=> form_error('is_company_incorporated_in_australia') );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
                                 

                                   }elseif($incorporated_australia==1)
								  {
                                      $where = array('user_id'=>$user_id,'id'=>$vendorid);	 	 
											 $this->Common_model->update_data('vendor_form',$where,$data); 
											 $this->Common_model->update_data('vendor_company',$where,$company_data);
											 $return  = array('status' =>true, 'message' => 'Your Information updated Sucessfuly ...' );
                                      
                                   
								}else{
									
		                            $this->form_validation->set_rules('property_situated_aust','property situated australia','required|callback_check_default');
		                            $this->form_validation->set_rules('company_carry_business_aus','company carry business australia','required|callback_check_default');
		                            $this->form_validation->set_rules('company_management_aus','company management australia','required|callback_check_default');
		                            $this->form_validation->set_rules('controlled_shareholders_aus','controlled shareholders australia','required|callback_check_default');
									
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('property_situated_aust'     => form_error('property_situated_aust'),
                                                           'company_carry_business_aus' => form_error('company_carry_business_aus'),
                                                           'company_management_aus'     => form_error('company_management_aus'),
                                                           'controlled_shareholders_aus'=> form_error('controlled_shareholders_aus')
                                             );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									}else{

                                             $where = array('user_id'=>$user_id,'id'=>$vendorid);	 	 
											 $this->Common_model->update_data('vendor_form',$where,$data); 
											 $this->Common_model->update_data('vendor_company',$where,$company_data);
											 $return  = array('status' =>true, 'message' => 'Your Information updated Sucessfuly ...' );
										   
                                         }		
								}  
							
						 }else{
							 
							   if($incorporated_australia==0){
                                      
                                     $this->form_validation->set_rules('is_company_incorporated_in_australia','is company incorporated in australia ','required|callback_check_default');
                                    $this->form_validation->set_message('check_default', 'Please select company incorporated in australia.');
                                    if($this->form_validation->run() == FALSE)


									 $error = array(
									
									 'is_company_incorporated_in_australia'=> form_error('is_company_incorporated_in_australia') );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
                                 

                                   }elseif($incorporated_australia==1)
								  {
                                     $vendordata   = $this->Common_model->insert_data('vendor_form',$data);
										   $company_data['id']= $this->db->insert_id();
										   $this->session->set_userdata('vendorId',$this->db->insert_id());
											 $this->Common_model->insert_data('vendor_company',$company_data);
										   $return  = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...'  );
                                   
								}else{
									
									
		                            $this->form_validation->set_rules('property_situated_aust','property situated australia','required|callback_check_default');
		                            $this->form_validation->set_rules('company_carry_business_aus','company carry business australia','required|callback_check_default');
		                            $this->form_validation->set_rules('company_management_aus','company management australia','required|callback_check_default');
		                            $this->form_validation->set_rules('controlled_shareholders_aus','controlled shareholders australia','required|callback_check_default');
									
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('property_situated_aust'     => form_error('property_situated_aust'),
                                                           'company_carry_business_aus' => form_error('company_carry_business_aus'),
                                                           'company_management_aus'     => form_error('company_management_aus'),
                                                           'controlled_shareholders_aus'=> form_error('controlled_shareholders_aus')
                                             );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									}else{

                                           $vendordata   = $this->Common_model->insert_data('vendor_form',$data);
										   $company_data['id']= $this->db->insert_id();
										   $this->session->set_userdata('vendorId',$this->db->insert_id());
										   $this->Common_model->insert_data('vendor_company',$company_data);
										   $return  = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...'  );
                                         }	
								}  
							
						    }
	
						}elseif(!empty($vendortype== 3)){
							 
							if(!empty($this->session->userdata('vendorId'))){
								$vendorid = $this->session->userdata('vendorId');
							 }
							 if(!empty($vendorid)){
								 
							 $this->form_validation->set_rules('superannuation_fund','superannuation fund','required|callback_check_default');
		                            $this->form_validation->set_rules('fund_estab_asset_fund','fund estab asset fund','required|callback_check_default');
		                            $this->form_validation->set_rules('fund_control_aus','fund control australia','required|callback_check_default');
		                            $this->form_validation->set_rules('fund_have_any_member','fund have anymember','required|callback_check_default');
		                            $this->form_validation->set_rules('do_either_following_apply','do either following apply','required|callback_check_default');
									
		                             if($this->form_validation->run() == FALSE){
                                            $error = array('superannuation_fund'      => form_error('superannuation_fund'),
                                                           'fund_estab_asset_fund'    => form_error('fund_estab_asset_fund'),
                                                           'fund_control_aus'         => form_error('fund_control_aus'),
                                                           'fund_have_any_member'     => form_error('fund_have_any_member'),
                                                           'do_either_following_apply'=> form_error('do_either_following_apply')
                                             );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									}else{

                                             $where = array('user_id'=>$user_id,'id'=>$vendorid);	 
											 $this->Common_model->update_data('vendor_form',$where,$data); 
											 $this->Common_model->update_data('vendor_superfund',$where,$superfund_data);
										     $return  = array('status' =>true, 'message' => 'Your Information updated Sucessfuly ...');
										   
                                         }	
						 }else{
							 
							        $this->form_validation->set_rules('superannuation_fund','superannuation fund','required|callback_check_default');
		                            $this->form_validation->set_rules('fund_estab_asset_fund','fund estab asset fund','required|callback_check_default');
		                            $this->form_validation->set_rules('fund_control_aus','fund control australia','required|callback_check_default');
		                            $this->form_validation->set_rules('fund_have_any_member','fund have anymember','required|callback_check_default');
		                            $this->form_validation->set_rules('do_either_following_apply','do either following apply','required|callback_check_default');
									
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('superannuation_fund'      => form_error('superannuation_fund'),
                                                           'fund_estab_asset_fund'    => form_error('fund_estab_asset_fund'),
                                                           'fund_control_aus'         => form_error('fund_control_aus'),
                                                           'fund_have_any_member'     => form_error('fund_have_any_member'),
                                                           'do_either_following_apply'=> form_error('do_either_following_apply')
                                             );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
									}else{

                                            $vendordata   = $this->Common_model->insert_data('vendor_form',$data);
											$superfund_data['id']= $this->db->insert_id();
											$this->session->set_userdata('vendorId',$this->db->insert_id());
											  $this->Common_model->insert_data('vendor_superfund',$superfund_data);
											$return  = array('status' =>true, 'message' => 'Your Information Sucessfuly Added...' );
										   
                                         }	
							 
						    }
						
						 }else{
							 
							  $return  = array('status' =>false, 'message' =>'Some thing went wrong...');
							 
						     }
					  
            }

            echo json_encode($return);

		
	}
			public function submittedforms_delete($id='',$type='')
			{       
				  $where  = array('id'=>base64_decode($id));
				  $vendor_type = base64_decode($type);
				  if($vendor_type==1){
					  
				         $this->Common_model->delete_data('vendor_form',$where);
				         $this->Common_model->delete_data('vendor_trust',$where);
				  }elseif($vendor_type==2){
					  
					    $this->Common_model->delete_data('vendor_form',$where);
				        $this->Common_model->delete_data('vendor_company',$where);
					  
				  }elseif($vendor_type==3){
					  
					     $this->Common_model->delete_data('vendor_form',$where);
				         $this->Common_model->delete_data('vendor_superfund',$where);
						 
				}elseif($vendor_type==4){  
				
				   $this->Common_model->delete_data('vendor_form',$where);
				   $this->Common_model->delete_data('vendor_individual',$where);
				  
				}else{
					 $this->Common_model->delete_data('vendor_form',$where);
				}
				  
				  $return=array('status' => true, 'message' => 'Deleted Successfully');
				  echo json_encode($return);
			}
			
			public function viewsubmittedform($id='',$vendor_type='')
		    {
					$checkloggedin =	$this->AdminModel->checkloggedin();
						if($checkloggedin==0)
							{
								redirect("admin");
							}
					$data = array();
					$seo  = array();		
				    $id= base64_decode($id);
				    $vendor_type= base64_decode($vendor_type);
					
					$data['vendor_data']    =   $this->UserModel->vendor_fulldata($id,$vendor_type);
				    $data['vendortype']     =   $this->Common_model->select_data('vendor_type');	
					
					$seo['url']				=	site_url("admin/viewsubmittedform");
					$seo['title']			=	"View Form";
					$seo['metatitle']		=	"View Form";
					$seo['metadescription']	=	"View Form";
                    $data['data']['seo'] = $seo;
											
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/Admin/user/view_submittedform",$data );					
			}
			   public function pdfgenrate($id='',$vtype=''){
                  $id=base64_decode($id);
			      $vtype=base64_decode($vtype);
        	      $vendor_data    =   $this->UserModel->vendor_fulldata($id,$vtype);
				  $i= 0;
				  if(!empty($vendor_data)){
				  foreach($vendor_data as $l){
					
					$result  = $this->AdminModel->get_name_by_id($l->vendor_type, 'type_name');
					$vendor_data[$i]->type_name = $result->vendor_type;
					
					$i++;
				   } 
				 }else{}				
				  if(!empty($vendor_data[0]->residency_status_changed)){
				      if($vendor_data[0]->residency_status_changed==1){
				      	$residency_status_changed      = "Yes";
				      }else{ $residency_status_changed = "No";};
				   
                       }else{$residency_status_changed = "";}

                       if(!empty($vendor_data[0]->lodged_australian_tax)){
				      if($vendor_data[0]->lodged_australian_tax==1){
				      	$lodged_australian_tax      = "Yes";
				      }else{ $lodged_australian_tax = "No";};
				   
                       }else{ $lodged_australian_tax = "";}

				     if(!empty($vendor_data[0]->holding_property)){
				      if($vendor_data[0]->holding_property==1){
				      	$holding_property      = "Yes";
				      }else{ $holding_property = "No";};
				   
                       }else{$holding_property = ""; }
					   
                        if(!empty($vendor_data[0]->is_entity_australian_superannuation_fund)){
				      if($vendor_data[0]->is_entity_australian_superannuation_fund==1){
				      	$is_entitysuperfund      = "Yes";
				      }else{ $is_entitysuperfund = "No";};
				   
                       }else{$is_entitysuperfund = ""; }
					   
                      if(!empty($vendor_data[0]->fund_established_in_australia_or_is_any_asset_of_the_fund)){
				      if($vendor_data[0]->fund_established_in_australia_or_is_any_asset_of_the_fund==1){
				      	$fund_established_fund      = "Yes";
				      }else{ $fund_established_fund = "No";};
				   
                       }else{ $fund_established_fund = ""; }
                          
				       if(!empty($vendor_data[0]->fund_central_management_control_in_australia)){
				      if($vendor_data[0]->fund_central_management_control_in_australia==1){
				      	$fund_central_management_control_in_australia      = "Yes";
				      }else{ $fund_central_management_control_in_australia = "No";};
				   
                       }else{$fund_central_management_control_in_australia = ""; }
					   
				     if(!empty($vendor_data[0]->fund_have_any_member)){
				      if($vendor_data[0]->fund_have_any_member==1){
				      	$fund_have_any_member      = "Yes";
				      }else{ $fund_have_any_member = "No";};
				   
                       }else{$fund_have_any_member = ""; }
                  
				     if(!empty($vendor_data[0]->do_either_of_the_following_apply)){
				      if($vendor_data[0]->do_either_of_the_following_apply==1){
				      	$do_either_of_the_following_apply      = "Yes";
				      }else{ $do_either_of_the_following_apply = "No";};
				   
                       }else{ $do_either_of_the_following_apply = "";}
					   
					    if(!empty($vendor_data[0]->name_of_trustee)){
				        $name_of_trustee=$vendor_data[0]->name_of_trustee;
				      }else{ $name_of_trustee='';}; 
				   
				    if(!empty($vendor_data[0]->is_this_unit_trust)){
				      if($vendor_data[0]->is_this_unit_trust==1){
				      	$is_this_unit_trust      = "Yes";
				      }else{ $is_this_unit_trust = "No";};
				   
                       }else{$is_this_unit_trust = ""; }
					   
				     if(!empty($vendor_data[0]->any_property_of_the_trust_situated_in_australia)){
				      if($vendor_data[0]->any_property_of_the_trust_situated_in_australia==1){
				      	$any_property_of_the_trust_situated_in_australia      = "Yes";
				      }else{ $any_property_of_the_trust_situated_in_australia = "No";};
				   
                       }else{$any_property_of_the_trust_situated_in_australia = ""; }
					   
				   if(!empty($vendor_data[0]->trust_carry_on_business_in_australia)){
				      if($vendor_data[0]->trust_carry_on_business_in_australia==1){
				      	$trust_carry_on_business_in_australia      = "Yes";
				      }else{ $trust_carry_on_business_in_australia = "No";};
				   
                       }else{$trust_carry_on_business_in_australia = ""; }
                    
				     if(!empty($vendor_data[0]->trust_central_management_control)){
				      if($vendor_data[0]->trust_central_management_control==1){
				      	$trust_central_management_control      = "Yes";
				      }else{ $trust_central_management_control = "No";};
				   
                       }else{$trust_central_management_control = ""; }

                    if(!empty($vendor_data[0]->australian_resident_hold_more_than_50percent_beneficial_interes)){
				      if($vendor_data[0]->australian_resident_hold_more_than_50percent_beneficial_interes==1){
				      	$australian_resident_hold_more_than_50percent_beneficial_interes      = "Yes";
				      }else{ $australian_resident_hold_more_than_50percent_beneficial_interes = "No";};
				   
                       }else{ $australian_resident_hold_more_than_50percent_beneficial_interes = "";}
					   
                      if(!empty($vendor_data[0]->is_trustee_of_the_trust_australian_resident)){
				      if($vendor_data[0]->is_trustee_of_the_trust_australian_resident==1){
				      	$is_trustee_of_the_trust_australian_resident      = "Yes";
				      }else{ $is_trustee_of_the_trust_australian_resident = "No";};
				   
                       }else{$is_trustee_of_the_trust_australian_resident=''; }
					   
				     if(!empty($vendor_data[0]->is_trust_central_management_control_in_australia)){
				      if($vendor_data[0]->is_trustee_of_the_trust_australian_resident==1){
				      	$is_trust_central_management_control_in_australia      = "Yes";
				      }else{ $is_trust_central_management_control_in_australia = "No";};
				   
                       }else{ $is_trust_central_management_control_in_australia = "";}
					   
				    if(!empty($vendor_data[0]->is_company_incorporated_in_australia)){
				      if($vendor_data[0]->is_company_incorporated_in_australia==1){
				      	$is_company_incorporated_in_australia      = "Yes";
				      }else{ $is_company_incorporated_in_australia = "No";};
				   
                       }else{$is_company_incorporated_in_australia = ""; }
					   
                     if(!empty($vendor_data[0]->property_of_company_situated_in_australia)){
				      if($vendor_data[0]->property_of_company_situated_in_australia==1){
				      	$property_of_company_situated_in_australia      = "Yes";
				      }else{ $property_of_company_situated_in_australia = "No";};
				   
                       }else{ $property_of_company_situated_in_australia = "";}
					   
                      if(!empty($vendor_data[0]->does_the_company_carry_on_business_in_australia)){
				      if($vendor_data[0]->does_the_company_carry_on_business_in_australia==1){
				      	$does_the_company_carry_on_business_in_australia      = "Yes";
				      }else{ $does_the_company_carry_on_business_in_australia = "No";};
				   
                       }else{$does_the_company_carry_on_business_in_australia = ""; }
					   
                     if(!empty($vendor_data[0]->company_central_management_and_control_in_australia)){
				      if($vendor_data[0]->company_central_management_and_control_in_australia==1){
				      	$company_central_management_and_control_in_australia      = "Yes";
				      }else{ $company_central_management_and_control_in_australia = "No";};
				   
                       }else{$company_central_management_and_control_in_australia = ""; }
					   
                      if(!empty($vendor_data[0]->voting_power_controlled_shareholders_who_are_resident_in_aus)){
				      if($vendor_data[0]->voting_power_controlled_shareholders_who_are_resident_in_aus==1){
				      	$voting_power_controlled_shareholders_who_are_resident_in_aus      = "Yes";
				      }else{ $voting_power_controlled_shareholders_who_are_resident_in_aus = "No";};
				   
                       }else{ $voting_power_controlled_shareholders_who_are_resident_in_aus = "";}

                     if(!empty($vendor_data[0]->date_of_birth)){
				             $date_of_birth=$vendor_data[0]->date_of_birth;
				      	 }else{ 
						     $date_of_birth='';
						 }
						 
                      if(!empty($vendor_data[0]->migrating_settling_australia)){
				      if($vendor_data[0]->migrating_settling_australia==1){
				      	$migrating_settling_australia      = "Yes";
				      }else{ $migrating_settling_australia = "No";};
				   
                       }else{ $migrating_settling_australia = "";}
					   
                       if(!empty($vendor_data[0]->returning_live_australia)){
				      if($vendor_data[0]->returning_live_australia==1){
				      	$returning_live_australia      = "Yes";
				      }else{ $returning_live_australia = "No";};
				   
                       }else{ $returning_live_australia = "";}
                       
                       if(!empty($vendor_data[0]->employment_contract_permanent_employment)){
				      if($vendor_data[0]->employment_contract_permanent_employment=='true'){
				      	$employment_contract_permanent_employment      = "Checked";
				      }else{ $employment_contract_permanent_employment = "";};
				   
                       }else{ }
				   
                    if(!empty($vendor_data[0]->exchange_program)){
				      if($vendor_data[0]->exchange_program=='true'){
				      	$exchange_program      = "Checked";
				      }else{ $exchange_program = "";};
				   
                       }else{ }
                       if(!empty($vendor_data[0]->full_time_education)){
				      if($vendor_data[0]->full_time_education=='true'){
				      	$full_time_education      = "Checked";
				      }else{ $full_time_education = "";};
				   
                       }else{ }
                       if(!empty($vendor_data[0]->holidaying_or_casual_employmen)){
				      if($vendor_data[0]->holidaying_or_casual_employmen=='true'){
				      	$holidaying_or_casual_employmen      = "Checked";
				      }else{ $holidaying_or_casual_employmen = "";};
				   
                       }else{ }
                        if(!empty($vendor_data[0]->visiting_friends_or_relatives)){
				      if($vendor_data[0]->visiting_friends_or_relatives=='true'){
				      	$visiting_friends_or_relatives      = "Checked";
				      }else{ $visiting_friends_or_relatives = "";};
				   
                       }else{ }
                      if(!empty($vendor_data[0]->other)){
				      if($vendor_data[0]->other=='true'){
				      	     $other      = "Checked";
				      }else{ $other = "";};
				   
                       }else{ }
					   
                     if(!empty($vendor_data[0]->have_you_stayed_or_do_you_intend_stay)){
				      if($vendor_data[0]->have_you_stayed_or_do_you_intend_stay==1){
				      	$have_you_stayed_or_do_you_intend_stay      = "Yes";
				      }else{ $have_you_stayed_or_do_you_intend_stay = "No";};
				   
                       }else{ $have_you_stayed_or_do_you_intend_stay=''; }
					   
                     if(!empty($vendor_data[0]->live_in_australia_family_friends)){
				      if($vendor_data[0]->live_in_australia_family_friends=='true'){
				      	$live_in_australia_family_friends      = "Checked";
				      }else{ $live_in_australia_family_friends = "";};
				   
                       }else{ $live_in_australia_family_friends = "";}
					   
                     if(!empty($vendor_data[0]->live_in_australia_hotel_motel)){
				      if($vendor_data[0]->live_in_australia_hotel_motel=='true'){
				      	$live_in_australia_hotel_motel      = "Checked";
				      }else{ $live_in_australia_hotel_motel = "";};
				   
                       }else{  $live_in_australia_hotel_motel = "";}
					   
                      if(!empty($vendor_data[0]->live_in_australia_university_campus)){
				      if($vendor_data[0]->live_in_australia_university_campus=='true'){
				      	$live_in_australia_university_campus      = "Checked";
				      }else{ $live_in_australia_university_campus = "";};
				   
                       }else{ $live_in_australia_university_campus = "";}
					   
                      if(!empty($vendor_data[0]->live_in_australia_own_buying_home)){
				      if($vendor_data[0]->live_in_australia_own_buying_home=='true'){
				      	$live_in_australia_own_buying_home      = "Checked";
				      }else{ $live_in_australia_own_buying_home = "";};
				   
                       }else{$live_in_australia_own_buying_home = ""; }
					   
                      if(!empty($vendor_data[0]->live_in_australia_renting_leasing_accommodation)){
				      if($vendor_data[0]->live_in_australia_renting_leasing_accommodation=='true'){
				      	$live_in_australia_renting_leasing_accommodation      = "Checked";
				      }else{ $live_in_australia_renting_leasing_accommodation = "";};
				   
                       }else{$live_in_australia_renting_leasing_accommodation = ""; }
					   
                     if(!empty($vendor_data[0]->spouse_dependant_children)){
				      if($vendor_data[0]->spouse_dependant_children==1){
				      	$spouse_dependant_children      = "Yes";
				      }else{ $spouse_dependant_children = "No";};
				   
                       }else{$spouse_dependant_children = ""; }
					   
                      if(!empty($vendor_data[0]->currently_living_with_you)){
				      if($vendor_data[0]->currently_living_with_you=='true'){
				      	$currently_living_with_you      = "Checked";
				      }else{ $currently_living_with_you = "";};
				   
                       }else{ $currently_living_with_you = "";}
					   
                     if(!empty($vendor_data[0]->remaining_overseas)){
				      if($vendor_data[0]->remaining_overseas=='true'){
				      	$remaining_overseas      = "Checked";
				      }else{ $remaining_overseas = "";};
				   
                       }else{$remaining_overseas = "";}
					   
                     if(!empty($vendor_data[0]->coming_to_live_with_you)){
				      if($vendor_data[0]->coming_to_live_with_you=='true'){
				      	$coming_to_live_with_you      = "Checked";
				      }else{ $coming_to_live_with_you = "";};
				   
                       }else{$coming_to_live_with_you = "";} 

                     if(!empty($vendor_data[0]->some_with_you_and_remaining_overseas)){
				      if($vendor_data[0]->some_with_you_and_remaining_overseas=='true'){
				      	$some_with_you_and_remaining_overseas      = "Checked";
				      }else{ $some_with_you_and_remaining_overseas = '';};
				   
                       }else{ $some_with_you_and_remaining_overseas = "";}
					   
                     if(!empty($vendor_data[0]->hold_majority_of_your_assets)){
				      if($vendor_data[0]->hold_majority_of_your_assets==1){
				      	$hold_majority_of_your_assets      = "Yes";
				      }else{ $hold_majority_of_your_assets = "No";};
				   
                       }else{ $hold_majority_of_your_assets = "";}
					   
                     if(!empty($vendor_data[0]->are_you_member_of_any_clubs_churches_community)){
				      if($vendor_data[0]->are_you_member_of_any_clubs_churches_community==1){
				      	$are_you_member_of_any_clubs_churches_community      = "Yes";
				      }else{ $are_you_member_of_any_clubs_churches_community = "No";};
				   
                       }else{ $are_you_member_of_any_clubs_churches_community = "";}
					   
                     if(!empty($vendor_data[0]->have_you_stayed_or_do_you_intend_stay_australia_six_month)){
				      if($vendor_data[0]->have_you_stayed_or_do_you_intend_stay_australia_six_month==1){
				      	$have_you_stayed_or_do_you_intend_stay_australia_six_month      = "Yes";
				      }else{ $have_you_stayed_or_do_you_intend_stay_australia_six_month = "No";};
				   
                       }else{ $have_you_stayed_or_do_you_intend_stay_australia_six_month = "";}
                     if(!empty($vendor_data[0]->social_or_economic_ties_to_country)){
				      if($vendor_data[0]->social_or_economic_ties_to_country==1){
				      	$social_or_economic_ties_to_country      = "Yes";
				      }else{ $social_or_economic_ties_to_country = "No";};
				   
                       }else{$social_or_economic_ties_to_country=''; } 
					   if(!empty($vendor_data[0]->australia_either_continue_intermittently_183day)){
							
					    if($vendor_data[0]->australia_either_continue_intermittently_183day==1){

						 $australia_either_continue_intermittently_183day      = "Yes";
						}else{ $australia_either_continue_intermittently_183day = "No";};
						}else{ $australia_either_continue_intermittently_183day = "";} 
					   
					if(!empty($vendor_data[0]->place_of_abode_outside_australia)){
					  if($vendor_data[0]->place_of_abode_outside_australia==1){
						$place_of_abode_outside_australia      = "Yes";
					  }else{ $place_of_abode_outside_australia = "No";};
				   
					   }else{$place_of_abode_outside_australia = ""; }

					  if(!empty($vendor_data[0]->intend_to_takeup_residence_in_australia)){
					  if($vendor_data[0]->intend_to_takeup_residence_in_australia==1){
							 $intend_to_takeup_residence_in_australia = "Yes";
					  }else{ $intend_to_takeup_residence_in_australia = "No"; }
				      }else{ $intend_to_takeup_residence_in_australia = "";}
								 
                     
					      //echo "<pre>";print_r($vendor_data);die;
        	                 require FCPATH.'pdf/tcpdf_import.php';
             

							// create new PDF document
							$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

							// set document information
							
							$pdf->SetCreator(PDF_CREATOR);
							$pdf->SetTitle('ONLINE FORM PDF');
							
							// set default header data
							//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

							// set header and footer fonts
							$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
							$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

							// set default monospaced font
							$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

							// set margins
							$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
							$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
							$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

							// set auto page breaks
							$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

							// set image scale factor
							$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

							// set some language-dependent strings (optional)
							if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
							    require_once(dirname(__FILE__).'/lang/eng.php');
							    $pdf->setLanguageArray($l);
							}

							// set font
							$pdf->SetFont('helvetica', '', 10);

							// set font
							$pdf->SetFont('helvetica', '', 10, '', false);
                         //$pdf->SetMargins(30, 20, 10, true);
							// add a page
							$pdf->AddPage();
                         
							$html='<h1>FRCGW Clearance Certificate </h1><br></br>'; 
							$pdf->writeHTML($html, true, false, true, false, '');
							 $pdf->SetMargins(30, 30, 10, true);
						 $html= '<h2>Vendor details</h2><div>
							<label for="tax">Tax File Number:</label> 
							<span> '.$vendor_data[0]->tax_file_no.'</span></div><br>
							<div><label for="abn">ABN:</label> 
							<span> '.$vendor_data[0]->abn_no.'</span></div><br>
							<div><label for="name">Full Name:</label> 
							<span> '.$vendor_data[0]->full_name.'</span></div><br>
							<div><label for="name">Vendor Type :</label> 
							<span> '.$vendor_data[0]->type_name.'</span></div><br />
							<div><label for="name">Email address of vendor:</label> 
							<span> '.$vendor_data[0]->email_address.'</span></div><br />
							<div><label for="name">Phone number of the vendor :</label> 
							<span> '.$vendor_data[0]->phone_no.'</span></div><br />
							<div><label for="name">Address of vendor:</label> 
							<span> '.$vendor_data[0]->address_of_vendor.'</span></div><br />
							

							<h2>Transaction dates</h2> 
                             <div><label for="name">Contract date:</label> 
							<span> '.$vendor_data[0]->contact_date.'</span></div><br />
							<div><label for="name">Expected settlement date:</label> 
							<span> '.$vendor_data[0]->expected_date.'</span></div><br />

							<h2>Clearance certificate application questions</h2>

							<div><label for="name">Has your residency status changed since your last tax return or will it change before you sell the asset?:</label> 
							<span> '.$residency_status_changed.'</span></div><br />
                               
							<div><label for="name"> Have you lodged an Australian tax return for the last two years?:</label> 
							<span> '.$lodged_australian_tax.'</span></div><br />
							<div><label for="name"> Are you holding the property on behalf of a foreign resident or on behalf of other entities that include foreign resident?:</label> 
							<span> '.$holding_property.'</span></div><br /> '; 
						
							$pdf->writeHTML($html, true, false, true, false, '');
							 if($vtype==1){
                              $pdf->SetMargins(20, 25, 10, true);
							  $html='<br><br><br><br><br><br><h2>Vendor Type</h2>';
							  $pdf->writeHTML($html, true, false, true, false, '');
							  $pdf->SetMargins(30, 30, 10, true);
							  $html='<br><h4>Trust</h4><br>';
							  $pdf->writeHTML($html, true, false, true, false, '');
							  
							 $html='<div><label for="name"> name of trustee:</label> 
							<span> '.$name_of_trustee.'</span></div><br />';
							  $pdf->writeHTML($html, true, false, true, false, '');
							
							$html='<div><label for="name"> Is this a unit trust?:</label> 
							<span> '.$is_this_unit_trust.'</span></div><br />';
							 $pdf->writeHTML($html, true, false, true, false, '');
                             if(!empty($vendor_data[0]->is_this_unit_trust==1)){
							if(!empty($any_property_of_the_trust_situated_in_australia)){
                           $html='<div><label for="name">Is any of the property of the trust situated in Australia? :</label> 
							<span> '.$any_property_of_the_trust_situated_in_australia.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
							 }
							 if(!empty($trust_carry_on_business_in_australia)){
                            $html='<div><label for="name">Does the trust carry on a business in Australia?:</label> 
							<span> '.$trust_carry_on_business_in_australia.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
							 }
							if(!empty($trust_central_management_control)){
                           $html='<div><label for="name">Is the trusts central management & control in Australia? :</label> 
							<span> '.$trust_central_management_control.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
							}
							if(!empty($australian_resident_hold_more_than_50percent_beneficial_interes)){
							$html='<div><label for="name">Do Australian residents hold more than 50% of the beneficial interests in the income or property of the trust? :</label> 
							<span> '.$australian_resident_hold_more_than_50percent_beneficial_interes.'</span></div><br />';
							     $pdf->writeHTML($html, true, false, true, false, '');
							}	 
							 }else{ 
								 if(!empty($is_trustee_of_the_trust_australian_resident)){
								$html='<div><label for="name">Is the trustee of the trust an Australian resident?  :</label> 
								<span> '.$is_trustee_of_the_trust_australian_resident.'</span></div><br />';
								  $pdf->writeHTML($html, true, false, true, false, '');
								 }
								 if(!empty($is_trust_central_management_control_in_australia)){
								$html='<div><label for="name">Is the trusts central management & control in Australia? :</label> 
								<span> '.$is_trust_central_management_control_in_australia.'</span></div><br />
								<br /><br /><br />';
							     $pdf->writeHTML($html, true, false, true, false, '');
							  }
							 }
							
							
                            }elseif($vtype==2){
								
                              $pdf->SetMargins(20, 25, 10, true);
							  $html='<br><br><br><br><br><br><h2>Vendor Type</h2> <br> ';
							  $pdf->writeHTML($html, true, false, true, false, '');
							  $pdf->SetMargins(30, 30, 10, true);
							
							$html ='<br><h4>Company</h4>
                            <div><label for="name">Is the company incorporated in Australia?:</label> 
							<span> '.$is_company_incorporated_in_australia.'</span></div><br />';
						       $pdf->writeHTML($html, true, false, true, false, ''); 
                           if(!empty($vendor_data[0]->is_company_incorporated_in_australia==2)){
                          
						   if(!empty($property_of_company_situated_in_australia)){
						   $html ='<div><label for="name">Is any of the property of the company situated in Australia?:</label> 
							<span> '.$property_of_company_situated_in_australia.'</span></div><br />';
							          $pdf->writeHTML($html, true, false, true, false, '');
								}
							 if(!empty($does_the_company_carry_on_business_in_australia)){	
						   $html ='<div><label for="name">Does the company carry on business in Australia?:</label> 
							<span> '.$does_the_company_carry_on_business_in_australia.'</span></div><br>';
							          $pdf->writeHTML($html, true, false, true, false, '');  
                             } 
							  if(!empty($company_central_management_and_control_in_australia)){	
                           $html ='<div><label for="name">Is the companys central management and control in Australia?:</label> 
							  <span> '.$company_central_management_and_control_in_australia.'</span></div><br />';
							          $pdf->writeHTML($html, true, false, true, false, '');     
							}
							if(!empty($voting_power_controlled_shareholders_who_are_resident_in_aus)){	
                           $html = '<div>
							<label for="name">Is the companys voting power controlled by shareholders who are resident in Australia?:</label> 
							<span> '.$voting_power_controlled_shareholders_who_are_resident_in_aus.'</span></div><br /> ';
							         $pdf->writeHTML($html, true, false, true, false, '');}
							
						   }else{}
							

                            
                            }elseif($vtype==3){
							
                         	  $pdf->SetMargins(20, 25, 10, true);
							  $html='<br><br><br><br><br><br><h2>Vendor Type</h2>';
							  $pdf->writeHTML($html, true, false, true, false, '');
							  $pdf->SetMargins(30, 30, 10, true);
							$html='<br><h4>Super fund</h4>
                            <div><label for="name"> Is the entity an Australian Superannuation Fund?:</label> 
							<span> '.$is_entitysuperfund.'</span></div><br />
                          
                           <div><label for="name">Was the fund established in Australia or is any asset of the fund situated in Australia? :</label> 
							<span> '.$fund_established_fund.'</span></div><br />
                            <div><label for="name"> Is the funds central management & control in Australia?:</label> 
							<span> '.$fund_central_management_control_in_australia.'</span></div> 
                           <div><label for="name">Does the fund have any member/s who were either?:</label> 
							<span> '.$fund_have_any_member.'</span></div><br />
                            <div><label for="name">Do either of the following apply? :</label> 
							<span> '.$do_either_of_the_following_apply.'</span></div><br />';
							
							$pdf->writeHTML($html, true, false, true, false, '');

					 }elseif($vtype==4){

                          $pdf->SetMargins(20, 25, 10, true);
                          $html='<br><br><br><br><br><br><h2>Vendor Type</h2>';
						  $pdf->writeHTML($html, true, false, true, false, '');
					      $pdf->SetMargins(30, 30, 10, true);
                          $html= '<br><h4>Individual</h4><br>
                            <div><label >Date of birth:</label> 
							<span> '.$date_of_birth.'</span></div><br />';
                           $pdf->writeHTML($html, true, false, true, false, '');
                          $html='<div><label>1. Are you migrating and settling in Australia or have been settled in Australia?:</label> 
							<span> '.$migrating_settling_australia.'</span></div><br />';
							 $pdf->writeHTML($html, true, false, true, false, '');
							if(!empty($vendor_data[0]->migrating_settling_australia==2)){
							if(!empty($vendor_data[0]->returning_live_australia==1)){		
							if(!empty($returning_live_australia)){
                          $html='<div><label >2. Are you an Australian returning to live in Australia? :</label> 
						  <span> '.$returning_live_australia.'</span></div> <br>
						   <div> <label><b>2.1 is your main purpose for being in Australia</b></label></div> <br>';
							 $pdf->writeHTML($html, true, false, true, false, '');
						  }
                            if(!empty($employment_contract_permanent_employment)){
							$html='<div><label >Employment contract or permanent employment :</label> 
							<span> '.$employment_contract_permanent_employment.'</span></div><br />';
							 $pdf->writeHTML($html, true, false, true, false, '');
						  }
						   if(!empty($exchange_program)){
                           $html='<div><label >Exchange program or full time research :</label> 
							<span> '.$exchange_program.'</span></div><br />';
							 $pdf->writeHTML($html, true, false, true, false, '');
						  }
						   if(!empty($full_time_education)){
                          $html=' <div><label >Full time education:</label> 
							<span> '.$full_time_education.'</span></div><br />';
								 $pdf->writeHTML($html, true, false, true, false, '');
						  }
						   if(!empty($holidaying_or_casual_employmen)){
                           $html='<div><label f>Holidaying or casual employmen :</label> 
							<span> '.$holidaying_or_casual_employmen.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						  }
						   if(!empty($visiting_friends_or_relatives)){
                           $html='<div><label >Visiting friends or relatives :</label> 
							<span> '.$visiting_friends_or_relatives.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						  }
						  if(!empty($vendor_data[0]->other=='true')){
						  if(!empty($other)){
                           $html='<div><label >2.1.1Other:</label> 
							<span> '.$other.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						  }
						  if(!empty($have_you_stayed_or_do_you_intend_stay)){
                           $html='<div><label >2.1.1.1 Have you stayed or do you intend to stay in a particular place continuously for six months or more?  :</label> </div>
                         <span> '.$have_you_stayed_or_do_you_intend_stay.'</span></div>';
							$pdf->writeHTML($html, true, false, true, false, '');
						  }  
						    $html='<span> 2.1.1.2 Where do you live in Australia? </span><br />'; 
							 $pdf->writeHTML($html, true, false, true, false, '');
							if(!empty($live_in_australia_family_friends)){
                           $html='<div><label >Staying with family, friends :</label> 
							<span> '.$live_in_australia_family_friends.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						  }
						  if(!empty($live_in_australia_hotel_motel)){
                           $html='<div><label >Hotel, motel, hostel or caravan :</label> 
							<span> '.$live_in_australia_hotel_motel.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						  }
						  if(!empty($live_in_australia_university_campus)){
                           $html='<div><label >University campus :</label> 
							<span> '.$live_in_australia_university_campus.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						  }
						  if(!empty($live_in_australia_own_buying_home)){
                           $html='<div><label >Own or buying a home :</label> 
							<span> '.$live_in_australia_own_buying_home.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						  }
                            if(!empty($live_in_australia_renting_leasing_accommodation)){
						   $html='<div><label >Renting or leasing accommodation :</label> 
							<span> '.$live_in_australia_renting_leasing_accommodation.'</span></div><br />';
						    $pdf->writeHTML($html, true, false, true, false, '');
							 $pdf->SetMargins(30, 25, 10, true);
							}
						   
                            if(!empty($spouse_dependant_children)){
							$html='<div><label>2.1.1.3 Do you have a spouse and/or dependant children?:</label> 
							<span> '.$spouse_dependant_children.'</span></div><br />';
						    $pdf->writeHTML($html, true, false, true, false, '');
							$pdf->SetMargins(30, 30, 10, true);
							
							}
                        $html='<h4>Where are your spouse and/or dependent children?</h4></br>';
					         $pdf->writeHTML($html, true, false, true, false, '');
					      if(!empty($currently_living_with_you)){
                              $html='<div><label >Currently living with you :</label> 
							<span> '.$currently_living_with_you.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						   }
							if(!empty($remaining_overseas)){
                           $html='<div><label >Remaining overseas :</label> 
							<span> '.$remaining_overseas.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						   }
							if(!empty($coming_to_live_with_you)){
                           $html='<div><label >Coming to live with you:</label> 
							<span> '.$coming_to_live_with_you.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						   }
							if(!empty($some_with_you_and_remaining_overseas)){
                           $html='<div><label >Some with you and some remaining overseas:</label> 
							<span> '.$some_with_you_and_remaining_overseas.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						   }
							if(!empty($hold_majority_of_your_assets)){
                           $html='<div><label >2.1.1.4 Where do you hold the majority of your assets? *:</label> 
							<span> '.$hold_majority_of_your_assets.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						   }
							  if(!empty($are_you_member_of_any_clubs_churches_community)){
                           $html='<div><label >2.1.1.5 Are you a member of any clubs, churches community groups or organisations in Australia?:</label> 
							<span> '.$are_you_member_of_any_clubs_churches_community.'</span></div><br />';
							$pdf->writeHTML($html, true, false, true, false, '');
						   }
						 } 
						}else{  
								if(!empty($have_you_stayed_or_do_you_intend_stay_australia_six_month)){
							   $html='<div><label >2.2 Have you stayed or do you intend to stay in Australia for six months or more? :</label> 
								<span> '.$have_you_stayed_or_do_you_intend_stay_australia_six_month.'</span></div><br />';
								$pdf->writeHTML($html, true, false, true, false, '');
							   }
							   if(!empty($social_or_economic_ties_to_country)){
							   $html='<div><label >2.3 Do you have social or economic ties to a country other than Australia?  :</label> 
								<span> '.$social_or_economic_ties_to_country.'</span></div><br />';
								$pdf->writeHTML($html, true, false, true, false, '');
							   }
							}
							if(!empty($australia_either_continue_intermittently_183day)){
							$html=' <div><label for="name">3 Have you been in Australia, either continuously or intermittently, for 183 days or more in the current income year? :</label> 
							<span> '.$australia_either_continue_intermittently_183day.'</span></div>';
							 $pdf->writeHTML($html, true, false, true, false, '');
							 }
							 if(!empty($place_of_abode_outside_australia)){
							$html='<div><label >3.1 Is your usual place of abode outside of Australia? :</label> 
						    <span> '.$place_of_abode_outside_australia.'</span></div><br />';
							  $pdf->writeHTML($html, true, false, true, false, '');
							 }
							if(!empty($intend_to_takeup_residence_in_australia)){
                          	$html='<div><label 3.1.1 Do you intend to take up residence in Australia?  :</label> 
						    <span> '.$intend_to_takeup_residence_in_australia.'</span></div> ';
						    $pdf->writeHTML($html, true, false, true, false, '');
							}
                          
							  
					  }else{
						     if(!empty($australia_either_continue_intermittently_183day)){
							$html=' <div><label for="name">3 Have you been in Australia, either continuously or intermittently, for 183 days or more in the current income year? :</label> 
							<span> '.$australia_either_continue_intermittently_183day.'</span></div><br/>';
							 $pdf->writeHTML($html, true, false, true, false, '');
							 }
							 if(!empty($place_of_abode_outside_australia)){
							$html='<div><label >3.1 Is your usual place of abode outside of Australia? :</label> 
						    <span> '.$place_of_abode_outside_australia.'</span></div><br/>';
							  $pdf->writeHTML($html, true, false, true, false, '');
							 }
							if(!empty($intend_to_takeup_residence_in_australia)){
                          	$html='<br><div><label 3.1.1 Do you intend to take up residence in Australia?  :</label> 
						    <span> '.$intend_to_takeup_residence_in_australia.'</span></div> ';
						    $pdf->writeHTML($html, true, false, true, false, '');
							}
						}   		  
					      	
					}else{ 

					}	
							//Close and output PDF document
							$pdf->Output('vendorform.pdf', 'I');


        }

			
			public function changepassword()
		    {
					$checkloggedin =	$this->AdminModel->checkloggedin();
						if($checkloggedin==0)
							{
								redirect("admin");
							}
					$data = array();
					$seo  = array();		
				    $adminid 			    = $this->session->userdata('token');
					$id 			        = base64_decode($adminid);
					$where                  = array('admin_id'=>$id);
					$data['profile_data']   = $this->Common_model->select_data('admin',$where);		
					
					$seo['url']				=	site_url("admin/changepassword");
					$seo['title']			=	"Change Password";
					$seo['metatitle']		=	"Change Password";
					$seo['metadescription']	=	"Change Password";
                    $data['data']['seo'] = $seo;
											
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/Admin/settings/changepassword",$data );					
			}
			 public function adminprofile_update() 
        {
               $adminid 			    = $this->session->userdata('token');
			   $id 			           = base64_decode($adminid); 
			 
				  $this->form_validation->set_error_delimiters('<p class="text text-danger error">', '</p>');
				  $this->form_validation->set_rules('fullname','fullname ', 'trim|required');
				  $this->form_validation->set_rules('email','email','trim|required|valid_email');
				  $this->form_validation->set_rules('contact_no','Phone','trim|required');
				
		  
			 if($this->form_validation->run() == FALSE)
			 {
			
				$error = array(
							'fullname'      => form_error('fullname'),
							 'email'        => form_error('email'),
					 		'contact_no'    => form_error('contact_no')
							 );
			
				$return=array('status' => false, 'message' => 'All fields are required', 'data' => $error);
			}
		
		  
		 else{
	 		  $data= array(
									'fullname'      =>  $this->input->post('fullname'),
									'email'         => $this->input->post('email'),
									'contact_no'    => $this->input->post('contact_no')
									);
									
								$adminid 			    = $this->session->userdata('token');
								$id 			        = base64_decode($adminid);
								$where                  = array('admin_id'=>$id);
											 
								$stat=$this->Common_model->update_data('admin',$where,$data);
								if($stat == true){
								  $return = array(
										"status" => TRUE,
										"message" => 'Profile updated successfully...',
										"data" =>$stat
									);
								
								}else{
									$return = array(
										"status" => false,
										"message" => '<i class="fa fa-times"></i> Oh Snap! Something went wrong.',
										"data" =>''
									);
								
								} 
           }
			  echo json_encode($return);
	
	   } 
            /****
			    subadmin function  start 
			
			**/
			
				public function view_allocateforms_subadmin()
			{
					$checkloggedin =	$this->AdminModel->checkloggedin();
						if($checkloggedin==0)
							{
								redirect("admin");
							}
					
					$adminid 			    = $this->session->userdata('token');
					$id 			        = base64_decode($adminid);
					
				    $data['vendordata'] = $this->AdminModel->vendordata_subadmin($id);	
					


					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/subadmin/view_allocate_forms",$data);					
			} 
			
				public function allocateforms_delete($id='',$type='')
			{       
				  $where  = array('id'=>base64_decode($id));
				  $vendor_type = base64_decode($type);
				  if($vendor_type==1){ 
					  
				         $this->Common_model->delete_data('vendor_form',$where);
				         $this->Common_model->delete_data('allocate_form',$where);
				         $this->Common_model->delete_data('vendor_trust',$where);
				  }elseif($vendor_type==2){
					  
					    $this->Common_model->delete_data('vendor_form',$where);
						 $this->Common_model->delete_data('allocate_form',$where);
				        $this->Common_model->delete_data('vendor_company',$where);
					  
				  }elseif($vendor_type==3){
					  
					     $this->Common_model->delete_data('vendor_form',$where);
						  $this->Common_model->delete_data('allocate_form',$where);
				         $this->Common_model->delete_data('vendor_superfund',$where);
						 
				}elseif($vendor_type==4){  
				
				   $this->Common_model->delete_data('vendor_form',$where);
				   $this->Common_model->delete_data('allocate_form',$where);
				   $this->Common_model->delete_data('vendor_individual',$where);
				  
				}else{
					 $this->Common_model->delete_data('vendor_form',$where);
				}
				  
				  $return=array('status' => true, 'message' => 'Deleted Successfully');
				  echo json_encode($return);
			}
			public function allocateform_another_subadmin()
			{
					$checkloggedin =	$this->AdminModel->checkloggedin();
					if($checkloggedin==0)
					{
								redirect("admin");
					}
					$data = array(); 
					$seo  = array();	
					$adminid 			    = $this->session->userdata('token');
					$id 			        = base64_decode($adminid);
				    $list                   =   $this->AdminModel->anothersubadmin_vendordata($id);	
				    $data['totalsubadmin']  =   $this->Common_model->select_data('admin',array('admin_id !='=> $id,'logintype'=>2));	
				    $i= 0; 
			if(!empty($list)){
				  foreach($list as $l){
					
					$c  = $this->AdminModel->get_name_by_id($l->vendor_type, 'type_name');
					$list[$i]->type_name = $c->vendor_type;
					$i++;
				  } 
				}else{}
					$data['vendor_data']    =   $list;
					$seo['url']				=	site_url("admin/allocateform_another_subadmin");
					$seo['title']			=	"Allocate form another subadmin";
					$seo['metatitle']		=	"Allocate form another subadmin";
					$seo['metadescription']	=	"Allocate form another subadmin";

				    $data['data']['seo'] = $seo;					
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/subadmin/allocateform_anothersubadmin",$data);					
			}
		public function allocateform_another_subadmin_action()
      {
					$this->form_validation->set_error_delimiters('<p class="text text-danger error">', '</p>');
					$this->form_validation->set_rules('subadmin_data','subadmin ', 'trim|required');
				  
				 if($this->form_validation->run() == FALSE)
				 {
				
				  $error = array(
						 'subadmin_data' => form_error('subadmin_data')
						);
				
				  $return=array('status' => false, 'message' => 'All fields are required', 'data' => $error);
				} 
			  else
			  {
				
				  $data = array();
				  $adminid 			    = $this->session->userdata('token');
				  $id 			        = base64_decode($adminid);
				  $subadmin_id          = $this->input->post('subadmin_data');
				  $vendor_id            = $this->input->post('vendor_id');
				  $vendordata           = $this->Common_model->select_data('allocate_form',array('subadmin_id'=>$subadmin_id));
				 
                  if(!empty($vendor_id && $subadmin_id))
				  {
					  if(!empty($vendordata))
					  { 
					    foreach($vendor_id as $data)
										   {
											  $datas=array('vendor_id'=>$data,'subadmin_id'=>$subadmin_id,'allocate_by'=>$id);
											  $this->Common_model->insert_data('allocate_form',$datas);
											  $this->Common_model->insert_data('assign_subadmin',$datas);
											  $where=array('subadmin_id'=>$id,'vendor_id'=>$data);
											  $this->Common_model->delete_data('assign_subadmin',$where);
										   }
								   $return=array('status' => true, 'message' => 'Saved successully....'); 
							   
						}else{ 
							   

										foreach($vendor_id as $data)
										   {
											  $datas=array('vendor_id'=>$data,'subadmin_id'=>$subadmin_id,'allocate_by'=>$id);
											  $this->Common_model->insert_data('allocate_form',$datas);
											  $this->Common_model->insert_data('assign_subadmin',$datas);
											  $where=array('subadmin_id'=>$id,'vendor_id'=>$data);
											  $this->Common_model->delete_data('assign_subadmin',$where);
										   }
										 $return=array('status' => true, 'message' => 'Saved successully....'); 
									  
							 }
						
				 
				   }else{

							 $return=array('status' => false, 'message' => 'Something went wrong....'); 
						}
					
			}
					echo json_encode($return);
        
      }
		  public function allocateform_another_subadmin_selected($id='')
		  {
			    $data=array();
				$where=array('subadmin_id'=>$id);
				  $info=$this->Common_model->select_data('allocate_form',$where);
				  foreach($info as $targetvalue){

					$data[]=$targetvalue->vendor_id;
				  }
			  
			   
				$return=array('status' => true, 'message' => 'Saved successully....', 'data' => $data);
			
				echo json_encode($return);
			
		  } 
               public function listallocateform_anothersubadmin()
			{
					$checkloggedin =	$this->AdminModel->checkloggedin();
					if($checkloggedin==0)
					{
								redirect("admin");
					}
					$data = array();
					$seo  = array();		
				    $adminid 			    =  $this->session->userdata('token');
					$id 			        =  base64_decode($adminid);
				   $list                    =  $this->AdminModel->list_allocateform_subadmin($id);	
				   if(!empty($list)){
				   $i= 0;
				foreach($list as $l){
					
					$c  = $this->AdminModel->get_name_by_id($l->vendor_type, 'type_name');
					$list[$i]->type_name = $c->vendor_type;
					
					$i++;
				} 
				   }else{ }
					$data['subadmin_data']  =   $list;
					$seo['url']				=	site_url("admin/registereduser_list");
					$seo['title']			=	"Allocate form subadmin";
					$seo['metatitle']		=	"Allocate form subadmin";
					$seo['metadescription']	=	"Allocate form subadmin";

				    $data['data']['seo'] = $seo;					
					$data['layout'] = $this->adminLayout($data);
					$this->load->view("back/subadmin/list_allocateform_anothersubadmin",$data);					
			}
			
			public function allocateform_anothersubadmin_delete($id='')
			{       
				  $where  = array('vendor_id'=>base64_decode($id));
				  $result=$this->Common_model->delete_data('allocate_form',$where);
				  if($result==1){
				  $return  = array('status' =>true, 'message' => 'Deleted sucessfuly ...' ,'data'=>$result);
				  }
				echo json_encode($return);
						 
		    }		  
			
			public function logout()
				{
					$this->session->sess_destroy();
					header("Location: ".site_url("admin"));
				}
			
	}
?>