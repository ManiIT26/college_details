<?php
class Staff_details Extends CI_Controller{


	function __construct(){

		parent:: __construct();

		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Department_roleModel');
		$this->load->model('Staff_detailsModel');
	}

	public function index(){

		$usr_details = $this->common_staff_details->Get_usr_details();

		//print_r($usr_details);

		if($this->session->userdata('user_type') != 'college_admin'){

			redirect(base_url().'access_denied'); 
		}

		if(isset($_POST['college_name'])){

			 


			if(isset($_FILES['file']))
			{
				$filename = $_FILES['file']['name'];
                $extension = explode('.', $filename);
                $ext = end($extension);
                $tmpName  = $_FILES['file']['tmp_name'];
                $fileName = uniqid().".".$ext;  
                $path = 'assets/images/staff_profile/'.$fileName; 
                move_uploaded_file($tmpName,$path); 

			}

			if($_POST['clg_department'] == '')
			{
				$_POST['clg_department'] = 0;
			}

			if($_POST['staff_type'] == 1){
				$approve_type = 1;
			}
			else{
				$approve_type = $_POST['approve_type'];
			}


			 

			if($_POST['reporting_person2_role'] != ''){ 
				$reporting_2 = explode('-', $_POST['reporting_person2_role'])[0];
			}
			else{
				$reporting_2 = 0;
			}

 
			 $insert_array = array('college_id'=>$_POST['college_name'],'department_id'=>$_POST['clg_department'],'role_id'=>$_POST['role'],
		 	'firstname'=>strtoupper($_POST['firstname']),'lastname'=>strtoupper($_POST['lastname']),'dob'=>$_POST['dob'],'gender'=>$_POST['gender'],'mobile_number'=>$_POST['mobile_number'],
		 	'approve_type'=>$approve_type,'email_id'=>$_POST['email_id'],'address'=>$_POST['address'],'staff_id'=>$_POST['staff_id'],'profile_image'=>$fileName,'staff_type'=>$_POST['staff_type'],
		 	'staff_attendance_type'=>$_POST['attendance_type'],'reporting_person1_role'=>explode('-', $_POST['reporting_person1_role'])[0],'reporting_person2_role'=>$reporting_2);

		 	$password = $_POST['confrim_password'];
		 	$s_id = $_POST['s_id'];  

		 	 $this->Staff_detailsModel->Insert_staff($insert_array,$password,$s_id);

			redirect(base_url().'Staff_details');
		}


		$data = '';

		$data['get_college_details'] = $this->Department_roleModel->getCollege_details();


		$this->HeaderModel->header();
		$this->load->view('staff_details',$data);
		$this->FooterModel->footer();
	}

	public function Get_dept_roles(){

		$data = json_decode(file_get_contents('php://input'),true);

		$college_id = $data['college_id'];

		$dept = $this->Department_roleModel->Get_dept_details($college_id);

		$role = $this->Department_roleModel->Get_role_details($college_id);
		
		$common_array = array('dept'=>$dept,'role'=>$role); 

		print_r(json_encode($common_array));

	}

	public function Get_staff_details(){

		
		$dept = $this->Staff_detailsModel->Get_staff_details();

		print_r(json_encode($dept));

	}

	public function edit_staff_details(){

		$data = json_decode(file_get_contents('php://input'));

		$this->Staff_detailsModel->edit_staff_details($data->s_id);
	}

	public function delete_staff_details(){

		$data = json_decode(file_get_contents('php://input'));

		 $this->Staff_detailsModel->delete_staff_details($data->s_id);
		

	} 

	public function Insert_attd(){

		if($_POST){

			$this->Staff_detailsModel->Insert_attd($_POST);
		}
	}

	public function Get_reporting_person(){

		$data = json_decode(file_get_contents('php://input'));

		$reporting_person = $this->Staff_detailsModel->Get_reportingPerson($data->reporting_person);

		print_r(json_encode($reporting_person));
	}


	public function update_staff(){

		if($_POST){



		$update_array = array('mobile_number'=>$_POST['mobile_number'],'address'=>$_POST['address'],
		'firstname'=>$_POST['fname'],'lastname'=>$_POST['lname'],'dob'=>$_POST['dob'],'gender'=>$_POST['gender'],'email_id'=>$_POST['email_id']);	
		$staff_id= $_POST['staff_id'];
		$this->Staff_detailsModel->update_staff($update_array,$staff_id);

		}
	}
}


?>