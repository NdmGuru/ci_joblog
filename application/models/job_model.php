<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_model extends CI_Model {

  	function __construct(){
        parent::__construct();
		$this->load->model('audit_model');
    }

	public function getJobs(){
		$this->db->select('	id as "Id",
							customer as "Cust", 
							start as "Start", 
							end as "End"
						 ');
						 
		$this->db->order_by("id","DESC");
		return $this->db->get_where('job', array('closedBy' => $this->user_model->get_techId()))->result_array();
	}
	
	public function addJob($job){
		$this->db->insert('job', $job);
		if($this->db->insert_id()){
			$this->audit_model->addEntry("Add", $this->db->insert_id(), $job);
			return true;
		}
		return false;
	}	
	
	public function update($data,$jobid){
		$this->db->where('id',$jobid);
		$this->db->update("job",$data);
		if($this->db->affected_rows() == 1){
			$this->audit_model->addEntry("Edit", $jobid, $data);
			return true;	
		}
		return false;
	}
	
	public function get($job){
		$query = $this->db->get_where('job',array("Id" => $job));
		if($query->num_rows() == 1){
			$result = $query->result_array();
			return $result[0];
		}
		return false;
	}
	
	public function delete($id){
		if($this->get($id)){
			$data = $this->get($id);
			$this->audit_model->addEntry("Delete", $id, $data);
			$this->db->delete('job', array("id" => $id));
			return true;
		}		
		return false;
	}
}