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
																	Terms of Agreement
																</div>
													  	
													  	
																<div    id='box_inside'  class="clearfix ">
																	<div>
																																<p class="MsoNormal" style="mso-pagination:none;mso-layout-grid-align:none;
text-autospace:none"><span style="font-family:&quot;Lucida Sans Unicode&quot;;color:#454545"><font class="Apple-style-span" size="2">These
Terms of Service set forth the terms and conditions that apply to your use of
ZekesZoo website located at http://www.zekeszoo.com (or successors URLs) and
the information services, vouchers, certificates, discounts and materials
offered thereon (collectively, the ZekesZoo Site) which are offered to you by
ZekesZoo (ZekesZoo), its affiliates or merchants.&nbsp; Subject to your
compliance with these Terms of Service, ZekesZoo grants you (You or User)
permission to use the ZekesZoo Site as set forth below.&nbsp; Certain programs,
features, services, vouchers, certificates or discounts may have additional
terms as expressly indicated by ZekesZoo. &nbsp;<o:p></o:p></font></span></p>

<br />

<p class="MsoNormal" style="mso-pagination:none;mso-layout-grid-align:none;
text-autospace:none"><span style="font-family:&quot;Lucida Sans Unicode&quot;;color:#454545"><font class="Apple-style-span" size="2">PLEASE
CAREFULLY READ THE FOLLOWING AGREEMENT.&nbsp; BY REGISTERING FOR, ACCESSING,
BROWSING, AND/OR OTHERWISE USING THE ZEKESZOO SITE, YOU ACKNOWLEDGE THAT YOU
HAVE READ, UNDERSTOOD AND AGREE TO BE BOUND BY THE FOLLOWING TERMS OF SERVICE,
INCLUDING ANY FUTURE MODIFICATIONS (COLLECTIVELY, THE TERMS).&nbsp; IF AT ANY
TIME, YOU DO NOT AGREE TO THESE TERMS, PLEASE IMMEDIATELY TERMINATE YOUR USE OF
THE ZEKESZOO SITE.<o:p></o:p></font></span></p>
																	</div>
																	
																	<div onclick='$(this).prev().hide();$(this).hide().next().slideDown("slow")'   style='cursor:pointer;color:blue;font-size:11px;font-weight:bold'  >more ...
																	</div>
														  		<div   style='display:none'    table='website'   href='#wysiwyg_div' id='terms'  class="wysiwyg_div_link_disable clearfix elements_to_hide_when_adding_deal" >
																																<?php     
																																
																																		if( isset( $website[0]->terms  ) ){
																																			echo $website[0]->terms;
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
