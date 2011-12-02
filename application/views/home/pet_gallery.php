<style>
#review_section .middle{
min-height:500px;
}



						#review_section  .middle div#gallery_header{
						    background-image: url(<?php  echo base_url()   ?>images/sites/zekeszoo/gallery.png);
						    background-position: 21px 12px;
						    background-repeat: no-repeat;

						}
						
						#review_section  .middle div#gallery{
							    background: none repeat scroll 0 0 #F8F6F6;
							    margin: 13px auto 0;
							    padding-top: 4px;
							    text-align: center;
							    width: 272px;
							    padding-bottom: 25px;
						}
						
						
									#review_section  .middle div#gallery div.one_public_picture{
									        padding: 3px;
											    border: 1px solid lightgray;
											    width: 158px;
											    margin: 12px auto 25px;
									}	
									
											#review_section  .middle div#gallery div.one_public_picture img{
											    
											}	
							
</style>

		
											<div   id='review_section' >
												
														<div  class=' rounded_bg' >
															<div class="top">
																<div class="sub_top">&nbsp;</div>
															</div>
														  <div class="middle">
																<div class="clearfix">
																	
																	
																	
																	
																<div id='gallery_header'  class=' header_style' >Gallery
																</div>

																<div     id='gallery'  >
																	
																	<?php foreach($public_gallery  as $one_picture){  ?>
																	
																	<div  class=' one_public_picture' bubble_text="<?php echo addslashes(  $one_picture['bubble_text']  );    ?>">
																		<a title='<?php echo addslashes(  $one_picture['bubble_text']  );    ?>' href='<?php echo base_url()    ?>uploads/gallery/<?php echo $one_picture['user_id']    ?>/<?php  echo $one_picture['my_pet_gallery_id']  ?>/image.png' rel='example1' ><img src='<?php echo base_url()    ?>uploads/gallery/<?php  echo $one_picture['user_id']   ?>/<?php  echo $one_picture['my_pet_gallery_id']   ?>/image_tiny.png' /></a>
																	</div>
																	
																	<?php } ?>
																</div>
																	
																	
																	
																	
																	
																</div>
															</div>
															<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
														</div>		
																			
												
											</div>
											
<?php     	$this->load->view('header/colorbox_css.php');  ?><script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/easing/jquery.easing.1.3.js"></script>
<script type="text/javascript" language="Javascript">
/*
 * JQuery Bouncing Speech Bubble Plugin
 * 
 * Version 1.3
 * Looks for the easing plugin and uses "easeInOutElastic" as default easing if it's loaded. Else uses the built-in "swing"
 * WORKS ONLY WITH PIXEL VALUES!!!
 * 
 * by Christian Bruun - 10. Feb 2009
 * 
 * Like it/use it? Send me an e-mail: rockechris@rockechris.com
 * 
 * License: None. Use and abuse. Comes with no warranty, of course!
 * 
 * Usage:
 * $('div/img/etc').bounce({ options });
 *  
 * Options: 
 * picPath:		path to images used ("LL.png", "UL.png", "LR.png" and "UR.png"
 * easing:		easing of the "bouncing"
 * animTime:	animation duration
 * visibleTime:	time the bubble is visible
 * outTime:		duration of fade out
 * force:		force animation direction { "LL", "UL", "LR" or "UR" }
 * wait:		time to wait after event
 * event:		event to trigger the bubble 
 * 
 * 
 * Possible improvements to come:
 * Wait X ms after hover etc event before tringgering popup - cancel popup if mouse moves away
 * 
 */
(function($) {
	$.fn.bounce = function(options) {
	//check for easing plugin
	var ease = 'swing'
	if($.easing.easeInBounce) {
		ease = 'easeOutElastic';
	}

    var defaults = {
		text:		'Rockechris',
		picPath:	'<?php echo base_url()    ?>js/jquery_bubble_bounce/',
		easing:		ease,
		animTime:	2000,
		visibleTime:0,
		outTime:	500,
		force:		'',
		wait:		0,
		event:		'mouseover'
    }
	
    var opts = $.extend(defaults, options);		
	var bubbleWidth = 200;
	var bubbleHeight = 160;
	var theTimeout;

	//preload bildene a
	$("<img>").attr("src", opts.picPath + "UL.png");
	$("<img>").attr("src", opts.picPath + "LL.png");
	$("<img>").attr("src", opts.picPath + "UR.png");
	$("<img>").attr("src", opts.picPath + "LR.png");
	
	
		
    return this.each(function() {
		$(this).after('<div class="bubble_plugin_div"><img src="' + opts.picPath + 'LL.png" alt="" /><p class="bubble_Plugin_p">' + opts.text + '</p></div>');
		var target = this;
		var bubble = $(target).next();
		var img = $(bubble).children().get(0);
		var txt = $(bubble).children().get(1);
		
		$(bubble).css({
			'backgroundColor': 'transparent', 'border': 'none',
			'position':	'absolute', width: '10px', height: '10px',
			left: $(target).offset().left + (parseInt($(target).outerWidth()) / 2) - 5,
			top: $(target).offset().top + (parseInt($(target).outerHeight()) / 2) - 5
		}).hide();
		$(img).css({ width:'100%', height:'100%', 'backgroundColor': 'transparent', 'border': 'none' });
		$(txt).css({
			position:'absolute', top:'50%', height:'1.5em','marginTop':'-1.5em', 'textAlign':'center', width:'90%', 'fontSize':'18px'
		}).hide();
		var isAnimating = false;
		var whereTo = null;
		$(target).bind(opts.event, function(e) {
//			theTimeout = setTimeout(function() {
			if (!isAnimating) {
				//reset bobla
				$(bubble).css({
					width: '10px', height: '10px',
					left: $(target).offset().left + (parseInt($(target).outerWidth()) / 2) - 5,
					top: $(target).offset().top + (parseInt($(target).outerHeight()) / 2) - 5
				});
				
				// Where to?
				if(opts.force.length > 0) {
					opts.force = opts.force.toUpperCase();
					if(opts.force == "LL" || opts.force == "SW")
						whereTo = "SW";
					else if(opts.force == "UL" || opts.force == "NW")
						whereTo = "NW"
					else if(opts.force == "LR" || opts.force == "SE")
						whereTo = "SE"
					else if(opts.force == "UR" || opts.force == "NE")
						whereTo = "NE"
					else 
						return;
				}
				else {
					if(($(window).width() / 2) < ($(target).offset().left + $(target).width() / 2)) {
						if(($(window).height() / 2) > (parseInt($(target).offset().top) + parseInt($(target).height() / 2)))
							whereTo = "SW";
						else
							whereTo = "NW";
					}
					else {
						if(($(window).height() / 2) > (parseInt($(target).offset().top) + parseInt($(target).height() / 2)))
							whereTo = "SE";
						else
							whereTo = "NE";
					}
				}
				
				switch(whereTo) {
					case 'SW' :
						$(txt).css({ 'marginTop': '-0.5em' });
						$(img).attr('src', opts.picPath + "LL.png");
						isAnimating = true;
						setTimeout(function() {
							$(bubble).show().animate({ left:'-='+bubbleWidth, width: bubbleWidth, height: bubbleHeight }, opts.animTime, opts.easing, function(){
								setTimeout(function() {
									$(bubble).fadeOut(opts.outTime, function(){
										isAnimating = false; $(txt).hide();
									});
								}, opts.visibleTime);
							});
							$(txt).fadeIn(opts.animTime);
						}, opts.wait);
						break;
					case 'NW' :
						$(txt).css({ 'marginTop': '-2em' });
						$(img).attr('src', opts.picPath + "UL.png");
						isAnimating = true;
						setTimeout(function() {
							$(bubble).show().animate({ left:'-='+bubbleWidth, top: '-='+bubbleHeight, width: bubbleWidth, height: bubbleHeight }, opts.animTime, opts.easing, function(){
								setTimeout(function() {
									$(bubble).fadeOut(opts.outTime, function(){
										isAnimating = false; $(txt).hide();
									});
								}, opts.visibleTime);
							});
							$(txt).fadeIn(opts.animTime);
						}, opts.wait);						
						break;
					case 'SE' :
						$(txt).css({ 'marginTop': '-0.5em' });
						$(img).attr('src', opts.picPath + "LR.png");
						isAnimating = true;
						setTimeout(function() {
							$(bubble).show().animate({ width: bubbleWidth, height: bubbleHeight }, opts.animTime, opts.easing, function(){
								setTimeout(function() {
									$(bubble).fadeOut(opts.outTime, function(){
										isAnimating = false; $(txt).hide();
									});
								}, opts.visibleTime);
							});
							$(txt).fadeIn(opts.animTime);
						}, opts.wait);					
						break;
					case 'NE' :
						$(txt).css({ 'marginTop': '-2em' });
						$(img).attr('src', opts.picPath + "UR.png");
						isAnimating = true;
						setTimeout(function() {
							$(bubble).show().animate({
								top: '-='+bubbleHeight, width: bubbleWidth, height: bubbleHeight}, opts.animTime, opts.easing, function(){
								setTimeout(function() {
									$(bubble).fadeOut(opts.outTime, function(){
										isAnimating = false; $(txt).hide();
									});
								}, opts.visibleTime);
							});
							$(txt).fadeIn(opts.animTime);
						}, opts.wait);
						break;
				}
			}
//			}			
		})
	});
}
})(jQuery);

</script>
<script type="text/javascript" language="Javascript">		
	$(document).ready(function() {
		
		$("a[rel='example1']").colorbox();
						
//		$('.one_public_picture').each(function(){
//		
//				$(this).bounce({ 'text': $(this).attr('bubble_text')});
//						        
//		});
	});						

</script>
	