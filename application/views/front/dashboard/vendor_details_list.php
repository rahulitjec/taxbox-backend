 <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" style="min-height:867px;background:#f2f3f8">

<!-- BEGIN PAGE BAR -->
                        <!--div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="#">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <a href="#">Vendor Details</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                               
                            </ul>
                           
                        </div-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase"> Managed Table</span>
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body" >
                                        <div class="table-toolbar ">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="btn-group">
                                                        <a  href="<?php echo base_url('vendorform');?>" id="sample_editable_1_new" class="btn sbold green"> Add New
                                                            <i class="fa fa-plus"></i>
                                                        </a>
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
										<table id="example" class="table table-striped table-bordered  table-advance table-hover " >
                                       
                                            <thead>
                                                <tr>
                                                    <th> S No. </th>
                                                    <th> Vendor Details </th>
                                                    <th> Date Created </th>
                                                    <th> Date Submitted </th>
                                                    <th> Status </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if(!empty($vendor_data)){ $i=1;foreach($vendor_data as $data){?>
                                                <tr  class="odd gradeX" >
                                                     <td><?php echo $i;?> </td>
                                                    <td>
                                                       <?php echo ucwords(strtolower($data->full_name));?><br>
													   <small><?php echo $data->address_of_vendor;?> </small>
                                                    </td>
                                                    <td>
                                                       <?php echo date_time($data->create_date);?> 
                                                    </td>
                                                    <td><?php echo (!empty($data->update_date)) ? date_time($data->update_date) : '';?> </td>
                                                    <td><span class="label label-sm label-success"><?php if($data->is_complete==1 && $data->pay_status==0){ echo 'Submitted';}elseif($data->pay_status==1){ echo 'Payment done';}else{echo 'Not Submitted'; };?></span>  </td>
													
													<td> <a href="<?php echo base_url('vendorform/'.base64_encode($data->id).'/'.base64_encode($data->vendor_type));?>" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i>Edit</a> 
													<span class="btn btn-outline btn-circle dark btn-sm black" onclick="deleteform(<?php echo $data->id;?>,<?php echo $data->vendor_type;?>)" style="cursor:pointer;"><i class="fa fa-trash-o"></i>Delete</span> </td>
                                                </tr>
											<?php $i++; }}?> 
                                            </tbody>
                                        </table>
										
                                    </div>
									<?php //echo "<pre>"; print_r($vendor_data);?>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                      
                      
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                
          
 
<script type="text/javascript">
           $(document).ready(function(){
				$('#example').DataTable();
			  $(".resident").addClass('active');
              $(".resident ul").removeClass('active'); 
              $(".vendordetails").addClass('active');
				
            });
			
	function deleteform(id,type) 
  {
		var id = btoa(id);
		var type = btoa(type);
		swal({
		  title: "Are you sure?",
		  text: "Vendor form will be deleted",
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
                url: '<?php echo base_url();?>Dashboard_controller/vendorforms_delete/'+ id+'/'+ type, 
				processdata:false,
				cache: false,
				success: function(data)
				{    
				     var values = JSON.parse(data);
                    swal("Deleted!",values.message, "success");
					 setTimeout(function(){
					 window.location.reload();
					 },2000);
				}
			});
		});		    
	
  };		
			
			
			
			
			
        </script>
   