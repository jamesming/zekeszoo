<style>
#myaccount_container {
	width:537px;
	margin:0 auto;
	position: relative;
}

#topnav {
	padding:10px 0px 12px;
	font-size:13px;
	line-height:23px;
	text-align:right;
	color:#8AA823;
	/*font-weight:bold;*/
}
#topnav a.myaccount {
	text-decoration:none;
	font-size:12px;	
	background:#A8C739;
	padding:4px 6px 6px;
	text-decoration:none;
	font-weight:bold;
	color:#F2F2F2;
	-webkit-border-radius:4px;
	-moz-border-radius:4px;
	border-radius:4px;
}
#topnav a.myaccount:hover {
	background:#D5E8B4;
	color:#8AA823!important;
	text-decoration:none!important;
}
#topnav a.myaccount, #topnav a.myaccount:hover {
	*background-position:0 3px!important;
}

#topnav div#greeting{
font-size: 15px;
padding-right: 15px;
padding-top: 5px;
}

a.myaccount {
	position:relative;
	margin-left:3px;
}
a.myaccount span {
	background-image:url(<?php echo base_url()    ?>images/twitter_login/toggle_down_light.png);
	background-repeat:no-repeat;
	background-position:100% 50%;
	padding:4px 16px 6px 0;
}
#topnav a.menu-open {
	background:#D5E8B4!important;
	color:#666!important;
	outline:none;
}

a.myaccount.menu-open span {
	background-image:url(<?php echo base_url()    ?>images/twitter_login/toggle_up_dark.png);
	color:#789;
}

#account_menu {
    background-color: #D5E8B4;
    border: 1px none transparent;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    border-top-left-radius: 5px;
    color: gray;
    display: none;
    font-size: 12px;
    margin-right: 0;
    margin-top: 5px;
    padding-top: 12px;
    padding-bottom: 12px;
    position: absolute;
    right: 0;
    text-align: left;
    top: 28px;
    width: 73px;
    z-index: 100;
}

#login_container div#tabs_div div.tab{
     padding-top: 63px;
}		

</style>
<div id='myaccount_container'  >
	
 <div id="topnav" class="topnav">
 	
	 	<a  href="" class="float_right myaccount" onfocus="this.blur()">
	 		<span>My Account</span>
	 	</a>  
	 		
	 	<div id='greeting' class='float_right ' >Welcome <?php
	 		
	 		if( isset( $this->session->userdata['full_name'] ) && $this->session->userdata['full_name'] != ''){
	 			
	 			echo $this->session->userdata['full_name'];
	 			
	 		}else{
	 			
	 			echo $this->session->userdata['email']  ;
	 			
	 		};
	 		
	 		
	 		   
	 		  
	 		  
	 		  
	 		  ?>.
	 	</div>
		 	

 </div>
	
  <fieldset id="account_menu">
		<ul>
			<li><a id='myprofile'>My Profile</a></li>
			<li><a id='mypayment'>My Payment</a></li>
			<li   style='display:none'  ><a id='mycredits'>My Credits</a></li>
			<li><a id='mydeals'>My Deals</a></li>
			<li   style='display:none'  ><a id='mypetgallery'>My Pet Gallery</a></li>
			<li><a id='logout'>Log Out</a></li>
			

			

		</ul>
  </fieldset>	
  
</div>


<script type="text/javascript" language="Javascript">
        $(document).ready(function() {

            $("#account_menu a").click(function(e) {          
							e.preventDefault();
										
								if( $(this).attr('id') == 'logout'){
									
									<?php if( $_SERVER['HTTP_HOST'] == 'localhost' ){?>
											document.location.href='http://localhost/zekeszoo/index.php/home/index?logout=1';	
									<?php }else{?>
											document.location.href='<?php echo  base_url().$_SERVER['REQUEST_URI'];   ?>?logout=1';									
									<?php } ?>

								}else{
									
									document.location.href='<?php echo  base_url();   ?>index.php/home/'  + $(this).attr('id');									
									
								};
            });

            $(".myaccount").click(function(e) {          
							e.preventDefault();
			        $("fieldset#account_menu").toggle();
							$(".myaccount").toggleClass("menu-open");
            });

						$("fieldset#account_menu").mouseup(function() {
							return false
						});
						
						$(document).mouseup(function(e) {
							if($(e.target).parent("a.myaccount").length==0) {
								$(".myaccount").removeClass("menu-open");
								$("fieldset#account_menu").hide();
							}
						});		
	
        });
</script>