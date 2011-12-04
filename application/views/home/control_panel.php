


<div id="dialog" title="Image Presenter Control Panel"     > 

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

		<iframe id="iframe_src_for_image" frameborder="0" scrolling=yes src=""  >
			
		    <p>Your browser does not support iframes.</p>
		    
		</iframe>			


</div> 

<div id= 'control_panel'>
	<ul>
		
		<li>
				<div id='open_vendor'  >
				</div>
		</li>
		
		<li>
				<div id='add_deal'  >
				</div>
		</li>
			
		<li>
				<div id='edit_deal'  class='control_panel_div_icon '  >
				</div>
		</li>
		
		<li>
			<div id='open_calendar' class='control_panel_div_icon ' >
			</div>
		</li>
		
		
		<li>
			<div id='choose_deal'   class='control_panel_div_icon '  >
			</div>
		</li>
		
		<li>
			<div  class='arrow_buttons ' id='back_deal'  deal_id='<?php echo $previous_deal_id    ?>' >
			</div>
		</li>
		
		<li>
			<div  class='arrow_buttons '  id='foward_deal'deal_id='<?php  echo $next_deal_id   ?>'>
			</div>
		</li>
				
</ul>
</div>

<div class='control_panel_form_div'>
	<div class='control_panel_close_form_deal'>
		close[x]
	</div>
	
	<div   style='width:1000px'  >
		<div class='float_left control_panel_form_div_inside_left_div'>
			
			<div id='update_form'  class=' other_divs'  >
						<div>
							<div  class=' update_deal_form_div_label' >
								Vendor
							</div>
	
							<select id='vendor_id' name='vendor_id'>
									<?php foreach($vendors as $vendor ){?>
											<option value='<?php echo $vendor->id;    ?>' ><?php  echo $vendor->company_name;  ?></option>
									<?php } ?>
							</select>
						</div>
						<div>
							<div  class=' update_deal_form_div_label' >
								Deal Name
							</div>
							<input  class='update_inputs '  name="deal_name" id="deal_name" type="" value="<?php  echo  ( isset( $deals[0]->deal_name) ? $deals[0]->deal_name:'' );   ?>" store="<?php  echo  $deals[0]->deal_name;   ?>">
						</div>
						<div>
							<div  class=' update_deal_form_div_label' >
								Original Price
							</div>
							<input  class='update_inputs ' name="orig_price" id="orig_price" type="" value="<?php  echo  ( isset( $deals[0]->orig_price) ? $deals[0]->orig_price:'' );   ?>" store="<?php  echo  ( isset( $deals[0]->orig_price) ? $deals[0]->orig_price:'' );   ?>">
						</div>	
						<div>
							<div  class=' update_deal_form_div_label' >
								Deal Price
							</div>
							<input  class='update_inputs ' name="deal_price" id="deal_price" type="" value="<?php  echo  ( isset( $deals[0]->deal_price) ? $deals[0]->deal_price:'' );   ?>" store="<?php  echo  ( isset( $deals[0]->deal_price) ? $deals[0]->deal_price:'' );   ?>">
						</div>		
						<div>
							<div  class=' update_deal_form_div_label' >
								Minimum Quantity
							</div>
							<input  class='update_inputs ' name="minimum_quantity" id="minimum_quantity" type="" value="<?php  echo  ( isset( $deals[0]->minimum_quantity) ? $deals[0]->minimum_quantity:'' );   ?>" store="<?php  echo  ( isset( $deals[0]->minimum_quantity) ? $deals[0]->minimum_quantity:'' );   ?>">
						</div>
						<div>
							<div  class=' update_deal_form_div_label' >
								Maximum Quantity
							</div>
							<input  class='update_inputs ' name="maximum_quantity" id="maximum_quantity" type="" value="<?php  echo  ( isset( $deals[0]->maximum_quantity) ? $deals[0]->maximum_quantity:'' );   ?>" store="<?php  echo  ( isset( $deals[0]->maximum_quantity) ? $deals[0]->maximum_quantity:'' );   ?>">
						</div>
						
						<div>
							<div  class=' update_deal_form_div_label' >
								Deal Expires
							</div>
							<input  class='update_inputs ' name="deal_will_expire" id="deal_will_expire" type="" value="<?php  echo  ( isset( $deals[0]->deal_will_expire) ? $deals[0]->deal_will_expire:'' );   ?>" store="<?php   echo ( isset( $deals[0]->deal_will_expire) ? $deals[0]->deal_will_expire:'' )  ?>">
						</div>					
						<div>
							<div  class=' update_deal_form_div_label' >
								Each Can Buy
							</div>
							<input  class='update_inputs ' name="each_can_buy" id="each_can_buy" type="" value="<?php  echo  ( isset( $deals[0]->each_can_buy) ? $deals[0]->each_can_buy:'' );   ?>" store="<?php  echo  ( isset( $deals[0]->each_can_buy) ? $deals[0]->each_can_buy:'' );   ?>">
						</div>						
						<div>
							<div  class=' update_deal_form_div_label' >
								Label for CC Receipt
							</div>
							<input  class='update_inputs ' name="deal_short_description" id="deal_short_description" type="" value="<?php  echo  $deals[0]->deal_short_description;   ?>" store="<?php  echo  ( isset( $deals[0]->deal_short_description) ? $deals[0]->deal_short_description:'' );   ?>">
						</div>							
						<div>
							<div class=' update_deal_form_div_label'   style='margin-top:0px;'  >
								<input id="vouchers" type="button" value="Vouchers">
							</div>
							<input id="options" type="button" value="Options">
						</div>		
						<div>
							<div  class=' update_deal_form_div_label'  >
								&nbsp;
							</div>
							<input  name="submit_update_form" id="submit_update_form" type="button" value="submit">
							<input  name="method" id="method" type="hidden" value="">
						</div>	
			</div>
	
						
			<div id='choose_deal_div'  class=' other_divs'>
				
				
				<?php  foreach( $all_the_deals as $one_deal ){ ?>
				
						<div  class='all_the_deals <?php  
							
						if(  $one_deal->id == $deal_id ){		
							
							$one_deal->id = -1;
	
							echo " selected_deal ";
							
						};
							
							
					  ?>' deal_id='<?php  echo $one_deal->id;   ?>'>
							
								<?php  echo $one_deal->deal_name;   ?>						
							
						</div>
			
				<?php } ?>
				
						
			</div>
			
			
			<div id='calendar'  class=' other_divs' >
				
				<iframe id="iframe_src_for_calendar" frameborder="0" scrolling=no src="<?php  echo base_url()   ?>index.php/home/calendar/<?php echo $deal_id    ?>?priority=<?php echo $priority    ?>"  
					
				    <p>Your browser does not support iframes.</p>
				    
				</iframe>	
				
			</div>
							
			<div id='vendor'  class=' other_divs' >
				
				<iframe id="iframe_src_for_vendor" frameborder="0" scrolling=no src="<?php  echo base_url()   ?>index.php/home/vendor/"  
					
				    <p>Your browser does not support iframes.</p>
				    
				</iframe>	
				
			</div>
		</div>
		
		<div  class=' float_left control_panel_form_div_inside_right_div'  >
			<div  id='options_panel'  class='  vouchers_or_options_panel ' >
				
				<div  id='options1'>
						<div><big>Add or edit 1st options to deal</big>
						</div>
						<div>
								<input  class='name ' id='option1_name' type="text" value="">&nbsp;&nbsp;<input  class='add_update_options_button '  id="add_option1" type="button" value="Add or Update">
								<input  class='primary_key '     id="option1_id" type="hidden" value="0">
						</div>
						
						<div  id='list_of_options1'   class='list_of ' >
							
							
						</div>					
				</div>

				<div  id='options2'>
						<div><big>Add or edit 2nd options to deal</big>
						</div>
						<div>
								<input   class='name ' id='option2_name' type="text" value="">&nbsp;&nbsp;<input class='add_update_options_button ' id="add_option2" type="button" value="Add or Update">
								<input   class='primary_key '  id="option2_id" type="hidden" value="0">
						</div>
						
						<div  id='list_of_options2'   class='list_of ' >
							
							
						</div>					
				</div>				
				
								
			</div>
			<div  id='vouchers_panel'  class='vouchers_or_options_panel ' >
				<div><big>Add or edit vouchers to deal</big>
				</div>
				<div>
						<input id='code' name="code" type="text" value="">&nbsp;&nbsp;<input id="add_voucher" type="button" value="Add or Update">
						<input name="voucher_id" id="voucher_id" type="hidden" value="0">
				</div>
				
				<div  id='list_of_vouchers'   class='list_of ' >
					
					
				</div>				
			</div>
		</div>
	</div>
	

	
	
	
</div>

