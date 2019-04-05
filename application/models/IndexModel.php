<?php 
class IndexModel Extends CI_Model{

	public function get_staff_notification(){

		$usr_id = $this->session->userdata('user_type_id');
		$college_id = $this->session->userdata('college_id');

		if($college_id != 0 && $usr_id != 0){

			$get_notifcation = $this->db->where('status',0) 
								->where('alter_staff',$usr_id)
								->where('college_id',$college_id)
								->get(ALTER_STAFF)->result_array();


		

			$applied_leave = array();


				

			foreach($get_notifcation as $notification){ 

				

				if($notification['alter_staff_type'] == 1){
					$this->db->where('sl.alter_staff1_status',0);
				}
				else{
					$this->db->where('sl.alter_staff2_status',0);
				}		
				$this->db->where('sl.emp_leave_id',$notification['emp_leave_id']);	 
				$this->db->where('s.college_id',$this->session->userdata('college_id'));
				$this->db->where('sl.status',1);	
				$this->db->from(''.STAFF_LEAVE.' as sl'); 
				$this->db->join(''.STAFF_DETAILS.' as s','sl.staff_id = s.staff_id AND s.status = 1 AND s.staff_type = 0');
				$rr = $this->db->get()->row_array();

				  

				$applied_leave[] = $rr + $notification; 
	 
			}	

			 
			
		}else{
			$applied_leave = array();
		}	 		

			return $applied_leave;

	}

	public function Alter_leave_staff($data){



		if($data['total_approval'] == 1){
			if($data['status'] ==1){
				$update_alter_staff = array('status'=>1);

				if($data['staff_type'] == 1){
					$update_alter_leave = array('alter_staff1_status'=>1);
				}
				else{
					$update_alter_leave = array('alter_staff2_status'=>1);
				}
	 
			}
			else{
				$update_alter_staff = array('status'=>2);

				if($data['staff_type'] == 1){
					$update_alter_leave = array('alter_staff1_status'=>2,'approve_status'=>0);
				}
				else{
					$update_alter_leave = array('alter_staff2_status'=>2,'approve_status'=>0);
				}

				
			}

		}
		else{
			if($data['status'] ==1){
				$update_alter_staff = array('status'=>1);

				$update_alter_leave = array('alter_staff1_status'=>1,'alter_staff2_status'=>1);
	 
			}
			else{
				$update_alter_staff = array('status'=>2);

				$update_alter_leave = array('alter_staff1_status'=>0,'alter_staff2_status'=>0,'approve_status'=>0);

				
			}
		}
		
		 

			$this->db->where('emp_leave_id',$data['leave_id']);
			$this->db->update(STAFF_LEAVE,$update_alter_leave);

			$this->db->where('alter_manage_id',$data['alter_id']);
			$this->db->update(ALTER_STAFF,$update_alter_staff);

		
	}


	public function Change_password($data,$old_pass){

		
		$user_name = $this->session->userdata('user_name');
		$user_type_id = $this->session->userdata('user_type_id');
		$user_type = $this->session->userdata('user_type');
		$college_id = $this->session->userdata('college_id');



		$this->db->where('u.username',$user_name);
		$this->db->where('u.password',md5($old_pass));
	 	$this->db->from(''.USERS.' as u');
	 	$user_data = $this->db->get()->row_array();

	 	 

		if(!empty($user_data))
		{

			if($user_type != 'staff'){
				$this->db->where('user_type_id',$user_type_id);
				$this->db->where('username',$user_name);
				$this->db->where('password',md5($old_pass));
			}
			else{
				$this->db->where('user_type_id',$user_type_id);
				$this->db->where('user_type',$user_type);
				$this->db->where('college_id',$college_id);
				$this->db->where('password',md5($old_pass));
			}	
	 		$this->db->update(USERS,$data);

	 		return 'success';

		}
		else{

			return 'error';

			
		}

 
	}

}


?>