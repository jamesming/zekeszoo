<div id='footer'>

</div>
<div  id='info'>
		<div  class='container ' >
			<div   id='company' class=' float_left'>
				<div  class=' footer_header' >Company
				</div>
				<ul>
					<li  id='home'>Home</li>
					<li  id='contactus'>Contact Us</li>
					<li  id='aboutus'>About Zekeszoo</li>
					<!--<li  id='press'>Press</li>-->
					<li  id='privacy'>Privacy</li>
				</ul>
			</div>
			<div   id='learn_more' class=' float_left'>
				<div  class='clearfix footer_header' >Learn More
				</div>
				<ul>
					<li  id='terms'>Terms of Service</li>
					<!--<li  id='returns'>Return Policy</li>-->
					<li  id='suggest'>Suggest a Business</li>
				</ul>
			</div >
			<div  id='footer_bottom_third_column' class='float_left '>
				
					<div  class=' clearfix' ><b>Join Our Community!</b>
					</div>
					<div  class='clearfix social_links ' >
						<div  class='float_left ' >
							<a target='_blank' href='http://twitter.com/zekeszoo'>
								<img   style='margin-top:-15px'   width='50' src='<?php echo base_url()    ?>images/twitter_newbird_blue.png' /></a>
						</div>	
						<div  class='float_left ' >
							<a target='_blank' href='http://www.facebook.com/zekeszoo'><img   style='margin-top:-3px' width='30' src='<?php echo base_url()    ?>images/fb.gif' /></a>
						</div>
					</div>


					<br /><br />
					<hr />
					<div id='copyright' >&#169;&nbsp;&nbsp;2011 Copyright. Zekeszoo Inc,  All Rights Reserved
					</div>
							
			</div >
		</div>
</div>


<iframe id="iframe_facebook" frameborder="0" scrolling="no" 
	  style='width:0px;height:0px'  
 >
	
    <p>Your browser does not support iframes.</p>
    
</iframe>	
<script type="text/javascript" language="Javascript">
	
$(document).ready(function() {
	
	
		$('#company li, #learn_more li').click(function(event) {				
						document.location.href='<?php echo  base_url();   ?>index.php/home/'+$(this).attr('id');
		});	
		
		
});	
</script>