				<script type="text/javascript">
					$(document).ready(function() { 
						$('.open_multi_options_bubble').openDOMWindow({
							eventType:'click',
							loader:1,
							loaderImagePath:'<?php  echo base_url()   ?>images/animationProcessing.gif',
							loaderHeight:16,
							loaderWidth:17,
							overlayOpacity:'30',
							width:490,
							height:<?php echo $multi_deal_bubble_height    ?>, 
							positionType:'absolute', 
							positionTop:<?php 
							
							echo ( $this->tools->browserIschrome() ? '354':'360' )
							
							?>, 
							positionLeft:($(window).width() / 2) - 380
						});
						
			
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
										padding-left:20px;
										padding-right:15px;
									}	
									
									
											.multi-options-bubble-inside.left-half .left-middle-half .bubble_content table{
												border-top:0px solid gray;
												border-left:0px solid gray;
												margin:0px 0px 0px 0px;
												font-size:15px;
											}												
									
														.multi-options-bubble-inside.left-half .left-middle-half .bubble_content table td{
															padding:9px 3px 0px 5px;
															margin:0px 0px 0px 0px;
															height:45px;		
															border-right:0px solid gray;
															border-bottom:0px solid gray;
															text-align:left;
														}			
														
																	.multi-options-bubble-inside.left-half .left-middle-half .bubble_content table td.first_col {
																			width:60px;
																	}		
																	.multi-options-bubble-inside.left-half .left-middle-half .bubble_content table td.second_col {
																			width:110px;
																	}	
																	
																	.multi-options-bubble-inside.left-half .left-middle-half .bubble_content table td.third_col {
																			width:40px;
																			text-align:center;
																	}																					
																																
																			.multi-options-bubble-inside.left-half .left-middle-half .bubble_content table td.first_col a{
																					font-weight:bold;
																					color:#175C8D;
																					font-size:15px;
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
							margin-left: <?php  echo ( $this->tools->browserIschrome() ? '-4':'-5' )   ?>px;
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
										<div   style='font-size:19px;text-align:left'  >
											<b>Choose your deal:</b>
										</div>
										<table>
											
											<?php foreach( $multi_deals  as  $deal){?>
												<tr>
													<td  class='first_col ' >
														<a href='<?php echo base_url()    ?>index.php/home/buy/<?php  echo $deal->id   ?>?priority=<?php echo $deal->priority    ?>'><?php echo  $deal->deal_name   ?></a>
													</td>
													<td  class='second_col ' >
														<a href='<?php echo base_url()    ?>index.php/home/buy/<?php  echo $deal->id   ?>?priority=<?php echo $deal->priority    ?>'><?php echo  $deal->multi_option_description   ?></a>
													</td>
													<td  class='third_col ' >
														buy
													</td>
												</tr>
											<?php } ?>
											<tr>

										</table>
									</div>
								</div>
								<div class='left-bottom-half bubble' >
										&nbsp;
								</div>							
							
						</div>

						<script>
							$(document).ready(function() { 
								$(".multi-options-bubble-inside.left-half .left-middle-half .bubble_content table tr:even")
								.css("background-color", "#F5F5F3");
							});

						</script>
						
						<div  class='multi-options-bubble-inside right-half halves bubble' >
							&nbsp;
						</div >

				</div>