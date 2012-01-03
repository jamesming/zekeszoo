<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/generic_view_css.php');  ?>
<?php     	$this->load->view('footer/footer_section_css.php');  ?>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
<style>
	

.input_label{
padding:0px 0px 0px 2px;
font-size: 12px;
}
div.outer_input_label input{
												    border: 1px solid darkgray;
												    height: 25px;
										    		padding-left: 5px;
										    		
												}			
.error_message{
    color: darkRed;
    font-size: 9px;
    height: 9px;
}
	
#update_container {
    height: 122px;
}

			#update_container div#update_image {
			    background-image: url("<?php  echo base_url()   ?>images/buynow2.png");
			    background-position: center center;
			    background-repeat: no-repeat;
			    color: white;
			    cursor: pointer;
			    font-size: 21px;
			    font-weight: bold;
			    height: 69px;
			    padding-top: 35px;
			    text-align: center;
			    width: 180px;
			    margin-left: 0px;
			}
</style>
</head>

<html>

<body>


	
<div id='top_body'  class='  clearfix' >
	<div id='sunrise'  class=' container' >

<?php     	$this->load->view('header/top_header.php');  ?>
							
							<div  class=' container' >
								
								<div   class=' container_inside   margin_top' >
									
										<div id='box_section'  class='float_left' >
											
											
												<div class=' two_third_column'  >
													
													
													<div  class=' rounded_bg' >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle left_middle"   style='min-height:302px'  >
													  	
													  	
													  	
																<div id='box_inside_header' class=' header_style'  >
																	Change Password
																</div>
													  	
													  	
																<div    id='box_inside'  class="clearfix "   >

																	<div>
																		
																		Please enter your email so that we can send you a link to change your password.
																		
																		<br /><br />
																	</div>
																	
																	<div class=' input_label' >Email
																	</div>
																	<div class=' input_div' >
																		<input name="email" id="email" type="text" value=""  class='small_input '>
																	</div>
																	<div  class=' error_message' >&nbsp;
																	</div>	

	
																	<div  id='update_container' class='clearfix ' >
																		<div id='update_image'>Submit
																		</div>
																	</div>
																
																</div>
															
															
														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>
												
												
												
			
									
									
										</div>
										
										
										
										
										
										
										
										
										<div id='right_col_section'  class='float_left' >
											
											
												<div class=' one_third_column'  >
													
													
													<div  class=' rounded_bg' >
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
													

													
												</div>
												
												
												
			
									
									
										</div>
										
										
										
									
										
								</div>
							
							</div>


					
				</div>



	</div>



<?php     	$this->load->view('footer/footer_section.php');  ?>

</body>
</html>


<script type="text/javascript" language="Javascript">
$(document).ready(function() {
	
				$('#logo').click(function(event) {
					<?php if( $_SERVER['HTTP_HOST'] == 'zekeszoo.com' ){?>	
												document.location.href='http://zekeszoo.com/index.php/home';

					<?php }else{?>
												document.location.href='<?php echo  base_url();   ?>index.php/home';

					<?php } ?>
				});	
				
				$('#logout').click(function(event) {
						document.location.href='<?php echo  base_url();   ?>index.php/home/logout/<?php echo $deal_id    ?>';
				});	
				
				$('.middle.left_middle #email').click(function(event) {
					$(this).val('');
					$('.error_message').hide();
				});	
				
				
				$('#update_image').click(function(event) {
						$.get("<?php echo base_url(). 'index.php/home/email_link_to_change_password/' ?>",{
							email:$('.middle.left_middle #email').val()
							},function(data) {
									if( data == '1'){
										
										$('.middle.left_middle #box_inside').html('Thank you.  Please check your email inbox for a link to change your password.');
										
									}else{
										
										$('.error_message').show().text('Email not found.');
										
									};
		
							});	
									
						});	

});		

</script>