				<script type="text/javascript">
					$(document).ready(function() { 
						$('.open_multi_options_bubble').openDOMWindow({
							eventType:'click',
							loader:1,
							loaderImagePath:'<?php  echo base_url()   ?>images/animationProcessing.gif',
							loaderHeight:16,
							loaderWidth:17,
							overlayOpacity:'55',
							width:477,
							height:<?php echo $multi_deal_bubble_height    ?>, 
							positionType:'absolute', 
							positionTop:330, 
							positionLeft:($(window).width() / 2) - 380
						});
						
						//setTimeout("$('a.open_multi_options_bubble').click()",500)
						
								
					});

				</script>	
	
	
				<a href="#multi-options-bubble" class="open_multi_options_bubble"   style='display:none'  >click</a>
	
			
				<style>
					.multi-options-bubble-inside.halves{
						margin:0px 0px 0px 0px;
						float:left;
						width:230px;
						background:transparent;
						overflow:hidden;
					}
					.multi-options-bubble-inside.left-half{
						width:433px;	
					}
					
					.bubble{
							background-image: url(<?php  echo base_url()   ?>images/bubble.png);
							background-repeat: no-repeat;	
					}

								.multi-options-bubble-inside.left-half .bubble{
										width:433px;											
								}
					
								.multi-options-bubble-inside.left-half .left-top-half{
										height:32px;
										background-position:0px 0px;
								}
								.multi-options-bubble-inside.left-half .left-middle-half{
										background-image: url(<?php  echo base_url()   ?>images/bubble_inside.png?random=1431);
										background-position: <?php echo ( $this->tools->browserIsExplorer() ? '0':'0' )    ?>px 0px;
										background-repeat: repeat;	
										height:<?php echo  $multi_deal_bubble_height - 68;    ?>px;
								}
									.multi-options-bubble-inside.left-half .left-middle-half .bubble_content{		
										padding:25px;
									}	
									
									
											.multi-options-bubble-inside.left-half .left-middle-half .bubble_content table{
												border-top:1px solid gray;
												border-left:1px solid gray;
											}												
									
														.multi-options-bubble-inside.left-half .left-middle-half .bubble_content table td{
															padding:0px 0px 0px 0px;
															margin:0px 0px 0px 0px;
															width:180px;
															height:85px;		
															border-right:1px solid gray;
															border-bottom:1px solid gray;
														}															
								
								.multi-options-bubble-inside.left-half .left-bottom-half{
								    background-position: 0 -305px;
								    height: 32px
								}													
					.multi-options-bubble-inside.right-half{
							background-image: url(<?php  echo base_url()   ?>images/bubble_right_triangle.png);
							background-repeat: no-repeat;
							background-position:left center;							
							width: 47px;
							margin-left: -4px;
					    height: <?php echo $multi_deal_bubble_height - 6   ?>px;
					}					
				</style>
				<div id="multi-options-bubble" style="display:none">
					
					
						<div  class='multi-options-bubble-inside left-half halves  ' >

								<div	class='left-top-half bubble'    >
										&nbsp;
								</div>
								<div  class='left-middle-half bubble' >
									<div  class='bubble_content ' >
										<table>
											<tr>
												<td>GOLD
												</td>
												<td>$200 for 2 Year of Dog Food
												</td>
											</tr>
												<td>SILVER
												</td>
												<td>$100 for 1 Year of Dog Food
												</td>
											</tr>											
											
										</table>
										<input onclick=$.closeDOMWindow() type="button" value="close">		
									</div>
								</div>
								<div class='left-bottom-half bubble' >
										&nbsp;
								</div>							
							
						</div>

				
						<div  class='multi-options-bubble-inside right-half halves bubble' >
							&nbsp;
						</div >

				</div>