<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Paypal extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
		
		$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
		 {
		    $site = $regs['domain'];
		 }
		 $website = $this->common->get_site_by_domain_name('yougotrated.writerbin.com');
		 
		 if(count($website)>0)
		 {
		 	$siteid = $website[0]['id'];
		 }
		 $this->session->set_userdata('siteid',$siteid);
		 
		 $siteid = $this->session->userdata('siteid');
		
		$this->data['site_name'] = $this->common->get_sitename_byid($siteid);
		$this->data['site_url'] = $this->common->get_siteurl_byid($siteid);
		$this->data['searchword']='';
			
		//Loading Model File
		$this->load->model('complaints');
		
		$this->data['title'] = 'Payment';
		$this->data['section_title'] = 'Payment';
				
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	//Function for PayPal Return URL
	public function payment_notify()
	{
		if( array_key_exists('payment_status',$_POST) )
		{
			$this->session->set_flashdata('success','Your Transaction is successfull and Payment has been made.');
			redirect('complaint', 'refresh');
		}
		else
		{
			redirect('complaint','refresh');
		}
	}
	
	//Function for PayPal Notify URL
	public function payment_return($complaintid='',$companyid='')
	{
		if( !empty($_POST) )
		{
			if( array_key_exists('payment_status',$_POST) /*&& $_POST['payment_status'] == 'Completed'*/ )
			{
				
				$complaint=$this->complaints->get_complaint_byid($complaintid);
				// assign posted variables to local variables
				$complaintid		 = $_POST['item_number'];
				$payment_amount    	= $_POST['mc_gross'];
				$payment_currency   = $_POST['mc_currency'];
				$transactionid      = $_POST['txn_id'];
				$payment_date     	= date('Y-m-d H:i:s',strtotime($_POST['payment_date']));
				
				//Loading Model File
				$this->load->model('complaints');
				
				if( $this->complaints->insert_transaction_details($complaintid,$payment_amount,$payment_currency,$transactionid,$payment_date) )
				{
					//echo $result;

					$company=$this->complaints->get_company_byid($companyid);
					$site_name = $this->common->get_setting_value(1);
					$site_url = $this->common->get_setting_value(2);
					$site_mail = $this->common->get_setting_value(5);
					
					//Loading E-mail library
					$this->load->library('email');
					
					//Loading E-mail config file
					$this->config->load('email',TRUE);
					
					//Payment mail for Admin
					$from = $company[0]['email'];
					$subject = 'Payment Successfull for removing compliant '.$complaintid;
					$to = $site_mail;
					
					$this->email->from($from);
					$this->email->to($to);
					$this->email->subject($subject);
				
					$mailbody = 
						'<html>
							<body>
							<table cellpadding="0" cellspacing="0" width="100%" border="0">
							<tr>
								<td>Hello Admin,</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td style="padding-left:50px;">
								'.$company[0]['company'].' successfully completed payment process  for Removing Compliant ID '.$complaintid.' Below are Details.
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td>
									<table cellpadding="0" cellspacing="0" width="100%" border="0">
									<tr><td colspan="3"><h4>Details</h4></td></tr>
									<tr>
										<td width="200">Complaint ID</td>
										<td>:</td>
										<td>'.$complaintid.'</td>
									</tr>
									<tr><td colspan="3">&nbsp;</td></tr>
									<tr><td colspan="3"><h4>Payment Details</h4></td></tr>
									<tr>
										<td>Total Payment Amount</td>
										<td>:</td>
										<td>'.$payment_currency.' '.$payment_amount.'</td>
									</tr>
									<tr>
										<td>Transacion ID</td>
										<td>:</td>
										<td><b>'.$transactionid.'</b></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr><td><br/><br/></td></tr>
							<tr>
								<td>
									Kind Regards,<br/>
									'.$company[0]['company'].'
								</td>
							</tr>
							</table>
							</body>
						</html>';
					 
					//echo"<pre>";
					//print_r($mailbody);
					//die();
				
					$this->email->message($mailbody);
					
					//Sending mail to Admin
					$this->email->send();
					
					
					//Payment mail for Company
					$from = $site_mail;
					$subject = 'You have been successfully done Payment to '.$site_name.' for Removing Compliant id '.$complaintid;
					$to = $company[0]['email'];
					
					$this->email->from($from);
					$this->email->to($to);
					$this->email->subject($subject);
				
					$mailbody = 
						'<html>
							<body>
							<table cellpadding="0" cellspacing="0" width="100%" border="0">
							<tr>
								<td>Hello '.$company[0]['company'].',</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td style="padding-left:50px;">
								You have been successfully done Payment to '.$site_name.' for Removing Compliant id '.$complaintid.',<br/>
								Complaint is successfully removed. 
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td>
									<table cellpadding="0" cellspacing="0" width="100%" border="0">
									<tr><td colspan="3"><h4>Compalint Details</h4></td></tr>
									<tr>
										<td>Complaint:</td>
										<td>'.nl2br(stripslashes($complaint[0]['detail'])).'</td>
									</tr>
									<tr>
										<td>Posted On:</td>
										<td>'.date('d M, Y',strtotime($complaint[0]['complaindate'])).'</td>
									</tr>
									<tr><td colspan="3">&nbsp;</td></tr>
									<tr><td colspan="3"><h4>Payment Details</h4></td></tr>
									<tr>
										<td>Total Payment Amount:</td>
										<td>'.$payment_currency.' '.$payment_amount.'</td>
									</tr>
									<tr>
										<td>Transacion ID:</td>
										<td><b>'.$transactionid.'</b></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr><td><br/><br/></td></tr>
							<tr>
								<td>
									Kind Regards,<br/>
									'.$site_name.'
								</td>
							</tr>
							</table>
							</body>
						</html>';
					 
					//echo"<pre>";
					//print_r($mailbody);
					//die();
					
					$this->email->message($mailbody);
					
					//Sending mail to admin
					$this->email->send();
					
					$this->session->set_flashdata('success','Your Transaction is successfull and Payment has been made.');
					redirect('complaint', 'refresh');
					
				}
			}
		}
	}
	
	//Function for PayPal Cancel Return URL
	public function payment_cancel()
	{
		//echo "<pre>";
		//print_r($_POST);
		//die();
		
		if( array_key_exists('payment_status',$_POST) && $_POST['payment_status'] != 'Completed' )
		{
			$this->session->set_flashdata('error','You have not completed payment process.');
			redirect('complaint', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('error','You have not completed payment process.');
			redirect('complaint','refresh');
		}
	}
	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */