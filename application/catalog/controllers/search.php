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
        $name = $this->input->post('name');
        $city = $this->input->post('ccity');
        $query = $this->searchs->get_autocompletes($name,$city);
		echo  $query;
        die();
       
    }
}
/* End of file search.php */
/* File location: application/controllers */
