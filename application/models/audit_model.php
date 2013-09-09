<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audit_model extends CI_Model {

  	function __construct(){
        parent::__construct();
    }
	
	public function getAudit($techId){
		$this->db->where(array("closedBy" => $techId));
		$query = $this->db->get("audit");
		return $query->result_array();
		
	}
	
	public function addEntry($type, $jobId, $data = array()){
		unset($data['id']);
		$data['action'] = $type;
		$data['jobId'] = $jobId;
		$this->db->insert('audit', $data);
	}
	
}