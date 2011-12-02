<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This file is found in library section of the codeigniter application directory
 *
 */


/**
 * Useful common functions. 
 * @autoloaded YES
 * @path \system\application\libraries\Tools.php
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @copyright 2010 Prospace LLC
 * @version 1.0
 * 
 */
class Validate {

private $CI;

function Validate(){
	
	$this->CI =& get_instance();	

}


function isValidEmail($email){

	if( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email) ) {
		return FALSE;
	}else {
		return TRUE;
	}	
	
}
	

}


/* End of file Validate.php */ 
/* Location: \system\application\libraries\Validate.php */
