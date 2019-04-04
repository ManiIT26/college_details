<?php
class Holiday_event Extends CI_Controller{

	function __construct(){ 

		parent:: __construct();
		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel'); 
		$this->load->model('Holiday_eventModel');
	}

	public function index(){

		

		if($this->session->userdata('user_type') != 'college_admin'){

			redirect(base_url().'access_denied');
		}

		$data = '';

		$get_month = (isset($_GET["month"])) ? $_GET['month'] : date('m');
        $get_year = (isset($_GET["year"])) ? $_GET['year'] : date('Y');

		if(isset($_POST['event_check_box'])){

			


			$event_details = array();

			for($i=0; $i<count($_POST['event_check_box']); $i++){

				 
				 	$get_key = array_search($_POST['event_check_box'][$i],$_POST['event_date']);

				 	if($_POST['event_name'][$get_key] == ''){

				 		$event_name = '';
				 	}
				 	else{
				 		$event_name = strtoupper($_POST['event_name'][$get_key]);
				 	}

				 
				 	/*for($a=0; $a<count($_POST['attd_role_type']); $a++){*/



				 	$this->db->where('month',date('Y-m', strtotime($_POST['event_date'][$get_key])));
				 	$this->db->where('college_id',$this->session->userdata('college_id'));
				 	//$this->db->where('staff_atten_type !=',$_POST['attd_role_type'][$a]);
				 	$this->db->delete(HOLIDAY_EVENT_FIX);

				 	/*}*/

		

				 	 $event_details[] = array('college_id'=>$this->session->userdata('college_id'),'holiday_name'=>$event_name,'holiday_date'=>$_POST['event_date'][$get_key],'holiday_category'=>'GH','month'=>date('Y-m', strtotime($_POST['event_date'][$get_key])));
 				
			}
				
			 
			$this->Holiday_eventModel->Insert_Events($event_details,$_POST['attd_role_type']); 
 			redirect(base_url().'holiday_event?month='.$get_month.'&year='.$get_year);
		}

		$this->HeaderModel->header();
		$this->load->view('holiday_event',$data);
		$this->FooterModel->footer();
	}
}

?>