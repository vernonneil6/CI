<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPRefundTransaction extends PPPro{

	public $method = "RefundTransaction";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//function setTransactionID($id)

// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setAmt($amt)
	//setCurrencyCode($currency)
	//setNote($note)

	public function setInvoiceID($id)
	{
		$this->request["INVOICEID"] = $id;
		return $this;
	}

	public function setRefundType($type = "Full")
	{
		$this->request["REFUNDTYPE"] = $type;
		return $this;
	}
}

/* End of file third_party/paypal/libraries/PPRefundTransaction.php */