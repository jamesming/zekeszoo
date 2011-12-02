<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/vendor_css.php');  ?>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery-ui/jquery.ui.core.min.js"></script>
</head>

<html>

<body>
<form id='form0' name='form0' action='<?php echo base_url()    ?>index.php/home/add_vendor' method='post'>

<div id='tabs'>
	<div id='add' class='tab float_left ' >Add
	</div>
	<div  id='edit' class='tab float_left ' >Edit
	</div>			
</div>
<div id='main' class='clearfix ' >
	
<div  id='vendor_list' class='float_left '>
<?php for($i=0;$i<1;$i++ ){?>
	<div class='clearfix item' >
		test
	</div>
<?php } ?>
</div>
	
<div  id='vendor_edit' class='float_left ' >
	
	<table>
		<tr>
			<td  class='label ' >Contact
			</td>
			<td><input name="contact" id="contact" type="" value="">
			</td>
		</tr>
		<tr>
			<td  class='label ' >Contact Email
			</td>
			<td><input name="email" id="email" type="" value="">
			</td>
		</tr>		
		<tr>
			<td  class='label '>Company Name
			</td>
			<td><input name="company_name" id="company_name" type="" value="">
			</td>
		</tr>
		<tr>
			<td  class='label '>Address
			</td>
			<td><input name="address" id="address" type="" value="">
			</td>
		</tr>
		<tr>
			<td  class='label '>Address2
			</td>
			<td><input name="address2" id="address2" type="" value="">
			</td>
		</tr>
		<tr>
			<td  class='label '>City
			</td>
			<td><input name="city" id="city" type="" value="">
			</td>
		</tr>
		<tr>
			<td  class='label '>State
			</td>
			<td><input name="state" id="state" type="" value="">
			</td>
		</tr>	
		<tr>
			<td  class='label '>Zipcode
			</td>
			<td><input name="zipcode" id="zipcode" type="" value="">
			</td>
		</tr>
		<tr>
			<td  class='label '>Telephone
			</td>
			<td><input name="telephone" id="telephone" type="" value="">
			</td>
		</tr>
		<tr>
			<td  class='label '>Fax
			</td>
			<td><input name="fax" id="fax" type="" value="">
			</td>
		</tr>
		<tr>
			<td  class='label '>Vendor Website
			</td>
			<td><input name="vendor_website" id="vendor_website" type="" value="">
			</td>
		</tr>	
		<tr>
			<td  class='label '>Vendor Type
			</td>
			<td>
				<select id='vendor_type_id' name='vendor_type_id'>
					<option value='1' selected>E-tailer</option>
					<option value='2'>Store</option>
					<option value='3'>Restaurant</option>
					<option value='4'>Spa</option>
					<option value='5'>Fitness</option>
					<option value='6'>Tour</option>
				</select>
			</td>
		</tr>	
		<tr>
			<td  class='label '>Notes
			</td>
			<td><input name="notes" id="notes" type="" value="">
			</td>
		</tr>		
		<tr>
			<td  class='label '>Label on CC Receipts
			</td>
			<td><input name="vendor_short_description" id="vendor_short_description" type="" value="">
			</td>
		</tr>			
		<tr>
			<td>&nbsp;
			</td>
			<td><input name="submit" id="submit" type="button" value="add">
			</td>
		</tr>		
	</table>
	
</div>


</div>

<input name="vendor_id" id="vendor_id" type="hidden" value="">

</form>
<div id='hidden_div'>
</div>
</body>
</html>


<?php     	$this->load->view('footer/document_ready_vendor.php');  ?>