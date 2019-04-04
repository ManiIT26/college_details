<?php
class Approve_leaveModel Extends CI_Model{

	/*public function Get_leave_req(){

		$this->db->where('s.s_id',$this->session->userdata('user_type_id'));
		$this->db->where('s.college_id',$this->session->userdata('college_id'));
		$this->db->select('s.role_id,r.role,s.department_id,s.approve_type');
		$this->db->from(''.STAFF_DETAILS.' as s');
		$this->db->join(''.ROLE.' as r','r.role_id = s.role_id AND r.status = 1','inner');
		$get_roles = $this->db->get()->row_array();

		
		$leave_management = array();

		if($get_roles['role'] == 'HOD'){
			$this->db->where('sl.approve_status != ',0);
			$this->db->where('sl.approve_status != ',3);
			$this->db->where('sl.status',1);
			$this->db->where('sl.alter_staff1_status',1);
			$this->db->where('sl.alter_staff2_status',1);
			$this->db->where('s.college_id',$this->session->userdata('college_id'));
			$this->db->where('s.department_id',$get_roles['department_id']);	
			$this->db->where('s.approve_type',2);	
			//$this->db->select('s.s_id,s.staff_id,s.firstname,s.lastname,sl.emp_leave_id,sl.apply_date,sl.leave_subject,sl.from_date,sl.to_date,sl.total_days,sl.leave_type,sl.leave_day_type,sl.reason,sl.file_name,sl.approve_type,sl.approve_status')	;
			$this->db->from(''.STAFF_LEAVE.' as sl');
			$this->db->join(''.STAFF_DETAILS.' as s','sl.staff_id = s.s_id AND s.status = 1 AND s.staff_type = 0');
			$this->db->order_by('sl.emp_leave_id','DESC');
			$leave_management = $this->db->get()->result_array();


		}
		else if($get_roles['role'] == 'PRINCIPAL'){
			$this->db->where('sl.approve_status >=',2);
			$this->db->where('sl.alter_staff1_status',1);
			$this->db->where('sl.alter_staff2_status',1);
			$this->db->where('s.college_id',$this->session->userdata('college_id'));
			$this->db->where('sl.status',1);		 
			$this->db->from(''.STAFF_LEAVE.' as sl');
			$this->db->join(''.STAFF_DETAILS.' as s','sl.staff_id = s.s_id AND s.status = 1 AND s.staff_type = 0');
			$this->db->order_by('sl.emp_leave_id','DESC');
			$leave_management = $this->db->get()->result_array();
		} 

		

		 $common_array = array('leave_management'=>$leave_management,'role_type'=>$get_roles['role']);

		print_r(json_encode($common_array));

	}*/

	 
	public function Approve_leave_req($data){ 

	 

		if($data['role_type'] == 1){
			$update_array = array('approve_status'=>2);
		}
		else if($data['role_type'] == 2){
			$update_array = array('approve_status'=>3);

			$this->send_mail($data,1,'Approve',$data['emp_leave_id']);

			$this->common_staff_details->InsertLeavManagement($data,1);
		} 
		
		$this->db->where('staff_id',$data['staff_id']);
		$this->db->where('emp_leave_id',$data['emp_leave_id']);
		$this->db->update(STAFF_LEAVE,$update_array);
	}


	public function Reject_leave_req($data){ 

		$this->common_staff_details->InsertLeavManagement($data,0); 
		 
		$update_array = array('approve_status'=>0,'reject_reason'=>$data['reject_reason']);
		$this->db->where('staff_id',$data['staff_id']);
		$this->db->where('emp_leave_id',$data['emp_leave_id']);
		$this->db->update(STAFF_LEAVE,$update_array);

		

		$this->send_mail($data,0,$data['reject_reason'],$data['emp_leave_id']);
	}

	public function send_mail($leave_data,$status_data,$reject_reason,$emp_leave_id){



		$this->db->where('sl.status',1);
		$this->db->where('sl.staff_id',$leave_data['staff_id']);	
		$this->db->where('a.emp_leave_id',$emp_leave_id);	
		$this->db->from(''.STAFF_DETAILS.' as sl');
		$this->db->join(' '.STAFF_LEAVE.' as a','sl.staff_id = a.staff_id','INNER'); 
		$this->db->join(''.ROLE.' as r','sl.role_id = r.role_id AND r.status = 1' ,'LEFT');
		$this->db->join(''.COLLEGE_DETAILS.' as c','c.college_id = sl.college_id AND c.status = 1' ,'INNER');
		$user_data = $this->db->get()->row_array();

		 
		if($user_data['leave_day_type'] == 'HD')
		{
			$total_leaves = 0.5;
		}else{
			$total_leaves = $user_data['total_days'];
		}
 
			
		$name = $user_data['firstname'].'&nbsp;'.$user_data['lastname'] ;
		$college_name = $user_data['college_name'];
		$applay_date = date('d-m-Y',strtotime($user_data['apply_date']));
		$from_date = date('d-m-Y',strtotime($user_data['from_date']));
		$to_date = date('d-m-Y',strtotime($user_data['to_date']));
		$total_days = $user_data['total_days'];
		$subject = $user_data['leave_subject'];
		$reason = $user_data['reason'];
		$email_id=  $user_data['email_id'];


		if($status_data == 0)
		{
			$status = '<b style="color:#db3c30;">Your Leave Request is Canceled !</b>';
		}else{

			$status = '<b style="color:#4caf50;">Your Leave Request is Approved !</b>';
		}

		if($status_data == 0)
		{
			$status_title = ' Your Leave Request is Canceled ! ';
		}else{

			$status_title = ' Your Leave Request is Approved ! ';
		}

		if($reject_reason == 'Approve'){
			$reject = '-';
		}
		else{
			$reject = $reject_reason;
		}
		
				
			
				$to = $email_id;
				$subject = "".$status_title.""; 
				$message = '<p style="font-size: 18px;">Name : '.$name.' </p> 
							<p style="font-size: 18px;">Apply Date : '.$applay_date.' </p>
							<p style="font-size: 18px;">From Date : '.$from_date.' </p> 
							<p style="font-size: 18px;">To Date : '.$to_date.' </p>
							<p style="font-size: 18px;">Total Days : '.$total_leaves.' </p>
							<p style="font-size: 18px;">Reason : '.$reason.' </p>
							<p style="font-size: 18px;">Message : '.$reject.' </p><br><br>
							<p style="font-size: 18px;">Status : '.$status.' </p><br><br>

							<p><b>With Regards,</b></p>
							<p><b>'.$college_name.',</b></p>
							<p><b>Mahendrapuri,Mallasamudram,Namakkal(Dt)-637503.</b></p>';
				
					
				
				
					require_once("mailer/class.phpmailer.php"); // include the class name
					
					$mail = new PHPMailer(); // create a new object
					$mail->IsSMTP(); // enable SMTP
					$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
					$mail->SMTPAuth = true; // authentication enabled
					$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
					$mail->Host = "smtp.gmail.com";
					$mail->Port = 465; // or 587
					$mail->IsHTML(true);
					
					
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


	public function Get_staff_details($leave_id){

		 


		$this->db->where('a.emp_leave_id',$leave_id);
		$this->db->from(' '.STAFF_LEAVE.' as a');
		$this->db->join(''.STAFF_DETAILS.' as sl','sl.staff_id = a.staff_id','INNER'); 
		//$this->db->select('')
		$user_data = $this->db->get()->row_array();

		$this->db->where('as.emp_leave_id',$user_data['emp_leave_id']); 
		$this->db->from(''.ALTER_STAFF.' as as');
		$this->db->join(''.STAFF_DETAILS.' as sl','sl.staff_id = as.alter_staff','INNER');
		$this->db->order_by('as.alter_manage_id','asc');
		$get_alter_staffs = $this->db->get()->result_array(); 


		if(isset($get_alter_staffs[1]['firstname'])){
			$staff_2 = $get_alter_staffs[1]['firstname'].' '.$get_alter_staffs[1]['lastname'].' - '.$get_alter_staffs[1]['staff_id'].' - '.$get_alter_staffs[1]['dept_staff_hrs'];
		}
		else{
			$staff_2 = '';
		}

		if(isset($get_alter_staffs[0]['firstname'])){
			$staff_1 = $get_alter_staffs[0]['firstname'].' '.$get_alter_staffs[0]['lastname'].' - '.$get_alter_staffs[0]['staff_id'].' - '.$get_alter_staffs[0]['dept_staff_hrs'];
		}
		else{
			$staff_1 = '';
		}

		$alter_staff_details = array(
			'staff_name1'=>$staff_1,
			'staff_name2'=>$staff_2);

		 $common_array = $user_data + $alter_staff_details;

		print_r(json_encode($common_array));
	}

}

?>