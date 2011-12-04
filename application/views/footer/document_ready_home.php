
<script type="text/javascript" language="Javascript">

	
$(document).ready(function() {
	
	
				$('#go_button').click(function(event) {
							$.post("<?php echo base_url() ?>index.php/home/insert_email_subscriber",{
								email: $('#email').val(),
								zip:$('#zip').val()
								},function(data) {
								
									alert(data);
							
							});	
				});	
	
				<?php if( $isBadAccount){?>
					
					$(".signin").click();
					$('div#signin_container input#email').css({border:'1px solid red'}).parent().next()
					.slideDown('fast')
					$('div#signin_container input#email').click(function(event) {
						$(this).css({border:'0px solid white'}).parent().next()
						.slideUp('fast')
					});	
					
				<?php }else{?>
					
				<?php } ?>
	
	
	
				<?php if( isset($next_deal[0]) ){?>
					
				var austDay = new Date();
				austDay = new Date(<?php echo $next_deal[0]->year;    ?>, <?php  echo $next_deal[0]->month;   ?> -1, <?php   echo $next_deal[0]->day;  ?>);
				
				$('#defaultCountdown').countdown({
					until: austDay, 
    			layout: '{dn} {dl} {hnn}{sep}{mnn}{sep}{snn}'});
    			
				$('#buynow_image').click(function(event) {
					
					<?php if( $_SERVER['HTTP_HOST'] == 'localhost' ){?>
						document.location.href='<?php echo  base_url();   ?>index.php/home/buy/<?php echo $deal_id    ?>?priority=<?php echo $priority    ?>';

					<?php }else{?>
						document.location.href='https://zekeszoo.com/index.php/home/buy/<?php echo $deal_id    ?>?priority=<?php echo $priority    ?>';
						
					<?php } ?>
				});	

    			

    		<?php }else{?>
    			
    			$('#buynow_text').html('Deal Over');

					
				<?php } ?>
	

	
				$('#logo').click(function(event) {
					<?php if( $_SERVER['HTTP_HOST'] == 'zekeszoo.com' ){?>	
												document.location.href='http://zekeszoo.com/index.php/home';

					<?php }else{?>
												document.location.href='<?php echo  base_url();   ?>index.php/home';

					<?php } ?>
				});	
				


				$('#close_subcribe').click(function(event) {
						$('#subscribe_container').slideUp('slow');
				});	
				
				
				greatest_height_of_onepart = 0;				
				$('#threeparts div.onepart')
					.each(function(){
							if( $(this).height() > greatest_height_of_onepart){	
								greatest_height_of_onepart = $(this).height();
							};
					}).height(greatest_height_of_onepart);
				
				
				
				
				

});		

<?php     	$this->load->view('footer/document_ready_admin.php');  ?>

</script>