<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends MY_Controller {
	
	private static $_user_id = null;
	private static $_fb_id = null;
	
	
	
    public function __construct()
	{
		parent::__construct();
		
                     $this->load->model('Common_model');
                     $this->load->model('UserModel');
					
                      if(!$this->session->userdata('logged_in') )
                    {
                      self::$_user_id = null;
                      redirect('userlogin');
					}else{
                     
                    $session = $this->session->userdata('logged_in');
				    self::$_user_id = base64_decode($session['user_id']);
				    $this->session->userdata('facebook');
						
				   }
                   
                  
				  
	}
		
	
	 public function index() 
	{
		
		$this->load->view('front/includes/header');
		$this->load->view('front/includes/sidebar');
		$this->load->view('front/dashboard/dashboard_view');
		$this->load->view('front/includes/footer');
	}
	 
	
     public function vendorForm($id='',$vendor_type='')
	{
		         $id= base64_decode($id);
					$vendor_type= base64_decode($vendor_type);
					if(!empty($id)){
						$this->session->set_userdata('vendorId',$id);
						
					}else{
						$this->session->unset_userdata('vendorId');
						
					} 
	    $data['paydata']        =  $this->Common_model->select_data('transaction_details',array('vendor_id'=>$id));	   
	    $data['amount']         =  AUD; 	   
		$data['vendor_data']    =  $this->UserModel->vendor_fulldata($id,$vendor_type);
	    $data['vendortype']     =  $this->Common_model->select_data('vendor_type');
		$this->load->view('front/includes/header');
		$this->load->view('front/includes/sidebar');
		$this->load->view('front/dashboard/vendorform',$data);
		$this->load->view('front/includes/footer');
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
			
     public function vendorFormAction($iscomplete='')
	 
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
                       $user_id                  = self::$_user_id;
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
		                            
                                           if($this->form_validation->run() == FALSE){
                                            $error = array('have_you_stayed_or_do_you_intend_stay_australia_six_month' => form_error('have_you_stayed_or_do_you_intend_stay_australia_six_month'),
                                             'social_or_economic_ties_to_country' => form_error('social_or_economic_ties_to_country')

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
		                             
                                           if($this->form_validation->run() == FALSE){
                                            $error = array('have_you_stayed_or_do_you_intend_stay_australia_six_month' => form_error('have_you_stayed_or_do_you_intend_stay_australia_six_month'),
                                             'social_or_economic_ties_to_country' => form_error('social_or_economic_ties_to_country')

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
                             

		                            $this->form_validation->set_rules('property_situated_australia','property situated australia','required|callback_check_default');
		                            $this->form_validation->set_rules('trust_carry_business_australia','trust carry business australia','required|callback_check_default');
									$this->form_validation->set_rules('trust_management_control','trust management control','required|callback_check_default');
									$this->form_validation->set_rules('australian_resident','australian resident','required|callback_check_default');
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('property_situated_australia' => form_error('property_situated_australia'),
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
									
									
		                            $this->form_validation->set_rules('is_trustee_aus_resident','is trustee aus resident','required|callback_check_default');
		                            $this->form_validation->set_rules('management_control_aus','management control aus','required|callback_check_default');
									
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('is_trustee_aus_resident' => form_error('is_trustee_aus_resident'),
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
                                      
                                     $this->form_validation->set_rules('is_this_unit_trust','is this unit trust ','required|callback_check_default');
                                    $this->form_validation->set_message('check_default', 'Please select unit trust.');
                                    if($this->form_validation->run() == FALSE)


									 $error = array(
									
									 'is_this_unit_trust'       => form_error('is_this_unit_trust') );
									  $return= array('status' => false, 'message' => 'All fields are required', 'data' => $error);
                                 

                                   }elseif($is_this_unit_trust==1)
								  {
                             

		                            $this->form_validation->set_rules('property_situated_australia','property situated australia','required|callback_check_default');
		                            $this->form_validation->set_rules('trust_carry_business_australia','trust carry business australia','required|callback_check_default');
									$this->form_validation->set_rules('trust_management_control','trust management control','required|callback_check_default');
									$this->form_validation->set_rules('australian_resident','australian resident','required|callback_check_default');
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('property_situated_australia' => form_error('property_situated_australia'),
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
									
									
		                            $this->form_validation->set_rules('is_trustee_aus_resident','is trustee aus resident','required|callback_check_default');
		                            $this->form_validation->set_rules('management_control_aus','management control aus','required|callback_check_default');
									
		                            
                                      if($this->form_validation->run() == FALSE){
                                            $error = array('is_trustee_aus_resident' => form_error('is_trustee_aus_resident'),
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
	 
 	
    public function vendorDetails(){
		$user_id = self::$_user_id;
		$where = array('user_id'=>$user_id);
		$this->load->view('front/includes/header');
		$this->load->view('front/includes/sidebar');
		$data['vendor_data']=$this->Common_model->select_data('vendor_form',$where);
		$this->load->view('front/dashboard/vendor_details_list',$data);
		$this->load->view('front/includes/footer');
		
	}
	public function vendorforms_delete($id='',$type='')
	
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
					 $this->Common_model->delete_data('vendor_form',$where_id);
				}
				  
				  $return=array('status' => true, 'message' => 'Deleted Successfully');
				  echo json_encode($return);
	}
	 public function pay_view($id=''){
		    $user_id = self::$_user_id;
		    $vendordata   = $this->UserModel->payment($user_id);
		 
		 if(!empty($id)){
		  $vendor_data   =  $this->Common_model->select_data('vendor_form',array('id'=>base64_decode($id)));
           if($vendor_data[0]->is_complete==1 && $vendor_data[0]->pay_status==0 ){
			 
				$data['amount']         =  AUD; 
				$data['vendor_data']    =  $vendor_data; 
				$this->load->view('front/includes/header');
				$this->load->view('front/includes/sidebar');
				$this->load->view('front/dashboard/payment',$data);
				$this->load->view('front/includes/footer');
			
			  }else{
				    redirect('vendordetails');
			     }
			  
		   }elseif(!empty($vendordata)){
			   
			    $data['amount']         =  AUD; 
				$data['vendor_data']    =  $vendordata; 
				$this->load->view('front/includes/header');
				$this->load->view('front/includes/sidebar');
				$this->load->view('front/dashboard/payment',$data);
				$this->load->view('front/includes/footer');
			   
	     }else{
				  
				   redirect('vendordetails');
			   }			
		  
	}
	
	public function paypal_pay($vid='')
	  
	{     
        $vdata=$this->Common_model->select_data('vendor_form',array('id'=>$vid));
		
	    $vendor_id = $vdata[0]->id;
	    $full_name = $vdata[0]->full_name;
	    $email     = $vdata[0]->email_address;
	    $phone     = $vdata[0]->phone_no;
	
	  // print_r($_POST['payment']);
	    $paypalInfo     = $_POST['payment'];
		$txn_id        = $paypalInfo["id"];
		$transactions  = $paypalInfo['transactions'];
		$trans         = $transactions[0];
		$amount        = $trans['amount'];
		$total         = $amount['total'];
		$currency      = $amount['currency'];
		$payer         = $paypalInfo['payer'];
		$status        = $payer['status'];
		$payer_info    = $payer['payer_info'];
		$payer_id      = $payer_info['payer_id'];
	
	     
		$data= array(
					   'name'              => $full_name, 
					   'vendor_id'         => $vendor_id, 
					   'email'             => $email, 
					   'contact_no'        => $phone,  
                       'transaction_id'    => $txn_id,
                       'total_amount'      => $total,
                       'currency'          => $currency,
                       'payer_id'          => $payer_id,
                       'status'            => $status
                                              );
					  if(!empty($paypalInfo)){
					  $result =    $this->Common_model->insert_data('transaction_details',$data);
					   if(!empty($result)){
					  $info  =  array('pay_status'=> 1);
					  $where =  array('id'=>$vendor_id);
					   $this->Common_model->update_data('vendor_form',$where,$info);
					   }
					      $return=array('status' => true, 'message' => 'Payment successful.');
					  }else{
						     $return=array('status' => false, 'message' => 'Please try again.. your Payment  not successful...');
					      }
					 
				      echo json_encode($return);
		
		
	} 
	
	public function userMyProfile(){
		$data['profile_data']=$this->Common_model->select_data('users', array('user_id'=>self::$_user_id));
		$this->load->view('front/includes/header');
		$this->load->view('front/includes/sidebar');
		$this->load->view('front/userlogin/myprofile',$data);
		$this->load->view('front/includes/footer');
		
	}
	 public function userMyProfileUpdate()
        {
               
          $this->form_validation->set_error_delimiters('<p class="text text-danger error">', '</p>');
		  $this->form_validation->set_rules('name','Name ', 'trim|required');
		  $this->form_validation->set_rules('email','email','trim|required');
		  $this->form_validation->set_rules('phone','Phone','trim|required|regex_match[/[0-9 -()+]+$/]|min_length[10]|max_length[12]');
		  $this->form_validation->set_rules('address','Address','trim|required');
		  
			 if($this->form_validation->run() == FALSE) 
			 {
			
				$error = array(
							'name'    => form_error('name'), 
							'email'   => form_error('email'),
							'phone'   => form_error('phone'),
							'address' => form_error('address')
						   );
			
				$return=array('status' => false, 'message' => 'All fields are required', 'data' => $error);
			} 
		 else{
	 		
					   $data= array(
									'name'    => $this->input->post('name'),
									'email'   => $this->input->post('email'),
									'phone'   => $this->input->post('phone'),
									'address' => $this->input->post('address')
								  );
					 $where=array('user_id'=>self::$_user_id);
								 
								$stat=$this->Common_model->update_data('users',$where,$data);
								if($stat == true){
								  $return = array(
										"status" => TRUE,
										"message" => 'Settings saved!',
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
	public function userChangePassword(){
		  $this->form_validation->set_error_delimiters('<p class="text text-danger error">', '</p>');
		  $this->form_validation->set_rules('old_password','Current Password', 'trim|required');
		  $this->form_validation->set_rules('new_password','New password','trim|required|min_length[6]');
		  $this->form_validation->set_rules('conf_password','Re-type New Password','trim|required|matches[new_password]');
		 
		if ($this->form_validation->run() == FALSE)
		{
		
			$error = array(
						'old_password'     => form_error('old_password'),
						'new_password'     => form_error('new_password'),
					    'conf_password'    => form_error('conf_password')
					
					);
		
			$return  = array('status' => false, 'message' => 'All fields are required', 'data' => $error);
		} 
	  else {
		    $where           = array('user_id'=>self::$_user_id);
			$old_password	 = md5($this->input->post('old_password'));
			$new_password 	 = md5($this->input->post('new_password'));
			//$npass           = $this->password($new_password,self::$_salt,'encrypt');
			
			
			$data =	array(
							'password'  => $new_password);	
						    
			$check = $this->Common_model->select_data('users', array('user_id'=>self::$_user_id));
			if($check)
		  {
			$db_p = $check[0]->password;
			//$dec_p = $this->password($db_p, null, 'decrypt');
				
			if($db_p == $old_password){				
			 $info=$this->Common_model->update_data('users',$where,$data);
			 $return  = array('status' =>true, 'message' => 'Change Password Sucessfully ...', 'data' =>$info);
			}
			else{
			   $return  = array('status' =>false, 'message' => 'Old Password Does not match ...', 'data' =>'');
			  }
		  }
			else{
				 $return  = array('status' =>false, 'message' => 'Confirm password does not match...', 'data' =>'');
			 }
			
	    }
	        echo json_encode($return);
           		
		
	}		

}


