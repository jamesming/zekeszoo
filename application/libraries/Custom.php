<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This file is found in library section of the codeigniter application directory
 *
 */


/**
 * Useful common functions. 
 * @autoloaded YES
 * @path \system\application\libraries\Custom.php
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @copyright 2010 Prospace LLC
 * @version 1.0
 * 
 */
class Custom {

private $CI;

   	public function __construct(){

			$this->CI =& get_instance();	
			

		}
		

		
		/**
		 * echo_options_list
		 *
		 * {@source }
		 * @package BackEnd
		 * @author James Ming <jamesming@gmail.com>
		 * @access public
		 */ 
 
 
		public function echo_options_list(  $options  ){
		
			?>
			<ul class='clearfix '>
			<?php     


			$count = 0;
			foreach( $options  as  $option ){	
				$count++;
				?>
				
							<li  class='options_group' primary_key=<?php   echo $option['id']   ?>  
								
								<?php if( $count == count($options) ){?>
										
										  style='border-bottom:1px solid gray'  
									
								<?php } ?>
								
							>
								
									<div  class='float_left name_div' ><?php echo $option['name']    ?></div>
									<div  class='float_left delete' >[X]</div>

								
							</li>
				
				<?php     
			}
			?>
			</ul>
			
			
			<script type="text/javascript" language="Javascript">
				$('#option_name').focus();
			</script>
			
			
			<?php    

		}
		
		
		
		/**
		 * echo_vouchers_list
		 *
		 * {@source }
		 * @package BackEnd
		 * @author James Ming <jamesming@gmail.com>
		 * @access public
		 */ 
 
 
		public function echo_vouchers_list(  $vouchers  ){
		
			?>
			<ul class='clearfix '>
			<?php     


			$count = 0;
			foreach( $vouchers  as  $voucher ){	
				$count++;
				?>
				
							<li  class='vouchers_group' voucher_id=<?php   echo $voucher['id']   ?>  
								
								style='
								<?php if( $count == count($vouchers) ){?>
										
										  border-bottom:1px solid gray'  
									
								<?php } ?>
								'
								
							>
								
									<div  class='float_left name_div' ><?php echo $count.')&nbsp;&nbsp;'.$voucher['code']    ?>
										
										
										<?php if( $voucher['user_deal_id'] != 0){?>	
										
												<b>&nbsp;&nbsp;*&nbsp;assigned&nbsp;*</b>
									
										<?php } ?>
										
										
									</div>
									<div  class='float_left delete' >[X]</div>

								
							</li>
				
				<?php     
			}
			?>
			</ul>
			
			
			<script type="text/javascript" language="Javascript">
				$('#code').focus();
			</script>
			
			
			<?php    

		}
		
		
/*

								<div   style='clear:both;display:none'  >
								
											
											<div    style='font-size:16px;float:left;margin:10px 20px 0px 0px;vertical-align:top' >
											Share
	
											</div>
<a target='_blank' href='".base_url()."index.php/home/deal/" . $deals['deal_url']. "?share=facebook' style='float:left;'    ><img  src='http://zekeszoo.com/images/fb.gif'  style='width:40px'  /></a>								
<a target='_blank' href='".base_url()."index.php/home/deal/" . $deals['deal_url']. "?share=twitter'  style='float:left;'      ><img src='http://zekeszoo.com/images/twitter_newbird_blue.png'     style='position:relative;top:-17px;width:70px;'  /></a>
											
																							
						</div>
*/		

		
		/**
		 * email_template
		 *
		 * {@source }
		 * @package BackEnd
		 * @author James Ming <jamesming@gmail.com>
		 * @access public
		 * @param array $deals
		 * @return string $message  
		 */ 
 
 
		public function email_template( $deals ){

		return $message = "


<html>

<body   style='font-family: arial,sans-serif;'  >



	<div   style='font-size:10px;font-weight:bold;clear:both;text-align:center;width:560px'  >
			<a target='_blank' href='".base_url()."index.php/home/deal/" . $deals['deal_url']. "'>Click here if you are trouble viewing this email.</a>
	</div>



	<div   style='width:526px;
								border:4px solid #175C8D;
								'  >
	
		<div   style='
				background:#FFFFFF;
				background-image:url(http://zekeszoo.com/images/sites/zekeszoo/sunrise.jpg);
				background-repeat:repeat;
    		background-position: -300px -420px;
    		
				height:auto'  >
			
				<div   style='
				background:lightgray;
				background-image:url(http://zekeszoo.com/images/sites/zekeszoo/sunrise.jpg);
				background-repeat:repeat;
    		background-position: -300px -420px;		
				height:106px;
				'  >
				<a target='_blank' href='http://www.zekeszoo.com/index.php/home'>
					<div   style='float:left;padding:10px 10px 20px'  >
						<img width='150px' src='http://zekeszoo.com/images/sites/zekeszoo/logo_plain.png'>
					</div>
				</a>
					<div   style='
					float:right;
					margin:20px 35px 0px 0px;
					width:180px;
					height:40px;
					text-align:center;
					padding:8px 0px 8px 0px;
					color:#175C8D;
					font-weight:bold;
					font-size:13px;
					'  >
					
							

								


					</div>

					
					
					
					

				</div>
				<div  style='clear:both;' >
				
						<div style='
											float:left;
											padding-left:8px;
												' >
							<table>
								<tr>
									<td   style='font-size:12px;
															 font-weight:bold;
																'  >" . $deals['company_name']. "
									</td>
								</tr>
							</table>
						</div>
				
				</div>
				
				<div style='
										font-size:24px;
										clear:both;
										font-weight:bold;
										color:white;
										background:#4B81A7;
										padding:15px 16px 10px 16px;
										margin:0px 0px 0px 0px;
										'><a   style='
										color:white;
										text-decoration:none;
										font-weight:normal'  target='_blank' href='".base_url()."index.php/home/deal/".$deals['deal_url']."'>
					" . strip_tags($deals['deal_headline']). "</a>
				</div>
				

				<div    
				
   style='clear:both;
				background:white;
				background-image:url(".base_url()."uploads/1/".$deals['deal_id']."/image.png);
				background-repeat:no-repeat;
    		background-position: center center;		
				height:402px;
				width:526px;		
				'  
				
				
				 >
				<br />
					<a target='_blank' href='".base_url()."index.php/home/deal/".$deals['deal_url']."'  style='margin-left:360px'  >
						<img src='".base_url()."/images/seedetails.png'     />
					</a>	
				</div>

				<div style='clear:both;padding:10px 15px 0px;'>".$deals['deal_description_snippet_for_email']."
				</div>
				<a target='_blank' href='".base_url()."index.php/home/deal/".$deals['deal_url']."'>	
					<div   style='
						background-image: url(http://zekeszoo.com/images/buy_now_button_aqua_glass.gif);
						background-position: 0px center;
						background-repeat: no-repeat;
						height:52px;
						width:152px;
						margin:20px auto 20px auto;	
					'  >
					</div>
				</a>
		</div>

	</div>
	<div   style='font-size:10px;font-weight:bold;clear:both;text-align:center;width:526px'  >
			To unsubscribe, email <a href='mailto:unsubscribe@zekeszoo.com'>unsubscribe@zekeszoo.com</a>, and we will promptly remove your from our email list.
	</div>

</body>
</html>


		";
		
			
			
		}




		
		/**
		 *generic_email
		 *
		 * {@source }
		 * @package BackEnd
		 * @author James Ming <jamesming@gmail.com>
		 * @access public
		 * @param array $deals
		 * @return string $message  
		 */ 
 
 
		public function generic_email( $body, $height = '704px' ){
			
		
		return $message = "


<html>

<body   style='font-family: arial,sans-serif;'  >






	<div   style='width:560px;
								border:4px solid #175C8D;
								'  >
	
		<div   style='
				background:#FFFFFF;
				background-image:url(http://zekeszoo.com/images/sites/zekeszoo/sunrise.jpg);
				background-repeat:no-repeat;
    		background-position: -300px -420px;
    		
				height:".$height."'  >
			
				<div   style='
				background:lightgray;
				background-image:url(http://zekeszoo.com/images/sites/zekeszoo/sunrise.jpg);
				background-repeat:repeat;
    		background-position: -300px -420px;		
				height:106px;
				white-space:nowrap;
				'  >
					<a target='_blank' href='http://www.zekeszoo.com/index.php/home'><div   style='float:left;padding:10px 10px 20px'  >
						<img width='150px' src='http://zekeszoo.com/images/sites/zekeszoo/logo_plain.png'>
					</div>
					</a>
					<div   style='
					float:right;
					margin:20px 35px 0px 0px;
					width:170px;
					height:40px;
					text-align:center;
					padding:8px 0px 8px 0px;
					color:#175C8D;
					font-weight:bold;
					font-size:13px;
					'  >
					
							

								
								<div   style='clear:both;margin-left:40px'  >
								
											
											<div    style='font-size:16px;float:left;margin:4px 10px 0px 0px;' >Join
											</div>
											
<a target='_blank' href='http://www.facebook.com/zekeszoo'>
<img src='http://zekeszoo.com/images/facebook.png'   />
</a>								
<a target='_blank' href='http://twitter.com/zekeszoo'>
<img src='http://zekeszoo.com/images/twitter.png'   />
</a>
											
								</div>

					</div>

				</div>

				

				
				<div    style='clear:both;'  >
					<div style='background:white;float:left;margin-left:20px; margin-right:20px' >



							".$body."


					</div>

				</div>

	

		</div>

	</div>

	<div   style='font-size:10px;font-weight:bold;clear:both;text-align:center;width:560px'  >
			To unsubscribe, email <a href='mailto:unsubscribe@zekeszoo.com'>unsubscribe@zekeszoo.com</a>, and we will promptly remove your from our email list.
	</div>
</body>
</html>


		";
		
			
			
		}
		
		
		
		

		
		/**
		 *	generic_email_no_social_icons
		 *
		 * {@source }
		 * @package BackEnd
		 * @author James Ming <jamesming@gmail.com>
		 * @access public
		 * @param array $deals
		 * @return string $message  
		 */ 
 
 
		public function generic_email_no_social_icons( $body ){
			
		
		return $message = "


<html>

<body   style='font-family: arial,sans-serif;'  >






	<div   style='width:560px;
								border:4px solid #175C8D;
								'  >
	
		<div   style='
				background:#FFFFFF;
				background-image:url(http://zekeszoo.com/images/sites/zekeszoo/sunrise.jpg);
				background-repeat:no-repeat;
    		background-position: -300px -420px;
    		
				height:504px'  >
			
				<div   style='
				background:lightgray;
				background-image:url(http://zekeszoo.com/images/sites/zekeszoo/sunrise.jpg);
				background-repeat:repeat;
    		background-position: -300px -420px;		
				height:106px;
				'  >
					<a target='_blank' href='http://www.zekeszoo.com/index.php/home'><div   style='float:left;padding:10px 10px 20px'  >
						<img width='150px' src='http://zekeszoo.com/images/sites/zekeszoo/logo_plain.png'>
					</div>
					</a>
					<div   style='
					float:right;
					margin:20px 35px 0px 0px;
					width:170px;
					height:40px;
					text-align:center;
					padding:8px 0px 8px 0px;
					color:#175C8D;
					font-weight:bold;
					font-size:13px;
					'  >
					


					</div>

				</div>

				

				
				<div    style='clear:both;'  >
					<div style='background:white;float:left;margin-left:20px; margin-right:20px' >



							".$body."


					</div>

				</div>

	

		</div>

	</div>
	<div   style='font-size:10px;font-weight:bold;clear:both;text-align:center;width:560px'  >
			To unsubscribe, email <a href='mailto:unsubscribe@zekeszoo.com'>unsubscribe@zekeszoo.com</a>, and we will promptly remove your from our email list.
	</div>

</body>
</html>


		";
		
			
			
		}
		
		
		
		

		
}


/* End of file Tool.php */ 
/* Location: \system\application\libraries\Custom.php */
