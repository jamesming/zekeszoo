<style>
#control_panel{
    background: none repeat scroll 0 0 #ACD6F3;
    border-bottom: 1px solid #2E9AFE;
    border-right: 1px solid #2E9AFE;
    border-top: 1px solid #2E9AFE;
    height: 234px;
    left: 0;
    position: fixed;
    top: 122px;
    width: 30px;
  	z-index:100;
}	
		#control_panel ul{	
			list-style-type:none;
		}
		
				#control_panel ul li{	
					margin-top:10px;
					
				}
				
						#control_panel ul li div{	
						    background-image: url(<?php echo base_url()    ?>images/icons-390.png);
						    background-repeat: no-repeat;
						    height: 22px;
						    margin-left: 1px;
						    width: 22px;
								cursor:pointer;
						}
								#control_panel ul li div#open_vendor{	
								    background-position: -10px -48px;
								}						
								#control_panel ul li div#add_deal{	
								    background-position: -10px -19px;
								}
								
								#control_panel ul li div#edit_deal{	

								    background-position: -36px -19px;
								}
								
								#control_panel ul li div#open_calendar{	

								    background-position: -36px -198px
								}
								
								#control_panel ul li div#choose_deal{	

								    background-position: -36px -166px
								}
								
								
								#control_panel ul li div#back_deal{	
						    		background-image: url(<?php echo base_url()    ?>images/left_right.png);
								    
								    <?php if( $previous_deal_id  >  0 ){?>
								    	background-position: 3px 3px;
								    <?php }else{?>
								    	background-position: 3px -18px;
								    <?php } ?>
								    
								}			
								
													
								#control_panel ul li div#foward_deal{	
						    		background-image: url(<?php echo base_url()    ?>images/left_right.png);
								    
								    <?php if( $next_deal_id  >  0  ){?>
								    	background-position: -18px 0px;
								    <?php }else{?>
								    	background-position: -18px -23px;
								    <?php } ?>
								    
								}		
								
							
.control_panel_form_div{
	display:none;
  width: 409px;
  height: 363px;
  background: lightblue;
  left: 29px;
  top: 40px;
  position: fixed;
  border-top: 1px solid #2E9AFE;
  border-right: 1px solid #2E9AFE;
  border-bottom: 1px solid #2E9AFE;
  border-left: 1px solid #2E9AFE;
  z-index:99;
}																
			.control_panel_form_div div.control_panel_close_form_deal{
				cursor:pointer;
		    text-align: right;
		    margin-right: 10px;
		    padding-top: 5px;
		    font-size: 11px;
		    color: #2E9AFE;
			}								
			.control_panel_form_div div.control_panel_form_div_inside_left_div{
		    background: #CAE0F5;
		    height:480px;
		    position: relative;
		    width: 331px;
		    margin:20px 0px 0px 20px;
			}
			
			
						.control_panel_form_div div.control_panel_form_div_inside_left_div div#update_form{
							display:none;
							padding-left: 22px;
						}

											.control_panel_form_div div.control_panel_form_div_inside_left_div div div.update_deal_form_div_label {
											    float: left;
											    width: 166px;
											    font-size: 14px;
											    color:#175C8D;
											    margin-top: 20px;
											}
											.control_panel_form_div div.control_panel_form_div_inside_left_div div input {
											    float: left;
											    width: 106px;
											    font-size: 14px;
											    margin-top: 20px;
											}
											
											.control_panel_form_div div.control_panel_form_div_inside_left_div div select {
											    float: left;
											    width: 106px;
											    font-size: 14px;
											    margin-top: 20px;
													width: 111px;
													height: 22px;
											}
								
						#choose_deal_div {
						    display: none;
						    overflow: auto;
						    height:430px;
						}
						
			.control_panel_form_div div.control_panel_form_div_inside_right_div{
			  background: #CAE0F5;
			  height:440px;
			  position: relative;
			  width: 290px;
			  margin:20px 0px 0px 20px;
			  display:none;
			  padding:20px;
			}	
			
			
									.control_panel_form_div 
									div.control_panel_form_div_inside_right_div
									div.options_panel,
									.control_panel_form_div 
									div.control_panel_form_div_inside_right_div
									div#vouchers_panel
									{
									  display:none
									}	
			
																	.control_panel_form_div 
																	div.control_panel_form_div_inside_right_div 
																	div.list_of{
																	overflow:auto;
																	height:395px;
																	}
																	
																	
																	.control_panel_form_div 
																	div.control_panel_form_div_inside_right_div 
																	div.list_of{
																	overflow:auto;
																	height:395px;
																	}
																	
																	#list_of_options1{
																		height:181px;
																	}
																	
																	#list_of_options2{
																		height:181px;
																		
																	}																	
																	
																			.control_panel_form_div 
																			div.control_panel_form_div_inside_right_div
																			li
																			{
																			  cursor:pointer;
																			  height:25px;
																			  padding:5px 0px;
																			  border-top:1px solid gray;
																			  border-left:1px solid gray;
																			  border-right:1px solid gray;
																			}				
																		
																		
																							.control_panel_form_div 
																							div.control_panel_form_div_inside_right_div
																							li
																							div.name_div
																							{
																							  width:237px;
																							  padding:2px 5px;
																							}								
																		
																							.control_panel_form_div 
																							div.control_panel_form_div_inside_right_div
																							li
																							div.delete
																							{
																							  width:10px;
																							  padding:2px 5px;
																							}			
						
								#choose_deal_div div {
								    color: #175C8D;
								    cursor: pointer;
								    font-size: 14px;
								    padding: 10px 0;
								    padding-left: 24px;
								}						
									
								.selected_deal {
										cursor:text !important;
										background:yellow;
								}	
											
											
											
	
#calendar {
}
		#calendar iframe {
		    width: 500px;
		    height: 473px;
		}		
		
#vendor {
}
		#vendor iframe {
		    width: 500px;
		    height: 473px;
		}				
		
		
		
#dialog{
display:none;	
}
		#dialog table#submit_jcrop_table{
			margin:14px; display:none
		}
		
				#dialog div#submit{
						text-align:center;
						font-size:18px;
						background:orange;
						color:white;
						width:100px
				}
				
		#dialog iframe#iframe_src_for_image{
			padding: 5px; 
			border: 1px solid lightgray;
			width:350px;
			height:50px;
			margin-top:13px;
			margin-left:5px;
		}				
				

		
									
</style>