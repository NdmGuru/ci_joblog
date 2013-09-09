<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('user_model');
		$this->load->model('job_model');
		$this->check_isvalidated();
    }

	public function index()
	{	
		$this->load->view('header');
		$this->load->view('home');
	}
		
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}