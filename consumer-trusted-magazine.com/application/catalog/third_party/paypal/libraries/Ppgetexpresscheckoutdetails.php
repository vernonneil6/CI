<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPGetExpressCheckoutDetails extends PPPro{
	
	public $method = "GetExpressCheckoutDetails";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }
// ---------- Required Parameters ----------------------------------------------------------------------- //
    //setToken($token)
}

/* End of file third_party/paypal/libraries/PPGetExpressCheckoutDetails.php */