<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/homepage_css.php');  ?>
<?php				if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){
						$this->load->view('header/control_panel_css.php');  
						}; ?>
<?php     	$this->load->view('footer/footer_section_css.php');  ?>


<META NAME="KEYWORDS" CONTENT="zekeszoo, zekes zoo, pet deals, pet savings, pet discounts, cat deals, dog deals, cat discounts, dog discounts, dog toy deals, dog food deals, dog deal discounts, dog toy discounts, organic pet products, pet tips, best pet food deals, coupon codes for pet food, coupon codes for pet products">
<META NAME="DESCRIPTION" CONTENT="discounted deals for pet products">
<TITLE>www.zekeszoo.com</TITLE>
<META HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="EN">
<META NAME="revisit-after" CONTENT="14 days">
<META NAME="Generator" CONTENT="http://websitesubmit.hypermart.net/">
<META NAME="robots" CONTENT="all">
<META NAME="Author" CONTENT="john">
<!-- MetaTags http://websitesubmit.hypermart.net/ -->
<!-- discounted deals for pet products -->
<link rel="shortcut icon" href="<?php echo base_url()    ?>images/favicon.ico">


<meta property="og:title" content="<?php echo strip_tags(  ( isset( $deals[0]->deal_headline) ? $deals[0]->deal_headline:'' ))    ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php  echo base_url().'index.php/home/deal/'.$deal_url   ?>?v=2" />
<meta property="og:image" content="<?php echo base_url(); ?>uploads/1/<?php echo  ( isset( $deals[0]->id) ? $deals[0]->id:'' )   ?>/image_tiny.png" />
<meta property="og:site_name" content="Zekeszoo.com" />
<meta property="fb:app_id" content="245890495426188" />
<meta property="og:description"
      content="This is a great deal to buy<?php echo rand(5, 1231) ?>"/>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery_countdown.js"></script>
</head>

<html>

<body>

<div  id='subscribe_container'>
	
		<div  class='container '    >
			
				<div id='paw_image' class='float_left ' >
				</div>
				<div  class='content float_left '   style='font-weight:normal'  >Get great deals for your pet today!
				</div>
				<div  class='input_form float_left '   >
					<input  class='short ' id="email"  type="text" name="email" onblur="if(this.value==''){this.value='Enter your email address'}" onfocus="if(this.value=='Enter your email address'){this.value=''}" value="Enter your email address">
					<input  class='shorter ' id="zip"  type="text" name="zip" onblur="if(this.value==''){this.value='and zip'}" onfocus="if(this.value=='and zip'){this.value=''}" value="and zip">
				</div>

				<img id='go_button'  class=' cursor_pointer float_left' src='<?php echo base_url()    ?>images/go.png'/>
				<div  class=' cursor_pointer float_left'  id='close_subcribe'>close[x]
				</div>
		</div>	
	
</div>
	
	
<div id='top_body'  class='  clearfix' >
	<div id='sunrise'  class=' container' >

<?php     	$this->load->view('header/top_header.php');  ?>
							
							<div  class='clearfix container' id='main_section_container'   >
								
								<div   id='main_section'    class='container_inside'   >
									
										<div  class=' rounded_bg ' >
											<div class="top">
												<div class="sub_top">&nbsp;</div>
											</div>
										  <div class="middle">
												<div class="clearfix">
													
													
													<div table='deals' id='deal_headline'   href='#wysiwyg_div'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal" >
														
														<?php
																	if( isset( $deals[0]->deal_headline  ) ){
																		echo $deals[0]->deal_headline;
																	}else{?>
																		Click here to enter a headline for "<?php  echo ( isset( $deals[0]->deal_name) ? $deals[0]->deal_name:'' );  ?>" in this line.  It should encompass two lines.
																	<?php
																	};
														     ?>
													</div>
													
													
													<div id='deal_image_buynow_container' class='  margin_top' >
														
														
														<div id='deal_image'   class='float_left elements_to_hide_when_adding_deal'   >
															
															<?php 
															$filename = 'uploads/'.$site_id.'/'.$deal_id.'/image.png';
															
															if (file_exists($filename)) {?>
															   <img id='img_deal' src='<?php echo base_url()    ?>uploads/<?php echo $site_id;    ?>/<?php echo $deal_id;    ?>/image.png?random=<?php echo  rand(5,123341);   ?>' />
															   <?php     					
															} else {?>
																<div   style='padding-top:100px;text-align:center;font-size:30px;color:gray;font-weight:bold'  > click to upload file
																</div>
															   
															<?php
															 }    
															?>
														</div>
														

														
														<div id='buynow'   class=' float_left'>
															<div id='value_compare'>
																
																
																<div id='value_div' >Value<br />$<span id='orig_price_on_website'  class=' elements_to_hide_when_adding_deal' ><?php  echo  ( isset( $deals[0]->orig_price) ? $deals[0]->orig_price:'' );   ?></span>
																</div>
																<div id='discount_div' >Discount<br /><span id='discount'  class=' elements_to_hide_when_adding_deal' ><?php  echo $discount;   ?></span>%
																</div>
																<div id='savings_div' >Savings<br />$<span id='savings'  class=' elements_to_hide_when_adding_deal' ><?php  echo $savings;   ?></span>
																</div>
																
																
															</div>
															
															
															
															<div id='buynow_image'>
																
																<div id='buynow_image_dollar_sign' class=' float_left'>$
																</div>
																<div id='deal_price_on_website' class='elements_to_hide_when_adding_deal float_left'><?php  echo  ( isset( $deals[0]->deal_price) ? $deals[0]->deal_price:'' );   ?>
																</div>
																<div id='buynow_text' class=' float_left'   >
																	
																	
																	<?php if($howmany_left > 0 ){?>
																			BUY NOW
																	<?php }else{?>
																			SOLD OUT
																	<?php } ?>
																	
																	
																</div>
																
																
															</div>
				
															<div id='countdown_container'>
																<div id='hourglass_container'>
																	<img src='<?php  echo base_url()   ?>images/hourglass.png'  />
																</div>
																<div  >Time Left To Buy<br />
																	<span id='defaultCountdown'></span>
																</div>
															</div>
																										
															
															<div id='bought_container' >
																
																<div id='bought_div' class=' clearfix'     style='display:none'    >
																	<span id='bought'><?php echo $bought_so_far    ?></span> bought / 
																	<?php echo $howmany_left    ?> left
																</div>
																
																
																		<?php if( $deal_is_on ){?>
																		
																							<div id='bought_container_middle' class=' clearfix'    style='display:none' >
																								<div id='checkbox_container' class=' float_left'>
																									<img src='<?php echo base_url()    ?>images/checkbox.jpg'/>
																									
																								</div>
																								<div id='deal_is' class=' float_left'>
																									The deal is on!
																								</div>
																							</div>
																							
																							
																							
																							<div id='tipped_at_div' class=' clearfix'   style='display:none'  >
																								Tipped on 
																								<span><?php echo  date("F j,", strtotime($tipped_time) ) . ' at ' . date("g:i a", strtotime($tipped_time) );  ?></span> 
																								with 
																								<span id='bought_tipping_point'><?php echo ( isset( $deals[0]->minimum_quantity) ? $deals[0]->minimum_quantity:'' )    ?></span> bought
																							</div>																							
																							
																																									
																		
																		
																		<?php }else{?>
																		
																							
																							<div id='bought_container_middle' class=' clearfix'   style='display:none' >
																								<div id='checkbox_container' class=' float_left'>
																									<img src='<?php echo base_url()    ?>images/checkbox.jpg'/>
																									
																								</div>
																								<div id='deal_is' class=' float_left'>
																									<?php  echo $count_of_buyers_needed_to_tip_deal  ?> more needed!
																								</div>
																							</div>																			
																																					

																		<?php } ?>
																



																
																<div id='share_container' class='social_share_div clearfix' >
<div  id='share_text'>
	Share this deal:					
</div>
<table  id='social_table'>
	<tr>
		
		<td   style='display:none'  >
		
				<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fzekeszoo.com/index.php/home/deal/<?php  echo $deal_url   ?>&amp;send=false&amp;layout=box_count&amp;width=150&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:90px;" allowTransparency="true"></iframe>

		</td>		
		<td  id='facebook_td'     >
			<script>
				function fbs_click() {
					u=location.href;
					t=document.title;
					window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
				</script>
				<style> 
					html .fb_share_link { 
						padding:2px 0 0 20px; 
						height:16px; 
						/*background:url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top left;*/
						background:url(<?php echo base_url()    ?>images/fb.gif) no-repeat top left;
					}
				</style>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" class="fb_share_link">
						Share on Facebook
				</a>
		</td>
		<td  id='twitter_td'>
			
			<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			
		</td>
		


	</tr>
</table>


																	
																</div>
																
															</div>											
															
														</div>
				
														
													</div>
													
													
												</div>
											</div>
											<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
										</div>		
										
								</div>
								
							</div>
							
							<div  class=' container' >
								
								<div id='description_other_deals_container'  class=' container_inside   margin_top' >
									
										<div id='description_section'  class=' float_left' >
											
											
												<div class=' two_third_column'  >
													
													
													<div  class=' rounded_bg' >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle">
													  	
													  	<div  id='threeparts' class=' clearfix' >
													  		<div  class='float_left onepart ' >
													  			<div  class='onepart_header  clearfix' >
													  				Highlights
													  			</div>
														  		<div table='deals'  href='#wysiwyg_div' id='deal_highlights'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal" >
																																<?php     
																																
																																		if( isset( $deals[0]->deal_highlights  ) ){
																																			echo $deals[0]->deal_highlights;
																																		}else{
																																			echo '
																																						<ul>
																																						<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</li>
																																						<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
																																						<li>Lorem ipsum dolor sit amet,</li>
																																						</ul>											
																																						';
																																		};
																																
																																?>
														  		</div>
													  		</div>

													  		<div  class='float_left onepart'  >
													  			<div  class='onepart_header  clearfix' >
													  				Details
													  			</div>
														  		<div  table='deals'    href='#wysiwyg_div' id='deal_finepoints'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal"   >
																																<?php     
																																
																																		if( isset( $deals[0]->deal_finepoints  ) ){
																																			echo $deals[0]->deal_finepoints;
																																		}else{
																																			echo '
																																						<ul>
																																						<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</li>
																																						<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
																																						<li>Lorem ipsum dolor sit amet,</li>
																																						</ul>											
																																						';
																																		};
																																
																																?>
														  		</div>
													  		</div>
													  		
												  		
													  		
													  		
													  		
													  		<div  class='float_left onepart' >
													  			<div  class='onepart_header  clearfix' >
													  				Company
													  			</div>
														  		<div   id='company'  class="clearfix elements_to_hide_when_adding_deal" >
																		<?php     
																		echo ( isset( $deals[0]->company_name) ? $deals[0]->company_name:'' )."<br />";
																		echo ( isset( $deals[0]->address) ? $deals[0]->address:'' )."<br />";
																		echo ( isset( $deals[0]->address2) ? $deals[0]->address2:'' )."<br />";
																		echo ( isset( $deals[0]->city) ? $deals[0]->city:'' ).", ";
																		echo ( isset( $deals[0]->state) ? $deals[0]->state:'' )."&nbsp;&nbsp;";
																		echo ( isset( $deals[0]->zipcode) ? $deals[0]->zipcode:'' )."<br />";
																		echo ( isset( $deals[0]->telephone) ? $deals[0]->telephone:'' )."<br />";
																		echo "<a target='_blank' href='http://" . ( isset( $deals[0]->vendor_website) ? $deals[0]->vendor_website:'' ) .  "'>http://" . ( isset( $deals[0]->vendor_website) ? $deals[0]->vendor_website:'' ) ."</a><br />";
																		?>			
																																
														  		</div>
													  		</div>														  		
													  		

													  	</div>
													  	

																<div id='deal_description_header' class='clearfix header_style' >
																	Product Description
																</div>
													  	
													  	
																<div   table='deals'    href='#wysiwyg_div' id='deal_description_snippet_for_email'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal"   style='display:none;background:yellow'  >
																	
																															<?php     
																															
																																	if( isset( $deals[0]->deal_description_snippet_for_email  ) && $deals[0]->deal_description_snippet_for_email!=''){
																																		echo $deals[0]->deal_description_snippet_for_email;
																																	}else{
																																		echo 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
																																	};
																															
																															?>
									
																	
																</div>
													  	
													  	
																<div   table='deals'    href='#wysiwyg_div' id='deal_description'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal">
																	
																															<?php     
																															
																																	if( isset( $deals[0]->deal_description  ) ){
																																		echo $deals[0]->deal_description;
																																	}else{
																																		echo 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
																																	};
																															
																															?>
									
																	
																</div>
															
															
															
															
														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>
												
												
												
												
													<div  id='doctorcorner_section'   class=' rounded_bg  margin_top' >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle"  >




																<div id='doc_header' class=' header_style' >Expert's Advice Corner
																</div>
<style>
#expert_advice{
	width:620px;

}
</style>
																<div  table='website'     href='#wysiwyg_div' id='expert_advice'  class="wysiwyg_div_link clearfix "   >

																															<?php     
																															
																																	if( isset( $website[0]->expert_advice  ) && $website[0]->expert_advice !=''){
																																		echo $website[0]->expert_advice ;
																																	}else{
																																		echo 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
																																	};
																															
																															?>
																		
																		
																		
																</div>

															





														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>						
												
												
										
												<div id='other_deals'  class=' margin_top'   style='display:none'  >
													
													
															<div  class=' one_third_column float_left margin_left' >
																		<div  class=' rounded_bg' >
																			<div class="top">
																				<div class="sub_top">&nbsp;</div>
																			</div>
																		  <div class="middle">
																				<div class="clearfix">&nbsp;</div>
																			</div>
																			<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
																		</div>				
															</div>
												
												
															<div  class=' one_third_column  float_left margin_left' >
																		<div  class=' rounded_bg' >
																			<div class="top">
																				<div class="sub_top">&nbsp;</div>
																			</div>
																		  <div class="middle">
																				<div class="clearfix">&nbsp;</div>
																			</div>
																			<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
																		</div>				
															</div>						
															
															
												</div>
							
									
									
									
										</div>
										
										<div  class=' one_third_column float_left margin_left'>
											
											<?php
											 // $this->load->view('home/pet_gallery.php');   
											
											?>
											
											
											
											<div   style='margin:0px 0px 10px 0px;display:none'  >
												<img src='<?php  echo base_url()   ?>images/charity.png' />
											</div>
											
											
											<?php
											  $this->load->view('home/facebook_likebox.php');   
											?>
											
											

											
												
												
										</div>		
										
								</div>
							
							</div>
					
				</div>



	</div>



	

<?php     	
$this->load->view('footer/footer_section.php');  
if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1 ){
	$this->load->view('home/control_panel.php');
};
?>

</body>
</html>


<?php  

if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){
	
	$this->load->view('footer/jquery_ui_for_dialog.php');
	$this->load->view('footer/wysiwyg_jquery_with_iframe.php');
	$this->load->view('footer/fancy_zoom.php'); 
	
};


$this->load->view('footer/document_ready_home.php'); 