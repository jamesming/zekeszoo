<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php  
			$this->load->view('header/blueprint_css.php');
	?>
	
	<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>

	<script type="text/javascript" language="Javascript">
	
			$(document).ready(function() { 
				
									
							$('#delete_folder').show();
								

							$('#select_file').change(function(e){
								$('#uploadForm').submit();
							});
							
								
							
							$('#delete_folder').click(function(e){
								
								
									if(  confirm('Do you really want to remove this image?')  ){
								
								
											$.post("<?php echo base_url() . 'index.php/home/remove_image/';    ?>",{
												folder_number: <?php  echo $deal_id;   ?>
											},function(data) {
												

												
											});								
											
											
									};		
											
											
							});
									
			});
			 
			 
	</script>
<style>
.float_left{
float:left;	
}

#uploadForm {
    margin-left: 43px;
    margin-top: 15px;
}
#uploadForm div#input_container {
}
#uploadForm div#input_container div {
}
#uploadForm div#input_container div.first {
    width: 234px
}
#uploadForm div#input_container div.second {
		width:30px;
    margin-left: 5px;
}	
</style>
</head>

<body   style='background:lightgray'  >
	
<form id='uploadForm' 
	name='uploadForm' action='<?php echo  base_url();   ?>index.php/home/upload_image/' 
	method='post' 
	enctype='multipart/form-data'>	
	<div id='input_container'    >
			<div  class='first float_left' >
				<input id='select_file' type="file" name="Filedata" size="20"      />
				<input id='deal_id' type="hidden" name="deal_id" value="<?php echo $deal_id    ?>"      />
				

			</div>
			<div  class='second float_left'>
				<img id='delete_folder'  class=' cursor_pointer'  src='<?php echo base_url();    ?>images/icon_trash.png'>
			</div>		
	</div>


</form>
	
</body>
</html>