<style>
#purr-container {
	position: absolute; 
	top: 120;
	right: 0;
}
.notice {
	border:0px;
	position: relative;
	width: 324px;
	padding:0px 0px;
	background:none;
}
.notice .close	{
	position: absolute; 
	top: 12px; right: 12px; 
	width: 18px; 
	height: 17px; 
	text-indent: -9999px; 
	background: url(<?php echo base_url();    ?>js/growl/purr-example/purrClose.png) no-repeat 0 10px;}

.notice-body {
	min-height: 50px;
	padding: 22px 22px 0 22px;
	background: url(<?php echo base_url();    ?>js/growl/purr-example/purrTop.png) no-repeat left top;
	color: #f9f9f9;
}
	.notice-body img	{width: 50px; margin: 0 10px 0 0; float: left;}
	.notice-body h3	{color:white;margin: 0; font-size: 1.1em;}
	.notice-body p		{margin: 5px 0 0 60px; font-size: 0.8em; line-height: 1.4em;}

.notice-bottom {
	
	background: url(<?php echo base_url();    ?>js/growl/purr-example/purrBottom.png) no-repeat left top;
}
</style>

<script type="text/javascript" src="<?php echo base_url();    ?>js/growl/jquery.purr.js"></script>
<script type="text/javascript" language="Javascript">
					$(document).ready(function() { 
						$('#test_growl').click( function(){
						
							growl( notice_header_text='test' , notice_body_text = 'this is the body<br>hello<br>hello', isThisSticky = false);
							
						});
					});
					
					
					function growl( notice_header_text, notice_body_text, isThisSticky ){
						
								var notice = '<div class="notice"   >'
										  + '<div class="notice-body"  >' 
											  + '<img  src="<?php echo base_url();    ?>js/growl/purr-example/info.png" alt="" />'
											  + '<h3>' + notice_header_text + '</h3>'
											  + '<p >' + notice_body_text + '</p>'
										  + '</div>'
										  + '<div class="notice-bottom">'
										  + '&nbsp;</div>'
									  + '</div>';
									  
								$( notice ).purr(
									{
										usingTransparentPNG: true,
										isSticky: isThisSticky
									}
								);
								
								return false;
					}
</script>
<!--
<span id='test_growl'  class='cursor_pointer ' >test growl</span>
-->