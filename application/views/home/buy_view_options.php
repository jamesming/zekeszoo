															
																	<?php if( is_array($options1) && count($options1) != 0 ){?>
																	
																			<div class="options_list clearfix "   style='white-space:nowrap;'   >
																				
																				 <table>	
																				 	<tr>
																				 		<td   style='text-align:left'  >
																								Please choose from the following options:
																				 		</td>
																				 		<td    style='text-align:right'>
																							<select name='option1_id'>
																								<option value=0  >-------------- Select -------------</option>
																								<?php foreach( $options1  as  $option){ ?>
																								
																										<option value=<?php  echo  $option['id']  ?>><?php echo $option['name']    ?></option>
																							
																							
																								<?php } ?>
				
																							</select>																				 			
																				 			
																				 		</td>
																				 	</tr>
																				</table>
																				
																					

																				
																			</div>
																
																	<?php }else{ ?>
																	
																			<input name="option1_id" type="hidden" value="0">
																	
																	<?php } ?>
																	
																	
																	
																	
																	<?php if(  is_array($options2) && count($options2) != 0 ){?>
																	
																			<div class="options_list clearfix "   style='white-space:nowrap;'   >
																				
																				 <table>	
																				 	<tr>
																				 		<td   style='text-align:left'  >
																								Please choose from the following options:
																				 		</td>
																				 		<td    style='text-align:right'>
																							<select name='option2_id'>
																								<option value=0  >-------------- Select -------------</option>
																								<?php foreach( $options2  as  $option){ ?>
																								
																										<option value=<?php  echo  $option['id']  ?>><?php echo $option['name']    ?></option>
																							
																							
																								<?php } ?>
				
																							</select>																				 			
																				 			
																				 		</td>
																				 	</tr>
																				</table>
																				
																					

																				
																			</div>
																
																	<?php }else{ ?>
																	
																			<input name="option2_id" type="hidden" value="0">
																	
																	<?php } ?>