<?php   
       echo $layout['header'] ;
       echo $layout['sidebar'] ; 
 ?>   


 <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                       <div class="row">
                            <div class="col-md-8">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-speech font-green"></i>
                                            <span class="caption-subject bold font-green uppercase">Create Subadmin</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <form role="form" id="subadmin">
										   <div class="form-group">
                                                           <label class="control-label">Title</label>
                                                                 <select class="form-control" name="title">
																	<option value="0">Select...</option>
																	<option value="Mr">Mr</option>
																	<option value="Ms">Ms</option>
																	<option value="Mrs">Mrs</option>
																	<option value="Other">Other</option>
																</select>
																</div>
                                            <div class="form-group">
                                                <label class="control-label">Full Name</label>
                                                <input type="text" name="fullname"  placeholder="Name" class="form-control" /> </div>
                                            <div class="form-group">
                                                 <label class="control-label">E-mail</label>
                                                <input type="text" name="email"  placeholder="E-mail" class="form-control" /> </div>
												<!--div class="form-group">
                                                <label class="control-label">Password</label>
                                                <input type="password" name="password"  placeholder="Password" class="form-control" /> </div-->
                                            <div class="form-group">
                                                <label class="control-label">Contact Number</label>
                                                <input type="text" name="contact_no"  placeholder="Contact Number" class="form-control" /> </div>
												 <div class="form-group">
												<label class="control-label">Address</label>
												<input type="text" name="address" placeholder="Address"  class="form-control" /> </div>
												
												 <div class="form-group">
												<label class="control-label">Country</label>
												<input type="text" name="country" placeholder="Country"  class="form-control" /> </div>
												 <div class="form-group">
												<label class="control-label">ABN number</label>
												<input type="text" name="abn_no" placeholder="ABN number"  class="form-control" /> </div>
												 <div class="form-group">
												<label class="control-label">Business name(if any)</label>
												<input type="text" name="business_name" placeholder="Business name(if any)"  class="form-control" /> </div>
												 <div class="form-group">
												<label class="control-label">Tax agent no</label>
												<input type="text" name="taxagent_no" placeholder="Tax agent no"  class="form-control" /> </div>
                                            
                                            <div class="margin-top-10">
										     <button type="submit" class="btn btn-circle green">Save Changes</button>
                                            <button type="reset" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                                            </div>
                                        </form>
                                    </div> 
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
	<?php   echo $layout['footer'] ; ?>
                <!-- END CONTENT -->
<script  type="text/javascript">
       $(".subadmin").addClass('active');
        $(".subadmin ul").removeClass('active'); 
        $(".subad").addClass('active');

 $('#subadmin').submit(function(e){
    e.preventDefault();
	var formdata=new FormData($(this)[0]);
   
    $.ajax({
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        url:'<?php echo site_url('Admin/subadmincreate_action');?>',
        beforeSend:function(){
			$('.error').remove();	
			 $(".loader").show();		
		},
        success:function(response){
            var data = $.parseJSON(response);
           if(data.status == true){
			 $('#subadmin').prepend('<div class="alert alert-success "><button type="button" class="close" data-dismiss="alert">&times;</button>'+data.message+'</div>');
			 setTimeout(function(){window.location.reload();},
              3000);
			  $(".loader").hide();
		  
		   }
		 else{
            $('#subadmin').prepend('<div class="alert alert-danger error"><button type="button" class="close" data-dismiss="alert">&times;</button>'+data.message+'</div>');
			if(data!=''){
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div').append(value);
                  });
				  setTimeout(function(){window.location.reload();},
               3000);
			  $(".loader").hide();
			} 
			
        } 
		
        }

    });
	});	
				

	
</script>					
				
				
				
				
				
				
				
				