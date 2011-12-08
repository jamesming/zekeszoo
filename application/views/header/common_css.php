<style>

body {
background:#F8F6F6;
}


a {
	text-decoration:none;
	cursor:pointer;
	color: inherit;
	
}
a:active, a:focus {
outline: 0;
border:0px;
}
.container_inside{
padding:0px 5px;
}
.float_left{
float:left;	
}
.float_right{
float:right;	
}
.clearfix{
clear:both;	
}
	.rounded_bg .top {
		background:url(<?php  echo base_url()   ?>images/rounded_bg.gif) no-repeat 0 0;
		padding-left:5px;
	}

		.rounded_bg .top .sub_top {
			background:url(<?php  echo base_url()   ?>images/rounded_bg.gif) no-repeat right 0;
			height:8px;
		}

	.rounded_bg .bottom {
		background:url(<?php  echo base_url()   ?>images/rounded_bg.gif) no-repeat 0 -12px;
		padding-left:5px;
	}

		.rounded_bg .bottom .sub_bottom {
			background:url(<?php  echo base_url()   ?>images/rounded_bg.gif) no-repeat right -12px;
			height:8px;
		}

	.rounded_bg .middle {
		border-right:1px solid #cbcaca;
		border-left:1px solid #cbcaca;
		background:#ffffff;
		padding:0 1px;
	}
.margin_left{
	margin-left: 9px;
}
.margin_right{
	margin-right: 9px;
}
.margin_top{
	margin-top: 12px;
}
.one_third_column {
    width: 307px;
}
.two_third_column {
    width: 623px;
}
.centered_width{
		width: 850px;	
}
.full_width{
		width: 940px;	
}
.margin_for_centered_width{
    margin-left: 40px;
    margin-top: 33px;	
}

.header_style{
    color: #A97720;
    font-size: 19px;
    font-weight: bold;
    height: 28px;
    padding-left: 70px;
    padding-top: 12px
}


.input_style{
	  border: 1px solid darkgray;
	  height: 25px;
		padding-left: 5px;	
}



#right_col_section{
    margin-left: 10px
}
#authorize_logo{
    background-image: url("<?php echo base_url()    ?>images/authorize_net_badge.png");
    background-position: 0 0;
    background-repeat: no-repeat;
    height: 103px;
    margin: 6px 37px;
    width: 200px;
}
</style>