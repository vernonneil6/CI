<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		if( !$this->session->userdata('agent_data'))
	  	{
	      	redirect('marketerlogin', 'refresh');
		}
	 	$this->load->helper('form');
        $this->load->model('agents');
         require_once('../application/businessadmin/Classes/PHPExcel.php');
        //Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : Agents ';
		$this->data['section_title'] = 'Agents';
		$this->data['site_url'] = $this->settings->get_setting_value(2);

		$this->data['header'] = $this->load->view('agentheader',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['agent_data'] )
	  	{
			$this->load->view('agent',$this->data);
	  	}
                
	}
	public function elitemember()
	{
		if( $this->session->userdata['agent_data'] )
	  	{
			$this->data['elitemembers'] = $this->agents->elitemembers();
			$this->load->view('agent',$this->data);
	  	}
                
	}
	function logout()
	{
			if( isset($this->session->userdata['agent_data']) )
			{
				$this->session->unset_userdata('agent_data');
				$this->session->sess_destroy();
				redirect('agentlogin', 'refresh');
			}
			else
			{
				redirect('agentlogin', 'refresh');
			}	
	}
	
	public function userprofile($id)
	{
		if( $this->session->userdata['agent_data'] )
	  	{
			$this->data['getdata'] = $this->agents->data_by_id($id);
			$this->load->view('agent', $this->data);
	  	}
	}
	
	public function resetpassword($id)
	{
		if( $this->session->userdata['agent_data'] )
	  	{
			$this->data['getdata'] = $this->agents->data_by_id($id);
			$this->load->view('agent', $this->data);
			
			if($this->input->post('newpassword'))
			{
				$old = $this->input->post('oldpassword');
				$new = $this->input->post('password');
				$retype = $this->input->post('retypepassword');
				$pwd = $this->input->post('pwd');
				
				if($old != $pwd)
				{
					$this->session->set_flashdata('error', 'Old Password is incorrect');
					redirect('agent/resetpassword/'.$id,'refresh');
				}
				else
				{
					if($new != $retype)
					{
						$this->session->set_flashdata('error', 'Password not matched');
						redirect('agent/resetpassword/'.$id,'refresh');
					}
					else
					{
						$this->agents->userprofileupdate($new, $id);
						$this->session->set_flashdata('success', 'Password changed successfully');
						redirect('agent/userprofile/'.$id,'refresh');
					}		
				}	
			}
	  	}     
	}
	public function getmycsv($id)
    {
		$type=$this->uri->segment(4);
		$site_url = $this->settings->get_setting_value(2);
		if( isset($this->session->userdata['agent_data']) )
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
					
					$items = $this->agents->myelitecsv($id,$type);
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
	function elitemembers()
	{  if( isset($this->session->userdata['agent_data']) )
		{
			$id = $this->session->userdata['agent_data'][0]->id;
			$details=$this->agents->brokerids($id);
			$type=$details['type'];
			$this->data['elitemembers']=$this->agents->myelitecsvs($id,$type);
			$this->load->view('agent', $this->data);
         }
	}

}
