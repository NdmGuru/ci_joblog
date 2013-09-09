<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public $name;
	public $techId;
	public $lastUpdate;
	public $validated;
	
  	function __construct(){
        parent::__construct();
    }

	public function get_name(){
		return $this->session->userdata("name");
	}
	
	public function get_techId(){
		return $this->session->userdata("techId");
	}
	
	public function get_lastUpdate(){
		return $this->session->userdata("lastUpdate");
	}

	public function get_valid(){
		return $this->session->userdata("validated");
	}
	
	public function set_name($name){
		$this->session->set_userdata(array("name" => $name));
		$this->name = $name;
		return true;
	}
	
	public function set_techId($id){
		$this->session->set_userdata(array("techId" => $id));
		$this->techId = $id;
		return true;
	}
	
	public function set_lastUpdate($update){
		$this->session->set_userdata(array("lastUpdate" => $update));
		$this->lastUpdate = $update;
		return true;
	}
	
	public function set_validated($valid){
		$this->session->set_userdata(array("validated" => $valid));
		$this->validated = $valid;
		return true;
	}
	
	public function techDropdown(){
		$result = $this->getTechs();
		$return = array();
		foreach($result as $row){
			$return[$row['techId']] = $row['Name'];
		}
		return $return;
	}
	
	public function getTechs(){
		$this->db->select("techId, concat(`firstName`, ' ', `lastName`) as Name", false);
		$this->db->order_by('Name');
		return $this->db->get("tech")->result_array();	
	}
	
	public function getTechName($id){
		$this->db->select("concat(`firstName`, ' ', `lastName`) as 'Name'", false);
		$this->db->where(array("techId" => $id));
		$result = $this->db->get("tech")->result_array();
		return $result[0]['Name'];
	}
	
	public function validate()
	{
		if($this->session->userdata("validated") == TRUE){
			redirect(home);
		}else{
			// grab user input
	        $techId = $this->security->xss_clean($this->input->post('techId'));
			
			$this->db->where('techId', $techId);
			$query = $this->db->get('tech');
			
			if( $query->num_rows() == 1 ){
				// If there is a user, then create session data
		        $row = $query->row();
				$this->set_name($row->firstName ." " .$row->lastName);
				$this->set_techId($row->techId); 
				$this->set_lastUpdate($row->lastUpdate);
				$this->set_validated(TRUE);
				return TRUE;		
			}
	
			return FALSE;
		}
	}
	
}