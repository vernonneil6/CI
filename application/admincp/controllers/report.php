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
			$this->data['elitemembers'] = $this->reports->get_all_elitemembersforreport();
			//Loading View File
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
					if($type=='allenable' || $type=='alldisable' || $type=='allelite' || $type=='allenablewithcode' || $type=='alldisablewithcode' || $type=='callcenter' || $type=='removedreviews' || $type=='removedcomplaints' || $type='subbrokerdetail')
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
		
	    $objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Address')	
									->setCellValue('C1', 'City')
									->setCellValue('D1', 'State')
									->setCellValue('E1', 'Zip')
									->setCellValue('F1', 'Business Phone')
									->setCellValue('G1', 'Category')
									->setCellValue('H1', 'Contact Name')
									->setCellValue('I1', 'Contact Phone')
									->setCellValue('J1', 'Contact Email')
									->setCellValue('K1', 'Signup Date')
									->setCellValue('L1', 'Cancel Date')
									->setCellValue('M1', 'Membership status:')
									->setCellValue('N1', 'Discount Code');
									
															  
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
		
		
		
		
		
		
		
		
			
		///////////subbroker csv
		
		
						if($type=='subbrokerdetail'){
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
									->setCellValue('A1', 'Name')
									->setCellValue('B1', 'Type')	
									->setCellValue('C1', 'Marketers_allowed')	
									->setCellValue('D1', 'Agents_allowed')	
									->setCellValue('E1', 'Signup')	
									->setCellValue('F1', 'Marketers_name')	
									->setCellValue('G1', 'Agents_name')	
									->setCellValue('H1', 'Total_Elite_sales');	
														  
		$items = $this->reports->get_subbrokerdetails();
		
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
		$name = 'Report-of-subbrokerdetails-enabled.xls';

		force_download($name, $file1); 
		
		
		}
		
		
		
		
		///////////subbroker csv
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
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
		
	    $objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Address')	
									->setCellValue('C1', 'City')
									->setCellValue('D1', 'State')
									->setCellValue('E1', 'Zip')
									->setCellValue('F1', 'Business Phone')
									->setCellValue('G1', 'Category')
									->setCellValue('H1', 'Contact Name')
									->setCellValue('I1', 'Contact Phone')
									->setCellValue('J1', 'Contact Email')
									->setCellValue('K1', 'Signup Date')
									->setCellValue('L1', 'Cancel Date')
									->setCellValue('M1', 'Membership status:')
									->setCellValue('N1', 'Discount Code');
									
															  
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
		
	    $objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Address')	
									->setCellValue('C1', 'City')
									->setCellValue('D1', 'State')
									->setCellValue('E1', 'Zip')
									->setCellValue('F1', 'Business Phone')
									->setCellValue('G1', 'Category')
									->setCellValue('H1', 'Contact Name')
									->setCellValue('I1', 'Contact Phone')
									->setCellValue('J1', 'Contact Email')
									->setCellValue('K1', 'Signup Date')
									->setCellValue('L1', 'Cancel Date')
									->setCellValue('M1', 'Membership status:')
									->setCellValue('N1', 'Discount Code');
									
															  
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
		
	    $objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Address')	
									->setCellValue('C1', 'City')
									->setCellValue('D1', 'State')
									->setCellValue('E1', 'Zip')
									->setCellValue('F1', 'Business Phone')
									->setCellValue('G1', 'Category')
									->setCellValue('H1', 'Contact Name')
									->setCellValue('I1', 'Contact Phone')
									->setCellValue('J1', 'Contact Email')
									->setCellValue('K1', 'Signup Date')
									->setCellValue('L1', 'Cancel Date')
									->setCellValue('M1', 'Membership status:')
									->setCellValue('N1', 'Discount Code');
															  
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
		
	    $objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Address')	
									->setCellValue('C1', 'City')
									->setCellValue('D1', 'State')
									->setCellValue('E1', 'Zip')
									->setCellValue('F1', 'Business Phone')
									->setCellValue('G1', 'Category')
									->setCellValue('H1', 'Contact Name')
									->setCellValue('I1', 'Contact Phone')
									->setCellValue('J1', 'Contact Email')
									->setCellValue('K1', 'Signup Date')
									->setCellValue('L1', 'Cancel Date')
									->setCellValue('M1', 'Membership status:')
									->setCellValue('N1', 'Discount Code');
															  
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
	/*public function search()
	{
		
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '-',$keyword);
			$keyword = str_replace(' ','-', $keyword);
			$searchdate=$this->input->post('searchdate');
			$type=$this->input->post('type');
			$searchtype=implode(',',$type);
			$this->reports->search_insert($keyword,$searchtype,$searchdate);
			redirect('report/search','refresh');	
		}
		else
		{
			redirect('report','refresh');
		}
			
	}*/
	public function reportsearch()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '-',$keyword);
			$keyword = str_replace(' ','-', $keyword);
			$option=$this->input->post('type'); 
			$singledate=date('Y-m-d',strtotime($this->input->post('singledate'))); 
			$fromdate=$this->input->post('fromdate');
			$enddate=$this->input->post('enddate');
		    $from=date('Y-m-d', strtotime($fromdate)); 
		   	$end=date('Y-m-d', strtotime($enddate));		
			$this->data['reports']=$this->reports->brokersearch($keyword,$option,$from,$end,$singledate);	
			$this->data['companyname']=$datas['company'];
			$this->data['country']=$datas['country'];
			$this->data['streetaddress']=$datas['streetaddress'];
			
			
			$limit = $this->paging['per_page'];
			
		    $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
			$this->paging['base_url'] = site_url("report/reportsearch");
			$this->paging['uri_segment'] = 5;
			$this->paging['total_rows'] = $this->reports->brokersearch_count($keyword,$limit,$offset);
			$this->pagination->initialize($this->paging);
			
				
		}
		$this->load->view('report',$this->data);
						
	}
	public function searchresult($keyword='')
	{
		
		$keyword = str_replace('-',' ', $keyword);
					
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
		$option=$this->input->post('type');
		//$this->data['reports'] = $this->reports->brokersearch($keyword,$option);
		
		$this->paging['base_url'] = site_url("reports/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = $this->reports->brokersearch_count($keyword);
		$this->pagination->initialize($this->paging);
		
		//$this->load->view('report',$this->data);
	}
	
	public function view($id='')
	{
		if( $this->input->is_ajax_request() )
			{
				if( $this->session->userdata['youg_admin'] )
				{
					if(!$id)
					{
						redirect('report', 'refresh');
					}
				
			    $this->data['m_list'] = $this->reports->get_marketerlist_byid($id);          
			    $this->data['a_list'] = $this->reports->get_agentlist_byid($id);          
				
				$this->data['subbroker'] = $this->reports->get_subbroker_byid($id);
				$this->data['marketer'] = $this->reports->get_marketer_byid($id);
				$this->data['agent'] = $this->reports->get_agent_byid($id);
				
				$this->data['subbroker_elite'] = $this->reports->get_elitecount_subbroker_byid($id);
				$this->data['marketer_elite'] = $this->reports->get_elitecount_marketer_byid($id);
				$this->data['agent_elite'] = $this->reports->get_elitecount_agent_byid($id);
				
				
				
				if( count($this->data['subbroker']) > 0 || count($this->data['marketer']) > 0 || count($this->data['agent']) > 0  ||  count($this->data['subbroker_elite']) > 0 || count($this->data['marketer_elite']) > 0  || count($this->data['agent_elite']) > 0)
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
	}
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
