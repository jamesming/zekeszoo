
<script type="text/javascript" language="Javascript">

	
$(document).ready(function() {
	
	
				<?php if( $this->input->get('share') == 'facebook'){?>
					$('#facebook_share_link').click();	
				<?php } ?>
				
				<?php if( $this->input->get('share') == 'twitter'){?>
					$('#twitter_share_link').click();	
				<?php } ?>				
	

	
				<?php if( $isBadAccount){?>
					
					$(".signin").click();
					$('div#signin_container input#email, div#signin_container input#password').css({border:'1px solid red'}).parent().next()
					.slideDown('slow')
					$('div#signin_container input#email, div#signin_container input#password').click(function(event) {
						$(this).css({border:'0px solid white'}).parent().next()
						.slideUp('slow')
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
    			
    			$('#buynow_text').html('Sold Out');

					
				<?php } ?>
	

	
				$('#logo').click(function(event) {
					<?php if( $_SERVER['HTTP_HOST'] == 'zekeszoo.com' ){?>	
												document.location.href='<?php  echo base_url().'index.php/home/deal/'.$deal_url   ?>?v=2';

					<?php }else{?>
												document.location.href='<?php  echo base_url().'index.php/home/deal/'.$deal_url   ?>?v=2';

					<?php } ?>
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