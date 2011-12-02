<script type="text/javascript" language="Javascript">
$(document).ready(function() {


	// CLICKING ADD TAB
	
	$('#add').click(function(event) {
		
		$('#form0 input').each(function(){
			
						$(this).val('');
			        
		});		
		
		$('.tab').css({background:'transparent'});
		
		$(this).css({background:'gray'});
			$('#vendor_list').animate({marginLeft:'-160px'},'slow');
			
		$('#vendor_id').val('');
			
		$('#submit').val('add');
			
	});	
	
	
	
	// CLICKING EDIT TAB
	
	$('#edit').click(function(event) {

		$('#submit').val('update');		
		
		$('.tab').css({background:'transparent'});
		$(this).css({background:'gray'});
			$('#vendor_list').animate({marginLeft:'0px'},'slow');
			
		$.post("<?php echo base_url(). 'index.php/home/get_vendors';    ?>",{
			},function(data) {
					$('#vendor_list').html(data);
		 });
	});
	
	
	$('#form0 input').click(function(event) {

		$(this).css({background:'white'});
		
	});
	
	
	//**  SUBMITTING VENDOR
	
	$('#submit').click(function(event) {
		
		var proceed = 'ok';
		
		$('#form0 input').each(function(){
		
								if( $(this).val() == '' ){

									$(this).css({background:'pink'});
									proceed = 'no';

								};
						        
						});
	
						
		proceed = 'ok';

		if( proceed == 'ok'){

					if( $('#submit').val() == 'add'){
						
						add_vendor_post();

					}else{
						
						update_vendor_post();
						
					};
			
		}else{
			alert('All fields must be filled.');
		};
			
				
				
				
	});	
	
		
});	


function update_vendor_post(){
	
	
//	$('#form0 input').animate({ backgroundColor: "blue" }, 'slow');
	
						$.post("<?php echo base_url(). 'index.php/home/update_vendor'; ?>",{
							vendor_id:$('#vendor_id').val(),
							contact:$('#contact').val(),
							email:$('#email').val(),
							company_name:$('#company_name').val(),
							address:$('#address').val(),
							address2:$('#address2').val(),
							city:$('#city').val(),
							state:$('#state').val(),
							zipcode:$('#zipcode').val(),
							telephone:$('#telephone').val(),
							fax:$('#fax').val(),
							telephone:$('#telephone').val(),
							vendor_website:$('#vendor_website').val(),
							vendor_type_id:$('#vendor_type_id').val(),
							notes:$('#notes').val(),
							vendor_short_description:$('#vendor_short_description').val()
						},function(data_from_first_post) {
							
							//$('#form0 input').animate({ backgroundColor: "blue" }, 'slow');
							//$('#form0 input').css({ backgroundColor: "blue" });
							
							alert('updated');
							
						});
	
}


function add_vendor_post(){
	
						$.post("<?php echo base_url(). 'index.php/home/add_vendor'; ?>",{
							contact:$('#contact').val(),
							email:$('#email').val(),
							company_name:$('#company_name').val(),
							address:$('#address').val(),
							address2:$('#address2').val(),
							city:$('#city').val(),
							state:$('#state').val(),
							zipcode:$('#zipcode').val(),
							telephone:$('#telephone').val(),
							fax:$('#fax').val(),
							telephone:$('#telephone').val(),
							vendor_website:$('#vendor_website').val(),
							vendor_type_id:$('#vendor_type_id').val(),
							notes:$('#notes').val()
						},function(data_from_first_post) {
							
							
									// ** SLIDING EDIT PANEL BACK IN VIEW
		
									$('#submit').val('update');		
									
									$('.tab').css({background:'transparent'});
									$(this).css({background:'gray'});
										$('#vendor_list').animate({marginLeft:'0px'},'slow');
										
										
										
										
									$.post("<?php echo base_url(). 'index.php/home/get_vendors';    ?>",{
										},function(data_from_second_post) {
											
												$('#vendor_list').html(data_from_second_post);
												
												$('#vendor_list div.item[vendor_id='+data_from_first_post+']').css({background:'yellow'});
												
												$('#vendor_id').val(data_from_first_post);
												
												// ADDING OPTION TO ADD DEAL SELECT FORM
												
												window.parent.$('#vendor_id').append("<option value='" + data_from_first_post + "'>" + $('#company_name').val() + "</option>");
												
												window.parent.$('#vendor_id').val(data_from_first_post);

									 });
							
						});
						
}	

</script>