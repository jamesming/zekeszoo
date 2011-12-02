							<div id='logo_container' >
								
								<div id='logo'  class=' span-10' >
								</div>
								
								<div  id='login_container' class=' span-14 last'   >

<?php

if( isset($this->session->userdata['user_id']) ){?>
	     	
	     	    
<div id='login_div' class='float_left'>	   
	<?php  $this->load->view('home/account_menu.php');    ?>
</div>
	     	
<?php 	
 


     	
}else{
				$this->load->view('home/twitter_login.php'); 
};
     	
 ?>

									<div id='tabs_div'   >
										
										<div class='tab' ><a id='index' >Today's Deal</a>
										</div>
										<div class='tab'   style='display:none'  ><a id='recentdeals' >Upcoming Deals</a>
										</div>
										<div  class='tab'><a id='howitworks'>How It Works</a>
										</div>
										<div  class='tab'><a id='faq'>FAQ</a>
										</div>				
									</div>
								

								</div>
								
							</div>
							
							
<script type="text/javascript" language="Javascript">
	
	$(document).ready(function() {
		
				$('#tabs_div div.tab a').click(function(event) {
						document.location.href='<?php echo  base_url();   ?>index.php/home/'+ $(this).attr('id');
				});		
				
				$('#tabs_div div.tab a').click(function(event) {
					<?php if( $_SERVER['HTTP_HOST'] == 'zekeszoo.com' ){?>	
												document.location.href='http://zekeszoo.com/index.php/home/'+ $(this).attr('id');
					<?php }else{?>
												document.location.href='<?php echo  base_url();   ?>index.php/home/'+ $(this).attr('id');

					<?php } ?>
				});	
				
				
	});		
	

</script>