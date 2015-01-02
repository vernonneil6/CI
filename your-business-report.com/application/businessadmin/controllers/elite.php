<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elite extends CI_Controller {

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
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	//If no session, redirect to login page
			//echo site_url();die();
	  	  	redirect('adminlogin', 'refresh');
		}
		
		//Loading Helper File
	  	$this->load->helper('form');
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Elite Membership';
		$this->data['section_title'] = 'Elite Membership';
		
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		$websites = $this->settings->get_all_urls();
		
		if( count($websites) > 0 )
				{
					$this->data['selsite']['zero'] = 'Select Site';
					$this->data['selsite']['all'] = 'All Websites';
					for($c=0;$c<count($websites);$c++)
					{
						$this->data['selsite'][stripslashes($websites[$c]['id'])] = ucwords(stripslashes($websites[$c]['title']));
					}
				}
				else
				{
					$this->data['selsite']['all'] = 'All Websites';
					$this->data['selsite'] = array();
				}
		
		//Load heading and save in variable
		$this->data['heading'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$id = $this->session->userdata['youg_admin']['id'];
			$this->data['elite'] = $this->settings->get_elitecompany_byid($id);
			
			//echo "<pre>";
			//print_r($this->data['elite']);
			//die();
			//Loading View File
			$this->load->view('elite',$this->data);
	  	}
	}

	//Function For Change Status to "Disable"
	public function disable($id='',$companyid='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0 && $companyid!='' && $companyid!=0)
			{
					if( $this->settings->cancel_elitemembership_bycompnayid($id,$companyid) )
					{
							$this->session->set_flashdata('success', 'Membership status disabled successfully.');
							redirect('dashboard/logout', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in updating Membership status. Try later!');
						redirect('elite', 'refresh');
					}
			}
		else
			{
				redirect('elite', 'refresh');
			}
 		}
	}
	
	public function cancel_subscribtion()
	{
		
		$this->load->model('settings');
	if( $this->session->userdata['youg_admin'] )
	  	{
			$id = $this->session->userdata['youg_admin']['id'];
			$this->data['elite'] = $this->settings->get_subscribtion_bycompanyid($id);
			
			//Loading View File
			$this->load->view('elite',$this->data);
	  	}}
		
		//Function For Change Status to "Disable"
	public function cancel($subscribtionid='',$companyid='')
	{
	 
	  if($this->session->userdata['youg_admin'])
	  {
			if($subscribtionid!='' && $companyid!='')
			{
				include('authorize/data.php');
				include('authorize/authnetfunction.php');
		
				$subscriptionId = $subscribtionid;
				//build xml to post
$content =
        "<?xml version=\"1.0\" encoding=\"utf-8\"?>".
        "<ARBCancelSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">".
        "<merchantAuthentication>".
        "<name>" . $loginname . "</name>".
        "<transactionKey>" . $transactionkey . "</transactionKey>".
        "</merchantAuthentication>" .
        "<subscriptionId>" . $subscriptionId . "</subscriptionId>".
        "</ARBCancelSubscriptionRequest>";

//send the xml via curl
$response = send_request_via_curl($host,$path,$content);

//if the connection and send worked $response holds the return from Authorize.net
if ($response)
{
	list ($resultCode, $code, $text, $subscriptionId) =parse_return($response);
	
	 " Response Code: $resultCode <br>";
	 " Response Reason Code: $code<br>";
	 " Response Text: $text<br>";
	 " Subscription Id: $subscriptionId <br><br>";
	
}
else
{
	$this->session->set_flashdata('success', $subscriptionId);
	redirect('elite/cancel_subscribtion', 'refresh');
}
if($text!='I00001')
{
	$this->session->set_flashdata('success', $subscriptionId);
	redirect('elite/cancel_subscribtion', 'refresh');
}else{
if( $this->settings->cancel_elitemembership_bycompnayid1($companyid) )
					{
						$this->session->set_flashdata('success', 'Membership status disabled successfully.');
						redirect('dashboard/logout', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in updating Membership status. Try later!');
						redirect('elite', 'refresh');
					}
}
			}
		else
			{
				redirect('elite', 'refresh');
			}
 		}
	}
	
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */