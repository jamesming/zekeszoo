<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Query Library Related to Zekeszoo
 * @autoloaded YES
 * @path \system\application\libraries\Query.php
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @copyright 2010 Prospace LLC
 * @version 1.0
 * 
 */
class Query {

private $CI;			// CodeIgniter instance


function query(){
	
	$this->CI =& get_instance();	
	
}



	/**
	 * prepare_for_index
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/mydeals
	 * @access public
	 */
	 
	function  prepare_for_index($where_array){	
		
//				$select_what =   'id,
//													deal_id, 
//													day_of_year,
//													tipped_time,
//													deal_url
//												';
//
//				$calendars = $this->CI->my_database_model->select_from_table( 
//					$table = 'calendar', 
//					$select_what, 
//					$where_array, 
//					$use_order = TRUE, 
//					$order_field = 'day_of_year', 
//					$order_direction = 'desc', 
//					$limit = 1
//				);
//				
//				
//				
//
//				$deals = $this->get_today_deal();
//				
//				if( count($calendars) == 0 ) redirect('/home/', 'refresh');;
//
//				if($calendars[0]->deal_id  ==  $deals[0]->id){
//							$next_deal = $this->get_next_deal();
//				}else{
//					$next_deal = '';
//				};


		$select_what =  'deals.deal_name, 
										 deals.deal_headline, 
										deal_share_headline,
										 deals.orig_price,
										 deals.id as deal_id,
										 deals.deal_price,
										 deals.deal_description,
										 deals.deal_description_snippet_for_email,
										 minimum_quantity,
										 maximum_quantity,
										 deals.deal_short_description,
										 deals.each_can_buy,
										 calendar.id as calendar_id,
										 calendar.day,
										 calendar.month,
										 calendar.year,
										 calendar.tipped_time,
										 calendar.id as calendar_id,
										 calendar.deal_url,
										 vendors.company_name as company_name,
										 vendors.address,
										 vendors.city,
										 vendors.state,
										 vendors.zipcode,
										 vendors.vendor_website,
										 vendor_short_description';
										 
		$join_array = array(
									'deals' => 'deals.id = calendar.deal_id',
									'vendors' => 'vendors.id = deals.vendor_id'
									);
										 


							
		$calendars = $this->CI->my_database_model->select_from_table( 
					$table = 'calendar', 
					$select_what, 
					$where_array, 
					$use_order = TRUE, 
					$order_field = 'day_of_year', 
					$order_direction = 'desc', 
					$limit = 1, 
					$use_join = TRUE, 
					$join_array 
				);

		$next_deal = $this->get_next_deal();
	

		return  array(
							'calendars' => $calendars,
							'next_deal' => $next_deal
							);


	}



	/**
	 * get_today_deal
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */	
	
	
	function get_today_deal( $priority = 1 ){
		

		$select_what =  'deals.deal_name, 
										 deals.deal_headline, 
										 deal_share_headline,
										 deals.orig_price,
										 deals.id as deal_id,
										 deals.deal_price,
										 deals.deal_description,
										 deals.deal_description_snippet_for_email,
										 deals.priority,
										 minimum_quantity,
										 maximum_quantity,
										 deals.deal_short_description,
										 deals.each_can_buy,
										 calendar.id as calendar_id,
										 calendar.day_of_year,
										 calendar.day,
										 calendar.month,
										 calendar.year,
										 calendar.tipped_time,
										 calendar.id as calendar_id,
										 calendar.deal_url,
										 vendors.company_name as company_name,
										 vendors.address,
										 vendors.city,
										 vendors.state,
										 vendors.zipcode,
										 vendors.vendor_website,
										 vendor_short_description';
		
				$where_array = array(
		  	'year' => date('Y'),
				'day_of_year' . ' <= ' =>  date('z',time()),
				'priority' => $priority				
				);
				

		 
		$join_array = array(
									'deals' => 'deals.id = calendar.deal_id',
									'vendors' => 'vendors.id = deals.vendor_id'
									);
		
		$deals = $this->CI->my_database_model->select_from_table( 
			$table = 'calendar', 
			$select_what, 
			$where_array, 
			$use_order = TRUE, 
			$order_field = 'year, day_of_year', 
			$order_direction = 'desc', 
			$limit = 1, 
			$use_join = TRUE, 
			$join_array
		);	
			
  
  if( count($deals) == 0){  // TRY LAST YEAR
  	
  			$where_array = array(
		  	'year' => date('Y')-1,
				'day_of_year' . ' <= ' =>  '365',
				'priority' => $priority				
				);
				
				$deals = $this->CI->my_database_model->select_from_table( 
					$table = 'calendar', 
					$select_what, 
					$where_array, 
					$use_order = TRUE, 
					$order_field = 'year, day_of_year', 
					$order_direction = 'desc', 
					$limit = 1, 
					$use_join = TRUE, 
					$join_array
				);				
					
  	
  };
  
  	
		return $deals;
	}


	/**
	 * get deal by id
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */	
	
	
	function get_deal_by_id( $deal_id  ){
		
				$select_what =  'deals.id, 
										 deals.vendor_id,
										 deals.deal_name,
										 deals.deal_price,
										 deals.orig_price,
										 deals.deal_headline, 
										deal_share_headline,
										 deal_description,,
										 deals.deal_description_snippet_for_email,
										 deals.deal_highlights,
										 deals.deal_finepoints,
										 deals.maximum_quantity,
										 deals.minimum_quantity,
										 deals.deal_will_expire,
										 deals.deal_short_description,
										 deals.each_can_buy,
										 vendors.company_name,
										 vendors.address,
										 vendors.address2,
										 vendors.city,
										 vendors.state,
										 vendors.zipcode,
										 vendors.vendor_website,
										 vendors.telephone
										 ';

		$where_array = array(
		'deals.id' => $deal_id
		);
		 
		$join_array = array(
									'vendors' => 'vendors.id = deals.vendor_id'
									);

		return $this->CI->my_database_model->select_from_table( 
			$table = 'deals', 
			$select_what, 
			$where_array, 
			$use_order = TRUE, 
			$order_field = 'deals.id', 
			$order_direction = 'desc', 
			$limit = 1, 
			$use_join = TRUE, 
			$join_array );
		
		
	}
	
	

	/**
	 * get all deals
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */	
	
	
	function get_all_deals(   $priority ){
		
			$select_what =  'id, deal_name';
			
			$where_array = array(
				'priority' => $priority
			);
	
			return $this->CI->my_database_model->select_from_table( 
				$table = 'deals', 
				$select_what, 
				$where_array, 
				$use_order = false, 
				$order_field = 'id', 
				$order_direction = 'desc', 
				$limit = -1, 
				$use_join = FALSE, 
				$join_array = array());
				
	}
	
	
	
	
	
	
	/**
	 * get_next_deal
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */	
		
	function get_next_deal( $priority = 1 ){
		
		// GET THE NEXT DEAL
		$select_what =  'deal_id, day_of_year, year, month, day';
		
		$where_array = array(
  	'year' => date('Y'),
		'day_of_year' . ' > ' =>  date('z',time())
		);
	
	
		$or_where_array = array(
  	'year' => ((int)date('Y') + 1 )
		);				

		return  $this->CI->my_database_model->select_from_table( 
			$table = 'calendar', 
			$select_what, 
			$where_array, 
			$use_order = TRUE, 
			$order_field = 'year, day_of_year', 
			$order_direction = 'asc', 
			$limit = 1,
			$use_join = FALSE, 
			$join_array = array(), 
			$group_by_array = array(),
			$or_where_array
			);
			
	}




	/**
	 * how many deals did all users buy during one booked segment
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */	
	
	
	function how_many_bought_during_one_booked_segment($calendar_id){

				$select_what =  'users_deals.id as user_deal_id';
				
				$where_array = array(
				'calendar_id' => $calendar_id
				);
				
				$users_deals = $this->CI->my_database_model->select_from_table(
						$table = 'users_deals', 
						$select_what, 
						$where_array, 
						$use_order = TRUE, 
						$order_field = 'users_deals.created', 
						$order_direction = 'desc', 
						$limit = -1, 
						$use_join = TRUE
				 );

				return count($users_deals );

	}



	/**
	 * register_process
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	function register_process($post_array ){	
		

		$table = 'users';
		
	  $where_array = array('email' => $post_array['email']);

	  if( $this->CI->my_database_model->my_database_model->check_if_exist($where_array, $table)){
	   	
	   			$error['type']='duplicate email';
	   			$error['message']='<ol><li>You have already registered with your site.&nbsp;&nbsp;Please simply sign in.</li></ol>';
	   	
	   			return $error;


	  }else{
	  	
	  			$this->CI->my_database_model->load->helper('security');
	  	
					$insert_what = array(
					                        'first_name' =>  $post_array['first_name'],
					                        'last_name' => $post_array['last_name'],
					                        'email' =>  $post_array['email'],
					                        'password' =>   do_hash(  $post_array['password'], 'md5' ),
					                        'zipcode' =>   $post_array['zipcode_signup']
					                );
					                
					                
					
					
					$user_id = $this->CI->my_database_model->my_database_model->insert_table(
													$table, 
													$insert_what
													); 
													
					$this->update_referal_code(	$user_id );								
													
		$body = "

<p>Thank you for sigining up on ZekesZoo.com!
</p>


<p>
Zeke's Zoo is a true labor of love for our entire team and we hope that with every Zeke's
Zoo experience you sense that your pet's well being
and saving you money is the key driver of everything we do... Our passion, our purpose!

</p>

<p>With each sales event you can be assured of the following:
</p>

<p>
	<ol>
		<li>The products & services we feature will always be of high quality and will aim to improve the quality of life for your pet.</li>
		<li>We have negotiated the very best deal possible, as we know how expensive

pet ownership can be.</li>
		<li>As a valued customer we will do everything we can to service your issues,

questions and comments to ensure your more than satisfied.</li>
		<li>You will get exclusive advance notice of the limited edition deals every Friday

morning.</li>
	</ol>
</p>

<p>
Please click on the following link to register with Zekeszoo. <br /><a href='http://www.zekeszoo.com/index.php/home/validate_account/{$user_id}'>http://www.zekeszoo.com/index.php/home/validate_account/{$user_id}</a>.
</p>
<p>
<br />
Thanks so much, once again, for registering.
</p>
<p>The Zeke's Zoo Team
</p>
";				
													
					$message = $this->CI->custom->generic_email_no_social_icons($body );

					$this->CI->load->library('email');
					
					$config['protocol'] = 'sendmail';
					$config['mailtype'] = 'html';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
			
					$this->CI->email->initialize($config);		

					$this->CI->email->from('zekeszoo@zekeszoo.com', 'zekeszoo');
					$this->CI->email->to($post_array['email']);
					// $this->CI->email->cc('another@another-example.com');
					$this->CI->email->bcc('zekeszoo@zekeszoo.com, jamesming@gmail.com, jflustyan@gmail.com, benbundy@gmail.com');
					
					$this->CI->email->subject('Registration New Account on Zekeszoo');
					$this->CI->email->message( $message );
					
					$this->CI->email->send();
					
					
					/** SEND EMAIL OUT	
					** $url = '<?php echo base_url    ?>index.php/home/validate_account/' . $user_id;
					**/
													
					$error['type']= 'none';								
					$error['message']='<ul><li>Thank you for registering.  Please check your email to continue the registration process.</li></ul>';							
													
		   		return 	$error	;							
					  	
		}



	
	}
	


	/**
	 * create_or_update_with_facebook
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */

		function create_or_update_with_facebook( $userInfo ){
			
			$facebook_user = $userInfo['id'];
			$first_name = $userInfo['first_name'];
			$last_name = $userInfo['last_name'];
			$email = $userInfo['email'];

			
			$table = 'users';
			
		  $where_array = array('facebook_user' => $facebook_user);
	
		  if( $this->CI->my_database_model->check_if_exist($where_array, $table)){
		  	
		  			$this->CI->my_database_model->update_table_where(
						$table = 'users', 
						$where_array = array('facebook_user' => $facebook_user), 
						$set_what_array = array('last_login' =>  date('Y-m-d H:i:s'))
						);
						
						$select_what =  '*';
						
						$where_array = array(
						'facebook_user' => $facebook_user
						);
						
						$users_temp_array = $this->CI->my_database_model->select_from_table( $table = 'users', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = 1);

						$users_temp_array = $this->CI->tools->object_to_array($users_temp_array);

						foreach( $users_temp_array[0]  as  $key => $value){
							$users[$key] = $value;
						}
						
						$users['facebook_user'] = $facebook_user;

			}else{
				
				
						$table = 'users';
						
					  $where_array = array('email' => $email);
				
					  if( $this->CI->my_database_model->check_if_exist($where_array, $table)){
					  	
					  	
					  			$this->CI->my_database_model->update_table_where(
									$table = 'users', 
									$where_array = array('email' => $email), 
									$set_what_array = array(
										'last_login' =>  date('Y-m-d H:i:s'),
										'facebook_user' => $facebook_user
										)
									);
									
									$select_what =  '*';
									
									$where_array = array(
										'email' => $email
									);
									
									$users_temp_array = $this->CI->my_database_model->select_from_table( $table = 'users', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = 1);

									$users_temp_array = $this->CI->tools->object_to_array($users_temp_array);
	
									foreach( $users_temp_array[0]  as  $key => $value){
										$users[$key] = $value;
									}
									
									$users['facebook_user'] = $facebook_user;

					  	
					  }else{
					  	
									$users = array();
								
									$insert_what = array(
									                        'email' =>  $email,
									                        'first_name' =>   $first_name,
									                        'last_name' =>   $last_name,
																					'facebook_user' => $facebook_user,
									                        'last_login' =>  date('Y-m-d H:i:s')
									                );
									
									$users['id'] = $this->CI->my_database_model->insert_table(
																	$table = 'users', 
																	$insert_what
																	); 	
																	
									// $this->update_referal_code(	$users['id'] );
																	
									$users['isAdmin'] = 0;	
									$users['email'] = $email;
									$users['first_name'] = $first_name;
									$users['last_name'] = $last_name;
									$users['facebook_user'] = $facebook_user;

					  }
				
				
			}
			
			
			return $users;
			
			
		}








	
	/**
	 * create_or_update_with_twitter
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */

		function create_or_update_with_twitter( $userInfo ){
			
			$twitter_user = $userInfo['id'];
			$full_name = $userInfo['name'];

			$table = 'users';
			
		  $where_array = array('twitter_user' => $twitter_user);
	
		  if( $this->CI->my_database_model->check_if_exist($where_array, $table)){
		  	
		  			$this->CI->my_database_model->update_table_where(
						$table = 'users', 
						$where_array = array('twitter_user' => $twitter_user), 
						$set_what_array = array('last_login' =>  date('Y-m-d H:i:s'))
						);
						
						$select_what =  '*';
						
						$where_array = array(
						'twitter_user' => $twitter_user
						);
						
						$users_temp_array = $this->CI->my_database_model->select_from_table( $table = 'users', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = 1);

						$users_temp_array = $this->CI->tools->object_to_array($users_temp_array);

						foreach( $users_temp_array[0]  as  $key => $value){
							$users[$key] = $value;
						}
						
						$users['twitter_user'] = $twitter_user;
						
						

			}else{
				
				
						$users = array();
					
						$insert_what = array(
						                        'full_name' =>   $full_name,
																		'twitter_user' => $twitter_user,
						                        'last_login' =>  date('Y-m-d H:i:s')
						                );
						
						$users['id'] = $this->CI->my_database_model->insert_table(
														$table = 'users', 
														$insert_what
														); 	
														
						// $this->update_referal_code(	$users['id'] );
														
						$users['isAdmin'] = 0;	
						$users['full_name'] = $full_name;
						$users['twitter_user'] = $twitter_user;
				
				
			}
			
			
			return $users;
			
			
		}

	
	
	
	/**
	 * prepare_email_deal_array
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */

	function prepare_email_deal_array(){
		
		$cur_deals = $this->get_today_deal();
		
		$cur_deals = $this->CI->tools->object_to_array($cur_deals);

		foreach( $cur_deals[0]  as  $key => $value){
			$deals[$key] = $value;
		}
		

		$deals['raw_percentage_discount_value']  = 100 - ( $deals['deal_price']  /   $deals['orig_price']   * 100 );
		$deals['discount'] = round($deals['raw_percentage_discount_value'],0);
		$deals['savings'] =  $deals['orig_price'] - $deals['deal_price'];

		$next_deal = $this->get_next_deal();

			
		$deals['deal_is_over'] = $next_deal[0]->month .'/'. $next_deal[0]->day .'/'.$next_deal[0]->year;
		return $deals;
	}
	

	
	
	/**
	 * insert_into_suggest
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */


	function insert_into_suggest( $suggestion){
		
		
		$insert_what = array(
		                        'business_name' =>  $suggestion['business_name'],
		                        'website' =>  $suggestion['business_website'],
		                        'name' =>  $suggestion['contact_name'],
		                        'email' =>  $suggestion['contact_email'],
		                        'phone' =>  $suggestion['contact_phone'],
		                );
		
		return $this->CI->my_database_model->insert_table(
										$table = 'suggestions', 
										$insert_what
										); 	
																	
	}
	
	
	
	/**
	 * validate_login
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	
	
	public function validate_login(  $post_array ){
		
		$table = 'users';
		
		if( $post_array['email'] == ''){
			return array(
				'is'=>'false',
				'key'=>'email',
				'message'=>'Email field must not be blank.'
			);
		};

		if( $post_array['password'] == ''){
			return array(
				'is'=>'false',
				'key'=>'password',
				'message'=>'Password field must not be blank.'
			);
		};
		
	  if( !$this->CI->my_database_model->check_if_exist(
	  	$where_array = array('email' => $post_array['email']), 
	  	$table
	  )){
	   	
			return array(
				'is'=>'false',
				'key'=>'email',
				'message'=>'Account is not found in system.'
			);

	  }


		$where_array = array(
			'password' => md5($post_array['password']),
			'email' => $post_array['email']		
		);
		
		$users = $this->CI->my_database_model->select_from_table( 
			$table, 
			$select_what =  '*', 
			$where_array, 
			$use_order = FALSE, 
			$order_field = '', 
			$order_direction = 'desc', 
			$limit = 1
			);

	  if( count( $users ) > 0 ){
		
					return array(
						'is'=>'true',
						'id'=>$users[0]->id,
						'isAdmin'=>$users[0]->isAdmin,
						'email'=>$users[0]->email,
					);	
		
		}else{
		
			return array(
				'is'=>'false',
				'key'=>'password',
				'message'=>'Wrong password submitted.'
			);		
		
		};
						
	}
		
	
	/**
	 * update_profile
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function update_profile(	$post_array, $user_id	){
		
			$this->CI->load->helper('security');
		
			$set_what_array = array(
									'first_name' => $post_array['first_name'],
									'last_name' => $post_array['last_name'],
									'zipcode' => $post_array['zipcode'],
									'password' => do_hash( $post_array['password'], 'md5' )
									);			
							
			$this->CI->my_database_model->update_table( 
				$table = 'users', 
				$primary_key = $user_id, 
				$set_what_array 
			);
						
					
	}
	
	
	
	/**
	 * insert_option
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function insert_option(	$post_array	){

			$insert_what = array(
			                  'name' =>  $post_array['option1_name'],
			                  'deal_id' =>  $post_array['deal_id']
			          );
			
			return $this->CI->my_database_model->insert_table(
								$table = $post_array['table'], 
								$insert_what
								); 	
	
	}
	
	
	/**
	 * get_options
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function get_options(	$post_array, $howmany = -1	){
		
		$where_array = array(
		'deal_id' => $post_array['deal_id']
		);
		
		return $this->CI->my_database_model->select_from_table( 
			$table = $post_array['table'], 
			$select_what =  '*', 
			$where_array, 
			$use_order = TRUE, 
			$order_field = 'created', 
			$order_direction = 'desc', 
			$limit = $howmany
			);
	
	}



	/**
	 * update_option
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function update_option(	$post_array ){

		$set_what_array = array(
								'name' => $post_array['option1_name']
								);			
						
		return $this->CI->my_database_model->update_table( 
			$table = $post_array['table'], 
			$primary_key = $post_array['primary_key'], 
			$set_what_array 
		);

	}
	
	
	/**
	 * delete_option
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function delete_option(	$post_array ){
	
		$where_array = array(
		'id' =>  $post_array['primary_key']
		);
		
		$this->CI->my_database_model->delete_from_table(
			$table=$post_array['table'], 
			$where_array
		);

	
	
	}



	
	/**
	 * get_unassigned_voucher
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function get_unassigned_voucher(	$deal_id	){
		
		$where_array = array(
		'deal_id' => $deal_id,
		'user_deal_id' => ''
		);
		
		return $this->CI->my_database_model->select_from_table( 
			$table = 'vouchers', 
			$select_what =  '*', 
			$where_array, 
			$use_order = TRUE, 
			$order_field = 'created', 
			$order_direction = 'desc', 
			$limit = 1
			);
	
	}


	/**
	 * deal_has_voucher
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function deal_has_voucher( $deal_id ){
	
			if( 
				$this->CI->my_database_model->count_records( 
						$table = 'vouchers',  
						$where_array = array(
							'deal_id' => $deal_id
						)
				)	> 0 
			){
				
				return TRUE;
				
			}else{
				
				return FALSE;		
			};
	
	}

	
	/**
	 * assian_voucher
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function assign_voucher(	$the_array ){

		$set_what_array = array(
								'user_deal_id' => $the_array['user_deal_id']
								);			
						
		$this->CI->my_database_model->update_table( 
			$table = 'vouchers', 
			$primary_key = $the_array['voucher_id'], 
			$set_what_array 
		);
		
		
		$set_what_array = array(
								'voucher_id' => $the_array['voucher_id']
								);			
						
		$this->CI->my_database_model->update_table( 
			$table = 'users_deals', 
			$primary_key = $the_array['user_deal_id'], 
			$set_what_array 
		);		
		

	}
	
	
	/**
	 * insert_voucher
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function insert_voucher(	$post_array	){

			$insert_what = array(
			                  'code' =>  $post_array['code'],
			                  'deal_id' =>  $post_array['deal_id']
			          );
			
			return $this->CI->my_database_model->insert_table(
								$table = 'vouchers', 
								$insert_what
								); 	
	
	}
	
	
	/**
	 * get_vouchers
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function get_vouchers(	$post_array, $howmany = -1	){
		
		$where_array = array(
		'deal_id' => $post_array['deal_id']
		);
		
		return $this->CI->my_database_model->select_from_table( 
			$table = 'vouchers', 
			$select_what =  '*', 
			$where_array, 
			$use_order = TRUE, 
			$order_field = 'created', 
			$order_direction = 'desc', 
			$limit = $howmany
			);
	
	}



	/**
	 * update_voucher
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function update_voucher(	$post_array ){

		$set_what_array = array(
								'code' => $post_array['code']
								);			
						
		return $this->CI->my_database_model->update_table( 
			$table = 'vouchers', 
			$primary_key = $post_array['voucher_id'], 
			$set_what_array 
		);

	}
	
	
	/**
	 * delete_voucher
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function delete_voucher(	$post_array ){
	
		$where_array = array(
		'id' =>  $post_array['voucher_id']
		);
		
		$this->CI->my_database_model->delete_from_table(
			$table='vouchers', 
			$where_array
		);

	
	
	}
	
	
	
	
	/**
	 * update_referal_code
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function update_referal_code(	$user_id ){

		$set_what_array = array(
								'referal_code' => $this->CI->tools->generateRandStr($length = 15)
								);			
						
		$this->CI->my_database_model->update_table( 
			$table = 'users', 
			$primary_key = $user_id, 
			$set_what_array 
		);

	}	
	
	
	
	/**
	 * insert_first_deal_for_priority
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function insert_first_deal_for_priority (	$priority ){
	
					$insert_what = array(
									'vendor_id' => 3,
									'deal_name' => 'first deal for priority : '. $priority,
									'orig_price' => 100,
									'deal_price' => 50,
									'maximum_quantity' => 100,
									'minimum_quantity' => 0,
									'deal_will_expire' => '2012-12-31',
									'deal_short_description' => 'first deal for priority : '. $priority,
									'each_can_buy' => 10,
									'priority' => $priority
									);		
					
					$inserted_id = $this->CI->my_database_model->insert_table(
													$table = 'deals', 
													$insert_what
													); 
					
					$month = date('m');
					$day = date('d');
					$year = date('Y');
					
	  			$insert_what =	 array(
					  	'deal_id' => $inserted_id,
					  	'month' => $month,
					  	'day' => $day,
					  	'year' => $year,
							'day_of_year'=> date('z',strtotime($year.'-'.$month.'-'.$day)),
							'deal_url'=> $year.'-'.$month.'-'.$day.'-' .  'first-deal-for-priority-'. $priority
					  	);
	  	
					$primary_key = $this->CI->my_database_model->insert_table(
													$table = 'calendar', 
													$insert_what
													); 
													

					return $this->get_today_deal(  $priority  );
					
					
	}
		
	
	
	/**
	 * get_promo_code_value_by_code
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function get_promo_codes_by_code( $promo_code ){
	
		$table = 'promo_codes';
		
		$where_array = array('code' => $promo_code);


	  if( $this->CI->my_database_model->check_if_exist($where_array, $table)){
	   	
			$select_what =  'id, value';
		
			$promo_codes = $this->CI->my_database_model->select_from_table( 
			$table,
			$select_what, 
			$where_array);
			
			return $promo_codes;


		}else{
	   	
				return '0';	
		}
	
}
	
	
	
		
	/**
	 * get_promo_code_value_by_code
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */
	 
	 
	public function get_promo_code_value_by_id( $promo_code_id ){
	
		$table = 'promo_codes';
		
		$where_array = array('id' => $promo_code_id);


	  if( $this->CI->my_database_model->check_if_exist($where_array, $table)){
	   	
			$select_what =  'value';
		
			$promo_codes = $this->CI->my_database_model->select_from_table( 
			$table,
			$select_what, 
			$where_array);
			
			return $promo_codes[0]->value;


		}else{
	   	
				return '0';	
		}
	
}
	
	
	
}


/* End of file Query.php */ 
/* Location: \system\application\libraries\Query.php */
