<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Checkcron extends CI_Controller {
	public $data;
	
	public function cron()
	{
		$checkdate=date('Y-m-d');
		$query=$this->db->select('*')
						->from('youg_subscription as s')
						->join('youg_elite as e','e.company_id = s.company_id','left')
						->where("(`s`.`transactionstatus` = '0' and `s`.`company_id` = '9041051') OR 
						(`e`.`cancel_flag`='1')")
						->like('s.expires',$checkdate)
						->get()
			            ->result_array();
		foreach($query as $con){
			//echo 'http://www.yougotrated.com/affiliates/sale/amount/' . trim($con['amount']) . '/trans_id/' . trim($con['auth_transreponse_key']) . '/tracking_code/' . $con['jamcode']; die;
			if(!empty($con['jamcode'])){
					$getdata = file_get_contents('http://www.yougotrated.com/affiliates/sale/amount/' . trim($con['amount']) . '/trans_id/' . trim($con['auth_transreponse_key'].'adfa') . '/tracking_code/' . $con['jamcode']);
				} die('success');
		}
	}
}
