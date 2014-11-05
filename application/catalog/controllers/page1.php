<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Page1 extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		
		if($this->uri->segment(2)!='')
		{
			$uniquename = $this->uri->segment(2);
			if($uniquename!='')
			{
				$page = $this->common->get_page_by_uniquename($uniquename);
			}
		else
		{
			redirect(site_url(),'refresh');	
		}
		
		if( count($page) > 0 )
		{
			$this->data['title'] = ($page[0]['title']);
		}
		}
		include('include.php');
	}
	
	public function my()
	{
	$this->load->library('email');
$config['protocol'] = "smtp";
$config['smtp_host'] = "ssl://smtp.gmail.com";
$config['smtp_port'] = "465";
$config['smtp_user'] = ""; 
$config['smtp_pass'] = "";
$config['charset'] = "utf-8";
$config['mailtype'] = "html";
$config['newline'] = "\r\n";

$this->email->initialize($config);

$this->email->from('moulik2007dec@gmail.com', 'moulik');
$list = array('pranay9803@gmail.com');
$this->email->to($list);
//$this->email->reply_to('no-reply@gmail.com', '');
$this->email->subject('This is an email test');
$this->email->message('It is working. Great!');
$this->email->send();
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */