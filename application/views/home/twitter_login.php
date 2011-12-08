<style>
	#signin_container {
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
#topnav a.signin {
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
#topnav a.signin:hover {
	background:#D5E8B4;
	color:#8AA823!important;
	
}
#topnav a.signin, #topnav a.signin:hover {
	*background-position:0 3px!important;
}

a.signin {
	position:relative;
	margin-left:3px;
}
a.signin span {
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
#small_signup {
	display:inline;
	float:none;
	line-height:23px;
	margin:25px 0 0;
	width:170px;
}
a.signin.menu-open span {
	background-image:url(<?php echo base_url()    ?>images/twitter_login/toggle_up_dark.png);
	color:#789;
}

#signin_menu {
	-moz-border-radius-topleft:5px;
	-moz-border-radius-bottomleft:5px;
	-moz-border-radius-bottomright:5px;
	-webkit-border-top-left-radius:5px;
	-webkit-border-bottom-left-radius:5px;
	-webkit-border-bottom-right-radius:5px;
	display:none;
	background-color:#D5E8B4;
	position:absolute;
	width:150px;
	z-index:100;
	border:1px transparent;
	text-align:left;
	padding:12px;
	top: 28px; 
	right: 0px; 
	margin-top:5px;
	margin-right: 0px;
/*	margin-right: -1px;*/
	color:gray;
	font-size:11px;
}

#signin_menu input[type=text], #signin_menu input[type=password] {
	display:block;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border:0px solid #9DCE66;
	font-size:13px;
	margin:0 0 5px;
	padding:5px;
	width:142px;
}
#signin_menu p {
	margin:0;
}
#signin_menu a {
	color:gray;
}
#signin_menu label {
	font-weight:normal;
}
#signin_menu p.remember {
	padding-top:10px;
}
#signin_menu p.forgot, #signin_menu p.complete {
	clear:both;
	margin:5px 0;
}
#signin_menu p a {
	color:gray!important;
}
#signin_submit {
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
#signin_submit::-moz-focus-inner {
padding:0;
border:0;
}
#signin_submit:hover, #signin_submit:focus {
	background-position:0 -5px;
	cursor:pointer;
}
a#signup{
	color:#8CAB25;
	
}
a#signup:hover{
	color:#A7D274;
	
}
#facebook{
    margin-top: 5px;
    margin-bottom: 10px;
}
#facebook div.oruse {
	 padding-top: 3px;
	 margin-left:5px;
}

#facebook div.icon {
  background-image: url("https://s-static.ak.facebook.com/rsrc.php/v1/zL/r/FGFbc80dUKj.png");
  background-position: 0px -233px;
  background-repeat: no-repeat;
  float: left;
  height: 19px;
  width: 18px;
	cursor:pointer;
	margin-left: 6px;
}
#facebook div.word {
    background: none repeat scroll 0 0 #5D76AA;
    border-bottom: 3px solid #29447E;
    color: #FFFFFF;
    cursor: pointer;
    float: left;
    font-family: arial;
    font-size: 12px;
    font-weight: bold;
    height: 15px;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 1px
}
.facebook_connect{
cursor:pointer;	
} 

.twitter_icon{
  background-image: url('<?php  echo base_url()   ?>images/twitter_login_image.png');
  background-position: 0px 0px;
  background-repeat: no-repeat;
  height: 26px;
  width: 85px;
  margin-left: 42px;
  cursor:pointer;
  display:none;
}
.error_message{
		display:none;
    color: darkRed;
    font-size: 9px;
    height: 9px;
    margin-bottom:5px;
}
</style>
<div id='signin_container'>
	
 <div id="topnav" class="topnav"> <a id='signup'>Sign Up</a> or <a href="" class="signin" onfocus="this.blur()"><span>Sign in</span></a> </div>
	
  <fieldset id="signin_menu">
    <form method="post" id="signin" action="<?php  echo base_url()   ?>index.php/home/signin/<?php  echo $deal_id   ?>">
    	<p>
      <label for="username">Email</label>
      <input id="email" name="email" value="" title="username" tabindex="4" type="text">
      </p>
      <div  class=' error_message' >
      	Bad Account
      </div>
      <p>
        <label for="password">Password</label>

        <input id="password" name="password" value="" title="password" tabindex="5" type="password">
      </p>
      <div  class=' error_message' >
      	or Password
      </div>
      <p class="remember">
        <span  id="signin_submit"  class='float_left '>Sign in</span>
	      <div id='facebook'  class='float_left ' >
		      	<div  class='oruse float_left' >or  
		      	</div>
						<div  class='icon facebook_connect' >
						</div>
						<div   class='word facebook_connect'  >
							Connect
						</div>
				</div>
      </p>
      

<!-- <div  class='twitter_icon'>
			</div> -->			
			
			
      <p class="forgot clearfix"> <a href="#" id="resend_password_link">Forgot your password?</a> </p>

      <p class="forgot-username"> <A id=forgot_username_link 
					title="If you remember your password, try logging in with your email" 
					href="#">Forgot your username?</A> </p>
    </form>
  </fieldset>	
</div>


<script type="text/javascript" language="Javascript">
        $(document).ready(function() {
        	
        		$('.twitter_icon').click(function(event) {				
								open('<?php echo base_url() ?>index.php/home/twitter', 1 ,"width=511,height=315,scrollbars=1,resizable=1");
						});	


						$('#signup').click(function(event) {				
								document.location.href='<?php echo  base_url();   ?>index.php/home/register';
						});	
				

            $(".signin").click(function(e) {  
							e.preventDefault();
			        $("fieldset#signin_menu").toggle();
							$(".signin").toggleClass("menu-open");
            });
            
            
            $('#iframe_facebook').attr('src','<?php echo base_url();    ?>index.php/home/facebook?from_logout=<?php echo $from_logout;    ?>');
            
						$('.facebook_connect').click(function(event) {
							
							$('iframe').each(function(index) { 
								try { this.contentWindow.facebook_connection(); } 
								catch (e) { } 
							});
						
						});	
						
						
			
						$("fieldset#signin_menu").mouseup(function() {
							return false
						});
						$(document).mouseup(function(e) {
							if($(e.target).parent("a.signin").length==0) {
								$(".signin").removeClass("menu-open");
								$("fieldset#signin_menu").hide();
							}
						});		
						
            $("#signin_submit").click(function(e) {          
			        $("#signin").submit();
            });
									
						
							
			
        });
</script>