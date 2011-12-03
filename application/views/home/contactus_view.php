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
																	Contact Us
																</div>
<style>					  	
#box_inside.clearfix p{
font-size:13px;
margin:0px 0px 0px 0px;
}
</style>
																<div    id='box_inside'  class="clearfix ">
														  		<p>
																	We currently offer the following ways to contact us
<br /><br />
																	<b>E-mail</b><br />customerservice@zekeszoo.com<br /><br />
																	
																	<b>Phone</b><br />
																	For all inquiries regarding your zekeszoo.com order,<br />please call us at 1-800-247-6575 Mon-Fri, 8am-10pm ET, Sat/Sun, 9am-8pm ET.<br />
																	For all other inquiries please call us at 1-800-617-2239.<br />
																	<br />
																	<b>Mail</b><br />
																	SperryTopSider.com Customer Service<br />
																	4200 South A Street<br />
																	Richmond, IN 47374<br />
																	</p>
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
