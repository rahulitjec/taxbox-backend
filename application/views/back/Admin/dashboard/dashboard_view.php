<?php   echo $layout['header'] ; ?>
<?php   echo $layout['sidebar'] ; ?>
<style>
.mt-action-datetime{

    vertical-align: top !important;
    display: table-cell !important; 
    width: 400px !important;
    white-space: nowrap !important;
     padding-top: 0px !important;
     color: #333 !important;
}
	
}

</style>
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                      
                        <!-- BEGIN PAGE BAR -->
                        <!--div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Dashboard</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
                                <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                                    <i class="icon-calendar"></i>&nbsp;
                                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                        </div-->
                       
                        <div class="row">
                            
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="<?php 
											$adminid =  $this->session->userdata('token');
					                        $id 	 =   base64_decode($adminid);
											if($id==1){
											echo (!empty($usercount_data)) ? count($usercount_data) : ''; 
											
											}else{
												
												echo (!empty($usercount_subadmin)) ? count($usercount_subadmin) : ''; 
											
											}?>">0</span>
                                        </div>
                                        <div class="desc"> Total User </div>
                                    </div>
                                </a>
                            </div>
							
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="<?php
											$adminid  =  $this->session->userdata('token');
					                        $id 	  =   base64_decode($adminid);
											if($id==1){
											echo (!empty($vendorcount_data)) ? count($vendorcount_data) : '';
											
											}else{
												
												echo (!empty($vendorcount_subadmin)) ? count($vendorcount_subadmin) : ''; 
											
											}
											
											?>">0</span> </div>
                                        <div class="desc"> Total Form</div>
                                    </div>
                                </a>
                            </div>
							
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="<?php 
											$adminid  =  $this->session->userdata('token');
					                        $id 	  =   base64_decode($adminid);
											if($id==1){
											echo (!empty($submitcount_data)) ? count($submitcount_data) : '';
											
											}else{
												
												echo (!empty($countsubmitform)) ? count($countsubmitform) : ''; 
											
											}
											?>">0</span>
                                        </div>
                                        <div class="desc">Total Submitted Form </div>
                                    </div>
                                </a>
                            </div>
                           
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                              <div class="col-lg-6 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption">
                                            <i class=" icon-social-twitter font-dark hide"></i>
                                            <span class="caption-subject font-dark bold uppercase">Recent User</span>
                                        </div>
                                        <!--ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_actions_pending" data-toggle="tab"> Pending </a>
                                            </li>
                                            <li>
                                                <a href="#tab_actions_completed" data-toggle="tab"> Completed </a>
                                            </li>
                                        </ul-->
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_actions_pending">
                                                <!-- BEGIN: Actions -->
                                                <div class="mt-actions">
												 <?php 
												 $adminid  =  $this->session->userdata('token');
					                             $id 	  =   base64_decode($adminid);
											  if($id==1){
												 
												 if(!empty($latestuser)){$i=1; foreach($latestuser as $data){?>
                                                    <div class="mt-action">
                                                        <div class="mt-action-img">
                                                            <?php echo $i;?> </div>
                                                        <div class="mt-action-body">
                                                            <div class="mt-action-row">
                                                                <div class="mt-action-info ">  
                                                                    <div class="mt-action-details ">
                                                                        <span class="mt-action-author"><?php echo ucwords(strtolower($data->name));?></span> 
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-datetime ">
																<span class="mt-action-author"><?php echo $data->email;?></span> 
                                                                    
                                                                </div>
                                                                <div class="mt-action-buttons" style="text-center:left !important;padding-top: 0px !important;">
                                                                    <div class="btn-group btn-group-circle">
                                                                         <span class="mt-action-author"><?php echo $data->phone;?></span> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
											  <?php $i++; }}} else{
													 
													 if(!empty($usercount_subadmin)){$i=1; foreach($usercount_subadmin as $data){?>
                                                    <div class="mt-action">
                                                        <div class="mt-action-img">
                                                            <?php echo $i;?> </div>
                                                        <div class="mt-action-body">
                                                            <div class="mt-action-row">
                                                                <div class="mt-action-info ">  
                                                                    <div class="mt-action-details ">
                                                                        <span class="mt-action-author"><?php echo ucwords(strtolower($data['name']));?></span> 
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-datetime ">
																<span class="mt-action-author"><?php echo $data['email'];?></span> 
                                                                    
                                                                </div>
                                                                <div class="mt-action-buttons" style="text-center:left !important;padding-top: 0px !important;">
                                                                    <div class="btn-group btn-group-circle">
                                                                         <span class="mt-action-author"><?php echo $data['phone'];?></span> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
											  <?php $i++; }}
													 
												 } ?>
                                                </div>
                                                <!-- END: Actions -->
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <div class="col-lg-6 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption">
                                            <i class=" icon-social-twitter font-dark hide"></i>
                                            <span class="caption-subject font-dark bold uppercase">Recent Vendor</span>
                                        </div>
                                        <!--ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_actions_pending" data-toggle="tab"> Pending </a>
                                            </li>
                                            <li>
                                                <a href="#tab_actions_completed" data-toggle="tab"> Completed </a>
                                            </li>
                                        </ul-->
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_actions_pending">
                                                <!-- BEGIN: Actions -->
                                                <div class="mt-actions">
												 <?php 
												  if($id==1){
												 if(!empty($latestvendor)){$i=1; foreach($latestvendor as $data){?>
                                                    <div class="mt-action">
                                                        <div class="mt-action-img">
                                                            <?php echo $i;?> </div>
                                                        <div class="mt-action-body">
                                                            <div class="mt-action-row">
                                                                <div class="mt-action-info ">  
                                                                    <div class="mt-action-details ">
                                                                        <span class="mt-action-author"><?php echo ucwords(strtolower($data->full_name));?></span> 
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-datetime ">
																<span class="mt-action-author"><?php echo $data->email_address;?></span> 
                                                                    
                                                                </div>
                                                                <div class="mt-action-buttons" style="text-center:left !important;padding-top: 0px !important;">
                                                                    <div class="btn-group btn-group-circle">
                                                                         <span class="mt-action-author"><?php echo $data->phone_no;?></span> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
												  <?php $i++; }} }else{ 
													   if(!empty($latestvendor_subadmin)){$i=1; foreach($latestvendor_subadmin as $data){?>
													 
													  <div class="mt-action">
                                                        <div class="mt-action-img">
                                                            <?php echo $i;?> </div>
                                                        <div class="mt-action-body">
                                                            <div class="mt-action-row">
                                                                <div class="mt-action-info ">  
                                                                    <div class="mt-action-details ">
                                                                        <span class="mt-action-author"><?php echo ucwords(strtolower($data->full_name));?></span> 
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-datetime ">
																<span class="mt-action-author"><?php echo $data->email_address;?></span> 
                                                                    
                                                                </div>
                                                                <div class="mt-action-buttons" style="text-center:left !important;padding-top: 0px !important;">
                                                                    <div class="btn-group btn-group-circle">
                                                                         <span class="mt-action-author"><?php echo $data->phone_no;?></span> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
													    
													<?php $i++; }}
													 
												 } ?>
                                                </div>
                                                <!-- END: Actions -->
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <?php //echo "<pre>"; print_r($latestvendor_subadmin);?>     
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                
		   </div>
     </div>  
   <?php   echo $layout['footer'] ; ?>   
    <script>

		$(document).ready(function()
		{
			$(".dashboard").addClass('active');
			$(".dashboard").css('background-color',"#36c6d3 !important");
			$(".dashboard a").css('color',"#fff"); 						

		});					 
 
	</script>   
   
