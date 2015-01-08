<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPDoReauthorization extends PPPro{

	public $method = "DoReauthorization";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setAuthorizationID($id)
	//setAmt($amt)
// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setCurrencyCode($currency = "USD")
}

/* End of file third_party/paypal/libraries/PPDoReauthorization.php */