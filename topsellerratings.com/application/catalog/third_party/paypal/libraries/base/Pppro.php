<?php
include("Ppconfig.php");
include("Ppobject.php");
/**
 *
 * @version    1.0
 * @author     Jason Michels
 */
class PPPro extends PPObject{

	function __construct() 
	{
		parent::__construct();
		$this->request = $this->wppNVPAuth();
		$this->url = $this->endpoints['wpp_nvp'][$this->environment];
	}

	public function wppNVPAuth()
	{
		return array(
			"USER" 		=> $this->api_creds[$this->environment]['user'], 
			"PWD" 		=> $this->api_creds[$this->environment]['pwd'], 
			"SIGNATURE" => $this->api_creds[$this->environment]['signature']
		);
	}

	public function setVersion($version = "80.0")
	{
		$this->request["VERSION"] = $version;
		return $this;
	}

	public function setAmt($amt)
	{
		$this->request["AMT"] = $amt;
		return $this;
	}

	public function setCurrencyCode($currency = "USD")
	{
		$this->request["CURRENCYCODE"] = $currency;
		return $this;
	}

	public function setCreditCard($credit)
	{
		$this->request["CREDITCARDTYPE"] = $credit["creditcardtype"];
		$this->request["ACCT"] = $credit["acct"];
		if(isset($credit["expdate"])){ $this->request["EXPDATE"] = $credit["expdate"]; }
		if(isset($credit["cvv2"])){ $this->request["CVV2"] = $credit["cvv2"]; }
		return $this;
	}

	public function setName($name) //Payer information fields. Email is not required
	{
		$this->request["FIRSTNAME"] = $name["first"];
		$this->request["LASTNAME"] = $name["last"];
		if(isset($name["email"])){ $this->request["EMAIL"] = $name["email"]; }
		return $this;
	}

	public function setAddress($address)
	{
		$this->request["STREET"] = $address["street"];
		if(isset($address["street2"])){ $this->request["STREET2"] = $address["street2"]; }
		$this->request["CITY"] = $address["city"];
		$this->request["STATE"] = $address["state"];
		$this->request["ZIP"] = $address["zip"];
		$this->request["COUNTRYCODE"] = $address["countrycode"];
		if(isset($address["shiptophonenum"])){ $this->request["SHIPTOPHONENUM"] = $address["shiptophonenum"];}
		return $this;
	}

	public function setShipToAddress($address)
	{
		if(isset($address["shiptoname"])){ $this->request["SHIPTONAME"] = $address["shiptoname"]; }
		if(isset($address["shiptostreet"])){ $this->request["SHIPTOSTREET"] = $address["shiptostreet"]; }
		if(isset($address["shiptostreet2"])){ $this->request["SHIPTOSTREET2"] = $address["shiptostreet2"]; }
		if(isset($address["shiptocity"])){ $this->request["SHIPTOCITY"] = $address["shiptocity"]; }
		if(isset($address["shiptostate"])){ $this->request["SHIPTOSTATE"] = $address["shiptostate"]; }
		if(isset($address["shiptozip"])){ $this->request["SHIPTOZIP"] = $address["shiptozip"]; }
		if(isset($address["shiptocountry"])){ $this->request["SHIPTOCOUNTRY"] = $address["shiptocountry"]; }
		if(isset($address["shiptophonenum"])){ $this->request["SHIPTOPHONENUM"] = $address["shiptophonenum"];}
		return $this;
	}

	public function setStartDate($start_date)
	{
		$this->request["STARTDATE"] = $start_date;
		return $this;
	}

	public function setEndDate($date)
	{
		$this->request["ENDDATE"] = $date;
		return $this;
	}
	
	public function setShippingAmt($amt)
	{
		//If you set this you also must set ITEMAMT
		$this->request["SHIPPINGAMT"] = $amt;
		return $this;
	}

	public function setTaxAmt($tax)
	{
		$this->request["TAXAMT"] = $tax;
		return $this;
	}

	public function setPaymentAction($paymentaction = 'Sale')
	{
		//can be "Authorization" or "Sale"
		$this->request["PAYMENTACTION"] = $paymentaction;
		return $this;
	}

	public function setReturnFMFDetails($fmfdetails = 0)
	{
		$this->request["RETURNFMFDETAILS"] = $fmfdetails;
		return $this;
	}

	public function setIssueNumber($issue_number)
	{
		$this->request["ISSUENUMBER"] = $issue_number;
		return $this;
	}

	public function setSoftDescriptor($descriptor)
	{
		//Description of the payment passed to buyers credit card statement. Format is below:
		//<PP * | PAYPAL *><Merchant descriptor as set in the Payment Receiving Preferences><1 space><soft descriptor>
		$this->request["SOFTDESCRIPTOR"] = $descriptor;
		return $this;
	}

	public function setDesc($desc)
	{
		$this->request["DESC"] = $desc;
		return $this;
	}

	public function setCustom($custom)
	{
		$this->request["CUSTOM"] = $custom;
		return $this;
	}

	public function setNote($note)
	{
		$this->request["NOTE"] = $note;
		return $this;
	}

	public function setToken($token)
    {
        $this->request["TOKEN"] = $token;
        return $this;
    }

    public function setInvNum($inv_num)
	{
		$this->request["INVNUM"] = $inv_num;
		return $this;
	}

	public function setNotifyURL($notifyurl)
	{
		$this->request["NOTIFYURL"] = $notifyurl;
		return $this;
	}

	public function setPaymentRequestAmt($amounts)
	{
		$i = 0;
		foreach($amounts as $amt)
		{
			$this->request["PAYMENTREQUEST_".$i."_AMT"] = $amt;	
			$i++;
		}
		return $this;
	}	
	public function setPaymentRequestCurrency($currencies)
	{
		$i = 0;
		foreach($currencies as $currency)
		{
			$this->request["PAYMENTREQUEST_".$i."_CURRENCYCODE"] = $currency;	
			$i++;
		}
		return $this;
	}

	public function setPaymentRequestPaymentAction($actions)
	{
		$i = 0;
		foreach($actions as $action)
		{
			$this->request["PAYMENTREQUEST_".$i."_PAYMENTACTION"] = $action;	
			$i++;
		}
		return $this;
	}

	public function setTransactionID($id)
	{
		$this->request["TRANSACTIONID"] = $id;
		return $this;
	}

	public function setEmail($email)
	{
		$this->request["EMAIL"] = $email;
		return $this;
	}

	public function setAuthorizationID($id)
	{
		$this->request["AUTHORIZATIONID"] = $id;
		return $this;
	}









	
	
	//START BUTTON MANAGER SHARED FUNCTIONS
	public function setHostedButtonID($id)
	{
		$this->request["HOSTEDBUTTONID"] = $id;
		return $this;
	}

	public function setButtonType($type)
	{
		$this->request["BUTTONTYPE"] = $type;
		return $this;
	}

	public function setButtonCode($code)
	{
		$this->request["BUTTONCODE"] = $code; //HOSTED,ENCRYPTED, CLEARTEXT, TOKEN
		return $this;
	}

	public function setOptionNames($options)
	{		
		$i = 0;
		foreach($options as $option)
		{
			$this->request["OPTION".$i."NAME"] = $option['name'];
			
			if(array_key_exists('select', $option))
			{
				$f = 0;
				foreach($option['select'] as $select)
				{
					$this->request["L_OPTION".$i."SELECT".$f.""] = $select;
					$f++;
				}
			}
			
			if(array_key_exists('price', $option))
			{
				$j = 0;
				foreach($option['price'] as $price)
				{
					$this->request["L_OPTION".$i."PRICE".$j.""] = $price;
					$j++;
				}
			}
			$i++;
		}
		return $this;
	}

	public function setButtonVariables($items)
	{
		$i = 0;
		foreach($items as $item)
		{
			$this->request["L_BUTTONVAR".$i] = $item;
			$i++;
		}
		return $this;
	}
}

/* End of PPPro.php class */