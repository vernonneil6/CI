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
	//setHostedButtonID($id)

// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setButtonCode($code)

	public function setButtonImage($image)
	{
		$this->request["BUTTONIMAGE"] = $image;
		return $this;
	}

	public function setButtonImageURL($url)
	{
		$this->request["BUTTONIMAGEURL"] = $url;
		return $this;
	}

	public function setBuyNowText($text)
	{
		$this->request["BUYNOWTEXT"] = $text;
		return $this;
	}
	
	//setButtonVariables($items)

	public function setTextBox($items)
	{
		$i = 0;
		foreach($items as $item)
		{
			$this->request["L_TEXTBOX".$i] = $item;
			$i++;
		}
		return $this;
	}

	//setOptionNames($options)


	
}

/* End of file third_party/paypal/libraries/PPBMCreateButton.php */