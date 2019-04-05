<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class common_staff_details{ 

	private $CI;
 
    function __construct()
    {
        $this->CI = get_instance();

        $this->CI->load->database();
    }


    public function InsertLeavManagement($data,$status){

    	if($status == 1){

    		$this->CI->db->where('staff_id',$data['staff_id']);
			$this->CI->db->where('emp_leave_id',$data['emp_leave_id']);
			$this->CI->db->where('approve_status',2);
			$staff_leave = $this->CI->db->get(STAFF_LEAVE)->row_array();

				$select_leave_mng = $this->CI->db->where('status',1)			  
				 	->where('staff_id',$data['staff_id'])		
				 	->get(LEAVE_MANAGEMENT)
				 	->row_array();

			if(isset($staff_leave['total_days']) && $staff_leave['total_days'] != ''){

				if($staff_leave['leave_day_type'] == 'HD')
				{
					$total_leaves = 0.5;
				}else{
					$total_leaves = $staff_leave['total_days'];
				}
				

				$up_array = array();
		 

				if($staff_leave['leave_type'] == 'CCL'){

					$add_leaves = $select_leave_mng['ccl_taken'] + $total_leaves;

					$up_array = array('ccl_taken'=>$add_leaves);				 

					if($total_leaves == '0.5'){
						$this->CI->db->where('staff_id',$data['staff_id']);
						$this->CI->db->where('ccl_count',$total_leaves);
						$this->CI->db->order_by('created_date','ASC');
						$this->CI->db->where('status',1);
						$this->CI->db->limit(1); 
						$ccl_count = $this->CI->db->get(CCL_COUNT)->row_array();

						if($ccl_count['ccl_count'] != ''){
							$update_array_ccl = array('status'=>0);

							$up_id = $ccl_count['ccl_id'];
						}
						else{
							$this->CI->db->where('staff_id',$data['staff_id']); 
							$this->CI->db->order_by('created_date','ASC');
							$this->CI->db->where('status',1);
							$this->CI->db->limit(1); 
							$ccl_count_all = $this->CI->db->get(CCL_COUNT)->row_array();

							$ccl_update_val = $ccl_count_all['ccl_count'] - $total_leaves;

							$up_id = $ccl_count_all['ccl_id'];

							$update_array_ccl = array('ccl_count'=>$ccl_update_val);
						}

						$this->CI->db->where('staff_id',$data['staff_id']);
						$this->CI->db->where('ccl_id',$up_id);
						$this->CI->db->update(CCL_COUNT,$update_array_ccl);				 
					}
					else{
						$up_array_count = array('status'=>0);
						$this->CI->db->where('staff_id',$data['staff_id']);
						$this->CI->db->order_by('created_date','ASC'); 
						$this->CI->db->limit($total_leaves);
						$this->CI->db->update(CCL_COUNT,$up_array_count);
					}				 
				}
				else if($staff_leave['leave_type'] == 'CL'){

					$add_leaves = $select_leave_mng['cl_taken'] + $total_leaves;

					$up_array = array('cl_taken'=>$add_leaves);
				}
				else{ 

					$add_leaves = $select_leave_mng['ccl_taken'];

					$up_array = array('cl_taken'=>$select_leave_mng['cl_taken'],'ccl_taken'=>$add_leaves);
				}
	 

		 		$this->CI->db->where('staff_id',$data['staff_id']);
			 	$this->CI->db->update(LEAVE_MANAGEMENT,$up_array);
			}	
    	}
    	else{
    		$this->CI->db->where('staff_id',$data['staff_id']);
			$this->CI->db->where('emp_leave_id',$data['emp_leave_id']);
			$this->CI->db->where('approve_status',3);
			$staff_leave = $this->CI->db->get(STAFF_LEAVE)->row_array(); 


			$select_leave_mng = $this->CI->db->where('status',1)			  
				 	->where('staff_id',$data['staff_id'])		
				 	->get(LEAVE_MANAGEMENT)
				 	->row_array();

			if(isset($staff_leave['total_days']) && $staff_leave['total_days'] != ''){

				if($staff_leave['leave_day_type'] == 'HD')
				{
					$total_leaves = 0.5;
				}else{
					$total_leaves = $staff_leave['total_days'];
				}
				

				$up_array = array();
		 

				if($staff_leave['leave_type'] == 'CCL'){ 

					$add_leaves = $select_leave_mng['ccl_taken'] - $total_leaves;

					$up_array = array('ccl_taken'=>$add_leaves);				 

					if($total_leaves == '0.5'){
						$this->CI->db->where('staff_id',$data['staff_id']);
						$this->CI->db->where('ccl_count',$total_leaves);
						$this->CI->db->order_by('created_date','ASC');
						$this->CI->db->where('status',1);
						$this->CI->db->limit(1); 
						$ccl_count = $this->CI->db->get(CCL_COUNT)->row_array();

						$ccl_update_val = $ccl_count['ccl_count'] + $total_leaves;

						$up_id = $ccl_count['ccl_id'];

						$update_array_ccl = array('ccl_count'=>$ccl_update_val); 

						  
						$this->CI->db->where('staff_id',$data['staff_id']);
						$this->CI->db->where('ccl_id',$up_id); 
						$this->CI->db->update(CCL_COUNT,$update_array_ccl);				 
					}
					else{ 
						$up_array_count = array('status'=>1);
						$this->CI->db->where('staff_id',$data['staff_id']);
						$this->CI->db->order_by('created_date','ASC'); 
						$this->CI->db->limit($total_leaves);
						$this->CI->db->update(CCL_COUNT,$up_array_count);
					}				 
				}
				else if($staff_leave['leave_type'] == 'CL'){

					$add_leaves = $select_leave_mng['cl_taken'] - $total_leaves;

					$up_array = array('cl_taken'=>$add_leaves);
				}
				else{ 

					$add_leaves = $select_leave_mng['ccl_taken'];

					$up_array = array('cl_taken'=>$select_leave_mng['cl_taken'],'ccl_taken'=>$add_leaves);
				}
	 

		 		$this->CI->db->where('staff_id',$data['staff_id']);
			 	$this->CI->db->update(LEAVE_MANAGEMENT,$up_array);
			}	
    	}

   
		
		 	
    }
 	 

 	public function Get_usr_details(){

 		$this->CI->db->where('s.status',1);
		$this->CI->db->where('s.staff_id',$this->CI->session->userdata('user_type_id'));
		$this->CI->db->where('s.college_id',$this->CI->session->userdata('college_id'));	 
		$this->CI->db->select('s.s_id,s.staff_attendance_type,s.reporting_person1_role,s.reporting_person2_role,s.approve_type,s.staff_type,s.staff_id,s.college_id,s.firstname,s.attadence_role,s.lastname,s.dob,s.gender,s.mobile_number,s.email_id,s.address,s.profile_image,r.role,d.department_name,c.college_name,l.cl_total,l.cl_taken,l.cl_last_total,l.ccl_total,l.ccl_taken,l.ccl_last_total');
	 	$this->CI->db->from(''.STAFF_DETAILS.' as s');
	 	$this->CI->db->join(''.ROLE.' as r','s.role_id = r.role_id AND r.status = 1' ,'LEFT');
	 	$this->CI->db->join(''.COLLEGE_DETAILS.' as c','s.college_id = c.college_id  AND c.status = 1','LEFT');
	 	$this->CI->db->join(''.DEPARTMENT.' as d','s.department_id = d.department_id  AND d.status = 1','LEFT');
	 	$this->CI->db->join(''.LEAVE_MANAGEMENT.' as l','l.staff_id = s.staff_id AND l.college_id = s.college_id AND l.status = 1','LEFT');
	 	$user = $this->CI->db->get(STAFF_DETAILS)->row_array();
 
		return $user;
 	}

 	public function Get_leave_details(){

 		$this->CI->db->where('status',1);
		$this->CI->db->where('staff_id',$this->CI->session->userdata('user_type_id'));
		$leave = $this->CI->db->get(CCL_COUNT)->result_array();

		return $leave;

 	}	

 	public function Leave_notification(){

 		$user_type_id = $this->CI->session->userdata('user_type_id');
 		$college_id = $this->CI->session->userdata('college_id');

 		$get_emp_staff_id = $this->CI->db->where('staff_id',$user_type_id)->where('college_id',$college_id)->select('staff_id')->get(STAFF_DETAILS)->row_array();


 		//get_level 1 

 		$this->CI->db->where('sl.approve_type',2);
 		$this->CI->db->where('sl.approve_status ',1);
 		$this->CI->db->where('sl.alter_staff1_status',1);
 		$this->CI->db->where('sl.alter_staff2_status',1);
 		$this->CI->db->where('sl.report1',$get_emp_staff_id['staff_id']);
 		$this->CI->db->from(''.STAFF_LEAVE.' as sl');
		$this->CI->db->join(''.STAFF_DETAILS.' as s','sl.staff_id = s.staff_id AND s.status = 1');
		$this->CI->db->order_by('sl.emp_leave_id','DESC');
		$get_level1 = $this->CI->db->get()->num_rows();
 		
		

		//get_level 2

 		$this->CI->db->where('sl.approve_type >=',1);
 		$this->CI->db->where('sl.approve_status',2);
 		$this->CI->db->where('sl.alter_staff1_status',1);
 		$this->CI->db->where('sl.alter_staff2_status',1);
 		$this->CI->db->where('sl.report2',$get_emp_staff_id['staff_id']);
 		$this->CI->db->from(''.STAFF_LEAVE.' as sl');
		$this->CI->db->join(''.STAFF_DETAILS.' as s','sl.staff_id = s.staff_id AND s.status = 1');
		$this->CI->db->order_by('sl.emp_leave_id','DESC');
		$get_level2 = $this->CI->db->get()->num_rows();

		$notification = $get_level1 + $get_level2;

		return $notification;

 	}

 	public function View_approve_req(){

 		$user_type_id = $this->CI->session->userdata('user_type_id');
 		$college_id = $this->CI->session->userdata('college_id');

 		$get_emp_staff_id = $this->CI->db->where('staff_id',$user_type_id)->where('college_id',$college_id)->select('staff_id')->get(STAFF_DETAILS)->row_array();

 		 $num_reporting_person = $this->CI->db
 		 ->where('college_id',$college_id)
 		 ->group_start()
 		 ->where('reporting_person1_role ',$get_emp_staff_id['staff_id'])
 		 ->or_where('reporting_person2_role ',$get_emp_staff_id['staff_id'])
 		 ->group_end()
 		 ->select('staff_id')->get(STAFF_DETAILS)
 		 ->num_rows();

 		  
 		  return $num_reporting_person;		
 	}


 	public function get_leave_req($level_type){

 		$user_type_id = $this->CI->session->userdata('user_type_id');
 		$college_id = $this->CI->session->userdata('college_id');

 		$get_emp_staff_id = $this->CI->db->where('staff_id',$user_type_id)->where('college_id',$college_id)->select('staff_id')->get(STAFF_DETAILS)->row_array();



 		$get_leave_req = array();

 		//get_level 1 

 		$this->CI->db->where('sl.approve_type >=',1);
 		$this->CI->db->where('sl.approve_status',1);  
 		$this->CI->db->where('sl.alter_staff1_status',1);
 		$this->CI->db->where('sl.alter_staff2_status',1);
 		$this->CI->db->where('sl.report1',$get_emp_staff_id['staff_id']);
 		$this->CI->db->from(''.STAFF_LEAVE.' as sl');
		$this->CI->db->join(''.STAFF_DETAILS.' as s','sl.staff_id = s.staff_id AND s.status = 1');
		$this->CI->db->order_by('sl.approve_status','ASC');
		$this->CI->db->select('s.staff_id,s.firstname,s.lastname,sl.apply_date,sl.from_date,sl.to_date,sl.reason,sl.file_name,sl.approve_status,sl.emp_leave_id,sl.leave_type,"1" as role_type,"Level 1" as leave_status');
		$get_level_1 = $this->CI->db->get()->result_array();

		//get_level 2


		$this->CI->db->where('sl.approve_type >=',1);
 		$this->CI->db->where('sl.approve_status',2);
 		$this->CI->db->where('sl.alter_staff1_status',1);
 		$this->CI->db->where('sl.alter_staff2_status',1);
 		$this->CI->db->where('sl.report2',$get_emp_staff_id['staff_id']);
 		$this->CI->db->from(''.STAFF_LEAVE.' as sl');
		$this->CI->db->join(''.STAFF_DETAILS.' as s','sl.staff_id = s.staff_id AND s.status = 1');
		$this->CI->db->order_by('sl.approve_status','ASC');
		$this->CI->db->select('s.staff_id,s.firstname,s.lastname,sl.apply_date,sl.from_date,sl.to_date,sl.reason,sl.file_name,sl.approve_status,sl.emp_leave_id,sl.leave_type,"2" as role_type,"Level 2" as leave_status ');
		$get_level_2 = $this->CI->db->get()->result_array();

		//get_level 1  history

 		$this->CI->db->where('sl.approve_type >=',1);
 		$this->CI->db->where('sl.approve_status',2);
 		$this->CI->db->where('sl.alter_staff1_status',1);
 		$this->CI->db->where('sl.alter_staff2_status',1);
 		$this->CI->db->where('sl.report1',$get_emp_staff_id['staff_id']);
 		$this->CI->db->from(''.STAFF_LEAVE.' as sl');
		$this->CI->db->join(''.STAFF_DETAILS.' as s','sl.staff_id = s.staff_id AND s.status = 1');
		$this->CI->db->select('s.staff_id,s.firstname,s.lastname,sl.apply_date,sl.from_date,sl.to_date,sl.reason,sl.file_name,sl.approve_status,sl.emp_leave_id,sl.leave_type,"1" as role_type,"Level 1" as leave_status ');
 		$this->CI->db->order_by('sl.approve_status','ASC');
		$get_level_1_his = $this->CI->db->get()->result_array();

		

		//get_level 2 History

		$this->CI->db->where('sl.approve_type >=',1);
 		$this->CI->db->where('sl.approve_status',3);
 		$this->CI->db->where('sl.alter_staff1_status',1);
 		$this->CI->db->where('sl.alter_staff2_status',1);
 		$this->CI->db->where('sl.report2',$get_emp_staff_id['staff_id']);
 		$this->CI->db->from(''.STAFF_LEAVE.' as sl');
		$this->CI->db->join(''.STAFF_DETAILS.' as s','sl.staff_id = s.staff_id AND s.status = 1');
		$this->CI->db->order_by('sl.approve_status','ASC');
		$this->CI->db->select('s.staff_id,s.firstname,s.lastname,sl.apply_date,sl.from_date,sl.to_date,sl.reason,sl.file_name,sl.approve_status,sl.emp_leave_id,sl.leave_type,"2" as role_type,"Level 2" as leave_status ');
		$get_level_2_his = $this->CI->db->get()->result_array();





 		$leave_management = array_merge($get_level_1,$get_level_2);
		$leave_count = count($leave_management);

		$leave_management_his = array_merge($get_level_1_his,$get_level_2_his);
		$leave_count_his = count($leave_management_his);

		if($level_type == 1){
 			$get_leave_req = $leave_management; 
 		}
 		else if($level_type == 2){
 			$get_leave_req = $leave_management_his; 
 		} 

		$leave_management = array('leave_management'=>$get_leave_req,'leave_count'=>$leave_count,'leave_count_his'=>$leave_count_his);
  
 		return $leave_management;

		 
 	}

 	public function Autorun_Attd(){

 		$this->CI->db->where('status',1);
 		$ccl_count = $this->CI->db->get(CCL_COUNT)->result_array();

 		foreach($ccl_count as $ccl){

 			$curr_date = date('Y-m-d');

 			$count_date = date('Y-m-d', strtotime($ccl['created_date']));

 			//echo $count_date.'<br>';

 			if(strtotime($curr_date) == strtotime($count_date)){

 				$this->CI->db->where('staff_id',$ccl['staff_id']);
 				$this->CI->db->where('status',1);
 				$leave_management = $this->CI->db->get(LEAVE_MANAGEMENT)->row_array();

 				

 				if($leave_management['leave_id'] != ''){

 					$ccl_total = $leave_management['ccl_total'] - $ccl['ccl_count'];
 					//echo $ccl['staff_id'].'---'.	$ccl_total.'<br>';

 					$update_array_lm = array('ccl_total'=>$ccl_total);

 					$update_array_count = array('status'=>0);

 					$this->CI->db->where('staff_id',$ccl['staff_id']);
 					$this->CI->db->where('status',1);
 					$this->CI->db->update(LEAVE_MANAGEMENT,$update_array_lm);


 					$this->CI->db->where('staff_id',$ccl['staff_id']);
 					$this->CI->db->where('status',1);
 					$this->CI->db->update(CCL_COUNT,$update_array_count);

 					 
 				}

 				

 				//echo $count_date.'<br>';
 			}

 			
 		}
 	}

	 
}