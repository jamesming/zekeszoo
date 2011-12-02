<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/register_view_css.php');  ?>
<?php     	$this->load->view('footer/footer_section_css.php');  ?>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
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
													  <div class="middle">
													  	

																	
																<div id='box_inside_header' class=' header_style' >
																	Sign Up
																</div>
													  	
													  	
																<div    id='box_inside'  class="clearfix ">
																	
																	






<form id='form0' name='form0' action='<?php echo base_url()    ?>index.php/home/register' method='post'>

															<div class='user_info_inner_box float_left' >
																	

<!--																					
																					<div  class=' outer_input_label' >
																						<div class=' input_label' >Full Name
																						</div>
																						<div class=' input_div' >
																							<input name="fullname" id="fullname" type="text" value=""  class='large_input ' >
																						</div>
																						<div  class=' error_message' >&nbsp;
																						</div>
																					</div>
	-->																				
	
	
																		<div  class=' outer_input_label' >
																			<div  class='float_left halfies' >
																				<div class=' input_label' >First Name
																				</div>
																				<div class=' input_div' >
																					<input name="first_name" id="first_name" type="text" value=""  class='small_input '>
																				</div>
																				<div  class=' error_message' >&nbsp;
																				</div>																			
																			</div>
																			<div  class='float_left halfies' >
																				<div class=' input_label' >Last Name
																				</div>
																				<div class=' input_div' >
																					<input name="last_name" id="last_name" type="text" value=""  class='small_input '>
																				</div>
																				<div  class=' error_message' >&nbsp;
																				</div>																						
																			</div>																			
																		</div>
																		
	
	
	
																					<div  class=' outer_input_label' >
																						<div  class='float_left halfies' >
																							<div class=' input_label' >Email
																							</div>
																							<div class=' input_div' >
																								<input name="email" id="email" type="text" value=""  class='small_input '>
																							</div>
																							<div  class=' error_message' >&nbsp;
																							</div>																				
																						</div>
																						<div  class='float_left halfies' >
																							<div class=' input_label' >Zip Code
																							</div>
																							<div class=' input_div' >
																								<input name="zipcode_signup" id="zipcode_signup" type="text" value=""  class='small_input '>
																							</div>	
																							<div  class=' error_message' >&nbsp;
																							</div>																			
																						</div>																			
																					</div>
																					
																					
																					<div  class=' outer_input_label' >
																						<div  class='float_left halfies' >
																							<div class=' input_label' >Password
																							</div>
																							<div class=' input_div' >
																								<input name="password" id="password_signup" type="password" value=""  class='small_input '>
																							</div>	
																							<div  class=' error_message' >&nbsp;
																							</div>																			
																						</div>
																						<div  class='float_left halfies' >
																							<div class=' input_label' >Password (confirm)
																							</div>
																							<div class=' input_div' >
																								<input name="confirm" id="confirm" type="password" value=""  class='small_input '>
																							</div>	
																							<div  class=' error_message' >&nbsp;
																							</div>																		
																						</div>																			
																					</div>
																					
																					
																					<div  id='i_agree' class=' outer_input_label'>
																						<input     style='
																						        background: transparent;
        																						border: 0;
																						'   class='float_left '  name="i_agree_box" id="i_agree_box" type="checkbox" value="">
																						<div  id='text_iagree' class='float_left ' > I agree to the <a>Deal Term</a>, <a>Terms of Service</a> and <a>Privacy Policy</a>. 
																						</div>
																					</div>
																					
																					
																					<div  class='clearfix outer_input_label'>
																						<div id='signup_image'>
																							Sign Up												
																						</div>
																					</div>
																					
																					
															</div>

</form>


<div>
	
														  	
												  			<div id='error_message'>
												  				<?php if( isset ( $error['type']) ){
												  				
												  									echo $error['message'];
												  				
													  						} ?>
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
																	Connect
																</div>
													  	
													  	
																<div    id='box_inside'  class="clearfix ">
																	
																	
																	

		
																	
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
<?php     	$this->load->view('footer/document_ready_register.php');  ?>

</body>
</html>

