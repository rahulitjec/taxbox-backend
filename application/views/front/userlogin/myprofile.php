 <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                      
                        <!-- BEGIN PAGE BAR -->
                        <!--div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="#">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>View Profile</span>
                                </li>
                            </ul>
                           
                        </div-->
                      <div class="row">
                            <div class="col-md-6">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-speech font-green"></i>
                                            <span class="caption-subject bold font-green uppercase">User Profile</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <form role="form" id="profile">
										<div class="alert alert-success" id="profilemsg" style="display:none;"></div>
                                            <div class="form-group">
											<label class="control-label">Name</label>
                                                <input type="text" name="name" value="<?php echo (!empty($profile_data)) ? str_replace('&nbsp',' ',$profile_data[0]->name) : '';?>" placeholder="Name" class="form-control" /> </div>
                                            <div class="form-group">
                                                 <label class="control-label">E-mail</label>
                                                <input type="text" name="email" value="<?php echo (!empty($profile_data)) ? $profile_data[0]->email : '';?>" placeholder="E-mail" class="form-control" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Contact Number</label>
                                                <input type="text" name="phone" value="<?php echo (!empty($profile_data)) ? $profile_data[0]->phone : '';?>"  placeholder="Contact Number" class="form-control" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Address</label>
                                                <input type="text" name="address" value="<?php echo (!empty($profile_data)) ? $profile_data[0]->address : '';?>" placeholder="Address" class="form-control" /> </div>
                                            <div class="margin-top-10">
										     <button type="submit" class="btn btn-circle green">Save Changes</button>
                                            <button type="reset" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-speech font-green"></i>
                                            <span class="caption-subject bold font-green uppercase">Change Password</span>
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form"  class="form-horizontal" id="pass">
										<div class="alert alert-success" id="passmsg" style="display:none;"></div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Current Password</label>
                                                <div class="col-md-9">
                                                    <input type="password"  name="old_password" placeholder="Current Password" class="form-control" /> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">New Password</label>
                                                <div class="col-md-9">
                                                 <input type="password"  name="new_password" placeholder="New Password" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Re-type New Password</label>
                                                <div class="col-md-9">
                                                 <input type="password"  name="conf_password" placeholder="Re-type New Password" class="form-control" />
                                                </div>
                                            </div>
										   
                                           
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn btn-circle green">Save Changes</button>
                                                        <button type="reset" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
<script type="text/javascript">
 $(".profile").addClass('active');
        //$(".resident ul").removeClass('active'); 
       // $(".residents").addClass('active');
	
	
	
 $('#profile').submit(function(e){
    e.preventDefault();
	
	var formdata=new FormData($(this)[0]); 
   
    $.ajax({
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        url:'<?php echo site_url('updateprofile');?>',
        beforeSend:function(){
			$('.error').remove();	
			$('.loader').show();	
		},
        success:function(response){
            var data = $.parseJSON(response);
           if(data.status == true){
			 $('#profilemsg').html(data.message).show();
			   setTimeout(function(){$('#profilemsg').fadeOut();},
              3000);
			  $('.loader').hide();
		  
		   }
		 else{
            $('#profile').prepend('<p class="alert alert-danger error">'+data.message+'</p>');
			if(data!=''){
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div').append(value);
				
            });
			}
			setTimeout(function(){$('#profilemsg').fadeOut();},
              3000);
			  $('.loader').hide();
        } 
		
        }

    });
	});	
				
/***************For Change Password********/

	
	 $('#pass').submit( function(e){
    e.preventDefault();
	var formdata=new FormData($(this)[0]);
   
    $.ajax({
        type:"POST",
        data:formdata,
        contentType:false, 
        processData:false,
        url:'<?php echo site_url('passwordchange');?>',
         beforeSend:function(){
			$('.error').remove();
            $('.loader').show();			
		},
        success:function(response){
            var data = $.parseJSON(response);
           if(data.status == true){
				 $('#passmsg').html(data.message).show();
			   setTimeout(function(){$('#passmsg').fadeOut();},
              3000);
			  $('.loader').hide();
		   }
		 else{
			
            $('#pass').prepend('<p class="alert alert-danger error">'+data.message+'</p>');
			if(data!=''){
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div').append(value);
            });
			}
			setTimeout(function(){$('#passmsg').fadeOut();},
              3000);
			  $('.loader').hide();
        } 

        }
		
    });
	});	
	/********************************/
	
</script>					
				
				
				
				
				
				
				
				