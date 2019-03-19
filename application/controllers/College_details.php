<?php
class College_details Extends CI_Controller{

	function __construct(){

		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('College_detailsModel');
	}

	public function index(){

		if(isset($_POST['college_name'])){

			if(isset($_POST['college_id'])){
				$_POST['college_id'] = $_POST['college_id'];
			}
			else{
				$_POST['college_id'] = '';
			}

			$insert_array = array('college_name'=>strtoupper($_POST['college_name']),'college_addr'=>$_POST['colleg_addr'],'college_latitude'=>$_POST['college_latitude'],'college_longitude'=>$_POST['college_longitude']);
		
			$this->College_detailsModel->Insert_college_details($insert_array,$_POST['college_id']);

			redirect(base_url().'college_details');
		}

		$this->HeaderModel->header();
		$this->load->view('college_details');
		$this->FooterModel->footer();
	}

	public function Get_college_details(){

		$this->College_detailsModel->getCollege_details();
	}

	public function edit_college_details(){

		$data = json_decode(file_get_contents('php://input'));

		$this->College_detailsModel->edit_college_details($data->college_id);
	}

	public function delete_college_details(){

		$data = json_decode(file_get_contents('php://input'));

		$this->College_detailsModel->delete_college_details($data->college_id);

	}

}

?>