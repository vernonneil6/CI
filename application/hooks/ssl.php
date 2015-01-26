<?php

class SecureAccount
{
    var $obj;

    //--------------------------------------------------
    //SecureAccount constructor
    function SecureAccount()
    {
        $this->obj =& get_instance();
    }

    //--------------------------------------------------
    //Redirect to https if in the account area without it
    function index()
    {
        if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== 'on')
        {
            $this->obj =& get_instance();
            $this->obj->load->helper(array('url', 'http'));

            $current = current_url();
            $current = parse_url($current);

            if((stripos($current['path'], "/solution/claimbusiness/") !== false))
            {
                $current['scheme'] = 'https';

                redirect(http_build_url('', $current), 'refresh');
            }
        }
    }
}
?>
