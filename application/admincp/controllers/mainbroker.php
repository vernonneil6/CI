<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Mainbroker extends CI_Controller 
{
	public $paging;
	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		
		if( $this->session->userdata('youg_admin'))
	  	{
		    //If no session, redirect to login page
			//echo site_url();die();
	      	if(!array_key_exists('type',$this->session->userdata['youg_admin']))
			{
				$a = site_url();
				$p = explode('/admincp',$a);
				//echo $p[0];
				//die();
				redirect($p[0].'/businessadmin', 'refresh');
			}
		}
		else
		{
			redirect('adminlogin', 'refresh');
		}
		//Loading Model File
  		$this->load->model('mainbrokers');
		
		require_once('../application/admincp/Classes/PHPExcel.php');
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : Main Broker ';
		$this->data['section_title'] = 'Main Broker';
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
	  if($this->session->userdata['youg_admin'])
	  {			
			$this->data['broker'] = $this->mainbrokers->brokers();
			$this->load->view('mainbroker',$this->data);
	  }
	}	
	function add()
	{
		
		$this->data['brokertype'] = $this->mainbrokers->brokers();
	    if($this->input->post('submitbroker'))
		{
			$request=$this->input;			
			$data=array(
			'type'=> 'subbroker',
			'mainbrokerid'=> $request->post('mainbrokerid'),
			'name'=>$request->post('username'),
			'password'=>$request->post('password'),
			'marketer'=>$request->post('marketer'),
			'agent'=>$request->post('agent'),
			'companyname'=>$request->post('companyname'),
			'companycontactname'=>$request->post('companycontactname'),
			'emailaddress'=>$request->post('emailaddress'),
			'phone'=>$request->post('phone'),
			'address'=>$request->post('address'),
			'id#'=>$request->post('id'),
			'signup'=>date("Y-m-d H:i:s")
			);	
					
			if($this->mainbrokers->allbroker($data)){
				$this->session->set_flashdata('success', 'Record Added Successfully');
				redirect('mainbroker/subbroker', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Record Not Added');
				redirect('mainbroker/add', 'refresh');
			}
			
		}
		$this->load->view('mainbroker',$this->data);
		
	}
	function brokeradd()
	{
		
		if($this->input->post('submitbroker'))
		{
			$request=$this->input;			
			$data=array(
			'type'=> 'broker',
			'name'=>$request->post('username'),
			'password'=>$request->post('password'),
			'subbroker'=>$request->post('subbroker'),
			'marketer'=>$request->post('marketer'),
			'agent'=>$request->post('agent'),
			'companyname'=>$request->post('companyname'),
			'companycontactname'=>$request->post('companycontactname'),
			'emailaddress'=>$request->post('emailaddress'),
			'phone'=>$request->post('phone'),
			'address'=>$request->post('address'),
			'id#'=>$request->post('id'),
			'signup'=>date("Y-m-d H:i:s")
			);	
			
								
			if($this->mainbrokers->allbroker($data)){
				$this->session->set_flashdata('success', 'Record Added Successfully');
				redirect('mainbroker', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Record Not Added');
				redirect('mainbroker', 'refresh');
			}
			
		}
		$this->load->view('mainbroker');
		
	}
	function marketeradd()
	{   
		$this->data['subbrokertype'] = $this->mainbrokers->subbrokers();
		
		if($this->input->post('submitbroker'))
		{
			
			$subid=$this->input->post('subbrokerid');
			$mainbrokerid=$this->mainbrokers->getmymainbroker($subid);
			$request=$this->input;			
			$data=array(
			'type'=> 'marketer',
			'mainbrokerid'=> $mainbrokerid[0]['mainbrokerid'],
			'subbrokerid'=> $request->post('subbrokerid'),
			'name'=>$request->post('username'),
			'password'=>$request->post('password'),
			'companyname'=>$request->post('companyname'),
			'companycontactname'=>$request->post('companycontactname'),
			'emailaddress'=>$request->post('emailaddress'),
			'phone'=>$request->post('phone'),
			'address'=>$request->post('address'),
			'id#'=>$request->post('id'),
			'signup'=>date("Y-m-d H:i:s")
			);	
			
							
			if($this->mainbrokers->allbroker($data)){
				$this->session->set_flashdata('success', 'Record Added Successfully');
				redirect('mainbroker/marketer', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Record Not Added');
				redirect('mainbroker/marketer', 'refresh');
			}
			
		}
		$this->load->view('mainbroker',$this->data);
		
	}
	
	function agentadd()
	{
		$this->data['marketertype'] = $this->mainbrokers->marketers();
		if($this->input->post('submitbroker'))
		{
			$markid=$this->input->post('marketerid');
			$brokerdata=$this->mainbrokers->getmybrokers($markid);
			$subbrokerid=$brokerdata[0]['subbrokerid'];
			$mainbrokerid=$brokerdata[0]['mainbrokerid'];
			$request=$this->input;			
			$data=array(
			'type'=> 'agent',
			'mainbrokerid'=> $mainbrokerid,
			'subbrokerid'=> $subbrokerid,
			'marketerid'=>$request->post('marketerid'),
			'name'=>$request->post('username'),
			'password'=>$request->post('password'),
			'companyname'=>$request->post('companyname'),
			'companycontactname'=>$request->post('companycontactname'),
			'emailaddress'=>$request->post('emailaddress'),
			'phone'=>$request->post('phone'),
			'address'=>$request->post('address'),
			'id#'=>$request->post('id'),
			'signup'=>date("Y-m-d H:i:s")
			);	
			
							
			if($this->mainbrokers->allbroker($data)){
				$this->session->set_flashdata('success', 'Record Added Successfully');
				redirect('mainbroker/agent', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Record Not Added');
				redirect('mainbroker', 'refresh');
			}
			
		}
		$this->load->view('mainbroker',$this->data);
		
	}
	
	function elitemember()
	{
		$array = array();
		$this->data['wholebroker'] = $this->mainbrokers->elitemembers();
		foreach($this->data['wholebroker'] as $whole_broker)
		{
			$id = $whole_broker['id'];
			$data = $this->mainbrokers->brokerids($id);
			$array[] = $this->mainbrokers->view_detailss($id);
		}
		$this->data['subbroker'] = $array;
		$this->load->view('mainbroker', $this->data);
	}
	function subbroker()
	{
		
		$this->data['subbroker']=$this->mainbrokers->subbrokers();
		$this->load->view('mainbroker', $this->data);
			
	}
	function marketer()
	{
		
		$this->data['marketers']=$this->mainbrokers->marketers();
		$this->load->view('mainbroker', $this->data);
			
	}
	function agent()
	{
		$this->data['agents']=$this->mainbrokers->agents();
		$this->load->view('mainbroker', $this->data);
	
	}
	function nodetail()
	{
		$this->load->view('mainbroker');
		
	}
	function brokerview($id='')
	{
		if( $this->session->userdata['youg_admin'] )
		{
					if(!$id)
					{
						redirect('mainbroker', 'refresh');
					}
					$this->data['views']=$this->mainbrokers->view_details($id);
					
					//print_r($this->data['views']);
			       					
					if(count($this->data['views']) > 0)
					{			
						//Loading View File
						$this->load->view('mainbrokerview',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('mainbroker/nodetail', 'refresh');
					}
		}
		
		
	}
	function view($id='')
	{
		if( $this->session->userdata['youg_admin'] )
		{
					if(!$id)
					{
						redirect('mainbroker', 'refresh');
					}
					$this->data['views']=$this->mainbrokers->view_details($id);
					
					//print_r($this->data['views']);
			       					
					if(count($this->data['views']) > 0)
					{			
						//Loading View File
						$this->load->view('mainbrokerview',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('mainbroker/nodetail', 'refresh');
					}
		}
		
		
	}
	function mview($id='')
	{
		if( $this->session->userdata['youg_admin'] )
		{
					if(!$id)
					{
						redirect('mainbroker', 'refresh');
					}
					$this->data['views']=$this->mainbrokers->view_details($id);
					
					//print_r($this->data['views']);
			       					
					if(count($this->data['views']) > 0)
					{			
						//Loading View File
						$this->load->view('mainbrokerview',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('mainbroker/nodetail', 'refresh');
					}
		}
		
		
	}
	function aview($id='')
	{
		if( $this->session->userdata['youg_admin'] )
		{
					if(!$id)
					{
						redirect('mainbroker', 'refresh');
					}
					$this->data['views']=$this->mainbrokers->view_details($id);
					
					//print_r($this->data['views']);
			       					
					if(count($this->data['views']) > 0)
					{			
						//Loading View File
						$this->load->view('mainbrokerview',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('mainbroker/nodetail', 'refresh');
					}
		}
		
		
	}
	function brokeredit($id){
		if(is_numeric($id)){
			$this->data['Brokers'] = $this->mainbrokers->brokerids($id);
			$this->load->view('viewbroker',$this->data);
		}
	}
	function edit($id){
		if(is_numeric($id)){
			$this->data['Brokers'] = $this->mainbrokers->brokerids($id);
			$this->load->view('viewbroker',$this->data);
		}
	}
	function medit($id){
		if(is_numeric($id)){
			$this->data['Brokers'] = $this->mainbrokers->brokerids($id);
			$this->load->view('viewbroker',$this->data);
		}
	}
	function aedit($id){
		if(is_numeric($id)){
			$this->data['Brokers'] = $this->mainbrokers->brokerids($id);
			$this->load->view('viewbroker',$this->data);
		}
	}
	function brokerupdate(){
		
		if( $this->input->post('table_id') ){				
			$id = $this->input->post('table_id');
			$data=array(
			'type'=> 'broker',
			'name'=>$this->input->post('username'),
			'password'=>$this->input->post('password'),
			'subbroker'=>$this->input->post('subbroker'),
			'marketer'=>$this->input->post('marketer'),
			'agent'=>$this->input->post('agent'),			
			'companyname'=>$this->input->post('companyname'),			
			'companycontactname'=>$this->input->post('companycontactname'),			
			'emailaddress'=>$this->input->post('emailaddress'),			
			'phone'=>$this->input->post('phone'),			
			'address'=>$this->input->post('address'),			
			'id#'=>$this->input->post('id')			
			);			
			if($this->mainbrokers->updatebroker($id,$data)){
				$this->session->set_flashdata('success', 'Record Updated Successfully');
			}else{
				$this->session->set_flashdata('error', 'Record Not Updated');
			}
			redirect('mainbroker', 'refresh');
		}
	}
	function update(){
		
		if( $this->input->post('table_id') ){				
			$id = $this->input->post('table_id');
			$data=array(
			'type'=> 'subbroker',
			'name'=>$this->input->post('username'),
			'password'=>$this->input->post('password'),
			'marketer'=>$this->input->post('marketer'),
			'agent'=>$this->input->post('agent'),			
			'companyname'=>$this->input->post('companyname'),			
			'companycontactname'=>$this->input->post('companycontactname'),			
			'emailaddress'=>$this->input->post('emailaddress'),			
			'phone'=>$this->input->post('phone'),			
			'address'=>$this->input->post('address'),			
			'id#'=>$this->input->post('id')			
			);			
			if($this->mainbrokers->updatebroker($id,$data)){
				$this->session->set_flashdata('success', 'Record Updated Successfully');
			}else{
				$this->session->set_flashdata('error', 'Record Not Updated');
			}
			redirect('mainbroker/subbroker', 'refresh');
		}
	}
	function mupdate(){
		
		if( $this->input->post('table_id') ){				
			$id = $this->input->post('table_id');
			$data=array(
			'type'=> 'marketer',
			'name'=>$this->input->post('username'),
			'password'=>$this->input->post('password'),
			'companyname'=>$this->input->post('companyname'),			
			'companycontactname'=>$this->input->post('companycontactname'),			
			'emailaddress'=>$this->input->post('emailaddress'),			
			'phone'=>$this->input->post('phone'),			
			'address'=>$this->input->post('address'),			
			'id#'=>$this->input->post('id')			
			);			
			if($this->mainbrokers->updatebroker($id,$data)){
				$this->session->set_flashdata('success', 'Record Updated Successfully');
			}else{
				$this->session->set_flashdata('error', 'Record Not Updated');
			}
			redirect('mainbroker/marketer', 'refresh');
		}
	}
	function aupdate(){
		
		if( $this->input->post('table_id') ){				
			$id = $this->input->post('table_id');
			$data=array(
			'type'=> 'agent',
			'name'=>$this->input->post('username'),
			'password'=>$this->input->post('password'),
			'companyname'=>$this->input->post('companyname'),			
			'companycontactname'=>$this->input->post('companycontactname'),			
			'emailaddress'=>$this->input->post('emailaddress'),			
			'phone'=>$this->input->post('phone'),			
			'address'=>$this->input->post('address'),			
			'id#'=>$this->input->post('id')			
			);			
			if($this->mainbrokers->updatebroker($id,$data)){
				$this->session->set_flashdata('success', 'Record Updated Successfully');
			}else{
				$this->session->set_flashdata('error', 'Record Not Updated');
			}
			redirect('mainbroker/agent', 'refresh');
		}
	}
	function bdelete($id){
		$this->mainbrokers->deletebroker($id);
		redirect('mainbroker', 'refresh');
	}
	function delete($id){
		$this->mainbrokers->deletebroker($id);
		redirect('mainbroker/subbroker', 'refresh');
	}
	function mdelete($id){
		$this->mainbrokers->deletebroker($id);
		redirect('mainbroker/marketer', 'refresh');
	}
	function adelete($id){
		$this->mainbrokers->deletebroker($id);
		redirect('mainbroker/agent', 'refresh');
	}
	public function getmycsv($id)
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
					
					$items = $this->mainbrokers->myelitecsv($id,$type);
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
                                        ob_end_clean();   
					$objPHPExcel->setActiveSheetIndex(0);
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
					$file=time().'.xls';
					$objWriter->save('../uploads/my/'.$file);
					$this->load->helper('download');

					$file1 = file_get_contents($site_url.'uploads/my/'.$file);
					$name = 'Report-of-Elitebrokercsv-details.xls';

					force_download($name, $file1); 
	
	} 
			
	}
	function ajaxRequest(){
		
		/*check checkBrokername*/
		if($this->input->post('type')=='checkBrokername'){
			if( $this->input->is_ajax_request() && ( $this->input->post('username'))){
				$username=$this->input->post('username');
				$btype=$this->input->post('btype');
				$nameStatus = array();
				$brokername = $this->mainbrokers->broker_nameavail_check($username,$btype);
				if(count($brokername)>0)
				{
					$nameStatus['status'] = "error";
					$nameStatus['nameError'] = "This Brokername already exists. Try later!";
					$nameStatus['checkname']="0";
                    echo json_encode($nameStatus);
				}else{
					$nameStatus['status'] = "success";
                    $nameStatus['checkname']="1"; 
					echo json_encode($nameStatus);
					return true;
				}
			}				
		}		
		
		
	}
	
}
?>
