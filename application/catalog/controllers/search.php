<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
         $this->load->model('searchs');
	
    }

    public function autocomplete()
    {
        $this->data['name'] = $this->input->get('query');
        $city = 'New York';//$this->input->post('ccity');
        $this->load->view('customsearch',$this->data);
    }
}
/* End of file search.php */
/* File location: application/controllers */
