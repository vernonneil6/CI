<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPTransactionSearch extends PPPro{

	public $method = "TransactionSearch";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setStartDate($date)

// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setEndDate($date)
	//setInvNum($inv_num)
	//setAmt($amt)
	//setCurrencyCode($currency)
	//setTransactionID($id)
	//setEmail($email)

	public function setReceiver($receiver)
	{
		$this->request["RECEIVER"] = $receiver;
		return $this;
	}

	public function setReceiptID($id)
	{
		$this->request["RECEIPTID"] = $id;
		return $this;
	}

	public function setAcct($acct)
	{
		$this->request["ACCT"] = $acct;
		return $this;
	}

	public function setAuctionItemNumber($item_number)
	{
		$this->request["AUCTIONITEMNUMBER"] = $item_number;
		return $this;
	}

	public function setTransactionClass($class)
	{
		$this->request["TRANSACTIONCLASS"] = $class;
		return $this;
	}

	public function setStatus($status)
	{
		$this->request["STATUS"] = $status;
		return $this;
	}

	public function setPayerName($name)
	{
		if(isset($address["salutation"])){ $this->request["SALUTATION"] = $address["salutation"]; }
		if(isset($address["firstname"])){ $this->request["FIRSTNAME"] = $address["firstname"]; }
		if(isset($address["middlename"])){ $this->request["MIDDLENAME"] = $address["middlename"]; }
		if(isset($address["lastname"])){ $this->request["LASTNAME"] = $address["lastname"]; }
		if(isset($address["suffix"])){ $this->request["SUFFIX"] = $address["suffix"]; }
		return $this;
	}
}

/* End of file third_party/paypal/libraries/PPTransactionSearch.php */