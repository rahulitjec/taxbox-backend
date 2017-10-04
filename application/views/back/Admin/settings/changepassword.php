 <?php   echo $layout['header'] ; ?>
 
  <?php   echo $layout['sidebar'] ; ?>   


<link href="<?php echo base_url();?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />

<div class="page-content-wrapper">

                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" style="min-height: 956px;">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="portlet light ">
                                                <div class="portlet-title tabbable-line">
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe theme-font hide"></i>
                                                        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                    </div>
                                                    <ul class="nav nav-tabs">
													 <li class="active">
														 <a href="#tab_1_2" data-toggle="tab">Personal Info</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_1" data-toggle="tab">Change Password</a>
                                                        </li>
                                                        
                                                       
                                                        
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
													
                                                        <div class="tab-pane " id="tab_1_1">
                                                            <form class="changepassword_form_submit" onsubmit="return changepassword_form_submit();" method="post">
                                                                <div class="form-group">
                                                                    <label class="control-label">Current Password</label>
                                                                    <input type="password" name="password" id="password"class="form-control"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">New Password</label>
                                                                    <input type="password" name="newpassword" id="newpassword"class="form-control"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Re-type New Password</label>
                                                                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control"> </div>
																	<p class="alert updateprofilepassmessage" style="display:none;"></p>
                                                                <div class="margin-top-10">
                                                                    <button type="submit" class="btn green">Change Password </button>                                                 
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE PASSWORD TAB -->
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane active " id="tab_1_2">
                                                            <form role="form"  id="profile">
															<div class="alert alert-success" id="profilemsg" style="display:none;"></div>
                                                                
																<div class="form-group">
                                                                    <label class="control-label"> Full Name</label>
                                                                    <input type="text" name="fullname" placeholder=" Name" value="<?php echo (!empty($profile_data)) ? $profile_data[0]->fullname : '';?>" class="form-control" /> </div>
																	
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                    <input type="text" name="email" placeholder="Email" value="<?php echo (!empty($profile_data)) ? $profile_data[0]->email : '';?>" class="form-control" /> </div>
                                                                 <div class="form-group">
                                                                    <label class="control-label">Phone</label>
                                                                    <input type="text" name="contact_no" placeholder="Phone" value="<?php echo (!empty($profile_data)) ? $profile_data[0]->contact_no : '';?>" class="form-control" /> </div>
                                                               
																	
                                                                 <div class="margiv-top-10">
                                                                   <button type="submit" class="btn btn-circle green">Save Changes</button>
                                                             <button type="reset" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PERSONAL INFO TAB -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PROFILE CONTENT -->
                            </div>
							
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
			<!--script src="<?php echo base_url();?>assets/pages/scripts/profile.min1232.js" type="text/javascript"></script-->
			<script src="<?php echo base_url();?>assets/back/js/adminlogin.js" type="text/javascript"></script>	
				

				<?php   echo $layout['footer'] ; ?>
<script type="text/javascript">

				$(document).ready(function(){

						$(".setting").addClass('active');

						$(".setting ul").addClass('in');

						$(".changepassword").addClass('active');

					});
$('#profile').submit(function(e){
    e.preventDefault();
	var formdata=new FormData($(this)[0]);
   
    $.ajax({
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        url:'<?php echo site_url('Admin/adminprofile_update');?>',
        beforeSend:function(){
			$('.error').remove();
            $(".loader").show();			
		},
        success:function(response){
            var data = $.parseJSON(response);
           if(data.status == true){
			 $('#profilemsg').html(data.message).show();
			   setTimeout(function(){$('#profilemsg').fadeOut();},
              3000);
			  $(".loader").hide();
		  
		   }
		 else{
            $('#profile').prepend('<div class="alert alert-danger error">'+data.message+'</div>');
			if(data!=''){
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div').append(value);
			 });
			  setTimeout(function(){ $(".loader").hide();},
              2000);
			 
			}
        } 
		
        }

    });
	});				
					
					

</script>
		
		
		
		