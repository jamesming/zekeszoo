
<script type="text/javascript" language="Javascript">
$(document).ready(function() {

				<?php   
				
				$testing = FALSE;
				//$testing = TRUE;

				
				if( $testing == TRUE ){	
										
							/* PUTTING TEST HERE */
							

							
							
							$pairs = array(
							'first_name'=>'James',
							'last_name'=>'Ming',
							'form0 input#email'=>'jamesming@gmail.com',
							'form0 input#password_signup'=>'123',
							'confirm'=>'12345',
							'zipcode_signup'=>'900036',
							'zipcode_payment'=>'10003',
							'cc_first_name'=>'James',
							'cc_last_name'=>'Ming',
							'cc_address'=>'1 Irving Place U28D',
							'cc_city'=>'New York',
							'cc_state'=>'NY',
							'cc_code'=>'721',
							'month_exp'=>'11',
							'year_exp'=>'2011'
							);

							$pairs['cc_num'] = '4264520026812776';
							$pairs['cardtype'] = 'Visa';


							
							/**/


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
											&& $this->users[0]->authorize_customerProfileId != ''
											&& ( isset( $payment_info_pairs['cc_num']) ? $payment_info_pairs['cc_num']:'' ) == ''
											){
												
														$yellow_fields = array(
																					'cc_num',
																					'cardtype',
																					'cc_code',
																					'month_exp',
																					'year_exp'
																					);  
														
														foreach($yellow_fields as $value){ ?>
															
															$('#<?php echo $value    ?>').css({background:'yellow'})
															
																.click(function(event) {	
					    	
																    $(this).hide_error_message();
																    
																})
																
																.parent().parent().children('div.error_message').show().show().html('required')
															
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
				
				
				
				<?php
				
						// brk
						
					 $server_response_type_array = array(
					 	'error in authorization',
					 	'BAD CREDIT CARD',
					 	'error in capture',
					 	'Contain Blank Fields',
					 	'A duplicate transaction has been submitted.',
					 	'This transaction has been declined.',
					 	'The transaction has been declined because of an AVS mismatch. The address provided does not match billing address of cardholder.',
					 	'The credit card has expired.',
					 	'The credit card number is invalid'
					 );
		
					 if( in_array( $server_response['type'], $server_response_type_array) ){ ?>

							$('#user_information_section  div.middle').append($('#buynow_container'));
							$('#change_credit_card').hide();
							
							window.setTimeout(function(){
								$('.error_box').slideDown('slow', function() {
									$(this).children('div.message').show().html('<?php if(isset($server_response['message']))echo $server_response['message'];    ?>');
		
									$('#user_information_section').show();	
									$('#use_card_on_file').attr('checked', false);	
									
									<?php foreach($server_response['bad_fields'] as $bad_field ){?>
										
										$('form#form0 #<?php echo $bad_field    ?>').display_error_message('Invalid');
										
									<?php } ?>
									
									
									<?php foreach($payment_info_pairs as $key => $value){ ?>
										
										$('#<?php echo $key    ?>').val('<?php echo $value    ?>');
										
									<?php
									}	?>
									
									
																	
								    
								});								
								
							},1200);

				<?php } ?>
				

				$('#logo').click(function(event) {
	
												document.location.href='<?php echo base_url()    ?>index.php/home';

				});	
				
				
				$('#ship_to_other').click(function(event) {
							if($(this).is(":checked") ){
								$('#user_information_section .middle div.user_info_outerbox.shipping_box, #user_information_section  .middle div#shipping_info').show();
							}else{
								$('.error_box').slideUp('slow');
								$('#user_information_section .middle div.user_info_outerbox.shipping_box, #user_information_section  .middle div#shipping_info').hide();
							};
				});	
				

					
					
				$('form#form0 select')

					.change(function(event) {				
						
							$(this).css({background:'white'})
							
							.parent().parent().children('div.error_message_select').show().html("&nbsp;");
							

					});					
					
					
					$('#quantity').change(function(event) {

						$('#total_price').text(  '$' + $(this).val() * $('#unit_price').text().replace('$', '') );
						
						if($('#promo_code_checkbox').is(":checked") ){
								$('#apply').click()
						};
						
					});	
								
								
	
					$('#promo_code_checkbox').click(function(event) {
							if($(this).is(":checked") ){
								$('.promo_code_function').show()
							}else{
								$('.promo_code_function, .code_not_valid').hide()
							};
					});	
					$('#apply').click(function(event) {
	
	
	
									$.post("<?php echo base_url(). 'index.php/home/get_promo_code';    ?>",{
										promo_code: $('#promo_code').val()
									},function(data) {
										
											if( data == 0){
												$('.code_not_valid').show();
											}else{
												$('#promo_code_container').hide();
												$('.promo_rows').show();
												$('#discount_div').html('&nbsp;&nbsp;-'+data).css({'text-decoration':'underline'});
												total_priceIs = parseInt($('#total_price').text().replace('$', ''));
											};
										
											$('#final_price').text(  '$' + (total_priceIs - data));
										
								
																																
											
									});
	
									
	
	
					});	
					
					
				(function( $ ) {
					
				  $.fn.display_error_message = function( message ) {
				  	
				    $(this).click(function(event) {
				    	
				    	$('.error_box').slideUp('slow');
				    	
					    $(this).hide_error_message();}
					    
					   )
					    
						.css({background:'pink'}).addClass('hasError')
						
						.parent().parent().children('div.error_message').show().show().html(message);
				
				  };
				})( jQuery );					
					

				(function( $ ) {
				  $.fn.hide_error_message = function() {

							if( !$(this).hasClass('select')){
							
									$(this).val('')
									
							};
					  
					    $(this)
																
							.css({background:'white'})
							
							.unbind('click')
							
							.parent().parent().children('div.error_message').show().html("&nbsp;");
				
				  };
				})( jQuery );

								
			$('#buynow_image').click(function(event) {
					
				var ok = 1;

				if ( !$('#use_card_on_file').length || !$('#use_card_on_file').is(':checked') ) {


												// ** NO BLANK TEXT OR PASSWORD 
						
												$('form#form0 .payment_box input[type=text], form#form0 .payment_box select,form#form0 .signup_box input[type=text],form#form0 .payment_box input[type=password]')
												
												.css({background:'white'})
												
												.each(function(){

														if(  $(this).val() == '' ){
						
															$(this).display_error_message('Can not be blank.');
															
															ok = 0;
															
														};
												        
												});

												if( $('#ship_to_other').is(':checked') ){

													
															$('form#form0 .shipping_box input[type=text]')
															
															.css({background:'white'})
															
															.each(function(){
			
																	if(  $(this).val() == '' ){
									
																		$(this).display_error_message('Can not be blank.');
																		
																		ok = 0;
																		
																	};
															        
															});
													
												};

																																						
												// ** ZIPCODE FOR PAYMENT MUST BE INT AND GREATER THAN 5 CHARACTERS
												if(  $('form#form0 input#cc_zipcode').val()  != parseInt( $('form#form0 input#cc_zipcode').val() ) 
															||  $('form#form0 input#cc_zipcode').val().length  < 5
												) {
													$('form#form0 input#cc_zipcode').display_error_message('Invalid zipcode.');
													ok = 0;
												};						

												// ONLY VALIDATE FIELDS IF THIS IS BRAND NEW USER					
												<?php if( !isset( $this->session->userdata['user_id'] ) ){?>
												
												
															// ** EMAIL
															if( isBadEmail(  $('form#form0 input#email').val() )  ){
																$('form#form0 input#email').display_error_message('Invalid email.');
																ok = 0;
			
															};


															// ** ZIPCODE FOR SIGNUP MUST BE INT AND GREATER THAN 5 CHARACTERS
															if(  $('form#form0 input#zipcode_signup').val()  != parseInt( $('form#form0 input#zipcode_signup').val() ) 
																		||  $('form#form0 input#zipcode_signup').val().length  < 5
															) {
																
																$('form#form0 input#zipcode_signup').display_error_message('Invalid zipcode.');
																
																ok = 0;
																		
															};
												
																
															// PASSWORD GREATER THAN 5
															
															if( $('form#form0 input#password_signup').val().length  < 5  ){
																$('form#form0 input#password_signup').display_error_message('Need 5 characters or more.');
																ok = 0;
									
															}else{
																
																				// ** PASSWORD MUST MATCH
																				
																				if( $('form#form0 input#password_signup').val()  !=  $('form#form0 input#confirm').val() ){
										
																					$('form#form0 input#password_signup, form#form0 input#confirm').display_error_message('Passwords must match.');
																					
																					ok = 0;													
																
																
																				};					
											
															};
						
												<?php }    ?>


				}
				
				
				if( 
					ok == 1
					|| $('#use_card_on_file').is(':checked') 
				){
					
						$('form#form0').submit();
					
				}else{
					
						$('body').scrollTo($('.error_box').parent(), {duration: 500, onAfter:function(){
									$('.error_box').slideDown('slow', function() {
										$(this).children('div.message').show().html('Please correct fields in pink.');
									})						
						} });

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