<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPDoAuthorization extends PPPro{

	public $method = "DoAuthorization";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setAmt($amt)
	//setTransactionID($id)
	
// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setCurrencyCode($currency = "USD")

	public function setTransactionEntity($transaction_entity = "Order")
	{
		$this->request["TRANSACTIONENTITY"] = $transaction_entity;
		return $this;
	}
}

/* End of file third_party/paypal/libraries/PPDoAuthorization.php */