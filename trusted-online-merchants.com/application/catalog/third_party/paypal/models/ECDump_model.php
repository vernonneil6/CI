<?php

class ECDump_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function working()
    {
    	/*
    	$query = $this->db->get('ec_log_dump');

		foreach ($query->result() as $row)
		{
		    echo $row->set_ec_url;
		    echo "<br />";
		}
		*/

    }
}

// end of file application/third_party/paypal/models/ECDump_model.php