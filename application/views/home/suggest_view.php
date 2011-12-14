<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/suggest_view_css.php');  ?>
<?php     	$this->load->view('footer/footer_section_css.php');  ?>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
</head>

<html>

<body>

<?php     	$this->load->view('header/email_subscribe.php');  ?>
	
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
																	Work With Us
																</div>
																
																
																<div    id='box_inside'  class="clearfix ">
																
																
																<form  id='form0' name='form0'
																	action='<?php echo base_url()    ?>index.php/home/update_suggest'
																	method='post'
																	>																
																
																					<div   class='question_header '   >
																						<b><font class="Apple-style-span" size="2"   style='color:black'  >Want to Feature a Deal for Your Business?</font></b>
																					</div>
																					<div><font class="Apple-style-span" size="2">
																						If you have a great pet product or service there is no better place to promote your business
																						than Zeke’s Zoo for new, pre-paid customers and no cost advertising. Our pet-friendly community
																						is always eagerly awaiting each weekly offer, buying the deals and sharing with their friends across
																					social media sites like Facebook and Twitter.</font>
																					</div>
																					<div>
<font class="Apple-style-span" size="2">
																						<ol id='steps' >
																							<li>You fill out the below form.</li>
																							<li>You get to create your deal. We are here to help.</li>
																							<li>We’ll launch the deal on our website and syndicate across our promotion network.</li>
																							<li>We’ll deliver you a list of new clients and a check for all sales.</li>
																						</ol></font>
																						<div><font class="Apple-style-span" size="2">Get your deal on Zeke’sZoo by filling out the below.</font>
																						</div>
					
					
					
																					</div>
																					<style>
																					.inner_form{
																						font-weight:bold;
																					}
																					</style>
																					<font class="Apple-style-span" size="2">
																					<div  class='input_div inner_form' >
																						<div  class='input_row clearfix' >
																			  					<div  class='float_left ' >
																						  			<div>Name of Business 
																						  			</div>
																						  			<div><input  class=' input_style' name="business_name" id="business_name" type="" value="">
																						  			</div>
																						  		</div>
																						  		
																						  		<div  class='float_left input_second_column' >
																						  			<div>Website
																						  			</div>
																						  			<div><input  class=' input_style' name="business_website" id="business_website" type="" value="">
																						  			</div>
																						  		</div>																							
																						</div>

																						<div  class='input_row clearfix ' >
																			  					<div  class='float_left ' >
																						  			<div>Contact 
																						  			</div>
																						  			<div><input  class=' input_style' name="contact_name" id="contact_name" type="" value="">
																						  			</div>
																						  		</div>
																						  		
																						  		<div  class='float_left input_second_column' >
																						  			<div>Email
																						  			</div>
																						  			<div><input  class=' input_style' name="contact_email" id="contact_email" type="" value="">
																						  			</div>
																						  		</div>	
																						  		
																						  		<div  class='float_left input_second_column' >
																						  			<div>Phone
																						  			</div>
																						  			<div><input  class=' input_style' name="contact_phone" id="contact_phone" type="" value="">
																						  			</div>
																						  		</div>																							  		
																						  																								
																						</div>
</font>
																					</div>
												  		
																			  		
																			  		
																			  		
																			  		<div   class=' clearfix' id='submit_button'>
																			  			Submit
																			  		</div>
														  	</form>
																</div>
															
															
														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>
												
												
												
			
									
									
										</div>
										
										
										
										
										
										
										
										
										<div id='right_col_section'  class='float_left' >
											
											
												<div class=' one_third_column'  >
													
													
											<?php
											  $this->load->view('home/pledge.php');   
											?>						
													
													
																									<iframe></iframe>
																									<iframe></iframe>
																									<iframe></iframe>
													
													
													
													
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
				$('#submit_button').click(function(event) {				
						
						$('#form0').submit();
						
				});	

});		


</script>

<?php  

if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){
	
	$this->load->view('footer/jquery_ui_for_dialog.php');
	$this->load->view('footer/wysiwyg_jquery_with_iframe.php');
	$this->load->view('footer/fancy_zoom.php'); 
	
};
