# Unofficial PayPal PHP Website Payments Pro SDK Codeigniter Package [Jason Michels] (http://thebizztech.com/)

NOTE:  This package is built to work with Codeigniter and allows for most of the PayPal Website Payments Pro functionality.  Not every single PayPal Pro API is built into this package, or if it is it may need refactoring, but the major API functions work correctly.

DEPENDANCIES:  There is one dependancy for this package, a curl library I built.  https://github.com/thebizztech/Simple-Codeigniter-Curl-PHP-Class  
You can possibly use Phil Sturgeons Curl library, but this package was built by creating an array, sending it to the curl class, and returning an array as the response from PayPal.  If you don't want to use my curl library, all you need to do is edit the execute() function found in paypal/libraries/base/PPObject.php.

SETUP: To get this working their is some setup needed.  
(1) Copy the package into your third_party folder and into a folder named paypal.  
(2) Make sure to have the curl library in your application/libraries folder, and optionally autoload it.<br />
(3) Open the application/third_party/paypal/config folder and rename pp_config_sample.php to pp_config.php.<br />
(4) Open the new pp_config.php file and enter your API username, password, and signature you get from your PayPal account. If you want to test in the PayPal sandbox you can sign up for an account at https://developer.paypal.com<br />
(5) Next create a controller, load the package, load the library your want to use, and process payments. See example below.<br />
(6) For debugging purposes, the curl library allows you to log your request and response messages between you and PayPal. If you ever have any troubles with transactions this is a huge help, and PayPal technical support will ask for this data. To enable these add these two lines to the bottom of your application/config/config.php<br />
$config['log_curl_request'] 	= 1;<br />
$config['log_curl_response'] 	= 1;<br />

Below I have posted an example of how to run a simple credit card transaction using DoDirectPayment.

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pay extends CI_Controller {

	public function index()
	{
		$this->load->add_package_path(APPPATH.'third_party/paypal/');
		$this->load->library('ppdodirectpayment');

		$payment = $this->ppdodirectpayment
				        ->setVersion()
				        ->setIP("192.168.1.0")
				        ->setPaymentAction("Authorization")
				        ->setCreditCard(array(
				                "creditcardtype"        => "Visa", 
				                "acct"                  => "4322713247967434", 
				                "expdate"               => "102013", 
				                "cvv2"                  => "123"
				        ))
				        ->setName(array(
				                "first" => "Jason", 
				                "last"  => "Michels"
				        ))
				        ->setAddress(array(
				                "street"        => "123", 
				                "city"          => "Papillion", 
				                "state"         => "NE", 
				                "zip"           => "68046", 
				                "countrycode"   => "US"
				        ))
				        ->setAmt("4.10")
				        ->execute();

		print_r($payment);
	}//end of Index function 

}//end of Controller

?>