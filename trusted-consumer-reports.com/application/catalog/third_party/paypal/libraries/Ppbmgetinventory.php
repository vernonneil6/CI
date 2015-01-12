<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class PPBMGetInventory extends PPPro{

	public $method = "BMGetInventory";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setHostedButtonID($id)

// ---------- Optional Parameters ----------------------------------------------------------------------- //
	public function setLDigitalDownloadKeys($keys)
	{
		$i = 0;
		foreach($keys as $key)
		{
			$this->request["L_DIGITALDOWNLOADKEYS".$i] = $key;
			$i++;
		}
		return $this;
	}

	
}

/* End of file third_party/paypal/libraries/PPBMGetInventory.php */