<script type="text/javascript" language="Javascript">
$(document).ready(function() {
	
	
				$('#submit').click(function(event) {  // THIS IS FOR SUBMITTING JCROP
					document.getElementsByTagName('iframe')[2].contentWindow.submitCropForm();
				});
						
				

				$('#logo').click(function(event) {				
						document.location.href='<?php echo  base_url();   ?>index.php/home';
				});

				$('.pic_row div.pic_box:nth-child(3)').addClass('last_in_row');
				

				
				$('.contains_image')
				
				.html("<div  class='small_icon_container float_right transparent_class'        ><div   class='delete small_icon'  title='Remove Picture'  ></div><div  class='edit small_icon' title='Change Picture'  ></div><div    href='#bubble_div'  class='bubble small_icon'  title='Make speech bubble'  ></div></div>")
				
				
				.mouseover(function() {
								$(this).find('.small_icon_container').css({display:'block'});
						}).mouseout(function(){
								$(this).find('.small_icon_container').css({display:'none'});
						});
						
						
				$('.delete').css({cursor:'pointer'}).click(function(event) {				
						if(  confirm('Do you really want to remove this picture?')  ){
						    document.location.href='<?php echo  base_url();   ?>index.php/home/remove_pet_image/' + $(this).parent().parent().attr('my_pet_gallery_id');
						}
				});
				
				
				$('.bubble').css({cursor:'pointer'}).fancyZoom().click(function(event) {
					$("#iframe_src_for_speech_bubble").attr('src','<?php echo base_url();    ?>index.php/home/speech_bubbble_form/'+$(this).parent().parent().attr('my_pet_gallery_id'));
				});		
				
				
				$('.edit, .first_available').css({cursor:'pointer'}).click(function(event) {
					open_dialogue_upload_image(
					 $(this).parent().parent().attr('my_pet_gallery_id'),
					 $(this).attr('title')
					);
				})

});		



function submit_bubble_form( my_pet_gallery_id ){
	

	
						$.post("<?php echo base_url(). 'index.php/home/update_bubble_text'; ?>",{
							my_pet_gallery_id:my_pet_gallery_id,
							bubble_text:$('#bubble_text').val()
						},function(data_from_first_post) {

							alert('updated');
							
						});
	
	
	
}

function open_dialogue_upload_image( my_pet_gallery_id, title ){
	
		// $('#dialog').attr('title', title);
	
		$('#dialog table#submit_jcrop_table').css({display:'none'});
	
		if( my_pet_gallery_id == null){
			my_pet_gallery_id = 0;
		};
		
	
		$("#iframe_src_for_image").css({width:'350px',height:'80px'}).attr('src','<?php echo base_url();    ?>index.php/home/upload_pet_form/' + my_pet_gallery_id );
			
		var width_of_dialog = 410;
		var left_coord = ($(window).width()/2 - width_of_dialog/2);

		$("#dialog" ).dialog({
			position:[left_coord,200],
			height: 160,
			zIndex: -10,
			width: width_of_dialog,
			resizable: false 
			})
						
};
						
function open_jcrop( my_pet_gallery_id ){ // called from inside iframe
	
	$("#iframe_src_for_image").css({width:'940px',height:'420px'}).attr('src','<?php echo base_url();    ?>index.php/home/iframe_jcrop_form_for_pet_image/' + my_pet_gallery_id);

	$( "#dialog" ).dialog({
		position:[6,10],
		height: 1150,
		height: 570,
		zIndex: -10,
		width: 990,
		resizable: false
		
		})	

};

</script>