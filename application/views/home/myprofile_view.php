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
																	My Profile
																</div>
													  	
													  	
																<div    id='box_inside' class="clearfix "    >


<style>
.halfies{
width: auto;
margin-right:8px;	
}
.outer_input_label{
    height: 60px;
    font-size: 11px;
    font-weight: bold;

}	
.input_label{
padding:0px 0px 0px 2px;
}
div.outer_input_label input{
												    border: 1px solid darkgray;
												    height: 25px;
										    		padding-left: 5px;
										    		
												}			
.error_message, .error_message_select {
    color: darkRed;
    font-size: 9px;
    height: 9px;
}
.error_message_select {
    position: relative;
}

#update_container {
    height: 122px;
}

			#update_container div#update_image {
			    background-image: url("<?php  echo base_url()   ?>images/buynow2.png");
			    background-position: center center;
			    background-repeat: no-repeat;
			    color: white;
			    cursor: pointer;
			    font-size: 21px;
			    font-weight: bold;
			    height: 69px;
			    padding-top: 35px;
			    text-align: center;
			    width: 180px;
			    margin-left: 61px;
			}

</style>

<form  id='form0' name='form0'
action='<?php echo base_url()    ?>index.php/home/update_profile'	
method='post'
>


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
																					<input name="zipcode" id="zipcode" type="text" value=""  class='small_input '>
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
																					<input name="password" id="password" type="password" value=""  class='small_input '>
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
																		
																		
																		
																<div  id='update_container' class='clearfix ' >
																	<div id='update_image'>Update
																	</div>
																</div>
																
																
																

<input id="ok2submit" type="hidden" value="1">

</form>
																


																</div>
														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>
												
												
												
			
									
									
										</div>
										
										
										
										
										
										
										
										
										<div id='right_col_section'  class='float_left' >
											
											
												<div class=' one_third_column'  >
													
													

													<?php     	$this->load->view('home/facebook_likebox.php');  ?>												
												
												
																									<iframe></iframe>
																									<iframe></iframe>
																									<iframe></iframe>
									
									
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
				$('#ok2submit').val(1);
				
				$('#update_image').click(function(event) {
					
						$('#box_inside input').each(function(){
		
								if( $(this).val() == '' ){

									$(this).css({background:'pink'}).parent().parent().children('div.error_message').html("Can't be blank.");

									$('#ok2submit').val(0);

								};
								
						});
						
						if( $('#password').val() != $('#confirm').val() ){
							
								$('#ok2submit').val(0);
								$('#confirm').css({background:'pink'}).parent().parent().children('div.error_message').html("Confirmation password does not match");
							
						};
						
									
						if( $('#ok2submit').val() == 1){
							
							$('#form0').submit();
							
						};

				});	
				
				$('#box_inside input').click(function(event) {
					
					$(this).css({background:'white'}).parent().parent().children('div.error_message').html("");
					$('#ok2submit').val(1);
					
				});	
				
		<?php
		
			if( isset($users)){
					 foreach($users as  $key => $value ){
					 	
					 	if( $key != 'password' ){?>
					 		
					 	$('#<?php echo  $key   ?>').val('<?php echo $value    ?>');
					 	
					 	<?php	
					 	};
					 	
					 	
						
							
						
					}  
			};
			
		?>
});		


</script>

<?php  

if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){
	
	$this->load->view('footer/jquery_ui_for_dialog.php');
	$this->load->view('footer/wysiwyg_jquery_with_iframe.php');
	$this->load->view('footer/fancy_zoom.php'); 
	
};
