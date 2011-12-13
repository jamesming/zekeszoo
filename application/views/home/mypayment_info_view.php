<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/mypayment_info_css.php');  ?>
<?php     	$this->load->view('footer/footer_section_css.php');  ?>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
</head>

<html>

<body>


<div id='top_body'  class='  clearfix' >
	<div id='sunrise'  class=' container' >

<?php     	$this->load->view('header/top_header.php');  ?>
							

						<form id='form0' name='form0'
							 action='<?php	echo base_url().'index.php/home/update_payment'; ?>' method='post'>

							<div  class=' container' >
								
								<div id='buy_box_other_deals_container'  class=' container_inside   margin_top' >
									
										<div id='buy_box_section'  class='margin_top float_left' >
											
											
	
												
												
												
												
										<div class=' error_box clear_fix' >
											<div id='exclamation_point'  class='float_left  ' >
											</div>
											<div  class='float_left message' >
											</div>
										</div>

													<div  id='user_information_section'   class='clear_fix rounded_bg' >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle">
															     	  
																<div id='pay_portion'>
																	<?php  $this->load->view('home/buy_inside_payment.php');   ?>																     	  
																</div>


																<div  id='buynow_container' class='clearfix ' >
																	<div id='buynow_image'>Update
																	</div>
																</div>



														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>						
												
												
			
									
									
										</div>
										
										<div  id='right_col_section' class=' one_third_column float_left margin_left margin_top'>
											
											

											
											


													
													<div  class=' rounded_bg'   style='margin:0px 0px 10px 0px;'  >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle">
													  	
													  	
													  	
																<div id='box_inside_header' class=' header_style' >
																	Trusted Source
																</div>
													  	
																<div  id='box_inside'  class="clearfix ">
																	<div><font class="Apple-style-span" size="2">
																	The privacy and security of your information is of the utmost importance to us. That’s why we partner with Authorize.net to protect your credit card information. Additionally, we never sell your personal information to third parties.
																	</font>
																	</div>
																	<div  id='authorize_logo'>&nbsp;
																	</div>
		
																	
																</div>
															
															
														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>													
											
											<?php
											  $this->load->view('home/pledge.php');   
											?>	
													

											
										</div>	
									
										

										
								</div>
								
						</form >									
								
							
							</div>
				
				</div>



	</div>


<?php     	$this->load->view('footer/footer_section.php');  ?>

</body>
	

</html>


<script type="text/javascript" language="Javascript">
	
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
					
$(document).ready(function() {
	
	
				$('.ship_to_other_div').hide();	
				
				$('.payment_box').css({'margin-bottom':'20px'})
				
				$('#shipping_info, .shipping_box').show();
				
				
				<?php   
				
				

				
				
				$testing = FALSE;
				//$testing = TRUE;

				
				if( $testing == TRUE ){  
							$pairs = array(
							'first_name'=>'Joseph',
							'last_name'=>'Singer',
							'form0 input#email'=>'jose@loverpoint.com',
							'form0 input#password_signup'=>'12345',
							'confirm'=>'12345',
							'zipcode_signup'=>'900036',
							'zipcode_payment'=>'10003',
							'cc_first_name'=>'Joseph',
							'cc_last_name'=>'Singer',
							'cc_address'=>'2341 Treetop Street',
							'cc_state'=>'CA',
							'cc_city'=>'Daly City',
							'cc_code'=>'323',
							'month_exp'=>'11',
							'year_exp'=>'2015'
							);
							

							$pairs['cc_num'] = '370000000000002';
							$pairs['cardtype'] = 'AmEx';							
//							
//							$pairs['cc_num'] = '4007000000027';
//							$pairs['cardtype'] = 'Visa';

						
							foreach($pairs as $key => $value){ ?>
								
								$('#<?php echo $key    ?>').val('<?php echo $value    ?>');
								
							<?php
							}					
				};
				?>
				
				$('form#form0 input[type=text]')

					.click(function(event) {				
						
							$(this)
							//.css({background:'white'}).val('')
							.parent().parent().children('div.error_message').show().html("&nbsp;");

					});
					
	

				<?php 
				
				foreach($payment_info_pairs as $key => $value){ ?>
					
					$('#<?php echo $key    ?>').val('<?php echo $value    ?>');	
					
				<?php
				}
				
				

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
				}	?>
				

				$('#logo').click(function(event) {
					<?php if( $_SERVER['HTTP_HOST'] == 'zekeszoo.com' ){?>	
												document.location.href='http://zekeszoo.com/index.php/home';

					<?php }else{?>
												document.location.href='<?php echo  base_url();   ?>index.php/home';

					<?php } ?>
				});	

				$('form#form0 select')

					.change(function(event) {				
						
							$(this).css({background:'white'})
							
							.parent().parent().children('div.error_message_select').show().html("&nbsp;");
							

					});		
					
					

					
				$('#buynow_image').click(function(event) {
					
						var ok = 1;

						// ** SELECTION MUST BE CHOOSEN
						$('form#form0 select, form#form0 input:not(#gift)')
						
						.css({background:'white'})
						
						.each(function(){
		
								if( $(this).val() == '' ){

									$(this).css({background:'pink'}).parent().parent().children('div.error_message_select, div.error_message').show().html("Can't be blank.")
									
									$(this).click(function(event) {
											$(this).css({background:'white'})
									});	


									ok = 0;

								};
						        
						});	
			
						// ** ZIPCODE FOR PAYMENT MUST BE INT AND GREATER THAN 5 CHARACTERS
						if(  $('form#form0 input#cc_zipcode').val()  != parseInt( $('form#form0 input#cc_zipcode').val() ) 
									||  $('form#form0 input#cc_zipcode').val().length  < 5
						) {
							
							$('form#form0 input#zipcode_payment').css({background:'pink'}).parent().parent().children('div.error_message').show().html("Invalid Zipcode.");

							ok = 0;

						}else{
						
							$('form#form0 input#zipcode_payment').css({background:'white'}).parent().parent().children('div.error_message').show().html("&nbsp;");	
							
						};						
						
						
						if(ok == 1){
							
							// 	alert('submitting');
							$('form#form0').submit();
						};

				});

});
</script>
