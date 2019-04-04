<?php
class Attendance_time_duration  Extends CI_Controller{


	function __construct(){

		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Attendance_time_durationModel');
		$this->load->model('Department_roleModel');
		 
	}

	public function index(){


	 

		if($this->session->userdata('user_type') == 'staff'){

			redirect(base_url().'access_denied');
		}
		$data = '';

		$data['get_college_details'] = $this->Department_roleModel->getCollege_details();

		if(isset($_POST['college_name'])){

			$data['from_date'] = $_POST['from_date_log']; 

			$data['college_name'] = $_POST['college_name']; 

			$this->Attendance_time_durationModel->GEt_attd_log($_POST);

			
		}

		

		$this->HeaderModel->header();
		$this->load->view('attendance_time_duration',$data);
		$this->FooterModel->footer();



	}

	 
}

?>