
<html>
<head>
	<?php  $this->load->view('header/blueprint_css.php');   ?>
	
	<style>
		body {
		    padding: 14px 21px;
		}
		#today{
			color: red; 
			font-weight: bold;
			}
		.titleMonth{
			font-weight: bold;
			font-size:30px;
			margin:0 40px 0 40px;
			}
		.calendar td{
			cursor:pointer;
			border:1px solid gray;
			width:65px;
			height:50px
			}
					.calendar td.booked_current_deal{
							background:lightgreen;
						}
						
					.calendar td.deal_has_customers{
							background:orange;
						}	
						
					.calendar td.booked_other_deal{
							background:yellow;
						}
					.deal_names{
							text-align:center;
							color:#2E9AFE;
								
					}						
	</style>
	

	<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
	


	<script type="text/javascript" language="Javascript">
		

					$(document).ready(function() { 
						
						
						<?php foreach( $booked as $one_booked){?>
							
							
	
										<?php if(  (int)$one_booked['howmany']  > 0){?>
											
											  $(".calendar td[day=<?php echo $one_booked['day'];    ?>]").addClass('deal_has_customers');

										<?php }elseif( $one_booked['deal_id'] == $deal_id){?>
											
												$(".calendar td[day=<?php echo $one_booked['day'];    ?>]").addClass('booked_current_deal');
											
										<?php }else{?>
											
												$(".calendar td[day=<?php echo $one_booked['day'];    ?>]").addClass('booked_other_deal');
											
										<?php } ?>
										
										$(".calendar td[day=<?php echo $one_booked['day'];    ?>]").append("<div  class=' deal_names' ><?php echo $one_booked['deal_name'];    ?></div>");
									
							
						<?php } ?>
						
						
						
						

	
						$(".calendar td").click(function(event) {
							
							var calendar_td = $(this);
							
							

							
							if( calendar_td.hasClass('booked_other_deal') ){
			
								alert('You can not book a deal on a day already reserved.');
						
							}else if( calendar_td.hasClass('deal_has_customers') ){
								
								alert('You can not book a deal that already has customers.');	
								
							}else{

											
													if( calendar_td.hasClass('booked_current_deal') ){
														
																	$.post("<?php echo base_url(). 'index.php/home/remove_from_calendar/'. $deal_id; ?>?random=<?php  echo rand(5,93294)   ?>",{
																		month:$(this).attr('month'),
																		day:$(this).attr('day'),
																		year:$(this).attr('year')
																		},function(data) {
			
																				calendar_td.removeClass('booked_current_deal');
																				calendar_td.children('div.deal_names').remove();
			
																		});		
											
													}else{
			
																	$.post("<?php echo base_url(). 'index.php/home/add_to_calendar/'. $deal_id; ?>?random=<?php  echo rand(5,93294)   ?>",{
																		month:$(this).attr('month'),
																		day:$(this).attr('day'),
																		year:$(this).attr('year')
																		},function(data) {
			alert(data);
																				calendar_td.addClass('booked_current_deal');
																				calendar_td.append("<div  class=' deal_names' >" + data +  "</div>");
			
																		});								
													}


										
										
							};
							
	


					   });
					   
					   

					   
					});
					
					
					function switch_month( when_month ){
						if( when_month  == 'last'){
							$('#goto_month').val( $('#last').val()  );
						}else{
							$('#goto_month').val( $('#next').val()  );
						};
						
						//alert(when_month);
						$('#form0').submit();
						
					}

</script>
	
</head>
<body>
	
<?php



if( $goto_month !='' ){
	$month = $goto_month;
}else{
	$month = date("m");
};


if( $year == ''){
	$year = date("Y");
};




$last = $month - 1;
$next = $month + 1;

if( $next == 14){
	 $next = 2;
	 $month = 1;
	 $year  = $year + 1;
};

if( $last == -1){
	 $last = 11;
	 $month = 12;
	 $year  = $year - 1;
};

$time = time();

?>
<form   style='display:none'   id='form0'  name="form0" action="<?php echo base_url();   ?>index.php/home/calendar/<?php echo $deal_id;    ?>" method="get"   >
	last	<input id="last" name="last" type="text" value="<?php  echo $last  ?>"><br>
	next	<input id="next" name="next" type="text" value="<?php  echo $next  ?>"><br>
	year	<input id="year" name="year" type="text" value="<?php  echo $year  ?>"><br>
	goto	<input id="goto_month" name="goto_month" type="text" value="<?php echo $goto_month;    ?>">
	goto	<input name="priority" type="text" value="<?php echo $priority;    ?>">
</form>

<?php     

$today = date('j',$time);

if( $month == date("m") ){
	$days = array(
    $today=>array(NULL,NULL,'<span id=\'today\'>'.$today.'</span>'),
	);
}else{
	$days = array();
};

$lastMonth = $month - 1;
$nextMonth = $month + 1;

$prev_or_next = array("<b   style='cursor:pointer;font-size:40px'   onclick=switch_month('last')>&laquo;</b>"=>"?month=".$lastMonth."&deal_id=", "<b     style='cursor:pointer;font-size:40px'   onclick=switch_month('next')>&raquo;</b>"=>"?month=".$nextMonth."&deal_id=");



echo $this->calendar->generate_calendar($year , $month, $days, $day_of_the_week_is_shown=4, NULL, 0, $prev_or_next);
?>	
	
</body>
</html>





