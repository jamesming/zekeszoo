<html>
<head>
	
	<?php  $this->load->view('header/blueprint_css.php');   ?>	
	

<link rel="stylesheet" href="<?php  echo base_url();   ?>js/Jcrop/css/jquery.Jcrop.css" type="text/css"  type="text/css" >
   
<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
<script type='text/javascript' src='<?php  echo base_url()   ?>js/Jcrop/js/jquery.Jcrop.min.js'></script>


<script type="text/javascript" language="Javascript">
	
					$(document).ready(function() {
						
							
							jQuery('#cropbox').Jcrop({		
								onChange: showPreview,
								aspectRatio: <?php  
								
							
															        echo "1.31350114";
							
								
													   ?>,
								setSelect:   [ 0, 0, <?php 
								
							
															        echo $width_of_file . ", ". $height_of_file ;
							
								
																	?> ]
							});  	
							
							
							$('#submit').click(function(event) {
							
							submitCropForm();
							
							
							});		

					});
					
					function checkCoords(){
						if (parseInt($('#w').val())) return true;
						alert('Please select a crop region then press submit.');
						return false;
					};
					
					function showPreview(coords){
						$('#x').val(coords.x);
						$('#y').val(coords.y);
						$('#x2').val(coords.x2);
						$('#y2').val(coords.y2);
						$('#w').val(coords.w);
						$('#h').val(coords.h);
					};
					
					function submitCropForm(){
						

										// AJAX UPDATE
										$.post("<?php echo base_url() . 'index.php/home/crop_pet_image/';    ?>",{
											x_origin: $('#x').val(),
											y_origin: $('#y').val(),
											width: $('#w').val(),
											height: $('#h').val(),
											my_pet_gallery_id: '<?php echo $my_pet_gallery_id;    ?>'
										},function(data) {
											
											
												window.parent.location.reload(true);


										});		
										
										
					};
					
					
					

</script>

<style>
	table {
	width:100%;
	}
	table td{
	color:darkgray;
	font-size:23px;
	}
</style>
</head>

<body   style='padding-top:2px'  >



<div   style='width:<?php echo $width_of_file;    ?>px;margin-left:auto;margin-right:auto'  > 
	<img     id='cropbox' src = '<?php  echo  base_url() . 'uploads/gallery/' . $this->session->userdata['user_id'] . '/' . $my_pet_gallery_id . '/transition.png?random=' . rand(5,6815);   ?>'>		
</div> 


							
							
<form id='corpForm' name='corpForm' action='<?php  echo base_url();   ?>index.php/upload/crop' onsubmit='return checkCoords();'>
	<input type="hidden" size="4" id="x" name="x" value="" />
	<input type="hidden" size="4" id="y" name="y" />
	<input type="hidden" size="4" id="x2" name="x2" />
	<input type="hidden" size="4" id="y2" name="y2" />
	<input type="hidden" size="4" id="w" name="w" />
	<input type="hidden" size="4" id="h" name="h" />
	

	<!-- 
	<label>X1 </label>
	<label>Y1 </label>
	<label>X2 </label>

	<label>Y2 </label>
	<label>W </label>
	<label>H </label>-->
</form>
</body>

