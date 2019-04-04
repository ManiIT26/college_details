<?php
class Leave_update Extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Leave_updateModel');
		 
	}

	public function index(){

		$data= '';	



		if(isset($_POST['staff_id'])){
			
			$data['staff_id']= $_POST['staff_id'];	
				

			$data['get_staff_details'] = $this->Leave_updateModel->Leave_upate($_POST['staff_id']);



		}

		if(isset($_POST['leave_id_1'])){

			$leave_id = $_POST['leave_id_1'];
			

			$insert_array = array('ccl_total'=>$_POST['ccl_total_1'],	
								'cl_total'=>$_POST['cl_total_1']);
		 	
			$this->Leave_updateModel->Update_leave($insert_array,$leave_id);
			
			//redirect(base_url().'Leave_upate');

		}	

		$this->HeaderModel->header();
		$this->load->view('leave_update',$data);
		$this->FooterModel->footer();
	}

	

}

?>