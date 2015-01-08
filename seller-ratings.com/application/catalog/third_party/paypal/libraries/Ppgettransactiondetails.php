<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPGetTransactionDetails extends PPPro{

	public $method = "GetTransactionDetails";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setTransactionID($id)
}

/* End of file third_party/paypal/libraries/PPGetTransactionDetails.php */