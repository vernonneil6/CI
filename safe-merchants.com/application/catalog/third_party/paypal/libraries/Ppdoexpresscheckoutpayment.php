<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPDoExpressCheckoutPayment extends PPPro{

	public $method = "DoExpressCheckoutPayment";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }
    
// ---------- Required Parameters ----------------------------------------------------------------------- //
    //setToken($token)
    //setPaymentRequestAmt($amounts)
    //setPaymentRequestCurrency($currencies)
    //setPaymentRequestPaymentAction($actions)

    public function setPayerID($payerid)
    {
        $this->request["PAYERID"] = $payerid;
        return $this;
    }

	

	
}

/* End of file third_party/paypal/libraries/PPDoExpressCheckoutPayment.php */