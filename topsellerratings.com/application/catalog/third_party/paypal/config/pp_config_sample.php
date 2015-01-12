<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['pp_environment'] = 'sandbox'; //options are 'sandbox' or 'live'

/* 
The username, pwd, and signature are received from your PayPal account profile.
These are needed to process payments.
*/
$config['username_sandbox']	= '';
$config['pwd_sandbox']	= '';
$config['signature_sandbox'] = '';

$config['username_live'] = '';
$config['pwd_live']  = '';
$config['signature_live'] = '';

$config['wpp_nvp_endpoint_sandbox'] = "https://api-3t.sandbox.paypal.com/nvp";
$config['wpp_nvp_endpoint_live'] = "https://api-3t.paypal.com/nvp";

$config['ec_redirect_url_sandbox'] = "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&";
$config['ec_redirect_url_live'] = "https://www.paypal.com/webscr?cmd=_express-checkout&";


/* End of file config.php */
/* Location: config/config.php */