<script type="text/javascript" language="Javascript">

					$(document).ready(function() {
						
						 
						$('.open_launch_window').openDOMWindow({
							eventType:'click',
							loader:1,
							loaderImagePath:'<?php  echo base_url()   ?>images/animationProcessing.gif',
							loaderHeight:16,
							loaderWidth:17,
							overlayOpacity:'35',
							height:<?php echo $launch_pop_height    ?>, 
							positionType:'absolute', 
							positionTop:200, 
							positionLeft:($(window).width() / 2) - 230
						});

						setTimeout(function() {
								$('body').scrollTo( $('#very_top'), 1000, {
									onAfter: function() { 
										$('a.open_launch_window').click();
									}} );
						}, 3000);
					});

				</script>
				
				
				<a href="#launch_content" class="open_launch_window"   style='display:none'  ></a>

			
				<style>
					.bubble{
							background-image: url(<?php  echo base_url()   ?>images/bubble.png);
							background-repeat: no-repeat;	
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
										padding:25px;
									}	
													
								
								#launch_pop.left-half .left-bottom-half{
								    background-position: 0 -305px;
								    height: 32px
								}													
				
				</style>
				<div id="launch_content" style="display:none">

						<div  id='launch_pop' class='left-half halves  ' >

								<div	class='left-top-half bubble'    >
										&nbsp;
								</div>
								<div  class='left-middle-half bubble' >
									<div  class='bubble_content ' >
										<div   style='text-align:center'  >ZekesZoo
										</div>
										<hr />
										<div  style='text-align:center' >
											Great Savings for your Pet.  Be nice to them
										</div>
										<div  style='text-align:center' >
											Join now. Its Free.<br /><br /><br />
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
														<input name="" id="" type="" value="">
													</td>
												</tr>
												<tr>
													<td>
														<input name="" id="" type="" value="">
													</td>
												</tr>
												<tr>
													<td>
														<input name="" id="" type="" value="">
													</td>
												</tr>
												<tr>
													<td>
														<input name="" id="" type="" value="">
													</td>
												</tr>		
													<td>
														<input name="" id="" type="" value="">
													</td>
												</tr>																							
											</table>
											<div  style='text-align:center' >
												<input name="" id="" type="submit" value="Join"><br /><br /><br />
											</div>
											<div  style='text-align:center' >
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