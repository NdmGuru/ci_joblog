<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('job_model');
		$this->load->model('user_model');
    }
	
	public function checkdate($start, $end){
		// Function to check that the start date is before the end date...
		if(strtotime($start) < strtotime($end)){
			return true;
		}
		return false;
	}
	
	public function index(){
		$this->add();
	}
	
	public function add(){
		$this->form_validation->set_message('checkdate', 'The start date must be before the end date');
		$this->form_validation->set_rules('customer', 'customer', 'trim|required');
		$this->form_validation->set_rules('start', 'start', 'trim|required|callback_checkdate['.$this->input->post('end').']');
		$this->form_validation->set_rules('end', 'end', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header');
			$this->load->view('home');
		}
		else
		{
			$data = array(
				"customer"	=> $this->input->post('customer'),
				"start" 	=> $this->input->post('start'),
				"end"		=> $this->input->post('end'),
				"closedBy"	=> $this->user_model->get_techId(),
			);
			$this->job_model->addJob($data);

			// Display the home view
			redirect("home");
		}
    }

	public function edit(){
		if($this->input->post('jobId')){
			$jobid	 			= $this->input->post('jobId');
			$job["start"] 		= $this->input->post('start');
			$job["end"]   		= $this->input->post('end');
			$job["customer"] 	= $this->input->post('customer');
			$job["closedBy"] 	= $this->user_model->get_techId();
			
			$this->job_model->update($job,$jobid);
			
			// Display the home view
			redirect("home");
		}else{				
			$data = $this->job_model->get($this->uri->segment(3));
			
			// Display the home view
			$this->load->view('header');
			$this->load->view('home',$data);
		}
	}
	
	public function delete(){
		$this->job_model->delete($this->uri->segment(3));
		
		// Display the home view
		$this->load->view('header');
		$this->load->view('home');
	}
}