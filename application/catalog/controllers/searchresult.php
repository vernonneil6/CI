<?php
class Searchresult extends CI_Controller {

	public $paging;
	public $data;
	
	public function __construct()
  	{
		parent::__construct();
		// Your own constructor code
		$this->data['site_name'] = $this->common->get_setting_value(1);
		
		$this->data['title'] = $this->data['site_name']; 
		//include('include.php');
		//Loading Model File
		//$this->load->model('homes');
	}
	
	function index()
	{
		$this->data['keywords'] = ucfirst($this->input->get('query')).' Business in YGR';
		$this->data['description'] = 'List of '.ucfirst($this->input->get('query')).' Business in YGR Directory';
		$this->data['header']=$this->load->view('header',$this->data,true);
		$this->data['footer']=$this->load->view('footer',$this->data,true);
		$this->load->view('searchresult',$this->data);
	}
}
?>
