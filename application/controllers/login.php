<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('user_model');
    }

	public function index($data = array("errors" => ""))
	{
		if($this->session->userdata('validated')){
            redirect('home');
        }
		
		$this->load->view('header');
		$this->load->view('login',$data);
	}
		
	public function process(){
        $result = $this->user_model->validate();
        if(! $result){
            $this->index(array("errors" => "Incorrect tech ID"));
        }else{
            redirect("home");
        }        
    }
}