<?php
class Leave_dashboard Extends CI_Controller{


	function __construct(){

		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Leave_dashboardModel');
	}

	public function index(){		
		$data = array();
		$data['college'] = $this->Leave_dashboardModel->getCollege_details();
		$data['leave'] = $this->Leave_dashboardModel->get_applied_leave_by_college();


		
		

		if($_GET && $_GET['leave_date'] != ''){
			$leave_date = date('Y-m-d', strtotime($_GET['leave_date']));
		}
		else{
			$leave_date = date('Y-m-d');
		}
		
		$data['leave_apply'] = $this->Leave_dashboardModel->get_applied_leave_by_staff($leave_date);

		$data['total_hrs'] = $this->Leave_dashboardModel->Totalhours($leave_date);
 
		$data['get_datewise_rec'] = $this->Leave_dashboardModel->GetAllRec($leave_date);

		$data['staff_details'] = $this->Leave_dashboardModel->GetAllLeaves($leave_date);


		

		//print_r($data);
		$this->HeaderModel->header();
		$this->load->view('leave_dashboard',$data);
		$this->FooterModel->footer();
	}
	public function alter_staff_details(){
		//$data = json_decode(file_get_contents('php://input'),true);
		//$this->Leave_dashboardModel->Alter_leave_staff($data);
	}

	public function getCollege_leaves(){
		
		if($_POST){


			$leave_date = date('Y-m-d', strtotime($_POST['click_date']));

			$this->Leave_dashboardModel->GetAllLeaves($leave_date);
		}
	}
}


?>