<?php 

class Slider extends CI_Controller
{
	function index()
	{
		$this->load->model('sliders');
		$data['titles']=$this->sliders->slide();
		$this->load->view('home',$data);
	}
}
?>