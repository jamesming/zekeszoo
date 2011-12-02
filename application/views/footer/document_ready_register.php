<script type="text/javascript" language="Javascript">
$(document).ready(function() {
	

				$('#i_agree_box, form#form0 input[type=text], form#form0 input[type=password]')
				.focus(function() {
					
					$(this).val('').css({background:'white'})

					.parent().parent().children('div.error_message').html("&nbsp;");
					
				});
				
				$('#logo').click(function(event) {
					<?php if( $_SERVER['HTTP_HOST'] == 'zekeszoo.com' ){?>	
												document.location.href='http://zekeszoo.com/index.php/home';

					<?php }else{?>
												document.location.href='<?php echo  base_url();   ?>index.php/home';

					<?php } ?>
				});	
				
				$('#logout').click(function(event) {
						document.location.href='<?php echo  base_url();   ?>index.php/home/logout/<?php echo $deal_id    ?>';
				});
				
				
				$('#signup_image').click(function(event) {
					
					
					
					
					
					
						$('form#form0 input[type=text], form#form0 input[type=password]')
						
						.css({background:'white'})
						
						.each(function(){
		
								if( $(this).val() == '' ){

									$(this).css({background:'pink'}).parent().parent().children('div.error_message').html("Can't be blank.");

								};
						        
						});
						
						
					
					$('#error_message').children().remove();
					
					var return_from_check_form = check_form();
					
					if( return_from_check_form == ''){
							$('#form0').submit();
					}else{
							$('#error_message').show().append('<ol></ol>').children().html(return_from_check_form );
					};

				});		
				
				
				<?php if( $error['type'] == 'duplicate email' ){?>

					$('#error_message').show();
					$('form#form0 input#email').css({background:'pink'}).val( '<?php  echo $this->input->post('email')   ?>' );
					
				<?php }elseif ( $error['type'] == 'none') {?>
					
					$('#error_message').show().css({
						'background-color':'#CEF6CE',
						'background-image': 'url(<?php  echo base_url()   ?>images/thumbup.png)',
						'background-position': '14px 13px',
						'background-repeat': 'no-repeat',
						border:'1px solid #8CAB25'
						});
						
						$('#signup_image').unbind('click');
					
				<?php } ?>					
				

});		


function check_form(){
	
				var message = ''

				$('form#form0 input[type=text], form#form0 input[type=password]').each(function(){

						if( $(this).val() == '' ){

							message = '<li>All form fields must be completely filled.</li>';
							
							$(this).css({background:'pink'});
							
						};
				        
				});
				
				

				
				
				// PASSWORD GREATER THAN 5
				
				if( $('form#form0 input#password_signup').val().length  < 5  ){

					message += '<li>Your passwords must more than 5 characters in length.</li>';
					
					$('form#form0 input#password_signup, form#form0 input#confirm').css({background:'pink'}).parent().parent().children('div.error_message').html("5 characters or more.");

				}else{
					
									// ** PASSWORD MUST MATCH
									
									if( $('form#form0 input#password_signup').val()  !=  $('form#form0 input#confirm').val() ){
										
										message += '<li>Your passwords must match.</li>';
										
										$('form#form0 input#password_signup, form#form0 input#confirm').css({background:'pink'}).parent().parent().children('div.error_message').html("Passwords must match.");
					
									}else{
										$('form#form0 input[type=password], form#form0 input#confirm').css({background:'white'}).parent().parent().children('div.error_message').html("&nbsp;");	
									};					

				};					
				

				
				
				// ** ZIPCODE FOR SIGNUP MUST BE INT AND GREATER THAN 5 CHARACTERS
				if(  $('form#form0 input#zipcode_signup').val()  != parseInt( $('form#form0 input#zipcode_signup').val() ) 
							||  $('form#form0 input#zipcode_signup').val().length  < 5
				) {
					
					message += '<li>Zipcode is invalid.</li>';
					
					$('form#form0 input#zipcode_signup').css({background:'pink'}).parent().parent().children('div.error_message').html("Invalid Zipcode.");

				}else{
						
							$('form#form0 input#zipcode_signup').css({background:'white'}).parent().parent().children('div.error_message').html("&nbsp;");	
							
				};
				
				
				// ** EMAIL 
				
				if( isBadEmail(  $('form#form0 input#email').val() )  ){
					
						message += '<li>Your email is invalid.</li>';
						
						$('form#form0 input#email').css({background:'pink'}).parent().parent().children('div.error_message').html("Invalid email.");
					
				}else{
						
						$('form#form0 input#email').css({background:'white'}).parent().parent().children('div.error_message').html("&nbsp;");
					
				};	
				
				// **  I AGREE CHECKED
				if ($('#i_agree_box').is(':checked')) {  } else {	
					
					message += '<li>Please agree to <u>Deal Term</u>, <u>Terms of Service</u> and <u>Privacy Policy</u>.</li>';
					
					$('#i_agree_box').css({background:'pink'});					
				};				
				
				
/**
 ** function does not work.  ajax can not write into global variable	
 			
				if( check_for_duplicate_email( $('form#form0 input#email').val() ) == 'true' )  {
					
					message += '<li>' +  $('form#form0 input#email').val() + ' is already a registered account.</li>';
					
					$('form#form0 input#email').css({background:'pink'});

				};	
*/				
				
				

				
				
				
				return message;
				
	
}


function isBadEmail(email) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(email) == false) {
      return true;
   }
}

/**
 ** function does not work.  ajax can not write into global variable

is_found = 'test';
function check_for_duplicate_email(){
	
		

		$.post("<?php echo base_url(). 'index.php/home/check_for_duplicate_email';    ?>",{
			email: $('#email').val()
			},function(data) {
				is_found = data;
				alert(is_found);
		 });
		  
		  
		  alert(is_found);
		 return is_found;
		 
}

*/
</script>