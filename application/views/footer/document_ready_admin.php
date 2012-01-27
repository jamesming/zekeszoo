
<?php if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){  ?>
	
$(document).ready(function() {


						$('#deal_description_snippet_for_email, #deal_share_headline').show();


						
						$('#submit').click(function(event) {
							
							$('iframe').each(function(index) { 
								try { this.contentWindow.submitCropForm(); } 
								catch (e) { } 
							});
						
						});	
						
						
					
						$('#deal_image').css({cursor:'pointer'}).click(function(event) {
							open_dialogue_upload_image();
						});	
						
						
						/**  Control Panel Fancy Zoom **/
						
				  	$('#control_panel ul li div.control_panel_tools').fancyZoom().click(function(event) {
				  		
							$("#iframe_content_text").attr('src','<?php echo base_url();    ?>index.php/home/doit');
							
						});		


						/** Control Panel  **/

				  	$('.control_panel_form_div div.control_panel_close_form_deal').click(function(event) {
				  		
							close_control_panel_div_box();
							
						});	
						
						/** Vendor  **/						
						
						
				  	$('#open_vendor').click(function(event) {
				  		

							open_large_control_panel();						  		

				  		$(".other_divs").hide();
				  		$("#vendor").show();
							launch_control_panel_div_box();	
	  		

						});	
						
						/** Calendar  **/						
						
						
				  	$('#open_calendar').click(function(event) {
				  		

							open_large_control_panel();				  		

				  		$(".other_divs").hide();
				  		$("#calendar").show();
							launch_control_panel_div_box();	
	  		

						});							
						
						
						
						

						/** Choose Deal Form  **/
						
				  	$('#choose_deal').click(function(event) {	
				  		$(".other_divs").hide();				  		
							open_small_control_panel();		
										  		

				  		$("#choose_deal_div").show();
							launch_control_panel_div_box();	
				  		
						});	
						
						
				  	$('.all_the_deals, .arrow_buttons').click(function(event) {	
				  		
				  			if( parseInt($(this).attr('deal_id')) > 0){
										document.location.href='<?php echo  base_url();   ?>index.php/home/index/' + $(this).attr('deal_id') + '?priority=<?php echo $priority    ?>';
				  			};
				  		
						});					
						
						
						
						$('#vendor_id').val('<?php echo ( isset( $deals[0]->vendor_id) ? $deals[0]->vendor_id:'' );    ?>');		
						
						
						/** Update Deal Form  **/
						
						
				  	$('#edit_deal').click(function(event) {
				  		$(".other_divs").hide();				  		
							open_small_control_panel();			  		
			

				  		$("#update_form").show();

				  		
							$(".control_panel_form_div").css({display:'block'});
							
							$("#control_panel").css({'border-right':'0px'});							
							
							
							$(".update_inputs").each(function(){
				        $(this).val( $(this).attr('store')  );
				        
				      });
				      
				      $(".elements_to_hide_when_adding_deal").css({visibility:'visible'});
				      
				      $('#method').val('update_deal');
				      
				      $('#submit_update_form').val('Update Deal');
			
								
											
						});		
						
						
						//$('#edit_deal').click();
						
						
				  	$('#add_voucher').click(function(event) {
				  	
							  	if( $('#code').val() !='' ){
							  			
							  			$.post("<?php echo base_url() ?>index.php/home/add_update_vouchers",{
							  				code: $('#code').val(),
							  				deal_id:<?php  echo $deal_id   ?>,
												voucher_id: $('#voucher_id').val()
												},function(data) {
													
													$('#voucher_id').val('0');
													$('#code').val('');
											    $('#list_of_vouchers').html(data);
													
												});	
							  	
							  	
							  	}else{
							  				alert('Must not be empty!');
							  	};

						});
						
						$('.vouchers_group div.name_div').live('click', function() {
								$('#voucher_id').val($(this).parent().attr('voucher_id'));
								$('#code').val(  $(this).text()  );
						});
						
						$('.vouchers_group div.delete').live('click', function() {
						
							  			$.post("<?php echo base_url() ?>index.php/home/delete_voucher",{
												voucher_id: $(this).parent().attr('voucher_id'),
							  				deal_id:<?php  echo $deal_id   ?>
												},function(data) {
													
													$('#voucher_id').val('0');
													$('#code').val('');
											    $('#list_of_vouchers').html(data);
													
												});	
						
						});			
						
						
						
				  	$('#choose_priority').click(function(event) {
				  		
							open_small_control_panel();
				  		$(".other_divs").hide();	
				  		$("#choose_priority_div").show();
				  		
							launch_control_panel_div_box();	
				  								
						});							
						
						
						
				
						/** Add Deal Form  **/

						
				  	$('#add_deal').click(function(event) {
				  	
				  		$(".other_divs").hide();	
				  						  		
							open_small_control_panel();	
				  		
				  		$("#update_form").show();

							launch_control_panel_div_box();					

							$(".update_inputs").each(function(){
				        $(this).val('');
				        
				      });
				      
				      $(".elements_to_hide_when_adding_deal").css({visibility:'hidden'});
				      
				      $('#method').val('add_deal');
				      
				      $('#submit_update_form').val('Add Deal');

						});					
						
						
						$('#orig_price').change(function(event) {
				  			$('#orig_price_on_website').css({visibility:'visible'}).text( $(this).val()  );
				  			calculate_savings()
				  			
						});		
						
				  	$('#deal_price').change(function(event) {
				  			$('#deal_price_on_website').css({visibility:'visible'}).text( $(this).val()  );
				  			calculate_savings()
						});	
						
						
				  	$('#submit_update_form').click(function(event) {

								$.post("<?php echo base_url(). 'index.php/home/'; ?>" +  $('#method').val()  +  "<?php echo '/'. $deal_id; ?>",{
									vendor_id: $('#vendor_id').val(),
									deal_name: $('#deal_name').val(),
									orig_price: $('#orig_price').val(),
									deal_price:  $('#deal_price').val(),
									maximum_quantity:$('#maximum_quantity').val(),
									minimum_quantity:$('#minimum_quantity').val(),
									deal_short_description:$('#deal_short_description').val(),
									each_can_buy:$('#each_can_buy').val(),
									deal_will_expire:$('#deal_will_expire').val(),
									priority:<?php  echo $priority   ?>
									},function(data) {

								    if( $('#method').val() == 'add_deal'){
								    	
								    		document.location.href='<?php echo  base_url();   ?>index.php/home/index/' + data;

								     	
								    }else{
								    	
												close_control_panel_div_box();
												
												$(".update_inputs").each(function(){
									        $(this).attr('store',  $(this).val() ) 
					      				});
								    };
								    
								    
										
									});	
						});		
						
						
						
						
						
						//$('#open_vendor').click();
		
												
						$('#options').click(function(event) {
									open_close_small_control_panel_wider('options_panel');
						});
						
						$('#vouchers').click(function(event) {
									open_close_small_control_panel_wider('vouchers_panel');
						});	
						
						
				  	$('.add_update_options_button').click(function(event) {
				  	
				  	var table = $(this).parent().parent().attr('id');
				  	
							  	if( $('#'+table+ ' input.name').val() !='' ){
							  	

							  			$.post("<?php echo base_url() ?>index.php/home/add_update_options",{
							  				option1_name: $('#'+table+ ' input.name').val(),
							  				deal_id:<?php  echo $deal_id   ?>,
												primary_key: $('#'+table+ ' input.primary_key').val(),
							  				table:table
												},function(data) {
													
													$('#'+table+ ' input.primary_key').val('0');
													$('#'+table+ ' input.name').val('');
											    $('#'+table+ ' div.list_of').html(data);
													
												});	
							  	
							  	
							  	}else{
							  				alert('Must not be empty!');
							  	};

						});
						
						$('.options_group div.name_div').live('click', function() {
						
								var table = $(this).parent().parent().parent().parent().attr('id');
						
								$('#'+table+ ' input.name').val( $(this).text());
								$('#'+table+ ' input.primary_key').val(   $(this).parent().attr('primary_key') );
						});
						
						$('.options_group div.delete').live('click', function() {
						
						var table = $(this).parent().parent().parent().parent().attr('id');
						
							  			$.post("<?php echo base_url() ?>index.php/home/delete_option",{
												primary_key: $(this).parent().attr('primary_key'),
							  				deal_id:<?php  echo $deal_id   ?>,
							  				table:table
												},function(data) {
													
													$('#'+table+ ' input.primary_key').val('0');
													$('#'+table+ ' input.name').val('');
											    $('#'+table+ ' div.list_of').html(data);
													
												});	
						
						});						
						
						

});
	
	

small_control_panel_is_opened = false;
function open_close_small_control_panel_wider( which_panel ){



			if( small_control_panel_is_opened){
			
							small_control_panel_is_opened = false;
							
							$('.control_panel_form_div').css({width:'373px'});
							
							$('.control_panel_form_div_inside_right_div').hide();				
			}else{
							small_control_panel_is_opened = true;
				
							$('.control_panel_form_div').css({width:'725px'});
							
							$('.control_panel_form_div_inside_right_div').show();				
			};
			$('.vouchers_or_options_panel').hide()
			$('#'+which_panel).show()
			


			if( which_panel == 'options_panel' && small_control_panel_is_opened){
			
			  			$.post("<?php echo base_url() ?>index.php/home/echo_options_list",{
			  			deal_id:<?php  echo $deal_id   ?>,
							table:'options1'
							},
			  			function(data) {

							    $('#list_of_options1').html(data);
									$('#option1_name').val('');
									
								});				
								
			  			$.post("<?php echo base_url() ?>index.php/home/echo_options_list",{
			  			deal_id:<?php  echo $deal_id   ?>,
							table:'options2'
							},
			  			function(data) {

							    $('#list_of_options2').html(data);
									$('#option2_name').val('');
									
								});		
								
			
			
			}else if( which_panel == 'vouchers_panel' && small_control_panel_is_opened){
			
			
			  			$.post("<?php echo base_url() ?>index.php/home/echo_vouchers_list",{
			  			deal_id:<?php  echo $deal_id   ?>},
			  			function(data) {

							    $('#list_of_vouchers').html(data);
									$('#code').val('');
									
								});				
			
			};



}
	
				
function open_small_control_panel(){

							$('.control_panel_form_div_inside_right_div').hide();

							$('.control_panel_form_div').css({
								width:'371px',	
								height: '550px'
								});		
}
function open_large_control_panel(){

							$('.control_panel_form_div_inside_right_div').hide();

							$('.control_panel_form_div').css({
								width:'580px',	
								height: '550px'
								});						  		

}

function launch_control_panel_div_box(){
	
		$(".control_panel_form_div").css({display:'block'});
		$("#control_panel").css({'border-right':'0px'});		
		
}


function close_control_panel_div_box(){
	
		$(".elements_to_hide_when_adding_deal").css({visibility:'visible'});
		$(".control_panel_form_div, .control_panel_form_div_inside_right_div").css({display:'none'});
		$("#control_panel").css({'border-right':'1px solid #2E9AFE'});
	
}
	


function calculate_savings(){
	
	var raw_percentage_discount_value  = 100 - ( parseInt($('#deal_price').val()) /  parseInt($('#orig_price').val())    * 100 );

	$('#discount').css({visibility:'visible'}).text(   Math.round( raw_percentage_discount_value  ).toFixed(0)  );
	$('#savings').css({visibility:'visible'}).text(   parseInt($('#orig_price').val())  -  parseInt($('#deal_price').val())  );
	
}



function open_dialogue_upload_image(){
	
		// $('body').scrollTo( '#top', 1000 );

		$("#iframe_src_for_image").attr('src','<?php echo base_url();    ?>index.php/home/upload_image_form/<?php echo $deal_id;    ?>' );
			
		var left_coord = ($(window).width()/2 -390);

		$("#dialog" ).dialog({
			position:[left_coord,104],
			height: 140,
			zIndex: -10,
			width: 410,
			resizable: false 
			})
						
};
						
function open_jcrop(){ // called from inside iframe

	$("#iframe_src_for_image").css({width:'940px',height:'420px'}).attr('src','<?php echo base_url();    ?>index.php/home/iframe_jcrop_form_for_image/<?php echo $deal_id;    ?>');

	$( "#dialog" ).dialog({
		position:[6,10],
		height: 1150,
		height: 570,
		zIndex: -10,
		width: 990,
		resizable: false
		
		})	

};

<?php } ?>

