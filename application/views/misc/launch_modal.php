<a href="#launch_content" class="open_launch_window"></a>
	
				<script type="text/javascript">
					
					$.fn.setCursorPosition = function(pos) {
					  this.each(function(index, elem) {
					    if (elem.setSelectionRange) {
					      elem.setSelectionRange(pos, pos);
					    } else if (elem.createTextRange) {
					      var range = elem.createTextRange();
					      range.collapse(true);
					      range.moveEnd('character', pos);
					      range.moveStart('character', pos);
					      range.select();
					    }
					  });
					  return this;
					};
					
					$(document).ready(function() { 
				

						$('.input_style').click(function(event) {
								$(this).css({color:'lightgray'}).setCursorPosition(0)
								.bind('keypress', function(e) {
										$(this).val('').css({color:'black','font-style':'normal'});
										$(this).unbind('keypress');																						
								})
						}).focus(function(event) {
								$(this).css({color:'lightgray'}).setCursorPosition(0)
								.bind('keypress', function(e) {
										$(this).val('').css({color:'black','font-style':'normal'});
										$(this).unbind('keypress');																						
								})
						});
						
						$('#password').click(function(event) {
								 $("<input type='password' />").addClass('input_style').attr({ value: '' }).css({color:'black','font-style':'normal'}).insertBefore(this).focus();
								 $(this).remove()
						}).focus(function(event) {
								 $("<input type='password' />").addClass('input_style').attr({ value: '' }).css({color:'black','font-style':'normal'}).insertBefore(this).focus();
								 $(this).remove()
						})	
						
						if( $.cookie("joined") == 1){
							
										$.cookie("joined", null);
							
						}else{
							
							
										$('.open_launch_window').openDOMWindow({
											eventType:'click',
											loader:1,
											loaderImagePath:'<?php  echo base_url()   ?>images/animationProcessing.gif',
											loaderHeight:16,
											loaderWidth:17,
											overlayOpacity:'55',
											height:<?php echo $launch_pop_height    ?>, 
											positionType:'absolute', 
											positionTop:200, 
											positionLeft:($(window).width() / 2) - 230
										});			
										
										// setTimeout("$('a.open_launch_window').click()",1000)				
										
						        window.setTimeout(function()
						        {
															$('body').scrollTo( $('#very_top'), 800, {
																				onAfter: function() { 
																				$('a.open_launch_window').click();
															}} );
						        },3000);
										
						};

						
						
						
						$('#join').click(function(event) {
							$.closeDOMWindow();
							$.cookie("joined", '1');
						
						});	
						
								
					});

				</script>
			
				<style>
					body{
					font-family:"Helvetica Neue", Arial, Helvetica, sans-serif;	
					font-size:17px;
					}
					.input_style{
						  border: 1px solid darkgray;
						  height: 25px;
							padding-left: 5px;
							color:gray;
							font-style:italic;	
					}				
							
					.bubble{
							background-image: url(<?php  echo base_url()   ?>images/bubble.png);
							background-repeat: no-repeat;	
					}

								#launch_pop.left-half{
										overflow:hidden							
								}

											#launch_pop.left-half .bubble{
													width:433px;											
											}
								
											#launch_pop.left-half .left-top-half{
													height:32px;
													background-position:0px 0px;
											}
											#launch_pop.left-half .left-middle-half{
													background-image: url(<?php  echo base_url()   ?>images/bubble_inside.png?random=1431);
													background-position: <?php echo ( $this->tools->browserIsExplorer() ? '0':'0' )    ?>px 0px;
													background-repeat: repeat;	
													height:<?php echo  $launch_pop_height - 68;    ?>px;
											}
												#launch_pop.left-half .left-middle-half .bubble_content{		
													padding:0 25px 25px 25px;
												}	
															#launch_pop.left-half .left-middle-half .bubble_content div#logo_div{		
																	text-align:center;
																	background-image: url(<?php echo base_url()    ?>images/sites/zekeszoo/logo.png);
																	background-repeat: no-repeat;	
																	background-position:center 0px;	
																	height:80px;
																	background-size:50%;
															}														
											
											#launch_pop.left-half .left-bottom-half{
											    background-position: 0 -306px;
											    height: 30px;
											}													
				
				</style>
				<div id="launch_content" style="display:none;">

						<div  id='launch_pop' class='left-half halves  '  >

								<div	class='left-top-half bubble'    >
										&nbsp;
								</div>
								<div  class='left-middle-half bubble' >
									<div  class='bubble_content ' >
										<div id='logo_div'>
										</div>
										<hr />
										<div   style='margin:10px 0px;font-weight:bold;color:gray'  >
											<div  style='text-align:center' >
												Join for Great Pet Savings. 
											</div>
											<div  style='text-align:center' >
												Its Really Free.
											</div>											
										</div>

										<div>
											<style>
											#launch_content_table input{
											 margin:5px 75px 5px;
											 width:220px;	
											}
											</style>
											<table  id='launch_content_table'>
												<tr>
													<td>
														<input  class='input_style ' name="first_name	" id="first_name	" type="" value="First Name">
													</td>
												</tr>
												<tr>
													<td>
														<input  class='input_style ' name="last_name	" id="last_name	" type="" value="Last Name">
													</td>
												</tr>
												<tr>
													<td>
														<input  class='input_style ' name="email" id="email" type="" value="Email">
													</td>
												</tr>
												<tr>
													<td>
														<input  class='input_style ' name="confirm_email" id="confirm_email" type="" value="Confirm Email">
													</td>
												</tr>		
													<td>
														<input  class='input_style ' name="password" id="password" type="" value="Password">
													</td>
												</tr>
												</tr>		
													<td >
														<div   style='float:left;width:95px;'  >
															<input name="agree" id="agree" type="checkbox" value=""   style='width:10px'  >
														</div>
														<div  style='padding-top:6px;float:left;width:200px;font-size:10px'  >I agree to the Terms and Conditions
														</div>
														
													</td>
												</tr>																																					
											</table>
											<style>
											#join{
												cursor:pointer;
												color:white;
												font-weight:bold;
												font-size:22px;
												margin:13px auto;
												text-align:center;
												padding-top:10px;
												height:40px;
												background-image: url(<?php  echo base_url()   ?>images/buynow2.png?random=1431);
												background-position: center 0px;
												background-repeat: no-repeat;
												background-size:contain;													
											}
											</style>
											<div  style='clear:both' >
												<div  id='join'   >Join
												</div>
											</div>
											<div  style='text-align:center;font-weight:bold;color:gray' >
												Questions?  Learn more about us.
											</div>																				
										</div>
									</div>
								</div>
								<div class='left-bottom-half bubble' >
										&nbsp;
								</div>							
							
						</div>


				</div>