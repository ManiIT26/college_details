<?php
class Attendance_logModel Extends CI_Model{

	public function GEt_attd_log($data){



		$select_all_clg_staffs = $this->db->where('status',1)/*->where('staff_type',1)*/->where('college_id',$data['college_name'])->select('staff_id,s_id,approve_type,attadence_role')->get(STAFF_DETAILS)->result_array();

		$get_clg_details =  $this->db->where('status',1)->where('college_id',$data['college_name'])->get(COLLEGE_DETAILS)->row_array();

		$clg_lat = $get_clg_details['college_latitude'];

	 	$clg_lon = $get_clg_details['college_longitude'];

	 	$radius = $get_clg_details['college_radius'];
 
		$fromdate = $data['from_date_log'];

		$todate = $data['to_date_log'];


	
		 

		$all_rec = array();

		foreach($select_all_clg_staffs as $staffs){
			$insert_fst = array('staff_id'=>$staffs['staff_id'],'month'=>date('Y-m', strtotime($fromdate)),'college_id'=>$data['college_name']); 

			$this->db->where('staff_id',$staffs['staff_id']);
			$this->db->where('month',date('Y-m', strtotime($fromdate)));
			$this->db->delete(STAFF_ATTENDANCE);

			$this->db->insert(STAFF_ATTENDANCE,$insert_fst);

			$num_dates = 0;

			$late_entry = 0;
		 	$permission = 0;

		 	$late_entry_out = 0;
		 	$permission_out = 0;

			for ($j=strtotime($fromdate); $j<=strtotime($todate); $j+=86400) { 

				$num_dates += 1;

				$this->db->where('status',1);
			 	$this->db->where('staff_id',$staffs['staff_id']); 
			 	$this->db->where('attd_date',date("Y-m-d", $j)); 
			 	$this->db->where('late_entry',1); 	
			 	$this->db->order_by('attd_date','ASC'); 
			 	$late_entry_details = $this->db->get(ATTENDANCE_PERMISSION)->result_array();

			 	$this->db->where('status',1);
			 	$this->db->where('staff_id',$staffs['staff_id']); 
			 	$this->db->where('attd_date',date("Y-m-d", $j)); 
			 	$this->db->where('permission',1); 	
			 	$this->db->order_by('attd_date','ASC'); 
			 	$permission_details = $this->db->get(ATTENDANCE_PERMISSION)->result_array();

			 	foreach($late_entry_details as $le){

			 		if($le['permission_lat'] != '' && $le['permission_lon'] != ''){
			 			$radius_data = $this->getDistance($clg_lat,$clg_lon,$le['permission_lat'],$le['permission_lon']);
			 		
			 			if($radius_data < $radius){
			 				$late_entry += 1;
				 		}
				 		else{
				 			$late_entry_out += 1;
				 		}
			 		}
			 		else{
			 			$late_entry += 0;

			 			$late_entry_out += 0;
			 		}
			 		 
			 		

			 		
			 	}

			 	foreach($permission_details as $pr){


			 		if($pr['permission_lat'] != '' && $pr['permission_lon'] != ''){
			 			$radius_data = $this->getDistance($clg_lat,$clg_lon,$pr['permission_lat'],$pr['permission_lon']);
				 		if($radius_data < $radius){
				 			$permission += 1;
				 		}
				 		else{
				 			$permission_out += 1;
				 		}
				 	}
				 	else{
				 		$permission += 0;

				 		$permission_out += 0;
				 	}	
			 	}
			}

			 


			$this->db->where('status',1);
		 	$this->db->where('staff_id',$staffs['staff_id']); 	
		 	$this->db->order_by('attd_date','ASC'); 
		 	$this->db->limit($num_dates,4);
		 	$get_rec_permission = $this->db->get(ATTENDANCE_PERMISSION)->result_array();

		 	$all_rec = array();

		 	$college_out_all_rec = array();
		 	$college_in_all_rec = array();

		 	foreach($get_rec_permission as $res){

		 		$all_rec[$res['attd_date']] = $res;
 
		 	}

		 	
		 	 

		 	$insert_array = array();
 	


			for ($i=strtotime($fromdate); $i<=strtotime($todate); $i+=86400) {  
			    $all_dates =  date("Y-m-d", $i); 

				$this->db->where('status',1);
			 	$this->db->where('staff_id',$staffs['staff_id']);
			 	$this->db->group_start();		 
				$this->db->or_where("'$all_dates' BETWEEN from_date AND to_date ");				 
				$this->db->group_end();
				$this->db->group_start();

				if($staffs['approve_type'] == 2){
					$this->db->where('approve_status',3);
				}
				else if($staffs['approve_type'] == 1){
					$this->db->where('approve_status',3);
				}  
				$this->db->group_end();		
			 	$get_leave = $this->db->get(STAFF_LEAVE);

			 	$num_rows_applied_leave = $get_leave->num_rows();
			 	$rows_applied_leave = $get_leave->row_array(); 

			  


			 	$this->db->where('status',1);
			 	$this->db->where('college_id',$data['college_name']);
			 	$this->db->where('staff_atten_type',$staffs['attadence_role']);
			 	$this->db->where('holiday_date',$all_dates);
			 	$get_leave_gl = $this->db->get(HOLIDAY_EVENT_FIX)->num_rows();

			 	$select_leave_mng = $this->db->where('status',1)
			 	->where('college_id',$data['college_name'])	
			 	->where('staff_id',$staffs['staff_id'])	
			 	->get(LEAVE_MANAGEMENT)
			 	->row_array();

			  	  

			 	$this->db->where('status',1);
			 	$this->db->where('college_id',$data['college_name']);
			 	$this->db->where('staff_id',$staffs['staff_id']);
			 	$this->db->where('curr_date',$all_dates);
			 	$this->db->order_by('attd_id','ASC'); 
			 	$get_attd_log = $this->db->get(ATTENDANCE)->result_array();

			 	
			 	$attd_per_day = '';

			 	$leave_type = '';

			 	$get_permission = 0;

		 		if(isset($all_rec[$all_dates]['permission']) || isset($all_rec[$all_dates]['late_entry'])){

			 		if($all_rec[$all_dates]['permission'] == 1 ||   $all_rec[$all_dates]['late_entry'] == 1 ){
				 		$get_permission = 3;
				 	}
				} 

				$logout_lst_rec_key = count($get_attd_log) - 1;

				if(isset($get_attd_log[$logout_lst_rec_key])){
					if($get_attd_log[$logout_lst_rec_key]['log_shot_code'] == 'L'){
			 			$add_total_hrs = 0;
				 	}
				 	else{


		 				$log_lst_rec_time = date('H:i:s', strtotime($get_attd_log[$logout_lst_rec_key]['created_on']));
		 				$lst_rec_time = date('H:i:s', strtotime('16:30:00'));
		 				$lst_diff = $this->get_time_difference($log_lst_rec_time,$lst_rec_time);

		 				 $add_total_hrs = round($lst_diff);
				 	}
				}
 				else{
 					$add_total_hrs = 0; 
 				}
				



			 	if(count($get_attd_log) != 0 && $get_leave_gl == 0){
 

			 		foreach($get_attd_log as $key=>$log){ 

			 		 
			 			if($log['log_shot_code'] == 'E'){

			 				$lst_rec_key = $key + 1;

			 				if(isset($get_attd_log[$lst_rec_key]['created_on'])){
			 					$lst_rec_time = date('H:i:s', strtotime($get_attd_log[$lst_rec_key]['created_on']));
			 					$current_rec_time = date('H:i:s', strtotime($log['created_on'])); 
			 					$lst_diff = $this->get_time_difference($current_rec_time,$lst_rec_time);
			 				}
			 				else{
			 					$lst_rec_time = date('H:i:s', strtotime('16:30:00'));
			 					$current_rec_time = date('H:i:s', strtotime($log['created_on'])); 
			 					$lst_diff = $this->get_time_difference($current_rec_time,$lst_rec_time);
			 				} 
			 			 	 
			 				$add_total_hrs += round($lst_diff);
	 
			 			} 

	 					 $add_total_hrs += ($get_permission / count($get_attd_log));
			 			
			 		}
 					

			 		 
			 		if($add_total_hrs >=3 && $add_total_hrs <=5){

			 			if($num_rows_applied_leave == 1){
			 				$leave_type = 'H'.$rows_applied_leave['leave_type'] ;

			 				if($rows_applied_leave['leave_type'] == 'CCL'){
			 					$add_leaves = $select_leave_mng['ccl_taken'] + 0.5;



			 					$up_array = array('ccl_taken'=>$add_leaves);
			 					$this->db->where('college_id',$data['college_name'])	
							 	->where('staff_id',$staffs['staff_id'])	
							 	->update(LEAVE_MANAGEMENT,$up_array);
			 				}
			 				else if($rows_applied_leave['leave_type'] == 'CL'){
			 					$add_leaves = $select_leave_mng['cl_taken'] + 0.5;

			 					$up_array = array('cl_taken'=>$add_leaves);
			 					$this->db->where('college_id',$data['college_name'])	
							 	->where('staff_id',$staffs['staff_id'])	
							 	->update(LEAVE_MANAGEMENT,$up_array);
			 				} 

			 			}
			 			else{
			 				$leave_type = 'HD';
			 			} 
			 		}
			 		else if($add_total_hrs >=6){
			 			if($num_rows_applied_leave == 1){
			 				$leave_type =  $rows_applied_leave['leave_type'] ;

			 				if($rows_applied_leave['leave_type'] == 'CCL'){
			 					$add_leaves = $select_leave_mng['ccl_taken'] + 1;

			 					$up_array = array('ccl_taken'=>$add_leaves);

			 					$this->db->where('college_id',$data['college_name'])	
							 	->where('staff_id',$staffs['staff_id'])	
							 	->update(LEAVE_MANAGEMENT,$up_array);
			 				}
			 				else if($rows_applied_leave['leave_type'] == 'CL'){
			 					$add_leaves = $select_leave_mng['cl_taken'] + 1;

			 					$up_array = array('cl_taken'=>$add_leaves);

			 					$this->db->where('college_id',$data['college_name'])	
							 	->where('staff_id',$staffs['staff_id'])	
							 	->update(LEAVE_MANAGEMENT,$up_array);
			 				}
			 			}
			 			else{
			 				$leave_type = 'UL';
			 			} 
			 		}
			 		else{
						$leave_type = 'P';
			 		} 
 				 
			 	}
			 	else if(count($get_attd_log) != 0 && $get_leave_gl == 1){

 

			 		foreach($get_attd_log as $key=>$log){ 

			 		 
			 			if($log['log_shot_code'] == 'E'){

			 				$lst_rec_key = $key + 1;

			 				if(isset($get_attd_log[$lst_rec_key]['created_on'])){
			 					$lst_rec_time = date('H:i:s', strtotime($get_attd_log[$lst_rec_key]['created_on']));
			 					$current_rec_time = date('H:i:s', strtotime($log['created_on'])); 
			 					$lst_diff = $this->get_time_difference($current_rec_time,$lst_rec_time);
			 				}
			 				else{
			 					$lst_rec_time = date('H:i:s', strtotime('16:30:00'));
			 					$current_rec_time = date('H:i:s', strtotime($log['created_on'])); 
			 					$lst_diff = $this->get_time_difference($current_rec_time,$lst_rec_time);
			 				} 

			 				 
			 			 	 
			 				$add_total_hrs += round($lst_diff);
	 
			 			}
			 			  

	 					 $add_total_hrs += ($get_permission / count($get_attd_log));
			 			
			 		}


			 		

			 		if($add_total_hrs >=3 && $add_total_hrs <=6){

			 			$leave_type = 'HCCL';

			 			$add_ccl = $select_leave_mng['ccl_total'] + 0.5;



			 			 $up_array = array('ccl_total'=>$add_ccl);

					 	$this->db->where('college_id',$data['college_name'])	
					 	->where('staff_id',$staffs['staff_id'])	
					 	->update(LEAVE_MANAGEMENT,$up_array);

					 		$ccl_expiry_date  = date('Y-m-d', strtotime($all_dates. ' + 180 days'));

					 	$insert_array_ccl = array('staff_id'=>$staffs['staff_id'],'ccl_count'=>0.5,'created_date'=>$ccl_expiry_date);

					 	$this->db->insert(CCL_COUNT,$insert_array_ccl);
			 			 
			 		}
			 		else if($add_total_hrs >=6 && $num_rows_applied_leave == 1){
			 			$leave_type = 'OFF';
			 		}
			 		else{
						$leave_type = 'PCCL';

						$add_ccl = $select_leave_mng['ccl_total'] + 1;

						 $up_array = array('ccl_total'=>$add_ccl);

					 	$this->db->where('college_id',$data['college_name'])	
					 	->where('staff_id',$staffs['staff_id'])	
					 	->update(LEAVE_MANAGEMENT,$up_array);

					 	$ccl_expiry_date  = date('Y-m-d', strtotime($all_dates. ' + 180 days'));

					 	$insert_array_ccl = array('staff_id'=>$staffs['staff_id'],'ccl_count'=>1,'created_date'=>$ccl_expiry_date);

					 	$this->db->insert(CCL_COUNT,$insert_array_ccl);
			 		}
	 
			 	}
			 	else if(count($get_attd_log) == 0 && $get_leave_gl == 1){
			 		$leave_type = 'OFF';
			 	}
			 	else if(count($get_attd_log) == 0 && $get_leave_gl == 0){
			 		 

			 		if($num_rows_applied_leave == 1){

		 				$leave_type = $rows_applied_leave['leave_type'] ;

		 				if($rows_applied_leave['leave_type'] == 'CCL'){
		 					$add_leaves = $select_leave_mng['ccl_taken'] + 1;

		 				}
		 				else if($rows_applied_leave['leave_type'] == 'CL'){
		 					$add_leaves = $select_leave_mng['cl_taken'] + 1;

		 				
		 				} 

					 	

		 			}
		 			else{
		 				$leave_type = 'UL';
		 			} 
			 	}

 
			 	if($leave_type == ''){
			 		$leave_type = 'NA';
			 	}
			 	else{
			 		$leave_type = $leave_type;
			 	}

			 	 


			 	$up_array = array('A'.date('d', strtotime($all_dates))=>$leave_type,'num_late_entry'=>$late_entry_out,'num_permission'=>$permission_out);

			 	$this->db->where('staff_id',$staffs['staff_id']);
			  	$this->db->where('month',date('Y-m', strtotime($fromdate)));
			  	$this->db->update(STAFF_ATTENDANCE,$up_array);
			} 

			 
			 	
 
		}


		 $download_csv = $this->download_csv(date('Y-m', strtotime($fromdate)),$data['college_name']); 
	}

	public function download_csv($month,$college_id){

		 
		//$fields_concat="A01,',',A02,',', A03,',', A04,',', A05,',', A06,',', A07,',', A08,',', A09,',', A10,',', A11,',', A12,',', A13,',', A14,',', A15,',', A16,',', A17,',', A18,',', A19,',', A20,',', A21,',', A22,',', A23,',', A24,',', A25,',', A26,',', A27,',', A28,',', A29,',', A30,',', A31";

     
        $query = $this->db->where("a.college_id",$college_id)
        ->where('a.month',$month)
        ->from(''.STAFF_ATTENDANCE.' as a')
        ->join(''.STAFF_DETAILS.' as s','s.staff_id = a.staff_id','INNER')
        ->join(''.COLLEGE_DETAILS.' as c','c.college_id = a.college_id','INNER')
        ->select('s.firstname,s.lastname,c.college_name,a.A01,a.A02,a.A03,a.A04,a.A05,a.A06,a.A07,a.A08,a.A09,a.A10,a.A11,a.A12,a.A13,a.A14,a.A15,a.A16,a.A17,a.A18,a.A19,a.A20,a.A21,a.A22,a.A23,a.A24,a.A25,a.A26,a.A27,a.A28,a.A29,a.A30,a.A31,a.num_permission,num_late_entry,a.month')
        ->get()
        ->result_array(); 

      /*  foreach($query as $staff){

        	$update_ccl = $this->db->where('staff_id',$staff['s_id'])
        	->like('month',date('Y', strtotime($month)))
        	->select('GROUP_CONCAT('.$fields_concat.') AS ful_att ')
        	->get(STAFF_ATTENDANCE)
        	->row_array();


        	$text=$update_ccl['ful_att'];
			$CL=substr_count($text, 'CL')+(substr_count($text, 'HCL')/2.0);
			$CCL=substr_count($text, 'CCL')+(substr_count($text, 'HCCL')/2.0);

			$update_array = array('cl_total');

			echo $CL.' '.$CCL;
			 
        }

        die();*/

         

         // file name 
		   $filename = 'users_'.$month.'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   
		   // get data 
		   $usersData = $query;

		   // file creation 
		   $file = fopen('php://output', 'w');
		 
		   $header = array("Firstname","Lastname","Collegename","A01","A02","A03","A04","A05","A06","A07","A08","A09","A10","A11","A12","A13","A14","A15","A16","A17","A18","A19","A20","A21","A22","A23","A24","A25","A26","A27","A28","A29","A30","A31","No Permission","Num Late Entry","Month"); 
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

	

	public function getDistance($latitude1, $longitude1, $latitude2, $longitude2 ) {  

		//echo $latitude1.'---'.$longitude1.'---'.$latitude2.'---'. $longitude2;

	    $earth_radius = 6371;

	    $dLat = deg2rad( $latitude2 - $latitude1 );  
	    $dLon = deg2rad( $longitude2 - $longitude1 );  

	    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
	    $c = 2 * asin(sqrt($a));  
	    $d = $earth_radius * $c;  

	    return $d;  
	}

}

?>