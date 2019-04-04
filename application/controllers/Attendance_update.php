<?php
class Attendance_update Extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Attendance_updateModel');
		 
	}

	public function index(){

		$data= '';	

		

		if(isset($_POST['staff_id'])){
			
			$data['staff_id']= $_POST['staff_id'];	
			$data['from_date']= $_POST['from_date'];	
			$data['to_date']= $_POST['to_date'];		

			$data['get_staff_details'] = $this->Attendance_updateModel->Attendance_upate($_POST['staff_id'],$_POST['from_date'],
			$_POST['to_date']);



		}

		if(isset($_POST['to_date_1'])){

				if(isset($_FILES['attachement']))
			{
				/*$filename = $_FILES['attachement']['name'];
                $extension = explode('.', $filename);
                $ext = end($extension);
                $tmpName  = $_FILES['attachement']['tmp_name'];
                $fileName = uniqid().".".$ext;  
                $path = 'assets/images/attendance_doc/'.$fileName; 
                move_uploaded_file($tmpName,$path);*/ 

			}

				$leave_date = $_POST['leave_date'];
				$date = date('Y-m-d');
				$leave_id = $_POST['leave_id_1'];

				
 
			$insert_array = array('staff_id'=>$_POST['staff_id_1'],'reason'=>$_POST['reason'],	
								'total_days'=>1,'leave_day_type'=>'FD','approve_status'=>3,'status'=>1,
								'alter_staff1_status'=>1,'alter_staff2_status'=>1,'apply_date'=>$date,
								'leave_day_type'=>$_POST['leave_day_type'],'leave_type'=>$_POST['leave_type_new'],'approve_type'=>$_POST['approve_type_1'],
								'report1'=>$_POST['reporting_1'],'report2'=>$_POST['reporting_2']);
		 	
			$this->Attendance_updateModel->Update_leave($insert_array,$leave_date,$fileName,$leave_id);
			
			//redirect(base_url().'Attendance_update');

		}	

		$this->HeaderModel->header();
		$this->load->view('attendence_update',$data);
		$this->FooterModel->footer();
	}

	public function getLeave_available(){

		$this->Attendance_updateModel->get_Leave_data($_POST);
	} 

}

?>