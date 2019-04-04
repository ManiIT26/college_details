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

	public function Insert_Email($email_id){

		$this->db->insert(COMMON_MAIL,$email_id);
	}

	 public function Get_dept_details($college_id){

	 	if($this->session->userdata('user_type') != 'super_admin'){
	 		$this->db->where('d.college_id',$college_id);
	 	}
	 	else if($college_id != 0){
	 		$this->db->where('d.college_id',$college_id);
	 	}

	 	$this->db->where('d.status',1); 
	 	$this->db->where('c.status',1);
	 	$this->db->from(''.DEPARTMENT.' as d');
	 	$this->db->join(' '.COLLEGE_DETAILS.' as c','d.college_id = c.college_id','INNER');
	 	$select_dept = $this->db->get()->result_array();

	 	return $select_dept;
	 }

	 public function delete_dept_details($dept_id){

	 	$up_array = array('status'=>0);

	 	$this->db->where('department_id',$dept_id);
	 	$this->db->update(DEPARTMENT,$up_array);
	 }

	 public function Insert_Role($role_details){

	 	$this->db->insert(ROLE,$role_details);
	 }

	 public function Insert_Holiday($holiday){

	 	$this->db->insert(HOLIDAY_EVENT_FIX,$holiday);
	 }


	 public function Get_role_details($college_id){

	 	if($this->session->userdata('user_type') != 'super_admin'){
	 		$this->db->where('r.college_id',$college_id);
	 	}
	 	else if($college_id != 0){
	 		$this->db->where('r.college_id',$college_id);
	 	}
	 	$this->db->where('r.status',1); 
	 	$this->db->where('c.status',1);
	 	$this->db->from(''.ROLE.' as r');
	 	$this->db->join(' '.COLLEGE_DETAILS.' as c','r.college_id = c.college_id','INNER');
	 	$this->db->order_by('r.role_id','desc'); 
	 	$select_role = $this->db->get()->result_array();

	 	return $select_role;

	 	//print_r(json_encode($select_role));
	 }

	  public function Get_holiday_details($college_id){

	 	if($this->session->userdata('user_type') != 'super_admin'){
	 		$this->db->where('h.college_id',$college_id);
	 	}
	 	else if($college_id != 0){
	 		$this->db->where('h.college_id',$college_id);
	 	}
	 	$this->db->where('h.status',1); 
	 	$this->db->where('c.status',1);
	 	$this->db->from(''.HOLIDAY_EVENT_FIX.' as h');
	 	$this->db->join(' '.COLLEGE_DETAILS.' as c','h.college_id = c.college_id','INNER');
	 	$this->db->order_by('h.holiday_date','ASC');
	 	$select_holiday = $this->db->get()->result_array();

	 	return $select_holiday;

	 	//print_r(json_encode($select_role));
	 }

	 public function Get_email_details(){


	 	$this->db->from(''.COMMON_MAIL.' as a');
	 	$this->db->order_by('a.mail_id','ASC');
	 	$select_email = $this->db->get()->result_array();

	 	return $select_email;

	 }

	  public function delete_role_details($role_id){

	 	$up_array = array('status'=>0); 

	 	$this->db->where('role_id',$role_id);
	 	$this->db->update(ROLE,$up_array);
	 }

	 public function delete_holiday_details($h_id){

	 	$up_array = array('status'=>0); 

	 	$this->db->where('holiday_event_id',$h_id);
	 	$this->db->update(HOLIDAY_EVENT_FIX,$up_array);
	 }

	 public function delete_email_details($mail){

	 	
		$this->db->where('mail_id',$mail);
	 	$this->db->delete(COMMON_MAIL);
	 }
}

?>