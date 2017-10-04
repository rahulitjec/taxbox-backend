<?php   
       echo $layout['header'] ;
       echo $layout['sidebar'] ; 
 ?>   
  

<!-- BEGIN CONTENT -->
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
                                            <span class="caption-subject bold uppercase">List Of Allocate Form To Subadmin</span>
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body table-responsive">
                                        <div class="table-toolbar">
                                            <div class="row hidden">
                                                <div class="col-md-6">
                                                    <div class="btn-group  hidden">
                                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                           
                                            </div>
                                        </div>
										<div class="alert alert-success" id="submsg" style="display:none;width:50%;"></div>
										<div class="alert alert-danger error" id="msg" style="display:none;"></div>
								
										<table id="example" class="table table-striped table-bordered display" >
                                       
                                            <thead>
                                                <tr>
												     
                                                    <th>S No.</th>
                                                    <th>Subadmin Name</th>
                                                    <th>User name</th>
                                                    <th>Vendor name</th>
                                                    <th>Vendor Type</th>
                                                    <!--th>Action</th-->
                                                     
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if(!empty($subadmin_data)){ $i=1;foreach($subadmin_data as $data){?>
                                                <tr  class="odd gradeX" >
                                                    <td><?php  echo $i;?> </td>
                                                    <td><?php  echo ucwords(strtolower($data->fullname));?></td>
                                                    <td><?php  echo ucwords(strtolower($data->name));?></td>
                                                    <td><?php  echo ucwords(strtolower($data->full_name));?></td>
                                                    <td><?php  echo ucwords(strtolower($data->type_name));?>  </td>
                                                    <!--td><span class="label label-sm label-danger" onclick="deleteform(<?php echo $data->vendor_id;?>)" style="cursor:pointer;">Delete</span> </td-->
                                                  	 
                                                </tr>
												<?php $i++; }}?>
                                            </tbody>
                                        </table>
										
										
									</div>
									<?php //echo "<pre>"; print_r($subadmin_data);?>
                                </div>
                              
						     	
                            </div>
                        </div>
                      
                      
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                
                    <!-- END CONTENT BODY -->
<?php   echo $layout['footer'] ; ?>
 


<script  type="text/javascript">
          $(document).ready(function(){
			$(".subadmin").addClass('active');
            $(".subadmin ul").removeClass('active'); 
            $(".allocatelist").addClass('active');
			
           $('#example').DataTable();
 });	   
 function deleteform(id) 
  {
		var id = btoa(id);
		
		swal({
		  title: "Are you sure?",
		  text: "allocate subadmin form will be deleted",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  closeOnConfirm: true
		},
		function(){
		  $.ajax
			({ 
				
				type: 'POST',
				async: true,
                url: '<?php echo base_url();?>Admin/allocateform_subadmin_delete/'+ id, 
				processdata:false,
				cache: false,
				success: function(data)
				{     console.log(data);
				     var values = JSON.parse(data);
                    swal("Deleted!",values.message, "success");
					window.location.reload(); 
				}
			});
		});		    
	
  };
		   
		
</script>		

					
					
					