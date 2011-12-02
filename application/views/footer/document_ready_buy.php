
<script type="text/javascript" language="Javascript">
$(document).ready(function() {

				<?php   
				
				$testing = FALSE;
				//$testing = TRUE;

				
				if( $testing == TRUE ){	
										
							
							foreach($pairs as $key => $value){ ?>
								
								$('#<?php echo $key    ?>').val('<?php echo $value    ?>');
								
							<?php
							}					
				};
				?>
				
				

	
				<?php
				if( isset( $users[0]->id ) ){  ?> 
					
					
					
					
											$('#sign_up_portion').hide();
				
											<?php 
											
											foreach($payment_info_pairs as $key => $value){ ?>
												
												$('#<?php echo $key    ?>').val('<?php echo $value    ?>');
												
											<?php
											}	
											
											
											
											if( isset( $this->session->userdata['user_id'] ) 
											&& $this->users[0]->authorize_customerProfileId != ''){
												
														$yellow_fields = array(
																					'cc_num',
																					'cardtype',
																					'cc_code',
																					'month_exp',
																					'year_exp'
																					);  
														
														foreach($yellow_fields as $value){ ?>
															
															$('#<?php echo $value    ?>').css({background:'yellow'});
															
														<?php
														}	
												
											};?>

											$('#total_price').text(  '$' + $('#quantity').val() * <?php  echo $deals[0]->deal_price   ?> );
											
					<?php						
				 }?>
				

				


				<?php
				 // IF LOGIN-IN USER HAS AUTHORIZE ACCOUNT INFO 
				if( isset( $users[0]->authorize_customerProfileId ) 
				&& $users[0]->authorize_customerProfileId != '' ){  ?>
					
					
				
					// MOVE PURCHASE BUTTON UP
					$('#buy_box_section div.two_third_column div.middle').append($('#buynow_container'));
					$('#buynow_container').css({'margin-top':'20px'});
					$('#user_information_section').hide();
					
					update_switch = 0
					$('#use_card_on_file').click(function(event) {
											
							$('#user_information_section').toggle();
							
							if( update_switch  == 0){
								$('#user_information_section  div.middle').append($('#buynow_container'));
								$('#buynow_container').css({'margin-top':'20px'});
								update_switch  = 1;										
							}else{
								$('#buy_box_section div.two_third_column div.middle').append($('#buynow_container'));
								$('#buynow_container').css({'margin-top':'20px'});
								update_switch  = 0;
							};
					
					});	

				<?php } ?>
				
				
				
				<?php if( $server_response['type'] == 'error in authorization' 
									|| $server_response['type'] == 'BAD CREDIT CARD' 
									|| $server_response['type'] == 'error in capture' 
									|| $server_response['type'] == 'Contain Blank Fields' 
									|| $server_response['type'] == 'A duplicate transaction has been submitted.'
									){?>

							$('#user_information_section  div.middle').append($('#buynow_container'));
							$('#change_credit_card').hide();
							
							window.setTimeout(function(){
								$('.error_box').slideDown('slow', function() {
									$(this).children('div.message').html('<?php if(isset($server_response['message']))echo $server_response['message'];    ?>');
		
									$('#user_information_section').show();	
									$('#use_card_on_file').attr('checked', false);	
									
									<?php foreach($server_response['bad_fields'] as $bad_field ){?>
										
										$('form#form0 #<?php echo $bad_field    ?>').css({background:'pink'}).parent().parent().children('div.error_message_select, div.error_message').html("");
										
									<?php } ?>
									
									
									<?php foreach($payment_info_pairs as $key => $value){ ?>
										
										$('#<?php echo $key    ?>').val('<?php echo $value    ?>');
										
									<?php
									}	?>
									
									
																	
								    
								});								
								
							},1200);

				<?php } ?>
				

				$('#logo').click(function(event) {
	
												document.location.href='http://zekeszoo.com/index.php/home';

				});	
				

				
				$('form#form0 input[type=text], form#form0 input[type=password]')

					.click(function(event) {				
						
							$(this)
							
							.css({background:'white'})
							
							// .val('')

							.parent().parent().children('div.error_message').html("&nbsp;");

					});
					
					
				$('form#form0 select')

					.change(function(event) {				
						
							$(this).css({background:'white'})
							
							.parent().parent().children('div.error_message_select').html("&nbsp;");
							

					});					
					
					
					$('#quantity').change(function(event) {
						
						$('#total_price').text(  '$' + $(this).val() * $('#unit_price').text().replace('$', '') );
						
					});	
								
				$('#buynow_image').click(function(event) {
					
						var ok = 1;

						// ** SELECTION MUST BE CHOOSEN
						$('form#form0 select, form#form0 input:not(#gift)')
						
						.css({background:'white'})
						
						.each(function(){
		
								if( $(this).val() == '' ){

									$(this).css({background:'pink'}).parent().parent().children('div.error_message_select, div.error_message').html("Can't be blank.");


									ok = 0;
									
				
								};
						        
						});	
						
						
						
						// ** Credit Card Validation.  Refer to creditcard.js
											
						if (!checkCreditCard ($('#cc_num').val(),$('#cardtype').val() )){
						 
						 	$('form#form0 input#cc_num, form#form0 select#cardtype').css({background:'pink'}).parent().parent().children('div.error_message').html("Invalid Credit Card.");
						 
							ok = 0;			 
						 
						}else{
							
							$('form#form0 input#cc_num, form#form0 select#cardtype').css({background:'white'}).parent().parent().children('div.error_message').html("&nbsp;");	

						};
						
						
						// ONLY VALIDATE FIELDS IF THIS IS BRAND NEW USER					
						<?php if( !isset( $this->session->userdata['user_id'] ) ){?>
						
								
												// ** NO BLANK TEXT OR PASSWORD 
						
												$('form#form0 input[type=text], form#form0 input[type=password]')
												
												.css({background:'white'})
												
												.each(function(){
								
														if( $(this).val() == '' ){
						
															$(this).css({background:'pink'}).parent().parent().children('div.error_message').html("Can't be blank.");
															
															ok = 0;
															
														};
												        
												});
													
												
												// ** ZIPCODE FOR SIGNUP MUST BE INT AND GREATER THAN 5 CHARACTERS
												if(  $('form#form0 input#zipcode_signup').val()  != parseInt( $('form#form0 input#zipcode_signup').val() ) 
															||  $('form#form0 input#zipcode_signup').val().length  < 5
												) {
													
													$('form#form0 input#zipcode_signup').css({background:'pink'}).parent().parent().children('div.error_message').html("Invalid Zipcode.");
													
													ok = 0;
															
												}else{
												
													$('form#form0 input#zipcode_signup').css({background:'white'}).parent().parent().children('div.error_message').html("&nbsp;");	
													
												};
												
												
												// ** ZIPCODE FOR PAYMENT MUST BE INT AND GREATER THAN 5 CHARACTERS
												if(  $('form#form0 input#zipcode_payment').val()  != parseInt( $('form#form0 input#zipcode_payment').val() ) 
															||  $('form#form0 input#zipcode_payment').val().length  < 5
												) {
													
													$('form#form0 input#zipcode_payment').css({background:'pink'}).parent().parent().children('div.error_message').html("Invalid Zipcode.");
						
						
													ok = 0;
															
						
						
												}else{
												
													$('form#form0 input#zipcode_payment').css({background:'white'}).parent().parent().children('div.error_message').html("&nbsp;");	
													
												};						
												
												
												// ** EMAIL
												if( isBadEmail(  $('form#form0 input#email').val() )  ){
													
													$('form#form0 input#email').css({background:'pink'}).parent().parent().children('div.error_message').html("Invalid email.");
													
						
													ok = 0;
															
						
								
												}else{
													
													$('form#form0 input#email').css({background:'white'}).parent().parent().children('div.error_message').html("&nbsp;");
													
												};
						
										
												// PASSWORD GREATER THAN 5
												
												if( $('form#form0 input#password_signup').val().length  < 5  ){
								
													
													$('form#form0 input#password_signup, form#form0 input#confirm').css({background:'pink'}).parent().parent().children('div.error_message').html("5 characters or more.");
						
													ok = 0;
															
						
												}else{
													
																	// ** PASSWORD MUST MATCH
																	
																	if( $('form#form0 input#password_signup').val()  !=  $('form#form0 input#confirm').val() ){
																		
						
																	ok = 0;
															
							
																		$('form#form0 input#password_signup, form#form0 input#confirm').css({background:'pink'}).parent().parent().children('div.error_message').html("Passwords must match.");
													
																	}else{
																		$('form#form0 input[type=password], form#form0 input#confirm').css({background:'white'}).parent().parent().children('div.error_message').html("&nbsp;");	
																	};					
								
												};
						
						<?php } ?>
						
ok = 1;
						if( 
							ok == 1
							|| $('#use_card_on_file').is(':checked') 
						){
							
								$('form#form0').submit();
							
						};

				});
});		


function isBadEmail(email) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(email) == false) {
      return true;
   }
}
				

</script>