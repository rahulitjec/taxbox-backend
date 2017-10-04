<div class="page-content-wrapper"  id="payShow">
				<div class="page-content" style="min-height: 891px; background: rgb(242, 243, 248);">
				    <div class="row">
                            <div class="col-md-12">
                                <div class="tabbable-line boxless tabbable-reversed">
                                   <div class="tab-content">
                                      <div class="portlet light bordered">
                                            <div class="portlet-body form">
                                                    <div class="form-body">
                                                            <h3 class="sbold form-section">Payment due $179 </h3> 
															<div class="row">
															
														  <!--h4 class="sbold" style="margin-left:30px;"> Payment due $179</h4-->
														  <span style="margin-left:30px;">Make payment using a credit or debit card, or PayPal account.</span><br><span style="margin-left:30px;"> Simply, click on PayPal Button and you will be redirected to a secure payment facility. Please note we do not store your credit or debt card details</span>
                                                         </div>
                                                          <br><br> 
                                                          <div class="row" >
															<div class="" id="pays"  style="margin-right:20px;">
																	<div id="paypal-response"></div>
																	<div  id="paypal-button"></div>	 	
														      </div>
															 <div class="pull-left"  style="margin-left:20px;">
																<a href="<?php echo base_url();?>Dashboard_controller/vendordetails" id="backEdit" class="btn-md btn green button-submit  ">BACK </a>
															</div>
                                                            </div><br><br>
															 <div class="alert alert-success" style="display:none;width:70%" id="vendorpay"></div> 
                                                        </div>  
                                                </div>
												
                                          </div>  
                                    </div>
                                </div>
								
                            </div>
							  
                        </div>
						</div>
						     
					</div>

     
<script src="https://www.paypalobjects.com/api/checkout.js"></script> 

         <script>
            
            paypal.Button.render({

             env: 'production', // Or 'sandbox' 'production'  AVRV4OeLs31jQuesijL5GALfc4_Tnc19qIXK_UuJGJdT67uPS0ERVpM2aZEBpdr0OTah2JvDJMEjeiu_

             client: {
              sandbox:    'ATllpGx4vMAOA0Z_HilfwrYWB4LmNt13h7Z4QwTYwc3xfnnOjm2eq-wvXkqrGDBLXbp4yEBUcYzQAkbW',
              production: 'AXmNCnl2Q8JdH2QNjJ2tP0-pe3YFbiDQ30CVtTmIHFGOrHRBOlrGkq0o50OCi_65s2oXIUwEFCPZQ0Me'
             },

             commit: true, // Show a 'Pay Now' button

             payment: function(data, actions) {
              return actions.payment.create({
               payment: {  transactions: [ { amount: { total: <?php echo $amount;?>, currency: 'AUD' } } ] }
              });
             },
			 style: {
				 size: 'responsive',
				 shape: 'pill',
				 color: 'blue',
				 label: 'pay'
			 },

             onAuthorize: function(data, actions) {
           return actions.payment.execute().then(function(payment) {

              
            console.log("AFGHSGFJ");
            console.log(payment);
            
             var vid=  <?php echo !empty($vendor_data) ? $vendor_data[0]->id : '';?>
			
             $.ajax({
              type: "POST", 
              url: "<?php echo base_url();?>Dashboard_controller/paypal_pay/"+vid, 
              data: {
                payment:payment
               },
              processdata:false,
              cache: false,
              success: function (tempdata)  
               {
                var values = JSON.parse(tempdata);
               
				 if(values.status==true){
				 $('#vendorpay').html(values.message).show();
				 setTimeout(function(){window.location.replace('<?php echo base_url();?>vendordetails');},
                 3000);
				} 
                document.getElementById('paypalpayid').value = values.payment_id;
                //$('.addorder_form').submit();
               } 
              });
             });
            } 

            }, '#paypal-button');  
           </script>
          