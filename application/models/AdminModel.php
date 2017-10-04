<?php

Class AdminModel extends CI_Model
		{
	
	public function checkpostinput($index)
	{
					$return = $this->input->post($index);
					$return = $this->security->xss_clean($return);
					return trim($return); 
	}				
	public function checkgetinput($index)
	{
					$return = $this->input->get($index);
					$return = $this->security->xss_clean($return);
					return trim($return); 
	}	
							
	public function index()
	{	
						$data['status']		=	1;
						$data['message']	=	"We got YOur request.";
						return json_encode($data);
	}
				
	public function checkloggedin()
	{
					if($this->session->userdata('token') && $this->session->userdata('adminname') && $this->session->userdata('logintype'))
						{
							$token			=	$this->session->userdata('token');
							$adminname		=	$this->session->userdata('adminname');
							$logintype		=	$this->session->userdata('logintype');
								// if(trim($logintype)=="admin")
								if(trim($logintype)!="")
									{
										return 1;
									} else {
										return 0;
									}
						} else {
							return 0;
						}
	}	
		
	public function adminlogin()
	{	
					$data = array();
					$data['refresh']	=	0;
					$email		=	$this->checkpostinput('email');
					$password	=	$this->checkpostinput('password');				 
					if($email=="")
					{
						$data['status']		=	0;
						$data['message']	=	"email is not correct";
						return json_encode($data);
					}								
					if($password=='')
					{
						$data['status']		=	0;
						$data['message']	=	"password is not correct";
						return json_encode($data); 
					}								
					if (!filter_var($email, FILTER_VALIDATE_EMAIL))
					{
						$data['status']		=	0;
						$data['message']	=	"Invalid email format.";
						return json_encode($data);
					}
					if(trim($email != "") && trim($password != ""))				
					{
						$password = md5($password);										
						$this->db->select('*');
						$this->db->from('admin');
						$this->db->where('email',$email);
						$this->db->where('password',$password);
						$query=$this->db->get();
						$result = $query->result(); 										
							
						if(!empty($result))
						{
							$id 		= base64_encode($result[0]->admin_id); 
							$fullname	= $result[0]->fullname;
							$logintype	= $result[0]->logintype;    
							$status		= $result[0]->status;							
							if($status)
							{
								$session = array(
												 'token' 		=>	$id,
												 'adminname' 	=>	$fullname,    
												 'status' 		=>	$status,    
												 'logintype' 	=>	$logintype
												);
								$this->session->set_userdata($session);								
								$data['status']		=	1;
								$data['refresh']	=	1;
								$data['message']	= 	"Welcome $fullname, You are logged in succesfully.";		
								return json_encode($data);												
								
							} else {
									$data['status']		=	0;
									$data['message']	=	"You are not allowed to Login, Please contact Server Administrator for more details.";
									return json_encode($data);
							}					
						} else {
							$data['status']		=	0;
							$data['message']	=	"Wrong Email or Password.";
							return json_encode($data);
						}	
					} else {
								$data['status']		=	0;
								$data['message']	=	"Please check the entered details.";
							return json_encode($data);
					}
						$data['status']		=	0;
						$data['message']	=	"Something went Wrong.";
						return json_encode($data); 
								
	}
			
		//Change password Admin Start
	public function updateprofilepass()
	{
					$data = array();
					$data['refresh'] = 0; 
					
					
					$adminid 			= 	$this->session->userdata('token'); 
					$id 			= base64_decode($adminid);
					
					$currentpassword	 	  	=	$this->checkpostinput('currentpassword');
					$newpassword	 	  		=	$this->checkpostinput('newpassword');
					$confirmpassword	 	  	=	$this->checkpostinput('confirmpassword');
					
					if($newpassword != $confirmpassword){
						$data['status']		=	0;
						$data['message']	=	'No Match Found !!!';
						return json_encode($data);
						
					} elseif($currentpassword == $confirmpassword){
						
							$data['status']		=	0;
							$data['message']	=	'Old Password And New Password Are Same !!!';
							return json_encode($data);
							
					} else {
							if($currentpassword!="" && $newpassword!="" && $confirmpassword!="" && $id!="" ) 
								{
									$this->db->select('*');
									$this->db->from('admin');
									$this->db->where('admin_id',$id);
									$this->db->where('password',md5($currentpassword));
									$query=$this->db->get();
									$result = $query->result();
									if(!empty($result))
									{
										$values						=	array();
										$values['password']			=	md5($newpassword); 
										$this->db->where('admin_id', $id); 
										$this->db->where('password', md5($currentpassword)); 
										$check = $this->db->update('admin', $values);
										//$sql = $this->db->last_query();
										$data['refresh']		=	0;
										$data['status']			=	1;
										$data['message']		=	"<b>Successfully !!</b> Update Your Password!";
									}else{
									$data['refresh']		=	0;
									$data['status']			=	0;
									$data['message']		=	"<b>Sorry !! </b>old password does not match. We are not able to update the password";
									
									}
									return json_encode($data); 	 
								
							 } else {
									$data['status']		=	0;
									$data['message']	=	"Please fill all field !!! ";
									return json_encode($data);
							}
					}			  
									$data['status']		=	0;
									$data['message']	=	'Something Wents Wrong !!!';
									return json_encode($data);
	}
			//Change password Admin End				
	public function allvendor()
	 {    
			
			$this->db->select('a .*,b.name');
			$this->db->from('vendor_form a'); 
			$this->db->join('users b', 'b.user_id=a.user_id'); 
            $this->db->where('`id` not in(SELECT `vendor_id` FROM `allocate_form`)');			
			$query = $this->db->get();
          // echo $this->db->last_query();die;			
			if($query->num_rows() != 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
     }
	 public function anothersubadmin_vendordata($id,$limit=null,$order=null)
	 { 
			$this->db->select('a .*,c.name,c.email,c.phone'); 
			$this->db->from('vendor_form a'); 
			$this->db->join('assign_subadmin b', 'b.vendor_id=a.id');    
			$this->db->join('users c', 'c.user_id=a.user_id');  
			$this->db->where('b.subadmin_id',$id);
			$this->db->where('b.allocate_by!=',$id);
			$query = $this->db->get(); 
			//echo $this->db->last_query();die;
			if($limit != null){
			$this->db->limit($limit);
		}
		if($order != null){
			$this->db->order_by($order, "desc");
		}
			if($query->num_rows() != 0)
			{
				return $query->result();     
			}
			else
			{
				return false;
			}
     }
	 public function allvendor_by_id($id,$limit=null,$order=null)
	 { 
			$this->db->select('a .*,c.name,c.email,c.phone');
			$this->db->from('vendor_form a'); 
			$this->db->join('allocate_form b', 'b.vendor_id=a.id');    
			$this->db->join('users c', 'c.user_id=a.user_id');  
			$this->db->where('b.subadmin_id',$id);
			$query = $this->db->get(); 
			//echo $this->db->last_query();die;
			if($limit != null){
			$this->db->limit($limit);
		}
		if($order != null){
			$this->db->order_by($order, "desc");
		}
			if($query->num_rows() != 0)
			{
				return $query->result();     
			}
			else
			{
				return false;
			}
     }
	   public function get_name_by_id($id, $type = null)
	 {
				
			if($type   == 'type_name'){
				$from  = 'vendor_type';
				$where = 'type_id';
				$name  = 'vendor_type';
			
			}else{
				return false;
			}
			$this->db->select($name);
			$data = $this->db->from($from)
				->where($where, $id)->get()->result(); 
				
			if($data){
				return $data[0];
			}else{
				return false;
			}

	} 
	public function list_allocateform_subadmin($id='')
	 { 
			$this->db->select('a .*,b.full_name,b.vendor_type,c.name,d.fullname');
			$this->db->from('allocate_form a'); 
			$this->db->join('vendor_form b', 'b.id=a.vendor_id');    
			$this->db->join('users c', 'c.user_id=b.user_id');  
			$this->db->join('admin d', 'd.admin_id=a.subadmin_id'); 
			$this->db->where('a.allocate_by',$id);
			$query = $this->db->get(); 
					
		/* if($order != null){
			$this->db->order_by($order, "desc");
		} */
			if($query->num_rows() != 0)
			{
				return $query->result();     
			}
			else
			{
				return false;
			}
     }
	 public function vendordata_subadmin($id=''){
		     $this->db->select('a .*,b.*,c.name');
			$this->db->from('allocate_form a'); 
			$this->db->join('vendor_form b', 'b.id=a.vendor_id');    
			$this->db->join('users c', 'c.user_id=b.user_id'); 
            $this->db->where('a.subadmin_id',$id);			
			$query = $this->db->get(); 
			 		
		/* if($order != null){
			$this->db->order_by($order, "desc");
		} */
			if($query->num_rows() != 0)
			{
				return $query->result();     
			}
			else
			{
				return false;
			}
		 
		 
	 }
	 
			
						
 } 
?>