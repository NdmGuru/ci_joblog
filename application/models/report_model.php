<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {

  	function __construct(){
        parent::__construct();
    }
	
	public function getManagers(){
		return $this->db->order_by('state')->get('manager')->result_array();	
	}
	
	public function getEmail($state){
		return $this->db->get_where('manager',array("state"=>$state))->result_array();
	}
	
	public function reportJobs($state){
		$this->db->select("	concat(tech.firstName,' ',tech.lastname) as ClosedBy,
							job.customer,
        					job.start,
        					job.end
							",false);
		$this->db->join('manager', 'manager.state = tech.state', 'inner');
		$this->db->join('job', 'job.closedBy = tech.techId', 'inner');
		$this->db->where("manager.state",$state);
		return $this->db->get('tech')->result_array();
	}
	
	public function reportHours($state){
		$this->db->select("	tech.techId,
       						concat(tech.firstName,' ',tech.lastname) as ClosedBy,
       						round(time_to_sec(sum(timediff(job.end, job.start))) / 3600,2) as 'Hours'
							",false);
		$this->db->join('manager', 'manager.state = tech.state', 'inner');
		$this->db->join('job', 'job.closedBy = tech.techId', 'inner');
		$this->db->where("manager.state",$state);
		$this->db->group_by("closedBy");
		return $this->db->get('tech')->result_array();
	}
	
}