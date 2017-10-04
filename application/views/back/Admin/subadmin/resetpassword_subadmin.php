<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Admin</title>
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
          
		
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
			<div class="" >  
            <form id="resetpass">
                <h3>Reset Password ?</h3>
                <br>
				<input  type="hidden"  name="pass" value="<?php echo $getpass;?>"/>
				<input  type="hidden"  name="email" value="<?php echo $email;?>"/>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" placeholder="Password" name="password" /> </div>
                </div>
				<div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" placeholder="Confirm Password" name="cpassword" /> </div>
                </div>
                <div class="form-actions">
                    <a href="<?php echo base_url('/admin');?>" id="back-btn" class="btn grey-salsa btn-outline"> Back </a>
                    <button class="btn green pull-right"> Submit </button>
                </div>
            </form>
			</div>
            
        </div>                                  <?php //echo $getpass;?>
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
        <script>
            $(document).ready(function()
            { 
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
		 <div class="loader" style="display:none; text-align: center;position: fixed; top:0px; bottom: 0px; left: 0px; right: 0px; background: rgba(0, 0, 0, 0.2);z-index: 9999; padding-top:300px;">
		<img src="<?php echo base_url();?>assets/images/square.gif" height="90" width="80" />
       </div>
    </body> 

</html>
 <script type="text/javascript">
 
    $('#resetpass').submit(function(e){
	
    e.preventDefault();
   var formdata=new FormData($('#resetpass')[0]);
   
    $.ajax({
        type:"POST",
        data:formdata, 
        contentType:false,
        processData:false,
        url:'<?php echo site_url();?>admin/resetpassword_subadmin_action',
        beforeSend:function(){
            $('.error').remove();
            $('.loader').show();
        },
        success:function(response){
            var data = $.parseJSON(response); 
			console.log(data);
            if(data.status == true){  
                $('#resetpass').prepend('<p class="alert alert-success ">'+data.message+'</p>');
                     /* setTimeout(function(){
                        window.location.replace('<?php echo site_url();?>');
                 }, 2000); */
				 $('.loader').hide();

        }else{
            $('#resetpass').prepend('<p style="color:#e73d4a !important;" class="alert alert-danger error">'+data.message+'</p>');
            $.each(data.data, function(key, value){
                $('input[name='+key+']').closest('div').append(value);
            });
			 $('.loader').hide();
			 setTimeout(function(){
                        window.location.reload();
                 },2000); 
				 
			 
        }

        }
       

    });

});
</script>