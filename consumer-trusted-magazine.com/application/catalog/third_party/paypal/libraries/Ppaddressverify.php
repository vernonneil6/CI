<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class PPAddressVerify extends PPPro{

	public $method = "AddressVerify";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setEmail($email)

	public function setStreet($street)
	{
		$this->request["STREET"] = $street;
		return $this;
	}

	public function setZip($zip)
	{
		$this->request["ZIP"] = $zip;
		return $this;
	}
}

/* End of file third_party/paypal/libraries/PPAddressVerify.php */