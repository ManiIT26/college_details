<?php
class Department_role Extends CI_Controller{

	function __construct(){

		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Department_roleModel');
	}

	public function index(){

		if($this->session->userdata('user_type') != 'college_admin'){

			redirect(base_url().'access_denied'); 
		}

		if(isset($_POST['college_name'])){

		 	$insert_array = array('college_id'=>$_POST['college_name'],'department_name'=>strtoupper($_POST['clg_department']));
			$this->Department_roleModel->Insert_Department($insert_array);
			redirect(base_url().'Department_role');
		}


		if(isset($_POST['college_name_role'])){

			$insert_array_role = array('college_id'=>$_POST['college_name_role'],'role'=>strtoupper($_POST['clg_role']));

			$this->Department_roleModel->Insert_Role($insert_array_role);

			redirect(base_url().'Department_role');

		}

		if(isset($_POST['college_name_holiday'])){

			$insert_array_holiday = array('college_id'=>$_POST['college_name_holiday'],

			'holiday_date'=>$_POST['h_date'],'holiday_name'=>$_POST['holiday'],'holiday_category'=>'GH');

			$this->Department_roleModel->Insert_Holiday($insert_array_holiday);

			redirect(base_url().'Department_role');

		}
		if(isset($_POST['email_id'])){

			$insert_array_email = array('email_id'=>$_POST['email_id']);

			$this->Department_roleModel->Insert_Email($insert_array_email);

			redirect(base_url().'Department_role');

		}


		$data = '';

		$data['get_college_details'] = $this->Department_roleModel->getCollege_details();
		$data['get_email_details'] = $this->Department_roleModel->Get_email_details();

		$this->HeaderModel->header();
		$this->load->view('Department_role',$data);
		$this->FooterModel->footer();
	}

	public function Get_dept_details(){
		
		

		$select_dept = $this->Department_roleModel->Get_dept_details($this->session->userdata('college_id'));

		print_r(json_encode($select_dept));
	}

	 

	public function delete_dept_details(){

		$data = json_decode(file_get_contents('php://input'));

		$this->Department_roleModel->delete_dept_details($data->dept_id);

	} 

	public function Get_role_details(){

		$select_role = $this->Department_roleModel->Get_role_details($this->session->userdata('college_id'));

		print_r(json_encode($select_role));
	}

	public function delete_role_details(){

		$data = json_decode(file_get_contents('php://input'));

		$this->Department_roleModel->delete_role_details($data->role_id);

	}

	public function Get_holiday_details(){

		$select_role = $this->Department_roleModel->Get_holiday_details($this->session->userdata('college_id'));

		print_r(json_encode($select_role));
	}

	public function delete_holiday_details(){

		$data = json_decode(file_get_contents('php://input'));

		$this->Department_roleModel->delete_holiday_details($data->holiday_event_id);

	}

	public function Get_email_details(){

		$get_email = $this->Department_roleModel->Get_email_details();

		print_r(json_encode($get_email));
	}

	public function delete_email_details(){

		$data = json_decode(file_get_contents('php://input'));

		$this->Department_roleModel->delete_email_details($data->mail_id);

	}

}

?>