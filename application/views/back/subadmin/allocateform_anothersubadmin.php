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
                                            <span class="caption-subject bold uppercase">Allocate Form To Another Subadmin</span>
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
                                                
                                            </div>
                                        </div>
										<div class="alert alert-success" id="submsg" style="display:none;width:50%;"></div>
										<div class="alert alert-danger error" id="msg" style="display:none;"></div>
										<div class="portlet-body">
                              <form role="form" id="subadmin">
										 <div class="row">
                                            <div class="form-group">
											<div class="col-md-3">
                                                <label class="control-label">Sub Admin</label>
                                                  
                                                        <select class="form-control" name="subadmin_data" id="ddlSubAdmin" onchange="getVendor();">
                                                            <option value="0">Select...</option>
															<?php  foreach($totalsubadmin as $data){ ?>
                                                            <option value="<?php echo $data->admin_id ;?>"><?php echo $data->fullname ;?></option>
															<?php } ?>
                                                            
                                                        </select>
                                                  	</div>  
												</div>
                                          
										</div>
                                    </div><br><br>
										<table id="example" class="table table-striped table-bordered display" >
                                       
                                            <thead>
                                                <tr>
												     <th></th>
                                                    <th>S No.</th>
                                                    <th>User name</th>
                                                    <th>Vendor name</th>
                                                    <th>Vendor Type</th>
                                                    <th>Contact No</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if(!empty($vendor_data)){ $i=1;foreach($vendor_data as $data){?>
                                                <tr  class="odd gradeX" >
                                                    <td ><?php echo $data->id;?></td>
                                                    <td><?php  echo $i;?> </td>
                                                    <td><?php  echo ucwords(strtolower($data->name));?></td>
                                                    <td><?php  echo ucwords(strtolower($data->full_name));?></td>
                                                    <td><?php  echo ucwords(strtolower($data->type_name));?>  </td>
                                                    <td><?php  echo $data->phone_no;?> </td>
                                                  	 
                                                </tr>
												<?php $i++; }}?>
                                            </tbody>
                                        </table>
										
										 
									</div>
									<?php //echo "<pre>"; print_r($vendor_data);?>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
								<div class="row" style="margin-left:70%;!important">
                                            <div class="form-group">
										     <button type="submit" class="btn btn-circle green">Save Changes</button>
                                            <button type="reset" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                                           </div>
										 
                                    </div>
						     </form>   	
                            </div>
                        </div>
                      
                      
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                
                    <!-- END CONTENT BODY -->
<?php   echo $layout['footer'] ; ?>
 


<script  type="text/javascript"> 
         
			$(".allocate").addClass('active');
            $(".allocate ul").removeClass('active'); 
            $(".anotherform").addClass('active');
    
	   $(document).ready(function(){
			
		 	 var table = $('#example').DataTable({
		
        'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']]
   });
    $('#subadmin').submit(function(e){
		e.preventDefault();	   
      var form = this;
	       var rows;
                       var vendor_id = "";
                        var table = $('#example').DataTable();
                        rows = $('#example').find('tbody tr');
                        $.each(rows, function() {
                          var d = table.row(this).data();
                       $($(this).find('td').eq(0)).find('input[type="checkbox"]').each(function(){
                         
                            if(this.checked)
                           {
                             // Create a hidden element
                         $(form).append(
                         $('<input>')
                              .attr('type', 'hidden')
                                .attr('name', 'vendor_id[]')
                               .attr('id', 'vendor_id')
                                 .val(d[0])
                                   );
                             }
                        })
                    });
	   
	   var formdata=new FormData($(this)[0]);
	   $.ajax({
				type:"POST",
				data:formdata,
				contentType:false,
				processData:false,
				url:'<?php echo site_url('Admin/allocateform_another_subadmin_action');?>',
				beforeSend:function(){
					$('.error').remove();	
				},
				success:function(response){
					var data = $.parseJSON(response);
				   if(data.status == true){
						$('#submsg').html(data.message).show();
						    setTimeout(function(){$('#submsg').fadeOut();},
						    3000); 
				   }
				 else{
					$('#subadmin').prepend('<div class="alert alert-danger" style="width:50%" >'+data.message+'</div>');
						    setTimeout(function(){window.location.reload();},
						    3000);
					if(data!=''){
					$.each(data.data, function(key, value){
						$('input[name='+key+']').closest('div').append(value);
						
					});
					}
				} 
				
				}

          }); 
	  
	
  }); 
 
});
  
  function getVendor()
{

  var userId = $('#ddlSubAdmin').val();
     $.ajax({
                type:"POST", 
                contentType:false,
                processData:false,
                url:'<?php echo site_url();?>Admin/allocateform_another_subadmin_selected/'+userId,
                beforeSend:function(){
                    $('.error').remove();   
                },
                success:function(response){
                   $('#example').find('input[type="checkbox"]').prop('checked', false);
                    var data = $.parseJSON(response);
                    var vendorId=data.data;
                   if(data.status == true){
                     
                     console.log(data.data)

                     for (var i=0;i < vendorId.length ;i++)
                     {
                     var rows, checked;
                     var table = $('#example').DataTable();
                       rows = $('#example').find('tbody tr');
                       $.each(rows, function() {
                         var d = table.row(this).data();
                            console.log();
                       if(d[0]== vendorId[i])
                         {
                            var checkbox = $($(this).find('td').eq(0)).find('input').prop('checked', true);
                          } 
                       });
                        
                        }  
                   
                   }
                    
                }

          }); 


} 
  
  
			
  
			
	      
		
</script>		

					
					
					