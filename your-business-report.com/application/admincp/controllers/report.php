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
					
					if($type=='allenable' || $type=='alldisable' || $type=='allelite' || $type=='allenablewithcode' || $type=='alldisablewithcode')
					{
						if($type=='allenable'){
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
							 
		$objPHPExcel->getActiveSheet()->setTitle('report');
		
	    $objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Join date')
									->setCellValue('C1', 'Membership status:');
									
															  
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
						$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
							 
		$objPHPExcel->getActiveSheet()->setTitle('report');
		
	    $objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Join date')
									->setCellValue('C1', 'Membership status:');
									
															  
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
						$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
							 
		$objPHPExcel->getActiveSheet()->setTitle('report');
		
	    $objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Join date')
									->setCellValue('C1', 'Account Status:');
									
															  
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
						$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
							 
		$objPHPExcel->getActiveSheet()->setTitle('report');
		
	    $objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Join date')
									->setCellValue('C1', 'Membership status:')
									->setCellValue('D1', 'Discountcode');
															  
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
						$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
							 
		$objPHPExcel->getActiveSheet()->setTitle('report');
		
	    $objPHPExcel->getActiveSheet()->getStyle("A1:T1")->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()
									->setCellValue('A1', 'Company')
									->setCellValue('B1', 'Join date')
									->setCellValue('C1', 'Membership status:')
									->setCellValue('D1', 'Discountcode');
															  
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
						
						/*if($type=='allenable')
						{
							$file = 'Report-of-elite-members-enabled.xls';
							ob_start();
							echo "Company;Join date;Membership status";
							echo "\n";
					
							$elitemembers = $this->reports->get_all_elitemembersforreport();
					
				    		for($i=0;$i<count($elitemembers);$i++) { 
							
							if($elitemembers[$i]['elitestatus'] == 'Enable')
							{
								echo stripslashes(ucwords($elitemembers[$i]['company']));
								echo ";";
								echo date("M d Y",strtotime($elitemembers[$i]['joindate'])); 
								echo ";";
								if( stripslashes($elitemembers[$i]['elitestatus']) == 'Enable' ) { 
								echo "Enable";
								echo ";";
									} 
							echo "\n";
							}
							}
					
							$content = ob_get_contents();
							ob_end_clean();
							header("Expires: 0");
							header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
							header("Cache-Control: no-store, no-cache, must-revalidate");
							header("Cache-Control: post-check=0, pre-check=0", false);
							header("Pragma: no-cache");  header("Content-type: application/csv;charset:UTF-8");
							header('Content-length: '.strlen($content));
							header('Content-disposition: attachment; filename='.basename($file));
							echo $content;
							exit;
							
						}*/
						
						/*if($type=='alldisable')
						{
							$file = 'Report-of-elite-members-disabled.csv';
							ob_start();
							echo "Company;Join date;Membership status";
							echo "\n";
					
							$elitemembers = $this->reports->get_all_elitemembersforreport();
					
				    		for($i=0;$i<count($elitemembers);$i++) { 
							
							if($elitemembers[$i]['elitestatus'] == 'Disable')
							{
								echo stripslashes(ucwords($elitemembers[$i]['company']));
								echo ";";
								echo date("M d Y",strtotime($elitemembers[$i]['joindate'])); 
								echo ";";
								if( stripslashes($elitemembers[$i]['elitestatus']) == 'Disable' ) { 
								echo "Disable";
								echo ";";
									} 
							echo "\n";
							}
							}
					
							$content = ob_get_contents();
							ob_end_clean();
							header("Expires: 0");
							header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
							header("Cache-Control: no-store, no-cache, must-revalidate");
							header("Cache-Control: post-check=0, pre-check=0", false);
							header("Pragma: no-cache");  header("Content-type: application/csv;charset:UTF-8");
							header('Content-length: '.strlen($content));
							header('Content-disposition: attachment; filename='.basename($file));
							echo $content;
							exit;
							
						}*/
						
						/*if($type=='allelite')
						{
							$file = 'Report-of-elite-members-all.csv';
							ob_start();
							echo "Company;Join date;Membership status;Payment method";
							echo "\n";
					
							$elitemembers = $this->reports->get_all_elitemembersforreport();
					
				    		for($i=0;$i<count($elitemembers);$i++) { 
							
								echo stripslashes(ucwords($elitemembers[$i]['company']));
								echo ";";
								echo date("M d Y",strtotime($elitemembers[$i]['joindate'])); 
								echo ";";
								if( stripslashes($elitemembers[$i]['elitestatus']) == 'Enable' ) { 
								echo "Enable";
								echo ";";
									} 
								if( stripslashes($elitemembers[$i]['elitestatus']) == 'Disable' ) { 
								echo "Disable";
								echo ";";
									} 
								echo "Paypal";
							echo "\n";
							
							}
					
							$content = ob_get_contents();
							ob_end_clean();
							header("Expires: 0");
							header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
							header("Cache-Control: no-store, no-cache, must-revalidate");
							header("Cache-Control: post-check=0, pre-check=0", false);
							header("Pragma: no-cache");  header("Content-type: application/csv;charset:UTF-8");
							header('Content-length: '.strlen($content));
							header('Content-disposition: attachment; filename='.basename($file));
							echo $content;
							exit;
							
						}*/
						
					/*	if($type=='allenablewithcode')
						{
							$file = 'Report-of-elite-members-with-promotional-enable.csv';
							ob_start();
							echo "Company;Join date;Membership status;Payment method;Promotional Code";
							echo "\n";
					
							$elitemembers = $this->reports->get_all_elitemembersforreport();
					
				    		for($i=0;$i<count($elitemembers);$i++) { 
							
								if( stripslashes($elitemembers[$i]['discountcode']!='')){
								echo stripslashes(ucwords($elitemembers[$i]['company']));
								echo ";";
								echo date("M d Y",strtotime($elitemembers[$i]['joindate'])); 
								echo ";";
								if( stripslashes($elitemembers[$i]['elitestatus']) == 'Enable' ) { 
								echo "Enable";
								echo ";";
									} 
								echo "Paypal";
								echo ";";
								echo stripslashes($elitemembers[$i]['discountcode']);
								echo "\n";
								}
							}
					
							$content = ob_get_contents();
							ob_end_clean();
							header("Expires: 0");
							header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
							header("Cache-Control: no-store, no-cache, must-revalidate");
							header("Cache-Control: post-check=0, pre-check=0", false);
							header("Pragma: no-cache");  header("Content-type: application/csv;charset:UTF-8");
							header('Content-length: '.strlen($content));
							header('Content-disposition: attachment; filename='.basename($file));
							echo $content;
							exit;
							
						}
						
						if($type=='alldisablewithcode')
						{
							$file = 'Report-of-elite-members-with-promotional-disable.csv';
							ob_start();
							echo "Company;Join date;Membership status;Payment method;Promotional Code";
							echo "\n";
					
							$elitemembers = $this->reports->get_all_elitemembersforreport();
					
				    		for($i=0;$i<count($elitemembers);$i++) { 
							
								if( stripslashes($elitemembers[$i]['discountcode']!=''))
								{
								echo stripslashes(ucwords($elitemembers[$i]['company']));
								echo ";";
								echo date("M d Y",strtotime($elitemembers[$i]['joindate'])); 
								echo ";";
								if( stripslashes($elitemembers[$i]['elitestatus']) == 'Disable' ) { 
								echo "Disable";
								echo ";";
									} 
								echo "Paypal";
								echo stripslashes($elitemembers[$i]['discountcode']);
								echo ";";
							echo "\n";
								}
							}
					
							$content = ob_get_contents();
							ob_end_clean();
							header("Expires: 0");
							header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
							header("Cache-Control: no-store, no-cache, must-revalidate");
							header("Cache-Control: post-check=0, pre-check=0", false);
							header("Pragma: no-cache");  header("Content-type: application/csv;charset:UTF-8");
							header('Content-length: '.strlen($content));
							header('Content-disposition: attachment; filename='.basename($file));
							echo $content;
							exit;
							
						}*/
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
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */