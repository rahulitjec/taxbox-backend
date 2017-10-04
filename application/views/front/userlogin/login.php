<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>User Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url();?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url();?>assets/pages/css/login-3.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="#">
                <img src="<?php echo base_url()?>assets/images/logo/logo-in-png.png" class="img-responsive" style="margin-left: 47%;" height="100" width="100" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
			<div id="loghide">
			<div class="login-form">
            <form  id="logform">
                <h3 class="form-title">Login to your account</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Login Id</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text"  placeholder="Username" name="email" /> </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password"  placeholder="Password" name="password" /> </div>
                </div>
                <div class="form-actions">
                    <label class="control-label "></label>
					<span></span>
                    <button   class="btn green pull-left"> Login </button><br>
                </div>
               <div>
                    <h4>Or </h4>
                                <?php
									if(!isset($data['fb_login_url'])){
										
									}else{
										echo'<a href="'.$data["fb_login_url"].' " class="btn blue-madison"><i class="fa fa-facebook-official" aria-hidden="true"></i> Continue with facebook</a>';
									
									}
								 	
							?>
                     </div>
               
                <div class="forget-password"> 
                    <h4>Forgot your password ?</h4>
                    <p> no worries, click
                        <a href="javascript:;" id="forget-password"> here </a> to reset your password. </p>
                </div>
				
                <div class="create-account">
                    <p> Don't have an account yet ?&nbsp;
                        <a href="javascript:;" id="register-btn"> Create an account </a>
                    </p>
                </div>
            </form>
			</div>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
			<div class="forget-form" >  
            <form id="forgot">
                <h3>Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" /> </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn grey-salsa btn-outline"> Back </button>
                    <button class="btn green pull-right"> Submit </button>
                </div>
            </form>
			</div>
			</div>
            <!-- END FORGOT PASSWORD FORM -->
            <!-- BEGIN REGISTRATION FORM -->

			<div  class="register-form"  id="regshow" >
            <form id="regform">
                <h3>Sign Up</h3>
                <p> Enter your personal details below: </p>
				<input type="hidden" id="reg" value="<?php echo !empty($this->input->get("action")) ? $this->input->get("action") : ''; ?>"/>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">First Name</label>
                 <input class="form-control placeholder-no-fix" type="text" placeholder="First Name" name="firstname" value="<?php echo $this->input->post("firstname"); ?>" /> 

                </div>
				<div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Last Name</label>
                 <input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="lastname" value="<?php echo $this->input->post("lastname"); ?>" /> 

                </div>
				<div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Phone no</label>
                    
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Phone" name="phone" value="<?php echo $this->input->post("phone"); ?>"/>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                   
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" value="<?php echo $this->input->post("email"); ?>"/> 
                </div>
				
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9"> Create Password</label>
                    
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="password" placeholder="Create Password" name="password" value="<?php echo $this->input->post("password"); ?>"/> 
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
                    <div class="controls">
                         <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" name="cpassword" /> 
                    </div>
                </div>
                <!--div class="form-group">
                    <label class="mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="tnc" /> I agree to the
                        <a href="javascript:;">Terms of Service </a> &
                        <a href="javascript:;">Privacy Policy </a>
                        <span></span>
                    </label>
                    <div id="register_tnc_error"> </div>
                </div-->
                <div class="form-actions">
                    <button id="register-back-btn" type="button" class="btn grey-salsa btn-outline"> Back </button>
                    <button   class="btn green pull-right" > Sign Up </button>
                </div>
            </form>
			</div>
            <!-- END REGISTRATION FORM -->
        </div>                                  <?php //print_r($fb_login_url);?>
        <!-- END LOGIN -->
        <!--[if lt IE 9]>
 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        
		 <div class="loader" style="display:none; text-align: center;position: fixed; top:0px; bottom: 0px; left: 0px; right: 0px; background: rgba(0, 0, 0, 0.2);z-index: 9999; padding-top:300px;">
		<img src="<?php echo base_url();?>assets/images/square.gif" height="90" width="80" />
       </div>
    </body> 

</html> 
  
 <script type="text/javascript">
             var reg=$("#reg").val();
			       if(reg !=''){
					 $("#regform").show();  
					 $("#loghide").hide();  
					  
				  }
                 $("#register-back-btn").click(function(){
                    $("#loghide").show();
                 });
 
 ////****************for login ****************///
    $('#logform').submit(function(e){
	
    e.preventDefault();
   var formdata=new FormData($('#logform')[0]);
   
    $.ajax({
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        url:'<?php echo site_url();?>login',
        beforeSend:function(){
            $('.error').remove();
            $('.loader').show();
        },
        success:function(response){
            var data = $.parseJSON(response); 
            if(data.status == true){
                $('#logform').prepend('<p class="alert alert-success ">'+data.message+'</p>');
                     setTimeout(function(){
                        window.location.replace('<?php echo site_url();?>vendordetails');
                 }, 2000);
				 $('.loader').hide();

        }else{
			$(".loader").css("display","none");
            $('#logform').prepend('<p style="color:#e73d4a !important;" class="alert alert-danger error">'+data.message+'</p>');
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div').append(value);
            });
			setTimeout(function(){
                        window.location.reload();
                 },2000);
			 
        }

        }
       

    });

});
/*************** Registration   ********/ 
  $('#regform').submit(function(e){
    e.preventDefault();
   var formdata=new FormData($(this)[0]);
   
    $.ajax({
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        url:'<?php echo site_url();?>/User_controller/userRegister',
        beforeSend:function(){
            $('.error').remove();
			 $('.loader').show(); 
        },
        success:function(response){
            var data = $.parseJSON(response);
            if(data.status == true){
                $('#regform').prepend('<p class="alert alert-success ">'+data.message+'</p>');
                  $('.loader').hide();
				  setTimeout(function(){
                        window.location.reload();
                 },2000);
        }else{
			$(".loader").css("display","none");
            $('#regform').prepend('<p style="color:#e73d4a !important;" class="alert alert-danger error">'+data.message+'</p>');
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div').append(value);
            });
			 
        }

        } 
       

    });

});
/*************** forgot password  ********/ 
 $('#forgot').submit(function(e){
    e.preventDefault();
   var formdata=new FormData($(this)[0]);
   
    $.ajax({
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        url:'<?php echo site_url();?>/User_controller/forgotPasswordAction',
        beforeSend:function(){
            $('.error').remove();
			$('.loader').show();
        },
        success:function(response){
            var data = $.parseJSON(response);
            if(data.status == true){
                $('#forgot').prepend('<p class="alert alert-success ">'+data.message+'</p>');
				$('.loader').hide();
                    
        }else{ 
		     $(".loader").css("display","none");
            $('#forgot').prepend('<p style="color:#e73d4a !important;" class="alert alert-danger error">'+data.message+'</p>');
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div.col-xs-12').append(value);
            });
			setTimeout(function(){
                        window.location.reload();
                 },2000);
        }

        }  
       

    });

});

</script>  