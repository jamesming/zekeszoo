<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>

<script type="text/javascript" language="Javascript">
	
	


	
	<?php if( count($userInfo) > 0 ){ ?>
		

				if( window.parent && window.parent.$('#myaccount_container').length == 0 ){
					window.parent.location.reload(true);
				};


				if (window.opener && window.opener.open && !window.opener.closed){

								window.opener.location.reload(true);
								self.close();

				}else{
					
								document.write('You are now logged into Zekeszoo.  Close this window and reload Zekeszoo.');
					
				};
				
				

	<?php }else{?>
		

	
				function facebook_connection(){
					
					
//					
//	var left = (screen.width/2)-(w/2);
//	var top = (screen.height/2)-(h/2);
//	var targetWin = window.open (pageURL, title, 'toolbar=0, location=0, directories=0, status=0, menubar=0, scrollbars=0, resizable=0, copyhistory=0, width='+w+', height='+h+', top='+top+', left='+left+'');

					
					
					window[1] = open('<?php echo $this->my_facebook_model->loginUrl; ?>', 1 ,"width=511,height=315,scrollbars=1,resizable=1");
					
					
						// make an under popup?
						if (window.opener && window.opener.open && !window.opener.closed){
							
								opener.focus();
							
						}
						
				}
	
	
	
	
	<?php } ?>
	
	
	


</script>
<body   style='background:green'  >
	You have been logged in.  Please close this windows and reload Zekeszoo.
</body>
			
