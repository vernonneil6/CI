<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class PPSetExpressCheckout extends PPPro{

	public $method = "SetExpressCheckout";

	public function __construct()
    {
    	parent::__construct();
    	$this->request["METHOD"] = $this->method;
    }

// ---------- Required Parameters ----------------------------------------------------------------------- //
	//setPaymentRequestAmt($amounts)
	//setPaymentRequestCurrency($currencies)
	//setPaymentRequestPaymentAction($actions)

	public function setReturnURL($url)
	{
		$this->request["RETURNURL"] = $url;
		return $this;
	}

	public function setCancelURL($url)
	{
		$this->request["CANCELURL"] = $url;
		return $this;
	}

// ---------- Optional Parameters ----------------------------------------------------------------------- //
	//setAmt($amt)
	//setPaymentAction($paymentaction)
	//setCurrencyCode($currency)
	//setToken($token)
	//setEmail($email)
	
	
	//---	For Displaying Product name	---//
	public function setPaymentRequestItemTypeFields($items)
	{
		$i = 0;
		foreach($items as $item)
		{
			$this->request["L_PAYMENTREQUEST_".$i."_NAME".$i] = $item['NAME'];
			$this->request["L_PAYMENTREQUEST_".$i."_DESC".$i] = $item['DESC'];
			$this->request["L_PAYMENTREQUEST_".$i."_AMT".$i] = $item['AMT'];
			$this->request["L_PAYMENTREQUEST_".$i."_QTY".$i] = $item['QTY'];
			$i++;
		}
		return $this;
	}
	
	public function setPaymentRequestItemAmt($amounts)
	{
		$i = 0;
		foreach($amounts as $amt)
		{
			$this->request["PAYMENTREQUEST_".$i."_ITEMAMT"] = $amt;
			$this->request["PAYMENTREQUEST_".$i."_TAXAMT"] = 0;
			$this->request["PAYMENTREQUEST_".$i."_SHIPPINGAMT"] = 0;
			$i++;
		}
		return $this;
	}
	
	public function setPaymentRequestTaxAmt($amounts)
	{
		$i = 0;
		foreach($amounts as $amt)
		{
			$this->request["PAYMENTREQUEST_".$i."_TAXAMT"] = $amt;
			$i++;
		}
		return $this;
	}
	
	public function setPaymentRequestShippingAmt($amounts)
	{
		$i = 0;
		foreach($amounts as $amt)
		{
			$this->request["PAYMENTREQUEST_".$i."_SHIPPINGAMT"] = $amt;
			$i++;
		}
		return $this;
	}
	
	public function setPaymentRequestPaymentRequestID($ids)
	{
		$i = 0;
		foreach($ids as $id)
		{
			$this->request["PAYMENTREQUEST_".$i."_PAYMENTREQUESTID"] = $id;	
			$i++;
		}
		return $this;
	}

	public function setPaymentRequestCustom($notes)
	{
		$i = 0;
		foreach($notes as $note)
		{
			$this->request["PAYMENTREQUEST_".$i."_CUSTOM"] = $note;	
			$i++;
		}
		return $this;
	}

	public function setPaymentRequestInvnum($numbers)
	{
		$i = 0;
		foreach($numbers as $number)
		{
			$this->request["PAYMENTREQUEST_".$i."_INVNUM"] = $number;	
			$i++;
		}
		return $this;
	}

	public function setPaymentRequestNotifyURL($urls)
	{
		$i = 0;
		foreach($urls as $url)
		{
			$this->request["PAYMENTREQUEST_".$i."_NOTIFYURL"] = $url;	
			$i++;
		}
		return $this;
	}

	public function setReqConfirmShipping($req_confirm_shipping = 0)
	{
		//Required for digital coods and must be a zero
		$this->request["REQCONFIRMSHIPPING"] = $req_confirm_shipping;
		return $this;
	}

	public function setNoShipping($no_shipping)
	{
		//Required for digital coods and must be one
		$this->request["NOSHIPPING"] = $no_shipping;
		return $this;
	}

	public function setMaxAmt($amt)
	{
		$this->request["MAXAMT"] = $amt;
		return $this;
	}

	public function setCallback($callback)
	{
		$this->request["CALLBACK"] = $callback;
		return $this;
	}

	public function setCallbackTimeout($callback_timeout)
	{
		$this->request["CALLBACKTIMEOUT"] = $callback_timeout;
		return $this;
	}

	public function setAllowNote($allow_note = 1)
	{
		$this->request["ALLOWNOTE"] = $allow_note;
		return $this;
	}

	public function setAddroverRide($override = 0)
	{
		$this->request["ADDROVERRIDE"] = $override;
		return $this;
	}

	public function setLocaleCode($locale_code = "US")
	{
		$this->request["LOCALECODE"] = $locale_code;
		return $this;
	}
// ---------- Only Giropay in Germany ----------------------------------------------------------------- //
	public function setGiropaySuccessURL($url)
	{
		$this->request["GIROPAYSUCCESSURL"] = $url;
		return $this;
	}

	public function setGiropayCancelURL($url)
	{
		$this->request["GIROPAYCANCELURL"] = $url;
		return $this;
	}

	public function setBankTxnPendingURL($url)
	{
		$this->request["BANKTXNPENDINGURL"] = $url;
		return $this;
	}

// ---------- Custom page styles ----------------------------------------------------------------- //
	public function setPageStyle($page_style)
	{
		$this->request["PAGESTYLE"] = $page_style;
		return $this;
	}

	public function setBrandName($brand_name)
	{
		$this->request["BRANDNAME"] = $brand_name;
		return $this;
	}

	public function setHdrImg($img)
	{
		$this->request["HDRIMG"] = $img;
		return $this;
	}

	public function setHdrBorderColor($color)
	{
		$this->request["HDRBORDERCOLOR"] = $color;
		return $this;
	}

	public function setHdrBackColor($color)
	{
		$this->request["HDRBACKCOLOR"] = $color;
		return $this;
	}

	public function setPayflowColor($color)
	{
		$this->request["PAYFLOWCOLOR"] = $color;
		return $this;
	}

	public function setSolutionType($type)
	{
		//Can be "Mark" or "Sole"
		$this->request["SOLUTIONTYPE"] = $type;
		return $this;
	}

	public function setLandingPage($page)
	{
		//"Billing" for non-paypal account or "Login" for PayPal account login
		$this->request["LANDINGPAGE"] = $page;
		return $this;
	}

	public function setChannelType($channel_type)
	{
		//Either "Merchant" or "eBayItem"
		$this->request["CHANNELTYPE"] = $channel_type;
		return $this;
	}

	public function setCustomerServiceNumber($number)
	{
		$this->request["CUSTOMERSERVICENUMBER"] = $number;
		return $this;
	}

	public function setGiftMessageEnable($gift_message_enable)
	{
		$this->request["GIFTMESSAGEENABLE"] = $gift_message_enable;
		return $this;
	}
// ---------- BILLING AGREEMENT ----------------------------------------------------------------- //
	public function setLBillingType($billings) //REQUIRED for billing agreements
	{
		for($i = 0; $i < $billings; $i++)
		{
			$this->request["L_BILLINGTYPE".$i.""] = "RecurringPayments";
		}
		return $this;
	}

	public function setLBillingAgreementDescription($descs) //REQUIRED for billing agreements
	{
		$i = 0;
		foreach($descs as $desc)
		{
			$this->request["L_BILLINGAGREEMENTDESCRIPTION".$i.""] = $desc;	
			$i++;
		}
		return $this;
	}

	public function setLPaymentType($types) //Optional "Any" or "InstantOnly"
	{
		$i = 0;
		foreach($types as $type)
		{
			$this->request["L_PAYMENTTYPE".$i.""] = $type;	
			$i++;
		}
		return $this;
	}

	public function setLBillingAgreementCustom($customs) //Optional
	{
		$i = 0;
		foreach($customs as $custom)
		{
			$this->request["L_BILLINGAGREEMENTCUSTOM".$i.""] = $custom;	
			$i++;
		}
		return $this;
	}






}

/* End of file third_party/paypal/libraries/PPSetExpressCheckout.php */