<?php
class Attendance_time_durationModel Extends CI_Model{

	public function GEt_attd_log($data){



		$select_all_clg_staffs = $this->db->where('s.status',1)
		->where('s.college_id',$data['college_name'])
		->order_by('s.s_id','ASC')
		->from(''.STAFF_DETAILS.' as s') 
		->join(''.COLLEGE_DETAILS.' as c','s.college_id = c.college_id','INNER')
		/*->join(''.DEPARTMENT.' as d','s.department_id = d.department_id','INNER')*/
		->join(''.ROLE.' as r','s.role_id = r.role_id','INNER')
		->get()->result_array();
 
		$staff_details = array();
		
		foreach($select_all_clg_staffs as $staffs){	

			$this->db->where('status',1);
		 	$this->db->where('college_id',$data['college_name']);
		 	$this->db->where('staff_id',$staffs['staff_id']);
		 	$this->db->where('curr_date',$data['from_date_log']);
		 	$this->db->order_by('attd_id','ASC'); 
		 	$get_attd_log = $this->db->get(ATTENDANCE)->result_array();

		 	if(count($get_attd_log) != 0){

		 		//print_r($get_attd_log);


		 		$lst_rec_key = count($get_attd_log) - 1;

		 		$lst_rec_created_time = 'Invalid Logout';

		 		$fst_rec_created_time = 'Invalid Login';

		 		$lst_diff = '-';

		 		$location = '-';

		 		if($get_attd_log[0]['log_shot_code'] == 'P'){

		 			$fst_rec_created_time = date('H:i:s', strtotime($get_attd_log[0]['created_on'])); 

		 			$location = $get_attd_log[0]['place'];

		 		} 

		 		if($get_attd_log[$lst_rec_key]['log_shot_code'] == 'L'){

		 			$lst_rec_created_time = date('H:i:s', strtotime($get_attd_log[$lst_rec_key]['created_on'])); 

		 		}

		 		if($fst_rec_created_time != '' && $lst_rec_created_time != 'Invalid Logout'){
 
		 			$lst_diff = $this->get_time_difference($fst_rec_created_time,$lst_rec_created_time);  

		 			$lst_diff = round($lst_diff,2).' Hrs';
		 		}

		 		$timing_array = array( 'staff_id'=>$staffs['staff_id'],'staff_name'=>$staffs['firstname'].' '.$staffs['lastname'] ,'role'=>$staffs['role'],
		 			'login_time'=>$fst_rec_created_time,'logout_time'=>$lst_rec_created_time,'diff'=>$lst_diff,'login_loc'=>$location);  

		 		$staff_details[] =  $timing_array; 
		 	}
		 	else{
		 		$timing_array = array( 'staff_id'=>$staffs['staff_id'],'staff_name'=>$staffs['firstname'].' '.$staffs['lastname'],'role'=>$staffs['role'],'login_time'=>'-','logout_time'=>'-','diff'=>'-','login_loc'=>'-');  

		 		$staff_details[] =  $timing_array;
		 	} 
		}

		//print_r($staff_details);

		$download_csv = $this->download_csv($staff_details,$data['from_date_log']); 
	}

	public function download_csv($staff_details,$month){

	 
       
		   $filename = 'users_'.$month.'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   
		   // get data 
		   $usersData = $staff_details;

		   // file creation 
		   $file = fopen('php://output', 'w');
		 
		   $header = array("Staff ID","Staffname","Role","Login Time","Logout Time","Total Hrs","Location"); 
		   fputcsv($file, $header);
		   foreach ($usersData as $key=>$line){ 
		     fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	} 


	public function get_time_difference($time1, $time2){
		$time1 = strtotime("1/1/1980 $time1");
		$time2 = strtotime("1/1/1980 $time2");

		if ($time2 < $time1)
		{
			$time2 = $time2 + 86400;
		}

		return ($time2 - $time1) / 3600;

	}

	

	 

}

?>