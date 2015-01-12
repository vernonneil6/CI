<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPDoNonReferencedCredit extends PPPro{

	public $method = "DoNonReferencedCredit";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setAmt($amt)
	//setCurrencyCode($currency = "USD")
	//setCreditCard($credit)
	//setName($name)
	//setAddress($address)
// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setShippingAmt($shipping_amt)
	//setTaxAmt($tax_amt)
	//setIssueNumber($issue_number)
	//setStartDate($start_date)
	//setNote($note)

	public function setNetAmt($net_amt)
	{
		$this->request["NETAMT"] = $net_amt;
		return $this;
	}
}

/* End of file third_party/paypal/libraries/PPDoNonReferencedCredit.php */