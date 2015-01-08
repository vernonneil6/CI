<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class PPBMButtonSearch extends PPPro{

	public $method = "BMButtonSearch";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setStartDate($date)

// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setEndDate($date)

	
}

/* End of file third_party/paypal/libraries/PPBMButtonSearch.php */