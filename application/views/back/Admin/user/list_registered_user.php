<?php   
       echo $layout['header'] ;
       echo $layout['sidebar'] ; 
 ?>   
  

<!-- BEGIN CONTENT -->
              <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">

<!-- BEGIN PAGE BAR -->
                       
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered ">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase">Registered User</span>
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body table-responsive">
                                        <div class="table-toolbar">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    
                                                </div>
                                                <div class="col-md-6 hidden">
                                                    <div class="btn-group pull-right">
                                                        <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-print"></i> Print </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<table id="example" class="table table-striped table-bordered" >
                                       
                                            <thead>
                                                <tr>
                                                    <th>S No.</th>
                                                    <th>User name</th>
                                                    <th>Email</th>
                                                    <th>Contact No</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if(!empty($user_data)){ $i=1;foreach($user_data as $data){?>
                                                <tr  class="odd gradeX" >
                                                    
                                                    <td><?php echo $i;?> </td>
                                                    <td>
                                                       <?php echo ucwords(strtolower($data->name));?></td>
                                                    <td> <?php echo $data->email;?> </td>
                                                    <td><?php echo $data->phone;?> </td>
													 
                                                </tr>
											<?php $i++; }}?> 
                                            </tbody>
                                        </table>
										
                                    </div>
									<?php //echo "<pre>"; print_r($user_data);?>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                      
                      
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                
                    <!-- END CONTENT BODY -->
<?php   echo $layout['footer'] ; ?>
 


<script  type="text/javascript">
       
	      $(document).ready(function()
            {
			$('#example').DataTable();
			$(".registereduser_list").addClass('active');
           $(".registereduser_list ul").removeClass('active'); 
           $(".registereduser").addClass('active');
				
				
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
		
</script>		

					
					
					