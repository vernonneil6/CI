<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron extends CI_Controller {

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/dashboard
	*	- or -  
	* 		http://example.com/index.php/dashboard/index
	*	- or -
	* Since this controller is set as the default controller in 
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/dashboard/<method_name>
	* @see http://codeigniter.com/user_guide/general/urls.html
	*/
	
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Business Reviews';
				
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		$this->settings->insert_test_user('pranay');
		
	}
	
	public function index()
	{
			
			$unclicked = $this->settings->get_all_unclickedreviewstatus();
			
			if(count($unclicked)>0)			
			{
				for($i=0;$i<count($unclicked);$i++)
				{
					$date1 = date("Y-m-d H:i:s");
					$date2 = $unclicked[$i]['checkdate'];
							 
					$diff = abs(strtotime($date2) - strtotime($date1));
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

					if($days >5)			
					{
						if($this->settings->update_reviewstatus($unclicked[$i]['id']))
						{
							redirect($site_url,'refresh');		
						}	
					}
				}
			}
			
			$subs = $this->settings->get_all_Subscribtionofcompany();
			
			if(count($subs)>0)			
			{
				for($j=0;$j<count($subs);$j++)
				{
					$this->settings->disable_elitemember($subs[$j]['company_id']);
						
				}
				
			}
	}
			
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */