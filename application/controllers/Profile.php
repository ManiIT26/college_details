<?php
class Profile Extends CI_Controller{


	function __construct(){

		parent:: __construct();

		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
	}

	public function index(){

		if($this->session->userdata('user_type') != 'staff'){

			redirect(base_url().'access_denied');
		}

		$this->HeaderModel->header();
		$this->load->view('profile');
		$this->FooterModel->footer();
	}
}


?>