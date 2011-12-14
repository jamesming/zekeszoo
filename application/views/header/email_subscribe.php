<style>
#subscribe_container{
	height:52px;
/*//background:#175C8D;*/	
	background-image:url(<?php  echo base_url()   ?>images/top_grad.png);
	background-repeat:repeat-x;
	background-position:center center;
}

		#subscribe_container div#paw_image{
/*			background-image:url(<?php  echo base_url()   ?>images/sites/zekeszoo/paw.png);
			background-repeat:no-repeat;
			background-position:right 6px;*/
			height:52px;
			width:148px;
			margin-left: 140px;
		}

		#subscribe_container div.content{
	    font-size: 20px;
	    color: #FFFFFF;
	    font-weight: bold;
	    padding-top: 8px;
    	padding-left: 18px;
		}
		
		
		#subscribe_container div.input_form {
	    padding-top: 8px;
    	padding-left: 21px;
		}				
		
				#subscribe_container div.input_form  input{
							border:medium none;
							color:#888888;
							font-size:93%;
							margin: 0px 0px 0px 0px;
							padding: 10px;
				}		
		
		
						#subscribe_container div.input_form  input.short{
									background:url(<?php  echo base_url()   ?>images/signup_short.png) no-repeat scroll left center transparent;
									width: 140px;
						}		
		
		
						#subscribe_container div.input_form  input.shorter{
									background:url(<?php  echo base_url()   ?>images/signup_shorter.png) no-repeat scroll left center transparent;
									width: 50px;
						}		
				
				#subscribe_container img#go_button{
					    padding-top: 8px;
					    margin:0px 0px 0px 2px;
				}			
				
				#subscribe_container div#close_subcribe{
			    width: 44px;
			    padding-top: 14px;
			    text-align: right;
			    font-size: 10px;
			    color: white;
				}
		
		
</style>
<script type="text/javascript" language="Javascript">
$(document).ready(function() { 
	
				$('#subscribe_container').delay(1000).slideDown('slow');
	
				$('#close_subcribe').click(function(event) {
						$('#subscribe_container').slideUp('slow');
				});
				
				$('#go_button').click(function(event) {
							$.post("<?php echo base_url() ?>index.php/home/insert_email_subscriber",{
								email: $('#email').val(),
								zip:$('#zip').val()
								},function(data) {
								
									$('#close_subcribe').click();
							
							});	
				});	
});
</script>
<div  id='subscribe_container'   style='display:none'  >
	
		<div  class='container '    >
			
				<div id='paw_image' class='float_left ' >
				</div>
				<div  class='content float_left '   style='font-weight:normal'  >Get great deals for your pet today!
				</div>
				<div  class='input_form float_left '   >
					<input  class='short ' id="email"  type="text" name="email" onblur="if(this.value==''){this.value='Enter your email address'}" onfocus="if(this.value=='Enter your email address'){this.value=''}" value="Enter your email address">
					<input  class='shorter ' id="zip"  type="text" name="zip" onblur="if(this.value==''){this.value='and zip'}" onfocus="if(this.value=='and zip'){this.value=''}" value="and zip">
				</div>

				<img id='go_button'  class=' cursor_pointer float_left' src='<?php echo base_url()    ?>images/go.png'/>
				<div  class=' cursor_pointer float_left'  id='close_subcribe'>close[x]
				</div>
		</div>	
	
</div>