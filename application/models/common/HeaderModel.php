<?php
class HeaderModel Extends CI_Model{


	public function header(){
 
		  
		date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)


		if(!$this->session->userdata('user_name')){

			redirect(base_url().'login');
		} 

		$data = '';

		$this->db->where('college_id',$this->session->userdata('college_id'));
		$data['get_college'] = $this->db->get(COLLEGE_DETAILS)->row_array();

		$data['holiday'] = $this->holyday();
		$data['user'] = $this->common_staff_details->Get_usr_details();
		$data['leave_count'] = $this->common_staff_details->Get_leave_details();

	 

		$data['check_attd'] = $this->check_attendance();

		 
		$this->load->view('common/header',$data);
	}	

	public function check_attendance(){

		$curr_date = date('Y-m-d');

		$this->db->where('status',1);
		$this->db->where('college_id',$this->session->userdata('college_id'));
		$this->db->where('staff_id',$this->session->userdata('user_type_id'));
		$this->db->where('curr_date',$curr_date);
		$this->db->order_by('attd_id','DESC');
		$this->db->limit(1);
		$get_atted = $this->db->get(ATTENDANCE)->row_array();

	 
		return $get_atted;

		 
	}

	public function holyday(){

		$curr_date = date("Y-m-d");		 


		$this->db->where('status',1);
		$this->db->where('curr_date',$curr_date);
		$this->db->where('log','Logout');
		$this->db->where('college_id',$this->session->userdata('college_id'));
		$this->db->where('staff_id',$this->session->userdata('user_type_id'));	
		$attd = $this->db->get(ATTENDANCE)->num_rows();

		 
		return  $attd ;


	}

	 


}


	

?>