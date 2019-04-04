<?php
class Leave_applyModel Extends CI_Model{

	public function view_reporting_person(){

		$usr_id = $this->session->userdata('user_type_id');
		$college_id = $this->session->userdata('college_id');
		$get_dept = $this->db->where('college_id',$college_id)
					->where('staff_id',$usr_id)
					->where('status',1)
					->select('department_id,staff_type')
					->get(STAFF_DETAILS)->row_array();


		 
		return array('current_staff'=>$get_dept);		


	}

	public function get_Deprtment_staff($dept_id){

		$usr_id = $this->session->userdata('user_type_id');
		$college_id = $this->session->userdata('college_id');
		$get_all_staffs =  $this->db->where('college_id',$college_id)
					->where('staff_id !=',$usr_id)
					->where('status',1)
					->where('staff_type',0)
					->where('department_id',$dept_id)					 
					->get(STAFF_DETAILS)->result_array(); 

		return $get_all_staffs;

	}

	public function Leave_apply($leave_data,$staff_data){


		$this->db->from(''.STAFF_DETAILS.' as sl');
		$this->db->where('sl.staff_id',$this->session->userdata('user_type_id'));
		$this->db->where('sl.status',1);
		$this->db->where('sl.college_id',$this->session->userdata('college_id'));
		$this->db->join(''.ROLE.' as r','sl.role_id = r.role_id AND r.status = 1' ,'LEFT');
		//$this->db->select('sl.approve_type,sl.staff_type,sl.reporting_person1_role,sl.reporting_person2_role,sl.staff_attendance_type','r.role','sl.role_id');
		$get_approve_type = $this->db->get()->row_array();
		


		
		if($get_approve_type['approve_type'] == 2){
			$leave_data['approve_status'] = 1;
		}
		else if($get_approve_type['approve_type'] == 1){	
			$leave_data['approve_status'] = 2;
		} 

		

		$leave_data =  $leave_data + array('approve_type'=>$get_approve_type['approve_type'],'report1'=>$get_approve_type['reporting_person1_role'],'report2'=>$get_approve_type['reporting_person2_role']); 


		$this->db->insert(STAFF_LEAVE,$leave_data);
		$insert_id = $this->db->insert_id();

		if(count($staff_data) != 0){

			$insert_staff_array = array();

			foreach($staff_data as $staff){


				$insert_staff_array[] = $staff + array('emp_leave_id'=>$insert_id,'college_id'=>$this->session->userdata('college_id'));
			}

			

			$this->db->insert_batch(ALTER_STAFF,$insert_staff_array);
		} 
		
		

		if($get_approve_type['role'] == 'PRINCIPAL' || $get_approve_type['role'] == 'ED' ||$get_approve_type['role'] == 'EO'||$get_approve_type['role'] == 'FO'||$get_approve_type['role'] == 'DEAN' || $get_approve_type['role'] == 'S_COORDINATIOR'){

			$this->db->where('sl.status',1);
			$this->db->where('sl.staff_id',$leave_data['staff_id']);		
			$this->db->select('sl.staff_id,sl.firstname,sl.lastname,sl.email_id,sl.s_id,a.apply_date,a.leave_subject,a.from_date,a.to_date,a.total_days,a.reason,r.role,c.college_name');
			$this->db->from(''.STAFF_DETAILS.' as sl');
			$this->db->join(' '.STAFF_LEAVE.' as a','sl.staff_id = a.staff_id','INNER'); 
			$this->db->join(''.ROLE.' as r','sl.role_id = r.role_id AND r.status = 1' ,'LEFT');
			$this->db->join(''.COLLEGE_DETAILS.' as c','c.college_id = sl.college_id AND c.status = 1' ,'INNER');
			$leave_management = $this->db->get()->row_array();

			$this->send_mail($leave_management,$insert_id);
			 
		} 

		 

	}

	public function send_mail($data,$insert_id){

				$this->db->where('cm.status',1);
				$this->db->from(''.COMMON_MAIL.' as cm');
				$email_data = $this->db->get()->result_array();

				foreach ($email_data as $key => $mail) {
					
				$name = $data['firstname'].' '.$data['lastname'] ;
				$college_name = $data['college_name'];
				$staff_id = $data['s_id'];
				$staff_name_id = $data['staff_id'];


				$applay_date = date('d-m-Y',strtotime($data['apply_date']));
				$from_date = date('d-m-Y',strtotime($data['from_date']));
				$to_date = date('d-m-Y',strtotime($data['to_date']));
				$total_days = $data['total_days'];
				$subject = $data['leave_subject'];
				$reason = $data['reason'];
				$email_id=  $data['email_id'];
				$role = $data['role'];

				if($total_days > 1)
				{
					$day_title = 'Total Days';
				}else{

					$day_title = 'Total Day';      
				}
			
			
				$to = $mail['email_id'];
				$subject = "".$name." (".$staff_name_id.") (".$from_date." To ".$to_date.") Leave Request";
				$message = '<p style="font-size: 18px;">Name : '.$name.' </p>
							<p style="font-size: 18px;">Designation : '.$role.'</p>
							<p style="font-size: 18px;">College : '.$college_name.' </p>
							<p style="font-size: 18px;">Apply Date : '.$applay_date.' </p>
							<p style="font-size: 18px;">From Date : '.$from_date.' </p> 
							<p style="font-size: 18px;">To Date : '.$to_date.' </p>
							<p style="font-size: 18px;">'.$day_title.' : '.$total_days.' </p>
							<p style="font-size: 18px;">Reason : '.$reason.' </p>
							<br> 
							<a href="'.base_url().'nonteaching_approval?leave_id='.$insert_id.'&staff_id='.$staff_name_id.'&status=3"> 
							<button type="button" style= "cursor:pointer;background-color: #00a65a;color: white;padding: 8px;border: 1px solid #00a65a;">Accept</button></a>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				        	<a href="'.base_url().'nonteaching_approval?leave_id='.$insert_id.'&staff_id='.$staff_name_id.'&&status=0">
				        	<button type="button" style= "cursor:pointer;background-color:#d54b3d;color: white;padding: 8px;border: 1px solid #d54b3d;">Reject</button></a>';
							
					
				
				
				require_once("mailer/class.phpmailer.php"); // include the class name
				
				$mail = new PHPMailer(); // create a new object
				$mail->IsSMTP(); // enable SMTP
				$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
				$mail->SMTPAuth = true; // authentication enabled
				$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
				$mail->Host = "smtp.gmail.com";
				$mail->Port = 465; // or 587
				$mail->IsHTML(true);
				
				
				/*$mail->Username = "karthickitdeveloper@gmail.com";
				$mail->Password = "blackday@27";
				$mail->SetFrom("karthickitdeveloper@gmail.com");*/
				$mail->Username = "mahendraeducation@gmail.com";
				$mail->Password = "smile2011!";
				$mail->SetFrom("mahendraeducation@gmail.com");
				
				$mail->Subject = $subject;
				$mail->Body = $message;
				$mail->AddAddress($to);
				
				if(!$mail->Send()){
					echo "Mailer Error: " . $mail->ErrorInfo;
				}
			
			
				} 


	}

	public function get_Leave_policy($data){



		$fromdate = $data['fromdate'];
		$todate = $data['todate'];
		$no_days = $data['no_days']; 

		$all_dates = array();

		for ($i=strtotime($fromdate); $i<=strtotime($todate); $i+=86400) {  
		    $all_dates[] = date("Y-m-d", $i);  
		} 

		 

	 	$this->db->where('status',1);
	 	$this->db->where('staff_id',$this->session->userdata('user_type_id'));
	 	$this->db->group_start();
		$this->db->where("DATE(from_date) IN ('".implode("','", $all_dates)."')");
		$this->db->or_where("DATE(to_date) IN ('".implode("','", $all_dates)."')");
		$this->db->or_where("'$fromdate' BETWEEN from_date AND to_date ");
		$this->db->or_where(" '$todate' BETWEEN from_date AND to_date");
		$this->db->group_end();
		$this->db->group_start();
		$this->db->where('approve_status !=',0);	 
		$this->db->group_end();		
	 	$get_leave = $this->db->get(STAFF_LEAVE)->num_rows();

	 	 

 	 	if($get_leave == 0){
 	 		$this->db->where('status',1);
			$this->db->where('staff_id', $this->session->userdata('user_type_id'));
			$this->db->where('college_id',$this->session->userdata('college_id'));
			$leave_management = $this->db->get(LEAVE_MANAGEMENT)->row_array();

			$avi_leave_cl = ($leave_management['cl_last_total'] + $leave_management['cl_total']) - $leave_management['cl_taken'];
			$avi_leave_ccl = ($leave_management['ccl_last_total'] + $leave_management['ccl_total']) - $leave_management['ccl_taken'];

		//echo $avi_leave_cl.''.$avi_leave_ccl;

			$leave_array = array('LOP','OD','SPELL','SPECIAL LEAVE'); 

			if($no_days <= $avi_leave_cl && $no_days <= 3){
				$leave_array[] = 'CL'; 
			}
			if($no_days <= $avi_leave_ccl && $no_days <= 2){
				$leave_array[] = 'CCL'; 
			}

			print_r(json_encode($leave_array));
 	 	}
 	 	else{
 	 		print_r('Already_Exist');
 	 	}

		

	}

	public function get_applied_leave(){

		$this->db->where('status',1);
		$this->db->where('staff_id', $this->session->userdata('user_type_id')); 
		$leave_management = $this->db->get(STAFF_LEAVE)->result_array();

		print_r(json_encode($leave_management));
	}

	public function Cancel_leave($data){

		$this->db->where('emp_leave_id',$data['emp_leave_id']);
		$this->db->where('staff_id',$data['staff_id']);
		$this->db->delete(STAFF_LEAVE);


	}
	
}


?>