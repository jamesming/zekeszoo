
<script type="text/javascript" language="Javascript">
	
					$(document).ready(function() { 

								  	$('.wysiwyg_div_link').css({cursor:'pointer', background:'clear'}).fancyZoom().click(function(event) {
								  		
											$("#div_id_to_edit").val($(this).attr('id'));
											$("#table").val($(this).attr('table'));
											
											
											$("#iframe_content_text").attr('src','<?php echo base_url();    ?>index.php/home/wysiwyg/<?php echo $deal_id;    ?>');
											
										});		
	
					});  // END $(document).ready(function()


</script>

<div id="wysiwyg_div"  style='
				height:580px;
				height:560px;
			display:none'  >
	<iframe id="iframe_content_text" scrolling="no"  style="
		width:650px;
		height:555px;
		margin: 0; 
		padding: 0; 
		border: 0px solid black;
		" 
		frameborder="0" src=""  >
		
	    <p>Your browser does not support iframes.</p>
	    
	</iframe>
</div>		

<input id="div_id_to_edit" type="hidden" value="">
<input id="table" type="hidden" value="">