<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/recentdeals_view_css.php');  ?>
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
											
											
												<div  class=' two_third_column' >
													

													
													<div  class=' rounded_bg' >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle">
													  	
													  	
													  	
														<div id='box_inside_header' class=' header_style' >
															Upcoming Deals
														</div>
  	
													  <?php
													  // echo '<pre>';print_r(  $past_deals );echo '</pre>';
													  ?>
													  
													  <?php foreach($past_deals  as $past_deal){  ?>
													  
													  
														  <div  class='deal_container clearfix ' >
														  	<div    class='image_div float_left' >
														  		<a target='_blank' href="<?php echo base_url().'index.php/home/deal/' . $past_deal['deal_url'];    ?>">
														  			<img src='<?php  echo base_url()   ?>uploads/1/<?php echo $past_deal['deal_id']    ?>/image_medium.png'>
														  		</a>
														  	</div>
														  	<div  class='deal_info float_left'>
														  		<div  class=' deal_date' >
														  			<?php echo $past_deal['month']    ?>/<?php echo $past_deal['day']    ?>/<?php echo $past_deal['year']    ?>
														  		</div>

														  		<div  class='deal_headline_div ' >
																	  <!-- <a target='_blank' href="<?php echo base_url().'index.php/home/deal/' . $past_deal['deal_url'];    ?>"> -->
																			<?php echo strip_tags($past_deal['deal_headline'])    ?>
																		<!-- </a>	 -->														  			
														  		</div>
															  
														  	</div>

													  	
														  </div>
	
													  
														<?php } ?>
													  

															
														</div>
														<div class=" class='clearfix ' bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>
												
												

									
									
										</div>
										
										
										
										<div id='right_col_section'  class='float_left' >
											
											
												<div class=' one_third_column'  >
													
													
																									<?php     	
																									$this->load->view('home/suggest_a_business.php');  
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
				
				$("div.deal_container:last-child,#box_section  .middle div.deal_info div.deal_pricing_info div.deal_pricing_info_inside div:last-child").css({border:'0px'})


});		



</script>

<?php  

if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){
	
	$this->load->view('footer/jquery_ui_for_dialog.php');
	$this->load->view('footer/wysiwyg_jquery_with_iframe.php');
	$this->load->view('footer/fancy_zoom.php'); 
	
};
