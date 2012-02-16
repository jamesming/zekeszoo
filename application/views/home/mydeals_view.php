
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/mydeals_view_css.php');  ?>
<?php     	$this->load->view('footer/footer_section_css.php');  ?>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
</head>


<?php 

if( isset($transactions[0]['redemption_type_id'] ) && $transactions[0]['redemption_type_id'] == 1){?>
	<style>
	.redeem{
	display:none;	
	}
	</style>
<?php } ?>

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
													  	<div    id='box_inside'  class="clearfix "    >
													  	
													  	
																<div id='box_inside_header' class=' header_style' >
																	My Deals
																</div>
													  	
													  		<div id='submenu'>
													  			<div  id='filterby' class='float_left ' >Filter by:
													  			</div>
													  			<ul  class='float_left '>
													  				<li id='available' >Available</li>
													  				<li id='used' >Used</li>
													  				<li id='expired' >Expired</li>
													  				<li id='all' >All</li>
													  			<ul>
													  		</div>

																<table  id='deal-grid'>
																	<tr  class='table-header ' >
																		<td>&nbsp;
																		</td>
																		<td>Name
																		</td>
																		<td>Purchase Date
																		</td>
																		<td>Expiration Date
																		</td>
																	</tr>


																<?php foreach($transactions  as $transaction){  ?>
																
																		<?php if( $transaction['status'] == 'inactive'){?>
																		
																			<tr>
																				<td colspan='4'>( This Deal Is Pending More Buyers To Be Valid )
																				</td>
																			</tr>
																			
																			<tr  class='deal-rows ' >
																				<td>
																					
																					<div  >
																						<a href='<?php echo base_url()    ?>index.php/home/deal/<?php echo $transaction['deal_url']    ?>'>
																							<img  class='deal_short_description ' src='<?php echo base_url()    ?>uploads/1/<?php echo $transaction['deal_id']   ?>/image_tiny.png?random=<?php echo rand(5,2122)    ?>'   calendar_id=<?php  echo $transaction['calendar_id']   ?>>
																						</a>
																					</div>																					
																				</td>
																				<td>
																					<div class='deal_short_description' calendar_id=<?php  echo $transaction['calendar_id']   ?>  calendar_id=<?php  echo $transaction['calendar_id']   ?>>
																						<a href='<?php echo base_url()    ?>index.php/home/deal/<?php echo $transaction['deal_url']    ?>'>
																							<?php  echo $transaction['deal_short_description'];   ?>	
																						</a>
																					</div>

																					<div class=' transaction_div float_left '>
																						<ul>
																						<?php foreach($transaction['user_deals']  as $one_user_deal  ){  ?>
																														<li>
																																	<?php echo $one_user_deal['id']   ?>
																														</li>																								
																						<?php } ?>
																						</ul>																				
																					</div>
																				</td>
																				<td>
																								<div class='purchase_date float_left' >
																									
																									<?php echo  date("F j, Y", strtotime($transaction['created']) );  ?>
																									
																								</div>																					
																				</td>																				
																				<td>
																					
																								<div class='expiration_date float_left' >
																										
																										<?php  echo date("F j, Y", strtotime($transaction['deal_will_expire']) );   ?>
																										
																									</div>		
																					
																					
																				</td>
																			</tr>																			

				
																		<?php }else{?>


																				<tr   class='deal-rows ' >
																					<td>
																										<div   id='transaction_image_div' class='float_left ' >
																											<a href='<?php echo base_url()    ?>index.php/home/deal/<?php echo $transaction['deal_url']    ?>'>
																												<img  class='deal_short_description ' src='<?php echo base_url()    ?>uploads/1/<?php echo $transaction['deal_id']   ?>/image_tiny.png?random=<?php echo rand(5,2122)    ?>'   calendar_id=<?php  echo $transaction['calendar_id']   ?>>
																											</a>
																										</div>																						
																					</td>
																					<td>
																											<div class='deal_short_description'   calendar_id=<?php  echo $transaction['calendar_id']   ?>>
																												<a href='<?php echo base_url()    ?>index.php/home/deal/<?php echo $transaction['deal_url']    ?>'>
																													<?php  echo $transaction['deal_short_description'];   ?>	
																												</a>
																											</div>		
																											<div  class='transaction_div '   >
																														<ul>
																														<?php foreach($transaction['user_deals']  as $one_user_deal  ){  ?>
																														
										
																																						<li>
																																								<a href='<?php echo base_url();    ?>index.php/home/voucher/<?php echo $one_user_deal['id']    ?>' target='_blank'> 
																																									<?php echo $one_user_deal['id']    ?>
																																								</a>
																																								&nbsp;&nbsp;
																																								<span   style='display:none' class='redeem ' user_deal_id=<?php echo $one_user_deal['id']    ?> redeemed=<?php echo $one_user_deal['redeemed'];    ?>>
																																									
																																									
																																									<?php if( $one_user_deal['redeemed'] == 0){?>
																																											(redeem)
																																									<?php }else{?>
																																											(unredeem)
																																									<?php } ?>
																																									
																																									
																																									
																																									
																																									</span>
																																						</li>																								
											
																														
																														<?php } ?>
																														</ul>																															
																											</div>

																																															
																					</td>
																					<td>
																										<div class='purchase_date float_left' >
																											
																											<?php echo  date("F j, Y", strtotime($transaction['created']) );  ?>
																											
																										</div>
																					</td>
																					<td>
																										<div class='expiration_date float_left' >
																											
																											<?php  echo date("F j, Y", strtotime($transaction['deal_will_expire']) );   ?>
																											
																										</div>																								
																					</td>																					
																				</tr>

							
							



																					
																		<?php } ?>
																

																

																
																<?php } ?>

																</table>
																	
																</div>
															
															
														</div>
														<div class="bottom clearfix"><div class="sub_bottom">&nbsp;</div></div>
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
							
							</div>


					
				</div>



	</div>



<?php     	$this->load->view('footer/footer_section.php');  ?>


<form 
	name='form1' 
	id='form1' 
	action='<?php echo base_url()    ?>index.php/home/index' >
<input name="calendar_id" id="calendar_id" type="hidden" value="">
</form>

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
	
//				$('.deal_short_description').click(function(event) {	
//						$('#calendar_id').val($(this).attr('calendar_id'));		
//						$('#form1').submit();	
//				});	
								
				
				
				$('#logout').click(function(event) {
						document.location.href='<?php echo  base_url();   ?>index.php/home/logout';
				});		


				$('#submenu li').click(function(event) {
						document.location.href='<?php echo  base_url();   ?>index.php/home/mydeals?filter=' + $(this).attr('id');
				});		
				
				$('.redeem').css({cursor:'pointer'}).click(function(event) {

						if(  $(this).attr('redeemed') == 1 ){
							$(this).attr('redeemed', 0);

						}else{
							$(this).attr('redeemed', 1);
						};
						
						$.post("<?php echo base_url(). 'index.php/home/redeem/'; ?>",{
							user_deal_id: $(this).attr('user_deal_id'),
							redeem: $(this).attr('redeemed')
							},function(data) {
						    		document.location.href='<?php echo  base_url();   ?>index.php/home/mydeals?filter=available';
							});	
				});						
				
				


});		



</script>