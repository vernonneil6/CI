<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class PPBMCreateButton extends PPPro{

	public $method = "BMCreateButton";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setButtonType($type)
	//setButtonCode($code)

// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setButtonVariables($items)
	//setOptionNames($options)

	public function setSubscriptionOptions($options)
	{		
		$this->request["OPTION0NAME"] = $options['name'];

		$i = 0;
		foreach($options['options'] as $option)
		{
			//print_r($option);
			//echo "<br />";
			$this->request["L_OPTION0SELECT".$i.""] = $option['select'];
			$this->request["L_OPTION0PRICE".$i.""] = $option['price'];
			$this->request["L_OPTION".$i."BILLINGPERIOD0"] = $option['billingperiod'];
			$i++;
			
		}
		return $this;
	}




	
}

/* End of file third_party/paypal/libraries/PPBMCreateButton.php */