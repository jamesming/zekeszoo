<?php

/**
 * Access for Users Table
 * @autoloaded YES
 * @path /system/application/models/my_payment_model.php
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @copyright 2010 Prospace LLC
 * @version 1.0
 * @todo method to delete a record
 * 
 */
 
class My_facebook_model extends CI_Model  {
	
		private $fbconfig;

    function __construct()
    {

        parent::__construct();

				$this->fbconfig = array();
								
		    $this->fbconfig['appid' ]     = "245890495426188";
		    $this->fbconfig['secret']     = "8c8d71e2e8ec09ec6a68ac4a9a57012c";


				if( isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS'] == 'on'){ 
						    $this->fbconfig['baseurl']    = "https://zekeszoo.com/index.php/home/facebook";
				}else{
						    $this->fbconfig['baseurl']    = "http://zekeszoo.com/index.php/home/facebook";
					
				}		    
		  
				
				$this->load->helper('facebook');
				
		    $this->facebook = new Facebook(array(
		      'appId'  => $this->fbconfig['appid'],
		      'secret' => $this->fbconfig['secret'],
		      'cookie' => true,
		    ));
		    
		    

			    $this->user = $this->facebook->getUser();


			    $this->loginUrl   = $this->facebook->getLoginUrl(
			            array(
			                'scope'         => 'email,
													                publish_stream,
													                user_birthday,
													                user_location,
													                user_work_history,
													                user_about_me,
													                user_hometown',
			                'redirect_uri'  => $this->fbconfig['baseurl'],
			                'display' => 'popup'
			            )
			    );


		}
		
		
		function get_logout_url($next_url){
		    return $this->facebook->getLogoutUrl(
		    	$params=array(), $next_url 
		    );
		}




     
}