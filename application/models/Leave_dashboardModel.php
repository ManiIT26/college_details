<?php 
class Leave_dashboardModel Extends CI_Model{

	public function GetAllRec($date){

		$month = date('m', strtotime($date));

		$from_date = date('Y-'.$month.'-01');

		$to_date =  date('Y-m-t', strtotime($from_date));

		$this->db->where('status',1);
		$college_data = $this->db->get(COLLEGE_DETAILS)->result_array();

		$date_wise_rec = array();

		/*for ($i=strtotime($from_date); $i<=strtotime($to_date); $i+=86400) {  */

			$college_wise_data = array();

			$all_dates = $date;  

			$num_applied_counts = 0;

			$total_leaves = $approve = $reject = 0;

			foreach ($college_data as $key => $college) {



			   	$this->db->where('l.status',1);		 
				$this->db->where("'$all_dates' BETWEEN l.from_date AND l.to_date");			 
				//$this->db->where('l.approve_status',3);	  
				//$this->db->select('l.emp_leave_id,l.reason,l.from_date,l.to_date,l.total_days,s.staff_id,s.firstname,s.lastname');
				$this->db->select('l.emp_leave_id,approve_status');
				$this->db->from(''.STAFF_LEAVE.' as l');
				$this->db->join(''.STAFF_DETAILS.' as s','s.staff_id = l.staff_id AND s.status = 1 AND s.college_id ='.$college['college_id'],'INNER');	
			 	$get_leave = $this->db->get()->result_array();

			 	

			 	foreach ($get_leave as $key => $get_cnt) {

			 		if($get_cnt['approve_status'] == 3){
			 			$approve += 1;
			 		}
			 		else if($get_cnt['approve_status'] == 0){
			 			$reject += 1;
			 		}

			 		$total_leaves += 1;

			 		
			 	}

			  	//echo $total_leaves .'-----'. $approve .'-----'. $reject.'<br>';

			 	//$num_applied_counts += $get_leave;
			    
			    //$college_wise_data[] = $college + array('num_rows'=>$get_leave);
 
	 
			}

			//echo $total_leaves .'-----'. $approve .'-----'. $reject.'<br>';

			$date_wise_rec[date('d', strtotime($all_dates))] =  array('total'=>$total_leaves,'approve'=>$approve,'reject'=>$reject);

			 		
			    
	/*	} */

		//print_r($date_wise_rec);


		return $date_wise_rec;
		
	}

	public function GetAllLeaves($date){

		$this->db->where('status',1);
		$college_data = $this->db->get(COLLEGE_DETAILS)->result_array();

 			
 		$college_wise_data = array();
			 

		foreach ($college_data as $key => $college) {
			
			$this->db->where('l.status',1);		 
			$this->db->where("'$date' BETWEEN l.from_date AND l.to_date");			 
			$this->db->where('l.approve_status',3);	  
			$this->db->select('l.emp_leave_id,l.reason,l.from_date,l.to_date,l.total_days,s.staff_id,s.firstname,s.lastname');
			$this->db->from(''.STAFF_LEAVE.' as l');
			$this->db->join(''.STAFF_DETAILS.' as s','s.staff_id = l.staff_id AND s.status = 1 AND s.college_id ='.$college['college_id'],'INNER');	
		 	$get_leave = $this->db->get()->result_array();

		 	 $college_wise_data[] = $college + array('staff_details'=>$get_leave);
		}

		return $college_wise_data;

	}
	
	public function Totalhours($date){
 
		$this->db->where('status',1);
		$college_data = $this->db->get(COLLEGE_DETAILS)->result_array();

		//echo "<pre>";
 			
 		$college_wise_data = array();
		 
		foreach ($college_data as $key => $college) {

			$staff_wise_details = array();

			$this->db->where('a.status',1);
			$this->db->where('a.college_id',$college['college_id']);
			$this->db->where('a.curr_date',$date);
			$this->db->distinct();
			$this->db->select('s.staff_id,s.firstname,s.lastname,s.s_id,s.staff_attendance_type');
			$this->db->from(''.ATTENDANCE.' as a');
			$this->db->join(''.STAFF_DETAILS.' as s','s.college_id = a.college_id AND s.status = 1 AND s.staff_id = a.staff_id','INNER');

			$get_stafff_details = $this->db->get()->result_array();

			//print_r($get_staff_id);

			//$get_stafff_details = $this->db->where('college_id',$college['college_id'])->where('status',1)->select('staff_id,firstname,lastname,s_id')->get(STAFF_DETAILS)->result_array();

			foreach($get_stafff_details as $staff){

				//GEt Permission rec

				$this->db->where('status',1);
				 
				$this->db->where('staff_id',$staff['staff_id']);
				$this->db->where('attd_date',$date);
				$this->db->select('permission,late_entry'); 
				$get_permission = $this->db->get(ATTENDANCE_PERMISSION)->row_array();

				$permission = isset($get_permission['permission'])?$get_permission['permission']:0;
				$late_entry = isset($get_permission['late_entry'])?$get_permission['late_entry']:0;
				


				$this->db->where('status',1);
				$this->db->where('college_id',$college['college_id']);
				$this->db->where('staff_id',$staff['staff_id']);
				$this->db->where('curr_date',$date);
				$this->db->select('created_on');
				$this->db->order_by('attd_id','ASC');
				$this->db->limit(1);
				$intime_details = $this->db->get(ATTENDANCE);

				$num_rows = $intime_details->num_rows();



				$get_in = $intime_details->row_array();

				$intime = date('H:i:s', strtotime($get_in['created_on']));

				$this->db->where('status',1);
				$this->db->where('college_id',$college['college_id']);
				$this->db->where('staff_id',$staff['staff_id']);
				$this->db->where('curr_date',$date);
				$this->db->select('created_on,log_shot_code');
				$this->db->order_by('attd_id','DESC');
				$this->db->limit(1);
				$get_out = $this->db->get(ATTENDANCE)->row_array();
 
				$out_time = date('H:i:s', strtotime($get_out['created_on']));

				 
				if($get_out['log_shot_code'] == 'L'){
					$out_time_l = date('H:i:s', strtotime($get_out['created_on']));;
				}
				else{
					$out_time_l = '-';
				}

				$time_diff = $this->get_time_difference($intime,$out_time);

				$total_hrs = round($time_diff,2);

				$staff_wise_details[] = $staff + array('intime'=>$intime,'out_time'=>$out_time_l,'total_hrs'=>$total_hrs,'permission'=>$permission,'late_entry'=>$late_entry);

				//echo $staff['s_id'].'-----'.$intime.'----'.$out_time.'----'.$permission.'----'.$late_entry.'<br>';
				 
			}

			$college_wise_data[] = $college + array('staff_wise_details'=>$staff_wise_details);

			 
			
			 
		}

	 
		return $college_wise_data;
		 
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
	
	public function getCollege_details(){

		$this->db->where('status',1);
		$college_data = $this->db->get(COLLEGE_DETAILS)->result_array();

		return (($college_data));
	}
	/*public function getStaff_details($id){
		$this->db->where('status',1);
		$this->db->where('s_id', $id); 
		$staff = $this->db->get(STAFF_DETAILS)->result_array();
		return $staff;
	}
	public function get_applied_leave(){
		$college = $this->getCollege_details();
		$this->db->where('status',1);
		//$this->db->where('staff_id', $this->session->userdata('user_type_id')); 
		$leave_management = $this->db->get(STAFF_LEAVE)->result_array();
		//echo "<pre>";
		//print_r($leave_management);
		if(!empty($leave_management)){
			$leave=array();
			for($j=0;$j<count($leave_management);$j++){
				$stf = $this->getStaff_details($leave_management[$j]['staff_id']);
				
				$leave[] = $leave_management[$j];
				$leave[$j]['college_id']= 1;
				//echo $stf[0]['college_id'];
				//print_r($stf[0]);
			}
		}
		//print_r($leave);
		//echo "</pre>";
		return $leave_management;
	}*/
	public function get_applied_leave_by_college(){
		if(isset($_GET['d'])){
			$curDate = date("Y-m-d", strtotime($_GET['d']));
			if($curDate!="" && $curDate!="0000-01-01" && $curDate!="0000-01-01 00:00:00"){
				$this->db->where("'$curDate' BETWEEN from_date AND to_date ");
			}
		}
		$this->db->where('s.approve_status',3);
		$this->db->from(''.STAFF_LEAVE.' as s');
		$this->db->join(''.STAFF_DETAILS.' as d','s.staff_id = d.staff_id','LEFT');
		$this->db->join(''.COLLEGE_DETAILS.' as c','d.college_id = c.college_id','LEFT');
		$leave = $this->db->get()->result_array();
		
		$cid="";
		$leaves=array();
		foreach($leave as $kleave=>$vleave){
			if($cid!=$vleave['college_id']){
				$cid=$vleave['college_id'];
			}
			$leaves[$cid][]=$vleave;
		}
		 
		return $leaves;
		//print_r(json_encode($select_role));
	}

	public function get_applied_leave_by_staff($date){

		$this->db->where("'$date' BETWEEN s.from_date AND s.to_date");
		$this->db->from(''.STAFF_LEAVE.' as s');
		$this->db->join(''.STAFF_DETAILS.' as d','s.staff_id = d.staff_id','LEFT');
		$this->db->join(''.COLLEGE_DETAILS.' as c','d.college_id = c.college_id','LEFT');
		$leave = $this->db->get()->result_array();

		return $leave ;


	}

}


?>