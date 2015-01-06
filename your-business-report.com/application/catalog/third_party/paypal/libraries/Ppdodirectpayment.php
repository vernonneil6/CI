<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PPDoDirectPayment extends PPPro{

	public $method = "DoDirectPayment";
	//public $required = array("VERSION", "IPADDRESS", "CREDITCARDTYPE", "ACCT", "EXPDATE", "CVV2", "FIRSTNAME", "LASTNAME", "STREET", "CITY", "STATE", "ZIP", "COUNTRYCODE", "AMT",);

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	public function setIP($ip)
	{
		$this->request["IPADDRESS"] = $ip;
		return $this;
	}

	//setCreditCard($credit)
	//setName($name)
	//setAddress($address)
	//setAmt($amt)

// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setCurrencyCode($currency = "USD")
	//setStartDate($start_date)
	//setShippingAmt($amt)
	//setTaxAmt($tax)
	//setShipToAddress($address)
	//setPaymentAction($paymentaction)
	//setReturnFMFDetails($fmfdetails)
	//setIssueNumber($issue_number)
	//setDesc($desc)
	//setCustom($custom)
	//setInvNum($invnum)
	//setNotifyURL($notifyurl)

	public function setItemAmt($amt)
	{
		$this->request["ITEMAMT"] = $amt;
		return $this;
	}

	public function setInsuranceAmt($amt)
	{
		$this->request["INSURANCEAMT"] = $amt;
		return $this;
	}

	public function setShipDiscAmt($amt)
	{
		//Shipping discount specified as negative number
		$this->request["SHIPDISCAMT"] = $amt;
		return $this;
	}

	public function setHandlingAmt($amt)
	{
		$this->request["HANDLINGAMT"] = $amt;
		return $this;
	}

// ---------- Payment Details Item Fields ------------------------------------------------------ //
	public function setLName($names)
	{
		foreach($names as $key => $value)
		{
			$this->request["L_NAME".$key] = $value;
		}
		return $this;
	}

	public function setLDesc($descriptions)
	{
		foreach($descriptions as $key => $value)
		{
			$this->request["L_DESC".$key] = $value;
		}
		return $this;
	}

	public function setLAmt($amounts)
	{
		foreach($amounts as $key => $value)
		{
			$this->request["L_AMT".$key] = $value;
		}
		return $this;
	}

	public function setLNumber($numbers)
	{
		foreach($numbers as $key => $value)
		{
			$this->request["L_NUMBER".$key] = $value;
		}
		return $this;
	}

	public function setLQty($quantities)
	{
		foreach($quantities as $key => $value)
		{
			$this->request["L_QTY".$key] = $value;
		}
		return $this;
	}

	public function setLTaxAmt($tax_amounts)
	{
		foreach($tax_amounts as $key => $value)
		{
			$this->request["L_TAXAMT".$key] = $value;
		}
		return $this;
	}
// ---------- 3D Secure Fields ------------------------------------------------------ //
	public function setAuthStatus3ds($auth_status_3ds)
	{
		$this->request["AUTHSTATUS3DS"] = $auth_status_3ds;
		return $this;
	}

	public function setMpiVendor3ds($mpi_vendor_3ds)
	{
		$this->request["MPIVENDOR3DS"] = $mpi_vendor_3ds;
		return $this;
	}

	public function setCavv($cavv)
	{
		$this->request["CAVV"] = $cavv;
		return $this;
	}

	public function setEci3ds($eci_3ds)
	{
		$this->request["ECI3DS"] = $eci_3ds;
		return $this;
	}

	public function setXid($xid)
	{
		$this->request["XID"] = $xid;
		return $this;
	}

}

/* End of file third_party/paypal/libraries/websitepro/PPDoDirectPayment.php */