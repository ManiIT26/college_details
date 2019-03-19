<?php
class Index Extends CI_Controller{


	function __construct(){

		parent:: __construct();

		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
	}

	public function index(){

		$this->HeaderModel->header();
		$this->load->view('index');
		$this->FooterModel->footer();
	}
}


?>