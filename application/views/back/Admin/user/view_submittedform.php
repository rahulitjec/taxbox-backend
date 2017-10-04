<?php 
 echo $layout['header'] ;
 echo $layout['sidebar'] ; 
 ?>   
    
        
<style>
   .resizetag{
	 width: 100%; 
     height: 34px;
     padding: 6px 12px;
     border: 1px solid #c2cad8;
   }
 
 </style>

 <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" style="min-height:867px;background:#f2f3f8">
                        <form  class="horizontal-form" id="vendor_form"  >
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                   <div class="tab-content">
                                         <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-equalizer font-blue-hoki"></i>
                                                        <span class="caption-subject font-blue-hoki bold uppercase">FRCGW Clearance Certificate</span> 
                                                    </div>
                                                </div>
												
                                                <div class="portlet-body form" style="margin-left:1%">
                                                     <div class="form-body">
                                                            <h3 class="form-section">Vendor details</h3>
															<?php if( !empty($this->uri->segment(2))) {
															$vid=base64_decode($this->uri->segment(2));?>
															  <input type="hidden" name="vendorid"  id="hdnVedorId"  class="form-control" 
															value="<?php echo (!empty($vid)) ? $vid : ''?>" />
															<?php  }else{  }?>
															
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Tax File Number</label>
                                                                        <input type="hidden" name="user_id"  disabled class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->user_id : '';?>" />
																		<input type="text" name="tax_no"  disabled class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->tax_file_no : '';?>" placeholder="Tax file number"/> 
                                                                       
                                                                    </div>
                                                                </div>
																</div>
																<div class="text-center" style="margin-right:50%;">OR</div>
																<div class="row">
																<div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">ABN</label>
                                                                        <input name="abn_no" type="text" disabled class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->abn_no : '';?>" placeholder="ABN"/> 
                                                                       
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
											
                                                            <!--/row-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="inputName" class="control-label">Full Name </label>
                                                                        <input name="fullname" data-error="Please enter name field." id="inputName" type="text" disabled class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->full_name : '';?>"  placeholder="Full name" />
                                                                        
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
															
															
															 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <label class="control-label">Vendor Type  </label>
                                                                        <select class="form-control"  disabled id="vendortype" name="vendor_type">
                                                            <option value="0">Select...</option>
															 <?php 
														 
														  foreach($vendortype as $type){
														 
																 ?>
														  <option value="<?php echo $type->type_id;?>" id="vtype" <?php
													
															   if(!empty($vendor_data) && $vendor_data[0]->vendor_type == $type->type_id){
																echo 'selected="selected"';
														   }else{}; ?> > <?php echo $type->vendor_type;?></option><?php } ?>
												 
                                                        </select>      
                                                                 </div>
                                                            </div>
														</div>
															
														 <div class="row" id="individual" style="display:none;">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Vendor Date Of Birth </label>
																	 <input name="individual_date_birth" type="text"  disabled class="form-control" data-provide="datepicker" value="<?php echo (!empty($vendor_data[0]->date_of_birth)) ? $vendor_data[0]->date_of_birth : '';?>" placeholder="Vendor Date Of birth"/> 
																	
																</div>
															</div>
														</div>
														<div class="row" id="trust" style="display:none;">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Name Of Trustee </label>
																	<input type="text" name="name_of_trustee"  disabled class="form-control" value="<?php echo (!empty($vendor_data[0]->name_of_trustee )) ? $vendor_data[0]->name_of_trustee : '' ;?>" placeholder="Name of trustee" />
																	
																</div>
															</div>
														</div>
														<div class="row" id="other" style="display:none;">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Other </label>
																	 <input name="other" type="text" disabled class="form-control"placeholder="Other" />
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Email address of vendor </label>
																	  <input type="text" class="form-control" disabled name="email"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->email_address : '';?>" placeholder="Email address">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Phone number of the vendor  </label>
																	  <input type="text" class="form-control" disabled  name="phone_no"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->phone_no : '';?>"placeholder="Phone number"> 
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Address of vendor </label>
																	   <input type="text" class="form-control" disabled name="addr_vendor"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->address_of_vendor : '';?>"placeholder="Address of vendor"> 
																</div>
															</div>
														</div>
														
                                                        </div>
                                                       
                                                </div>
                                          </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
						  <div class="row">
                            <div class="col-md-12">
                                <div class="tabbable-line boxless tabbable-reversed">
                                   <div class="tab-content">
                                      <div class="portlet light bordered">
                                            <div class="portlet-body form" style="margin-left:1%">
                                                    <div class="form-body">
                                                            <h3 class="form-section">Transaction dates</h3>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Contract date(if known) </label>
                                                                        <input  class="form-control"  disabled   type="text" name="contact_date"   value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->contact_date : '';?>" placeholder="Contact date"/> 
   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                               <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Expected settlement date</label>
                                                                        <input class="form-control"  disabled  type="text" name="expected_date"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->expected_date : '';?>" placeholder="Expected settlement date"> 
                                                                    </div>
                                                                </div> 
                                                            </div>   
                                                        </div>
                                                  
                                                </div>
                                          </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
						  <div class="row">
                            <div class="col-md-12">
                                <div class="tabbable-line boxless tabbable-reversed">
                                   <div class="tab-content">
                                        <div class="portlet light bordered">
                                              <div class="portlet-body form" style="margin-left:1%">
                                                   <div class="form-body">
                                                            <h3 class="form-section">Clearance certificate application questions</h3>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">1. Has your residency status changed since your last tax return or will it change before you sell the asset?</label>
                                                                      <select class="form-control" disabled name="residency_status" >
																		<option value="">Select...</option>
																		<?php if(!empty($vendor_data)){ 
																	   if($vendor_data[0]->residency_status_changed==1){?>
																		<option value="1"selected="selected">Yes</option>
																		<option value="2">No</option>
																	  <?php }else{ ?>
																		<option value="2" selected="selected">No</option>
																		<option value="1">Yes</option>
																		<?php }} else{?><option value="1">Yes</option>
																		<option value="2">No</option>
																		<?php }?>
																	</select>			   
                                                                 </div>
                                                              </div>  
                                                            </div>
                                                             <div class="row">
                                                                 <div class="col-md-6">
                                                                    <div class="form-group ">
                                                                        <label class="control-label">2. Have you lodged an Australian tax return for the last two years? </label>
                                                                          <select class="form-control" disabled name="australian_tax" >
																			<option value="">Select...</option>
																			 <?php if(!empty($vendor_data)){ 
																		   if($vendor_data[0]->lodged_australian_tax==1){?>
																			<option value="1"selected="selected">Yes</option>
																			<option value="2">No</option>
																		  <?php }else{ ?>
																			<option value="2" selected="selected">No</option>
																			<option value="1">Yes</option>
																			<?php }} else{?><option value="1">Yes</option>
																			<option value="2">No</option>
																			<?php }?>
																		</select> 
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">3. Are you holding the property on behalf of a foreign resident or on behalf of other entities that include foreign resident?
													                    </label>
                                                                        <select class="form-control" disabled name="holding_property" >
																		<option value="">Select...</option>
																		   <?php if(!empty($vendor_data)){ 
																	   if($vendor_data[0]->holding_property==1){?>
																		<option value="1"selected="selected">Yes</option>
																		<option value="2">No</option>
																	   <?php }else{ ?>
																		<option value="2" selected="selected">No</option>
																		<option value="1">Yes</option>
																		<?php }} else{?><option value="1">Yes</option>
																		<option value="2">No</option>
																		<?php }?>
																		
																	</select>
																				   
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                     
                                                </div>
                                          </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
						  <div class="row" id="dvindividual" style="display:none;">
                            <div class="col-md-12">
                                <div class="tabbable-line boxless tabbable-reversed">
                                   <div class="tab-content">
                                       
                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-equalizer font-blue-hoki"></i>
                                                        <span class="caption-subject font-blue-hoki bold uppercase">Vendor Type</span> 
                                                    </div> 
                                                </div>
                                                <div class="portlet-body form" style="margin-left:1%">
                                                   
                                                        <div class="form-body">
                                                            <h3 class="form-section">Individual</h3>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="sbold control-label">1. Are you migrating and settling in Australia or have been settled in Australia?
                                                                   </label>
                                                                             <select class="form-control" id="migrating" disabled name="migrating_settling_australia" >
																			<option value="0">Select...</option>
																			 <?php if(!empty($vendor_data[0]->migrating_settling_australia)){ 
																		   if($vendor_data[0]->migrating_settling_australia==1){?>
																		   <option value="1"selected="selected">Yes</option>
																		   <option value="2">No</option>
																		  <?php }else{ ?>
																			<option value="2" selected="selected">No</option>
																			<option value="1">Yes</option>
																			<?php }}else{?>
																			<option value="1">Yes</option>
																			<option value="2">No</option>
																			<?php } ?> 
																			
																		</select>
														              <span class="help-block">If yes go to question 3</span>
                                                                    </div>
                                                                </div>
                                                             
                                                                <!--/span-->
                                                            </div>
                                                            <!--/row-->
														<div id="returning" >
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class=" sbold control-label">2. Are you an Australian returning to live in Australia? </label>
                                                                       <select class="form-control" name="returning_live_australia" disabled id="return_australia" >
																	   <option value="">Select...</option>
																		<?php if(!empty($vendor_data[0]->returning_live_australia)){ 
																	   if($vendor_data[0]->returning_live_australia==1){?>
																	   <option value="1"selected="selected">Yes</option>
																	   <option value="2">No</option>
																	  <?php }else{ ?>
																		<option value="2" selected="selected">No</option>
																		<option value="1">Yes</option>
																		<?php }}else{?>
																		<option value="1">Yes</option>
																		<option value="2">No</option>
																		<?php } ?> 
																	</select>
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
															<div id="main_purpose">
															 <span class="" style="font-weight: 400;">2.1 What is your main purpose for being in Australia? </span><br> 
                                                               <br>
															 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Employment contract or permanent employment</label>
                                                                      <div class=" mt-checkbox-list">
																		<label class="mt-checkbox mt-checkbox-outline"> 
																			<input type="checkbox"  name="employment_contract_permanent_employment" disabled value="true" <?php 
																if(!empty($vendor_data[0]->employment_contract_permanent_employment))
																{
																	$techarray=$vendor_data[0]->employment_contract_permanent_employment;
																			if (strpos($techarray, 'true') !== false)
																		echo 'checked="checked"';
																} ?> />
																		<span style="margin-left: 12px; margin-top: 8px;"></span>
																		</label>
															       </div>	
                                                              </div>
                                                            </div>
                                                       </div>
													   
													   <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Exchange program or full time research</label>
                                                                       <div class=" mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
                                                            <input type="checkbox"  name="exchange_program" disabled value="true" 		
																<?php 
															if(!empty($vendor_data[0]->exchange_program))
															{
																$techarray =$vendor_data[0]->exchange_program;
																		if (strpos($techarray, 'true') !== false)
																	echo 'checked="checked"';
															}?> />
																		<span style="margin-left: 12px; margin-top: 8px;"></span>
														  </label>			
                                                                   </div>	
                                                                </div>
                                                            </div>
                                                       </div>
													    <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Full time education</label>
                                                                       <div class=" mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
                                                                      <input type="checkbox"  name="full_time_education" disabled value="true" 		
																	<?php 
																if(!empty($vendor_data[0]->full_time_education))
																{
																	$techarray =$vendor_data[0]->full_time_education;
																			if (strpos($techarray, 'true') !== false)
																		echo 'checked="checked"';
																}?> />
                                                            <span style="margin-left: 12px; margin-top: 8px;"></span>
														  </label>			
                                                                   </div>	
                                                                </div>
                                                            </div>
                                                       </div>
													    <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Holidaying or casual employmen</label>
                                                                       <div class=" mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
                                                                         <input type="checkbox"  name="holidaying_or_casual_employmen" disabled value="true" 		
																	<?php 
																if(!empty($vendor_data[0]->holidaying_or_casual_employmen))
																{
																	$techarray =$vendor_data[0]->holidaying_or_casual_employmen;
																			if (strpos($techarray, 'true') !== false)
																		echo 'checked="checked"';
																}?> />
                                                             <span style="margin-left: 12px; margin-top: 8px;"></span>
														   </label>			
                                                                   </div>	
                                                                </div>
                                                            </div>
                                                       </div>
													    <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Visiting friends or relatives</label>
                                                                       <div class=" mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
															 <input type="checkbox"  name="visiting_friends_or_relatives" disabled value="true" 		
																		<?php 
																	if(!empty($vendor_data[0]->visiting_friends_or_relatives))
																	{
																		$techarray =$vendor_data[0]->visiting_friends_or_relatives;
																				if (strpos($techarray, 'true') !== false)
																			echo 'checked="checked"';
																	}?> />
																				<span style="margin-left: 12px; margin-top: 8px;"></span>
														   </label>			
                                                                   </div>	
                                                                </div>
                                                            </div>
                                                       </div>
													    <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.1.1 Other</label>
                                                                       <div class=" mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
															    <input type="checkbox"  name="other" value="true" disabled 	id="otherdata"	
																	<?php 
																if(!empty($vendor_data[0]->other))
																{
																	$techarray =$vendor_data[0]->other;
																			if (strpos($techarray, 'true') !== false)
																		echo 'checked="checked"';
																}?> />
                                                               <span style="margin-left: 12px; margin-top: 8px;"></span>
														   </label>			
                                                                   </div>	
                                                                </div>
                                                            </div>
                                                       </div>
													    <div class="stayed">
													    <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.1.1.1 Have you stayed or do you intend to stay in a particular place continuously for six months or more? </label>
                                                                    <select class="form-control" name="have_you_stayed_or_do_you_intend_stay" disabled >
																	<option value="">Select...</option>
																	 <?php if(!empty($vendor_data[0]->have_you_stayed_or_do_you_intend_stay)){ 
																   if($vendor_data[0]->have_you_stayed_or_do_you_intend_stay==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?> 
                                                            
                                                                    </select>	
                                                                </div>
                                                            </div>
                                                       </div> 
													 <span class="" style="">2.1.1.2 Where do you live in Australia? </span><br>
													  <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Staying with family, friends</label>
                                                                    <div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline"> 
																		<input type="checkbox"  name="live_in_australia_family_friends" disabled value="true" 		
																<?php 
															if(!empty($vendor_data[0]->live_in_australia_family_friends))
															{
																$techarray =$vendor_data[0]->live_in_australia_family_friends;
																		if (strpos($techarray, 'true') !== false)
																	echo 'checked="checked"';
															}?> />
                                                            <span style="margin-left: 12px; margin-top: 8px;"></span>
                                                        </label> 
                                                                     </div>	
                                                                </div>
                                                            </div>
                                                       </div>
													     <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Hotel, motel, hostel or caravan</label>
                                                                    <div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline"> 
																		  <input type="checkbox"  name="live_in_australia_hotel_motel" disabled value="true" 		
																			<?php 
																		if(!empty($vendor_data[0]->live_in_australia_hotel_motel))
																		{
																			$techarray = $vendor_data[0]->live_in_australia_hotel_motel;
																					if (strpos($techarray, 'true') !== false)
																				echo 'checked="checked"';
																		}?> />
                                                                      <span style="margin-left: 12px; margin-top: 8px;"></span>
                                                                  </label> 
                                                                     </div>	
                                                                </div>
                                                            </div>
                                                       </div>
													   <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">University campus</label>
                                                                    <div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline"> 
																		   <input type="checkbox"  disabled name="live_in_australia_university_campus" value="true" 		
																			<?php 
																		if(!empty($vendor_data[0]->live_in_australia_university_campus))
																		{
																			$techarray =$vendor_data[0]->live_in_australia_university_campus;
																					if (strpos($techarray, 'true') !== false)
																				echo 'checked="checked"';
																		}?> />
                                                                      <span style="margin-left: 12px; margin-top: 8px;"></span>
                                                                  </label> 
                                                                     </div>	
                                                                </div>
                                                            </div>
                                                       </div>
													    <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Own or buying a home</label>
                                                                    <div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline"> 
																		     <input type="checkbox" disabled name="live_in_australia_own_buying_home" value="true" 		
																			<?php 
																		if(!empty($vendor_data[0]->live_in_australia_own_buying_home))
																		{
																			$techarray =$vendor_data[0]->live_in_australia_own_buying_home;
																					if (strpos($techarray, 'true') !== false)
																				echo 'checked="checked"';
																		}?> />
                                                                      <span style="margin-left: 12px; margin-top: 8px;"></span>
                                                                  </label> 
                                                                     </div>	
                                                                </div>
                                                            </div>
                                                       </div>
													    <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Renting or leasing accommodation</label>
                                                                    <div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline"> 
																		   <input type="checkbox"  disabled name="live_in_australia_renting_leasing_accommodation" value="true" 		
																			<?php 
																		if(!empty($vendor_data[0]->live_in_australia_renting_leasing_accommodation))
																		{
																			$techarray =$vendor_data[0]->live_in_australia_renting_leasing_accommodation;
																					if (strpos($techarray, 'true') !== false)
																				echo 'checked="checked"';
																		}?> />
                                                                      <span style="margin-left: 12px; margin-top: 8px;"></span>
                                                                  </label> 
                                                                     </div>	
                                                                </div>
                                                            </div>
                                                       </div>
													   <br>
													     <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.1.1.3 Do you have a spouse and/or dependant children?</label>
                                                                     <select class="form-control" disabled name="spouse_dependant_children" id="child">
																		<option value="">Select...</option>
																	   <?php if(!empty($vendor_data[0]->spouse_dependant_children)){ 
																	   if($vendor_data[0]->spouse_dependant_children==1){?>
																	   <option value="1"selected="selected">Yes</option>
																	   <option value="2">No</option>
																	  <?php }else{ ?>
																		<option value="2" selected="selected">No</option>
																		<option value="1">Yes</option>
																		<?php }}else{?>
																		<option value="1">Yes</option>
																		<option value="2">No</option>
																		<?php } ?> 
																		
																	</select>
                                                                </div>
                                                            </div>
                                                       </div>
													   <div id="spouse">
													    <span class="" style="">Where are your spouse and/or dependent children?</span><br>
														 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Currently living with you</label>
                                                                     <div class="mt-checkbox-list">
																		<label class="mt-checkbox mt-checkbox-outline"> 
																			<input type="checkbox"  disabled name="currently_living_with_you" value="true" 		
																	<?php 
																if(!empty($vendor_data[0]->currently_living_with_you))
																{
																	$techarray =$vendor_data[0]->currently_living_with_you;
																			if (strpos($techarray, 'true') !== false)
																		echo 'checked="checked"';
																}?> />
																			<span style="margin-left: 12px; margin-top: 8px;"></span>
																		</label>
																  </div>
                                                                </div>
                                                            </div>
                                                       </div>
													    <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Remaining overseas</label>
                                                                     <div class="mt-checkbox-list">
																		<label class="mt-checkbox mt-checkbox-outline"> 
																			   <input type="checkbox"  disabled name="remaining_overseas" value="true" 		
																				<?php 
																			if(!empty($vendor_data[0]->remaining_overseas))
																			{
																				$techarray =$vendor_data[0]->remaining_overseas;
																						if (strpos($techarray, 'true') !== false)
																					echo 'checked="checked"';
																			}?> />
																			<span style="margin-left: 12px; margin-top: 8px;"></span>
																		</label>
																  </div>
                                                                </div>
                                                            </div>
                                                       </div>
													       <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Coming to live with you</label>
                                                                     <div class="mt-checkbox-list">
																		<label class="mt-checkbox mt-checkbox-outline"> 
																			     <input type="checkbox"  disabled name="coming_to_live_with_you" value="true" 		
																				<?php 
																			if(!empty($vendor_data[0]->coming_to_live_with_you))
																			{
																				$techarray =$vendor_data[0]->coming_to_live_with_you;
																						if (strpos($techarray, 'true') !== false)
																					echo 'checked="checked"';
																			}?> />
																			<span style="margin-left: 12px; margin-top: 8px;"></span>
																		</label>
																  </div>
                                                                </div>
                                                            </div>
                                                       </div>
													     <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Some with you and some remaining overseas</label>
                                                                     <div class="mt-checkbox-list">
																		<label class="mt-checkbox mt-checkbox-outline"> 
																			   <input type="checkbox"  disabled name="some_with_you_and_remaining_overseas" value="true" 		
																				<?php 
																			if(!empty($vendor_data[0]->some_with_you_and_remaining_overseas))
																			{
																				$techarray =$vendor_data[0]->some_with_you_and_remaining_overseas;
																						if (strpos($techarray, 'true') !== false)
																					echo 'checked="checked"';
																			}?> />
																			<span style="margin-left: 12px; margin-top: 8px;"></span>
																		</label>
																  </div>
                                                                </div>
                                                            </div>
                                                       </div>
													   </div>
													      <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.1.1.4 Where do you hold the majority of your assets?</label>
                                                                     <select class="form-control" disabled name="hold_majority_of_your_assets" >
																		<option value="">Select...</option>
																		  <?php if(!empty($vendor_data[0]->hold_majority_of_your_assets)){ 
																	   if($vendor_data[0]->hold_majority_of_your_assets==1){?>
																	   <option value="1"selected="selected">Australia</option>
																	   <option value="2">Overseas</option>
																	  <?php }else{ ?>
																		<option value="2" selected="selected">Overseas</option>
																		<option value="1">Australia</option>
																		<?php }}else{?>
																		<option value="1">Australia</option>
																		<option value="2">Overseas</option>
																		<?php } ?>  
																	</select>
                                                                </div>
                                                            </div>
                                                       </div>
													     <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.1.1.5 Are you a member of any clubs, churches community groups or organisations in Australia? </label>
																<select class="form-control" disabled name="are_you_member_of_any_clubs_churches_community" >
																	<option value="">Select...</option>
																 <?php if(!empty($vendor_data[0]->are_you_member_of_any_clubs_churches_community)){ 
																   if($vendor_data[0]->are_you_member_of_any_clubs_churches_community==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
                                                            </select>
                                                                </div>
                                                            </div>
                                                          </div>
													  </div>
                                                  </div>
												   <div id="stayed_australia">
												    <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.2 Have you stayed or do you intend to stay in Australia for six months or more?</label>
																 <select class="form-control" disabled name="have_you_stayed_or_do_you_intend_stay_australia_six_month" >
																	<option value="">Select...</option>
																	   <?php if(!empty($vendor_data[0]->have_you_stayed_or_do_you_intend_stay_australia_six_month)){ 
																   if($vendor_data[0]->have_you_stayed_or_do_you_intend_stay_australia_six_month==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>   
                                                             </select> 
                                                              </div>
                                                          </div>
                                                     </div>
													   <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.3 Do you have social or economic ties to a country other than Australia? Y </label>
																		<select class="form-control" disabled name="social_or_economic_ties_to_country" >
																			<option value="">Select...</option>
																			 <?php if(!empty($vendor_data[0]->social_or_economic_ties_to_country)){ 
																		   if($vendor_data[0]->social_or_economic_ties_to_country==1){?>
																		   <option value="1"selected="selected">Yes</option>
																		   <option value="2">No</option>
																		  <?php }else{ ?>
																			<option value="2" selected="selected">No</option>
																			<option value="1">Yes</option>
																			<?php }}else{?>
																			<option value="1">Yes</option>
																			<option value="2">No</option>
																			<?php } ?>  
																    </select>
                                                                 </div>
                                                            </div> 
                                                        </div> 
											        </div>
										         </div>
												 <div id="austra">
												     <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class=" sbold control-label">3 Have you been in Australia, either continuously or intermittently,
                                                                          for 183 days or more in the current income year?</label>
																		<select class="form-control" disabled name="intermittently_183day" id="continu_aus" >
																	<option value="">Select...</option>
																	 <?php if(!empty($vendor_data[0]->australia_either_continue_intermittently_183day)){ 
																   if($vendor_data[0]->australia_either_continue_intermittently_183day==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
                                                           </select>
                                                                 </div>
                                                            </div>
                                                       </div> 
													   <div id="outsidaus">
												        <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">3.1 Is your usual place of abode outside of Australia?</label>
																	 <select class="form-control" disabled name="place_of_abode_outside_australia" id="outside_aus" >
																	<option value="">Select...</option>
																	<?php if(!empty($vendor_data[0]->place_of_abode_outside_australia)){ 
																   if($vendor_data[0]->place_of_abode_outside_australia==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
														    </select>
                                                                 </div>
                                                            </div>
                                                       </div> 
													   <div id="intend_aus">
													     <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">3.1.1 Do you intend to take up residence in Australia? </label>
															<select class="form-control" disabled name="intend_to_takeup_residence_in_australia" >
																<option value="">Select...</option>
															   <?php if(!empty($vendor_data[0]->intend_to_takeup_residence_in_australia)){ 
															   if($vendor_data[0]->intend_to_takeup_residence_in_australia==1){?>
															   <option value="1"selected="selected">Yes</option>
															   <option value="2">No</option>
															  <?php }else{ ?>
																<option value="2" selected="selected">No</option>
																<option value="1">Yes</option>
																<?php }}else{?>
																<option value="1">Yes</option>
																<option value="2">No</option>
																<?php } ?>  
                                                            </select>
                                                                 </div>
                                                              </div>
                                                         </div> 
												    </div>
											    </div>
                                              </div>
											</div>
                                         </div>    
                                                </div>
                                          </div>  
                                    </div>
                                </div>
                            </div>
						                      
							 <div class="row" id="dvtrust" style="display:none;">
                            <div class="col-md-12">
                                <div class="tabbable-line boxless tabbable-reversed">
                                   <div class="tab-content">
                                      <div class="portlet light bordered">
									  <div class="portlet-title">
											<div class="caption">
												<i class="icon-equalizer font-blue-hoki"></i>
												<span class="caption-subject font-blue-hoki bold uppercase">Vendor Type</span> 
											</div> 
										</div>
                                            <div class="portlet-body form" style="margin-left:1%">
                                                    <div class="form-body">
                                                            <h3 class="form-section"> Trust</h3>
                                                           <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Is this a unit trust?</label>
                                                                        <select class="form-control" disabled name="is_this_unit_trust" id="unit_turst">
																		<option value="0">Select...</option>
																		  <?php if(!empty($vendor_data[0]->is_this_unit_trust)){ 
																	   if($vendor_data[0]->is_this_unit_trust==1){?>
																	   <option value="1"selected="selected">Yes</option>
																	   <option value="2">No</option>
																	  <?php }else{ ?>
																		<option value="2" selected="selected">No</option>
																		<option value="1">Yes</option>
																		<?php }}else{?>
																		<option value="1">Yes</option>
																		<option value="2">No</option>
																		<?php } ?>  
																	</select>
																</div>
                                                              </div>
                                                            </div>
													<div id="property">
														<span style="margin-left:20px;">Complete the following details:</span><br><br>
                                                          <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Is any of the property of the trust situated in Australia?</label>
                                                                  <select class="form-control" disabled name="property_situated_australia">
																	<option value="">Select...</option>
																	 <?php if(!empty($vendor_data[0]->any_property_of_the_trust_situated_in_australia)){ 
																   if($vendor_data[0]->any_property_of_the_trust_situated_in_australia==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
                                                               </select>
																</div>
                                                              </div>
                                                            </div> 
															 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Does the trust carry on a business in Australia?</label>
                                                                 <select class="form-control" disabled name="trust_carry_business_australia">
																	<option value="">Select...</option>
																	  <?php if(!empty($vendor_data[0]->trust_carry_on_business_in_australia)){ 
																   if($vendor_data[0]->trust_carry_on_business_in_australia==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
																	
																</select>
																</div>
                                                              </div>
                                                            </div> 
															 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Is the trust central management & control in Australia?</label>
                                                                 <select class="form-control" disabled name="trust_management_control">
																	<option value="">Select...</option>
																	 <?php if(!empty($vendor_data[0]->trust_central_management_control)){ 
																   if($vendor_data[0]->trust_central_management_control==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
                                                             </select>
																</div>
                                                              </div>
                                                            </div>
                                                             <div class="row">
                                                               <div class="col-md-6">
                                                                    <div class="form-group">
                                                            <label class="control-label">Do Australian residents hold more than 50% of the beneficial interests in the income or
                                                        property of the trust?</label>
                                                                 <select class="form-control" disabled name="australian_resident">
																	<option value="">Select...</option>
																	  <?php if(!empty($vendor_data[0]->australian_resident_hold_more_than_50percent_beneficial_interes)){ 
																   if($vendor_data[0]->australian_resident_hold_more_than_50percent_beneficial_interes==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
                                                              </select>
																</div>
                                                              </div>
                                                            </div>
													    </div>
                                                         <div id="resident">															
                                                         <span style="margin-left:20px;">Complete the following details: </span><br><br> <div class="row">
                                                               <div class="col-md-6">
                                                                    <div class="form-group">
                                                            <label class="control-label">Is the trustee of the trust an Australian resident?</label>
                                                                 <select class="form-control" disabled name="is_trustee_aus_resident">
																<option value="">Select...</option>
																  <?php if(!empty($vendor_data[0]->is_trustee_of_the_trust_australian_resident)){ 
															   if($vendor_data[0]->is_trustee_of_the_trust_australian_resident==1){?>
															   <option value="1"selected="selected">Yes</option>
															   <option value="2">No</option>
															  <?php }else{ ?>
																<option value="2" selected="selected">No</option>
																<option value="1">Yes</option>
																<?php }}else{?>
																<option value="1">Yes</option>
																<option value="2">No</option>
																<?php } ?>  
                                                            </select>
																</div>
                                                              </div>
                                                            </div> 
                                                            <div class="row">
                                                              <div class="col-md-6">
                                                               <div class="form-group">
                                                            <label class="control-label">Is the trust central management & control in Australia?</label>
                                                                 <select class="form-control" disabled name="management_control_aus">
																	<option value="">Select...</option>
																	  <?php if(!empty($vendor_data[0]->is_trust_central_management_control_in_australia)){ 
																   if($vendor_data[0]->is_trust_central_management_control_in_australia==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
                                                             </select>
																</div>
                                                             </div>
                                                           </div> 
                                                         </div>	
														 
                                                   </div> 
                                              
                                                </div>
                                          </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
							<div class="row" id="dvcompany" style="display:none;">
                            <div class="col-md-12">
                                <div class="tabbable-line boxless tabbable-reversed">
                                   <div class="tab-content">
                                      <div class="portlet light bordered">
									  <div class="portlet-title">
											<div class="caption">
												<i class="icon-equalizer font-blue-hoki"></i>
												<span class="caption-subject font-blue-hoki bold uppercase">Vendor Type</span> 
											</div> 
										</div>
                                            <div class="portlet-body form" style="margin-left:1%">
                                                   <div class="form-body">
                                                            <h3 class="form-section"> Company</h3>
                                                           <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Is the company incorporated in Australia?</label>
                                                                       <select class="form-control" name="is_company_incorporated_in_australia" disabled id="company_aus">
																	 <option value="0">Select...</option>
																	 <?php if(!empty($vendor_data[0]->is_company_incorporated_in_australia)){ 
																   if($vendor_data[0]->is_company_incorporated_in_australia==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>   
																 </select>
																</div>
                                                              </div>
                                                            </div>
													<div id="cmp_details">
														<span class="bold" style="margin-left:10px;">Complete the following details:</span><br><br>
                                                          <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                   <label class="control-label">Is any of the property of the company situated in Australia?</label>
                                                                  <select class="form-control" disabled name="property_situated_aust">
																	<option value="">Select...</option>
																	 <?php if(!empty($vendor_data[0]->property_of_company_situated_in_australia)){ 
																   if($vendor_data[0]->property_of_company_situated_in_australia==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>     
																</select>
																</div>
                                                              </div>
                                                            </div> 
															 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <label class="control-label">Does the company carry on business in Australia?</label>
                                                                  <select class="form-control" name="company_carry_business_aus" disabled>
																	<option value="">Select...</option>
																	 <?php if(!empty($vendor_data[0]->does_the_company_carry_on_business_in_australia)){ 
																   if($vendor_data[0]->does_the_company_carry_on_business_in_australia==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
																 </select>
																</div>
                                                              </div>
                                                            </div> 
															 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                   <label class="control-label">Is the company central management and control in Australia?</label>
                                                                  <select class="form-control" name="company_management_aus" disabled>
																	<option value="">Select...</option>
																	 <?php if(!empty($vendor_data[0]->company_central_management_and_control_in_australia)){ 
																   if($vendor_data[0]->company_central_management_and_control_in_australia==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
																</select>
																</div>
                                                              </div>
                                                            </div>
                                                             <div class="row">
                                                               <div class="col-md-6">
                                                                 <div class="form-group">
                                                            <label class="control-label">Is the company voting power controlled by shareholders who are resident in Australia?</label>
                                                                 <select class="form-control" name="controlled_shareholders_aus" disabled>
																		<option value="">Select...</option>
																		 <?php if(!empty($vendor_data[0]->voting_power_controlled_shareholders_who_are_resident_in_aus)){ 
																	   if($vendor_data[0]->voting_power_controlled_shareholders_who_are_resident_in_aus==1){?>
																	   <option value="1"selected="selected">Yes</option>
																	   <option value="2">No</option>
																	  <?php }else{ ?>
																		<option value="2" selected="selected">No</option>
																		<option value="1">Yes</option>
																		<?php }}else{?>
																		<option value="1">Yes</option>
																		<option value="2">No</option>
																		<?php } ?>  
																	 </select>
																</div>
                                                              </div>
                                                            </div>
													    </div>
                                                         
                                                   </div> 
                                               
                                                </div>
                                          </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row" id="dvsuperfund" style="display:none;">
                            <div class="col-md-12">
                                <div class="tabbable-line boxless tabbable-reversed">
                                   <div class="tab-content">
                                      <div class="portlet light bordered">
									  <div class="portlet-title">
											<div class="caption">
												<i class="icon-equalizer font-blue-hoki"></i>
												<span class="caption-subject font-blue-hoki bold uppercase">Vendor Type</span> 
											</div> 
										</div>
                                            <div class="portlet-body form" style="margin-left:1%">
                                                   <div class="form-body">
                                                            <h3 class="form-section">Super fund</h3>
                                                           <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">1. Is the entity an Australian Superannuation Fund?</label>
                                                                        <select class="form-control" name="superannuation_fund" disabled>
																		<option value="">Select...</option>
																		  <?php if(!empty($vendor_data[0]->is_entity_australian_superannuation_fund)){ 
																	   if($vendor_data[0]->is_entity_australian_superannuation_fund==1){?>
																	   <option value="1"selected="selected">Yes</option>
																	   <option value="2">No</option>
																	  <?php }else{ ?>
																		<option value="2" selected="selected">No</option>
																		<option value="1">Yes</option>
																		<?php }}else{?>
																		<option value="1">Yes</option>
																		<option value="2">No</option>
																		<?php } ?>  
																		
																	</select>
																</div>
                                                              </div>
                                                            </div>
													
														 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                   <label class="control-label">2. Was the fund established in Australia or is any asset of the fund situated in Australia?</label>
                                                                 <select class="form-control" name="fund_estab_asset_fund" disabled>
																	<option value="">Select...</option>
																	 <?php if(!empty($vendor_data[0]->fund_established_in_australia_or_is_any_asset_of_the_fund)){ 
																   if($vendor_data[0]->fund_established_in_australia_or_is_any_asset_of_the_fund==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
														 </select>
																</div>
                                                              </div>
                                                            </div> 
															 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <label class="control-label">3. Is the funds central management & control in Australia?</label>
                                                                 <select class="form-control" name="fund_control_aus" disabled>
																	<option value="">Select...</option>
																	 <?php if(!empty($vendor_data[0]->fund_central_management_control_in_australia)){ 
																   if($vendor_data[0]->fund_central_management_control_in_australia==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
																	
																</select>
																</div>
                                                              </div>
                                                            </div> 
															 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                   <label class="control-label sbold">4. Does the fund have any member/s who were either?
                                                        <br>
                                                    <span style="font-size:12;">A contributor in the fund at that time<br> OR<br>
                                                    An individual on whose behalf contributions have been made? (unless the individual is a foreign resident and who is not a contributor at the time and for whom contributions made to the fund on their behalf after the individual became a foreign resident are only payments in respect of a time when the individual was an Australian resident)</span></label>
                                                                  <select class="form-control" name="fund_have_any_member" disabled>
                                                            <option value="">Select...</option>
                                                              <?php if(!empty($vendor_data[0]->fund_have_any_member)){ 
														   if($vendor_data[0]->fund_have_any_member==1){?>
														   <option value="1"selected="selected">Yes</option>
														   <option value="2">No</option>
														  <?php }else{ ?>
															<option value="2" selected="selected">No</option>
															<option value="1">Yes</option>
															<?php }}else{?>
															<option value="1">Yes</option>
															<option value="2">No</option>
															<?php } ?>  
                                                            
                                                        </select>
														     </div>
                                                          </div>
                                                        </div>
                                                         <div class="row">
                                                            <div class="col-md-6">
                                                                 <div class="form-group">
                                                            <label class="control-label sbold">5. Do either of the following apply?
                                                        <br><br>
														<span style="font-size:12;">At least 50% of the total market value of the fund assets attributable to superannuation interests held by active members is attributable to Australian residents?<br> OR<br>
                                                        At least 50% of the sum of the amounts that would be payable to or in respect of active members if they voluntarily ceased to be members is attributable to Australian residents?</span></label>
                                                                  <select class="form-control" name="do_either_following_apply" disabled>
																	<option value="">Select...</option>
																	  <?php if(!empty($vendor_data[0]->do_either_of_the_following_apply)){ 
																   if($vendor_data[0]->do_either_of_the_following_apply==1){?>
																   <option value="1"selected="selected">Yes</option>
																   <option value="2">No</option>
																  <?php }else{ ?>
																	<option value="2" selected="selected">No</option>
																	<option value="1">Yes</option>
																	<?php }}else{?>
																	<option value="1">Yes</option>
																	<option value="2">No</option>
																	<?php } ?>  
														 </select>
																</div>
                                                              </div>
                                                         </div>
                                                   </div> 
                                              
                                                    <!-- END FORM-->
                                                </div>
                                          </div>  
                                    </div>
                                </div>
                            </div>
                        </div>           
						         <div class="form-actions">
						                    <div class="row">
                                              <div class="col-md-offset-3 col-md-9" id="divHide">
										            
                                                          <button class="btn blue-hoki" id="buttonHide" onclick="viewprint()">Print</button>
														    <a  href="<?php echo base_url('Admin/pdfgenrate/'.base64_encode($vendor_data[0]->id).'/'.base64_encode($vendor_data[0]->vendor_type));?>" class="btn purple-plum" >Generate PDF</a>
                                                            <!--a class="btn blue-madison" href="<?php echo base_url('Admin/submittedforms_list');?>" class="btn default button-previous">
                                                              <i ></i> Back </a-->
                                                         
                                                        </div>
                                                    </div>
										 </div>  
						</form> 
						
                     </div> 
                </div>
                    <!-- END CONTENT BODY -->
<?php   echo $layout['footer'] ; ?>	
    
 <script type="text/javascript">
  
 function viewprint() {
              window.print();
         } 
    $('document').ready(function(e) {   
        $(".form").addClass('active');
        $(".form ul").removeClass('active'); 
        $(".submitted").addClass('active');

function divHIdeAndshow()
{
                if ($('#vendortype').val() == 1) {
                    $("#dvtrust").show();
                } else {
                    $("#dvtrust").hide();
                }
                if ($('#vendortype').val() == 1) {
                    $("#trust").show();
                } else {
                    $("#trust").hide();
                }
                if ($('#vendortype').val() == 2) {
                    $("#dvcompany").show();
                } else {
                    $("#dvcompany").hide();
                }
                if ($('#vendortype').val() == 3) {
                    $("#dvsuperfund").show();
                } else {
                    $("#dvsuperfund").hide();
                }
                if ($('#vendortype').val() == 4) {
                    $("#dvindividual").show();
                } else {
                    $("#dvindividual").hide();
                }
                if ($('#vendortype').val() == 4) {
                    $("#individual").show();
                } else {
                    $("#individual").hide();
                }
                if ($('#vendortype').val() == 5) {
                    $("#other").show();
                } else {
                    $("#other").hide();
                }
           /******* Individual ********/
                 if ($('#migrating').val() == 1) {
                    $("#returning ").hide();
                }  else {
                    $("#returning ").show();
                    $("#austra ").show();
                } 
                if ($('#migrating').val() == 1) {
                    $("#austra ").show();
                }  
                   $("#otherdata").click(function () {
					if ($(this).is(":checked")) {
						$(".stayed").show();
					}else {
						$(".stayed").hide();
					}
				}); 
				
                if ($('#return_australia').val() == 1) {
                    $("#main_purpose ").show();
                }  else {
                    $("#main_purpose ").hide();
                } 
                if ($('#return_australia').val() == 2) {
                    $("#stayed_australia ").show();
                }  else {
                    $("#stayed_australia ").hide();
                } 

               if ($('#continu_aus').val() == 1) {
                    $("#outsidaus ").show();
                }  else {
                    $("#outsidaus ").hide();
                } 
                if ($('#outside_aus').val() == 1) {
                    $("#intend_aus ").show();
                }  else {
                    $("#intend_aus ").hide();
                }

				 if ($('#child').val() == 1) {
                    $("#spouse ").show();
                }  else {
                    $("#spouse ").hide();
                }
                /*******company********/

              if ($('#company_aus').val() == 1) {
                    $("#cmp_details ").hide();
                }  else {
                    $("#cmp_details ").show();
                } 

                /*******trust********/

                 if ($('#unit_turst').val() == 1) {
                    $("#property ").show();
                }  else {
                    $("#property ").hide();
                } 
                 if ($('#unit_turst').val() == 2) {
                    $("#resident ").show();
                }  else {
                    $("#resident ").hide();
                } 

}

          if($('#hdnVedorId').val() != "" || $('#hdnVedorId').val() != "0")
        {
       divHIdeAndshow();    

        }
		
      /******* vendortype ********/
		
            $("#vendortype").change(function () {
              

              divHIdeAndshow();  
				
				
            });
         /******* Individual ********/
			
			$('#migrating').on('change', function() {
                divHIdeAndshow();  
				 
			 });
			$('#return_australia').on('change', function() {
                divHIdeAndshow();  
				 
			 });
			$('#continu_aus').on('change', function() {
                 divHIdeAndshow();  
				
			 });
			$('#outside_aus').on('change', function() {
                 divHIdeAndshow();  
				
			 });
			 $('#child').on('change', function() {
                 divHIdeAndshow();  
				
			 });
           /*******company********/
			
			$('#company_aus').on('change', function() {
                 divHIdeAndshow(); 
				
			 });
              /*******trust********/
			
			$('#unit_turst').on('change', function() {
                divHIdeAndshow(); 
				
			 });
			
		
});		
	
			
		


</script>
 
   