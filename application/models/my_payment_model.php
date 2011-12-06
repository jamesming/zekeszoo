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
 
class My_payment_model extends CI_Model  {
	

    function __construct()
    {
        parent::__construct();
        
				/*
				https://test.authorize.net/
				username: scenecredit2011
				password: Ourlady1234
				
				*/
				
				
// * Note: To send requests to the live gateway, either define this:
// * define("AUTHORIZENET_SANDBOX", false);
// *   -- OR -- 
// * $sale = new AuthorizeNetAIM;
// * $sale->setSandbox(false);

				$this->load->helper('authorizenet2');

$live = FALSE;
//								$live = TRUE;
				
				if( $live ){
					
								// LIVE
								$this->AUTHORIZENET_API_LOGIN_ID 			= '4EpVEkgM97xc'; 
								$this->AUTHORIZENET_TRANSACTION_KEY   = '4cY7GNM5gv35Xd97';	
								
								
								$this->request = new AuthorizeNetCIM(
								$this->AUTHORIZENET_API_LOGIN_ID, 
								$this->AUTHORIZENET_TRANSACTION_KEY
								);			
								$this->request->setSandbox(false);						
									
				}else{
					
								// SANDBOX
								$this->AUTHORIZENET_API_LOGIN_ID 			= '5q57nZhDH73k'; 
								$this->AUTHORIZENET_TRANSACTION_KEY   = '237nq8a39xA7BG5N';	
				
								$this->request = new AuthorizeNetCIM(
								$this->AUTHORIZENET_API_LOGIN_ID, 
								$this->AUTHORIZENET_TRANSACTION_KEY
								);
								$this->request->setSandbox(true);	
				};
				


		}


	/**
	 * create customer profile
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

	 function create_payment_profile(
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
			$cc_phonenumber = ''
	 ){
	 	

	   // Create new customer profile
	    $customerProfile                    = new AuthorizeNetCustomer;
	    $customerProfile->description       = $first_name.' ' .$last_name;
	    $customerProfile->merchantCustomerId= time();
	    $customerProfile->email             = $email;
	    
	    $paymentProfile = new AuthorizeNetPaymentProfile;
	    $paymentProfile->customerType = "individual";
	
			$paymentProfile->billTo->firstName = $first_name;
			$paymentProfile->billTo->lastName = $last_name;
			$paymentProfile->billTo->address = $cc_address;
			$paymentProfile->billTo->city = $cc_city;
			$paymentProfile->billTo->state = $cc_state;
			$paymentProfile->billTo->zip = $cc_zipcode;
			$paymentProfile->billTo->phoneNumber = $cc_phonenumber;


	    $paymentProfile->payment->creditCard->cardNumber = $cc_num;
	    $paymentProfile->payment->creditCard->expirationDate = $year_exp."-".$month_exp;
	    
	    
	    
	    $customerProfile->paymentProfiles[] = $paymentProfile;

	    
	    // Add shipping address.
	    $address = new AuthorizeNetAddress;
	    $address->firstName = $first_name;
	    $address->lastName = $last_name;
	    $address->company = " ";
	    $address->address = $cc_address;
	    $address->city = $cc_city;
	    $address->state = $cc_state;
	    $address->zip = $cc_zipcode;
	    $address->country = "USA";
	    $address->phoneNumber = "";
	    $address->faxNumber = "";
	    $customerProfile->shipToList[] = $address;
	    
	    return  $response = $this->request->createCustomerProfile($customerProfile);

	 }
	 
	 

	/**
	 * update customer profile Payment Profile
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/	 
	 
	function  update_customer_profile(
			$customerProfileId,
			$first_name,
			$last_name,
			$email	 
	 ){
	    $customerProfile->description       = $first_name.' ' .$last_name;
	    $customerProfile->email             = $email;
	    return $response = $this->request->updateCustomerProfile($customerProfileId, $customerProfile);
   
	 }


	/**
	 * Add Payment Profile
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

	function add_payment_profile(
			$cc_num,
			$month_exp,
			$year_exp,
			$customerProfileId,
			$paymentProfileId,
			$first_name,
			$last_name,
			$cc_address,
			$cc_city,
			$cc_state,
			$cc_zipcode,
			$cc_phonenumber = ''
		){
			


	    $paymentProfile = new AuthorizeNetPaymentProfile;
	    $paymentProfile->customerType = "individual";
			$paymentProfile->billTo->firstName = $first_name;
			$paymentProfile->billTo->lastName = $last_name;
			$paymentProfile->billTo->address = $cc_address;
			$paymentProfile->billTo->city = $cc_city;
			$paymentProfile->billTo->state = $cc_state;
			$paymentProfile->billTo->zip = $cc_zipcode;
			$paymentProfile->billTo->phoneNumber = $cc_phonenumber;

	    $paymentProfile->payment->creditCard->cardNumber = $cc_num;
	    $paymentProfile->payment->creditCard->expirationDate = $year_exp."-".$month_exp;

    	return $response = $this->request->createCustomerPaymentProfile($customerProfileId, $paymentProfile);
    
   
	}
	


	/**
	 * Add Shipping Profile
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

	function add_shipping_profile(
			$customerProfileId,
			$first_name,
			$last_name,
			$address,
			$city,
			$state,
			$zipcode,
			$phonenumber = ''
		){	
			

    $address = new AuthorizeNetAddress;
	    $address->firstName = $first_name;
	    $address->lastName = $last_name;
	    $address->company = " ";
	    $address->address = $address;
	    $address->city = $city;
	    $address->state = $state;
	    $address->zip = $zipcode;
	    $address->country = "USA";
	    $address->phoneNumber = $phonenumber;
    return $response = $this->request->createCustomerShippingAddress($customerProfileId, $address);

			
		}


	/**
	 * void transaction
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/
   
   
   function void_transaction($transactionId){
   	
    $transaction = new AuthorizeNetTransaction;
    $transaction->transId = $transactionId;
    $response = $this->request->createCustomerProfileTransaction("Void", $transaction);

    return  $response;
   }    

	/**
	 * validate ccv
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

   function validate_ccv(
	   	$customerProfileId,
	   	$customerPaymentProfileId,
	   	$customerShippingAddressId,
	   	$cardCode
   ){


    return $response = $this->request->validateCustomerPaymentProfile($customerProfileId, $customerPaymentProfileId, $customerShippingAddressId, $cardCode, $validationMode = "testMode");


   	
  }


	/**
	 * authorize only
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

   function authorize_only_transaction(
   		$order_number,
   		$order_description,
			$total_transaction_value,
	   	$customerProfileId,
	   	$paymentProfileId,
	   	$customerAddressId,
	   	$cvv
   ){
    $transaction = new AuthorizeNetTransaction;
    $transaction->amount = $total_transaction_value;
    $transaction->customerProfileId = $customerProfileId;
    $transaction->customerPaymentProfileId = $paymentProfileId;
    $transaction->customerShippingAddressId = $customerAddressId;
    $transaction->cardCode = $cvv;
    $transaction->order->invoiceNumber = $order_number;
    $transaction->order->description = $order_description;
    

    return $response = $this->request->createCustomerProfileTransaction("AuthOnly", $transaction);

   }
   
  
  
  
	/**
	 * capture prior
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/

   function capture_prior_authorized_transaction(
			$total_transaction_value,
			$user_deal_processed,
			$unit_price,
			$title_of_purchase,
			$deal_short_description,
	   	$customerProfileId,
	   	$paymentProfileId,
	   	$customerAddressId,
	   	$transactionId
   ){
   	
   	
    $transaction = new AuthorizeNetTransaction;
    $transaction->amount = $total_transaction_value;
    $transaction->customerProfileId = $customerProfileId;
    $transaction->customerPaymentProfileId = $paymentProfileId;
    $transaction->customerShippingAddressId = $customerAddressId;

     foreach($user_deal_processed as $one_user_deal_processed){

		    $lineItem              = new AuthorizeNetLineItem;
		    $lineItem->itemId      = $one_user_deal_processed;
		    $lineItem->name        = $title_of_purchase;
		    $lineItem->description = $deal_short_description;
		    $lineItem->quantity    = 1;
		    $lineItem->unitPrice   = $unit_price;
		    $lineItem->taxable     = "false";  
		      	
    		$transaction->lineItems[] = $lineItem;
    }
    

    
    $transaction->transId = $transactionId;

    $response = $this->request->createCustomerProfileTransaction("PriorAuthCapture", $transaction);
    
    
    return $response;
   }
  
  
   

	/**
	 * delete customer profile
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/
   
   
   function delete_customer($customerProfileId){
   	
 		$response = $this->request->deleteCustomerProfile($customerProfileId);
 		
				    if ($response->isOk()) {
				        $deleted['check'] = 'ok';
				    }else{
				    		$deleted['check'] = 'ERROR';
				    }
		    
    return  $response;
    
   }
   
   
	/**
	 * delete payment profile
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/
   
   
   function delete_payment_profile($customerProfileId, $paymentProfileId){
   	
    $response = $this->request->deleteCustomerPaymentProfile($customerProfileId, $paymentProfileId);
 		
    return  $response;
   }  
   
   
   
	/**
	 * delete shipping profile
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/
   
   
   function delete_shipping_profile($customerProfileId, $customerAddressId){
   	
    $response = $this->request->deleteCustomerShippingAddress($customerProfileId, $customerAddressId);

    return  $response;
   }  
   
   
	/**
	 * get customer profile
	 *	
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 **/
	 
	 
	 function get_customer_profile($customerProfileId){
	 	
		$response = $this->request->getCustomerProfile($customerProfileId);
		
		 return  $response;
	 	
	 }
   
   
     
}

/**

		
		echo "<hr />";
		
		echo "Update Payment Profile"."<br />";
		// Update Payment Profile
		
		$response = $this->my_payment_model->update_payment_profile(
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
		
		echo '<pre>';print_r(  $response   );echo '</pre>'; 
		


	 function update_payment_profile(
			$cc_num,
			$month_exp,
			$year_exp,
			$customerProfileId,
			$paymentProfileId,
			$first_name,
			$last_name,
			$cc_address,
			$cc_city,
			$cc_state,
			$cc_zipcode,
			$cc_phonenumber = ''
		){
		    // Update payment profile.
		    $paymentProfile->payment->creditCard->cardNumber = $cc_num;
		    $paymentProfile->payment->creditCard->expirationDate = $year_exp."-".$month_exp;
		    
				$paymentProfile->billTo->firstName = $first_name;
				$paymentProfile->billTo->lastName = $last_name;
				$paymentProfile->billTo->address = $cc_address;
				$paymentProfile->billTo->city = $cc_city;
				$paymentProfile->billTo->state = $cc_state;
				$paymentProfile->billTo->zip = $cc_zipcode;
				$paymentProfile->billTo->phoneNumber = $cc_phonenumber;
		    


		    return  $response = $this->request->updateCustomerPaymentProfile($customerProfileId,$paymentProfileId, $paymentProfile);
			
		}
		
**/
