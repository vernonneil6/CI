<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPManagePendingTransactionStatus extends PPPro{

	public $method = "ManagePendingTransactionStatus";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setTransactionID($id)

	public function setAction($action)
	{
		$this->request["ACTION"] = $action;
		return $this;
	}

}

/* End of file third_party/paypal/libraries/PPManagePendingTransactionStatus.php */