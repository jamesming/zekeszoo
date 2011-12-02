<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
</head>

<html>
<style>
.small_header {
    font-weight: bold;
    font-size: 17px;
}
.content_text {
    font-size: 12px;
    margin-bottom: 21px;
}
#outer_container {
    border: 1px solid;
    margin: 10px;
    padding: 18px;
    width:767px;
    height:793px;
}
#outer_container div#logo_div {
    width: 57%;
}
#outer_container div#voucher_number {
    font-size: 68px;
    padding-top: 13px;
    text-align: right;
    width: 43%;
}
#outer_container div#headline {
    font-size: 48px;
    padding: 20px 0px 20px 5px;
    line-height: 0.95;
}
#outer_container div#image_div {
    width: 48%;
    padding-left: 19px;
}
#outer_container div#image_div img {
    border: 1px solid gray;
}
#outer_container div#info_right_div {
    width: 47%;
}
#outer_container div#standard_message_container {
		padding-top: 33px;
		margin-bottom: 95px;
}
#outer_container div#standard_message_container div#standard_message {
    width: 50%;
}
#outer_container div#standard_message_container div#map {
    width: 50%;
}	

#outer_container div#aboutus {
    background: none repeat scroll 0 0 lightgray;
    text-align: center;
    padding: 12px 0px;
}
#outer_container div#legal {
    font-size: 5px;
    padding: 9px 0px;
}

</style>
<body>
	
	<div  id='outer_container' >
		<div>
			
				<div id='logo_div' class=' float_left' >
					<img src='<?php echo base_url().'images/sites/zekeszoo/logo_bw.png'; ?>'>
				</div>
				<div id='voucher_number' class=' float_left'>
					#<?php  echo $deals[0]->user_deal_id   ?>
				</div>			
			
		</div>
		
		<div id='headline' class='clearfix ' >
			<?php echo $deals[0]->deal_headline    ?>
		</div>
		
		<div>
			<div id='image_div' class=' float_left' >
				<img src='<?php echo base_url().'uploads/1/'.$deals[0]->deal_id.'/bw_image.png?random='.rand(5,21231); ?>'>
			</div>
			<div id='info_right_div'  class=' float_left' >
				<div class='small_header clearfix '>Value:
				</div>
				<div class='clearfix content_text'>
					$<?php  echo $deals[0]->deal_price   ?>
				</div> 
				<div class='small_header clearfix '>Issued to:
				</div>
				<div class='clearfix content_text'><?php  echo $deals[0]->first_name   ?> <?php  echo $deals[0]->last_name   ?>
				</div> 
				
				<div class='small_header clearfix '>Expires:
				</div>
				<div class='clearfix content_text'>
					<?php echo  date("F j, Y", strtotime($deals[0]->deal_will_expire) );  ?>
				</div> 		
				<div class='small_header clearfix '>Redeem at:
				</div>
				<div class='clearfix content_text'>
					<?php echo $deals[0]->company_name;  ?><br />
					<?php echo $deals[0]->address;  ?><br />
					<?php echo $deals[0]->city;  ?><br />
					<?php echo $deals[0]->state;  ?><br />
					<?php echo $deals[0]->zipcode;  ?><br />
					<?php echo $deals[0]->vendor_website;  ?><br />
				</div> 		
			</div>
		</div>

	</div>


</body>
</html>

