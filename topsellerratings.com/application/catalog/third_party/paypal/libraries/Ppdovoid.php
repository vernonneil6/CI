<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class PPDoVoid extends PPPro{
	//Void an order or authorization
	public $method = "DoVoid";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setAuthorizationID($id)
// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setNote($note)
}

/* End of file third_party/paypal/libraries/PPDoVoid.php */