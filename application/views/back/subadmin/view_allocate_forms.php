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
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase"> Allocate Form List</span>
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-toolbar">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="btn-group  hidden">
                                                        <button id="sample_editable_1_new" class="btn sbold green"> Add New
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
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
                                                    <th>Vendor name</th>
                                                    <th>Email</th>
                                                    <th>Contact No</th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if(!empty($vendordata)){ $i=1;foreach($vendordata as $data){?>
                                                <tr  class="odd gradeX" >
                                                    
                                                    <td><?php echo $i;?> </td>     
                                                    <td><?php echo ucwords(strtolower($data->name));?></td>
                                                    <td><?php echo ucwords(strtolower($data->full_name));?></td>
                                                    <td> <?php echo $data->email_address;?> </td>
                                                    <td><?php echo $data->phone_no;?> </td>
													 <td><a href="<?php echo base_url('Admin/edit_submittedform/'.base64_encode($data->id));?>" class="label label-sm label-success">Edit</a> 
													<a href="<?php echo base_url('Admin/viewsubmittedform/'.base64_encode($data->id).'/'.base64_encode($data->vendor_type));?>" class="label label-sm label-success">View</a>
													<span class="label label-sm label-danger" onclick="deleteform(<?php echo $data->id;?>, <?php //echo $data->vendor_type;?>)" style="cursor:pointer;">Delete</span>
													</td>
                                                </tr>
											<?php $i++; }}?>
                                            </tbody>
                                        </table>
										
                                    </div>
									<?php //echo "<pre>"; print_r($vendordata);?> 
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
       
	      $(document).ready(function(){
			$('#example').DataTable();
			$(".allocate").addClass('active');
            $(".allocate ul").removeClass('active'); 
            $(".allocateform").addClass('active');
});			
			
   function deleteform(id,type) 
  {
		var id = btoa(id);
		var type = btoa(type);
		swal({
		  title: "Are you sure?", 
		  text: "Form will be deleted",
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
                url: '<?php echo base_url();?>Admin/allocateforms_delete/'+ id+'/'+ type, 
				processdata:false,
				cache: false,
				success: function(data)
				{    
				     var values = JSON.parse(data);
                    swal("Deleted!",values.message, "success");
					window.location.reload();
				}
			});
		});		    
	
  };

			
	      
		
</script>		

					
					
					