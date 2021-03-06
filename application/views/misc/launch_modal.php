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
					
					$.fn.makeTypePassword = function() {
						  $("<input id='join_password' type='password' value_check='Password (must be 6 characters)' name='join_password' errorChecked=0/>")
						  .click(function(event) {
								$(this).removeErrorMessage()
						  })	
						  .addClass('input_style')
						  .attr({ value: '' })
						  .css({color:'black','font-style':'normal'})
						  .insertBefore(this).focus();
							$(this).remove()

					  return this;
					};
					
					$.fn.makeNormalInputStyle = function() {
						$(this).val('').css({color:'black','font-style':'normal'});
						$(this).unbind('keypress');	
					  return this;
					};		
					
					$.fn.addErrorMessage = function(message) {
						if( $(this).attr('id') == 'agree'){
							$(this).parent().parent().append("<div  class='error_div '   style='clear:both'  >"+message+"</div>");
						}else{
							$(this).parent().append("<div  class='error_div ' >"+message+"</div>");
						};
					  return this;
					};		
					
					$.fn.removeErrorMessage = function() {
						if( $(this).attr('errorChecked') == 1){
							if( $(this).attr('id') == 'agree'){
								$(this).parent().parent().children('div.error_div').remove()
							}else{
								$(this).parent().children('div.error_div').remove()
							};
							$(this).attr('errorChecked', 0);
							resizeLaunchWindowBy( (window.heightOfErrorMessageDiv + 5) * -1 );
							window.ok = 1;
						  return this;							
							
						};

					};							
										
												
					function resizeLaunchWindowBy( howmuch ){
								$('#DOMWindow').height($('#DOMWindow').height()+howmuch);
								$('#launch_pop.left-half .left-middle-half').height($('#launch_pop.left-half .left-middle-half').height()+howmuch)
					}	
					
					$(document).ready(function() { 
				
						$('.input_style').click(function(event) {
								$(this).removeErrorMessage()
								if( $(this).val() == $(this).attr('value_check') || $(this).val()==''){
									$(this).val($(this).attr('value_check')).css({color:'lightgray'}).setCursorPosition(0)
									.bind('keypress', function(e) {
											$(this).makeNormalInputStyle()																				
									})
								};									
						}).focus(function(event) {
								$(this).removeErrorMessage()
								if( $(this).val() == $(this).attr('value_check') || $(this).val()=='' ){
									$(this).val($(this).attr('value_check')).css({color:'lightgray'}).setCursorPosition(0)
									.bind('keypress', function(e) {
											$(this).makeNormalInputStyle()																				
									})
								};
						}).blur(function(event) {
							if( $(this).val() == $(this).attr('value_check')  || $(this).val()==''){
								$(this).css({color:'gray'})
							};
						});
						
						$('#join_password').click(function(event) {
								$(this).removeErrorMessage()
								$(this).bind('keypress', function(e) {
										$(this).makeNormalInputStyle()
										$(this).makeTypePassword();																						
								})
								 
						}).focus(function(event) {
								 $(this).removeErrorMessage()
								 $(this).bind('keypress', function(e) {
										$(this).makeNormalInputStyle()
										$(this).makeTypePassword();																						
								})
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
										
						        window.setTimeout(function()
						        {
															$('body').scrollTo( $('#very_top'), 800, {
																				onAfter: function() { 
																				$('a.open_launch_window').click();
															}} );
						        },500);
										
						};
						
						$('#agree').click(function(event) {
								if( $(this).is(":checked") ){
									$(this).removeErrorMessage();
								};
						});	

						
						window.ok = 1;
						window.heightOfErrorMessageDiv = 20;
						
						$('#join').click(function(event) {

							
								$('.input_style').each(function(count) {
											
											if( $(this).attr('errorChecked') == 0 && $(this).val() == $(this).attr('value_check')){
												resizeLaunchWindowBy( window.heightOfErrorMessageDiv );
												$(this).attr('errorChecked', 1).addErrorMessage( $(this).attr('value_check') + ' required.');
												window.ok = 0;
											};
											
								});	
								
								if( window.ok == 1 && $('#join_email').val() != $('#confirm_email').val()){
									resizeLaunchWindowBy( window.heightOfErrorMessageDiv );
									$('#confirm_email').attr('errorChecked', 1).addErrorMessage('Confirm Email does not match Email.');
									window.ok = 0;
								};
												
												
												
								if( window.ok == 1 && $('#join_password').val().length < 6 ){
										resizeLaunchWindowBy( window.heightOfErrorMessageDiv );
										$('#join_password').attr('errorChecked', 1).addErrorMessage('Must be min 6 characters.');
										window.ok = 0;
								};

												
												
								if( window.ok == 1 && !$('#agree').is(":checked") ){
										resizeLaunchWindowBy( window.heightOfErrorMessageDiv );
										$('#agree').attr('errorChecked', 1).addErrorMessage('Must agree to Terms and Conditions.');
										window.ok = 0;
								};
								
								if( window.ok == 1 ){
									$.closeDOMWindow();
									$('#form0').submit();
								};						
						
						});	
						
								
					});

				</script>
			
				<style>
					body{
					font-family:"Helvetica Neue", Arial, Helvetica, sans-serif;	
					font-size:17px;
					}
					.input_style{
						  border: 1px solid gray;
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
											.error_div{
										    color: darkRed;
										    font-size: 12px;
										    height: 19px;
										    margin: 0;
										    padding-left: 80px;
										    font-style: italic;
										    text-align:left;
											}
											</style>
											<form
											id='form0'
											name='form0'
											enctype='multipart/form-data'
											action='<?php  echo base_url()  ?>index.php/home/enroll/'	
											method='post'
											>
											<table  id='launch_content_table'>
												<tr>
													<td>
														<input  class='input_style ' name="first_name" id="first_name	" type="" value="First Name" value_check='First Name' errorChecked=0>
													</td>
												</tr>
												<tr>
													<td>
														<input  class='input_style ' name="last_name" id="last_name	" type="" value="Last Name" value_check='Last Name' errorChecked=0>
													</td>
												</tr>
												<tr>
													<td>
														<input  class='input_style ' name="join_email" id="join_email" type="" value="Email" value_check='Email' errorChecked=0>
													</td>
												</tr>
												<tr>
													<td>
														<input  class='input_style ' name="confirm_email" id="confirm_email" type="" value="Confirm Email" value_check='Confirm Email' errorChecked=0>
													</td>
												</tr>
												<tr>		
													<td>
														<input  class='input_style ' name="join_password" id="join_password" type="" value="Password (must be 6 characters)" value_check='Password (must be 6 characters)' errorChecked=0>
													</td>
												</tr>
												<tr>		
													<td >
														<div>
															<div   style='float:left;width:95px;'  >
																<input name="agree" id="agree" type="checkbox" value=""   style='width:10px'  >
															</div>
															<div  style='text-align:left;padding-top:6px;float:left;width:200px;font-size:10px'  >I agree to the Terms and Conditions
															</div>															
														</div>
													</td>
												</tr>																																					
											</table>
											</form>
											<style>
											#join{
												cursor:pointer;
												color:white;
												font-weight:bold;
												font-size:17px;
												margin:13px auto;
												text-align:center;
												padding-top:4px;
												height:32px;
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