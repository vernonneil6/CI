<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPGetBalance extends PPPro{

	public $method = "GetBalance";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //

// ---------- Optional Parameters ----------------------------------------------------------------------- //
	public function setCurrencyReturn($currency = 0) //If 0 returns primary currency, if 1 all currencies
	{
		$this->request["RETURNALLCURRENCIES"] = $currency;
		return $this;
	}
}

/* End of file third_party/paypal/libraries/PPGetBalance.php */