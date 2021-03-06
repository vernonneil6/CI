<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Report extends CI_Controller {

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
	
	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   redirect('adminlogin', 'refresh');
		}
		
		$this->load->model('reports');
	
		require_once('../application/admincp/Classes/PHPExcel.php');
				
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Reports';
		$this->data['section_title'] = 'Reports';
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		$websites = $this->settings->get_all_urls();
		
		if( count($websites) > 0 )
				{
					$this->data['selsite']['zero'] = 'Select Site';
					for($c=0;$c<count($websites);$c++)
					{
						$this->data['selsite'][stripslashes($websites[$c]['id'])] = ucwords(stripslashes($websites[$c]['title']));
					}
				}
				else
				{
					$this->data['selsite'] = array();
				}
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		$this->load->model('reports');
		if( $this->session->userdata['youg_admin'] )
	  	{
			
			//Addingg Setting Result to variable
			//Loading View File
			$this->data['allsubbroker']=$this->reports->get_subbrokerdetails();  
			$this->load->view('report',$this->data);
	  	}
		else
		{
			redirect('adminlogin','refresh');
		}
	}
	
	public function csv($type='')
    {
        $site_url = $this->settings->get_setting_value(2);
		if( $this->session->userdata['youg_admin'] )
        {
				if($type!='')
				{
					if($type=='allenable' || $type=='alldisable' || $type=='allelite' || $type=='allenablewithcode' || $type=='alldisablewithcode' || $type=='callcenter' || $type=='removedreviews' || $type=='removedcomplaints' || $type=='subbrokerdetails')
					{
						if($type=='allenable'){
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
							 ->setLastModifiedBy("YouGotRated Admin")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Business");
							 
			$objPHPExcel->getActiveSheet()->setTitle('Report');
			
			$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Address')	
									->setCellValue('C1', 'City')
									->setCellValue('D1', 'State')
									->setCellValue('E1', 'Zip')
									->setCellValue('F1', 'Business Phone')
									->setCellValue('G1', 'Category')
									->setCellValue('H1', 'Website')
									->setCellValue('I1', 'Contact Name')
									->setCellValue('J1', 'Contact Phone')
									->setCellValue('K1', 'Contact Email')
									->setCellValue('L1', 'Sub Broker')
									->setCellValue('M1', 'Marketer')
									->setCellValue('N1', 'Agent')
									->setCellValue('O1', 'Acquisition Type')
									->setCellValue('P1', 'Signup Date')
									->setCellValue('Q1', 'Cancel Date')
									->setCellValue('R1', 'Membership status:')
									->setCellValue('S1', 'Months Active')
									->setCellValue('T1', 'Monthly Rate')
									->setCellValue('U1', 'Discount Code')
									->setCellValue('V1', 'Notes');
									
															  
			$items = $this->reports->get_all_enabledmembers();
			
			$row=2;
			foreach($items as $row_data)
			{
				$col = 0;	
				foreach($row_data as $key=>$value)
				{
					if(!$value)
					$value='-';
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
				}
				$row++;
			}
			
			$objPHPExcel->setActiveSheetIndex(0);
		
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$file=time().'.xls';
			$objWriter->save('../uploads/my/'.$file);
			$this->load->helper('download');
			
			$file1 = file_get_contents($site_url.'uploads/my/'.$file);
			$name = 'Report-of-elite-members-enabled.xls';

			force_download($name, $file1); 
			
			}
			
			
					if($type=='alldisable'){
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
							 ->setLastModifiedBy("YouGotRated Admin")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Business");
							 
			$objPHPExcel->getActiveSheet()->setTitle('Report');
			
			$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Address')	
									->setCellValue('C1', 'City')
									->setCellValue('D1', 'State')
									->setCellValue('E1', 'Zip')
									->setCellValue('F1', 'Business Phone')
									->setCellValue('G1', 'Category')
									->setCellValue('H1', 'Website')
									->setCellValue('I1', 'Contact Name')
									->setCellValue('J1', 'Contact Phone')
									->setCellValue('K1', 'Contact Email')
									->setCellValue('L1', 'Sub Broker')
									->setCellValue('M1', 'Marketer')
									->setCellValue('N1', 'Agent')
									->setCellValue('O1', 'Acquisition Type')
									->setCellValue('P1', 'Signup Date')
									->setCellValue('Q1', 'Cancel Date')
									->setCellValue('R1', 'Membership status:')
									->setCellValue('S1', 'Months Active')
									->setCellValue('T1', 'Monthly Rate')
									->setCellValue('U1', 'Discount Code')
									->setCellValue('V1', 'Notes');
									
															  
			$items = $this->reports->get_all_disabledmembers();
			
			$row=2;
			foreach($items as $row_data)
			{
				$col = 0;	
				foreach($row_data as $key=>$value)
				{
					if(!$value)
					$value='-';
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
				}
				$row++;
			}
				
			$objPHPExcel->setActiveSheetIndex(0);
		
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$file=time().'.xls';
			$objWriter->save('../uploads/my/'.$file);
			$this->load->helper('download');
			
			$file1 = file_get_contents($site_url.'uploads/my/'.$file);
			$name = 'Report-of-elite-members-disabled.xls';

			force_download($name, $file1); 
			
			}
			
						if($type=='allelite'){
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
							 ->setLastModifiedBy("YouGotRated Admin")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Business");
							 
			$objPHPExcel->getActiveSheet()->setTitle('Report');
			
			$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()
										->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Address')	
									->setCellValue('C1', 'City')
									->setCellValue('D1', 'State')
									->setCellValue('E1', 'Zip')
									->setCellValue('F1', 'Business Phone')
									->setCellValue('G1', 'Category')
									->setCellValue('H1', 'Website')
									->setCellValue('I1', 'Contact Name')
									->setCellValue('J1', 'Contact Phone')
									->setCellValue('K1', 'Contact Email')
									->setCellValue('L1', 'Sub Broker')
									->setCellValue('M1', 'Marketer')
									->setCellValue('N1', 'Agent')
									->setCellValue('O1', 'Acquisition Type')
									->setCellValue('P1', 'Signup Date')
									->setCellValue('Q1', 'Cancel Date')
									->setCellValue('R1', 'Membership status:')
									->setCellValue('S1', 'Months Active')
									->setCellValue('T1', 'Monthly Rate')
									->setCellValue('U1', 'Discount Code')
									->setCellValue('V1', 'Notes');
										
																  
			$items = $this->reports->get_all_elitemembers();
			
			$row=2;
			foreach($items as $row_data)
			{
				$col = 0;	
				foreach($row_data as $key=>$value)
				{
					if(!$value)
					$value='-';
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
				}
				$row++;
			}
				
			$objPHPExcel->setActiveSheetIndex(0);
		
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$file=time().'.xls';
			$objWriter->save('../uploads/my/'.$file);
			$this->load->helper('download');
			
			$file1 = file_get_contents($site_url.'uploads/my/'.$file);
			$name = 'Report-of-elite-members.xls';

			force_download($name, $file1); 
			
			}
						
						if($type=='allenablewithcode'){
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
							 ->setLastModifiedBy("YouGotRated Admin")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Business");
							 
			$objPHPExcel->getActiveSheet()->setTitle('Report');
			
			$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Address')	
									->setCellValue('C1', 'City')
									->setCellValue('D1', 'State')
									->setCellValue('E1', 'Zip')
									->setCellValue('F1', 'Business Phone')
									->setCellValue('G1', 'Category')
									->setCellValue('H1', 'Website')
									->setCellValue('I1', 'Contact Name')
									->setCellValue('J1', 'Contact Phone')
									->setCellValue('K1', 'Contact Email')
									->setCellValue('L1', 'Sub Broker')
									->setCellValue('M1', 'Marketer')
									->setCellValue('N1', 'Agent')
									->setCellValue('O1', 'Acquisition Type')
									->setCellValue('P1', 'Signup Date')
									->setCellValue('Q1', 'Cancel Date')
									->setCellValue('R1', 'Membership status:')
									->setCellValue('S1', 'Months Active')
									->setCellValue('T1', 'Monthly Rate')
									->setCellValue('U1', 'Discount Code')
									->setCellValue('V1', 'Notes');
																  
			$items = $this->reports->get_all_enabledmemberswithcode();
			
			$row=2;
			foreach($items as $row_data)
			{
				$col = 0;	
				foreach($row_data as $key=>$value)
				{
					if(!$value)
					$value='-';
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
				}
				$row++;
			}
				
			$objPHPExcel->setActiveSheetIndex(0);
		
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$file=time().'.xls';
			$objWriter->save('../uploads/my/'.$file);
			$this->load->helper('download');
			
			$file1 = file_get_contents($site_url.'uploads/my/'.$file);
			$name = 'Report-of-elite-members.xls';

			force_download($name, $file1); 
			
			}
			
						if($type=='alldisablewithcode'){
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
							 ->setLastModifiedBy("YouGotRated Admin")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Business");
							 
			$objPHPExcel->getActiveSheet()->setTitle('Report');
			
			$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Address')	
									->setCellValue('C1', 'City')
									->setCellValue('D1', 'State')
									->setCellValue('E1', 'Zip')
									->setCellValue('F1', 'Business Phone')
									->setCellValue('G1', 'Category')
									->setCellValue('H1', 'Website')
									->setCellValue('I1', 'Contact Name')
									->setCellValue('J1', 'Contact Phone')
									->setCellValue('K1', 'Contact Email')
									->setCellValue('L1', 'Sub Broker')
									->setCellValue('M1', 'Marketer')
									->setCellValue('N1', 'Agent')
									->setCellValue('O1', 'Acquisition Type')
									->setCellValue('P1', 'Signup Date')
									->setCellValue('Q1', 'Cancel Date')
									->setCellValue('R1', 'Membership status:')
									->setCellValue('S1', 'Months Active')
									->setCellValue('T1', 'Monthly Rate')
									->setCellValue('U1', 'Discount Code')
									->setCellValue('V1', 'Notes');
																  
			$items = $this->reports->get_all_disabledmemberswithcode();
			
			$row=2;
			foreach($items as $row_data)
			{
				$col = 0;	
				foreach($row_data as $key=>$value)
				{
					if(!$value)
					$value='-';
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
				}
				$row++;
			}
				
			$objPHPExcel->setActiveSheetIndex(0);
		
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$file=time().'.xls';
			$objWriter->save('../uploads/my/'.$file);
			$this->load->helper('download');
			
			$file1 = file_get_contents($site_url.'uploads/my/'.$file);
			$name = 'Report-of-elite-members.xls';

			force_download($name, $file1); 
			
			}
		
						if($type=='callcenter'){
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
							 ->setLastModifiedBy("YouGotRated Admin")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Business");
							 
			$objPHPExcel->getActiveSheet()->setTitle('Report');
			
			$objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()
								->setCellValue('A1', 'Email')
								->setCellValue('B1', 'Name')
								->setCellValue('C1', 'Address')
								->setCellValue('D1', 'Payment Transaction ID')
								->setCellValue('E1', 'Payment Method')
								->setCellValue('F1', 'Membership status')
								->setCellValue('G1', 'Disabled On');
																  
			$items = $this->reports->get_all_callcenter_elite();
			$row=2;
			foreach($items as $row_data)
			{
				$col = 0;	
				foreach($row_data as $key=>$value)
				{
					if(!$value)
					$value='-';
					if($key=='id')
					{
						$value='Paypal';
					}
					
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
				}
				$row++;
			}
				
			$objPHPExcel->setActiveSheetIndex(0);
		
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$file=time().'.xls';
			$objWriter->save('../uploads/my/'.$file);
			$this->load->helper('download');
			
			$file1 = file_get_contents($site_url.'uploads/my/'.$file);
			$name = 'Report-of-elite-members-registered-from-callcenter.xls';

			force_download($name, $file1); 
			
			}
		
						if($type=='removedreviews'){
							
												
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
							 ->setLastModifiedBy("YouGotRated Admin")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Business");
							 
			$objPHPExcel->getActiveSheet()->setTitle('Report');
			
			$objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()
								->setCellValue('A1', 'Username')
								->setCellValue('B1', 'Email')
								->setCellValue('C1', 'Name')
								->setCellValue('D1', 'Address')
								->setCellValue('E1', 'Created On')
								->setCellValue('F1', 'Removed On')
								->setCellValue('G1', 'Company Name')
								->setCellValue('H1', 'Company Address');
								
								
														  
			$items = $this->reports->get_all_removed_reviews();
			
			$row=2;
			foreach($items as $row_data)
			{
				$col = 0;	
				foreach($row_data as $key=>$value)
				{
					if(!$value)
					$value='-';
					if($value=='0000-00-00')
					{
						$value='NA';
					}
					
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
				}
				$row++;
			}
				
			$objPHPExcel->setActiveSheetIndex(0);
		
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$file=time().'.xls';
			$objWriter->save('../uploads/my/'.$file);
			$this->load->helper('download');
			
			$file1 = file_get_contents($site_url.'uploads/my/'.$file);
			$name = 'Report-of-all-removed-reviews.xls';
			force_download($name, $file1); 
			}
			
						if($type=='removedcomplaints'){
							
												
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
							 ->setLastModifiedBy("YouGotRated Admin")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Business");
							 
			$objPHPExcel->getActiveSheet()->setTitle('Report');
			
			$objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()
								->setCellValue('A1', 'Username')
								->setCellValue('B1', 'Email')
								->setCellValue('C1', 'Name')
								->setCellValue('D1', 'Address')
								->setCellValue('E1', 'Created On')
								->setCellValue('F1', 'Removed On')
								->setCellValue('G1', 'Company Name')
								->setCellValue('H1', 'Company Address');
								
								
														  
			$items = $this->reports->get_all_removed_complaints();
			
			$row=2;
			foreach($items as $row_data)
			{
				$col = 0;	
				foreach($row_data as $key=>$value)
				{
					if(!$value)
					$value='-';
					if($value=='0000-00-00 00:00:00')
					{
						$value='NA';
					}
					
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
				}
				$row++;
			}
				
			$objPHPExcel->setActiveSheetIndex(0);
		
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$file=time().'.xls';
			$objWriter->save('../uploads/my/'.$file);
			$this->load->helper('download');
			
			$file1 = file_get_contents($site_url.'uploads/my/'.$file);
			$name = 'Report-of-all-removed-complaints.xls';
			force_download($name, $file1); 
			}
						
					}
					else
					{
						redirect('report','refresh');	
					}
				}
				else
				{
					redirect('report','refresh');	
				}
		}
		else
		{
			redirect('adminlogin','refresh');
		}
    }
    public function subbrokerdetails($id)
    {
		$type=$this->uri->segment(4);
		$site_url = $this->settings->get_setting_value(2);
		if( $this->session->userdata['youg_admin'] )
        {		
		   	
					$objPHPExcel = new PHPExcel();
					$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
					 ->setLastModifiedBy("YouGotRated Admin")
					 ->setTitle("Office 2007 XLSX Test Document")
					 ->setSubject("Office 2007 XLSX Test Document")
					 ->setDescription("")
					 ->setKeywords("office 2007 openxml php")
					 ->setCategory("Business");
					 
					$objPHPExcel->getActiveSheet()->setTitle('Report');

					$objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getFont()->setBold(true);

					$objPHPExcel->getActiveSheet()
							->setCellValue('A1', 'Elite Member First/Lastname')							
							->setCellValue('B1', 'Elite Company Name')							
							->setCellValue('C1', 'Elite Mem Phone')	
							->setCellValue('D1', 'Elite Mem Email')	
							->setCellValue('E1', 'Date of Signup')	
							->setCellValue('F1', 'SubBroker Name')	
							->setCellValue('G1', 'Marketer Name')	
							->setCellValue('H1', 'Agent Name')	
							->setCellValue('I1', 'Renew Date')	
							->setCellValue('J1', 'Date Last CC Charge Occurred')	
							->setCellValue('K1', 'Status')	
							->setCellValue('L1', 'Number of Payments Made')
							->setCellValue('M1', 'ID#');	
							
				
					$items = $this->reports->new_subbrokerdetails($id,$type);
					
					$row=2;
					foreach($items as $row_data)
					{
						$col = 0;	
						foreach($row_data as $key=>$value)
						{
							if(!$value)
							$value='-';
							if($value=='0000-00-00 00:00:00')
							{
								$value='NA';
							}
							
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
							$col++;
						}
						$row++;
					}
                   
					$objPHPExcel->setActiveSheetIndex(0);
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
					$file=time().'.xls';
					$objWriter->save('../uploads/my/'.$file);
					$this->load->helper('download');

					$file1 = file_get_contents($site_url.'uploads/my/'.$file);
					$name = 'Report-of-subbroker-details.xls';

					force_download($name, $file1); 
	    } 
			
	}
   	public function signupdetailss()
    {
		$from= $_GET['fromdates'];
		$end=$_GET['todates'];
		$mid = ($_GET['mid']) ? $_GET['mid'] : '';
		$from= ($from!='') ? date('Y-m-d', strtotime($from)) : '';
		$end= ($end!='') ? date('Y-m-d', strtotime($end)) : $from;
		$type =($_GET['type']) ? $_GET['type'] : '';
		$site_url = $this->settings->get_setting_value(2);
		if( $this->session->userdata['youg_admin'] )
        {			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
					 ->setLastModifiedBy("YouGotRated Admin")
					 ->setTitle("Office 2007 XLSX Test Document")
					 ->setSubject("Office 2007 XLSX Test Document")
					 ->setDescription("")
					 ->setKeywords("office 2007 openxml php")
					 ->setCategory("Business");
					 
			$objPHPExcel->getActiveSheet()->setTitle('Report');

			$objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()
							->setCellValue('A1', 'Elite Member First/Lastname')							
							->setCellValue('B1', 'Elite Company Name')							
							->setCellValue('C1', 'Elite Mem Phone')	
							->setCellValue('D1', 'Elite Mem Email')	
							->setCellValue('E1', 'Date of Signup')	
							->setCellValue('F1', 'SubBroker Name')	
							->setCellValue('G1', 'Marketer Name')	
							->setCellValue('H1', 'Agent Name')	
							->setCellValue('I1', 'Renew Date')	
							->setCellValue('J1', 'Date Last CC Charge Occurred')	
							->setCellValue('K1', 'Status')	
							->setCellValue('L1', 'Number of Payments Made')
							->setCellValue('M1', 'ID#');		
														  
			$items = $this->reports->signbtndate($from,$end,$mid,$type);
			$row=2;
			foreach($items as $row_data)
			{
				$col = 0;	
				foreach($row_data as $key=>$value)
				{
					if(!$value)
					$value='-';
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
				}
				$row++;
			}
                    
			$objPHPExcel->setActiveSheetIndex(0);
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$file=time().'.xls';
			$objWriter->save('../uploads/my/'.$file);
			$this->load->helper('download');

			$file1 = file_get_contents($site_url.'uploads/my/'.$file);
			$name = 'Report-of-signup-details.xls';

			force_download($name, $file1); 
		
	    } 
		
	}
	public function elitereport_csv()
	{
		$site_url = $this->settings->get_setting_value(2);
		if( $this->session->userdata['youg_admin'] )
        {		
		
					$objPHPExcel = new PHPExcel();
					$objPHPExcel->getProperties()->setCreator("YouGotRated Admin")
					 ->setLastModifiedBy("YouGotRated Admin")
					 ->setTitle("Office 2007 XLSX Test Document")
					 ->setSubject("Office 2007 XLSX Test Document")
					 ->setDescription("")
					 ->setKeywords("office 2007 openxml php")
					 ->setCategory("Business");
					 
					$objPHPExcel->getActiveSheet()->setTitle('Report');
					$objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getFont()->setBold(true);

					$objPHPExcel->getActiveSheet()
							->setCellValue('A1', 'Elite Member First/Lastname')							
							->setCellValue('B1', 'Elite Company Name')							
							->setCellValue('C1', 'Elite Mem Phone')	
							->setCellValue('D1', 'Elite Mem Email')	
							->setCellValue('E1', 'Date of Signup')	
							->setCellValue('F1', 'SubBroker Name')	
							->setCellValue('G1', 'Marketer Name')	
							->setCellValue('H1', 'Agent Name')	
							->setCellValue('I1', 'Renew Date')	
							->setCellValue('J1', 'Date Last CC Charge Occurred')	
							->setCellValue('K1', 'Status')	
							->setCellValue('L1', 'Number of Payments Made')
							->setCellValue('M1', 'ID#');		
														  
					$items = $this->reports->total_elite();
					$row=2;
					foreach($items as $row_data)
					{
					
					$col = 0;	
						foreach($row_data as $key=>$value)
						{
							if(!$value)
							$value='-';
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
							$col++;
						}
					$row++;
			    	}
                    
					$objPHPExcel->setActiveSheetIndex(0);
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
					$file=time().'.xls';
					$objWriter->save('../uploads/my/'.$file);
					$this->load->helper('download');

					$file1 = file_get_contents($site_url.'uploads/my/'.$file);
					$name = 'Report-of-signup-details.xls';

					force_download($name, $file1); 
		
	    } 
		
		
		
	}

	public function marketer_list($subid)
	{
		
		$data['mlist'] = $this->reports->get_marketerdetails($subid);  
		$menu.='<option value="all">Select marketer</option>';
		foreach($data['mlist'] as $list){
			$menu.="<option value=".$list['id'].">".ucfirst($list['name'])."</option>";
		}
		print_r($menu);
        
	}	
	public function agent_list($mid)
	{
		$data['alist'] = $this->reports->get_agentdetails($mid);  
		$menus.='<option value="all">Select agent</option>';
	    foreach($data['alist'] as $lists){
			$menus.="<option value=".$lists['id'].">".ucfirst($lists['name'])."</option>";
		}	
		print_r($menus);
	}
	public function viewlist($mid)
	{
		$data['alist'] = $this->reports->get_agentdetails($mid);  
		$menus.='<option value="all">Select agent</option>';
	    foreach($data['alist'] as $lists){
			$menus.="<option value=".$lists['id'].">".ucfirst($lists['name'])."</option>";
		}	
		print_r($menus);
	}
	public function reportsearch()
	{   
		$this->data['allsubbroker']=$this->reports->get_subbrokerdetails();  
		$this->data['sub']= $this->input->post('subbroker');
		$this->data['mark']= $this->input->post('marketer');
		$this->data['agent']= $this->input->post('agent');
		$this->data['fromdate']= $this->input->post('fromdate');
		$this->data['enddate']= $this->input->post('enddate');
		
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$broker_keyword = addslashes($this->input->post('subbroker'));
			$broker_keyword = htmlspecialchars(str_replace('%20', ' ', $broker_keyword));
			$broker_keyword = preg_replace('/[^a-zA-Z0-9\']/', '-',$broker_keyword);
			$broker_keyword = str_replace(' ','-', $broker_keyword);
		    
			$marketer_keyword = addslashes($this->input->post('marketer'));
			$marketer_keyword = htmlspecialchars(str_replace('%20', ' ', $marketer_keyword));
			$marketer_keyword = preg_replace('/[^a-zA-Z0-9\']/', '-',$marketer_keyword);
			$marketer_keyword = str_replace(' ','-', $marketer_keyword);
		    
			$agent_keyword = addslashes($this->input->post('agent'));
			$agent_keyword = htmlspecialchars(str_replace('%20', ' ', $agent_keyword));
			$agent_keyword = preg_replace('/[^a-zA-Z0-9\']/', '-',$agent_keyword);
			$agent_keyword = str_replace(' ','-', $agent_keyword);
			
			if(is_numeric($broker_keyword)) { $search_broker=$broker_keyword; } else { $search_broker='';}
		    if(is_numeric($marketer_keyword)) { $search_marketer=$marketer_keyword;  } else { $search_marketer='';}
		    if(is_numeric($agent_keyword)) { $search_agent=$agent_keyword; } else { $search_agent='';}
		    
		    $fromdate=$this->input->post('fromdate');
			if($fromdate !='')	{
			    $from=date('Y-m-d', strtotime($fromdate));
		    }  else  {
			    $from='';	
			}
			
			$enddate=$this->input->post('enddate'); 
		    if($enddate !='') {
		         $end=date('Y-m-d', strtotime($enddate));	
		    } else {
			      $end='';	
			}
			
		
				
		} 
		    $this->data['reports']=$this->reports->brokersearches($search_broker,$search_marketer,$search_agent,$from,$end);	
			$this->data['companyname']=$datas['company'];
			$this->data['country']=$datas['country'];
			$this->data['streetaddress']=$datas['streetaddress'];
		    $this->load->view('report',$this->data);
						
	}
	
	public function searchresult($keyword='')
	{
		
		$keyword = str_replace('-',' ', $keyword);
					
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
		$option=$this->input->post('type');
		$this->paging['base_url'] = site_url("report/reportsearch");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = $this->reports->brokersearch_count($keyword,$limit,$offset);
		$this->pagination->initialize($this->paging);
		
	}
	
	/*public function view($id='')
	{
		if( $this->input->is_ajax_request() )
			{
				if( $this->session->userdata['youg_admin'] )
				{
					if(!$id)
					{
						redirect('report', 'refresh');
					}
					
													
					$this->data['elitemembers'] = $this->reports->elitemembers($id);
			        $this->data['titletype'] = $this->reports->get_types($id);
			        $this->data['signups'] = $this->reports->get_signupview_bycompanyid($id);
			       				
					
					if(count($this->data['elitemembers']) > 0 || count($this->data['elitemember']) > 0 || count($this->data['titletype']) > 0 || count($this->data['signups']) > 0)
					{			
						//Loading View File
						$this->load->view('report',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('report', 'refresh');
					}
			}
		}
		else
		{
			redirect('report', 'refresh');
		}
	}*/
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
