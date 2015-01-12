<?php
/**
 *
 * @version    1.0
 * @author     Jason Michels
 * Naming convention: 
 * Classes will be Pascal Case. Example: class DoDirectPayment
 * Functions will be Camel Case: Example: function doQuery
 * Variables will use underscores: Example: this_good_variable
 * Constants same as variables except all upper case
 */

class PPConfig{
	protected $environment = "";
	protected $ci = "";

	protected $api_creds = array();
	protected $endpoints = array();

	function __construct() 
	{
		$this->ci =& get_instance();
		
		$this->environment = $this->ci->config->item('pp_environment');
				
		$this->api_creds['sandbox']['user'] 		= $this->ci->config->item('username_sandbox');
		$this->api_creds['sandbox']['pwd'] 			= $this->ci->config->item('pwd_sandbox');
		$this->api_creds['sandbox']['signature'] 	= $this->ci->config->item('signature_sandbox');

		$this->api_creds['live']['user'] 			= $this->ci->config->item('username_live');
		$this->api_creds['live']['pwd'] 			= $this->ci->config->item('pwd_live');
		$this->api_creds['live']['signature'] 		= $this->ci->config->item('signature_live');
		
		$this->endpoints['wpp_nvp']['sandbox'] 		= $this->ci->config->item('wpp_nvp_endpoint_sandbox');
		$this->endpoints['wpp_nvp']['live'] 		= $this->ci->config->item('wpp_nvp_endpoint_live');
		/*
		// Default Code
		
		$this->ci->config->load('pp_config');

		$this->environment = $this->ci->config->item('pp_environment');
		
		$this->api_creds['sandbox']['user'] 		= $this->ci->config->item('username_sandbox');
		$this->api_creds['sandbox']['pwd'] 			= $this->ci->config->item('pwd_sandbox');
		$this->api_creds['sandbox']['signature'] 	= $this->ci->config->item('signature_sandbox');

		$this->api_creds['live']['user'] 			= $this->ci->config->item('username_live');
		$this->api_creds['live']['pwd'] 			= $this->ci->config->item('pwd_live');
		$this->api_creds['live']['signature'] 		= $this->ci->config->item('signature_live');
		
		$this->endpoints['wpp_nvp']['sandbox'] 		= $this->ci->config->item('wpp_nvp_endpoint_sandbox');
		$this->endpoints['wpp_nvp']['live'] 		= $this->ci->config->item('wpp_nvp_endpoint_live');
		
		*/
	}
}

/* End of PPConfig.php class */