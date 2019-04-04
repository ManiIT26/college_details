<?php
class Change_password Extends CI_Controller{


	function __construct(){

		parent:: __construct();

		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('IndexModel');
	}

	public function index(){

		if(isset($_POST['confirm_password']))
		{

			$update_pass = array('password'=>md5($_POST['confirm_password']));

			$msg =  $this->IndexModel->Change_password($update_pass,$_POST['old_password']);

			if($msg == 'error'){
				echo '<script>alert("Old Password Not Matched");</script>';
			}
			else{
				echo '<script>alert("Password Successfully Updated..!"); window.location.replace("change_password");
 </script>';
				//redirect(base_url().'change_password');
			}

		}

			  	

		$this->HeaderModel->header();
		$this->load->view('change_password');
		$this->FooterModel->footer();
	}

	
}


?>