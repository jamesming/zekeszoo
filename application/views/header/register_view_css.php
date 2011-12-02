<style>
.error_message, .error_message_select {
    color: darkRed;
    font-size: 11px;
    height: 9px;
}
.error_message_select {
    position: relative;
    top: -7px;
}
#error_message {
		background-color:pink;
    background-image: url(<?php  echo base_url()   ?>images/exclamation_point.png);
    background-position: 7px 13px;
  	background-repeat: no-repeat;
    border: 1px solid red
    color: gray;
    display: none;
    font-size: 16px;
    height: auto;
    margin-left: 292px;
    margin-top: 16px;
    padding-left: 19px;
    padding-right: 0;
    padding-top: 13px;
    padding-bottom:19px;
    position: absolute;
    width: 256px;
    border: 1px solid red;
}
		#error_message ol, #error_message ul {
    color: gray;
    font-size: 13px;
    margin-left: 56px;
    padding-right: 10px;
		}

		#error_message ul {
			list-style: none;
		}
		
#box_section, #right_col_section{
margin-top: 20px;
}

		#box_section  .middle,  #right_col_section  .middle{
		min-height:398px;
		}
		
		
								#box_section  .middle div#box_inside_header {
								    background-image: url(<?php  echo base_url()   ?>images/sites/zekeszoo/star.png);
								    background-position: 21px 13px;
								  	background-repeat: no-repeat;}
								  	
								#right_col_section  .middle div#box_inside_header {
								    background-image: url(<?php  echo base_url()   ?>images/sites/zekeszoo/star.png);
								    background-position: 21px 13px;
								  	background-repeat: no-repeat;}
		
								#box_section  .middle div#box_inside_header,  
								#right_col_section  .middle div#box_inside_header{
								    color: #A97720;
								    font-size: 19px;
								    font-weight: bold;
								    height: 28px;
								    padding-left: 63px;
								    padding-top: 12px
								}
								#box_section .two_third_column .middle div#box_inside,
								#right_col_section .one_third_column .middle div#box_inside
								 {
										padding: 28px 15px 13px 27px;
								    font-size: 16px;
								    overflow:none;
								}

#right_col_section{
    margin-left: 10px
}





										#box_section .middle div.user_info_inner_box div.outer_input_label{
										    /*background: orange;*/
										    height: 60px;
										    font-size: 11px;
										    font-weight: bold;

										}		
										
										
												#box_section .middle div.user_info_inner_box div.outer_input_label input{
												    border: 1px solid darkgray;
												    height: 25px;
										    		padding-left: 5px;
												}
												

										
												#box_section .middle div.user_info_inner_box div.outer_input_label select.select_large{
												    border: 1px solid darkgray;
												    height: 29px;
												    width: 128px;
												    margin-top: 0px;
												}		
												
												#box_section .middle div.user_info_inner_box div.outer_input_label select.select_small{
												    border: 1px solid darkgray;
												    height: 29px;
												    width: 61px;
												    margin-top: 0px;
												}		
												
												#box_section .middle div.user_info_inner_box div.outer_input_label select#month_exp{
												    margin-right:5px;
												}													
																								
												
												#box_section .middle div.user_info_inner_box div.outer_input_label select option{

												}														
												
										
														#box_section .middle div.user_info_inner_box div.outer_input_label div.halfies{
															width: 136px;
														}
														
																#box_section .middle div.user_info_inner_box div.outer_input_label div.halfies input.small_input{
																	width: 120px;
																}														
										
														#box_section .middle div.user_info_inner_box div.outer_input_label div.input_div{
														    /*background: pink;*/
														}
														
																#box_section .middle div.user_info_inner_box div.outer_input_label div.input_div input.large_input{
																    width: 256px;
																}




.error_input{
	background:pink;
}



#box_section .middle div.user_info_inner_box div#i_agree {
    height: 31px;
    padding-top: 8px;
}
				#box_section .middle div.user_info_inner_box div#i_agree div#text_iagree {
				    padding-left: 13px;
				        width: 231px;
						<?php if( $this->tools->browserIsExplorer()){?>
							padding-top: 5px;
						<?php }else{?>
							padding-top: 2px;
						<?php } ?>
				    
				}
						#box_section .middle div.user_info_inner_box div#i_agree div#text_iagree a{
						   color:blue;
						}
								#box_section .middle div.user_info_inner_box div#i_agree input {
								    margin-top: -3px;
								    border:0px;
								}

										#box_section .middle div.user_info_inner_box div.outer_input_label div#signup_image{
									    background-image: url(<?php  echo base_url()   ?>images/submit.png);
									    background-position: center center;
									  	background-repeat: no-repeat;
									    color: white;
									    cursor: pointer;
									    font-size: 17px;
									    font-weight: bold;
									    height: 45px;
									    padding-top: 18px;
									    text-align: center;
									    width: 129px;
										}



</style>