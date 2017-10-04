 <?php   
       echo $layout['header'] ;
       echo $layout['sidebar'] ; 
 ?>   
  
 <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                         <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase"> Subadmin List</span>
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body table-responsive" >
                                        
										<table id="example" class="table table-striped table-bordered " >
                                       
                                            <thead>
                                                <tr>
                                                    <th> S No. </th>
                                                    <th> Name </th>
                                                    <th> Email </th>
                                                    <th> Contact No. </th>
                                                    
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if(!empty($showing_subadmin)){ $i=1;foreach($showing_subadmin as $data){?>
                                                <tr  class="odd gradeX" >
                                                    
                                                    <td><?php echo $i;?> </td>
                                                    <td> <?php echo ucwords(strtolower($data->fullname));?></td>
                                                    <td> <?php echo $data->email;?></td>
                                                    <td> <?php echo $data->contact_no;?></td>
                                                    
                                                </tr>
											<?php $i++; }}?> 
                                            </tbody>
                                        </table>
										
                                    </div>
									<?php //echo "<pre>"; print_r($showing_subadmin);?>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                      
                      
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                
 <?php   echo $layout['footer'] ; ?>         
 
<script type="text/javascript">
           $(document).ready(function(){
				$('#example').DataTable();
			  $(".subadmin").addClass('active');
              $(".subadmin ul").removeClass('active'); 
              $(".listsubadmin").addClass('active');
				
            }); 
			
		
			
			
			
        </script>
   