<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPDoCapture extends PPPro{

	public $method = "DoCapture";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setAmt($amt)
	//setAuthorizationID($id)

	public function setCompleteType($complete_type = "NotComplete")
	{
		$this->request["COMPLETETYPE"] = $complete_type;
		return $this;
	}
// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setCurrencyCode($currency)
	//setSoftDescriptor($soft_descriptor)
	//setInvNum($inv_num)
	//setNote($note)
}

/* End of file third_party/paypal/libraries/PPDoCapture.php */