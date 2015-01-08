<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class PPSetExpressCheckoutMobile extends PPPro{
	public $method = "SetExpressCheckout";

	public function __construct()
	{
		parent::__construct();
		$this->request["METHOD"] = $this->method;
	}

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//set_amt($amt)


}

/* End of file third_party/paypal/libraries/PPSetExpressCheckoutMobile.php */