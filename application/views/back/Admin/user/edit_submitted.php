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
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                       
                      
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?php echo base_url();?>Admin/Dashboard">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Edit Vendor Form</span>
                                </li>
                            </ul>
                           
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Foreign resident capital gains withholding clearance certificate application     
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="portlet light bordered" id="form_wizard_1">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class=" icon-layers font-red"></i>
                                            <span class="caption-subject font-red bold uppercase">Clearance certificate application-
                                                <span class="step-title"> Step 1 of 4 </span>
                                            </span>
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body form">
                                 <form class="form-horizontal"  id="submit_form"  >
                                            <div class="form-wizard">
                                                <div class="form-body">
                                                    <ul class="nav nav-pills nav-justified steps">
                                                        <li>
                                                            <a href="#tab1" data-toggle="tab" class="step">
                                                                <span class="number"> 1 </span>
                                                                <span class="desc">
                                                                    <i class="fa fa-check"></i> Vendor Details</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab2" data-toggle="tab" class="step">
                                                                <span class="number"> 2 </span>
                                                                <span class="desc">
                                                                    <i class="fa fa-check"></i> Transaction Dates</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab3" data-toggle="tab" class="step active">
                                                                <span class="number"> 3 </span>
                                                                <span class="desc">
                                                                    <i class="fa fa-check"></i> Clearance Certificate Application Questions</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab4" data-toggle="tab" class="step">
                                                                <span class="number"> 4 </span>
                                                                <span class="desc">
                                                                    <i class="fa fa-check"></i> Vendor Type </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div id="bar" class="progress progress-striped" role="progressbar">
                                                        <div class="progress-bar progress-bar-success"> </div>
                                                    </div>
                                                    <div class="tab-content">
                                                        <!--div class="alert alert-danger display-none">
                                                            <button class="close" data-dismiss="alert"></button>  </div-->
                                                        <div class="alert alert-success display-none" id="vendorinfo">
                                                              </div>
                                           <div class="tab-pane active" id="tab1"> 
                                                       <h3 class="block">Vendor details</h3> 
													<input type="hidden" name="vendorid"  id="hdnVedorId" class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->id : '';?>" />
												    <div class="form-group">
                                                    <label class="control-label col-md-3">Tax File Number
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-2"> 
													  <input type="hidden" name="user_id"  class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->user_id : '';?>" />
													  
                                                        <input type="text" name="tax_no"  class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->tax_file_no : '';?>" placeholder="Tax file number"/> </div>
														 <label class="control-label col-md-1">OR   ABN
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-2"> 
                                                        <input name="abn_no" type="text" class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->abn_no : '';?>" placeholder="ABN"/> </div>
														
                                                </div> 
                                                   
												<div class="form-group">
                                                    <label class="control-label col-md-3">Full Name
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input name="fullname" type="text" class="form-control" value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->full_name : '';?>"  placeholder="Full name" />
                                                       
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Vendor Type
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control"  id="vendortype" name="vendor_type">
                                                            <option value="">Select...</option>
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
                                                <div class="form-group" id="individual" style="display:none;">
                                                    <label class="control-label col-md-3">Vendor Date Of Birth
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4 date">
                                                        <input name="individual_date_birth" type="text" class="datepicker resizetag" data-provide="datepicker" value="<?php echo (!empty($vendor_data[0]->date_of_birth)) ? $vendor_data[0]->date_of_birth : '';?>" placeholder="Vendor Date Of birth"/> 
														
														</div>
                                                </div>
                                                <div class="form-group" id="trust" style="display:none;">
                                                    <label class="control-label col-md-3">Name Of Trustee
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="name_of_trustee" class="form-control" value="<?php echo (!empty($vendor_data[0]->name_of_trustee )) ? $vendor_data[0]->name_of_trustee : '' ;?>" placeholder="Name of trustee" />
                                                       
                                                    </div>
                                                </div>
                                                <div class="form-group" id="other" style="display:none;">
                                                    <label class="control-label col-md-3">Other&nbsp;&nbsp;</label>
                                                    <div class="col-md-4">
                                                        <input name="other" type="text" class="form-control"placeholder="Other" />
                                                        <!--span class="help-block"> Description </span-->
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Email address of vendor
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="email"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->email_address : '';?>" placeholder="Email address"> 
                                                    </div>
                                                </div>

                                                   <div class="form-group">
                                                    <label class="control-label col-md-3">Phone number of the vendor (including area code)
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                       
                                                            <input type="text" class="form-control" name="phone_no"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->phone_no : '';?>"placeholder="Phone number"> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Address of vendor (including postcode)
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        
                                                            <input type="text" class="form-control" name="addr_vendor"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->address_of_vendor : '';?>"placeholder="Address of vendor"> 
                                                    </div>
                                                    </div>
									      </div>
                                           <div class="tab-pane" id="tab2">
                                                            <h3 class="block">Transaction dates</h3>
                                                 <div class="form-group" >
                                                    <label class="control-label col-md-3">Contact date(if known)
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4 date" >
                                                        <input  class="datepicker resizetag" data-provide="datepicker"  type="text" name="contact_date"   value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->contact_date : '';?>" placeholder="Contact date"/> 
														
                                                     </div>
												</div>
                                                <div class="form-group ">
                                                    <label class="col-md-3 control-label">Expected settlement date
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4 date">
                                                        
                                                        <input class="datepicker resizetag" data-provide="datepicker" type="text" name="expected_date"  value="<?php echo (!empty($vendor_data)) ? $vendor_data[0]->expected_date : '';?>" placeholder="Expected settlement date"> 
															
                                                    </div>
                                                </div>
											
                                             </div>
                                           <div class="tab-pane" id="tab3">
                                               <h3 class="block"> Clearance certificate application questions</h3>
                                               <div class="form-group">
                                                    <label class="control-label col-md-3 ">1. Has your residency status changed since your last tax return or will it change before you sell the asset?
                                                    <span class="required">*</span>	</label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="residency_status">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 ">2. Have you lodged an Australian tax return for the last two years?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="australian_tax">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 ">3. Are you holding the property on behalf of a foreign resident or on behalf of other entities that include foreign resident?
													<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="holding_property">
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
                  <div class="tab-pane" id="tab4">
                           <h3 class="block">Vendor Type</h3>
                                                           
                         <div class="row vdtype" id="dvindividual" style="display:none;">
                            <div class="col-md-12">
                                <!-- BEGIN VALIDATION STATES-->
                                <div class="portlet light portlet-fit portlet-form bordered">
                                    <div class="portlet-title">
                                        <div class="caption"> 
                                            <span class="caption-subject font-dark sbold uppercase">  Individual</span>
                                        </div>
                                       
                                    </div>
								
                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                        <div class="form-body">
                                       <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">1. Are you migrating and settling in Australia or have been settled in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" id="migrating" name="migrating_settling_australia">
                                                            <option value="">Select...</option>
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
                                      
                                            <div id="returning" >
                                            <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">2. Are you an Australian returning to live in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="returning_live_australia" id="return_australia">
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
                                             <div id="main_purpose">
                                               <span class="sbold" style="font-weight: 400;">2.1  is your main purpose for being in Australia? </span><br> 
                                              <br>
                                               <div class="form-group">
                                                    <label class="control-label col-md-3">Employment contract or permanent employment</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
                                                            <input type="checkbox"  name="employment_contract_permanent_employment" value="true"<?php 
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Exchange program or full time research</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Full time education</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Holidaying or casual employmen</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Visiting friends or relatives</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Other</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> 
                                                         <input type="checkbox"  name="other" value="true" 		
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
                                                </div><br>
                                                 <div class="form-group">
                                                    <label class="control-label col-md-3">Have you stayed or do you intend to stay in a particular place continuously for six months or more? 
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="have_you_stayed_or_do_you_intend_stay">
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
                                              <span class="sbold" style="font-weight: 400;"> Where do you live in Australia? </span><br>
                                              
                                               <div class="form-group">
                                                    <label class="control-label col-md-3">Staying with family, friends</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Hotel, motel, hostel or caravan</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">University campus</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Own or buying a home</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Renting or leasing accommodation</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <br> 
                                               <div class="form-group">
                                                    <label class="control-label col-md-3">Do you have a spouse and/or dependant children?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="spouse_dependant_children">
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
                                                <span class="sbold" style="font-weight: 400;">Where are your spouse and/or dependent children?</span><br>
                                               <div class="form-group">
                                                    <label class="control-label col-md-3">Currently living with you</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Remaining overseas</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Coming to live with you</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Some with you and some remaining overseas</label>
                                                    <div class=" col-md-4 mt-checkbox-list">
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
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">Where do you hold the majority of your assets? 
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="hold_majority_of_your_assets">
                                                            <option value="">Select...</option>
                                                              <?php if(!empty($vendor_data[0]->hold_majority_of_your_assets)){ 
														   if($vendor_data[0]->hold_majority_of_your_assets==1){?>
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">Are you a member of any clubs, churches community groups or organisations in Australia? 
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="are_you_member_of_any_clubs_churches_community">
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
                                                 <div id="stayed_australia">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">2.2 Have you stayed or do you intend to stay in Australia for six months or more?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="have_you_stayed_or_do_you_intend_stay_australia_six_month">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">2.3 Do you have social or economic ties to a country other than Australia? Y 
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="social_or_economic_ties_to_country">
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
                                                </div></div>
												</div>
												<div id="austra">
                                                <div class="form-group" >
                                                    <label class="control-label col-md-3 sbold">3 Have you been in Australia, either continuously or intermittently,
                                                   for 183 days or more in the current income year?* 
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="intermittently_183day" id="continu_aus">
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
												<div id="outsidaus">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">3.1 Is your usual place of abode outside of Australia?*

                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="place_of_abode_outside_australia" id="outside_aus">
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
												<div id="intend_aus">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">3.1.1 Do you intend to take up residence in Australia? 
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                </div></div>
												</div>
												</div>
                                            </div>
                                       
                                    </div>
                                    <!-- END VALIDATION STATES-->
                                </div>
                            </div>
                        </div>
						  <div class="row vdtype" id="dvcompany" style="display:none;">
                            <div class="col-md-12">
                                <!-- BEGIN VALIDATION STATES-->
                                <div class="portlet light portlet-fit portlet-form bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                         <span class="caption-subject font-dark sbold uppercase"> Company</span>
                                        </div>    
                                    </div>
									
                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                       
                                            <div class="form-body">
                                                 <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">Is the company incorporated in Australia?*
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="is_company_incorporated_in_australia" id="company_aus">
                                                            <option value="">Select...</option>
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
												<div id="cmp_details" >
												<span style="font-size:13px;">Complete the following details:</span><br><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Is any of the property of the company situated in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Does the company carry on business in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Is the company central management and control in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Is the company voting power controlled by shareholders who are resident in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                    <!-- END VALIDATION STATES-->
                                </div>
                            </div>
                        </div>
						  <div class="row vdtype" id="dvtrust" style="display:none;">
                            <div class="col-md-12">
                                <!-- BEGIN VALIDATION STATES-->
                                <div class="portlet light portlet-fit portlet-form bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                           <span class="caption-subject font-dark sbold uppercase"> Trust</span>
                                        </div>
                                       
                                    </div>								         
                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                       
                                            <div class="form-body">
                                                 <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">Is this a unit trust?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="is_this_unit_trust" id="unit_turst">
                                                            <option value="">Select...</option>
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
												<div id="property">
												<span style="margin-left:20px;">Complete the following details:</span><br><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Is any of the property of the trust situated in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Does the trust carry on a business in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Is the trust central management & control in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Do Australian residents hold more than 50% of the beneficial interests in the income or
                                                      property of the trust?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
											<div id="resident">
                                                <span style="margin-left:20px;">Complete the following details: </span><br><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Is the trustee of the trust an Australian resident?
                                                      <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Is the trust central management & control in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                    <!-- END VALIDATION STATES-->
                                </div>
                            </div>
                        </div>
						  <div class="row vdtype" id="dvsuperfund" style="display:none;">
                            <div class="col-md-12">
                                <!-- BEGIN VALIDATION STATES-->
                                <div class="portlet light portlet-fit portlet-form bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                             <span class="caption-subject font-dark sbold uppercase"> Super fund</span>
                                        </div>
										</div> 
                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                       
                                            <div class="form-body">
                                                 <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">1. Is the entity an Australian Superannuation Fund?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">2. Was the fund established in Australia or is any asset of the fund situated in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">3. Is the funds central management & control in Australia?
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">4. Does the fund have any member/s who were either?
                                                        <span class="required"> * </span><br>
                                                    <span style="font-size:12;">A contributor in the fund at that time<br> OR<br>
                                                    An individual on whose behalf contributions have been made? (unless the individual is a foreign resident and who is not a contributor at the time and for whom contributions made to the fund on their behalf after the individual became a foreign resident are only payments in respect of a time when the individual was an Australian resident)</span></label>
                                                    <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 sbold">5. Do either of the following apply?
                                                        <span class="required"> * </span><br><br>
														<span style="font-size:12;">At least 50% of the total market value of the fund’s assets attributable to superannuation interests held by active members is attributable to Australian residents?<br> OR<br>
                                                        At least 50% of the sum of the amounts that would be payable to or in respect of active members if they voluntarily ceased to be members is attributable to Australian residents?</span>
                                                    </label>
                                                    <div class="col-md-4">
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
                                    <!-- END VALIDATION STATES-->
                                </div>
                            </div>
                        </div> 
                   </div>
                      </div>
                        </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <a href="javascript:;" class="btn default button-previous">
                                                                <i class="fa fa-angle-left"></i> Back </a>
                                                            <a href="javascript:;" onclick="coutinueAction()"  class="btn btn-outline green button-next dtype" findvtype="<?php echo !empty($vendor_data) ? $vendor_data[0]->vendor_type : '';?>"> Continue
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                            <button  class="btn green button-submit"> Submit</button>
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
										<?php //echo "<pre>";print_r($vendor_data);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
             
            </div>
            <!-- END CONTAINER -->
         
        <div class="quick-nav-overlay"></div>
<?php   echo $layout['footer'] ; ?>		
   <script type="text/javascript">
    
    $('document').ready(function(e) {   
                        
        $(".resident").addClass('active');
        $(".resident ul").removeClass('active'); 
        $(".residents").addClass('active');
		
	$('.datepicker').datepicker();
		
    
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
                } 
                if ($('#migrating').val() == 2) {
                    $("#austra ").hide();
                }  else {
                    $("#austra ").show();
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
           /*******company********/
			
			$('#company_aus').on('change', function() {
                 divHIdeAndshow(); 
				
			 });
              /*******trust********/
			
			$('#unit_turst').on('change', function() {
                divHIdeAndshow(); 
				
			 });
         
			
		
});
 $(".dtype").click(function () {
	 var ftype= $(".dtype").attr('findvtype');
	  if(ftype==4){
	   $("#dvindividual").trigger("click").show();
	  }else if(ftype==3){
		  $("#dvsuperfund").trigger("click").show();
	  }else if(ftype==2){
		   $("#dvcompany").trigger("click").show();
	 }else if(ftype==1){ 
	 $("#dvtrust").trigger("click").show();
     }else{	 
	 }	      
    }); 
</script>
 <script type="text/javascript">
  function coutinueAction(){
	 
	  var formdata=new FormData($('#submit_form')[0]);
   
    $.ajax({
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        url:'<?php echo site_url();?>/Admin/edit_submittedform_action',
        beforeSend:function(){
            $('.error').remove();
            $('.loader').show();
			
        },
        success:function(response){
            var data = $.parseJSON(response);
            if(data.status == true){
                 $('#vendorinfo').html(data.message).show();
			    setTimeout(function(){$('#vendorinfo').fadeOut();},
                3000);
				$('.loader').hide();
 
        }else{
            $('#submit_form').prepend('<p style="color:#e73d4a !important;" class="alert alert-danger error">'+data.message+'</p>');
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div').append(value);
            });
        }

        }
       
 
    });
	  
	  
	  
  }
  
 
  $('#submit_form').submit(function(e){
    e.preventDefault();
   var formdata=new FormData($(this)[0]);
   var iscomplete=btoa(1);
    $.ajax({
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        url:'<?php echo site_url();?>/Admin/edit_submittedform_action/'+iscomplete,
        beforeSend:function(){
            $('.error').remove();
			 $('.loader').show();
        },
        success:function(response){
            var data = $.parseJSON(response);
            if(data.status == true){
                $('#vendorinfo').html(data.message).show();
			    setTimeout(function(){$('#vendorinfo').fadeOut();},
                3000);
				 $('.loader').hide();
 
        }else{
			  
            $('#submit_form').prepend('<p style="color:#e73d4a !important;" class="alert alert-danger error">'+data.message+'</p>');
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div.col-xs-12').append(value);
            });
			
        }

        }
       

    });

  })
</script>
   