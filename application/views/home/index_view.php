<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<?php     	$this->load->view('header/top_header_css.php');  ?>
<?php     	$this->load->view('header/homepage_css.php');  ?>
<?php				if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){
						$this->load->view('header/control_panel_css.php');  
						}; ?>
<?php     	$this->load->view('footer/footer_section_css.php');  ?>


<META NAME="KEYWORDS" CONTENT="zekeszoo, zekes zoo, pet deals, pet savings, pet discounts, cat deals, dog deals, cat discounts, dog discounts, dog toy deals, dog food deals, dog deal discounts, dog toy discounts, organic pet products, pet tips, best pet food deals, coupon codes for pet food, coupon codes for pet products">
<META NAME="DESCRIPTION" CONTENT="<?php echo strip_tags(  ( isset( $deals[0]->deal_share_headline) ? $deals[0]->deal_share_headline:'' ))    ?>">
<TITLE><?php echo strip_tags(  ( isset( $deals[0]->deal_share_headline) ? $deals[0]->deal_share_headline:'' ))    ?></TITLE>
<META HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="EN">
<META NAME="revisit-after" CONTENT="14 days">
<META NAME="Generator" CONTENT="http://websitesubmit.hypermart.net/">
<META NAME="robots" CONTENT="all">
<META NAME="Author" CONTENT="john">
<!-- MetaTags http://websitesubmit.hypermart.net/ -->
<!-- discounted deals for pet products -->
<link rel="shortcut icon" href="<?php echo base_url()    ?>images/favicon.ico">


<meta property="og:title"  content="<?php echo rtrim(strip_tags(  ( isset( $deals[0]->deal_share_headline) ? $deals[0]->deal_share_headline:'' )))    ?>"/>
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php  echo base_url().'index.php/home/deal/'.$deal_url   ?>?v=2" />
<meta property="og:image" content="<?php echo base_url(); ?>uploads/1/<?php echo  ( isset( $deals[0]->id) ? $deals[0]->id:'' )   ?>/image_tiny.png" />
<meta property="og:site_name" content="Zekeszoo.com" />
<meta property="fb:app_id" content="245890495426188" />
<meta property="og:description" content="<?php echo strip_tags(  ( isset( $deals[0]->deal_share_headline) ? $deals[0]->deal_headline:'' ))    ?>"
      />

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo  base_url();   ?>js/jquery.scrollTo-min.js"></script>
<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery_countdown.js"></script>
	<script type="text/javascript" language="Javascript">
	(function($){
	
	//closeDOMWindow
	$.fn.closeDOMWindow = function(settings){
		
		if(!settings){settings={};}
		
		var run = function(passingThis){
			
			if(settings.anchoredClassName){
				var $anchorClassName = $('.'+settings.anchoredClassName);
				$anchorClassName.fadeOut('fast',function(){
					if($.fn.draggable){
						$anchorClassName.draggable('destory').trigger("unload").remove();	
					}else{
						$anchorClassName.trigger("unload").remove();
					}
				});
				if(settings.functionCallOnClose){settings.functionCallAfterClose();}
			}else{
				var $DOMWindowOverlay = $('#DOMWindowOverlay');
				var $DOMWindow = $('#DOMWindow');
				$DOMWindowOverlay.fadeOut('fast',function(){
					$DOMWindowOverlay.trigger('unload').unbind().remove();																	  
				});
				$DOMWindow.fadeOut('fast',function(){
					if($.fn.draggable){
						$DOMWindow.draggable("destroy").trigger("unload").remove();
					}else{
						$DOMWindow.trigger("unload").remove();
					}
				});
			
				$(window).unbind('scroll.DOMWindow');
				$(window).unbind('resize.DOMWindow');
				
				if($.fn.openDOMWindow.isIE6){$('#DOMWindowIE6FixIframe').remove();}
				if(settings.functionCallOnClose){settings.functionCallAfterClose();}
			}	
		};
		
		if(settings.eventType){//if used with $().
			return this.each(function(index){
				$(this).bind(settings.eventType, function(){
					run(this);
					return false;
				});
			});
		}else{//else called as $.function
			run();
		}
		
	};
	
	//allow for public call, pass settings
	$.closeDOMWindow = function(s){$.fn.closeDOMWindow(s);};
	
	//openDOMWindow
	$.fn.openDOMWindow = function(instanceSettings){	
		
		var shortcut =  $.fn.openDOMWindow;
	
		//default settings combined with callerSettings////////////////////////////////////////////////////////////////////////
		
		shortcut.defaultsSettings = {
			anchoredClassName:'',
			anchoredSelector:'',
			borderColor:'#ccc',
			borderSize:'0',
			draggable:0,
			eventType:null, //click, blur, change, dblclick, error, focus, load, mousedown, mouseout, mouseup etc...
			fixedWindowY:100,
			functionCallOnOpen:null,
			functionCallOnClose:null,
			height:500,
			loader:0,
			loaderHeight:0,
			loaderImagePath:'',
			loaderWidth:0,
			modal:0,
			overlay:1,
			overlayColor:'#000',
			width:500, 
			windowBGColor:'transparent',
			windowBGImage:null, // http path
			windowHTTPType:'get',
			windowPadding:0,
			windowSource:'inline', //inline, ajax, iframe
			windowSourceID:'',
			windowSourceURL:'',
			windowSourceAttrURL:'href'
		};
		
		var settings = $.extend({}, $.fn.openDOMWindow.defaultsSettings , instanceSettings || {});
		
		//Public functions
		
		shortcut.viewPortHeight = function(){ return self.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;};
		shortcut.viewPortWidth = function(){ return self.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;};
		shortcut.scrollOffsetHeight = function(){ return self.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;};
		shortcut.scrollOffsetWidth = function(){ return self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft;};
		shortcut.isIE6 = typeof document.body.style.maxHeight === "undefined";
		
		//Private Functions/////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		var sizeOverlay = function(){
			var $DOMWindowOverlay = $('#DOMWindowOverlay');
			if(shortcut.isIE6){//if IE 6
				var overlayViewportHeight = document.documentElement.offsetHeight + document.documentElement.scrollTop - 4;
				var overlayViewportWidth = document.documentElement.offsetWidth - 21;
				$DOMWindowOverlay.css({'height':overlayViewportHeight +'px','width':overlayViewportWidth+'px'});
			}else{//else Firefox, safari, opera, IE 7+
				$DOMWindowOverlay.css({'height':'100%','width':'100%','position':'fixed'});
			}	
		};
		
		var sizeIE6Iframe = function(){
			var overlayViewportHeight = document.documentElement.offsetHeight + document.documentElement.scrollTop - 4;
			var overlayViewportWidth = document.documentElement.offsetWidth - 21;
			$('#DOMWindowIE6FixIframe').css({'height':overlayViewportHeight +'px','width':overlayViewportWidth+'px'});
		};
		
		var centerDOMWindow = function() {
			var $DOMWindow = $('#DOMWindow');
			if(settings.height + 50 > shortcut.viewPortHeight()){//added 50 to be safe
				$DOMWindow.css('left',Math.round(shortcut.viewPortWidth()/2) + shortcut.scrollOffsetWidth() - Math.round(($DOMWindow.outerWidth())/2));
			}else{
				$DOMWindow.css('left',Math.round(shortcut.viewPortWidth()/2) + shortcut.scrollOffsetWidth() - Math.round(($DOMWindow.outerWidth())/2));
				$DOMWindow.css('top',Math.round(shortcut.viewPortHeight()/2) + shortcut.scrollOffsetHeight() - Math.round(($DOMWindow.outerHeight())/2));
			}
		};
		
		var centerLoader = function() {
			var $DOMWindowLoader = $('#DOMWindowLoader');
			if(shortcut.isIE6){//if IE 6
				$DOMWindowLoader.css({'left':Math.round(shortcut.viewPortWidth()/2) + shortcut.scrollOffsetWidth() - Math.round(($DOMWindowLoader.innerWidth())/2),'position':'absolute'});
				$DOMWindowLoader.css({'top':Math.round(shortcut.viewPortHeight()/2) + shortcut.scrollOffsetHeight() - Math.round(($DOMWindowLoader.innerHeight())/2),'position':'absolute'});
			}else{
				$DOMWindowLoader.css({'left':'50%','top':'50%','position':'fixed'});
			}
			
		};
		
		var fixedDOMWindow = function(){
			var $DOMWindow = $('#DOMWindow');
			$DOMWindow.css('left', settings.positionLeft + shortcut.scrollOffsetWidth());
			$DOMWindow.css('top', + settings.positionTop + shortcut.scrollOffsetHeight());
		};
		
		var showDOMWindow = function(instance){
			if(arguments[0]){
				$('.'+instance+' #DOMWindowLoader').remove();
				$('.'+instance+' #DOMWindowContent').fadeIn('fast',function(){if(settings.functionCallOnOpen){settings.functionCallOnOpen();}});
				$('.'+instance+ '.closeDOMWindow').click(function(){
					$.closeDOMWindow();	
					return false;
				});
			}else{
				$('#DOMWindowLoader').remove();
				$('#DOMWindow').fadeIn('fast',function(){if(settings.functionCallOnOpen){settings.functionCallOnOpen();}});
				$('#DOMWindow .closeDOMWindow').click(function(){						
					$.closeDOMWindow();
					return false;
				});
			}
			
		};
		
		var urlQueryToObject = function(s){
			  var query = {};
			  s.replace(/b([^&=]*)=([^&=]*)b/g, function (m, a, d) {
				if (typeof query[a] != 'undefined') {
				  query[a] += ',' + d;
				} else {
				  query[a] = d;
				}
			  });
			  return query;
		};
			
		//Run Routine ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
		var run = function(passingThis){
			
			//get values from element clicked, or assume its passed as an option
			settings.windowSourceID = $(passingThis).attr('href') || settings.windowSourceID;
			settings.windowSourceURL = $(passingThis).attr(settings.windowSourceAttrURL) || settings.windowSourceURL;
			settings.windowBGImage = settings.windowBGImage ? 'background-image:url('+settings.windowBGImage+')' : '';
			var urlOnly, urlQueryObject;
			
			if(settings.positionType == 'anchored'){//anchored DOM window
				
				var anchoredPositions = $(settings.anchoredSelector).position();
				var anchoredPositionX = anchoredPositions.left + settings.positionLeft;
				var anchoredPositionY = anchoredPositions.top + settings.positionTop;
				
				$('body').append('<div class="'+settings.anchoredClassName+'" style="'+settings.windowBGImage+';background-repeat:no-repeat;padding:'+settings.windowPadding+'px;overflow:auto;position:absolute;top:'+anchoredPositionY+'px;left:'+anchoredPositionX+'px;height:'+settings.height+'px;width:'+settings.width+'px;background-color:'+settings.windowBGColor+';border:'+settings.borderSize+'px solid '+settings.borderColor+';z-index:10001"><div id="DOMWindowContent" style="display:none"></div></div>');		
				//loader
				if(settings.loader && settings.loaderImagePath !== ''){
					$('.'+settings.anchoredClassName).append('<div id="DOMWindowLoader" style="width:'+settings.loaderWidth+'px;height:'+settings.loaderHeight+'px;"><img src="'+settings.loaderImagePath+'" /></div>');
					
				}
	
				if($.fn.draggable){
					if(settings.draggable){$('.' + settings.anchoredClassName).draggable({cursor:'move'});}
				}
				
				switch(settings.windowSource){
					case 'inline'://////////////////////////////// inline //////////////////////////////////////////
						$('.' + settings.anchoredClassName+" #DOMWindowContent").append($(settings.windowSourceID).children());
						$('.' + settings.anchoredClassName).unload(function(){// move elements back when you're finished
							$('.' + settings.windowSourceID).append( $('.' + settings.anchoredClassName+" #DOMWindowContent").children());				
						});
						showDOMWindow(settings.anchoredClassName);
					break;
					case 'iframe'://////////////////////////////// iframe //////////////////////////////////////////
						$('.' + settings.anchoredClassName+" #DOMWindowContent").append('<iframe frameborder="0" hspace="0" wspace="0" src="'+settings.windowSourceURL+'" name="DOMWindowIframe'+Math.round(Math.random()*1000)+'" style="width:100%;height:100%;border:none;background-color:#fff;" class="'+settings.anchoredClassName+'Iframe" ></iframe>');
						$('.'+settings.anchoredClassName+'Iframe').load(showDOMWindow(settings.anchoredClassName));
					break;
					case 'ajax'://////////////////////////////// ajax //////////////////////////////////////////	
						if(settings.windowHTTPType == 'post'){
							
							if(settings.windowSourceURL.indexOf("?") !== -1){//has a query string
								urlOnly = settings.windowSourceURL.substr(0, settings.windowSourceURL.indexOf("?"));
								urlQueryObject = urlQueryToObject(settings.windowSourceURL);
							}else{
								urlOnly = settings.windowSourceURL;
								urlQueryObject = {};
							}
							$('.' + settings.anchoredClassName+" #DOMWindowContent").load(urlOnly,urlQueryObject,function(){
								showDOMWindow(settings.anchoredClassName);
							});
						}else{
							if(settings.windowSourceURL.indexOf("?") == -1){ //no query string, so add one
								settings.windowSourceURL += '?';
							}
							$('.' + settings.anchoredClassName+" #DOMWindowContent").load(
								settings.windowSourceURL + '&random=' + (new Date().getTime()),function(){
								showDOMWindow(settings.anchoredClassName);
							});
						}
					break;
				}
				
			}else{//centered, fixed, absolute DOM window
				
				//overlay & modal
				if(settings.overlay){
					$('body').append('<div id="DOMWindowOverlay" style="z-index:10000;display:none;position:absolute;top:0;left:0;background-color:'+settings.overlayColor+';filter:alpha(opacity='+settings.overlayOpacity+');-moz-opacity: 0.'+settings.overlayOpacity+';opacity: 0.'+settings.overlayOpacity+';"></div>');
					if(shortcut.isIE6){//if IE 6
						$('body').append('<iframe id="DOMWindowIE6FixIframe"  src="blank.html"  style="width:100%;height:100%;z-index:9999;position:absolute;top:0;left:0;filter:alpha(opacity=0);"></iframe>');
						sizeIE6Iframe();
					}
					sizeOverlay();
					var $DOMWindowOverlay = $('#DOMWindowOverlay');
					$DOMWindowOverlay.fadeIn('fast');
					if(!settings.modal){
						$DOMWindowOverlay.click(function(){
							$.closeDOMWindow(); // DISABLE USER CLICKS ON SHADED BACKGROUND
						});
					}
				}
				
				//loader
				if(settings.loader && settings.loaderImagePath !== ''){
					$('body').append('<div id="DOMWindowLoader" style="z-index:10002;width:'+settings.loaderWidth+'px;height:'+settings.loaderHeight+'px;"><img src="'+settings.loaderImagePath+'" /></div>');
					centerLoader();
				}
	
				//add DOMwindow
				$('body').append('<div id="DOMWindow" style="background-repeat:no-repeat;'+settings.windowBGImage+';overflow:auto;padding:'+settings.windowPadding+'px;display:none;height:'+settings.height+'px;width:'+settings.width+'px;background-color:'+settings.windowBGColor+';border:'+settings.borderSize+'px solid '+settings.borderColor+'; position:absolute;z-index:10001"></div>');
				
				var $DOMWindow = $('#DOMWindow');
				//centered, absolute, or fixed
				switch(settings.positionType){
					case 'centered':
						centerDOMWindow();
						if(settings.height + 50 > shortcut.viewPortHeight()){//added 50 to be safe
							$DOMWindow.css('top', (settings.fixedWindowY + shortcut.scrollOffsetHeight()) + 'px');
						}
					break;
					case 'absolute':
						$DOMWindow.css({'top':(settings.positionTop+shortcut.scrollOffsetHeight())+'px','left':(settings.positionLeft+shortcut.scrollOffsetWidth())+'px'});
						if($.fn.draggable){
							if(settings.draggable){$DOMWindow.draggable({cursor:'move'});}
						}
					break;
					case 'fixed':
						fixedDOMWindow();
					break;
					case 'anchoredSingleWindow':
						var anchoredPositions = $(settings.anchoredSelector).position();
						var anchoredPositionX = anchoredPositions.left + settings.positionLeft;
						var anchoredPositionY = anchoredPositions.top + settings.positionTop;
						$DOMWindow.css({'top':anchoredPositionY + 'px','left':anchoredPositionX+'px'});
								
					break;
				}
				
				$(window).bind('scroll.DOMWindow',function(){
					if(settings.overlay){sizeOverlay();}
					if(shortcut.isIE6){sizeIE6Iframe();}
					if(settings.positionType == 'centered'){centerDOMWindow();}
					if(settings.positionType == 'fixed'){fixedDOMWindow();}
				});
	
				$(window).bind('resize.DOMWindow',function(){
					if(shortcut.isIE6){sizeIE6Iframe();}
					if(settings.overlay){sizeOverlay();}
					if(settings.positionType == 'centered'){centerDOMWindow();}
				});
				
				switch(settings.windowSource){
					case 'inline'://////////////////////////////// inline //////////////////////////////////////////
						$DOMWindow.append($(settings.windowSourceID).children());
						$DOMWindow.unload(function(){// move elements back when you're finished
							$(settings.windowSourceID).append($DOMWindow.children());				
						});
						showDOMWindow();
					break;
					case 'iframe'://////////////////////////////// iframe //////////////////////////////////////////
						$DOMWindow.append('<iframe frameborder="0" hspace="0" wspace="0" src="'+settings.windowSourceURL+'" name="DOMWindowIframe'+Math.round(Math.random()*1000)+'" style="width:100%;height:100%;border:none;background-color:#fff;" id="DOMWindowIframe" ></iframe>');
						$('#DOMWindowIframe').load(showDOMWindow());
					break;
					case 'ajax'://////////////////////////////// ajax //////////////////////////////////////////
						if(settings.windowHTTPType == 'post'){
							
							if(settings.windowSourceURL.indexOf("?") !== -1){//has a query string
								urlOnly = settings.windowSourceURL.substr(0, settings.windowSourceURL.indexOf("?"));
								urlQueryObject = urlQueryToObject(settings.windowSourceURL);
							}else{
								urlOnly = settings.windowSourceURL;
								urlQueryObject = {};
							}
							$DOMWindow.load(urlOnly,urlQueryObject,function(){
								showDOMWindow();
							});
						}else{
							if(settings.windowSourceURL.indexOf("?") == -1){ //no query string, so add one
								settings.windowSourceURL += '?';
							}
							$DOMWindow.load(
								settings.windowSourceURL + '&random=' + (new Date().getTime()),function(){
								showDOMWindow();
							});
						}
					break;
				}
				
			}//end if anchored, or absolute, fixed, centered
			
		};//end run()
		
		if(settings.eventType){//if used with $().
			return this.each(function(index){				  
				$(this).bind(settings.eventType,function(){
					run(this);
					return false;
				});
			});	
		}else{//else called as $.function
			run();
		}
		
	};//end function openDOMWindow
	
	//allow for public call, pass settings
	$.openDOMWindow = function(s){$.fn.openDOMWindow(s);};
	
	})(jQuery);
	</script>	 
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28517226-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>



<body>
<div id="very_top"><div>
<?php
     	$this->load->view('misc/launch_modal.php');  
     	$this->load->view('misc/multi_deal_bubble.php');  
?>

	
<?php     	$this->load->view('header/email_subscribe.php');  ?>
	
	
<div id='top_body'  class='  clearfix' >
	<div id='sunrise'  class=' container' >

<?php     	$this->load->view('header/top_header.php');  ?>
							
							<div  class='clearfix container' id='main_section_container'   >
								
								<div   id='main_section'    class='container_inside'   >
									
										<div  class=' rounded_bg ' >
											<div class="top">
												<div class="sub_top">&nbsp;</div>
											</div>
										  <div class="middle">
												<div class="clearfix">
													
													
													<div table='deals' id='deal_headline'   href='#wysiwyg_div'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal" >
														
														<?php
																	if( isset( $deals[0]->deal_headline  ) ){
																		echo $deals[0]->deal_headline;
																	}else{?>
																		Click here to enter a headline for "<?php  echo ( isset( $deals[0]->deal_name) ? $deals[0]->deal_name:'' );  ?>" in this line.  It should encompass two lines.
																	<?php
																	};
														     ?>
													</div>
													
													
													<div id='deal_image_buynow_container' class='  margin_top' >
														
														
														<div id='deal_image'   class='float_left elements_to_hide_when_adding_deal'   >
															
															<?php 
															$filename = 'uploads/'.$site_id.'/'.$deal_id.'/image.png';
															
															if (file_exists($filename)) {?>
															   <img id='img_deal' src='<?php echo base_url()    ?>uploads/<?php echo $site_id;    ?>/<?php echo $deal_id;    ?>/image.png?random=<?php echo  rand(5,123341);   ?>' />
															   <?php     					
															} else {?>
																<div   style='padding-top:100px;text-align:center;font-size:30px;color:gray;font-weight:bold'  > click to upload file
																</div>
															   
															<?php
															 }    
															?>
														</div>
														

														
														<div id='buynow'   class=' float_left'>
															<div id='value_compare'>
																
																
																<div id='value_div' >Value<br />$<span id='orig_price_on_website'  class=' elements_to_hide_when_adding_deal' ><?php  echo  ( isset( $deals[0]->orig_price) ? $deals[0]->orig_price:'' );   ?></span>
																</div>
																<div id='discount_div' >Discount<br /><span id='discount'  class=' elements_to_hide_when_adding_deal' ><?php  echo $discount;   ?></span>%
																</div>
																<div id='savings_div' >Savings<br />$<span id='savings'  class=' elements_to_hide_when_adding_deal' ><?php  echo $savings;   ?></span>
																</div>
																
																
															</div>
															
															
															
															<div id='buynow_image'>
																
																<div id='buynow_image_dollar_sign' class=' float_left'>$
																</div>
																<div id='deal_price_on_website' class='elements_to_hide_when_adding_deal float_left'><?php  echo  ( isset( $deals[0]->deal_price) ? $deals[0]->deal_price:'' );   ?>
																</div>
																<div id='buynow_text' class=' float_left'   >
																	
																	
																	<?php if($howmany_left > 0 ){?>
																			BUY NOW
																	<?php }else{?>
																			SOLD OUT
																	<?php } ?>
																	
																	
																</div>
																
																
															</div>
				
															<div id='countdown_container'>
																<div id='hourglass_container'>
																	<img src='<?php  echo base_url()   ?>images/hourglass.png'  />
																</div>
																<div  >Time Left To Buy<br />
																	<span id='defaultCountdown'></span>
																</div>
															</div>
																										
															
															<div id='bought_container' >
																
																<div id='bought_div' class=' clearfix'     style='display:none'    >
																	<span id='bought'><?php echo $bought_so_far    ?></span> bought / 
																	<?php echo $howmany_left    ?> left
																</div>
																
																
																		<?php if( $deal_is_on ){?>
																		
																							<div id='bought_container_middle' class=' clearfix'    style='display:none' >
																								<div id='checkbox_container' class=' float_left'>
																									<img src='<?php echo base_url()    ?>images/checkbox.jpg'/>
																									
																								</div>
																								<div id='deal_is' class=' float_left'>
																									The deal is on!
																								</div>
																							</div>
																							
																							
																							
																							<div id='tipped_at_div' class=' clearfix'   style='display:none'  >
																								Tipped on 
																								<span><?php echo  date("F j,", strtotime($tipped_time) ) . ' at ' . date("g:i a", strtotime($tipped_time) );  ?></span> 
																								with 
																								<span id='bought_tipping_point'><?php echo ( isset( $deals[0]->minimum_quantity) ? $deals[0]->minimum_quantity:'' )    ?></span> bought
																							</div>																							
																							
																																									
																		
																		
																		<?php }else{?>
																		
																							
																							<div id='bought_container_middle' class=' clearfix'   style='display:none' >
																								<div id='checkbox_container' class=' float_left'>
																									<img src='<?php echo base_url()    ?>images/checkbox.jpg'/>
																									
																								</div>
																								<div id='deal_is' class=' float_left'>
																									<?php  echo $count_of_buyers_needed_to_tip_deal  ?> more needed!
																								</div>
																							</div>																			
																																					

																		<?php } ?>
																



																
																<div id='share_container' class='social_share_div clearfix' >
<div  id='share_text'>
	Share this deal:					
</div>
<table  id='social_table'>
	<tr>
		
		<td   style='display:none'  >
		
				<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fzekeszoo.com/index.php/home/deal/<?php  echo $deal_url   ?>&amp;send=false&amp;layout=box_count&amp;width=150&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:90px;" allowTransparency="true"></iframe>

		</td>		
		<td  id='facebook_td'    style='padding-top:47px;'   >
			<script>
				function fbs_click() {
					u=location.href;
					t=document.title;
					window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
				</script>
				<style> 
					html .fb_share_link { 
						padding:2px 0 0 20px; 
						height:16px; 
						/*background:url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top left;*/
						background:url(<?php echo base_url()    ?>images/fb.gif) no-repeat top left;
					}
				</style>
				<a  id='facebook_share_link' style='height:40px;padding-top:40px;padding-left:0px; font-size:12px;font-weight:bold'  rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" class="fb_share_link">
				&nbsp;Share&nbsp;&nbsp;&nbsp;
				</a>
		</td>
		<td  id='twitter_td'>
			
			<a 
				id='twitter_share_link' 
				href="http://twitter.com/share" 
				class="twitter-share-button" 
				data-count="vertical"  
				data-url="http//zekeszoo.com" 
				data-text="<?php echo rtrim(strip_tags(  ( isset( $deals[0]->deal_share_headline) ? $deals[0]->deal_share_headline:'' ))).' -- http://zekeszoo.com/index.php/home/deal/'.$deal_url; ?>"
				>Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			
		</td>
		


	</tr>
	
	
	<tr>
		<td colspan=2>
				<div   table='deals'    href='#wysiwyg_div' id='deal_share_headline'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal"   style='background:yellow;display:none'  >
					
																			<?php     
																			
																					if( isset( $deals[0]->deal_share_headline  ) && $deals[0]->deal_share_headline!=''){
																						echo $deals[0]->deal_share_headline;
																					}else{
																						echo 'Lorem ipsum dolor sit amet.';
																					};
																			
																			?>

					
				</div>
		</td>
	</tr>
	
</table>


																	
																</div>
																
															</div>											
															
														</div>
				
														
													</div>
													
													
												</div>
											</div>
											<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
										</div>		
										
								</div>
								
							</div>
							
							<div  class=' container' >
								
								<div id='description_other_deals_container'  class=' container_inside   margin_top' >
									
										<div id='description_section'  class=' float_left' >
											
											
												<div class=' two_third_column'  >
													
													
													<div  class=' rounded_bg' >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle">
													  	
													  	<div  id='threeparts' class=' clearfix' >
													  		<div  class='float_left onepart ' >
													  			<div  class='onepart_header  clearfix' >
													  				Highlights
													  			</div>
														  		<div table='deals'  href='#wysiwyg_div' id='deal_highlights'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal" >
																																<?php     
																																
																																		if( isset( $deals[0]->deal_highlights  ) &&  $deals[0]->deal_highlights!=''){
																																			echo $deals[0]->deal_highlights;
																																		}else{
																																			echo '
																																						<ul>
																																						<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</li>
																																						<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
																																						<li>Lorem ipsum dolor sit amet,</li>
																																						</ul>											
																																						';
																																		};
																																
																																?>
														  		</div>
													  		</div>

													  		<div  class='float_left onepart'  >
													  			<div  class='onepart_header  clearfix' >
													  				Details
													  			</div>
														  		<div  table='deals'    href='#wysiwyg_div' id='deal_finepoints'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal"   >
																																<?php     
																																
																																		if( isset( $deals[0]->deal_finepoints  ) && $deals[0]->deal_finepoints!='' ){
																																			echo $deals[0]->deal_finepoints;
																																		}else{
																																			echo '
																																						<ul>
																																						<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</li>
																																						<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
																																						<li>Lorem ipsum dolor sit amet,</li>
																																						</ul>											
																																						';
																																		};
																																
																																?>
														  		</div>
													  		</div>
													  		
												  		
													  		
													  		
													  		
													  		<div  class='float_left onepart' >
													  			<div  class='onepart_header  clearfix' >
													  				Company
													  			</div>
														  		<div   id='company'  class="clearfix elements_to_hide_when_adding_deal" >
																		<?php     
																		echo ( isset( $deals[0]->company_name) && $deals[0]->company_name != '' ? $deals[0]->company_name:'' )."<br />";
																		echo ( isset( $deals[0]->address) && $deals[0]->address != '' ? $deals[0]->address."<br />":'' );
																		echo ( isset( $deals[0]->address2) && $deals[0]->address2 != '' ? $deals[0]->address2."<br />":'' );
																		echo ( isset( $deals[0]->city) && $deals[0]->city != '' ? $deals[0]->city.", ":'' );
																		echo ( isset( $deals[0]->state) && $deals[0]->state != '' ? $deals[0]->state."&nbsp;&nbsp;":'' );
																		echo ( isset( $deals[0]->zipcode) && $deals[0]->zipcode != '' ? $deals[0]->zipcode."<br />":'' );
																		echo ( isset( $deals[0]->telephone) &&  $deals[0]->telephone!= '' ? $deals[0]->telephone."<br />":'' );
																		echo "<a target='_blank' href='http://" . ( isset( $deals[0]->vendor_website) ? $deals[0]->vendor_website:'' ) .  "'>http://" . ( isset( $deals[0]->vendor_website) ? $deals[0]->vendor_website:'' ) ."</a><br />";
																		?>			
																																
														  		</div>
													  		</div>														  		
													  		

													  	</div>
													  	

																<div id='deal_description_header' class='clearfix header_style' >
																	Product Description
																</div>
													  	
													  	
																<div   table='deals'    href='#wysiwyg_div' id='deal_description_snippet_for_email'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal"   style='display:none;background:yellow'  >
																	
																															<?php     
																															
																																	if( isset( $deals[0]->deal_description_snippet_for_email  ) && $deals[0]->deal_description_snippet_for_email!=''){
																																		echo $deals[0]->deal_description_snippet_for_email;
																																	}else{
																																		echo 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
																																	};
																															
																															?>
									
																	
																</div>
													  	
													  	
																<div   table='deals'    href='#wysiwyg_div' id='deal_description'  class="wysiwyg_div_link clearfix elements_to_hide_when_adding_deal">
																	
																															<?php     
																															
																																	if( isset( $deals[0]->deal_description  ) ){
																																		echo $deals[0]->deal_description;
																																	}else{
																																		echo 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
																																	};
																															
																															?>
									
																	
																</div>
															
															
															
															
														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>
												
												
												
												
													<div  id='doctorcorner_section'   class=' rounded_bg  margin_top' >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle"  >




																<div id='doc_header' class=' header_style' >Expert's Advice Corner
																</div>
<style>
#expert_advice{
	width:620px;

}
</style>
																<div  table='website'     href='#wysiwyg_div' id='expert_advice'  class="wysiwyg_div_link clearfix "   >

																															<?php     
																															
																																	if( isset( $website[0]->expert_advice  ) && $website[0]->expert_advice !=''){
																																		echo $website[0]->expert_advice ;
																																	}else{
																																		echo 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
																																	};
																															
																															?>
																		
																		
																		
																</div>

															





														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>						
												
												
										
												<div id='other_deals'  class=' margin_top'   style='display:none'  >
													
													
															<div  class=' one_third_column float_left margin_left' >
																		<div  class=' rounded_bg' >
																			<div class="top">
																				<div class="sub_top">&nbsp;</div>
																			</div>
																		  <div class="middle">
																				<div class="clearfix">&nbsp;</div>
																			</div>
																			<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
																		</div>				
															</div>
												
												
															<div  class=' one_third_column  float_left margin_left' >
																		<div  class=' rounded_bg' >
																			<div class="top">
																				<div class="sub_top">&nbsp;</div>
																			</div>
																		  <div class="middle">
																				<div class="clearfix">&nbsp;</div>
																			</div>
																			<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
																		</div>				
															</div>						
															
															
												</div>
							
									
									
									
										</div>
										
										<div  class=' one_third_column float_left margin_left'>
											
											<?php
											 // $this->load->view('home/pet_gallery.php');   
											
											?>
											
											
											
											<div   style='margin:0px 0px 10px 0px;display:none'  >
												<img src='<?php  echo base_url()   ?>images/charity.png' />
											</div>
											
											
											<?php
											  $this->load->view('home/facebook_likebox.php');   
											?>
											
											

											
												
												
										</div>		
										
								</div>
							
							</div>
					
				</div>



	</div>



	

<?php     	
$this->load->view('footer/footer_section.php');  
if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1 ){
	$this->load->view('home/control_panel.php');
};
?>

</body>
</html>


<?php  

if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){
	
	$this->load->view('footer/jquery_ui_for_dialog.php');
	$this->load->view('footer/wysiwyg_jquery_with_iframe.php');
	$this->load->view('footer/fancy_zoom.php'); 
	
};


$this->load->view('footer/document_ready_home.php'); 