	var base_url_value = $(".base_url").val();
	
function adminlogin()
	{
		var email  	=	$("#email").val();
		var password  	=	$("#password").val();
		$.ajax({
			type: "POST",  
			url: base_url_value+"adminajax/adminlogin",
			data: {
				email:email,
				password:password
			},
			processdata:false,			cache: false,									beforeSend:function(){			$(".loader").show();			}, 		  
			success: function (tempdata)
			{
				if (tempdata.trim() != '') 
						{													
							var values = JSON.parse(tempdata);							showresponse(values.status,values.message,"loginmessage","admin_login",0);							 $(".loader").hide();							if(values.refresh)
									{
										window.location.reload(); 									} 
						} else {
							showresponse(0,"Something went wrong, Please try again later.","loginmessage","admin_login");
						}
			} 
		});
		return false;
	}	var blankform=1;

	function showresponse(showtype,showmessage,classname,formclassname,blankform)
		{
			$("."+classname).fadeIn("slow");
				$("."+classname).html(showmessage); 
					if(showtype==1)
						{
							$("."+classname).addClass("alert-success");
							$("."+classname).removeClass("alert-danger");
								if(blankform==1)
								{
									$('.'+formclassname)[0].reset();
								}
						} else {
							$("."+classname).removeClass("alert-success");
							$("."+classname).addClass("alert-danger");
						}
							setTimeout(function(){
								$("."+classname).fadeOut("slow");
							},60000);
		}

		function showreswithoutSettimeout(showtype,showmessage,classname,formclassname)
		{
			$("."+classname).fadeIn("slow");
				$("."+classname).html(showmessage);
					if(showtype==1)
						{
							$("."+classname).addClass("alert-success");
							$("."+classname).removeClass("alert-danger");
							$("#submit").attr('disabled', true);
								if(blankform==1)
									{
										//$('.'+formclassname)[0].reset();

									}
						}else {

							// $("."+classname).removeClass("alert-success");

							// $("."+classname).addClass("alert-danger");

							 $("#submit").attr('disabled', false);

						} 
		}
	function changepassword_form_submit()

		{

			
			var base_url_value = $(".base_url").val();
				
			
			var currentpassword			=	$("#password").val();

			var newpassword				=	$("#newpassword").val();

			var confirmpassword			=	$("#confirmpassword").val();

			

					$.ajax({ 

						type: "POST",

						async: true,

						url: base_url_value+'adminajax/updateprofilepass', 

						data: {

							'currentpassword' 	 		: currentpassword,

							'newpassword'		 	 	: newpassword,

							'confirmpassword'		 	: confirmpassword

						},
                         beforeSend:function(){
								
								$(".relay").show();
								
						 }, 
						
						success: function(tempdata)  

							{

								if (tempdata.trim() != '') 

									{

										var values = JSON.parse(tempdata);

										showresponse(values.status,values.message,"updateprofilepassmessage","changepassword_form_submit");
										$(".relay").hide();

											if(values.refresh)

												{

													window.location.reload();

												}

									} else {

										showresponse(0,"Something went wrong, Please try again later.","updateprofilepassmessage","changepassword_form_submit"); 

									} 

							}

					});

			return false;

		}	
					