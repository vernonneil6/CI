<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPCreateRecurringPaymentsProfile extends PPPro{

	public $method = "CreateRecurringPaymentsProfile";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setDesc($desc)
	//setToken($token)
	//setAmt($amt)
	//setCurrencyCode($currency)

    public function setProfileStartDate($date)
    {
        $this->request["PROFILESTARTDATE"] = $date;
        return $this;
    }

	public function setBillingPeriod($period)
	{
		$this->request["BILLINGPERIOD"] = $period;
		return $this;
	}

	public function setBillingFrequency($frequency)
	{
		$this->request["BILLINGFREQUENCY"] = $frequency;
		return $this;
	}

	public function setTotalBillingCycles($total)
	{
		$this->request["TOTALBILLINGCYCLES"] = $total;
		return $this;
	}
// ---------- Required For Credit Cards Parameters ---------------------------------------------- //
	//setCreditCard($credit)
	//setAddress($address)
// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setStartDate($start_date)
	//setIssueNumber($issue_number)
	//setShippingAmt($amt)
	//setTaxAmt($amt)
	//setShipToAddress($address)

	public function setSubscriberName($name)
    {
        $this->request["SUBSCRIBERNAME"] = $name;
        return $this;
    }

    public function setProfileReference($reference)
    {
        $this->request["PROFILEREFERENCE"] = $reference;
        return $this;
    }

    public function setMaxFailedPayments($number)
	{
		$this->request["MAXFAILEDPAYMENTS"] = $number;
		return $this;
	}

	public function setAutoBillAmount($amount)
	{
		$this->request["AUTOBILLOUTAMT"] = $amount;
		return $this;
	}

	public function setInitAmt($amt)
	{
		$this->request["INITAMT"] = $amt;
		return $this;
	}

	public function setFailedInitAmtAction($action)
	{
		$this->request["FAILEDINITAMTACTION"] = $action;
		return $this;
	}

// ---------- Optional Trial Parameters ------------------------------------------------------ //
	public function setTrialBillingPeriod($period)
	{
		$this->request["TRIALBILLINGPERIOD"] = $period;
		return $this;
	}

	public function setTrialBillingFrequency($frequency)
	{
		$this->request["TRIALBILLINGFREQUENCY"] = $frequency;
		return $this;
	}

	public function setTrialTotalBillingCycles($total)
	{
		$this->request["TRIALTOTALBILLINGCYCLES"] = $total;
		return $this;
	}

	public function setTrialAmt($amt)
	{
		$this->request["TRIALAMT"] = $amt;
		return $this;
	}
	

}

/* End of file third_party/paypal/libraries/PPCreateRecurringPaymentsProfile.php */