<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPBMManageButtonStatus extends PPPro{

	public $method = "BMManageButtonStatus";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setHostedButtonID($id)

	public function setButtonStatus($status)
	{
		$this->request["BUTTONSTATUS"] = $status;
		return $this;
	}

// ---------- Optional Parameters ----------------------------------------------------------------------- //


	
}

/* End of file third_party/paypal/libraries/PPBMManageButtonStatus.php */