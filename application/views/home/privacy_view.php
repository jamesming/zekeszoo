<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/generic_view_css.php');  ?>
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
																	Privacy
																</div>
													  	
													  	
																<div    id='box_inside'  class="clearfix ">
																	<div>
													  				<div><font class="Apple-style-span" size="2">ZekesZoo ("ZekesZoo") values your privacy and the privacy of other visitors and users of our website at http://www.zekeszoo.com (or successor URLs) (collectively, the "ZekesZoo Site" or the "Site"). Our ongoing commitment to the protection of your privacy is essential to maintaining the relationship of trust that exists between ZekesZoo and you ("You" or "User"). This notice of our Privacy Policy is intended to help you understand what information we gather from Users such as yourself, how we use that information and in some instances how we share that information. By using the ZekesZoo Site, you expressly consent to the information handling practices described in this Privacy Policy.</font></div>
																		<div><font class="Apple-style-span" size="2"><br /></font></div>
																	</div>
																	<div onclick='$(this).prev().hide();$(this).hide().next().slideDown("slow")'   style='cursor:pointer;color:blue;font-size:11px;font-weight:bold'  >more ...
																</div>																	
																	

														  		<div  table='website'    href='#wysiwyg_div' id='privacy'  class="wysiwyg_div_link_disable clearfix elements_to_hide_when_adding_deal"   style='display:none'  >
																																<?php     
																																
																																		if( isset( $website[0]->privacy  ) ){
																																			echo $website[0]->privacy;
																																		}else{
																																			echo 'click to enter contents.....										
																																						';
																																		};
																																
																																?>
														  		</div>
																</div>
															
															
														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>
												
												
												
			
									
									
										</div>
										
										
										
										
										
										
										
										
										<div id='right_col_section'  class='float_left' >
											
											
												
											<?php
											  $this->load->view('home/facebook_likebox.php');   
											?>
												
												
												
			
									
									
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
				

});		



</script>

<?php  

	$this->load->view('footer/jquery_ui_for_dialog.php');
	$this->load->view('footer/wysiwyg_jquery_with_iframe.php');
	$this->load->view('footer/fancy_zoom.php');

if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){
	
 
	
};
