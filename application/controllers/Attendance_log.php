<?php
class Attendance_log  Extends CI_Controller{


	function __construct(){

		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Attendance_logModel');
		$this->load->model('Department_roleModel');
		 
	}

	public function index(){


		/*$real_variable = 'test'; 
		$name = 'real_variable';
		$name_of_name = 'name';
		 

		print_r($$$name_of_name);*/

		if($this->session->userdata('user_type') == 'staff'){

			redirect(base_url().'access_denied');
		}
		$data = '';

		$data['get_college_details'] = $this->Department_roleModel->getCollege_details();

		if(isset($_POST['college_name'])){

			$data['from_date'] = $_POST['from_date_log'];

			$data['to_date'] = $_POST['to_date_log'];

			$this->Attendance_logModel->GEt_attd_log($_POST);

			
		}

		

		$this->HeaderModel->header();
		$this->load->view('attendance_log',$data);
		$this->FooterModel->footer();



	}

	 
}

?>