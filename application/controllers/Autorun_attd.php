<?php
class Autorun_attd Extends CI_Controller{

	function __construct(){
		parent:: __construct();

		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		 
	}

	public function index(){

			$loc = @unserialize (file_get_contents('http://ip-api.com/php/'));
		
			$loc['lon'] = ($loc['lon'])?$loc['lon']:'';

			$loc['lat'] = ($loc['lat'])?$loc['lat']:''; 

			$loc['city'] = ($loc['city'])?$loc['city']:'';

			echo 'lon : '.$loc['lon'].' lat : '.$loc['lat'].' city : '.$loc['city'];

		//$this->common_staff_details->Autorun_Attd();

	}
}

?>