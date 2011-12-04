<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/buy_css.php');  ?>
<?php     	$this->load->view('footer/footer_section_css.php');  ?>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/creditcard/creditcard_validation.js"></script>
<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo  base_url();   ?>js/jquery.scrollTo-min.js"></script>
</head>

<html>

<body>
<div id="very_top"><div>

<div id='top_body'  class='  clearfix' >
	<div id='sunrise'  class=' container' >

<?php     	$this->load->view('header/top_header.php');  ?>
							

						<form id='form0' name='form0'
							 action='<?php
						
							 echo base_url().	'index.php/home/buy';
							 	?>' method='post'>
							 	<input name="priority" type="hidden" value="<?php echo $priority    ?>">

							<div  class=' container' >
								
								<div id='buy_box_other_deals_container'  class=' container_inside   margin_top' >
									
										<div id='buy_box_section'  class='margin_top float_left' >
											
											
												<div class=' two_third_column'  >
													
													
													<div  class=' rounded_bg' >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle">
													  	
													  	
													  	
																<div id='deal_buy_box_header' class=' header_style' >
																	Your Deal
																</div>
													  	
													  	
																<div    id='deal_buy_box'  class="clearfix ">
																	
																	
																	
																	<div id='items_header'   class="clearfix ">
																		
																		<div  class='float_left description_col ' >
																			Description
																		</div>
																		<div  class='float_left  quantity_col' >
																			Quantity
																		</div>
																		<div  class='float_left  price_col' >
																			Price
																		</div>
																		<div  class='float_left  total_col' >
																			Total
																		</div>																		
																		
																	</div>
																	<div id='items_middle'   class="clearfix ">
																		
																		<div  class='float_left description_col ' >
																			<?php echo $deals[0]->deal_short_description    ?>
																		</div>
																		<div  class='float_left  quantity_col' >
																			<select name='quantity' id='quantity'>
																				
																					<?php
																					for($i=1;$i<=$quantity_available_to_user;$i++){?>
																						<option value='<?php echo $i    ?>'><?php echo $i    ?></option>
																					<?php } ?>

																			</select>
																		</div>
																		<div  id='unit_price' class='float_left  price_col' >
																			$<?php echo $deals[0]->deal_price    ?>
																		</div>
																		<div id='total_price' class='float_left  total_col' >
																			$<?php echo $deals[0]->deal_price    ?>
																		</div>																		
																		
																	</div>		
																	
<?php
     	$this->load->view('home/buy_view_options.php');  
?>
																	
																	

																	<div id='is_gift'   class="clearfix "   style='display:none'  >
																		
																		<img  class='float_left '  src='<?php echo base_url()    ?>images/gift.png'>
																		<div  class='float_left ' >Is this a gift? 																
																		</div>

																		
																	</div>																			
		





																				<?php
																				if( isset( $users[0]->authorize_customerProfileId ) 
																				&& $users[0]->authorize_customerProfileId != '' ){  ?>
																				
																						<div  class='clearfix '  id='change_credit_card'>
																							
																							<input id="use_card_on_file" name='use_card_on_file' type="checkbox" value="1" CHECKED>
																							Use credit card on file (**<?php echo $users[0]->last_three    ?>)
																						</div>
																					
																				<?php } ?>




																	
																</div>
															
															
														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>
												
												
												
												
										<div class=' error_box clear_fix' >
											<div id='exclamation_point'  class='float_left  ' >
											</div>
											<div  class='float_left message' >
											</div>
										</div>
												
												
													<div  id='user_information_section'   class='clear_fix rounded_bg  margin_top' >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle">


																<div id='sign_up_portion'>
																	<?php
																	
																			if(  !isset( $this->session->userdata['user_id'] )  ){
																			
																			  $this->load->view('home/buy_inside_singup.php');   
																			  																		
		
																			};

																	 ?>
																</div>
																																     	  
																<div id='pay_portion'>
																	<?php  $this->load->view('home/buy_inside_payment.php');   ?>																     	  
																</div>


																<div  id='buynow_container' class='clearfix ' >
																	<div id='terms'>
																		By purchasing, you agree to the <a href='<?php echo base_url()    ?>index.php/home/terms'>Terms of Service</a> and <a href='<?php  echo base_url()   ?>index.php/home/privacy'>Privacy Policy</a>.
																	</div>
																	
																	<div id='buynow_image'>Purchase
																	</div>
																</div>



														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
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





								</div>
								
						</form >									
								
							
							</div>
				
				</div>



	</div>


<?php     	$this->load->view('footer/footer_section.php');  ?>

</body>
	

</html>

<?php     	$this->load->view('footer/document_ready_buy.php');  ?>