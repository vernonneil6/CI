<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPDoReferenceTransaction extends PPPro{

	public $method = "DoReferenceTransaction";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setAmt($amt)
	//setCurrencyCode($currency = "USD")
	//setCreditCard($credit)

	public function setReferenceID($id)
	{
		$this->request["REFERENCEID"] = $id;
		return $this;
	}

// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setAddress($address)
	//setShipToAddress($address)
	//setPaymentAction($paymentaction)
	//setReturnFMFDetails($fmfdetails)
	//setStartDate($start_date)
	//setIssueNumber($issue_number)
	//setSoftDescriptor($descriptor)
}

/* End of file third_party/paypal/libraries/PPDoReferenceTransaction.php */