<?php
class Holiday_eventModel Extends CI_Model{

	public function Insert_Events($data,$attd_role_type){

		for($a=0; $a<count($attd_role_type); $a++){
 
			$insert_data = array();	
			//print_r($attd_role_type[$a]);

			foreach ($data as $key => $datas) {
				
				$insert_data[] = $datas + array('staff_atten_type	'=>$attd_role_type[$a]);
			}
				
		$this->db->insert_batch(HOLIDAY_EVENT_FIX,$insert_data);
		}

		 
	}
}

?>