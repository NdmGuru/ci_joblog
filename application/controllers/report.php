<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('report_model');
		$this->load->model('user_model');
		$this->load->model('job_model');
		$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'localhost',
			  'smtp_port' => 25,
			  'mailtype' => 'html',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
			);	
	
		$this->load->library('email', $config);	
    }

	public function index()
	{	
		$this->load->view('header');
		$this->load->view('report');
	}
	
	public function generateReport($state)
	{
		// Start the report
		
		// Start job report (All jobs closed for state)
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Closed Jobs ' .$state);

		$dataSet = $this->report_model->reportJobs($state);

		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0,1,"Technitian");
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(1,1,"Customer");
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2,1,"Start");
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(3,1,"End");
		
		$rowCnt = 2;
		foreach ($dataSet as $column){
			$colCnt = 0;
			foreach ($column as $row){	
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow($colCnt,$rowCnt,$row);
				$colCnt++;
			}
			$rowCnt++;
		}
		
		// Start the tech worked hours report (All techs for state).
		$this->excel->createSheet(1);
		$this->excel->setActiveSheetIndex(1);
		$this->excel->getActiveSheet()->setTitle('Hours Worked ' .$state);

		$dataSet = $this->report_model->reportHours($state);

		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0,1,"Tech ID");
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(1,1,"Technitian");
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2,1,"Hours");
		
		$rowCnt = 2;
		foreach ($dataSet as $column){
			$colCnt = 0;
			foreach ($column as $row){	
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow($colCnt,$rowCnt,$row);
				$colCnt++;
			}
			$rowCnt++;
		}	
		
		// set active sheet to 0
		$this->excel->setActiveSheetIndex(0);

		// Write out the report
		$filename='/var/www/sites/joblog.bytecraft.com.au/files/jobReport_' .$state .'.xls'; //save our workbook as this file name
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		
		// Save the file, and return the file name.
		$objWriter->save($filename);
		return $filename;
	}
	
	public function emailReport($file, $email){
		$this->email->from('report@joblog.bytecraft.com.au', 'Joblog Reports');
		$this->email->to($email); 
		
		$this->email->subject('Joblog Report');
		$this->email->message('Please find attached your joblog report');	
		$this->email->attach($file);
		
		$this->email->send();
		delete_files("/files/");	
		
		return true;
	}

	public function send(){
		if($this->input->post('state')){
			$file = $this->generateReport($this->input->post('state'));
			$email = 'nmetcalf@bytecraft.com.au';

			$this->emailReport($file, $email);
			
			$data['message'] = "Email sent to " .$email;

			$this->load->view('header');
			$this->load->view('report',$data);
		}elseif($this->uri->segment(3)){
			$report = $this->generateReport($this->uri->segment(3));
			
			if($this->uri->segment(4)){
				$email = $this->uri->segment(4);
			}else{
				$email = $this->report_model->getEmail($this->uri->segment(3));
			}

			$this->emailReport($report, $email);
			
			echo "Email sent to " .$email ." with joblog for " .$this->uri->segment(3);
		}else{
			$this->index();
		}
	}
}
