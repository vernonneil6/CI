<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class PayPalLog{

	public $ci = "";
	public $url = "";
	public $request = array();
	public $response = array();
	public $acct_hide = "************";
	public $start_time = "";
	public $end_time = "";
	public $final_time = "";

    public function __construct()
    {
    	$this->ci =& get_instance();
    	$this->ci->config->load('pp_config');
    	//$this->ci->load->model('ECDump_model');
    	//$this->ci->load->library('curl');
    	//$this->ci->config->item('pp_environment')
    }

    public function log_start()
    {
    	$this->start_time = time();
    	//echo "<br />Start Time: ".$this->start_time."<br />";
    	return $this;
    }

    public function log_end()
    {
    	$this->end_time = time();
    	//echo "<br />End Time: ".$this->end_time."<br />";
    	$this->final_time = $this->end_time - $this->start_time;
    	//echo "<br />Final Time: ".$this->final_time."<br />";
    	return $this;
    }

    public function log_url($url)
    {
    	$this->url = $url;
    	return $this;
    }

    public function log_request($request)
    {
    	$this->request = $request;
    	return $this;
    }

    public function log_response($response)
    {
    	$this->response = $response;
    	return $this;
    }

    public function sanitize_request()
    {
    	if(isset($this->request['USER'])){ unset($this->request['USER']); }
    	if(isset($this->request['PWD'])){ unset($this->request['PWD']); }
    	if(isset($this->request['SIGNATURE'])){ unset($this->request['SIGNATURE']); }
    	if(isset($this->request['ACCT'])){ 
	    	$this->request['ACCT'] = $this->ci->encrypt->sha1($this->request['ACCT']); 
	    }
	    if(isset($this->request['CVV2'])){ 
	    	$this->request['CVV2'] = $this->ci->encrypt->sha1($this->request['CVV2']); 
	    }
	    return $this;
    }

    public function sanitize_response()
    {
    	return $this;
    }

    public function insert()
    {
    	if(isset($this->request['METHOD']))
    	{
    		$insert_data = array(
		    	"method" 		=> $this->request['METHOD'],
		    	"url" 			=> $this->url,
		    	"request" 		=> serialize($this->request),
		    	"response" 		=> serialize($this->response),
		    	"response_time" => $this->final_time
		    );
		    $this->ci->db->insert($this->ci->config->item('pp_api_log_table'), $insert_data);
    	}
	    return $this;
    }

    public function insert_set_ec()
    {
    	$insert_data = array(
	    	"set_ec_url"		=> $this->url,
	    	"set_ec_request" 	=> serialize($this->request),
	    	"set_ec_response" 	=> serialize($this->response),
	    	"token" 			=> $this->response['TOKEN'],
	    	"set_response_time" => $this->final_time
	    );
	    $this->ci->db->insert($this->ci->config->item('pp_api_ec_log_table'), $insert_data);
	    return $this;
    }

    public function insert_get_ec()
    {
    	$update_data = array(
	    	"get_ec_url"		=> $this->url,
	    	"get_ec_request" 	=> serialize($this->request),
	    	"get_ec_response" 	=> serialize($this->response),
	    	"get_ec_response_time" => $this->final_time
	    );
	    $this->ci->db->
	    	where('token', $this->request['TOKEN'])->
	    	update($this->ci->config->item('pp_api_ec_log_table'), $update_data);

	    return $this;
    }

    public function insert_do_ec()
    {
    	$update_data = array(
            "do_ec_url"        => $this->url,
            "do_ec_request"    => serialize($this->request),
            "do_ec_response"   => serialize($this->response),
            "do_ec_response_time" => $this->final_time
        );
        $this->ci->db->
            where('token', $this->request['TOKEN'])->
            update($this->ci->config->item('pp_api_ec_log_table'), $update_data);

        return $this;
    }

    public function execute()
    {
    	$this->sanitize_request()->sanitize_response();

    	$method = $this->request['METHOD'];
    	if($method == "SetExpressCheckout")
    	{
    		$this->insert_set_ec();
    	}
    	else if($method == "GetExpressCheckoutDetails")
    	{
    		$this->insert_get_ec();
    	}
    	else if($method == "DoExpressCheckoutPayment")
    	{
    		$this->insert_do_ec();
    	}
    	else
    	{
    		$this->insert();
    	}
    	return true;
    }

    
}

/* End of file third_party/paypal/libraries/PayPalLog.php */