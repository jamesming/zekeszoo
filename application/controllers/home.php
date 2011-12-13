<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {



		private $site_id;
		private $deal_id;

		private $deal_in_words;





   public function __construct(){
        parent::__construct();


				// brk
				
				//$this->error_check_mode = TRUE;
				$this->error_check_mode = FALSE;



				if( $this->input->get('priority')){

        	$this->priority = 	$this->input->get('priority');

				}elseif( defined ($this->input->post('priority')) ){

        	$this->priority = $this->input->post('priority');

				}else{

        	$this->priority = 1;

				};


        if( $this->input->get('logout') ){

							if( $_COOKIE ) {

							    foreach( $_COOKIE as $name => $value ) {

							            //Get the current cookie config
							            $params = session_get_cookie_params();

							            // Delete the cookie from globals
							            unset($_COOKIE[$name]);

							            //Delete the cookie on the user_agent
							            setcookie($name, '', time()-43200, $params['path'], '', $params['secure']);
							    }
							}
							$this->session->sess_create();

							$uri = str_replace("?logout=1", "", $_SERVER['REQUEST_URI']);
							$uri = str_replace("//index.php/", "", $uri);



							if( $_SERVER['HTTP_HOST'] == 'localhost' ){

								redirect('/home/index');
							}else{

								redirect($uri);
							};


        };




				$this->site_id  = 1;



				if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){

								if( $this->uri->segment(3) != '' ){
									$this->deal_id  = $this->uri->segment(3);
								}else{
									$this->deal_id =  $this->input->post('deal_id');
								};

				};


				if(  isset( $this->session->userdata['user_id'] )  ){

					$this->users = $this->get_user_information($this->session->userdata['user_id']);

				}else{

					$this->users = array();

				};


				// IF INDEX BROUGHT ON BY USER LOGOUT
				if( $this->input->get('from_logout') == 1 ){
					$this->from_logout = 1;
				}else{
					$this->from_logout = 0;
				};


   }



	/**
	 * deal
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/deal
	 * @access public
	 */

	public function deal(){

				$where_array = array(
		  	'deal_url' => $this->uri->segment(3)
				);

				$this->referal_code = $this->uri->segment(4);

				$this->deal_in_words = $this->query->prepare_for_index($where_array);

				$this->index();
	}


	/**
	 * Index Page for this controller.
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/index
	 * @access public
	 */

	public function index(){

		if(   isset($this->deal_in_words)  ){  // ** COMING FROM $this->deal() .. when user clicks deal from mydeals_view

				$calendars = $this->deal_in_words['calendars'];
				$next_deal = $this->deal_in_words['next_deal'];
				$tipped_time = $this->deal_in_words['calendars'][0]->tipped_time;
				$this->deal_id = $this->deal_in_words['calendars'][0]->deal_id;
				$deal_url =  $this->deal_in_words['calendars'][0]->deal_url;

		}elseif(   $this->deal_id ==''  ){  // ** COMING FROM /home/index

				$today_deal = (
											 count( $this->query->get_today_deal(  $this->priority  ) ) > 0 ?
															$this->query->get_today_deal(  $this->priority  ) :
															$this->query->insert_first_deal_for_priority (	$this->priority )
											);

				$calendars = $today_deal;
				$next_deal =  $this->query->get_next_deal(  $this->priority   );
				$tipped_time = ( isset( $today_deal[0]->tipped_time) ? $today_deal[0]->tipped_time:'' );
				$this->deal_id = ( isset( $today_deal[0]->deal_id) ? $today_deal[0]->deal_id:'' );
				$deal_url = ( isset( $today_deal[0]->deal_url) ? $today_deal[0]->deal_url:'' );

		}else{
				$tipped_time = '';
				$deal_url =  "";
		};

		$deals = $this->query->get_deal_by_id( $this->deal_id );

		if( isset( $this->session->userdata['isAdmin'] ) && $this->session->userdata['isAdmin']== 1){

			$next_deal = array();

			$all_the_deals = $this->query->get_all_deals($this->priority);

			 for( $i= 0; $i <= count($all_the_deals); $i++ ){

			 	if( isset($all_the_deals[ $i ])  &&  $all_the_deals[$i]->id == $this->deal_id){

			 		if( isset($all_the_deals[ $i - 1 ]) ) $previous_deal_id = $all_the_deals[ $i - 1 ]->id;
			 		else $previous_deal_id = -1;

			 		if( isset($all_the_deals[ $i + 1 ]) ) $next_deal_id = $all_the_deals[ $i + 1 ]->id;
					else $next_deal_id = -1;

			 	};

			 }

			$select_what =  '*';

			$where_array = array();

			$vendors = $this->my_database_model->select_from_table( $table = 'vendors', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);

		}else{



			$all_the_deals = array();
//			$previous_deal_id='';
//			$next_deal_id='';

			$vendors = array();

		};


		$raw_percentage_discount_value  = 100 - ( ( isset( $deals[0]->deal_price) ? $deals[0]->deal_price:'1' )  /   ( isset( $deals[0]->orig_price) ? $deals[0]->orig_price:'1' )    * 100 );

		$discount = round($raw_percentage_discount_value,0);

		$savings = ( isset( $deals[0]->orig_price) ? $deals[0]->orig_price:'0' ) - ( isset( $deals[0]->deal_price) ? $deals[0]->deal_price:'0' );


		if( $this->uri->segment(3) == 'bad_account' ){
			$isBadAccount = TRUE;
		}else{
			$isBadAccount = FALSE;
		};

		if( isset($calendars)  ){
					$bought_so_far = (int)$this->query->how_many_bought_during_one_booked_segment($calendar_id = ( isset( $calendars[0]->calendar_id) ? $calendars[0]->calendar_id:'0' ));
		}else{
					$bought_so_far = (int)$this->how_many_bought($this->deal_id);
		};

		$howmany_left =   ( (int)( isset( $deals[0]->maximum_quantity) ? $deals[0]->maximum_quantity:'0' ) -  $bought_so_far) ;

		if( $bought_so_far >= ( isset( $deals[0]->minimum_quantity) ? $deals[0]->minimum_quantity:'' ) ){
			$deal_is_on = TRUE;
			$count_of_buyers_needed_to_tip_deal = 0;
		}else{
			$deal_is_on = FALSE;
			$count_of_buyers_needed_to_tip_deal = 	$deals[0]->minimum_quantity - $bought_so_far;
		};


		$data = 		array(
		'priority' => $this->priority,
		'website' => $this->my_database_model->select_from_table( $table = 'website', $select_what = '*', $where_array = array(), $use_order = TRUE, $order_field = 'id', $order_direction = 'desc', $limit = 1, $use_join = FALSE, $join_array= array() ),
		'deal_url' => $deal_url,
		'from_logout' => $this->from_logout,
		'count_of_buyers_needed_to_tip_deal' => $count_of_buyers_needed_to_tip_deal,
		'deal_is_on' => $deal_is_on,
		'tipped_time' => $tipped_time,
		'howmany_left' => $howmany_left,
		'bought_so_far' => $bought_so_far,
		'users' => $this->users,
		'vendors' => $vendors,
		'isBadAccount' => $isBadAccount,
		'next_deal' => $next_deal,
		'previous_deal_id' => ( isset( $previous_deal_id) ? $previous_deal_id:0),
		'next_deal_id' => ( isset( $next_deal_id) ? $next_deal_id:'' ),
		'all_the_deals' => $all_the_deals,
		'discount'=> $discount,
		'savings'=>$savings,
		'deals' => $deals,
		'site_id' => $this->site_id,
		'deal_id' => $this->deal_id ,
		'public_gallery' => $this->get_public_gallery($limit = 3));

		$this->load->view('home/index_view',$data);


	}



	/**
	 * facebook
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/facebook
	 * @access public
	 */

	public function facebook(){

		$this->load->model('my_facebook_model');

		$loginUrl = $this->my_facebook_model->loginUrl;

		if ( $this->input->get('from_logout') == 1 ){
			?>
			<script type="text/javascript" language="Javascript">
				window.parent.$('#logo').click();
			</script>
			<?php
		};


		$facebook_user = $this->my_facebook_model->user;

//		echo '<pre>';print_r($facebook_user);echo '</pre>';
//		echo '<pre>';print_r($_SESSION);echo '</pre>';


		if ( $facebook_user ){

			$userInfo   = $this->my_facebook_model->facebook->api("/".$this->my_facebook_model->user);

			$users = $this->query->create_or_update_with_facebook( $userInfo );

			$newdata = array(
		                   'email'  => $users['email'],
		                   'user_id'     => $users['id'],
		                   'isAdmin'     =>  $users['isAdmin'],
		                   'logged_in' => TRUE
		               );

			$this->session->set_userdata($newdata);

		}else{

			$userInfo   = array();

		}



		$this->load->view('home/facebook_view',
			array(
			'loginUrl' => $loginUrl,
			'userInfo' => $userInfo
			)
		);





	}







	/**
	 * twitter
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/ twitter
	 * @access public
	 */

	 function twitter(){

	 		$this->load->model('my_twitter_model');  // Sends the user off for login if not logged in

	 		$userInfo = $this->my_twitter_model->userInfo();

	 		if( $userInfo ){

					 		$userInfo = $this->tools->object_to_array($userInfo);

					 		$users = $this->query->create_or_update_with_twitter( $userInfo );


							$newdata = array(
						                   'full_name'  => $users['full_name'],
						                   'user_id'     => $users['id'],
						                   'isAdmin'     =>  $users['isAdmin'],
						                   'logged_in' => TRUE
						               );




							$this->session->set_userdata($newdata);



					 		?>

					 		<script type="text/javascript" language="Javascript">

								if( window.opener.$('#myaccount_container').length == 0 ){

									window.opener.$('#logo').click();

								};
					 			self.close();

					 		</script>


					 		<?php

	 		};



	 }



	/**
	 * closewindow
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/closewindow
	 * @access public
	 */
	public function closewindow(){

	?>


	<script type="text/javascript" language="Javascript">

		window[1].close();

	</script>


	<?php

	}









	/**
	 * recent deals
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/mydeals
	 * @access public
	 */

	public function  recentdeals(){


		$select_what =  '
										 calendar.id as calendar_id,
										 calendar.deal_url,
										 deals.deal_name,
										 deals.id as deal_id,
										 orig_price,
										 deal_price,
										 minimum_quantity,
										 maximum_quantity,
										 deals.deal_short_description,
										 deals.deal_description,
										 deals.each_can_buy,
										 deals.deal_headline,
										 calendar.day,
										 calendar.month,
										 calendar.year,
										 calendar.tipped_time,
										 calendar.id as calendar_id,
										 vendors.company_name as company_name,
										 vendors.city as city,
										 vendor_short_description,
										 vendor_website';

				$where_array = array(
		  	'year' => date('Y'),
				'day_of_year' . ' >= ' =>  date('z',time())
				);


		$join_array = array(
									'deals' => 'deals.id = calendar.deal_id',
									'vendors' => 'vendors.id = deals.vendor_id'
									);


		$all_deals = $this->my_database_model->select_from_table(
			$table = 'calendar',
			$select_what,
			$where_array,
			$use_order = TRUE,
			$order_field = 'day_of_year',
			$order_direction = 'asc',
			$limit = -1,
			$use_join = TRUE,
			$join_array );

		$all_deals = $this->tools->object_to_array($all_deals);

		foreach( $all_deals  as  $one_deal){

			foreach( $one_deal  as  $key => $value){
				$temp[$key] = $value;
				if( $key == 'calendar_id'){

					$select_what =  'count(users_deals.id) as count';

					$where_array = array(
					'users_deals.calendar_id' => $value,
					'users_deals.status' => 'active'
					);

					$users_deals = $this->my_database_model->select_from_table(
						$table = 'users_deals',
						$select_what,
						$where_array,
						$use_order = FALSE,
						$order_field = 'id',
						$order_direction = 'desc',
						$limit = -1
						);

					$temp['total_bought'] = $users_deals[0]->count;

				};

				if( $key == 'orig_price'){

						$temp_orig_price = $value;

				};

				if( $key == 'deal_price'){

						$temp_deal_price = $value;

						$temp['raw_percentage_discount_value']  = 100 - ( $temp_deal_price  /   $temp_orig_price    * 100 );

						$temp['discount'] = round($temp['raw_percentage_discount_value'],0);

						$temp['savings'] = $temp_orig_price - $temp_deal_price;

						unset($temp_orig_price,$temp_deal_price);

				};


			}

			$past_deals[] = $temp;
			unset($temp);

		}



		$this->load->view('home/recentdeals_view', array(
			'past_deals' => $past_deals,
			'deal_id' => $this->deal_id,
			'from_logout' => $this->from_logout
			));
	}


	/**
	 * redeem
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/redeem
	 * @access public
	 */

	public function  redeem(){

		$user_deal_id = $this->input->post('user_deal_id');
		$redeem = $this->input->post('redeem');

		if( $redeem == 1){
					$set_what_array = array(
											'redeemed' => 1
											);
		}else{
					$set_what_array = array(
											'redeemed' => 0
											);

		};

		$this->my_database_model->update_table(
			$table = 'users_deals',
			$primary_key = $user_deal_id,
			$set_what_array );

}





	/**
	 * design_email
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/email_deal
	 * @access public
	 */

	public function  design_email(){

		$deals = $this->query->prepare_email_deal_array();

		echo $this->custom->email_template( $deals );

	}

	/**
	 * send_thank_you_email
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/send_thank_you_email
	 * @access public
	 */

	public function  send_thank_you_email( $content = array()){



//$content['deal_name'] =  'test';
//$content['cc_transaction_description'] =  'test description';


$fullname = $this->users[0]->first_name . ' ' . $this->users[0]->last_name;
$subject ="What a treat! Purchase confirmation for ".$content['deal_name'].".";
$order_summary = "
<b>Order Summary:</b><br />
". $content['cc_transaction_description'] ."
<br />
You can fetch, view and print your coupon at zekeszoo.com
by signing in and going to the 'My Deals' area of the website.
";


$body = "
<br />
<p>
Hi {$fullname},
</p>

<p>
We thank you and hope you love your purchase!

No further action is required at this point, we'll take it from here. Your purchase will be shipped directly to the address provided at checkout.

<p>
{$order_summary}
</p>
<p>
With any questions please don't hesitate to shoot us an email at <a href='mailto:help@zekeszoo'>help@zekeszoo.com</a>.
<br /><br />
All the best to you and your pets!<br /><br />
Your Friends at Zeke's Zoo.<br />
<br />
Join our Pet & Deal Loving Community on <a target='_blank' href='https://facebook.com/zekeszoo'>Facebook</a>.
<p>

";


// 		echo $this->custom->generic_email($body );

		$this->load->library('email');

		$message = $this->custom->generic_email_no_social_icons($body );

		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);

		$this->email->from("confirmation@zekeszoo.com", "Zeke's Zoo");
		$this->email->to(
		$this->users[0]->email.',
		benbundy@gmail.com,
		jamesming@gmail.com'
		);

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();


	}

	/**
	 * email deal
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/email_deal
	 * @access public
	 */

	public function  email_deal(){

		$deals = $this->query->prepare_email_deal_array();

		$this->load->library('email');

		$message = $this->custom->email_template( $deals );

		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);

		$this->email->from('jamesming@gmail.com', 'James Ming');
		$this->email->to('
		asian2see@gmail.com,
		jamesming@gmail.com,
		benbundy@gmail.com,
		jflustyan@gmail.com'
		);

		$this->email->subject($deals['deal_headline']);
		$this->email->message($message);

		$this->email->send();

		//echo $this->email->print_debugger();

	}

	/**
	 * mydeals
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/mydeals
	 * @access public
	 */

	public function mydeals(){

		if( $this->input->get() ){

				$filter = $this->input->get('filter');

				switch ($filter) {
				    case 'available':
										$where_array = array(
										'deal_will_expire >' => date('Y-m-d'),
										'redeemed' => 0,
										'users_deals.user_id' => $this->users[0]->id
										);
				        break;
				    case 'used':
										$where_array = array(
										'redeemed' => 1,
										'users_deals.user_id' => $this->users[0]->id
										);
				        break;
				    case 'expired':
										$where_array = array(
										'deal_will_expire <' => date('Y-m-d') ,
										'users_deals.user_id' => $this->users[0]->id
										);
				        break;
				    case 'all':
										$where_array = array(
										'users_deals.user_id' => $this->users[0]->id
										);
				        break;

				}



		}else{
				$where_array = array(
				'deal_will_expire >' => date('Y-m-d'),
				'redeemed' => 0,
				'users_deals.user_id' => $this->users[0]->id
				);
		};


					// ** Group by authorize_transactionId the user_deals associated with user_deal_id
				$select_what =  '
												 users_deals.authorize_transactionId,
												 users_deals.created,
												 users_deals.status,
												 users.id as user_id,
												 users.first_name,
												 users.last_name,
												 users.authorize_customerProfileId,
												 users.authorize_paymentProfileId,
												 users.authorize_customerAddressId,
												 users_deals.authorize_transactionId,
												 users_deals.id as user_deal_id,
												 deals.deal_will_expire,
												 deal_short_description,
												 deals.id as deal_id,
												 deals.deal_price,
												 company_name,
												 calendar.id as calendar_id,
												 calendar.year,
												 calendar.deal_url
												 ';


				$join_array = array(
											'users' => 'users.id = users_deals.user_id',
											'deals' => 'deals.id = users_deals.deal_id',
											'vendors' => 'vendors.id = deals.vendor_id',
											'calendar' => 'deals.id = calendar.deal_id'
											);

				$users_deals_grouped = $this->my_database_model->select_from_table(
					$table = 'users_deals',
					$select_what,
					$where_array,
					$use_order = TRUE,
					$order_field = 'calendar.day_of_year',
					$order_direction = 'desc',
					$limit = -1,
					$use_join = TRUE,
					$join_array,
					$group_by = array('authorize_transactionId')
					);


				// ** Get array for ALL  user_deals by user_deal_id
				$select_what =  '
				users_deals.id as user_deal_id,
				users_deals.authorize_transactionId,
				users_deals.redeemed
				';




				$users_deals = $this->my_database_model->select_from_table(
					$table = 'users_deals',
					$select_what,
					$where_array,
					$use_order = TRUE,
					$order_field = 'calendar.day_of_year',
					$order_direction = 'desc',
					$limit = -1,
					$use_join = TRUE,
					$join_array,
					$group_by = array('users_deals.id')
					);


				// ** create transaction array with grouped user_deals array
				foreach( $users_deals_grouped  as  $one_user_deal_grouped ){

						$transaction['authorize_transactionId'] = $one_user_deal_grouped->authorize_transactionId;
						$transaction['deal_id'] = $one_user_deal_grouped->deal_id;
						$transaction['status'] = $one_user_deal_grouped->status;
						$transaction['user_id'] = $one_user_deal_grouped->user_id;
						$transaction['deal_will_expire'] = $one_user_deal_grouped->deal_will_expire;
						$transaction['created'] = $one_user_deal_grouped->created;
						$transaction['first_name'] = $one_user_deal_grouped->first_name;
						$transaction['last_name'] = $one_user_deal_grouped->last_name;
						$transaction['deal_price'] = $one_user_deal_grouped->deal_price;
						$transaction['company_name'] = $one_user_deal_grouped->company_name;
						$transaction['deal_short_description'] = $one_user_deal_grouped->deal_short_description;
						$transaction['authorize_customerProfileId'] = $one_user_deal_grouped->authorize_customerProfileId;
						$transaction['authorize_paymentProfileId'] = $one_user_deal_grouped->authorize_paymentProfileId;
						$transaction['authorize_customerAddressId'] = $one_user_deal_grouped->authorize_customerAddressId;
						$transaction['calendar_id'] = $one_user_deal_grouped->calendar_id;
						$transaction['deal_url'] = $one_user_deal_grouped->deal_url;

						foreach( $users_deals  as  $user_deal){

								if( $user_deal->authorize_transactionId == $one_user_deal_grouped->authorize_transactionId ){

									$one_user_deal['id'] = $user_deal->user_deal_id;
									$one_user_deal['redeemed'] = $user_deal->redeemed;
								  $user_deals[] = $one_user_deal;
								  unset($one_user_deal);
									$transaction['user_deals'] = $user_deals;
								};

						}

						unset($user_deals);

						$transaction['total'] = $one_user_deal_grouped->deal_price * count( $transaction['user_deals'] );

						$transactions[] = $transaction;

						unset($transaction);

				}


		if( !isset( $transactions )){
			$transactions=array();
		};

		$this->load->view('home/mydeals_view', array(
			'transactions' => $transactions
			));
	}

	/**
	 * voucher
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/mydeals
	 * @access public
	 */

	public function  voucher(){

		$user_deal_id =  $this->uri->segment(3);

			// ** Group by authorize_transactionId the user_deals that are inactive and associated with deal_id
		$select_what =  '
										 users_deals.id as user_deal_id,
										 users_deals.created,
										 users_deals.authorize_transactionId,
										 users_deals.status,
										 users.id as user_id,
										 users.first_name,
										 users.last_name,
										 deal_short_description,
										 deals.deal_price,
										 deals.deal_will_expire,
										 deals.deal_finepoints,
										 deals.id as deal_id,
										 deal_headline,
										 vendors.company_name,
										 vendors.address,
										 vendors.city,
										 vendors.state,
										 vendors.zipcode,
										 vendors.telephone,
										 vendors.vendor_website
										 ';

				$where_array = array(
				'users_deals.id' => $user_deal_id
				);


				$join_array = array(
											'users' => 'users.id = users_deals.user_id',
											'deals' => 'deals.id = users_deals.deal_id',
											'vendors' => 'vendors.id = deals.vendor_id',
											'calendar' => 'deals.id = calendar.deal_id'
											);

				$deals = $this->my_database_model->select_from_table(
					$table = 'users_deals',
					$select_what,
					$where_array,
					$use_order = TRUE,
					$order_field = 'authorize_transactionId, user_deal_id',
					$order_direction = 'desc',
					$limit = -1,
					$use_join = TRUE,
					$join_array,
					$group_by = array('users_deals.id')
					);

		$this->load->view('home/voucher_view', array(
			'deals' => $deals
			));

	}


	/**
	 * howitworks
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/howitworks
	 * @access public
	 */

	public function howitworks(){

		$select_what =  '*';

				$where_array = array(
		  	'id' => 1
				);

		$website = $this->my_database_model->select_from_table( $table = 'website', $select_what, $where_array, $use_order = TRUE, $order_field = 'id', $order_direction = 'desc', $limit = 1, $use_join = FALSE, $join_array= array() );


		$this->load->view('home/howitworks_view',
		array(
			'website' => $website,
			'site_id' => $this->site_id,
			'deal_id' => $this->deal_id,
			'from_logout' => $this->from_logout
			));
	}










	/**
	 * FAQ
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/faqs
	 * @access public
	 */

	public function faq(){

		$select_what =  '*';

				$where_array = array(
		  	'id' => 1
				);

		$website = $this->my_database_model->select_from_table( $table = 'website', $select_what, $where_array, $use_order = TRUE, $order_field = 'id', $order_direction = 'desc', $limit = 1, $use_join = FALSE, $join_array= array() );


		$this->load->view('home/faq_view',
		array(
		'website' => $website,
		'site_id' => $this->site_id,
		'deal_id' => $this->deal_id,
		'from_logout' => $this->from_logout
		));
	}



	/**
	 * terms
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/mydeals
	 * @access public
	 */

	public function terms(){

		$select_what =  '*';

				$where_array = array(
		  	'id' => 1
				);

		$website = $this->my_database_model->select_from_table( $table = 'website', $select_what, $where_array, $use_order = TRUE, $order_field = 'id', $order_direction = 'desc', $limit = 1, $use_join = FALSE, $join_array= array() );


		$this->load->view('home/terms_view',
		array(
		'website' => $website,
		'site_id' => $this->site_id,
		'deal_id' => $this->deal_id,
		'from_logout' => $this->from_logout
		));
	}


	/**
	 * returns
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/mydeals
	 * @access public
	 */

	public function returns(){

		$select_what =  '*';

				$where_array = array(
		  	'id' => 1
				);

		$website = $this->my_database_model->select_from_table( $table = 'website', $select_what, $where_array, $use_order = TRUE, $order_field = 'id', $order_direction = 'desc', $limit = 1, $use_join = FALSE, $join_array= array() );


		$this->load->view('home/returns_view',
		array(
			'website' => $website,
			'site_id' => $this->site_id,
			'deal_id' => $this->deal_id,
			'from_logout' => $this->from_logout
			));
	}



	/**
	 * aboutus
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/mydeals
	 * @access public
	 */

	public function aboutus(){

		$select_what =  '*';

				$where_array = array(
		  	'id' => 1
				);

		$website = $this->my_database_model->select_from_table( $table = 'website', $select_what, $where_array, $use_order = TRUE, $order_field = 'id', $order_direction = 'desc', $limit = 1, $use_join = FALSE, $join_array= array() );


		$this->load->view('home/aboutus_view',
			array(
				'website' => $website,
				'site_id' => $this->site_id,
				'deal_id' => $this->deal_id,
				'from_logout' => $this->from_logout));
	}



	/**
	 * privacy
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/mydeals
	 * @access public
	 */

	public function privacy(){

		$select_what =  '*';

				$where_array = array(
		  	'id' => 1
				);

		$website = $this->my_database_model->select_from_table( $table = 'website', $select_what, $where_array, $use_order = TRUE, $order_field = 'id', $order_direction = 'desc', $limit = 1, $use_join = FALSE, $join_array= array() );


		$this->load->view('home/privacy_view',
		array(
			'website' => $website,
			'site_id' => $this->site_id,
			'deal_id' => $this->deal_id,
			'from_logout' => $this->from_logout
			));
	}



	/**
	 * press
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/mydeals
	 * @access public
	 */

	public function press(){

		$select_what =  '*';

				$where_array = array(
		  	'id' => 1
				);

		$website = $this->my_database_model->select_from_table( $table = 'website', $select_what, $where_array, $use_order = TRUE, $order_field = 'id', $order_direction = 'desc', $limit = 1, $use_join = FALSE, $join_array= array() );


		$this->load->view('home/press_view',
			array(
			'website' => $website,
			'site_id' => $this->site_id,
			'deal_id' => $this->deal_id,
		  'from_logout' => $this->from_logout
			));
	}






	/**
	 * register
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/register
	 * @access public
	 */

	public function register(){


		if( $this->input->post() ){
			$error = $this->query->register_process(  $this->input->post() );
		}else{
			$error['type']= '';
		};


		$this->load->view('home/register_view',
			array(
				'error' => $error,
				'site_id' => $this->site_id,
				'deal_id' => $this->deal_id,
				'from_logout' => $this->from_logout));
	}


	/**
	 * suggest
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/suggest
	 * @access public
	 */

	public function suggest(){


		$this->my_database_model->create_generic_table($table = 'suggestions');

		if( $this->input->post() ){
			$error = $this->register_process($email = $this->input->post('email'));
		}else{
			$error['type']= '';
		};


		$this->load->view('home/suggest_view',
				array('error' => $error,
				'site_id' => $this->site_id,
				'deal_id' => $this->deal_id,
				'from_logout' => $this->from_logout
		));
	}


		/**
	 * update_suggest
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/update_suggest
	 * @access public
	 */

	public function update_suggest(){

			$suggestion['business_name'] =  $this->input->post('business_name');
			$suggestion['business_website'] =  $this->input->post('business_website');
			$suggestion['contact_name'] =  $this->input->post('contact_name');
			$suggestion['contact_email'] =  $this->input->post('contact_email');
			$suggestion['contact_phone'] =  $this->input->post('contact_phone');

			$this->query->insert_into_suggest(
				$suggestion
			);

			$server_response['type'] = 'success';
			$server_response['message'] = "Thanks " .$suggestion['contact_name']. "! We’ll be contacting you shortly and look forward to doing business with you.";

			$this->load->view('home/success_view', array(
				'server_response'=>$server_response,
				'site_id' => $this->site_id,
				'deal_id' => $this->deal_id,
				'from_logout' => $this->from_logout ));
	}



	/**
	 * validate_account
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/validate_account
	 * @access public
	 */

	public function validate_account(){



		$set_what_array = array(
								'activate' => 1
								);

		$this->my_database_model->update_table( $table = 'users', $primary_key = $this->uri->segment(3), $set_what_array );



		$select_what =  'fullname';

		$where_array = array('id' => $this->uri->segment(3));

		$user = $this->my_database_model->select_from_table( $table = 'users', $select_what, $where_array, $use_order = false, $order_field = 'id', $order_direction = 'desc', $limit = -1, $use_join = FALSE, $join_array = array());

		$this->load->view('home/validate_account_view', array('user' => $user,'site_id' => $this->site_id, 'deal_id' => $this->deal_id ));


	}



	/**
	 * check_for_duplicate_email
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/check_for_duplicate_email
	 * @access public
	 */

	public function check_for_duplicate_email(){

		$table = 'users';

		$where_array = array('email' => $this->input->post('email'));


	  if( $this->my_database_model->check_if_exist($where_array, $table)){

				echo 'true';

		}else{

				echo 'false';
		}

	}



	/**
	 * buy
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/buy
	 * @access public
	 */

	public function buy(){

		//brk

		//echo '<pre>';print_r( $this->input->post()  );echo '</pre>';exit;

		$this->load->model('my_payment_model');

		if(   $this->deal_id == ''  ){
			$deals = $this->query->get_today_deal(  $this->priority );
		};


		if(  isset( $this->session->userdata['user_id'] )  ){
			$quantity_available_to_user =  (int)$deals[0]->each_can_buy - (int)$this->how_many_user_bought($calendar_id = $deals[0]->calendar_id, $user_id = $this->users[0]->id);
		}else{
			$quantity_available_to_user =  (int)$deals[0]->each_can_buy;
			$payment_info_pairs = array();
		}


		$howmany_left =   ( (int)$deals[0]->maximum_quantity -  (int)$this->query->how_many_bought_during_one_booked_segment($calendar_id = $deals[0]->calendar_id)) ;

		if( $howmany_left <= $quantity_available_to_user ){
					$quantity_available_to_user = $howmany_left;
		};

		// echo '<pre>';print_r(  $this->input->post()  );echo '</pre>';  exit;

		if( $this->input->post() ){

								$has_errors = $this->posting_has_errors( $this->input->post());

								if(  !$this->input->post('use_card_on_file') && $has_errors['outcome'] == 'FIELDS CONTAIN BLANKS' ){

														$server_response['type'] = 'Contain Blank Fields';
														$server_response['bad_fields'] = $has_errors['bad_fields'];
														$server_response['message'] = 'All fields must be filled out in order to proceed with this transaction.';

														$this->show_buy_view(
														$server_response,
														$deals,
														$quantity_available_to_user,
														$payment_info_pairs = $this->input->post(),
												$options1 = $this->tools->object_to_array(  $this->query->get_options( array('table'=>'options1','deal_id' => $deals[0]->deal_id) ) ),
												$options2 = $this->tools->object_to_array(  $this->query->get_options( array('table'=>'options2','deal_id' => $deals[0]->deal_id) ) )
														);

								}elseif(  !$this->input->post('use_card_on_file') && $has_errors['outcome'] == 'BAD CREDIT CARD' ){

														$server_response['type'] = 'BAD CREDIT CARD';
														$server_response['bad_fields'] = $has_errors['bad_fields'];
														$server_response['message'] = 'Please ensure your credit card number is correctly filled.';

														$this->show_buy_view(
														$server_response,
														$deals,
														$quantity_available_to_user,
														$payment_info_pairs = $this->input->post(),
												$options1 = $this->tools->object_to_array(  $this->query->get_options( array('table'=>'options1','deal_id' => $deals[0]->deal_id) ) ),
												$options2 = $this->tools->object_to_array(  $this->query->get_options( array('table'=>'options2','deal_id' => $deals[0]->deal_id) ) )
														);

								}else{

											$server_response = $this->buy_post($deals);

											if(  $server_response['type'] == 'success'
												|| $server_response['type'] == 'successful authorization'
											){

														$this->load->view('home/success_view', array(
															'server_response'=>$server_response,
															'site_id' => $this->site_id,
															'deal_id' => $this->deal_id ));

											}
											elseif(  $server_response['type'] == 'A duplicate transaction has been submitted.'
														|| $server_response['type'] == 'user exceeded each can buy'
														|| $server_response['type'] == 'NEW SIGNUP PASSWORD NOT MATCH EXISTING ACCOUNT'
											){

														$this->load->view('home/error_view', array(
														'server_response'=>$server_response,
														'site_id' => $this->site_id,
														'deal_id' => $this->deal_id,
														'from_logout' => $this->from_logout
														));

											}else{

														$this->show_buy_view(
														$server_response,
														$deals,
														$quantity_available_to_user,
														$payment_info_pairs =  $this->input->post(),
														$options1 = $this->tools->object_to_array(  $this->query->get_options( array('table'=>'options1','deal_id' => $deals[0]->deal_id) ) ),
														$options2 = $this->tools->object_to_array(  $this->query->get_options( array('table'=>'options2','deal_id' => $deals[0]->deal_id) ) ));

											};
								};

		}else{

									if(  isset( $this->session->userdata['user_id'] )
											&& $this->users[0]->authorize_customerProfileId != ''
										){


										$payment_info_pairs = $this->prepare_payment_info_pairs($this->users[0]->authorize_customerProfileId);


									}else{
										$payment_info_pairs = array();
									};



									if( $quantity_available_to_user < 1){

												$server_response['message']='You have exceeded the quota for number of purchases for this deal. ';

												$this->load->view('home/error_view', array(
												'server_response'=>$server_response,
												'site_id' => $this->site_id,
												'deal_id' => $this->deal_id,
												'from_logout' => $this->from_logout
												));

									}else{


											$server_response['type'] = '';

											$this->show_buy_view(
												$server_response,
												$deals,
												$quantity_available_to_user,
												$payment_info_pairs,
												$options1 = $this->tools->object_to_array(  $this->query->get_options( array('table'=>'options1','deal_id' => $deals[0]->deal_id) ) ),
												$options2 = $this->tools->object_to_array(  $this->query->get_options( array('table'=>'options2','deal_id' => $deals[0]->deal_id) ) )
											);

									};

		};


	}


	/**
	 * continue_buy
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/purchase
	 * @access public
	 */

	private function buy_post($deals){



		// IF LOGIN-IN USER DOES NOT HAS AUTHORIZE ACCOUNT INFO OR IF USER WANT TO USE A NEW DIFFERENT CARD
		if( isset( $this->session->userdata['user_id'] )
			&& $this->users[0]->authorize_customerProfileId == ''
			|| $this->input->post('use_card_on_file') == ''
			&& isset( $this->session->userdata['user_id'] )
			){



				if($this->error_check_mode == TRUE) echo "USER ARRAY"."<hr />";
				if($this->error_check_mode == TRUE) echo'<pre> ';
				if($this->error_check_mode == TRUE) print_r(  $this->users   );
				if($this->error_check_mode == TRUE) echo'</pre> ';
				if($this->error_check_mode == TRUE) echo "<hr />";

													if($this->error_check_mode == TRUE) echo "FORM POST - LOGIN-IN USER DOES NOT HAS AUTHORIZE ACCOUNT INFO"."<br />";
													if($this->error_check_mode == TRUE) echo "OR IF USER WANT TO USE A NEW DIFFERENT CARD"."<hr />";
													if($this->error_check_mode == TRUE) echo'<pre> ';
													if($this->error_check_mode == TRUE)
													if($this->error_check_mode == TRUE) print_r(  $this->input->post()   );
													if($this->error_check_mode == TRUE) echo'</pre> ';

													$users = $this->users;

													if( $this->input->post('use_card_on_file') == '' ){
														$this->remove_authorize_payment_information($users);
													};

													$users['id'] = $users[0]->id;
													$users['status'] = 'old account';

													$shipping_info = $this->get_shipping_info();

													// CREATE PAYMENT PROFILE AT AUTHORIZE.NET
													$response = $this->my_payment_model->create_payment_profile(
														$firstname = $this->input->post('cc_first_name'),
														$lastname = $this->input->post('cc_last_name'),
														$email = $users[0]->email,
														$cc_num = $this->input->post('cc_num'),
														$month_exp = $this->input->post('month_exp'),
														$year_exp = $this->input->post('year_exp'),
														$cc_address = $this->input->post('cc_address'),
														$cc_city = $this->input->post('cc_city'),
														$cc_state = $this->input->post('cc_state'),
														$cc_zipcode = $this->input->post('cc_zipcode'),
														$cc_phonenumber = $this->input->post('cc_phone'),
												    $shipping_info['first_name'],
												    $shipping_info['last_name'],
												    $shipping_info['address'],
												    $shipping_info['city'],
												    $shipping_info['state'],
												    $shipping_info['zipcode']
												 );



												 if( $response->isOk() ){

																$users['authorize_customerProfileId'] = $response->getCustomerProfileId();
																$users['authorize_paymentProfileId'] =  $response->getCustomerPaymentProfileIds();
																$users['authorize_customerAddressId'] =  $response->getCustomerShippingAddressIds();


																if($this->error_check_mode == TRUE) echo "CREATE NEW CUSTOMER ACCOUNT AT AUTHORIZE"."<hr />";
																if($this->error_check_mode == TRUE) echo'<pre> ';
																if($this->error_check_mode == TRUE) print_r(  $response   );


																// UPDATE EXISTING ACCOUNT WITH NEW AUTHORIZE.NET ACCOUNT INFO
																$set_what_array = array(
																						'shipping_first_name' => $shipping_info['first_name'],
																						'shipping_last_name'	 => $shipping_info['last_name'],
																						'shipping_address' 	 => $shipping_info['address'],
																						'shipping_city'	 	  => $shipping_info['city'],
																						'shipping_state'	 => $shipping_info['state'],
																						'shipping_zipcode'  => $shipping_info['zipcode'],
																						'authorize_customerProfileId' => $users['authorize_customerProfileId'],
																						'authorize_paymentProfileId' => $users['authorize_paymentProfileId'],
																						'authorize_customerAddressId' => $users['authorize_customerAddressId'],
																						'last_three' => substr(   $this->input->post('cc_num')  , -3)
																						);

																$this->my_database_model->update_table( $table = 'users', $primary_key = $users[0]->id, $set_what_array );

												}else{

																if($this->error_check_mode == TRUE) echo "CREATE NEW CUSTOMER ACCOUNT AT AUTHORIZE"."<hr />";
																if($this->error_check_mode == TRUE) echo'<pre> ';
																if($this->error_check_mode == TRUE) print_r(  $response   );
																if($this->error_check_mode == TRUE) echo'</pre> ';

																$users['authorize_customerProfileId'] = '';
																$users['authorize_paymentProfileId'] =  '';
																$users['authorize_customerAddressId'] = '';

												}



		// IF LOGIN-IN USER HAS AUTHORIZE ACCOUNT INFO
		}else if( isset( $this->users[0]->authorize_customerProfileId )
		&& $this->users[0]->authorize_customerProfileId != '' ){


													if($this->error_check_mode == TRUE) echo "FORM POST - LOGIN-IN USER HAS AUTHORIZE ACCOUNT INFO "."<hr />";
													if($this->error_check_mode == TRUE) echo'<pre> ';
													if($this->error_check_mode == TRUE) print_r(  $this->input->post()   );
													if($this->error_check_mode == TRUE) echo'</pre> ';

													$users = $this->users;

													$users['status'] = 'old account';
													$users['id'] = $users[0]->id;

											   	$users['authorize_customerProfileId'] = $users[0]->authorize_customerProfileId;
											   	$users['authorize_paymentProfileId'] = $users[0]->authorize_paymentProfileId;
											   	$users['authorize_customerAddressId'] = $users[0]->authorize_customerAddressId;


		// IF USER IS ATTEMPTING TO PURCHASE WITHOUT LOGGING IN
		}else {

													if($this->error_check_mode == TRUE) echo "FORM POST - BRAND NEW USER "."<hr />";
													if($this->error_check_mode == TRUE) echo'<pre> ';
													if($this->error_check_mode == TRUE) print_r(  $this->input->post()   );
													if($this->error_check_mode == TRUE) echo'</pre> ';

													$email = $this->input->post('email');

													$users = $this->get_user_id_or_create_user_account($email, $password = $this->input->post('password_signup'));


													if( $users['status'] == 'NEW SIGNUP PASSWORD NOT MATCH EXISTING ACCOUNT'){

														$server_response['type'] = 'NEW SIGNUP PASSWORD NOT MATCH EXISTING ACCOUNT';
														$server_response['message'] = 'Your account had already been created in the system before and the password you entered is not valid.';

														return $server_response;

													}

		}


		if($this->error_check_mode == TRUE) echo "USERS ARRAY SEND TO PROCESS TRANSACTION"."<hr />";
		if($this->error_check_mode == TRUE) echo'<pre> ';
		if($this->error_check_mode == TRUE) print_r(  $users   );
		if($this->error_check_mode == TRUE) echo'</pre> ';



		//** PROCESS TRANSACTION
		$server_response = $this->process_transaction(
		$deals,
		$quantity = (int)$this->input->post('quantity'),
		$users['id'],
   	$users['authorize_customerProfileId'],
   	$users['authorize_paymentProfileId'],
   	$users['authorize_customerAddressId'],
   	$cvv = $this->input->post('cc_code'));


		if($this->error_check_mode == TRUE) echo "response in the payment"."<hr />";;
		if($this->error_check_mode == TRUE) echo'<pre> ';
		if($this->error_check_mode == TRUE) print_r(  $server_response  );
		if($this->error_check_mode == TRUE) echo'</pre> ';


		$error_array = array(
			'error in authorization',
			'error in capture',
			'The credit card has expired.',
			'This transaction has been declined.',
			'The transaction has been declined because of an AVS mismatch. The address provided does not match billing address of cardholder.',
			'The credit card number is invalid'
		);

		// ** REMOVE AUTHORIZE ACCOUNT IF PAYMENT WAS BAD
		if( in_array($server_response['type'], $error_array) 
		){

			$response = $this->my_payment_model->get_customer_profile($users['authorize_customerProfileId']);

				if( $response->isOk() ){
						$payment_info_pairs = array(
						'cc_first_name'=>$response->xml->profile->paymentProfiles->billTo->firstName,
						'cc_last_name'=>$response->xml->profile->paymentProfiles->billTo->lastName,
						'cc_address'=>$response->xml->profile->paymentProfiles->billTo->address,
						'cc_city'=>$response->xml->profile->paymentProfiles->billTo->city,
						'cc_state'=>$response->xml->profile->paymentProfiles->billTo->state,
						'cc_zipcode'=>$response->xml->profile->paymentProfiles->billTo->zip
						);
				};

				// $server_response['payment_info_pairs'] = $payment_info_pairs;


			$this->remove_authorize_payment_information($users);
		};


		return $server_response;

	}



		/**
	 * update_profile
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/update_suggest
	 * @access public
	 */

	public function update_profile(){

			$this->query->update_profile(
				$post_array = $this->input->post(),
				$user_id = $this->users[0]->id
			);

			$server_response['type'] = 'success';
			$server_response['message'] = "Your profile has been updated.";

			$this->load->view('home/success_view', array(
				'server_response'=>$server_response,
				'site_id' => $this->site_id,
				'deal_id' => $this->deal_id)
			);
	}




	/**
	 * myprofile
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

	public function myprofile(){

		if(  isset( $this->session->userdata['user_id'] )  ){

			$users = $this->tools->object_to_array($this->users[0]);

			$data = array(
										'users' => $users,
										'site_id' => $this->site_id,
										'deal_id' => $this->deal_id,
										'from_logout' => $this->from_logout
										);

			$this->load->view('home/myprofile_view', $data);

		}else{

			redirect('/home');

		};


	}






	/**
	 * mycredit
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

	public function mycredits(){


		$this->load->view('home/mycredits_view', array() );

	}
















	/**
	 * mypayment
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

	public function mypayment(){

		$this->load->model('my_payment_model');


		if(  isset( $this->session->userdata['user_id'] )
				&& $this->users[0]->authorize_customerProfileId != ''
			){


			$payment_info_pairs = $this->prepare_payment_info_pairs($this->users[0]->authorize_customerProfileId);


		}else{
			$payment_info_pairs = array();
		};



		$data = array(
									'payment_info_pairs'=> $payment_info_pairs,
									'site_id' => $this->site_id,
									'deal_id' => $this->deal_id,
									'public_gallery' => $this->get_public_gallery($limit = 3)
									);

		$this->load->view('home/mypayment_info_view', $data);

	}



	/**
	 * update_payment
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

	public function update_payment(){



			$users = $this->users;

			$this->load->model('my_payment_model');

			$this->remove_authorize_payment_information($users);

			$users['id'] = $users[0]->id;

	    $shipping_info['first_name'] = $this->input->post('shipping_first_name');
	    $shipping_info['last_name'] = $this->input->post('shipping_last_name');
	    $shipping_info['address'] = $this->input->post('shipping_address');
	    $shipping_info['city'] = $this->input->post('shipping_city');
	    $shipping_info['state'] = $this->input->post('shipping_state');
	    $shipping_info['zipcode'] = $this->input->post('shipping_zipcode');


			// CREATE PAYMENT PROFILE AT AUTHORIZE.NET
			$response = $this->my_payment_model->create_payment_profile(
				$firstname = $this->input->post('cc_first_name'),
				$lastname = $this->input->post('cc_last_name'),
				$email = $users[0]->email,
				$cc_num = $this->input->post('cc_num'),
				$month_exp = $this->input->post('month_exp'),
				$year_exp = $this->input->post('year_exp'),
				$cc_address = $this->input->post('cc_address'),
				$cc_city = $this->input->post('cc_city'),
				$cc_state = $this->input->post('cc_state'),
				$cc_zipcode = $this->input->post('cc_zipcode'),
				$cc_phonenumber = $this->input->post('cc_phone'),
		    $shipping_info['first_name'],
		    $shipping_info['last_name'],
		    $shipping_info['address'],
		    $shipping_info['city'],
		    $shipping_info['state'],
		    $shipping_info['zipcode']
		 );

		 if( $response->isOk() ){

						$users['authorize_customerProfileId'] = $response->getCustomerProfileId();
						$users['authorize_paymentProfileId'] =  $response->getCustomerPaymentProfileIds();
						$users['authorize_customerAddressId'] =  $response->getCustomerShippingAddressIds();


						if($this->error_check_mode == TRUE) echo "CREATE NEW CUSTOMER ACCOUNT AT AUTHORIZE"."<hr />";
						if($this->error_check_mode == TRUE) echo'<pre> ';
						if($this->error_check_mode == TRUE) print_r(  $response   );
						if($this->error_check_mode == TRUE) echo'</pre> ';

						// UPDATE EXISTING ACCOUNT WITH NEW AUTHORIZE.NET ACCOUNT INFO
						$set_what_array = array(
												'authorize_customerProfileId' => $users['authorize_customerProfileId'],
												'authorize_paymentProfileId' => $users['authorize_paymentProfileId'],
												'authorize_customerAddressId' => $users['authorize_customerAddressId'],
												'last_three' => substr(   $this->input->post('cc_num')  , -3),
												'shipping_first_name' => $shipping_info['first_name'],
												'shipping_last_name'	 => $shipping_info['last_name'],
												'shipping_address' 	 => $shipping_info['address'],
												'shipping_city'	 	  => $shipping_info['city'],
												'shipping_state'	 => $shipping_info['state'],
												'shipping_zipcode'  => $shipping_info['zipcode']
												);

						$this->my_database_model->update_table( $table = 'users', $primary_key = $users[0]->id, $set_what_array );


						$server_response['message'] = 'Your payment has been updated sucessfully';

						$this->load->view('home/success_view', array(
							'server_response'=>$server_response,
							'site_id' => $this->site_id,
							'deal_id' => $this->deal_id ));




		}else{

						if($this->error_check_mode == TRUE) echo "ERROR FROM AUTHORIZE"."<hr />";
						if($this->error_check_mode == TRUE) echo'<pre> ';
						if($this->error_check_mode == TRUE) print_r(  $response   );
						if($this->error_check_mode == TRUE) echo'</pre> ';


						$users['authorize_customerProfileId'] = '';
						$users['authorize_paymentProfileId'] =  '';
						$users['authorize_customerAddressId'] = '';


					$server_response['message'] = 'an error has occurred.';

					$payment_info_pairs = $this->prepare_payment_info_pairs($this->users[0]->authorize_customerProfileId);

					$data = array(
												'payment_info_pairs'=> $payment_info_pairs,
												'site_id' => $this->site_id,
												'deal_id' => $this->deal_id,
												'public_gallery' => $this->get_public_gallery($limit = 3)
												);




						$this->load->view('home/mypayment_info_view',$data );


		}

	}

	/**
	 * show_buy_view
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/


	private function show_buy_view($server_response, $deals, $quantity_available_to_user, $payment_info_pairs, $options1=0, $options2=0){

				$data =array(
					'server_response'=> $server_response,
					'users' => $this->users,
					'deals' => $deals,
					'site_id' => $this->site_id,
					'deal_id' => $this->deal_id,
					'quantity_available_to_user' => $quantity_available_to_user,
					'payment_info_pairs' => $payment_info_pairs,
					'public_gallery' => $this->get_public_gallery($limit = 5),
					'from_logout' => $this->from_logout,
					'options1' => $options1,
					'options2' => $options2,
					'priority' => $this->priority
					);


				$this->load->view('home/buy_view',$data);


	}


	/**
	 * see_captured_transactions
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

	public function see_captured_transactions(){

				$status = $this->uri->segment(3);

				if( $this->uri->segment(4) !=''){
					$deals = $this->get_deal_by_calendar_id($this->uri->segment(4));
				}else{
					$deals = $this->query->get_today_deal(   $this->priority );
				};

				$deal_id = $deals[0]->deal_id;

				$where_array = array(
				'status' => $status,
				'users_deals.calendar_id' => $deals[0]->calendar_id
				);

				// ** Group by authorize_transactionId the user_deals that are inactive and associated with deal_id
				$select_what =  '
												 users_deals.authorize_transactionId,
												 users.id as user_id,
												 users.first_name,
												 users.last_name,
												 users.authorize_customerProfileId,
												 users.authorize_paymentProfileId,
												 users.authorize_customerAddressId,
												 users_deals.authorize_transactionId,
												 users_deals.id as user_deal_id,
												 deal_short_description,
												 deals.deal_price,
												 company_name,
												 calendar.year,
												 calendar.id as calendar_id
												 ';


				$join_array = array(
											'users' => 'users.id = users_deals.user_id',
											'deals' => 'deals.id = users_deals.deal_id',
											'vendors' => 'vendors.id = deals.vendor_id',
											'calendar' => 'deals.id = calendar.deal_id'
											);

				$users_deals_grouped = $this->my_database_model->select_from_table(
					$table = 'users_deals',
					$select_what,
					$where_array,
					$use_order = TRUE,
					$order_field = 'authorize_transactionId, user_deal_id',
					$order_direction = 'desc',
					$limit = -1,
					$use_join = TRUE,
					$join_array,
					$group_by = array('authorize_transactionId')
					);


				// ** Get array for ALL inactive user_deals by deal_id
				$select_what =  'users_deals.id as user_deal_id, users_deals.authorize_transactionId';



				$join_array = array(
											'users' => 'users.id = users_deals.user_id',
											'deals' => 'deals.id = users_deals.deal_id',
											'calendar' => 'deals.id = calendar.deal_id'
											);

				$users_deals = $this->my_database_model->select_from_table(
					$table = 'users_deals',
					$select_what,
					$where_array,
					$use_order = TRUE,
					$order_field = 'authorize_transactionId, users_deals.id',
					$order_direction = 'desc',
					$limit = -1,
					$use_join = TRUE,
					$join_array,
					$group_by = array('users_deals.id')
					);




				// ** create transaction array with grouped user_deals array
				foreach( $users_deals_grouped  as  $one_user_deal_grouped ){

						$transaction['authorize_transactionId'] = $one_user_deal_grouped->authorize_transactionId;
						$transaction['user_id'] = $one_user_deal_grouped->user_id;
						$transaction['first_name'] = $one_user_deal_grouped->first_name;
						$transaction['last_name'] = $one_user_deal_grouped->last_name;
						$transaction['deal_price'] = $one_user_deal_grouped->deal_price;
						$transaction['company_name'] = $one_user_deal_grouped->company_name;
						$transaction['deal_short_description'] = $one_user_deal_grouped->deal_short_description;
						$transaction['authorize_customerProfileId'] = $one_user_deal_grouped->authorize_customerProfileId;
						$transaction['authorize_paymentProfileId'] = $one_user_deal_grouped->authorize_paymentProfileId;
						$transaction['authorize_customerAddressId'] = $one_user_deal_grouped->authorize_customerAddressId;

						foreach( $users_deals  as  $user_deal){

								if( $user_deal->authorize_transactionId == $one_user_deal_grouped->authorize_transactionId ){
								  $user_deals[] = $user_deal->user_deal_id;
									$transaction['user_deals'] = $user_deals;
								};

						}

						unset($user_deals);

						$transaction['total'] = $one_user_deal_grouped->deal_price * count( $transaction['user_deals'] );

						$transactions[] = $transaction;

						unset($transaction);

				}

				if( !isset($transactions)  ) {echo 'No transactions found'; exit;		}

				echo "Total Deals of '" . $deals[0]->deal_short_description . "' Sold: ". count($users_deals)."<br />";
				echo "Calendar_id: ". $deals[0]->calendar_id."<br />";
				echo "deal_id: ". $deals[0]->deal_id."<br />";
				echo "Maximum that can be sold: ". $deals[0]->maximum_quantity."<br />";
				echo "Quantities Left for Sale: ". ($deals[0]->maximum_quantity - count($users_deals));

				echo '<pre>';print_r(  $transactions  );echo '</pre>';  exit;


	}

	/**
	 * activate_authorized_deals
	 *
	 * Using two query to user_deal table
	 * and organizing results into multi-level array
	 * with each array consisting of an array of user_deals associated with the purchaser
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

	private function activate_authorized_deals( $deals ){

				$where_array = array(
				'status' => 'inactive',
				'users_deals.calendar_id' => $deals[0]->calendar_id
				);


				/* GROUP BY AUTHORIZE_TRANSACTIONID THE USER_DEALS THAT ARE INACTIVE AND ASSOCIATED WITH DEAL_ID */
				$select_what =  '
												 users_deals.authorize_transactionId,
												 users.id as user_id,
												 users.first_name,
												 users.last_name,
												 users.authorize_customerProfileId,
												 users.authorize_paymentProfileId,
												 users.authorize_customerAddressId,
												 users_deals.authorize_transactionId,
												 users_deals.id as user_deal_id,
												 users_deals.promo_code_id as promo_code_id,
												 deal_short_description,
												 deals.deal_price,
												 company_name,
												 calendar.year
												 ';


				$join_array = array(
											'users' => 'users.id = users_deals.user_id',
											'deals' => 'deals.id = users_deals.deal_id',
											'vendors' => 'vendors.id = deals.vendor_id',
											'calendar' => 'deals.id = calendar.deal_id'
											);

				$users_deals_grouped = $this->my_database_model->select_from_table(
					$table = 'users_deals',
					$select_what,
					$where_array,
					$use_order = TRUE,
					$order_field = 'authorize_transactionId, user_deal_id',
					$order_direction = 'desc',
					$limit = -1,
					$use_join = TRUE,
					$join_array,
					$group_by = array('authorize_transactionId')
					);


				/* GET ARRAY FOR ALL INACTIVE USER_DEALS BY DEAL_ID */
				$select_what =  'users_deals.id as user_deal_id, 
												 users_deals.authorize_transactionId';



				$join_array = array(
											'users' => 'users.id = users_deals.user_id',
											'deals' => 'deals.id = users_deals.deal_id',
											'calendar' => 'deals.id = calendar.deal_id'
											);

				$users_deals = $this->my_database_model->select_from_table(
					$table = 'users_deals',
					$select_what,
					$where_array,
					$use_order = TRUE,
					$order_field = 'authorize_transactionId, users_deals.id',
					$order_direction = 'desc',
					$limit = -1,
					$use_join = TRUE,
					$join_array,
					$group_by = array('users_deals.id')
					);


				/* CREATE TRANSACTION ARRAY WITH GROUPED USER_DEALS ARRAY */
				foreach( $users_deals_grouped  as  $one_user_deal_grouped ){

						$transaction['authorize_transactionId'] = $one_user_deal_grouped->authorize_transactionId;
						$transaction['promo_code_id'] = $one_user_deal_grouped->promo_code_id;
						$transaction['user_id'] = $one_user_deal_grouped->user_id;
						$transaction['first_name'] = $one_user_deal_grouped->first_name;
						$transaction['last_name'] = $one_user_deal_grouped->last_name;
						$transaction['deal_price'] = $one_user_deal_grouped->deal_price;
						$transaction['company_name'] = $one_user_deal_grouped->company_name;
						$transaction['deal_short_description'] = $one_user_deal_grouped->deal_short_description;
						$transaction['authorize_customerProfileId'] = $one_user_deal_grouped->authorize_customerProfileId;
						$transaction['authorize_paymentProfileId'] = $one_user_deal_grouped->authorize_paymentProfileId;
						$transaction['authorize_customerAddressId'] = $one_user_deal_grouped->authorize_customerAddressId;

						foreach( $users_deals  as  $user_deal){

								if( $user_deal->authorize_transactionId == $one_user_deal_grouped->authorize_transactionId ){
								  $user_deals[] = $user_deal->user_deal_id;
									$transaction['user_deals'] = $user_deals;
								};

						}

						unset($user_deals);


						
						$discount = ( $transaction['promo_code_id'] != 0 ? $this->query->get_promo_code_value_by_id( $transaction['promo_code_id']) : 0 );

						$transaction['total'] = ($one_user_deal_grouped->deal_price * count( $transaction['user_deals'] )) - $discount;

						$transactions[] = $transaction;

						unset($transaction);

				}


				if( !isset($transactions)  ) return;

				/* CAPTURE PREVIOUSLY AUTHORIZED DEALS */
				foreach( $transactions  as  $transaction){

					$response = $this->my_payment_model->capture_prior_authorized_transaction(
								$total_transaction_value = $transaction['total'],
								$user_deal_processed = $transaction['user_deals'],
								$unit_price = $transaction['deal_price'],
								$title_of_purchase = 'Zekeszoo Deal for '. $transaction['company_name'],
								$deal_short_description = $transaction['deal_short_description'],
						   	$authorize_customerProfileId = $transaction['authorize_customerProfileId'],
						   	$authorize_paymentProfileId = $transaction['authorize_paymentProfileId'],
						   	$authorize_customerAddressId = $transaction['authorize_customerAddressId'],
						   	$transactionId = $transaction['authorize_transactionId']
					   );


				 	if( $response->isOk() ){


						// $content['total'] =  $transaction['total'];
						// $content['deal_price']  = $transaction['deal_price'];
						// $content['title_of_purchase']  = 'Zekeszoo Deal for '. $transaction['company_name']
						// send_deal_has_tipped_your_purshase_has_processed_email( $content );


				 			foreach( $transaction['user_deals']  as  $user_deal_id ){

									$set_what_array = array(
															'status' => 'active',
															);

									$this->my_database_model->update_table(
										$table = 'users_deals',
										$primary_key = $user_deal_id,
										$set_what_array
										);

				 			}

					};

				}

				//** update tipped at with datetime
				$set_what_array = array(
										'tipped_time' =>  date('Y-m-d H:i:s')
										);

				$where_array = array(
				'id' => $deals[0]->calendar_id
				);


				$this->my_database_model->update_table_where(
					$table = 'calendar',
					$where_array,
					$set_what_array
					);

				return;

	}

	/**
	 * prepare_payment_info_pairs
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/
	private function prepare_payment_info_pairs($authorize_customerProfileId){

		$response = $this->my_payment_model->get_customer_profile($this->users[0]->authorize_customerProfileId);

		if( $response->isOk() ){
				return array(
				'cc_first_name'=>$response->xml->profile->paymentProfiles->billTo->firstName,
				'cc_last_name'=>$response->xml->profile->paymentProfiles->billTo->lastName,
				'cc_address'=>$response->xml->profile->paymentProfiles->billTo->address,
				'cc_city'=>$response->xml->profile->paymentProfiles->billTo->city,
				'cc_state'=>$response->xml->profile->paymentProfiles->billTo->state,
				'cc_zipcode'=>$response->xml->profile->paymentProfiles->billTo->zip,
				'cc_phone'=>$response->xml->profile->paymentProfiles->billTo->phoneNumber,
				'shipping_first_name'=>$response->xml->profile->shipToList->firstName,
				'shipping_last_name'=>$response->xml->profile->shipToList->lastName,
				'shipping_address'=>$response->xml->profile->shipToList->address,
				'shipping_city'=>$response->xml->profile->shipToList->city,
				'shipping_state'=>$response->xml->profile->shipToList->state,
				'shipping_zipcode'=>$response->xml->profile->shipToList->zip
				);
		}else{
				return array();
		};

	}


	/**
	 * process transaction
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

		private function process_transaction(
		  $deals,
			$quantity,
			$user_id,
			$authorize_customerProfileId,
			$authorize_paymentProfileId,
			$authorize_customerAddressId,
			$cvv
		){

				if( $this->did_user_exceed_each_can_buy($want_to_buy = $quantity, $deals, $user_id ) ){
					$server_response['type'] = 'user exceeded each can buy';
					$bad_fields = array();

					$server_response['bad_fields'] = $bad_fields;
					$server_response['message']='You have exceeded the quota for number of purchases for this deal. ';

					return $server_response;
				};


				$did_deal_tip = $this->did_deal_tip( $want_to_buy = $quantity, $deals );

				if( $did_deal_tip ){
					$this->activate_authorized_deals( $deals );
					$status = 'active';
				}else{
					$status = 'inactive';
				};


				
				$promo_codes = $this->query->get_promo_codes_by_code($this->input->post('promo_code'));

				$discount = ( is_array( $promo_codes ) ? $promo_codes[0]->value : 0 );
				$discount_desc = ( is_array( $promo_codes ) ? ' (promo-'.$this->input->post('promo_code').': -$'.$promo_codes[0]->value.')' : '' );
				$promo_code_id = ( is_array( $promo_codes ) ? $promo_codes[0]->id : 0 );
				$total_transaction_value = ( (float)$deals[0]->deal_price * $quantity ) - $discount;

				$cc_transaction_description = $quantity . ' item(s) of ' . $deals[0]->deal_short_description;


				/* AUTHORIZING TRANSACTION  */
				$response = $this->my_payment_model->authorize_only_transaction(
				   		$order_number = $user_id.'-'.$deals[0]->deal_id,
				   		$order_description = $cc_transaction_description.$discount_desc,
							$total_transaction_value,
					   	$authorize_customerProfileId,
					   	$authorize_paymentProfileId,
					   	$authorize_customerAddressId,
			   			$cvv
				   );


				if( $response->isOk() ){

						$transactionId = $response->getTransactionResponse()->transaction_id;

						for($i = 1 ; $i <= (int)$this->input->post('quantity'); $i++ ){

								$insert_what = array(
												'promo_code_id' => $promo_code_id,
												'option1_id' => (int)$this->input->post('option1_id'),
												'option2_id' => (int)$this->input->post('option2_id'),
												'calendar_id' => $deals[0]->calendar_id,
												'deal_id' => $deals[0]->deal_id,
												'user_id' => $user_id,
												'authorize_transactionId' => $transactionId,
												'status' => $status
												);

								$user_deal_id = $this->my_database_model->insert_table(
																$table = 'users_deals',
																$insert_what
																);




								if( $this->query->deal_has_voucher( $deals[0]->deal_id ) ){

										$vouchers = $this->query->get_unassigned_voucher( $deals[0]->deal_id  );

										if( count($vouchers ) > 0 ){

											$this->query->assign_voucher(
												array(
															'user_deal_id'=> $user_deal_id,
															'voucher_id'  => $vouchers[0]->id
															)
											);

										};

								};


								$user_deal_processed[] = 	$user_deal_id;

						}

						if( $did_deal_tip ){


										/* CAPTURING AUTHORIZED TRANSACTION  */
										$response = $this->my_payment_model->capture_prior_authorized_transaction(
													$total_transaction_value,
													$user_deal_processed,
													$unit_price = $deals[0]->deal_price,
													$title_of_purchase = 'Zekeszoo Deal for '. $deals[0]->company_name,
													$deal_short_description = $deals[0]->deal_short_description,
											   	$authorize_customerProfileId,
											   	$authorize_paymentProfileId,
											   	$authorize_customerAddressId,
											   	$transactionId
										   );


										if( $response->isOk() ){
											$server_response['type'] = 'success';
											$server_response['message'] = 'Your order has been processed.<br /><br />You will be receiving an email confirmation shortly.<br /><br />Enjoy and visit soon!';
										}else{
											$server_response['type'] = 'error in capture';
										};

						}else{

							$server_response['type'] = 'successful authorization';
							$server_response['message'] = 'This deal has not tipped yet.&nbsp;&nbsp;But as soon as it does, we will process your transaction and email you the good news.';
						}


						$content['deal_name'] =  $deals[0]->deal_short_description;
						$content['cc_transaction_description'] =  $cc_transaction_description;
						$content['did_deal_tip'] = $did_deal_tip;
						$this->send_thank_you_email( $content );



				}else{


					if($this->error_check_mode == TRUE) echo "ERROR IN AUTHORIZATION"."<hr />";
					if($this->error_check_mode == TRUE) echo'<pre> ';
					if($this->error_check_mode == TRUE) print_r(  $response  );
					if($this->error_check_mode == TRUE) echo'</pre> ';

					if($this->error_check_mode == TRUE) echo  $response->xml->messages->message->text."<br />";

					// brk 

					if( $response->xml->messages->message->text == 'A duplicate transaction has been submitted.'){
						$server_response['type'] = 'A duplicate transaction has been submitted.';
						$server_response['message'] = 'You have submitted a duplicate transaction for the exact amount.&nbsp;&nbsp;Please try again in 10 minutes or select a different quantity for your order.';
						$server_response['payment_info_pairs'] = array();
						$server_response['bad_fields'] = array();
					}elseif( $response->xml->messages->message->text == 'The credit card number is invalid.'){
						$server_response['type'] = 'The credit card number is invalid';
						$server_response['message'] = 'The credit card number is invalid.';
						$server_response['payment_info_pairs'] = array();
						$server_response['bad_fields'] = array(
																							'cc_num',
																							'cardtype',
																							'cc_code',
																							'month_exp',
																							'year_exp'
																							);			
					}elseif( $response->xml->messages->message->text == 'The credit card has expired.'){
						$server_response['type'] = 'The credit card has expired.';
						$server_response['message'] = 'The credit card has expired.';
						$server_response['payment_info_pairs'] = array();
						$server_response['bad_fields'] = array(
																								'month_exp',
																								'year_exp'
																								);				
					}
					elseif( $response->xml->messages->message->text == 'The transaction has been declined because of an AVS mismatch. The address provided does not match billing address of cardholder.'){
						$server_response['type'] = 'The transaction has been declined because of an AVS mismatch. The address provided does not match billing address of cardholder.';
						$server_response['message'] = 'The address provided does not match billing address of cardholder.';
						$server_response['payment_info_pairs'] = array();
						$server_response['bad_fields'] = array(
																							'cc_address',
																							'cc_city',
																							'cc_state',
																							'cc_zipcode'
																							);	
									
					}
					elseif( $response->xml->messages->message->text == 'This transaction has been declined.'){
						$server_response['type'] = 'This transaction has been declined.';
						$server_response['message'] = 'This transaction has been declined.';
						$server_response['payment_info_pairs'] = array();
						$server_response['bad_fields'] = array(
																							'cc_num',
																							'cardtype',
																							'cc_code',
																							'month_exp',
																							'year_exp'
																							);	
									
					}
					else{
						$server_response['type'] = 'error in authorization';
						
						$server_response['message'] = 'Error in authorizing this credit card.';
						$server_response['payment_info_pairs'] = array();
						$server_response['bad_fields'] = array(
																							'cc_num',
																							'cardtype',
																							'cc_code',
																							'month_exp',
																							'year_exp'
																							);	
					};



				};


//				$response_array = array('success','successful authorization','A duplicate transaction has been submitted.');
//
//				if( !in_array($server_response['type'], $response_array) 
//				){
//
//					$bad_fields = array(
//					'cc_first_name',
//					'cc_last_name',
//					'cc_address',
//					'cc_city',
//					'cc_state',
//					'cc_zipcode',
//					'cc_num',
//					'cardtype',
//					'cc_code',
//					'month_exp',
//					'year_exp'
//					);
//
//					$server_response['bad_fields'] = $bad_fields;
//					$server_response['message']='There has been an error in processing your payment information.  Please check your entries highlighted in pink and click purchase to recontinue.';
//
//				};

				return  $server_response;

		}



	/**
	 * posting_has_errors
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/purchase
	 * @access public
	 */

	private function posting_has_errors($posting){

				$has_errors['outcome'] = 'NONE';


				if( !is_numeric($posting['cc_num']) ){

					$has_errors['outcome']  = 'BAD CREDIT CARD';
					$bad_fields[] = 'cc_num';

				};
//brk
				foreach($posting as $key => $value){
					
					if( isset($posting['ship_to_other'])){ // USER CHECKED SEND TO ALTERNATE ADDRESS

										if( $key != 'promo_code' && $value == ''){
												$has_errors['outcome'] = 'FIELDS CONTAIN BLANKS';
												$bad_fields[] = $key;
										};	
															
					}else{  
						
						// AVOID CHECKING BLANKS IN SHIPPING AREA
						if( !in_array( $key, 
									array(
										'shipping_first_name',
										'shipping_last_name',
										'shipping_address',
										'shipping_city',
										'shipping_state',
										'shipping_zipcode'
									))){
										
												if(  $key != 'promo_code' && $value == ''){
														$has_errors['outcome'] = 'FIELDS CONTAIN BLANKS';
														$bad_fields[] = $key;
												};												

						};
					
						
					};
					

					
					
				}



				if( isset($bad_fields) ){
					$has_errors['bad_fields'] = $bad_fields;
				};

				return $has_errors;
	}



	/**
	 * get or create user_id
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/get_user_id_or_create_user_account
	 * @access public
	 **/

	private function get_user_id_or_create_user_account($email, $password){

	  $this->load->helper('security');

		$table = 'users';

	  $where_array = array('email' => $email);

	  if( $this->my_database_model->check_if_exist($where_array, $table)){


					$select_what =  '*';

					$where_array = array(
					'email' => $email
					);

					$users = $this->my_database_model->select_from_table( $table = 'users', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = 1);


					if( $users[0]->password == do_hash(  $this->input->post('password_signup'), 'md5' )){


								// DELETE EXISTING CUSTOMER ACCOUNT AT AUTHORIZE.NET
								$this->my_payment_model->delete_customer($users[0]->authorize_customerProfileId);


								$shipping_info = $this->get_shipping_info();

								// 3
								// CREATE PAYMENT PROFILE AT AUTHORIZE.NET
								$response = $this->my_payment_model->create_payment_profile(
									$firstname = $this->input->post('cc_first_name'),
									$lastname = $this->input->post('cc_last_name'),
									$email = $users[0]->email,
									$cc_num = $this->input->post('cc_num'),
									$month_exp = $this->input->post('month_exp'),
									$year_exp = $this->input->post('year_exp'),
									$cc_address = $this->input->post('cc_address'),
									$cc_city = $this->input->post('cc_city'),
									$cc_state = $this->input->post('cc_state'),
									$cc_zipcode = $this->input->post('cc_zipcode'),
									$cc_phonenumber = $this->input->post('cc_phone'),
							    $shipping_info['first_name'],
							    $shipping_info['last_name'],
							    $shipping_info['address'],
							    $shipping_info['city'],
							    $shipping_info['state'],
							    $shipping_info['zipcode']
							 );

								$users_array['authorize_customerProfileId'] = $response->getCustomerProfileId();
								$users_array['authorize_paymentProfileId'] =  $response->getCustomerPaymentProfileIds();
								$users_array['authorize_customerAddressId'] =  $response->getCustomerShippingAddressIds();


								// UPDATE EXISTING ACCOUNT WITH NEW AUTHORIZE.NET ACCOUNT INFO
								$set_what_array = array(
														'shipping_first_name' => $shipping_info['first_name'],
														'shipping_last_name'	 => $shipping_info['last_name'],
														'shipping_address' 	 => $shipping_info['address'],
														'shipping_city'	 	  => $shipping_info['city'],
														'shipping_state'	 => $shipping_info['state'],
														'shipping_zipcode'  => $shipping_info['zipcode'],
														'authorize_customerProfileId' => $users_array['authorize_customerProfileId'],
														'authorize_paymentProfileId' => $users_array['authorize_paymentProfileId'],
														'authorize_customerAddressId' => $users_array['authorize_customerAddressId'],
														'last_three' => substr(   $this->input->post('cc_num')  , -3)
														);

								$this->my_database_model->update_table( $table = 'users', $primary_key = $users[0]->id, $set_what_array );

								$users_array['id'] = $users[0]->id;
								$users_array['status'] = 'old account';

								$newdata = array(
							                   'email'  => $users[0]->email,
							                   'user_id'     => $users[0]->id,
							                   'isAdmin'     => $users[0]->isAdmin,
							                   'logged_in' => TRUE
							               );

								$this->session->set_userdata($newdata);
								$this->users = $users;


					}else{

								// FROM BUY PAGE NEW SIGNUP PASSWORD NOT MATCH EXISTING ACCOUNT'S
								$users_array['status'] = 'NEW SIGNUP PASSWORD NOT MATCH EXISTING ACCOUNT';

					};



	  }else{

					$shipping_info = $this->get_shipping_info();

					// 4
					// CREATE PAYMENT PROFILE AT AUTHORIZE.NET
					$response = $this->my_payment_model->create_payment_profile(
						$firstname = $this->input->post('cc_first_name'),
						$lastname = $this->input->post('cc_last_name'),
						$email = $this->input->post('email'),
						$cc_num = $this->input->post('cc_num'),
						$month_exp = $this->input->post('month_exp'),
						$year_exp = $this->input->post('year_exp'),
						$cc_address = $this->input->post('cc_address'),
						$cc_city = $this->input->post('cc_city'),
						$cc_state = $this->input->post('cc_state'),
						$cc_zipcode = $this->input->post('cc_zipcode'),
						$cc_phonenumber = $this->input->post('cc_phone'),
					  $shipping_info['first_name'],
					  $shipping_info['last_name'],
					  $shipping_info['address'],
					  $shipping_info['city'],
					  $shipping_info['state'],
					  $shipping_info['zipcode']
					);


					$users_array['authorize_customerProfileId'] = $authorize_customerProfileId = $response->getCustomerProfileId();
					$users_array['authorize_paymentProfileId'] = $authorize_paymentProfileId = $response->getCustomerPaymentProfileIds();
					$users_array['authorize_customerAddressId'] = $authorize_customerAddressId = $response->getCustomerShippingAddressIds();


					$insert_what = array(
																	'activate' => 0,
					                        'site_id' =>  $this->site_id,
					                        'first_name' =>  $this->input->post('first_name'),
					                        'last_name' =>  $this->input->post('last_name'),
					                        'email' =>  $email,
					                        'password' =>   do_hash(  $this->input->post('password_signup'), 'md5' ),
					                        'zipcode' =>   $this->input->post('cc_zipcode'),
					                        'authorize_customerProfileId' =>   $authorize_customerProfileId,
					                        'authorize_paymentProfileId' =>   $authorize_paymentProfileId,
					                        'authorize_customerAddressId' =>   $authorize_customerAddressId,
																	'last_three' => substr(   $this->input->post('cc_num')  , -3),
																	'shipping_first_name' => $shipping_info['first_name'],
																	'shipping_last_name'	 => $shipping_info['last_name'],
																	'shipping_address' 	 => $shipping_info['address'],
																	'shipping_city'	 	  => $shipping_info['city'],
																	'shipping_state'	 => $shipping_info['state'],
																	'shipping_zipcode'  => $shipping_info['zipcode']
					                );

					$user_id = $this->my_database_model->insert_table(
													$table,
													$insert_what
													);

					$users_array['id'] = $user_id;
					$users_array['status'] = 'new account';



					$newdata = array(
				                   'email'  => $email,
				                   'user_id'     => $user_id,
				                   'isAdmin'     => 0,
				                   'logged_in' => TRUE
				               );

					$this->session->set_userdata($newdata);
					$this->users = $this->get_user_information($this->session->userdata['user_id']);



		}



		return $users_array;

	}


/**
	 * get user information
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */


	private function get_user_information($user_id){

		$select_what =  '*';

				$where_array = array(
		  	'id' => $user_id
				);


		return $this->my_database_model->select_from_table( $table = 'users', $select_what, $where_array, $use_order = FALSE, $order_field = 'id', $order_direction = 'desc', $limit = 1, $use_join = FALSE, $join_array=array() );

	}



/**
	 * test
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */


	function test(){


			$this->load->model('my_payment_model');

		echo "CREATE PAYMENT PROFILE"."<br />";

		// CREATE PAYMENT PROFILE
		$response = $this->my_payment_model->create_payment_profile(
			$firstname = 'Dan',
			$lastname = 'roc',
			$email ='dan@somewhere.com',
			$cc_num = "4111111111111111",
			$month_exp ='02',
			$year_exp = '2012',
			$cc_address='123 Maiden Lane',
			$cc_city='Atlantic City',
			$cc_state='NJ',
			$cc_zipcode='32423'
	 );

		echo '<pre>';print_r(  $response   );echo '</pre>';

		$authorize_customerProfileId = $response->getCustomerProfileId();
		$authorize_paymentProfileId = $response->getCustomerPaymentProfileIds();
		$authorize_customerAddressId = $response->getCustomerShippingAddressIds();

		exit;


	echo "<hr />";
   echo "UPDATE CUSTOMER PROFILE";


   $response = $this->my_payment_model->update_customer_profile(
			$authorize_customerProfileId,
			$firstname = 'James',
			$lastname = 'Ming',
			$email = 'jamesming@gmail.com'
	 );


   	echo '<pre>';print_r( $response    );echo '</pre>';




		$response = $this->my_payment_model->get_customer_profile($authorize_customerProfileId);



		echo "<hr />";
		echo "GET CUSTOMER PROFILE"."<br />";
		echo '<pre>';print_r(  $response  );echo '</pre>';


		echo "<hr />";

		echo $response->xml->profile->paymentProfiles->billTo->firstName ."<br />";
		echo $response->xml->profile->paymentProfiles->billTo->lastName ."<br />";
		echo $response->xml->profile->paymentProfiles->billTo->address ."<br />";
		echo $response->xml->profile->paymentProfiles->billTo->city ."<br />";
		echo $response->xml->profile->paymentProfiles->billTo->state ."<br />";
		echo $response->xml->profile->paymentProfiles->billTo->zip ."<br />";


		echo "<hr />";
		// REMOVE CUSTOMER PROFILE

		$response = $this->my_payment_model->delete_customer($authorize_customerProfileId);

		echo '<pre>';print_r(  $response   );echo '</pre>';



   	exit;


		echo "<hr />";
		// REMOVE PAYMENT PROFILE
		echo "REMOVE PAYMENT PROFILE"."<br />";

		$response = $this->my_payment_model->delete_payment_profile($authorize_customerProfileId,$authorize_paymentProfileId);

		echo '<pre>';print_r(  $response   );echo '</pre>';





		echo "<hr />";
		// ADD NEW PAYMENT PROFILE
		echo "ADD NEW PAYMENT PROFILE"."<br />";


		$response = $this->my_payment_model->add_payment_profile(
			$cc_num = '370000000000002',
			$month_exp ='02',
			$year_exp = '2012',
			$authorize_customerProfileId,
			$authorize_paymentProfileId,
			$firstname = 'James',
			$lastname = 'Ming',
			$cc_address='6163 Colgate',
			$cc_city='Los Angeles',
			$cc_state='CA',
			$cc_zipcode='90036',
			$phonenumber = ''
		);

		$authorize_paymentProfileId = $response->getPaymentProfileId();

		echo '<pre>';print_r(  $response   );echo '</pre>';

		echo 'New $authorize_paymentProfileId: '.$authorize_paymentProfileId."<br />";


		echo "<hr />";
		// REMOVE SHIPPING PROFILE
		echo "REMOVE SHIPPING PROFILE"."<br />";

		$response = $this->my_payment_model->delete_shipping_profile($authorize_customerProfileId,$authorize_customerAddressId);

		echo '<pre>';print_r(  $response   );echo '</pre>';



		echo "<hr />";
		// ADD NEW SHIPPING PROFILE
		echo "ADD NEW SHIPPING PROFILE"."<br />";


		$response = $this->my_payment_model->add_shipping_profile(
			$authorize_customerProfileId,
			$firstname = 'James',
			$lastname = 'Ming',
			$cc_address='6163 Colgate',
			$cc_city='Los Angeles',
			$cc_state='CA',
			$cc_zipcode='90036',
			$phonenumber = ''
		);


		echo '<pre>';print_r(  $response   );echo '</pre>';

		$authorize_customerAddressId = $response->getCustomerAddressId();

		echo 'New $authorize_customerAddressId: '.$authorize_customerAddressId."<br />";




//		echo "<hr />";
//		// VALIDATION OF CCV
//
//
//
//		$response = $this->my_payment_model->validate_ccv(
//	   	$authorize_customerProfileId,
//	   	$authorize_paymentProfileId,
//	   	$authorize_customerAddressId,
//	   	$cardCode ='123'
//   );
//
//		echo '<pre>';print_r(  $response   );echo '</pre>';


		echo "<hr />";
		// AUTHORIZE A TRANSACTION

		$response = $this->my_payment_model->authorize_only_transaction(
		   		$order_number = 'XXX',
		   		$order_description = 'ZekesZoo Purchase',
					$total_transaction_value = '10',
			   	$authorize_customerProfileId,
			   	$authorize_paymentProfileId,
			   	$authorize_customerAddressId,
	   			$cvv = '123'
		   );

		echo '<pre>';print_r(  $response   );echo '</pre>';

		echo $transactionId = $response->getTransactionResponse()->transaction_id;

		echo "<hr />";
		// CAPTURE PRIOR AUTHORIZED


		$user_deal_processed[] = 323;
		$user_deal_processed[] = 223;
		$user_deal_processed[] = 423;
		$user_deal_processed[] = 6523;



		$response = $this->my_payment_model->capture_prior_authorized_transaction(
					$total_transaction_value='10',
					$user_deal_processed,
					$unit_price ='2',
					$title_of_purchase ='Petco Brand',
					$deal_short_description = 'Dogbone Pack of Three',
			   	$authorize_customerProfileId,
			   	$authorize_paymentProfileId,
			   	$authorize_customerAddressId,
			   	$transactionId
		   );

		echo '<pre>';print_r(  $response   );echo '</pre>';




		echo "<hr />";
		// VOID A TRANSACTION

		$response = $this->my_payment_model->void_transaction($transactionId);

		echo '<pre>';print_r(  $response   );echo '</pre>';







	}


	/**
	 * how many deals did this user buy
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */


	private function how_many_user_bought($calendar_id, $user_id){
				$select_what =  '*';

				$where_array = array(
				'user_id' => $user_id,
				'calendar_id' => $calendar_id
				);

				$users_deals = $this->my_database_model->select_from_table( $table = 'users_deals', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);


//				if($this->error_check_mode == TRUE) echo "USERS_DEALS ARRAY"."<hr />";
//				if($this->error_check_mode == TRUE) echo '<pre> ';
//				if($this->error_check_mode == TRUE) print_r(  $users_deals );
//				if($this->error_check_mode == TRUE) echo '</pre> ';


//				if($this->error_check_mode == TRUE) echo 'count of users_deals'.count($users_deals )."<br />";;

				return count($users_deals );

	}





	/**
	 * how many deals did all users buy
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */


	private function how_many_bought($deal_id){

				$select_what =  '*';

				$where_array = array(
				'deal_id' => $deal_id
				);

				$users_deals = $this->my_database_model->select_from_table( $table = 'users_deals', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);

				return count($users_deals );

	}








	/**
	 * get_deal_by_calendar_id
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */


	private function get_deal_by_calendar_id($calendar_id){

		$select_what =  'deals.deal_name,
										 deals.id,
										 deal_price,
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
										 vendors.company_name as company_name,
										 vendor_short_description';

				$where_array = array(
		  	'calendar.id' => $calendar_id
				);


		$join_array = array(
									'deals' => 'deals.id = calendar.deal_id',
									'vendors' => 'vendors.id = deals.vendor_id'
									);

		$the_array = $this->my_database_model->select_from_table( $table = 'calendar', $select_what, $where_array, $use_order = TRUE, $order_field = 'day_of_year', $order_direction = 'desc', $limit = 1, $use_join = TRUE, $join_array );

		if( count($the_array) == 0) {echo "bad calendar_id";exit;};

		return $the_array;

	}


	/**
	 * remove authorize account information
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */

	private function remove_authorize_payment_information($users){

				// REMOVE AUTHORIZE ACCOUNT IF PAYMENT IS BAD


				if( isset($users['authorize_customerProfileId']) ){
					$response = $this->my_payment_model->delete_customer($users['authorize_customerProfileId']);
				}else{
					$response = $this->my_payment_model->delete_customer($users[0]->authorize_customerProfileId);
				};


				if($this->error_check_mode == TRUE) echo 'DELETE AUTORIZE USE ACCOUNT'."<hr />";
				if($this->error_check_mode == TRUE) echo'<pre>';
				if($this->error_check_mode == TRUE) print_r(  $response   );
				if($this->error_check_mode == TRUE) echo'</pre> ';

				// UPDATE EXISTING ACCOUNT EMPTY AUTHORIZE FIELDS
				$set_what_array = array(
										'authorize_customerProfileId' => '',
										'authorize_paymentProfileId' => '',
										'authorize_customerAddressId' => '',
										'last_three' => ''
										);


				$this->my_database_model->update_table( $table = 'users', $primary_key = ( isset( $users[0]->id) ? $users[0]->id:$users['id']), $set_what_array );

	}


	/**
	 * did user_exceed_each_can_buy
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/


  private function did_user_exceed_each_can_buy($want_to_buy, $deals, $user_id ){


//				if($this->error_check_mode == TRUE) echo "DEAL TODAY ARRAY"."<hr />";
//				if($this->error_check_mode == TRUE) echo'<pre> ';
//				if($this->error_check_mode == TRUE) print_r(  $deals );
//				if($this->error_check_mode == TRUE) echo'</pre> ';

				$quantity_available_to_user =  $deals[0]->each_can_buy - (int)$this->how_many_user_bought($calendar_id = $deals[0]->calendar_id, $user_id);

				if( $want_to_buy > $quantity_available_to_user){

					return  TRUE;

				}else{

					return FALSE;

				};

	}



	/**
	 * did_deal_tip
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/


  private function did_deal_tip( $want_to_buy, $deals ){

  			$minimum_quantity = $deals[0]->minimum_quantity;

  			$bought_so_far = (int)$this->query->how_many_bought_during_one_booked_segment($calendar_id = $deals[0]->calendar_id);

				if( $bought_so_far + $want_to_buy >= $minimum_quantity ){

					return  TRUE;

				}else{

					return FALSE;

				};

	}




	/**
	 * update_account
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/remove_account
	 * @access public
	 **/

		private function update_account(
				$authorize_customerProfileId,
				$authorize_paymentProfileId,
				$authorize_customerProfileId,
				$first_name,
				$last_name,
				$email,
				$cc_num,
				$month_exp,
				$year_exp,
				$cc_address,
				$cc_city,
				$cc_state,
				$cc_zipcode,
				$cc_phone
				){



/*
									$new_authorize_ids = $this->update_account(
										$users[0]->authorize_customerProfileId,
										$users[0]->authorize_paymentProfileId,
										$users[0]->authorize_customerAddressId,
										$firstname = $this->input->post('cc_first_name'),
										$lastname = $this->input->post('cc_last_name'),
										$email,
										$cc_num = $this->input->post('cc_num'),
										$month_exp = $this->input->post('month_exp'),
										$year_exp = $this->input->post('year_exp'),
										$cc_address = $this->input->post('cc_address'),
										$cc_city = $this->input->post('cc_city'),
										$cc_state = $this->input->post('cc_state'),
										$cc_zipcode = $this->input->post('cc_zipcode')
									);
					*/


						   $response = $this->my_payment_model->update_customer_profile(
									$authorize_customerProfileId,
									$first_name,
									$last_name,
									$email
							 );


								$response = $this->my_payment_model->delete_payment_profile($authorize_customerProfileId,$authorize_paymentProfileId);

								$response = $this->my_payment_model->add_payment_profile(
									$cc_num,
									$month_exp,
									$year_exp,
									$authorize_customerProfileId,
									$authorize_paymentProfileId,
									$first_name,
									$last_name,
									$cc_address,
									$cc_city,
									$cc_state,
									$cc_zipcode,
									$cc_phone
								);

								$new_authorize_ids['authorize_paymentProfileId']  = $response->getPaymentProfileId();


								$response = $this->my_payment_model->delete_shipping_profile($authorize_customerProfileId,$authorize_customerAddressId);

								$response = $this->my_payment_model->add_shipping_profile(
									$authorize_customerProfileId,
									$first_name,
									$last_name,
									$cc_address,
									$cc_city,
									$cc_state,
									$cc_zipcode,
									$phonenumber = ''
								);

								$new_authorize_ids['authorize_customerAddressId'] = $response->getCustomerAddressId();

								return $new_authorize_ids;

		}



	/**
	 * remove_account
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/remove_account
	 * @access public
	 **/

	private function remove_account(  $users ){

		$this->my_payment_model->delete_customer($users['authorize_customerProfileId']);

		$where_array = array(
		'id' => $users['id']
		);

		$this->my_database_model->delete_from_table($table='users', $where_array);

	}


	/**
	 * add_deal
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/add_deal
	 * @access public
	 **/

	function add_deal(){

					$insert_what = array(
									'vendor_id' => $this->input->post('vendor_id'),
									'deal_name' => $this->input->post('deal_name'),
									'orig_price' => $this->input->post('orig_price'),
									'deal_price' => $this->input->post('deal_price'),
									'maximum_quantity' => $this->input->post('maximum_quantity'),
									'minimum_quantity' => $this->input->post('minimum_quantity'),
									'deal_will_expire' => $this->input->post('deal_will_expire'),
									'deal_short_description' => $this->input->post('deal_short_description'),
									'each_can_buy' => $this->input->post('each_can_buy'),
									// 'priority' => 2
									'priority' => $this->input->post('priority')
									);

					$inserted_id = $this->my_database_model->insert_table(
													$table = 'deals',
													$insert_what
													);


					echo $inserted_id;


	}


	/**
	 * update_deal
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/update_deal
	 * @access public
	 **/

	function update_deal(){


			$set_what_array = array(
									'vendor_id' => $this->input->post('vendor_id'),
									'deal_name' => $this->input->post('deal_name'),
									'orig_price' => $this->input->post('orig_price'),
									'deal_price' => $this->input->post('deal_price'),
									'maximum_quantity' => $this->input->post('maximum_quantity'),
									'minimum_quantity' => $this->input->post('minimum_quantity'),
									'deal_will_expire' => $this->input->post('deal_will_expire'),
									'deal_short_description' => $this->input->post('deal_short_description'),
									'each_can_buy' => $this->input->post('each_can_buy')
									);

			$this->my_database_model->update_table( $table = 'deals', $primary_key = $this->deal_id, $set_what_array );

	}


	/**
	 * vendor
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/vendor
	 * @access public
	 **/

	function vendor(){


		$this->load->view('home/vendor_view', array());


	}


	/**
	 * add_vendor
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/add_vendor
	 * @access public
	 **/

	function add_vendor(){


		$table = 'vendors';


		$insert_what = array(
                      'contact' => $this->input->post('contact'),
                      'email' => $this->input->post('email'),
                      'company_name' => $this->input->post('company_name'),
                      'address' => $this->input->post('address'),
                      'address2' => $this->input->post('address2'),
                      'city' => $this->input->post('city'),
                      'state' => $this->input->post('state'),
                      'zipcode' => $this->input->post('zipcode'),
                      'telephone' => $this->input->post('telephone'),
                      'fax' => $this->input->post('fax'),
                      'telephone' => $this->input->post('telephone'),
                      'vendor_website' => $this->input->post('vendor_website'),
                      'vendor_type_id' => $this->input->post('vendor_type_id'),
                      'notes' => $this->input->post('notes'),
                      'vendor_short_description' => $this->input->post('vendor_short_description')
											);

		$vendor_id = $this->my_database_model->insert_table(
						$table,
						$insert_what
						);


		 echo $vendor_id;

	}



	/**
	 * update_vendor
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/update_vendor
	 * @access public
	 **/

	function update_vendor(){

		$table = 'vendors';

		$set_what_array = array(
                      'contact' => $this->input->post('contact'),
                      'email' => $this->input->post('email'),
                      'company_name' => $this->input->post('company_name'),
                      'address' => $this->input->post('address'),
                      'address2' => $this->input->post('address2'),
                      'city' => $this->input->post('city'),
                      'state' => $this->input->post('state'),
                      'zipcode' => $this->input->post('zipcode'),
                      'telephone' => $this->input->post('telephone'),
                      'fax' => $this->input->post('fax'),
                      'telephone' => $this->input->post('telephone'),
                      'vendor_website' => $this->input->post('vendor_website'),
                      'vendor_type_id' => $this->input->post('vendor_type_id'),
                      'notes' => $this->input->post('notes'),
                      'vendor_short_description' => $this->input->post('vendor_short_description')
											);


			$this->my_database_model->update_table( $table, $primary_key = $this->input->post('vendor_id'), $set_what_array );


	}


	/**
	 * get_vendor
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/get_vendors
	 * @access public
	 **/

	function get_vendor(){
				$select_what =  '*';

				$where_array = array(
				'id' => $this->input->post('vendor_id')
				);

				$vendor = $this->my_database_model->select_from_table( $table = 'vendors', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = 1);

				echo "
				<script type='text/javascript' language='Javascript'>";

				?>

				$('#vendor_id').val('<?php echo $vendor[0]->id; ?>');  // PREPARE VENDOR RECORD TO BE UPDATED

				// window.parent.$('#vendor_id').val('<?php echo $vendor[0]->id; ?>');  // CHANGE DEAL'S VENDOR

				$('#submit').val('update');

				<?php


						foreach($vendor[0] as $key=>$vendor){

							if( $key == 'created'
							||  $key == 'updated'
							||  $key == 'site_id'
							||  $key == 'id'
							||  $key == 'vendor_type_id'
							){}else{ ?>

								$('#<?php echo $key    ?>').val('<?php  echo $vendor   ?>');

							<?php
							};
						}



				echo "

				</script>";







	}


	/**
	 * get_vendors
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/get_vendors
	 * @access public
	 **/

	function get_vendors(){
				$select_what =  '*';

				$where_array = array();

				$vendors = $this->my_database_model->select_from_table( $table = 'vendors', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);

				foreach($vendors as $vendor){
					?>
					<div class='clearfix item'  vendor_id=<?php echo $vendor->id;    ?>>
						<?php echo  $vendor->company_name;   ?>
					</div>
					<?php
				}

				echo "
				<script type='text/javascript' language='Javascript'>

						$('.item').click(function(event) {"; ?>

							$(this).parent().children('div.item').css({background:'transparent'});
							$(this).css({background:'yellow'});

							$.post("<?php echo base_url(). 'index.php/home/get_vendor';    ?>",{
								vendor_id: $(this).attr('vendor_id')
								},function(data) {
										$('#hidden_div').html(data);
							 });


				<?php
				echo "});
				</script>

				";

	}






	function update_method(){

		$table = $this->input->post('table');

		if( $table == 'website' ){
			$this->update_content();
		}elseif(  $table == 'deals'  ){
			$this->update();
		};


	}


	/**
	 * update content of website
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @uses My_database_model::create_table_with_fields()
	 * @uses My_database_model::check_if_exist()
	 * @uses My_database_model::add_column_to_table_if_exist()
	 * @uses My_database_model::insert_table()
	 * @uses My_database_model::get_primary_key()
	 * @uses My_database_model::update_table()
	 * @path /index.php/dashboard/update
	 * @access public
	 **/

	function update_content(){


		$table = 'website';
		$field = $this->input->post('field');
		$text = $this->input->post('text');


		$fields_array = array(
		                        $field =>  array(
		                                                 'type' => 'blob'
		                                      )
		                );

		$this->my_database_model->add_column_to_table_if_exist($table, $fields_array);


		/**
		 * Insert into table if not already exist otherwise do an update
		 *
		 **/

	  $where_array = array('id' => 1);

	  if( $this->my_database_model->check_if_exist($where_array, $table) ){

				$set_what_array = array(
										$field => $text
										);

				echo $this->my_database_model->update_table( $table, $primary_key = 1, $set_what_array );



	  }else{

					$insert_what = array(
								$field => $text
								);

					$primary_key = $this->my_database_model->insert_table(
													$table,
													$insert_what
													);

					echo  $primary_key;

	  };

	}

	/**
	 * update
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @uses My_database_model::create_table_with_fields()
	 * @uses My_database_model::check_if_exist()
	 * @uses My_database_model::add_column_to_table_if_exist()
	 * @uses My_database_model::insert_table()
	 * @uses My_database_model::get_primary_key()
	 * @uses My_database_model::update_table()
	 * @path /index.php/dashboard/update
	 * @access public
	 **/

	function update(){

		$table = 'deals';
		$field = $this->input->post('field');
		$text = $this->input->post('text');


		/**
		 * Insert into table if not already exist otherwise do an update
		 *
		 **/

	  $where_array = array('id' => $this->deal_id);

	  if( $this->my_database_model->check_if_exist($where_array, $table) ){

				$set_what_array = array(
										$field => $text
										);

				$return = $this->my_database_model->update_table( $table, $primary_key = $this->deal_id, $set_what_array );



	  }else{

					$insert_what = array(
								$field => $text,
								'site_id' => $this->site_id
								);

					$return = $this->my_database_model->insert_table(
													$table,
													$insert_what
													);

	  };

	  echo $return;

	}


	/**
	 * iframe of WYSIWIG
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/wysiwig
	 * @access public
	 **/




	function wysiwyg(){

		$data = array(
			'deal_id' => $this->deal_id
			);

		$this->load->view('home/wysiwyg_view', $data);

	}


	/**
	 * get public gallery
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access private
	 */

	private function get_public_gallery( $limit  = -1 ){

		$select_what =  '*';

		$where_array = array();

		$public_galleries = $this->my_database_model->select_from_table(
			$table = 'my_pet_galleries',
			$select_what,
			$where_array,
			$use_order = TRUE,
			$order_field = 'RAND()',
			$order_direction = 'asc',
			$limit);

		foreach( $public_galleries  as  $one_gallery){

			$one_picture_array['my_pet_gallery_id'] = $one_gallery->id;
			$one_picture_array['user_id'] = $one_gallery->user_id;
			$one_picture_array['bubble_text'] = $one_gallery->bubble_text;

			$public[] = $one_picture_array;

		}

		return $public;

	}

	/**
	 * update speech bubble
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/update_speech_bubbble
	 * @access public
	 */

	 public function update_speech_bubble(){

			$set_what_array = array(
                      'bubble_text' => $this->input->post('bubble_text')
											);

			$this->my_database_model->update_table(
			$table = 'my_pet_galleries',
			$primary_key = $this->input->post('my_pet_gallery_id'),
			$set_what_array
			);

	 	?>

	 	<script type="text/javascript" language="Javascript">
	 			window.parent.$('body').click(); // closes fancy zoom
	 	</script>

	 	<?php

	 }

	/**
	 * speech bubble form
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/speech_bubbble_form
	 * @access public
	 */

	public function speech_bubbble_form(){

		$my_pet_gallery_id = $this->uri->segment(3);

		$select_what =  'bubble_text';

		$where_array = array(
		'id' =>  $my_pet_gallery_id
		);

		$my_pet_galleries = $this->my_database_model->select_from_table(
			$table = 'my_pet_galleries',
			$select_what,
			$where_array,
			$use_order = TRUE,
			$order_field = 'created',
			$order_direction = 'asc',
			$limit = -1);


		?>
		<style>
				body{
				font-family:"Helvetica Neue", Arial, Helvetica, sans-serif;
				}
				#fancy_zoom_div {
				margin-top:10px;
		    font-weight: bold;
		    color: gray;
		    font-size: 18px;
		    text-align:left;
				}
				#fancy_zoom_div textarea#bubble_text {
						margin-top:10px;
				    width: 380px;
				    padding: 8px;
				    font-size: 21px;
				}


				#fancy_zoom_div  div.submit_container {
				    text-align:center;
				}

							#fancy_zoom_div div.submit_container input#submit_bubble {
							    font-size: 18px;
							    width:100px;
							    margin:10px auto;
							}
		</style>
		<form method='post' action='<?php echo base_url()    ?>index.php/home/update_speech_bubble'>
						<div  id='fancy_zoom_div'>
								<div>
									What your pet would say if it could talk ...
								</div>
								<textarea  id='bubble_text' name='bubble_text'><?php echo $my_pet_galleries[0]->bubble_text    ?></textarea>
								<div  class='submit_container' >
									<input type='hidden' name="my_pet_gallery_id" id="my_pet_gallery_id" value="<?php echo $my_pet_gallery_id    ?>">
									<input name="submit_bubble" id="submit_bubble" type="submit" value="submit">
								</div>


						</div>
		</form>
		<?php
	}

	/**
	 * my pet gallery
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/mypetgallery
	 * @access public
	 */

	public function mypetgallery(){


		$select_what =  'id';

		$where_array = array(
		'user_id' =>  $this->session->userdata['user_id']
		);

		$my_pet_galleries = $this->my_database_model->select_from_table(
			$table = 'my_pet_galleries',
			$select_what,
			$where_array,
			$use_order = TRUE,
			$order_field = 'created',
			$order_direction = 'asc',
			$limit = -1);

		foreach( $my_pet_galleries  as  $my_pet_gallery){

			$one_picture_array['my_pet_gallery_id'] = $my_pet_gallery->id;
			$one_picture_array['type'] = 'contains_image';

			$picture[] = $one_picture_array;

		}

		unset(  $one_picture_array  );


		$one_picture_array['my_pet_gallery_id'] = 0;
		$one_picture_array['type'] = 'first_available';

		$picture[] = $one_picture_array;

		unset(  $one_picture_array  );

		$count_of_empty_holders =  12 - count($picture);

		for ($i=1; $i <= $count_of_empty_holders;  $i++){
			$one_picture_array['my_pet_gallery_id'] = 0;
			$one_picture_array['type'] = 'no_image';
			$picture[] = $one_picture_array;
		}

		unset(  $one_picture_array  );

		$picture_row1 = array($picture[0],$picture[1],$picture[2]);
		$picture_row2 = array($picture[3],$picture[4],$picture[5]);
		$picture_row3 = array($picture[6],$picture[7],$picture[8]);
		$picture_row4 = array($picture[9],$picture[10],$picture[11]);

		$pictures = array(
				$picture_row1,
				$picture_row2,
				$picture_row3,
				$picture_row4
				);

		$this->load->view('home/mypetgallery_view',
			array(
			'pictures' => $pictures,
			'deal_id' => $this->deal_id,
			'public_gallery' => $this->get_public_gallery($limit = 4)
			));

	}



	/**
	 * upload_pet_form
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/upload_pet_form
	 * @access public
	 **/

	function upload_pet_form(){


		$data= array(
		'my_pet_gallery_id' => $this->uri->segment(3)
		);


		$this->load->view('home/upload_pet_form_view', $data);


	}





	/**
	 * upload_image
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/upload_pet_image
	 * @access public
	 **/

	function upload_pet_image(){

		if( $this->input->post('my_pet_gallery_id') == 0){

				$insert_what = array(
				                  'user_id' =>  $this->session->userdata['user_id']
				          );

				$my_pet_gallery_id = $this->my_database_model->insert_table(
									$table = 'my_pet_galleries',
									$insert_what
									);

		}else{
				$my_pet_gallery_id = $this->input->post('my_pet_gallery_id');
		};



		$path_array = array(
			'folder'=> 'gallery',
			'user_id'=> $this->session->userdata['user_id'],
			'my_pet_gallery_id'=> $my_pet_gallery_id
		);

		$upload_path = $this->tools->set_directory_for_upload( $path_array );

		$config['upload_path'] = './' . $upload_path;
		$config['allowed_types'] = 'bmp|jpeg|gif|jpg|png';
		$config['overwrite'] = 'TRUE';
		$config['file_name'] = 'transition.png';

		$this->load->library('upload', $config);


		if ( ! $this->upload->do_upload("Filedata")){
					?>
							<script type="text/javascript" language="Javascript">

								window.parent.growl( notice_header_text = 'Error', notice_body_text = '<br><?php echo $this->upload->display_errors();    ?>', isThisSticky = true)

							</script>

					<?php
					exit;
		}
		else{	?>

							<script type="text/javascript" language="Javascript">


														window.parent.$('#submit_jcrop_table').show();
														window.parent.open_jcrop( <?php  echo $my_pet_gallery_id   ?>);

							</script>

		<?php

		}



	}




	/**
	 * iframe_jcrop_form_for_pet_image
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/iframe_jcrop_form_for_pet_image
	 * @access public
	 **/

	function iframe_jcrop_form_for_pet_image(){

			$my_pet_gallery_id = $this->uri->segment(3);

			$dir_path = 'uploads/gallery/'  .  $this->session->userdata['user_id'] . '/' . $my_pet_gallery_id;


			$image_information = getimagesize($dir_path . '/' . 'transition.png');

			$width_of_file = $image_information[0];
			$height_of_file = $image_information[1];


			$new_width  = '527';
			$new_height = $this->tools->get_new_size_of ($what = 'height', $based_on_new = $new_width, $orig_width = $width_of_file, $orig_height = $height_of_file );

			$this->tools->resize_this(  $full_path = $dir_path . '/' . 'transition.png' , $width = $new_width, $height = $new_height);


			$data= array(
			'width_of_file' => $new_width,
			'height_of_file' => $new_height,
			'my_pet_gallery_id' => $my_pet_gallery_id
			 );


			$this->load->view('home/iframe_jcrop_for_pet_image_view', $data);

	}



	/**
	 * remove_pet_image
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/remove_pet_image
	 * @access public
	 **/


	function remove_pet_image(){

		$my_pet_gallery_id = $this->uri->segment(3);

		$dir_path = 'uploads/gallery/'
		. $this->session->userdata['user_id'] . '/'
		.  $my_pet_gallery_id . '/';


		$this->tools->recursiveDelete($dir_path);

		$where_array = array(
	  	'id' => $my_pet_gallery_id
  	);

		$table  = 'my_pet_galleries';

		$this->my_database_model->delete_from_table( $table, $where_array);


		redirect('/home/mypetgallery');

	}

	/**
	 * crop_pet_image
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/crop_pet_image
	 * @access public
	 **/



	function crop_pet_image(){

		$dir_path = 'uploads/gallery/' . $this->session->userdata['user_id'] . '/'  .  $this->input->post('my_pet_gallery_id') . '/';



		$x_origin = $this->input->post('x_origin');
		$y_origin = $this->input->post('y_origin');
		$width = $this->input->post('width');
		$height = $this->input->post('height');

		$this->tools->crop_and_name_it( $new_name = 'image.png', $dir_path.'transition.png', $dir_path, $width, $height, $x_origin, $y_origin );

		$new_width  = '410';
		$new_height = $this->tools->get_new_size_of ($what = 'height', $based_on_new = $new_width, $orig_width = $width, $orig_height = $height );

		$this->tools->resize_this(  $full_path = $dir_path . '/' . 'image.png' , $width = $new_width, $height = $new_height);


		$new_tiny_width  = '157';
		$new_tiny_height = $this->tools->get_new_size_of (
			$what = 'height',
			$based_on_new = $new_width,
			$orig_width = $new_width,
			$orig_height = $new_height
		);


		$this->tools->clone_and_resize_append_name_of(
			$appended_suffix = '_tiny',
			$full_path = $dir_path . '/' . 'image.png',
			$width = $new_tiny_width,
			$height = $new_tiny_height
			);



		// ** Delete transitional image
		$this->tools->recursiveDelete($dir_path.'transition.png');


	}



	/**
	 * upload_image_form
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/upload_image_form
	 * @access public
	 **/

	function upload_image_form(){


		$data= array('deal_id' => $this->deal_id );


		$this->load->view('home/upload_image_form_view', $data);


	}





	/**
	 * upload_image
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/upload_image
	 * @access public
	 **/

	function upload_image(){

		$path_array = array('sites'=> $this->site_id, 'deals'=> $this->deal_id);
		$upload_path = $this->tools->set_directory_for_upload( $path_array );

		$config['upload_path'] = './' . $upload_path;
		$config['allowed_types'] = 'bmp|jpeg|gif|jpg|png';
		$config['overwrite'] = 'TRUE';
		$config['file_name'] = 'transition.png';

		$this->load->library('upload', $config);


		if ( ! $this->upload->do_upload("Filedata")){
					?>
							<script type="text/javascript" language="Javascript">

								window.parent.growl( notice_header_text = 'Error', notice_body_text = '<br><?php echo $this->upload->display_errors();    ?>', isThisSticky = true)

							</script>

					<?php
					exit;
		}
		else{

			$this->load->view('home/upload_image_view', array('deal_id' => $this->deal_id ));

		}



	}



	/**
	 * iframe_jcrop_form_for_images
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/iframe_jcrop_form_for_images
	 * @access public
	 **/

	function iframe_jcrop_form_for_image(){


			$dir_path = 'uploads/' . $this->site_id . '/'  .  $this->deal_id;

			$image_information = getimagesize($dir_path . '/' . 'transition.png');

			$width_of_file = abs ($image_information[0]);
			$height_of_file = abs ($image_information[1]);


			$new_width  = '527';
			$new_height = $this->tools->get_new_size_of ($what = 'height', $based_on_new = $new_width, $orig_width = $width_of_file, $orig_height = $height_of_file );

			$this->tools->resize_this(  $full_path = $dir_path . '/' . 'transition.png' , $width = $new_width, $height = $new_height);

			$data= array('width_of_file' => $new_width, 'height_of_file' => $new_height,  'site_id' => $this->site_id, 'deal_id' => $this->deal_id );


			$this->load->view('home/iframe_jcrop_image_view', $data);

	}

	/**
	 * crop_image
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/crop_image
	 * @access public
	 **/


	function crop_image(){

		// $dir_path = "uploads/1/2/";
		$dir_path = 'uploads/' . $this->site_id . '/'  .  $this->deal_id . '/';

		$x_origin = $this->input->post('x_origin');
		$y_origin = $this->input->post('y_origin');
		$width = $this->input->post('width');
		$height = $this->input->post('height');

		$this->tools->crop_and_name_it( $new_name = 'image.png', $dir_path.'transition.png', $dir_path, $width, $height, $x_origin, $y_origin );

		$new_width  = '526';
		$new_height = $this->tools->get_new_size_of ($what = 'height', $based_on_new = $new_width, $orig_width = $width, $orig_height = $height );

		$this->tools->resize_this(  $full_path = $dir_path . '/' . 'image.png' , $width = $new_width, $height = $new_height);


		$new_tiny_width  = '110';
		$new_tiny_height = $this->tools->get_new_size_of (
			$what = 'height',
			$based_on_new = $new_width,
			$orig_width = $new_width,
			$orig_height = $new_height
		);


		$this->tools->clone_and_resize_append_name_of(
			$appended_suffix = '_tiny',
			$full_path = $dir_path . '/' . 'image.png',
			$width = $new_tiny_width,
			$height = $new_tiny_height
			);


		$new_medium_width  = '258';
		$new_medium_height = $this->tools->get_new_size_of (
			$what = 'height',
			$based_on_new = $new_width,
			$orig_width = $new_width,
			$orig_height = $new_height
		);


		$this->tools->clone_and_resize_append_name_of(
			$appended_suffix = '_medium',
			$full_path = $dir_path . '/' . 'image.png',
			$width = $new_medium_width,
			$height = $new_medium_height
			);

		// ** In case admin was uploading JPG image.
		$this->tools->convert_to_PNG_image_from_file(
			$filename = base_url().$dir_path  . 'image_medium.png',
			$new_width = 258,
			$location = $dir_path . '/' . 'image_medium.png'
			);


		$this->tools->make_black_and_white(
			$original_image = base_url().$dir_path  . 'image_medium.png',
			$bw_image =  $dir_path . '/' . 'bw_image.png'
			);


		// ** Delete transitional image
		$this->tools->recursiveDelete($dir_path.'transition.png');


	}



	/**
	 * signin
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/signin
	 * @access public
	 **/

	function signin(){

					$select_what =  '*';

					$where_array = array(
					'email' => $this->input->post('email')
					);

					$validation = $this->query->validate_login($this->input->post());

					if( $validation['is'] == 'true'){
								$newdata = array(
							                   'email'  => $validation['email'],
							                   'user_id'     => $validation['id'],
							                   'isAdmin'     => $validation['isAdmin'],
							                   'logged_in' => TRUE
							               );

								$this->session->set_userdata($newdata);

								redirect('/home/index/' . $this->deal_id, 'refresh');


					}else{

								redirect('/home/index/bad_account', 'refresh');

					};


	}


	/**
	 * logout_facebook
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/logout_facebook
	 * @access public
	 **/

	function logout_facebook(){

//			$this->load->model('my_facebook_model');
//
//			$logoutUrl = $this->my_facebook_model->get_logout_url(
//						$next_url = base_url().'index.php/home/logout/'
//						);



			if( $_COOKIE ) {

			        foreach( $_COOKIE as $name => $value ) {

			                //Get the current cookie config
			                $params = session_get_cookie_params();

			                // Delete the cookie from globals
			                unset($_COOKIE[$name]);

			                //Delete the cookie on the user_agent
			                setcookie($name, '', time()-43200, $params['path'], '', $params['secure']);
			        }
			}

			$this->logout();
	}



	/**
	 * logout
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/logout
	 * @access public
	 **/

	function logout(){


	 		//$this->load->model('my_twitter_model');

	 		//$this->my_twitter_model->logout();

			$this->session->sess_create();

			redirect('/home/index?from_logout=1');

	}


/**
 * remove_from_calendar
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/remove_from_calendar
 * @access public
 **/

function remove_from_calendar(){

			$where_array = array(
		  	'deal_id' => $this->deal_id,
		  	'month' => $this->input->post('month'),
		  	'day' => $this->input->post('day'),
		  	'year' => $this->input->post('year')
	  	);

			$table  = 'calendar';

			$this->my_database_model->delete_from_table( $table, $where_array);

}


/**
 * add_to_calendar
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/add_to_calendar
 * @access public
 **/

function add_to_calendar(){

		/**
		 * Insert into table if not already exist otherwise do an update
		 *
		 **/


		$select_what =  '*';

		$where_array = array('id' => $this->deal_id);

		$deals = $this->my_database_model->select_from_table( $table = 'deals', $select_what, $where_array, $use_order = false, $order_field = 'id', $order_direction = 'desc', $limit = -1, $use_join = FALSE, $join_array = array());


		$table = 'calendar';

	  $where_array = array(
	  	'month' => $this->input->post('month'),
	  	'day' => $this->input->post('day'),
	  	'year' => $this->input->post('year'),
			'day_of_year'=> date('z',strtotime($this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day')))
	  	);

	  if( $this->my_database_model->check_if_exist($where_array, $table) ){



	  }else{

	  			$deal_url = str_replace(" ", "-", $deals[0]->deal_short_description);

	  			$deal_url = str_replace(".", "", $deal_url);

	  			$insert_what =	 array(
					  	'deal_id' => $this->deal_id,
					  	'month' => $this->input->post('month'),
					  	'day' => $this->input->post('day'),
					  	'year' => $this->input->post('year'),
							'day_of_year'=> date('z',strtotime($this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day'))),
							'deal_url'=> $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day').'-' .  $deal_url
					  	);

					$primary_key = $this->my_database_model->insert_table(
													$table = 'calendar',
													$insert_what
													);

	  };



	  echo $deals[0]->deal_name;

}




/**
 * calendar
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/calendar
 * @access public
 **/

function calendar(){

		$this->load->library('calendar');


		if( $this->input->get('year') != ''){
			$year = $this->input->get('year');
		}else{
			$year = date("Y");
		};


		if( $this->input->get('goto_month') != ''){
			if( $this->input->get('goto_month') == 13){
				$month = $goto_month =  1;
				$year = date("Y") + 1;
			}elseif($this->input->get('goto_month') == 0){
				$month = $goto_month =  12;
				$year = $this->input->get('year') - 1;
			}else{
				$month = $goto_month = $this->input->get('goto_month');
			};

		}else{
			$month = date("m");
		};

		if( !isset($daysInMonthBooked) ){
			$daysInMonthBooked = array();
		};


		$select_what =  '
			day,
			calendar.id as calendar_id,
			deals.deal_name,
			deal_id
			';

		$where_array = array(

		 'month' =>  $month,
		 'year' =>  $year,
		 'priority' => $this->priority
		 );


		$join_array = array(
									'deals' => 'deals.id = calendar.deal_id'
									);


		$booked = $this->my_database_model->select_from_table(
			$table = 'calendar',
			$select_what,
			$where_array,
			$use_order = TRUE,
			$order_field = 'day_of_year',
			$order_direction = 'asc',
			$limit = -1,
			$use_join = TRUE,
			$join_array );


		$booked = $this->tools->object_to_array($booked);



		foreach( $booked  as  $key => $value){
			$how_many = (int)$this->query->how_many_bought_during_one_booked_segment($calendar_id = $value['calendar_id']);
			$inner_array  = array(
				'day' => $value['day'],
				'calendar_id' => $value['calendar_id'],
				'deal_name' => $value['deal_name'],
				'deal_id' => $value['deal_id'],
				'howmany' => $how_many
			);
			$prebooked[$key]  = $inner_array;
			unset($inner_array);
		}

		if( !isset($prebooked)){
			$prebooked = array();
		};



		$data= array(
		'year' => $year,
		'month' => $month,
		'day' => $this->input->get('day'),
		'goto_month' => ( isset( $goto_month) ? $goto_month:'' ),
		'deal_id' => $this->uri->segment(3),
		'booked' => $prebooked,
		'priority' => $this->priority
		);



		$this->load->view('home/calendar_view', $data);


}


/**
 * add_update_options
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/add_update_options
 * @access public
 **/

function add_update_options(){


	if( $this->input->post('primary_key')==0){
			$this->query->insert_option(  $this->input->post() );
	}else{
			$this->query->update_option(  $this->input->post() );
	};

 	$options = $this->tools->object_to_array(  $this->query->get_options( $this->input->post() ) );
	$this->custom->echo_options_list(  $options  );

}


/**
 * delete_option
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/add_update_options
 * @access public
 **/

function delete_option(){

	$this->query->delete_option(  $this->input->post() );

 	$options = $this->tools->object_to_array(  $this->query->get_options( $this->input->post() ) );
	$this->custom->echo_options_list(  $options  );

}


/**
 * echo_options_list
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/echo_options_list
 * @access public
 **/

function echo_options_list(){

 	$options = $this->tools->object_to_array(  $this->query->get_options( $this->input->post() ) );
	$this->custom->echo_options_list(  $options  );

}




/**
 * add_update_vouchers
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/add_update_vouchers
 * @access public
 **/

function add_update_vouchers(){

	if( $this->input->post('voucher_id')==0){
			$this->query->insert_voucher(  $this->input->post() );
	}else{
			$this->query->update_voucher(  $this->input->post() );
	};

 	$vouchers = $this->tools->object_to_array(  $this->query->get_vouchers( $this->input->post() ) );
	$this->custom->echo_vouchers_list(  $vouchers  );

}


/**
 * delete_voucher
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/add_update_vouchers
 * @access public
 **/

function delete_voucher(){

	$this->query->delete_voucher(  $this->input->post() );

 	$vouchers = $this->tools->object_to_array(  $this->query->get_vouchers( $this->input->post() ) );
	$this->custom->echo_vouchers_list(  $vouchers  );

}



/**
 * insert_email_subscriber
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/insert_email_subscriber
 * @access public
 **/

function insert_email_subscriber(){
		?>inserted<?php

}




/**
 * echo_vouchers_list
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/echo_vouchers_list
 * @access public
 **/

function echo_vouchers_list(){

 	$vouchers = $this->tools->object_to_array(  $this->query->get_vouchers( $this->input->post() ) );
	$this->custom->echo_vouchers_list(  $vouchers  );

}




/**
 * contactus
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/contactus
 * @access public
 **/

function contactus(){

		$select_what =  '*';

				$where_array = array(
		  	'id' => 1
				);

		$website = $this->my_database_model->select_from_table( $table = 'website', $select_what, $where_array, $use_order = TRUE, $order_field = 'id', $order_direction = 'desc', $limit = 1, $use_join = FALSE, $join_array= array() );


		$this->load->view('home/contactus_view',
		array(
		'website' => $website,
		'site_id' => $this->site_id,
		'deal_id' => $this->deal_id,
		'from_logout' => $this->from_logout
		));
}



private function get_shipping_info(){

			if( $this->input->post('ship_to_other') && $this->input->post('ship_to_other') == 1){

			    $shipping_info['first_name'] = $this->input->post('shipping_first_name');
			    $shipping_info['last_name'] = $this->input->post('shipping_last_name');
			    $shipping_info['address'] = $this->input->post('shipping_address');
			    $shipping_info['city'] = $this->input->post('shipping_city');
			    $shipping_info['state'] = $this->input->post('shipping_state');
			    $shipping_info['zipcode'] = $this->input->post('shipping_zipcode');

			}else{

					$shipping_info['first_name'] = $this->input->post('cc_first_name');
					$shipping_info['last_name'] = $this->input->post('cc_last_name');
					$shipping_info['address'] = $this->input->post('cc_address');
					$shipping_info['city'] = $this->input->post('cc_city');
					$shipping_info['state'] = $this->input->post('cc_state');
					$shipping_info['zipcode']= $this->input->post('cc_zipcode');

			};

		return $shipping_info;

}

/**
 * get_promo_code
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/get_promo_code
 * @access public
 **/


function get_promo_code(){

		$promo_codes =  $this->query->get_promo_codes_by_code($this->input->post('promo_code'));
		echo ( is_array( $promo_codes)  ? $promo_codes[0]->value: 0 );

}


/**
 * forgot_password
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/orgot_password
 * @access public
 **/


function forgot_password(){
	
		$password_change_code = rand(5, 123123);

		$this->my_database_model->update_table_where( 
			$table='users', 
			$where_array = array(
				'email' => $this->input->post('email')
			), 
			$set_what_array = array(
				'password_change_code' => $password_change_code
				)
		);
		
		echo $password_change_code;

}




/**
 * create_table
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/create_table
 * @access public
 **/


function create_table(){

$table = 'promo_codes';

$this->my_database_model->	create_generic_table($table );

$fields_array = array(
                      'name' => array(
                                               'type' => 'varchar(255)',
                                    ),
                      'code' => array(
                                               'type' => 'varchar(255)'
                                    ),
                      'value' => array(
                                               'type' => 'decimal(10.2)'
                                    )
              );



$this->my_database_model->add_column_to_table_if_exist(
	$table,
	$fields_array
);



}


/**


		$fields_array = array(
		                        'id' => array(
		                                                 'type' => 'INT',
		                                                 'unsigned' => TRUE,
		                                                 'auto_increment' => TRUE
		                                      ),
		                        'site_id' => array(
		                                                 'type' => 'INT',
		                                                 'unsigned' => TRUE
		                                      ),
		                        'created' => array(
		                                                 'type' => 'DATETIME'
		                                        ),
		                        'updated' => array(
		                                                 'type' => 'DATETIME'
		                                        )
		                );

		$primary_key = 'id';

		$this->my_database_model->create_table_with_fields($table, $primary_key, $fields_array);

		$fields_array = array(
		                        'fullname' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'email' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'password' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'zipcode' => array(
		                                                 'type' => 'varchar(255)'
		                                        )
		                );

		$this->my_database_model->add_column_to_table_if_exist($table, $fields_array);

	$fields_array = array(
		                        'id' => array(
		                                                 'type' => 'INT',
		                                                 'unsigned' => TRUE,
		                                                 'auto_increment' => TRUE
		                                      ),
		                        'site_id' => array(
		                                                 'type' => 'INT',
		                                                 'unsigned' => TRUE
		                                      ),
		                        'created' => array(
		                                                 'type' => 'DATETIME'
		                                        ),
		                        'updated' => array(
		                                                 'type' => 'DATETIME'
		                                        )
		                );

		$primary_key = 'id';

		$this->my_database_model->create_table_with_fields($table, $primary_key, $fields_array);

		$fields_array = array(
				                    'contact' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
				                    'email' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'company_name' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'address' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'address2' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'city' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'state' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'zipcode' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'telephone' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'fax' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'telephone' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'vendor_website' => array(
		                                                 'type' => 'varchar(255)'
		                                        ),
		                        'vendor_type_id' => array(
		                                                 'type' => 'int'
		                                        ),
		                        'notes' => array(
		                                                 'type' => 'blob'
		                                        )
		                );

		$this->my_database_model->add_column_to_table_if_exist($table, $fields_array);

**/




}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */