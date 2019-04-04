<?php
class LoginModel Extends CI_Model{

	public function login($login_data){



		 $this->db->where('username',$login_data['user_name']);
		 $this->db->where('status',1);
		 $this->db->where('password',md5($login_data['usr_password']));
		 $user_details = $this->db->get(USERS)->result_array();

		 return $user_details;
		  
	}

	public function send_all_mail(){

		$this->db->where('s.status',1);
		$this->db->where('s.s_id >',191);
		$this->db->from(''.STAFF_DETAILS.' as s');
		$this->db->select('s.staff_id,s.email_id,u.username');
		$this->db->join(''.USERS.' as u','u.user_type_id = s.s_id','INNER');
		$get_all_mail = $this->db->get()->result_array();

			/*$usr_name = '7128';

			$pass = 'admin';


			
			$to = 'karthickitdeveloper@gmail.com'; 
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
						} */
		

		/*foreach($get_all_mail as $mail){
		
			if(isset($mail['email_id']) && $mail['email_id'] !='' ){
			
			$usr_name = $mail['username'];

			$pass = 'admin';


			
			$to = $mail['email_id'];
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
		}*/

	}

	public function leave_count()
	{

		$this->db->where('l.status',1);
		$this->db->from(''.LEAVE_MANAGEMENT.' as l');
		$leave_count = $this->db->get()->result_array();

		
		foreach ($leave_count as $key => $value) {
			$ccl_count = $value['ccl_total'];

			for ($i=0; $i<$ccl_count ; $i++) { 
			
				$user_insert = array('staff_id'=>$value['staff_id'],'ccl_count'=>1,'created_date'=>'2019-01-01','status'=>1);
				$this->db->insert(CCL_COUNT,$user_insert);	
					
				
			}

		}


		
		
		
	}

}

?>