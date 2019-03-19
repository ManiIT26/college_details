<?php
class Department_roleModel Extends CI_Model{


	public function getCollege_details(){

		$this->db->where('status',1);
		$college_data = $this->db->get(COLLEGE_DETAILS)->result_array();

		return $college_data;
	}

	public function Insert_Department($dept_details){

		$this->db->insert(DEPARTMENT,$dept_details);
	}

	 public function Get_dept_details(){

	 	$this->db->where('d.status',1); 
	 	$this->db->where('c.status',1);
	 	$this->db->from(''.DEPARTMENT.' as d');
	 	$this->db->join(' '.COLLEGE_DETAILS.' as c','d.college_id = c.college_id','INNER');
	 	$select_dept = $this->db->get()->result_array();

	 	print_r(json_encode($select_dept));
	 }

	 public function delete_dept_details($dept_id){

	 	$up_array = array('status'=>0);

	 	$this->db->where('department_id',$dept_id);
	 	$this->db->update(DEPARTMENT,$up_array);
	 }

	 public function Insert_Role($role_details){

	 	$this->db->insert(ROLE,$role_details);
	 }


	 public function Get_role_details(){
	 	$this->db->where('r.status',1); 
	 	$this->db->where('c.status',1);
	 	$this->db->from(''.ROLE.' as r');
	 	$this->db->join(' '.COLLEGE_DETAILS.' as c','r.college_id = c.college_id','INNER');
	 	$select_role = $this->db->get()->result_array();

	 	print_r(json_encode($select_role));
	 }

	  public function delete_role_details($role_id){

	 	$up_array = array('status'=>0); 

	 	$this->db->where('role_id',$role_id);
	 	$this->db->update(ROLE,$up_array);
	 }
}

?>