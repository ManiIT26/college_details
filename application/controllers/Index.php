<?php
class Index Extends CI_Controller{


	function __construct(){

		parent:: __construct();

		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('IndexModel');
	}

	public function index(){

		$data = '';


		$data['get_staff_notification'] = $this->IndexModel->get_staff_notification();
		$this->HeaderModel->header();
		if($this->session->userdata('user_type') == 'super_admin'){
			redirect(base_url().'leave_dashboard');
		}
		else{
			$this->load->view('index',$data);
		}
		
		$this->FooterModel->footer();
	}

	public function alter_staff_details(){

		$data = json_decode(file_get_contents('php://input'),true);

		$this->IndexModel->Alter_leave_staff($data);
	}
}


?>