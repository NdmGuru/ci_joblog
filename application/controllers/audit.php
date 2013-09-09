<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audit extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('job_model');
		$this->load->model('user_model');
    }
		
	public function index(){
		$this->view();
	}
	
	public function view(){
		// View the audit log, for a particular user?
		$this->load->view('header');
		$this->load->view('audit');
	}
}