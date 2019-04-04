<?php
class Approve_leave Extends CI_Controller{


	function __construct(){

		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Approve_leaveModel');
		 
	}

	public function index(){

		$usr_details = $this->common_staff_details->Get_usr_details();
		
		

		$usr_view_approve_req = $this->common_staff_details->View_approve_req();
 
	 
		if($this->session->userdata('user_type') == 'staff' && $usr_view_approve_req != 0){
			 
			
		}
		else{
			redirect(base_url().'access_denied');
		}


		
		//$get_leave_req = $this->common_staff_details->get_leave_req(); 

		$data = '';

		$this->HeaderModel->header();
		$this->load->view('approve_leave',$data);
		$this->FooterModel->footer();
	}

	public function Get_req_list(){

		$data = json_decode(file_get_contents('php://input')); 

		$get_leave_req = $this->common_staff_details->get_leave_req($data->level_type);
		
		print_r(json_encode($get_leave_req));

		
	}

	public function Approve_leave_req(){

		$data = json_decode(file_get_contents('php://input'),true);

		$this->Approve_leaveModel->Approve_leave_req($data);
	}

	public function Reject_leave_req(){

		$data = json_decode(file_get_contents('php://input'),true);

		$this->Approve_leaveModel->Reject_leave_req($data);
	}

	public function get_leave_policy_details(){

		$data = json_decode(file_get_contents('php://input'));

		$this->Approve_leaveModel->Get_staff_details($data->emp_leave_id);
	}
}

?>