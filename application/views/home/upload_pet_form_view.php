<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php  
			$this->load->view('header/blueprint_css.php');
	?>
	
	<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>

	<script type="text/javascript" language="Javascript">
	
			$(document).ready(function() { 
				
									

							$('#select_file').change(function(e){
								$('#uploadForm').submit();
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
    width: 234px;
		padding-top: 11px;
		padding-left: 29px;
}

</style>
</head>

<body   style='background:lightgray'  >
	
<form id='uploadForm' 
	name='uploadForm' action='<?php echo  base_url();   ?>index.php/home/upload_pet_image/' 
	method='post' 
	enctype='multipart/form-data'>	
	<div id='input_container'    >
			<div  class='first float_left' >
				<input id='select_file' type="file" name="Filedata" size="20"      />
				<input name="my_pet_gallery_id" id="my_pet_gallery_id" type="hidden" value="<?php echo $my_pet_gallery_id    ?>">

			</div>
	
	</div>


</form>
	
</body>
</html>