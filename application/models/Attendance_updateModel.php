<?php
class Attendance_updateModel Extends CI_Model{

		public function Attendance_upate($staff_id,$from_date,$to_date)
		{


		
					
				$this->db->from(''.STAFF_LEAVE.' as sl');
				$this->db->select('s.firstname,s.lastname,sl.apply_date,sl.from_date,sl.to_date,sl.total_days,sl.leave_type,
					sl.leave_day_type,sl.reason,sl.staff_id,s.approve_type,s.reporting_person1_role,s.reporting_person2_role,sl.emp_leave_id');
				$this->db->where('sl.from_date',$from_date);
				$this->db->where('sl.to_date',$to_date);
				$this->db->join(''.STAFF_DETAILS.' as s','s.staff_id = sl.staff_id' ,'INNER');
				$this->db->where('sl.staff_id',$staff_id);
				$get_staff_leave = $this->db->get()->result_array(); 

			return $get_staff_leave;					

		}

		public function get_Leave_data($data){



		$fromdate = $data['from_date'];
		$todate = $data['to_date'];
		$s_id = $data['s_id'];
		$attach_from_date = $data['attach_from_date'];
		$attach_to_date = $data['attach_to_date'];


		

		$all_dates = array();

		for ($i=strtotime($fromdate); $i<=strtotime($todate); $i+=86400) {  
		    $all_dates[] = date("Y-m-d", $i);  
		} 

		 
		$this->db->select('curr_date');
	 	$this->db->where('status',1);
	 	$this->db->where('staff_id',$s_id);
	 	$this->db->where('log_shot_code','P');
	 	$this->db->where("DATE(curr_date) IN ('".implode("','", $all_dates)."')");
	 	//$this->db->where("'DATE(curr_date)' NOT BETWEEN '".$attach_from_date."' AND '".$attach_to_date."' ");
	 	$get_leave = $this->db->get(ATTENDANCE)->result_array();

			//print_r($this->db->last_query());



		 print_r(json_encode($get_leave));
	 	
}

	public function Update_leave($data,$leave_data,$filename,$leave_id)
	{


		print_r($leave_data);
		die();

		if(isset($filename))
		{
			$insert_array = array('staff_id'=>$data['staff_id'],'attachment'=>$filename,'leave_id'=>$leave_id);

			$this->db->insert(ATTACHMENT,$insert_array);
		}

		foreach ($leave_data as $key => $leave) {

			$staff_leave = array('from_date'=>$leave,'to_date'=>$leave);

			$up_array = $data + $staff_leave;
			
			$this->db->insert(STAFF_LEAVE,$up_array);

		}
		
			

	}

}
?>