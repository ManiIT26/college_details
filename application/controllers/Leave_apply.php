<?php
class Leave_apply Extends CI_Controller{


	function __construct(){
		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Leave_applyModel');
		$this->load->model('Department_roleModel');
	}

	public function index(){

		
		$this->common_staff_details->Leave_notification();
		 

		if($this->session->userdata('user_type') != 'staff'){

			redirect(base_url().'access_denied');
		}

		$data = '';


		$data['view_reporting_person'] = $this->Leave_applyModel->view_reporting_person();

		$data['Dept_details'] = $this->Department_roleModel->Get_dept_details($this->session->userdata('college_id'));




		if(isset($_POST['leave_subject'])){
			 
			$staff_insert_array = array();

			if(isset($_POST['dept_staff1']) && $_POST['dept_staff1'] != ''){

				$alter_staff1 = $_POST['dept_staff1'];

				$dept_staff1_hrs = $_POST['dept_staff1_hrs']; 

				$staff_insert_array[] = array('college_id'=>$this->session->userdata('college_id'),'alter_staff'=>$alter_staff1,'alter_staff_type'=>1,'dept_staff_hrs'=>$dept_staff1_hrs,'total_approval'=>1);

				$alter_staff1_status = 0;

				$total_approval = 1;
			}
			else{
				$alter_staff1 = 0;			 
				
				$alter_staff1_status = 1;
				
				$total_approval = 0;
			}

			 

			if(isset($_POST['dept_staff2']) && $_POST['dept_staff2'] != ''){
				 
				$alter_staff2 = $_POST['dept_staff2'];

				$dept_staff2_hrs = $_POST['dept_staff2_hrs'];

				$alter_staff2_status = 0;

				
				$staff_insert_array[] = array('college_id'=>$this->session->userdata('college_id'),'alter_staff'=>$alter_staff2,'alter_staff_type'=>2,'dept_staff_hrs'=>$dept_staff2_hrs,'total_approval'=>1);
			}
			else{
				 
				$alter_staff2 = 0;

				$alter_staff2_status = 1;
				
				$total_approval = 0;
			} 

			$staff_insert_array[0]['total_approval'] = $total_approval;

			 


			if($_FILES['leave_attachment']['name'] != '')
			{
				$filename = $_FILES['leave_attachment']['name'];
				$file_type = $_FILES['leave_attachment']['type'];
				$file_size = $_FILES['leave_attachment']['size'];
                $extension = explode('.', $filename);
                $ext = end($extension);
                $tmpName  = $_FILES['leave_attachment']['tmp_name'];
                $fileName = uniqid().".".$ext; 

                $path = 'assets/images/attendance_doc/'.$fileName;  
                move_uploaded_file($tmpName,$path); 

			}
			else{
				$fileName = '';
				$file_type = '';
				$file_size = '';
			}

			$insert_array = array('staff_id'=>$this->session->userdata('user_type_id'),
				'apply_date'=>date('Y-m-d'),
				'leave_subject'=>$_POST['leave_subject'],
				'from_date'=>$_POST['from_date_leave'],
				'to_date'=>$_POST['to_date_leave'],
				'total_days'=>$_POST['leave_total'],
				'leave_type'=>$_POST['college_leave_type'],
				'leave_day_type'=>$_POST['leave_day_type'],
				'reason'=>$_POST['leave_reason'],				  
				'file_name'=>$fileName,
				'file_type'=>$file_type,
				'file_size'=>$file_size, 
				'alter_staff1_status'=>$alter_staff1_status,
				 'alter_staff2_status'=>$alter_staff2_status,
				'approve_status'=>1);

			 

			$this->Leave_applyModel->Leave_apply($insert_array,$staff_insert_array);
		    
			redirect(base_url().'leave_apply');
		}

		$this->HeaderModel->header();
		$this->load->view('leave_apply',$data);
		$this->FooterModel->footer();


	}

	public function Get_dept_staffs(){

		$data = json_decode(file_get_contents('php://input'));

		$Deprtment_staff = $this->Leave_applyModel->get_Deprtment_staff($data->dept_id);

		print_r(json_encode($Deprtment_staff));
		 
	}

	public function Event_calander(){

		 $this->load->view('event_calander');
	}

	public function Get_leave_details(){

		$this->Leave_applyModel->get_applied_leave();
	}

	public function getLeave_policy(){

		if($_POST){

			$data = $_POST;
		}	
		else{
			$data = json_decode(file_get_contents('php://input'),true);
 
		}
 
		$data = json_decode(file_get_contents('php://input'),true);

		$this->Leave_applyModel->get_Leave_policy($data);
	}

	public function cancel_leave(){

		$data = json_decode(file_get_contents('php://input'),true);

		$this->Leave_applyModel->Cancel_leave($data);
	}


	public function MobileLeave_apply(){

		if(isset($_POST['leave_subject'])){

			print_r($_POST);

			die();


			$staff_insert_array = array();

			if(isset($_POST['dept_staff1']) && $_POST['dept_staff1'] != ''){

				$alter_staff1 = $_POST['dept_staff1'];

				$dept_staff1_hrs = $_POST['dept_staff1_hrs']; 

				$staff_insert_array[] = array('college_id'=>$this->session->userdata('college_id'),'alter_staff'=>$alter_staff1,'alter_staff_type'=>1,'dept_staff_hrs'=>$dept_staff1_hrs,'total_approval'=>1);

				$alter_staff1_status = 0;

				$total_approval = 1;
			}
			else{
				$alter_staff1 = 0;			 
				
				$alter_staff1_status = 1;
				
				$total_approval = 0;
			}

			 

			if(isset($_POST['dept_staff2']) && $_POST['dept_staff2'] != ''){
				 
				$alter_staff2 = $_POST['dept_staff2'];

				$dept_staff2_hrs = $_POST['dept_staff2_hrs'];

				$alter_staff2_status = 0;

				
				$staff_insert_array[] = array('college_id'=>$this->session->userdata('college_id'),'alter_staff'=>$alter_staff2,'alter_staff_type'=>2,'dept_staff_hrs'=>$dept_staff2_hrs,'total_approval'=>1);
			}
			else{
				 
				$alter_staff2 = 0;

				$alter_staff2_status = 1;
				
				$total_approval = 0;
			} 

			$staff_insert_array[0]['total_approval'] = $total_approval;

			 


			if($_FILES['leave_attachment']['name'] != '')
			{
				$filename = $_FILES['leave_attachment']['name'];
				$file_type = $_FILES['leave_attachment']['type'];
				$file_size = $_FILES['leave_attachment']['size'];
                $extension = explode('.', $filename);
                $ext = end($extension);
                $tmpName  = $_FILES['leave_attachment']['tmp_name'];
                $fileName = uniqid().".".$ext; 

                $path = 'assets/images/attendance_doc/'.$fileName;  
                move_uploaded_file($tmpName,$path); 

			}
			else{
				$fileName = '';
				$file_type = '';
				$file_size = '';
			}

			$insert_array = array('staff_id'=>$this->session->userdata('user_type_id'),
				'apply_date'=>date('Y-m-d'),
				'leave_subject'=>$_POST['leave_subject'],
				'from_date'=>$_POST['from_date_leave'],
				'to_date'=>$_POST['to_date_leave'],
				'total_days'=>$_POST['leave_total'],
				'leave_type'=>$_POST['college_leave_type'],
				'leave_day_type'=>$_POST['leave_day_type'],
				'reason'=>$_POST['leave_reason'],				  
				'file_name'=>$fileName,
				'file_type'=>$file_type,
				'file_size'=>$file_size, 
				'alter_staff1_status'=>$alter_staff1_status,
				 'alter_staff2_status'=>$alter_staff2_status,
				'approve_status'=>1);

			 

			$this->Leave_applyModel->Leave_apply($insert_array,$staff_insert_array);
		    
			//redirect(base_url().'leave_apply');
		}

	}
}

?>