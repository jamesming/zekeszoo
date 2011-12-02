															
																	<?php if( is_array($options1) && count($options1) != 0 ){?>
																	
																			<div class="options_list clearfix ">
																					<div  class='float_left ' >Please choose from the following options:
																					</div>&nbsp;
																					<select class='float_left ' name='option1_id'>
																						
																						<?php foreach( $options1  as  $option){ ?>
																						
																								<option value=<?php  echo  $option['id']  ?>><?php echo $option['name']    ?></option>
																					
																					
																						<?php } ?>
		
																					</select>
																				
																			</div>
																
																	<?php }else{ ?>
																	
																			<input name="option1_id" type="hidden" value="0">
																	
																	<?php } ?>
																	
																	
																	
																	
																	<?php if(  is_array($options2) && count($options2) != 0 ){?>
																	
																			<div class="options_list clearfix ">
																					<div  class='float_left ' >Please choose from the following options:
																					</div>&nbsp;
																					<select class='float_left ' name='option2_id'>
																						
																						<?php foreach( $options2  as  $option){ ?>
																						
																								<option value=<?php  echo  $option['id']  ?>><?php echo $option['name']    ?></option>
																					
																					
																						<?php } ?>
		
																					</select>
																				
																			</div>
																
																	<?php }else{ ?>
																	
																			<input name="option2_id" type="hidden" value="0">
																	
																	<?php } ?>