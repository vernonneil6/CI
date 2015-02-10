<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subbroker extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		if( !$this->session->userdata('subbroker_data'))
	  	{
	      	redirect('subbrokerlogin', 'refresh');
		}
	 	$this->load->helper('form');
        $this->load->model('subbrokers');
        require_once('../application/businessadmin/Classes/PHPExcel.php');
        //Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : Subbrokers ';
		$this->data['section_title'] = 'Subbrokers';
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		$websites = $this->settings->get_all_urls();

		$this->data['header'] = $this->load->view('subbrokerheader',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->load->view('subbroker',$this->data);
	  	}
                
	}
	public function marketer()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['allmarketer'] = $this->subbrokers->data_allmarketer();
			$this->load->view('subbroker',$this->data);
	  	}
                
	}
	
	public function addmarketer()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->load->view('subbroker');
			
			if($this->input->post('marketersubmit'))
			{
				$data=array(
					'type'=> 'marketer',
					'name'=>$this->input->post('marketername'),
					'password'=>$this->input->post('marketerpassword'),
					'signup'=>date("Y-m-d H:i:s"),
					'subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id
				);
				$this->subbrokers->allbroker($data);
				redirect('subbroker/marketer','refresh');
			}
	  	}
                
	}
	
	public function editmarketer($id)
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['getmarketerdata'] = $this->subbrokers->data_by_id($id);
			$this->load->view('subbroker',$this->data);
			
			if($this->input->post('marketersubmit'))
			{
			
				$type = 'marketer';
				$name = $this->input->post('marketername');
				$password = $this->input->post('marketerpassword');
				$signup = date("Y-m-d H:i:s");
				$subbrokerid = $this->session->userdata['subbroker_data'][0]->id;
			
				$this->subbrokers->marketerupdates($type,$name,$password,$signup,$subbrokerid,$id);
				redirect('subbroker/marketer','refresh');
			}
	  	}
                
	}
	
	public function deletemarketer($id)
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->subbrokers->data_delete($id);
			redirect('subbroker/marketer','refresh');
		}
	}
	
	public function agent()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['allagent'] = $this->subbrokers->data_allagent();
			$this->load->view('subbroker',$this->data);
	  	}
                
	}
	public function addagent()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['marketername'] = $this->subbrokers->data_allmarketer();
			$this->load->view('subbroker',$this->data);
			if($this->input->post('agentsubmit'))
			{
				$data=array(
					'type'=> 'agent',
					'name'=>$this->input->post('agentname'),
					'password'=>$this->input->post('agentpassword'),
					'signup'=>date("Y-m-d H:i:s"),
					'marketerid'=>$this->input->post('agentmarketer'),
					'subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id
				);
				$this->subbrokers->allbroker($data);
				redirect('subbroker/agent','refresh');
			}
	  	}
                
	}
	
	public function editagent($id)
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['marketername'] = $this->subbrokers->data_allmarketer();
			$this->data['getagentdata'] = $this->subbrokers->data_by_id($id); 
			$this->load->view('subbroker',$this->data);
			
			if($this->input->post('agentsubmit'))
			{
				$type = 'agent';
				$name = $this->input->post('agentname');
				$password = $this->input->post('agentpassword');
				$signup = date("Y-m-d H:i:s");
				$marketerid = $this->input->post('agentmarketer');
				$subbrokerid = $this->session->userdata['subbroker_data'][0]->id;
				
				 $this->subbrokers->agentupdates($type,$name,$password,$signup,$marketerid,$subbrokerid,$id);
				 redirect('subbroker/agent','refresh');
			}
	  	}
                
	}
	
	public function deleteagent($id)
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->subbrokers->data_delete($id);
			redirect('subbroker/agent','refresh');
		}
	}
	
	public function elitemember()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['elitemembers'] = $this->subbrokers->elitemembers();
			$this->data['elitemember'] = $this->subbrokers->agentelitemembers();
			$this->load->view('subbroker',$this->data);
	  	}
                
	}
	
	public function userprofile($id)
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['getdata'] = $this->subbrokers->data_by_id($id);
			$this->load->view('subbroker', $this->data);
	  	}
	}
	
	public function resetpassword($id)
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['getdata'] = $this->subbrokers->data_by_id($id);
			$this->load->view('subbroker', $this->data);
			
			if($this->input->post('newpassword'))
			{
				$old = $this->input->post('oldpassword');
				$new = $this->input->post('password');
				$retype = $this->input->post('retypepassword');
				$pwd = $this->input->post('pwd');
				
				if($old != $pwd)
				{
					$this->session->set_flashdata('error', 'Old Password is incorrect');
					redirect('subbroker/resetpassword/'.$id,'refresh');
				}
				else
				{
					if($new != $retype)
					{
						$this->session->set_flashdata('error', 'Password not matched');
						redirect('subbroker/resetpassword/'.$id,'refresh');
					}
					else
					{
						$this->subbrokers->userprofileupdate($new, $id);
						$this->session->set_flashdata('success', 'Password changed successfully');
						redirect('subbroker/userprofile/'.$id,'refresh');
					}		
				}	
			}
	  	}     
	}
	
	function logout()
	{
		if( isset($this->session->userdata['subbroker_data']) )
		{
			$this->session->unset_userdata('subbroker_data');
			$this->session->sess_destroy();
		  	redirect('subbrokerlogin', 'refresh');
		}
		else
		{
			redirect('subbrokerlogin', 'refresh');
		}	
	}
	    public function getmycsv($id)
    {
		$type=$this->uri->segment(4);
		$site_url = $this->settings->get_setting_value(2);
		if( isset($this->session->userdata['subbroker_data']) )
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
					
					$items = $this->subbrokers->myelitecsv($id,$type);
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
	{  if( isset($this->session->userdata['subbroker_data']) )
		{
			$id = $this->session->userdata['subbroker_data'][0]->id;
			$details=$this->subbrokers->brokerids($id);
			$type=$details['type'];
			$this->data['elitemembers']=$this->subbrokers->myelitecsvs($id,$type);
			$this->load->view('subbroker', $this->data);
         }
	}

}
