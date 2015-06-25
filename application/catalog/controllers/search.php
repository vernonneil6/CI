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
        $search_data = $this->input->post('search_data');
        $query = $this->searchs->get_autocomplete($search_data);
       //print_r($query);
       if($query==''){ $val[]='No result'; }
       
        foreach ($query as $row => $result){
         
			$value=$result->category;
			$val[]=$value;
          
        }
		echo  json_encode($val);
        die();
       // $this->load->view('header', $data);
    }
}
/* End of file search.php */
/* File location: application/controllers */
