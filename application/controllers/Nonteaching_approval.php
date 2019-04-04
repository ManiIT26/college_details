<?php
class Nonteaching_approval Extends CI_Controller{


	function __construct(){

		parent:: __construct();

		$this->load->model('Nonteching_approvalModel');

		
	}

	public function index(){

		

		if(isset($_GET)){ 
			
			$update_array = array('staff_id'=>$_GET['staff_id'],'status'=>$_GET['status']); 

			$this->Nonteching_approvalModel->Leave_approval($update_array,$_GET['leave_id']);

			
		}

		
		//$this->load->view('index');
		
	}
}


?>