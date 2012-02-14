<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {





   public function __construct(){
        parent::__construct();
?>        
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.cookie.js"></script>



</head>
<body>
	
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
							// $.closeDOMWindow(); DISABLE USER CLICKS ON SHADED BACKGROUND
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
<?php     


   }

	public function index(){
		
		
	}



	public function ie(){
		
	$multi_deal_bubble_height = 300;	
		
?>		
		

<body>
	
				<script type="text/javascript">
					$(document).ready(function() { 
						$('.open_multi_options_bubble').openDOMWindow({
							eventType:'click',
							loader:1,
							loaderImagePath:'<?php  echo base_url()   ?>images/animationProcessing.gif',
							loaderHeight:16,
							loaderWidth:17,
							overlayOpacity:'55',
							width:477,
							height:<?php echo $multi_deal_bubble_height    ?>, 
							positionType:'absolute', 
							positionTop:100, 
							positionLeft:($(window).width() / 2) - 300
						});
						
						setTimeout("$('a.open_multi_options_bubble').click()",500)
						
								
					});

				</script>	
	
	
				<a href="#multi-options-bubble" class="open_multi_options_bubble"   style='display:none'  ></a></p>
	
			
				<style>
					.multi-options-bubble-inside.halves{
						margin:0px 0px 0px 0px;
						float:left;
						width:230px;
						background:transparent;
						overflow:hidden;
					}
					.multi-options-bubble-inside.left-half{
						width:433px;	
					}
					
					.bubble{
							background-image: url(<?php  echo base_url()   ?>images/bubble.png);
							background-repeat: no-repeat;	
					}

								.multi-options-bubble-inside.left-half .bubble{
										width:433px;											
								}
					
								.multi-options-bubble-inside.left-half .left-top-half{
										height:32px;
										background-position:0px 0px;
								}
								.multi-options-bubble-inside.left-half .left-middle-half{
										background-image: url(<?php  echo base_url()   ?>images/bubble_inside.png?random=1431);
										background-position: <?php echo ( $this->tools->browserIsExplorer() ? '0':'0' )    ?>px 0px;
										background-repeat: repeat;	
										height:<?php echo  $multi_deal_bubble_height - 68;    ?>px;
								}
									.multi-options-bubble-inside.left-half .left-middle-half .bubble_content{		
										padding:25px;
									}	
									
									
											.multi-options-bubble-inside.left-half .left-middle-half .bubble_content table{
												border-top:1px solid gray;
												border-left:1px solid gray;
											}												
									
														.multi-options-bubble-inside.left-half .left-middle-half .bubble_content table td{
															padding:0px 0px 0px 0px;
															margin:0px 0px 0px 0px;
															width:180px;
															height:85px;		
															border-right:1px solid gray;
															border-bottom:1px solid gray;
														}															
								
								.multi-options-bubble-inside.left-half .left-bottom-half{
								    background-position: 0 -305px;
								    height: 32px
								}													
					.multi-options-bubble-inside.right-half{
							background-image: url(<?php  echo base_url()   ?>images/bubble_right_triangle.png);
							background-repeat: no-repeat;
							background-position:left center;							
							width: 47px;
							margin-left: -4px;
					    height: <?php echo $multi_deal_bubble_height - 6   ?>px;
					}					
				</style>
				<div id="multi-options-bubble" style="display:none">
					
					
						<div  class='multi-options-bubble-inside left-half halves  ' >

								<div	class='left-top-half bubble'    >
										&nbsp;
								</div>
								<div  class='left-middle-half bubble' >
									<div  class='bubble_content ' >
										<table>
											<tr>
												<td>GOLD
												</td>
												<td>$200 for 2 Year of Dog Food
												</td>
											</tr>
												<td>SILVER
												</td>
												<td>$100 for 1 Year of Dog Food
												</td>
											</tr>											
											
										</table>
										<input onclick=$.closeDOMWindow() type="button" value="close">		
									</div>
								</div>
								<div class='left-bottom-half bubble' >
										&nbsp;
								</div>							
							
						</div>

				
						<div  class='multi-options-bubble-inside right-half halves bubble' >
							&nbsp;
						</div >

				</div>

</body>
</html>
		
		
<?php     	
		
	}

function launchpage(){

		
	$launch_pop_height = 560;	
		
?>		

	
<a href="#launch_content" class="open_launch_window"></a></p>
	
	
				<script type="text/javascript">
					
					$.fn.setCursorPosition = function(pos) {
					  this.each(function(index, elem) {
					    if (elem.setSelectionRange) {
					      elem.setSelectionRange(pos, pos);
					    } else if (elem.createTextRange) {
					      var range = elem.createTextRange();
					      range.collapse(true);
					      range.moveEnd('character', pos);
					      range.moveStart('character', pos);
					      range.select();
					    }
					  });
					  return this;
					};
					
					$(document).ready(function() { 
						
						$.cookie("NameOfPerson", 'James Ming');

//						alert($.cookie("NameOfPerson"));
//						
//						$.cookie("NameOfPerson", null);
//						
//						alert($.cookie("NameOfPerson"));						

						$('.input_style').click(function(event) {
								$(this).css({color:'lightgray'}).setCursorPosition(0)
								.bind('keypress', function(e) {
										$(this).val('').css({color:'black','font-style':'normal'});
										$(this).unbind('keypress');																						
								})
						}).focus(function(event) {
								$(this).css({color:'lightgray'}).setCursorPosition(0)
								.bind('keypress', function(e) {
										$(this).val('').css({color:'black','font-style':'normal'});
										$(this).unbind('keypress');																						
								})
						});
						
						$('#password').click(function(event) {
								 $("<input type='password' />").addClass('input_style').attr({ value: '' }).insertBefore(this).focus();
								 $(this).remove()
						}).focus(function(event) {
								 $("<input type='password' />").addClass('input_style').attr({ value: '' }).insertBefore(this).focus();
								 $(this).remove()
						})	
						
						$('.open_launch_window').openDOMWindow({
							eventType:'click',
							loader:1,
							loaderImagePath:'<?php  echo base_url()   ?>images/animationProcessing.gif',
							loaderHeight:16,
							loaderWidth:17,
							overlayOpacity:'55',
							height:<?php echo $launch_pop_height    ?>, 
							positionType:'absolute', 
							positionTop:200, 
							positionLeft:($(window).width() / 2) - 230
						});
						
						setTimeout("$('a.open_launch_window').click()",1000)
						
								
					});

				</script>
			
				<style>
					body{
					font-family:"Helvetica Neue", Arial, Helvetica, sans-serif;	
					font-size:17px;
					}
					.input_style{
						  border: 1px solid darkgray;
						  height: 25px;
							padding-left: 5px;
							color:gray;
							font-style:italic;	
					}				
							
					.bubble{
							background-image: url(<?php  echo base_url()   ?>images/bubble.png);
							background-repeat: no-repeat;	
					}

								#launch_pop.left-half{
										overflow:hidden							
								}

											#launch_pop.left-half .bubble{
													width:433px;											
											}
								
											#launch_pop.left-half .left-top-half{
													height:32px;
													background-position:0px 0px;
											}
											#launch_pop.left-half .left-middle-half{
													background-image: url(<?php  echo base_url()   ?>images/bubble_inside.png?random=1431);
													background-position: <?php echo ( $this->tools->browserIsExplorer() ? '0':'0' )    ?>px 0px;
													background-repeat: repeat;	
													height:<?php echo  $launch_pop_height - 68;    ?>px;
											}
												#launch_pop.left-half .left-middle-half .bubble_content{		
													padding:0 25px 25px 25px;
												}	
															#launch_pop.left-half .left-middle-half .bubble_content div#logo_div{		
																	text-align:center;
																	background-image: url(<?php echo base_url()    ?>images/sites/zekeszoo/logo.png);
																	background-repeat: no-repeat;	
																	background-position:center 0px;	
																	height:80px;
																	background-size:50%;
															}														
											
											#launch_pop.left-half .left-bottom-half{
											    background-position: 0 -306px;
											    height: 32px
											}													
				
				</style>
				<div id="launch_content" style="display:none;">

						<div  id='launch_pop' class='left-half halves  '  >

								<div	class='left-top-half bubble'    >
										&nbsp;
								</div>
								<div  class='left-middle-half bubble' >
									<div  class='bubble_content ' >
										<div id='logo_div'>
										</div>
										<hr />
										<div  style='text-align:center' ><br />
											Join Now for Great Pet Savings. 
										</div>
										<div  style='text-align:center' >
											Its Really Free.<br /><br />
										</div>
										<div>
											<style>
											#launch_content_table input{
											 margin:5px 75px 5px;
											 width:220px;	
											}
											</style>
											<table  id='launch_content_table'>
												<tr>
													<td>
														<input  class='input_style ' name="first_name	" id="first_name	" type="" value="First Name">
													</td>
												</tr>
												<tr>
													<td>
														<input  class='input_style ' name="last_name	" id="last_name	" type="" value="Last Name">
													</td>
												</tr>
												<tr>
													<td>
														<input  class='input_style ' name="email" id="email" type="" value="Email">
													</td>
												</tr>
												<tr>
													<td>
														<input  class='input_style ' name="confirm_email" id="confirm_email" type="" value="Confirm Email">
													</td>
												</tr>		
													<td>
														<input  class='input_style ' name="password" id="password" type="" value="Password">
													</td>
												</tr>																							
											</table>
											<div  style='text-align:center' >
												<input name="" id="" type="submit" value="Join"><br /><br /><br />
											</div>
											<div  style='text-align:center' >
												Questions?  Learn more about us.
											</div>																				
										</div>
									</div>
								</div>
								<div class='left-bottom-half bubble' >
										&nbsp;
								</div>							
							
						</div>


				</div>

</body>
</html>
		
		
<?php     	
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/test.php */