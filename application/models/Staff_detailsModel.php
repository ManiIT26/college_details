<?php
class Staff_detailsModel Extends CI_Model{


	public function getCollege_details(){

		$this->db->where('status',1);
		$college_data = $this->db->get(COLLEGE_DETAILS)->result_array();

		return $college_data; 
	}

	public function Insert_Staff($staff_details,$password,$s_id){

		$usr_name = $staff_details['staff_id'];

		$pass = $password;

		$mail = $staff_details['email_id']; 
		 
			 
		if(isset($s_id) && $s_id != '') 
		{

			$this->db->where('s_id',$s_id);
	 		$this->db->update(STAFF_DETAILS,$staff_details);

	 		$up_array =array('password'=>md5($password));

	 		$this->db->where('user_type_id',$usr_name);
	 		$this->db->update(USERS,$up_array); 

		}else{

			$this->db->insert(STAFF_DETAILS,$staff_details);

			$insert_id = $this->db->insert_id();

			$user_insert = array('user_type_id'=>$staff_details['staff_id'],'username'=>$staff_details['staff_id'],'password'=>md5($password),'user_type'=>'staff',
			'college_id'=>$staff_details['college_id']);

			$this->db->insert(USERS,$user_insert);

		}


		
		$this->Sendmail($usr_name,$pass,$mail);
		
	}


	public function Sendmail($usr_name,$pass,$mail){
		$usr_name = $usr_name;

			 
			
			$to = $mail;
			$subject = " Mahendra eAttendance Login Details";
			$message = '<b>Greetings,</b><br>'.

						'<p style="font-size: 13px;">Welcome to Mahendra eAttendance <br> login credentials given below <br></p>
						<p style="font-size: 18px;">Link  : http://10.0.0.55/attendance/ </p>
						<p style="font-size: 18px;">Username : '.$usr_name.' </p>
						<p style="font-size: 18px;">Password : '.$pass.' </p><br><br>
						<p style="font-size: 13px;">Regards </p>
						<p style="font-size: 13px;">Mahendra educational institutions </p>
						 ';

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



	public function Get_staff_details(){

		if($this->session->userdata('user_type') != 'super_admin'){
	 		$this->db->where('s.college_id',$this->session->userdata('college_id'));
	 	}
	 	
	 	$this->db->where('s.status',1);
	 	$this->db->from(''.STAFF_DETAILS.' as s');
	 	$this->db->join(''.ROLE.' as r','s.role_id = r.role_id','LEFT');
	 	$this->db->join(''.COLLEGE_DETAILS.' as c','s.college_id = c.college_id','LEFT');
	 	$this->db->join(''.DEPARTMENT.' as d','s.department_id = d.department_id','LEFT');
	 	$this->db->order_by('s.s_id','DESC');
	 	$select_role = $this->db->get()->result_array();

	 	return $select_role;

	 	//print_r(json_encode($select_role));
	 }

	 public function delete_staff_details($staff_id){

	 	$up_array = array('status'=>0);
	 	$this->db->where('s_id',$staff_id);
	 	$this->db->update(STAFF_DETAILS,$up_array);

		$this->db->where('user_type_id',$staff_id);
	 	$this->db->update(USERS,$up_array);
	 	
	 }

	 public function edit_staff_details($staff_id){

		$this->db->where('status',1);
		$this->db->where('s_id',$staff_id);
		$staff_data = $this->db->get(STAFF_DETAILS)->row_array();
		

		if($staff_data['reporting_person2_role'] != 0){
			$reporting_person_2 = $this->Get_reportingPerson($staff_data['reporting_person2_role']);

			$r2 = $reporting_person_2[0]['staff_id'].' - '.$reporting_person_2[0]['firstname'].''.$reporting_person_2[0]['lastname'].' ('.$reporting_person_2[0]['department_name'].' - '.$reporting_person_2[0]['role'].' )';
		}
		else{
			$r2 = $staff_data['reporting_person2_role'];
		}

		if($staff_data['reporting_person1_role'] != 0){
			$reporting_person_1 = $this->Get_reportingPerson($staff_data['reporting_person1_role']);
			$r1 = $reporting_person_1[0]['staff_id'].' - '.$reporting_person_1[0]['firstname'].''.$reporting_person_1[0]['lastname'].' ('.$reporting_person_1[0]['department_name'].' - '.$reporting_person_1[0]['role'].' )';
		}
		else{
			$r1 = $staff_data['reporting_person1_role'];
		}

		

		

		$staff_data = $staff_data + array('user_type'=>$this->session->userdata('user_type'),'reporting_person_2'=>$r2,'reporting_person_1'=>$r1);

	 

		print_r(json_encode($staff_data)); 
	}

	public function Get_reportingPerson($staff_id){

		$this->db->where('s.college_id',$this->session->userdata('college_id'));
		$this->db->like('s.staff_id',$staff_id);
		$this->db->select('s.staff_id,s.firstname,s.lastname,r.role,d.department_name');
		$this->db->from(''.STAFF_DETAILS.' as s');
		$this->db->join(''.ROLE.' as r','s.role_id = r.role_id','LEFT');
		$this->db->join(''.DEPARTMENT.' as d','s.department_id = d.department_id','LEFT');
		$this->db->limit(10);
		$reporting_person = $this->db->get()->result_array();

		return $reporting_person;
		
	}

	
	public function Insert_attd($attd_data){

	 	$loc = @unserialize (file_get_contents('http://ip-api.com/php/'));
		
		$loc['lon'] = ($loc['lon'])?$loc['lon']:'';

		$loc['lat'] = ($loc['lat'])?$loc['lat']:''; 

		$loc['city'] = ($loc['city'])?$loc['city']:'';

		date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

		$get_attd = $this->db->where('status',1)->where('curr_date',date('Y-m-d'))->where('staff_id',$this->session->userdata('user_type_id'))->get(ATTENDANCE)->num_rows();

		 
		$get_permission = $this->db->where('status',1)->where('attd_date',date('Y-m-d'))->where('staff_id',$this->session->userdata('user_type_id'))->get(ATTENDANCE_PERMISSION);

		$get_permission_data = $get_permission->row_array();

		$get_permission_rows = $get_permission->num_rows(); 

 
		 	$login_time = date('H:i:s');

		 	$late_entry_time_in = date('H:i:s', strtotime('09:20:00'));

		 	$late_entry_time_out = date('H:i:s', strtotime('09:35:00')); 

		 	$permis_last_time = date('H:i:s', strtotime('10:20:00'));

		 	$late_eve_in = date('H:i:s', strtotime('16:15:00')); 

		 	$permis_eve_in = date('H:i:s', strtotime('15:30:00')); 

		 	$permis_eve_out = date('H:i:s', strtotime('16:30:00')); 
 

		 	 if($get_attd == 0){

		 		if(strtotime($login_time) >= strtotime($late_entry_time_in) && strtotime($login_time) <= strtotime($late_entry_time_out)){
	 
			 		if($get_permission_rows == 0){

			 			$attd_permim_log = array('staff_id'=>$this->session->userdata('user_type_id'),'attd_date'=>date('Y-m-d'),'permission'=>0,'late_entry'=>1,'permission_lon'=>$loc['lon'],'permission_lat'=>$loc['lat'],'permission_place'=>$loc['city']);

		 				$this->db->insert(ATTENDANCE_PERMISSION,$attd_permim_log);
			 		}
			 		else{
			 			$attd_permim_log = array('late_entry'=>1);

			 			$this->db->where('staff_id',$this->session->userdata('user_type_id'));
				 		$this->db->where('attd_date',date('Y-m-d'));
			 			$this->db->update(ATTENDANCE_PERMISSION,$attd_permim_log); 
			 		}
	 
		 		}
			 	
			 
			 	if(strtotime($login_time) >= strtotime($late_entry_time_out) && strtotime($login_time) <= strtotime($permis_last_time)){


			 			$attd_permim_log = array('staff_id'=>$this->session->userdata('user_type_id'),'attd_date'=>date('Y-m-d'),'permission'=>1,'late_entry'=>0,'permission_lon'=>$loc['lon'],'permission_lat'=>$loc['lat'],'permission_place'=>$loc['city']);

		 				$this->db->insert(ATTENDANCE_PERMISSION,$attd_permim_log);
			 		 
			 	}
			} 	


 
		 	if(strtotime($login_time) >= strtotime($permis_eve_in) && strtotime($login_time) <= strtotime($permis_eve_out) && $attd_data['log'] == 'Permission' && $get_permission_rows == 0){

		 		if($get_permission_rows == 0){

		 			$attd_permim_log = array('staff_id'=>$this->session->userdata('user_type_id'),'attd_date'=>date('Y-m-d'),'permission'=>1,'late_entry'=>0,'permission_lon'=>$loc['lon'],'permission_lat'=>$loc['lat'],'permission_place'=>$loc['city']);

	 				$this->db->insert(ATTENDANCE_PERMISSION,$attd_permim_log);
		 		}
		 		else{
		 			$attd_permim_log = array('permission'=>1);

		 			$this->db->where('staff_id',$this->session->userdata('user_type_id'));
			 		$this->db->where('attd_date',date('Y-m-d'));
		 			$this->db->update(ATTENDANCE_PERMISSION,$attd_permim_log); 
		 		}
		 	}

			if(strtotime($login_time) >= strtotime($late_eve_in) && strtotime($login_time) <= strtotime($permis_eve_out) && $attd_data['log'] == 'Permission' && $get_permission_rows == 0){ // eve permission

		 		if($get_permission_rows == 0){

		 			$attd_permim_log = array('staff_id'=>$this->session->userdata('user_type_id'),'attd_date'=>date('Y-m-d'),'permission'=>0,'late_entry'=>1,'permission_lon'=>$loc['lon'],'permission_lat'=>$loc['lat'],'permission_place'=>$loc['city']);

	 				$this->db->insert(ATTENDANCE_PERMISSION,$attd_permim_log);
		 		}
		 		else{
		 			$attd_permim_log = array('late_entry'=>1);

		 			$this->db->where('staff_id',$this->session->userdata('user_type_id'));
			 		$this->db->where('attd_date',date('Y-m-d'));
		 			$this->db->update(ATTENDANCE_PERMISSION,$attd_permim_log); 
		 		}
		 	}


  
		if($attd_data['log'] == 'Emergency'){

			$log_shot_code = 'E';
		}
		else if($attd_data['log'] == 'Logout'){

			$log_shot_code = 'L';
		}
		else if($attd_data['log'] == 'Permission'){

			$log_shot_code = 'PE';
		}
		else{
			$log_shot_code = 'P';
		}


		

		if($attd_data['attendance_type'] == 1){ 

			 $log = array('curr_date'=>date('Y-m-d'),'lon'=>$loc['lon'],'lat'=>$loc['lat'],'place'=>$loc['city'],'log_shot_code'=>$log_shot_code);
		}
		else{
			 $log = array('curr_date'=>date('Y-m-d'),'lon'=>$loc['lon'],'lat'=>$loc['lat'],'place'=>$loc['city'],'log_shot_code'=>$log_shot_code);
		}

		$attd_data = $attd_data + $log;

		 $this->db->insert(ATTENDANCE,$attd_data);

		 

	}

	public function update_staff($data,$staff_id)
	{

		$this->db->where('staff_id',$staff_id);
	 	$this->db->update(STAFF_DETAILS,$data);
	}




	
}

?>