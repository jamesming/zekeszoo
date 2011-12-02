<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/mypetgallery_view_css.php');  ?>
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
																	My Pet Gallery
																</div>
													  	
													  	
																<div    id='box_inside'  class="clearfix ">



																		<div  id='my_pet_gallery_container'>
																		
																		<?php foreach($pictures  as $picture_row){  ?>
																		
																				<div  class='pic_row clearfix' >
																		
																				<?php
																				foreach($picture_row  as $picture){  ?>
																					
																					
																								<?php if($picture['type'] == 'contains_image'){?>
																								
																								
																											<div  class='pic_box float_left contains_image_container' >
																													<div  my_pet_gallery_id='<?php echo $picture['my_pet_gallery_id']     ?>' 
																																class=' contains_image'    
																																style='background:url(<?php echo base_url()    ?>uploads/gallery/<?php echo $this->session->userdata['user_id']    ?>/<?php echo $picture['my_pet_gallery_id']    ?>/image_tiny.png)'  >
																														
																													</div>										
																											</div>
																		
																		
																								<?php }elseif (  $picture['type'] == 'first_available'  ) {?>
																								
																											<div class='pic_box float_left first_available'  title='Add New Picture'>
																													Click to add
																											</div>	
																											
																								<?php }else{?>
																								
																											<div  class='pic_box float_left no_image' >
																												
																											</div>
																								
																								<?php } ?>		
																		
																		
																				<?php 
																				}?>
																				
																				</div>		
																		
																		<?php } ?>
																		</div>





																</div>
															
															
														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>
												
												
												
			
									
									
										</div>
										
										
										
										
										
										
										
										
										<div id='right_col_section'  class='float_left' >
											
											
												<div class=' one_third_column'  >
													
													
												<?php  $this->load->view('home/pet_gallery.php');   ?>
													
												
												
			
									
									
										</div>
										
										
										
									
										
								</div>
							
							</div>


					
				</div>



	</div>



<?php     	$this->load->view('footer/footer_section.php');  ?>

<div id="dialog" title="Upload Picture"     > 

		<table id='submit_jcrop_table' width='100%'    >
			<tr>
				<td width='55%' align=right>Crop image then&nbsp;&nbsp;</td>
				<td>
					<div id='submit' class='rounded_border cursor_pointer'    >
						submit
					</div>	
				</td>
			</tr>
		</table>

		<iframe id="iframe_src_for_image" frameborder="0" scrolling=no src=""  >
			
		    <p>Your browser does not support iframes.</p>
		    
		</iframe>			


</div>

<div id="bubble_div">
				

		<iframe id="iframe_src_for_speech_bubble" 
			frameborder="0" scrolling=no src=""   >
			
		    <p>Your browser does not support iframes.</p>
		    
		</iframe>				

</div>	



</body>
</html>




<?php  

	$this->load->view('footer/document_ready_my_pet_gallery.php');
	$this->load->view('footer/jquery_ui_for_dialog.php');
	$this->load->view('footer/fancy_zoom.php');
