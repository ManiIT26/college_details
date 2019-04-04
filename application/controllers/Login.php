<?php
class Login Extends CI_Controller{

	function __construct(){

		parent:: __construct();

		/*$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');*/
		$this->load->model('LoginModel');
	}

	public function index(){

		

		if($this->session->userdata('user_name')){

			redirect(base_url().'index');
		}

		


		$data = '';

		if(isset($_POST['user_name'])){ 

			$data['usr_name'] = $_POST['user_name'];

			$data['usr_pass'] = $_POST['usr_password'];

			$usr_details =  $this->LoginModel->login($_POST);

			if(count($usr_details) == 1){

				$this->session->set_userdata('user_name',$usr_details[0]['username']);

				$this->session->set_userdata('user_type',$usr_details[0]['user_type']);

				$this->session->set_userdata('user_type_id',$usr_details[0]['user_type_id']); 

				$this->session->set_userdata('college_id',$usr_details[0]['college_id']); 

				redirect(base_url().'index');
			}
			else{
				$data['error'] = 'Username or Password is incorrect';
			}
		}
 
		$this->load->view('login',$data);  
		 
	}


	public function mobile_usr(){

		if(isset($_POST['user_name'])){ 

			$data['usr_name'] = $_POST['user_name'];

			$data['usr_pass'] = $_POST['usr_password'];

			$usr_details =  $this->LoginModel->login($_POST);

			if(count($usr_details) == 1){

				 print_r(json_encode($usr_details));
			}
			 
		}
	}
} 

?>