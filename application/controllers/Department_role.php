<?php
class Department_role Extends CI_Controller{

	function __construct(){

		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Department_roleModel');
	}

	public function index(){

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

		$data = '';

		$data['get_college_details'] = $this->Department_roleModel->getCollege_details();

		$this->HeaderModel->header();
		$this->load->view('Department_role',$data);
		$this->FooterModel->footer();
	}

	public function Get_dept_details(){

		$this->Department_roleModel->Get_dept_details();
	}

	 

	public function delete_dept_details(){

		$data = json_decode(file_get_contents('php://input'));

		$this->Department_roleModel->delete_dept_details($data->dept_id);

	} 

	public function Get_role_details(){

		$this->Department_roleModel->Get_role_details();
	}

	public function delete_role_details(){

		$data = json_decode(file_get_contents('php://input'));

		$this->Department_roleModel->delete_role_details($data->role_id);

	}

}

?>