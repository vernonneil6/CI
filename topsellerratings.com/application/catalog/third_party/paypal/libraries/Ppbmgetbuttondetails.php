<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class PPBMGetButtonDetails extends PPPro{

	public $method = "BMGetButtonDetails";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setHostedButtonID($id)

// ---------- Optional Parameters ----------------------------------------------------------------------- //


	
}

/* End of file third_party/paypal/libraries/PPBMGetButtonDetails.php */