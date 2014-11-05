<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Cron extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
	}
	
	public function index()
	{
		//get common values
		$bid_commission_rate = $this->crons->get_bidoffer_setting_value_byid(2);
		$offer_commission_rate = $this->crons->get_bidoffer_setting_value_byid(3);
		
		//get all lastest bids
		$lastest_bids = $this->crons->get_all_lastest_bids();
		
		if(count($lastest_bids)>0)
		{
			for($i=0;$i<count($lastest_bids);$i++)
			{
				$categoryid = $lastest_bids[$i]['categoryid'];
				$productid = $lastest_bids[$i]['productid'];
				$price = $lastest_bids[$i]['price'];
			        $unique_id =uniqid();
				//get all suitble offers for given bids
				$find_suitble_offers = $this->crons->find_all_suitble_offers($categoryid,$productid,$price);
				
				if(count($find_suitble_offers)>0)
				{
					//bid user
					$bidby = $lastest_bids[$i]['bidby'];
					
					//offer user
					$offerby = $find_suitble_offers[0]['offerby'];
					
					$bidid = $lastest_bids[$i]['id'];
					$offerid = $find_suitble_offers[0]['id'];
					$quantity = $lastest_bids[$i]['quantity'];

					//commissions
					$bid_commission = (($lastest_bids[$i]['price'] * $bid_commission_rate * $quantity )/100);
					$offer_commission = (($find_suitble_offers[0]['price'] * $offer_commission_rate * $quantity )/100);
					
					//total
					$price = $lastest_bids[$i]['price'] * $quantity;

					
					
					if($lastest_bids[$i]['quantity'] == $find_suitble_offers[0]['quantity'])
					{
						$transaction_quantity = $lastest_bids[$i]['quantity'];
						$this->crons->update_bid($bidid,$transaction_quantity,"Close");
						$this->crons->update_offer($offerid,$transaction_quantity,"Close");
						$this->crons->add_transaction($bidid,$bid_commission,$price,$transaction_quantity,$offerid,$offer_commission,$unique_id);
					
					}
					else
					{
						if($lastest_bids[$i]['quantity'] > $find_suitble_offers[0]['quantity'])
						{
							$transaction_quantity = $find_suitble_offers[0]['quantity'];	
						}
						else
						{
							$transaction_quantity = $lastest_bids[$i]['quantity'];
						}
						
						$this->crons->update_bid($bidid,$transaction_quantity,"Open");
						$this->crons->update_offer($offerid,$transaction_quantity,"Open");
						
						$this->crons->add_transaction($bidid,$bid_commission,$price,$transaction_quantity,$offerid,$offer_commission,$unique_id);
						
						//add history for both
						$this->crons->add_bid_history($bidid,$transaction_quantity);
						$this->crons->add_offer_history($bidid,$transaction_quantity);
					
					}
						
						$total_for_bidby = $bid_commission + $price;
						$total_for_offerby = ($price - $offer_commission);
						
						$this->crons->update_member($bidby,$total_for_bidby,"bid");
						$this->crons->update_member($offerby,$total_for_offerby,"Offer");
						
						$site_name = $this->crons->get_setting_value(1);
						$site_url = $this->crons->get_setting_value(2);
						$site_email = $this->crons->get_setting_value(5);
						
						$cat_name = $this->crons->get_category($categoryid);
						$product_name = $this->crons->get_product($productid);
						
						if(count($cat_name)>0)
						{
							$category = $cat_name[0]['category'];
						}
						else
						{
							$category = "";
						}
						
						if(count($product_name)>0)
						{
							$product = $product_name[0]['product_name'];
						}
						else
						{
							$product = "";
						}
						
						//get user
						$biduser = $this->crons->get_member($bidby);
						
						if(count($biduser)>0)
						{
						
						//user detail
						$firstname = $biduser[0]['firstname'];
						$lastname = $biduser[0]['lastname'];
						$emailid = $biduser[0]['email'];	
						
						$mail = $this->crons->get_email_byid(4);
						
						$subject = $mail[0]['subject'];
						$mailformat = $mail[0]['emailformat'];
						
						//Loading E-mail library
						$this->load->library('email');
								
						//Loading E-mail config file
						$this->config->load('email',TRUE);
						$this->cnfemail = $this->config->item('email');
									
						$this->email->initialize($this->cnfemail);
						$this->email->from($site_email,$site_name);
						$this->email->to($emailid);	
						$this->email->subject($this->common->get_setting_value(1)." : ".$subject);
						
						$mail_body = str_replace("%quantity%",ucfirst($quantity),str_replace("%price%",($price),str_replace("%firstname%",ucfirst($firstname),str_replace("%lastname%",ucfirst($lastname),str_replace("%email%",$emailid,str_replace("%category%",$category,str_replace("%productid%",$productid,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))))))));
					
						$this->email->message($mail_body);
						$this->email->send();
					}
					
						//get user
						$offeruser = $this->crons->get_member($offerby);
						
						if(count($offeruser)>0)
						{
							
						//user detail
						$firstname = $offeruser[0]['firstname'];
						$lastname = $offeruser[0]['lastname'];
						$emailid = $offeruser[0]['email'];	
						
						$mail = $this->crons->get_email_byid(5);
						
						$subject = $mail[0]['subject'];
						$mailformat = $mail[0]['emailformat'];
						
						//Loading E-mail library
						$this->load->library('email');
								
						//Loading E-mail config file
						$this->config->load('email',TRUE);
						$this->cnfemail = $this->config->item('email');
									
						$this->email->initialize($this->cnfemail);
						$this->email->from($site_email,$site_name);
						$this->email->to($emailid);	
						$this->email->subject($this->common->get_setting_value(1)." : ".$subject);
						
						$mail_body = str_replace("%quantity%",ucfirst($quantity),str_replace("%price%",($price),str_replace("%firstname%",ucfirst($firstname),str_replace("%lastname%",ucfirst($lastname),str_replace("%email%",$emailid,str_replace("%category%",$category,str_replace("%productid%",$productid,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))))))));
					
						$this->email->message($mail_body);
						$this->email->send();
					
						$get_bids = $this->crons->get_bids();
						if(count($get_bids)>0)
						{
							for($j=0;$j<count($get_bids);$j++)
							{
								$this->crons->update_bid($get_bids[$j]['id'],$get_bids[$j]['transaction_quantity'],"Close");
						
							}
				
						}
						
						$get_offers = $this->crons->get_offers();
						if(count($get_offers)>0)
						{
							for($j=0;$j<count($get_offers);$j++)
							{
							$this->crons->update_offer($get_offers[$j]['id'],$get_offers[$j]['transaction_quantity'],"Close");
							}
						}
					}
				}	
			}
		}
	}
	
	
}

/* End of file cron.php */
/* Location: ./application/controllers/welcome.php */
