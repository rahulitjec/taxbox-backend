 <style>
   .resizetag{
	 width: 100%; 
     height: 34px;
     padding: 6px 12px;
     border: 1px solid #c2cad8;
   }
 
 </style> <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" style="min-height:867px;background:#f2f3f8" id="pageHide">
                        <form  class="horizontal-form" id="vendor_form"  >
                        <div class="row">
                            <div class="col-md-12">
                              <div class="tabbable-line boxless tabbable-reversed">
                                 <div class="tab-content col-md-8">
                                         <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-equalizer font-blue-hoki"></i>
                                                        <span class="caption-subject font-blue-hoki bold uppercase">FRCGW Clearance Certificate</span> 
                                                    </div>
                                                </div>
												
                                                <div class="portlet-body form" >
                                                     <div class="form-body">
                                                            <h3 class="form-section">Vendor details</h3>
															<?php if( !empty($this->uri->segment(2))) {
															$vid=base64_decode($this->uri->segment(2));?>
															  <input type="hidden" name="vendorid"  id="hdnVedorId" class="form-control" 
															value="<?php echo (!empty($vid)) ? $vid : ''?>" />
															<?php  }else{  }?>
												     <input type="hidden" id="hvid"   
												    value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->id : ''?>" />
                                                            <div class="row">
                                                                <div class="col-md-8 " >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Tax File Number<span class="required"> * </span></label>
                                                                        <input type="hidden" name="user_id"  class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->user_id : '';?>" />
																		<input type="text" name="tax_no"  class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->tax_file_no : '';?>" placeholder="Tax file number"/> 
                                                                       
                                                                    </div>
                                                                </div>
																</div>
																<div class="text-center" >OR</div>
																<div class="row">
																<div class="col-md-8 " >
                                                                    <div class="form-group">
                                                                        <label class="control-label"> ABN<span class="required"> * </span></label>
                                                                        <input name="abn_no" type="text" class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->abn_no : '';?>" placeholder="ABN"/> 
                                                                       
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
											
                                                            <!--/row-->
                                                            <div class="row">
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label for="inputName" class="control-label">Full Name  <span class="required"> * </span></label>
                                                                        <input name="fullname" data-error="Please enter name field." id="inputName" type="text" class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->full_name : '';?>"  placeholder="Full name" />
                                                                        
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
															
															
															 <div class="row">
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                      <label class="control-label">Vendor Type  <span class="required"> * </span></label>
                                                                        <select class="form-control"  id="vendortype" name="vendor_type">
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
															<div class="col-md-8 " >
																<div class="form-group">
																	<label class="control-label">Vendor Date Of Birth <span class="required"> * </span></label>
																	 <input name="individual_date_birth" type="text"  class="datepicker resizetag" data-provide="datepicker" value="<?php echo (!empty($vendor_data[0]->date_of_birth)) ? $vendor_data[0]->date_of_birth : '';?>" placeholder="Vendor Date Of birth"/> 
																	
																	
																</div>
															</div>
														</div>
														<div class="row" id="trust" style="display:none;">
															<div class="col-md-8 " >
																<div class="form-group">
																	<label class="control-label">Name Of Trustee <span class="required"> * </span></label>
																	<input type="text" name="name_of_trustee"  class="form-control" value="<?php echo (!empty($vendor_data[0]->name_of_trustee )) ? $vendor_data[0]->name_of_trustee : '' ;?>" placeholder="Name of trustee" />
																	
																</div>
															</div>
														</div>
														<div class="row" id="other" style="display:none;">
															<div class="col-md-8 " >
																<div class="form-group">
																	<label class="control-label">Other <span class="required"> * </span></label>
																	 <input name="other" type="text" class="form-control"placeholder="Other" />
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-8 " >
																<div class="form-group">
																	<label class="control-label">Email address of vendor <span class="required"> * </span></label>
																	  <input type="text" class="form-control" name="email"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->email_address : '';?>" placeholder="Email address">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-8">
																<div class="form-group">
																	<label class="control-label">Phone number of the vendor  <span class="required"> * </span></label>
																	  <input type="text" class="form-control" name="phone_no"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->phone_no : '';?>"placeholder="Phone number"> 
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-8" >
																<div class="form-group">
																	<label class="control-label">Address of vendor <span class="required"> * </span></label>
																	   <input type="text" class="form-control" name="addr_vendor"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->address_of_vendor : '';?>"placeholder="Address of vendor"> 
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
                                   <div class="tab-content col-md-8 ">
                                      <div class="portlet light bordered">
                                            <div class="portlet-body form" >
                                                    <div class="form-body">
                                                            <h3 class="form-section">Transaction dates</h3>

                                                            <div class="row">
															
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Contract date(if known) <span class="required"> * </span></label>
                                                                        <input  class="datepicker resizetag"  data-provide="datepicker"  type="text" name="contact_date"   value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->contact_date : '';?>" placeholder="Contract date"/> 
   
                                                                    </div>
                                                               
                                                               </div>
                                                               <div class="col-md-8">
                                                                    <div class="form-group"  >
                                                                        <label class="control-label">Expected settlement date<span class="required"> * </span></label>
                                                                        <input class="datepicker resizetag"  data-provide="datepicker" type="text" name="expected_date"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->expected_date : '';?>" placeholder="Expected settlement date"> 
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
                                   <div class="tab-content col-md-8">
                                        <div class="portlet light bordered">
                                              <div class="portlet-body form" >
                                                   <div class="form-body">
                                                            <h3 class="form-section">Clearance certificate application questions</h3>
                                                            <div class="row">
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">1. Has your residency status changed since your last tax return or will it change before you sell the asset?</label>
                                                                      <select class="form-control" name="residency_status" >
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
                                                                 <div class="col-md-8" >
                                                                    <div class="form-group ">
                                                                        <label class="control-label">2. Have you lodged an Australian tax return for the last two years? <span class="required">* </span></label>
                                                                          <select class="form-control" name="australian_tax" >
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">3. Are you holding the property on behalf of a foreign resident or on behalf of other entities that include foreign resident?
													                    <span class="required">*</span></label>
                                                                        <select class="form-control" name="holding_property" >
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
                                   <div class="tab-content col-md-8">
                                       
                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-equalizer font-blue-hoki"></i>
                                                        <span class="caption-subject font-blue-hoki bold uppercase">Vendor Type</span> 
                                                    </div> 
                                                </div>
                                                <div class="portlet-body form"  style="margin-left:1%">
                                                   
                                                        <div class="form-body">
                                                            <h3 class="form-section">Individual</h3>
                                                            <div class="row">
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="sbold control-label">1. Are you migrating and settling in Australia or have been settled in Australia?
                                                                   <span class="required"> * </span></label>
                                                                             <select class="form-control" id="migrating" name="migrating_settling_australia" >
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class=" sbold control-label">2. Are you an Australian returning to live in Australia? <span class="required"> * </span></label>
                                                                       <select class="form-control" name="returning_live_australia" id="return_australia" >
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
															 <span class="" style="font-weight:400;margin-left:15%;">2.1 What is your main purpose for being in Australia? </span><br> 
                                                               <br>
															 <div class="row">
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Employment contract or permanent employment<span class="required"> * </span></label>
                                                                      <div class=" mt-checkbox-list">
																		<label class="mt-checkbox mt-checkbox-outline"> 
																			<input type="checkbox"  name="employment_contract_permanent_employment" value="true" <?php 
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Exchange program or full time research<span class="required"> * </span></label>
                                                                       <div class=" mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
                                                            <input type="checkbox"  name="exchange_program" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Full time education<span class="required"> * </span></label>
                                                                       <div class=" mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
                                                                      <input type="checkbox"  name="full_time_education" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Holidaying or casual employmen<span class="required"> * </span></label>
                                                                       <div class=" mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
                                                                         <input type="checkbox"  name="holidaying_or_casual_employmen" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Visiting friends or relatives<span class="required"> * </span></label>
                                                                       <div class=" mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
															 <input type="checkbox"  name="visiting_friends_or_relatives" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.1.1 Other<span class="required"> * </span></label>
                                                                       <div class=" mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
															    <input type="checkbox"  name="other" value="true" 	id="otherdata"	
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.1.1.1 Have you stayed or do you intend to stay in a particular place continuously for six months or more? <span class="required"> * </span></label>
                                                                    <select class="form-control" name="have_you_stayed_or_do_you_intend_stay" >
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
													 <span class="" style="font-weight:400;margin-left:0%;">2.1.1.2 Where do you live in Australia? </span><br>
													  <div class="row">
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Staying with family, friends<span class="required"> * </span></label>
                                                                    <div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline"> 
																		<input type="checkbox"  name="live_in_australia_family_friends" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Hotel, motel, hostel or caravan<span class="required"> * </span></label>
                                                                    <div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline"> 
																		  <input type="checkbox"  name="live_in_australia_hotel_motel" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">University campus<span class="required"> * </span></label>
                                                                    <div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline"> 
																		   <input type="checkbox"  name="live_in_australia_university_campus" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Own or buying a home<span class="required"> * </span></label>
                                                                    <div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline"> 
																		     <input type="checkbox" name="live_in_australia_own_buying_home" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Renting or leasing accommodation<span class="required"> * </span></label>
                                                                    <div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline"> 
																		   <input type="checkbox"  name="live_in_australia_renting_leasing_accommodation" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.1.1.3 Do you have a spouse and/or dependant children?<span class="required"> * </span></label>
                                                                     <select class="form-control" name="spouse_dependant_children" id="child">
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
													    <span class="" style="font-weight:400;margin-left:15%;">Where are your spouse and/or dependent children?</span><br>
														 <div class="row">
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Currently living with you<span class="required"> * </span></label>
                                                                     <div class="mt-checkbox-list">
																		<label class="mt-checkbox mt-checkbox-outline"> 
																			<input type="checkbox"  name="currently_living_with_you" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Remaining overseas<span class="required"> * </span></label>
                                                                     <div class="mt-checkbox-list">
																		<label class="mt-checkbox mt-checkbox-outline"> 
																			   <input type="checkbox"  name="remaining_overseas" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Coming to live with you<span class="required"> * </span></label>
                                                                     <div class="mt-checkbox-list">
																		<label class="mt-checkbox mt-checkbox-outline"> 
																			     <input type="checkbox"  name="coming_to_live_with_you" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Some with you and some remaining overseas<span class="required"> * </span></label>
                                                                     <div class="mt-checkbox-list">
																		<label class="mt-checkbox mt-checkbox-outline"> 
																			   <input type="checkbox"  name="some_with_you_and_remaining_overseas" value="true" 		
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.1.1.4 Where do you hold the majority of your assets? <span class="required"> * </span></label>
                                                                     <select class="form-control" name="hold_majority_of_your_assets" >
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.1.1.5 Are you a member of any clubs, churches community groups or organisations in Australia? <span class="required"> * </span></label>
																<select class="form-control" name="are_you_member_of_any_clubs_churches_community" >
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.2 Have you stayed or do you intend to stay in Australia for six months or more?<span class="required"> * </span></label>
																 <select class="form-control" name="have_you_stayed_or_do_you_intend_stay_australia_six_month" >
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">2.3 Do you have social or economic ties to a country other than Australia? Y <span class="required"> * </span></label>
																		<select class="form-control" name="social_or_economic_ties_to_country" >
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="sbold control-label">3 Have you been in Australia, either continuously or intermittently,
                                                                          for 183 days or more in the current income year?<span class="required"> * </span></label>
																		<select class="form-control" name="intermittently_183day" id="continu_aus" >
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">3.1 Is your usual place of abode outside of Australia?<span class="required"> * </span></label>
																	 <select class="form-control" name="place_of_abode_outside_australia" id="outside_aus" >
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">3.1.1 Do you intend to take up residence in Australia? <span class="required"> * </span></label>
															<select class="form-control" name="intend_to_takeup_residence_in_australia" >
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
                                   <div class="tab-content col-md-8">
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Is this a unit trust?<span class="required"> * </span></label>
                                                                        <select class="form-control" name="is_this_unit_trust" id="unit_turst">
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
														<span style="margin-left:0%;">Complete the following details:</span><br><br>
                                                          <div class="row">
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Is any of the property of the trust situated in Australia?<span class="required"> * </span></label>
                                                                  <select class="form-control" name="property_situated_australia">
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Does the trust carry on a business in Australia?<span class="required"> * </span></label>
                                                                 <select class="form-control" name="trust_carry_business_australia">
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Is the trust central management & control in Australia?<span class="required"> * </span></label>
                                                                 <select class="form-control" name="trust_management_control">
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
                                                               <div class="col-md-8" >
                                                                    <div class="form-group">
                                                            <label class="control-label">Do Australian residents hold more than 50% of the beneficial interests in the income or
                                                        property of the trust?<span class="required"> * </span></label>
                                                                 <select class="form-control" name="australian_resident">
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
                                                         <span style="margin-left:0%;">Complete the following details: </span><br><br> <div class="row">
                                                               <div class="col-md-8" >
                                                                    <div class="form-group">
                                                            <label class="control-label">Is the trustee of the trust an Australian resident?<span class="required"> * </span></label>
                                                                 <select class="form-control" name="is_trustee_aus_resident">
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
                                                              <div class="col-md-8" >
                                                               <div class="form-group">
                                                            <label class="control-label">Is the trust central management & control in Australia?<span class="required"> * </span></label>
                                                                 <select class="form-control" name="management_control_aus">
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
                                   <div class="tab-content col-md-8">
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">Is the company incorporated in Australia?<span class="required"> * </span></label>
                                                                       <select class="form-control" name="is_company_incorporated_in_australia" id="company_aus">
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
														<span class="bold" style="margin-left:0%;">Complete the following details:</span><br><br>
                                                          <div class="row">
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                   <label class="control-label">Is any of the property of the company situated in Australia?<span class="required"> * </span></label>
                                                                  <select class="form-control" name="property_situated_aust">
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                      <label class="control-label">Does the company carry on business in Australia?<span class="required"> * </span></label>
                                                                  <select class="form-control" name="company_carry_business_aus">
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                   <label class="control-label">Is the company central management and control in Australia?<span class="required"> * </span></label>
                                                                  <select class="form-control" name="company_management_aus">
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
                                                               <div class="col-md-8" >
                                                                 <div class="form-group">
                                                            <label class="control-label">Is the company voting power controlled by shareholders who are resident in Australia?<span class="required"> * </span></label>
                                                                 <select class="form-control" name="controlled_shareholders_aus">
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
                                   <div class="tab-content col-md-8">
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                        <label class="control-label">1. Is the entity an Australian Superannuation Fund?<span class="required"> * </span></label>
                                                                        <select class="form-control" name="superannuation_fund">
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                   <label class="control-label">2. Was the fund established in Australia or is any asset of the fund situated in Australia?<span class="required"> * </span></label>
                                                                 <select class="form-control" name="fund_estab_asset_fund">
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                      <label class=" control-label">3. Is the funds central management & control in Australia?<span class="required"> * </span></label>
                                                                 <select class="form-control" name="fund_control_aus">
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
                                                                <div class="col-md-8" >
                                                                    <div class="form-group">
                                                                   <label class="control-label sbold">4. Does the fund have any member/s who were either?
                                                        <span class="required"> * </span><br>
                                                    <span style="font-size:12;">A contributor in the fund at that time<br> OR<br>
                                                    An individual on whose behalf contributions have been made? (unless the individual is a foreign resident and who is not a contributor at the time and for whom contributions made to the fund on their behalf after the individual became a foreign resident are only payments in respect of a time when the individual was an Australian resident)</span></label>
                                                                  <select class="form-control" name="fund_have_any_member">
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
                                                            <div class="col-md-8" >
                                                                 <div class="form-group">
                                                            <label class="control-label sbold">5. Do either of the following apply?
                                                        <span class="required"> * </span><br><br>
														<span style="font-size:12;">At least 50% of the total market value of the fund assets attributable to superannuation interests held by active members is attributable to Australian residents?<br> OR<br>
                                                        At least 50% of the sum of the amounts that would be payable to or in respect of active members if they voluntarily ceased to be members is attributable to Australian residents?</span></label>
                                                                  <select class="form-control" name="do_either_following_apply">
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
						<div class="row">
						         <div class="col-sm-12 form-actions">
												<div class="tabbable-line boxless tabbable-reversed col-md-8" style="padding-left: 0px;padding-right: 0px;">
											       <?php if(!empty($vendor_data)){ 
														if($vendor_data[0]->is_complete==1 && $vendor_data[0]->pay_status==0 ){
															 
															?>
														 <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
														  <a href="<?php echo base_url();?>Dashboard_controller/vendordetails" class="btn default pull-left">Cancel</a>
                                                         </div>	
														<div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
                                                          <button  class="btn green button-submit repaypals pull-right">Update</button>
                                                         </div>
														
														
														<?php }else{ ?>
														  <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
														  <a href="<?php echo base_url();?>Dashboard_controller/vendordetails" class="btn default pull-left">Cancel</a>
                                                         </div>	
														 <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
                                                          <button  class="btn green button-submit repaypals pull-right">Update</button>
                                                         </div>
														
														<?php  }  }else{ ?>
														  <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
														  <a href="<?php echo base_url();?>Dashboard_controller/vendordetails" class="btn default pull-left">Cancel</a>
                                                         </div>	
                                                          <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
                                                          <button  class="btn green button-submit repaypals pull-right">PROCEED TO PAYMENT </button> 	 
                                                         </div>
														 
															<?php }?> 
														<br>
														<br><br><div class="alert alert-success" style="display:none;width:50%;margin-left:50px;" id="vendorinfo"></div>	 
												 </div>
											</div>
												  
								 </div>  
 
						</form> 
						
                     </div> 
                </div>
				 <!-- END CONTENT BODY -->
	       
   <script type="text/javascript">    
    $('document').ready(function(e) {   
             
        $(".resident").addClass('active');
        $(".resident ul").removeClass('active'); 
        $(".residents").addClass('active');
		
		  $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true
    });
		  /******* vendortype ********/
		
            $("#vendortype").change(function () {
              

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
				
				
            });
         /******* Individual ********/
			
			$('#migrating').on('change', function() {
                 if ($('#migrating').val() == 1) {
                    $("#returning ").hide();
                }  else {
                    $("#returning ").show();
					$("#austra ").show();
                } 
                if ($('#migrating').val() == 1) {
                    $("#austra ").show();
                } 
				
				 
			 });
			  $("#otherdata").click(function () {
					if ($(this).is(":checked")) {
						$(".stayed").show();
					}else {
						$(".stayed").hide();
					}
				}); 
			 
			$('#return_australia').on('change', function() {
                
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
				 
			 });
			$('#continu_aus').on('change', function() {
                  if ($('#continu_aus').val() == 1) {
                    $("#outsidaus ").show();
                }  else {
                    $("#outsidaus ").hide();
                } 
				
			 });
			$('#outside_aus').on('change', function() {
                 if ($('#outside_aus').val() == 1) {
                    $("#intend_aus ").show();
                }  else {
                    $("#intend_aus ").hide();
                }   
				
			 });
			 
			 $('#child').on('change', function() {
                if ($('#child').val() == 1) {
                    $("#spouse ").show();
                }  else {
                    $("#spouse ").hide();
                }  
				
			 });
			 
           /*******company********/
			
			$('#company_aus').on('change', function() {
                 if ($('#company_aus').val() == 1) {
                    $("#cmp_details ").hide();
                }  else {
                    $("#cmp_details ").show();
                } 
				
			 });
              /*******trust********/
			 
			$('#unit_turst').on('change', function() {
                
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
				
			 });
	
});



          if($('#hdnVedorId').val() != "" || $('#hdnVedorId').val() != "0")
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
                 
				 if ($('#otherdata').is(":checked")) {
					$(".stayed").show();
				}else {
					$(".stayed").hide();
				} 
				
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
	

</script>
 <script type="text/javascript">
 
 
  $('#vendor_form').submit(function(e){
	  
    e.preventDefault();
   var formdata=new FormData($(this)[0]); 
   var iscomplete=btoa(1);
     var id= btoa($('#hvid').val());
    $.ajax({
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        url:'<?php echo site_url();?>Dashboard_controller/vendorFormAction/'+iscomplete,
        beforeSend:function(){
            $('.error').remove();
            $('.loader').show();
        },
        success:function(response){ 
            var data = $.parseJSON(response);
            if(data.status == true){
                $('#vendorinfo').html(data.message).show();
			     setTimeout(function(){
					 window.location.replace('<?php echo site_url();?>Dashboard_controller/pay_view/'+id);
					 },2000);
				 $('.loader').hide();
 
        }else{
            $('#vendor_form').append('<p style="color:#e73d4a !important;width:50%!important;" class="alert alert-danger error">'+data.message+'</p>');
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div').append(value);
                $('select[name='+key+']').closest('div').append(value);
            });
			setTimeout(function(){$('#vendor_form');},
              3000);
			  $('.loader').hide(); 
        }

        }
       

    });

  })
</script>
                   
              