<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Catlist extends CI_Controller {





	public function index()
	{ 	
		//$this->data['header'] = $this->load->view('header',$this->data,true);
		//$this->data['footer'] = $this->load->view('footer',$this->data,true);
		$this->load->model('catlists');
		$this->load->view('catlistss');
		
	}
	
	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
