<?php
class Nonteching_approvalModel Extends CI_Model{

public function Leave_approval($data,$leave_id)
{

		$cl_change = array('emp_leave_id'=>$leave_id,'staff_id'=>$data['staff_id'],'role_type'=>2);  
 
		if($data['status'] == 3)
		{


			$update_array = array('approve_status'=>$data['status'],'alter_staff1_status'=>1,'alter_staff2_status'=>1);
			$this->common_staff_details->InsertLeavManagement($cl_change,1);
			$alert = 'Already Approved';
			$success_alert = 'Successfully Approved';
		}else{
			$update_array = array('approve_status'=>$data['status']);
			$this->common_staff_details->InsertLeavManagement($cl_change,0);
			$alert = 'Already Rejected';
			$success_alert = 'Successfully Rejected';
		}

		
		$this->db->where('staff_id',$data['staff_id']);
		$this->db->where('emp_leave_id',$leave_id);
		$this->db->where('approve_status',$data['status']);
		$exist_rec = $this->db->get(STAFF_LEAVE); 
		$exist_or_not = $exist_rec->num_rows();




		$this->db->where('staff_id',$data['staff_id']);
		$this->db->where('emp_leave_id',$leave_id); 
		$staff_leave = $this->db->get(STAFF_LEAVE)->row_array(); 
	  
		if($staff_leave['leave_day_type'] == 'HD')
		{
			$total_leaves = 0.5;
		}else{
			$total_leaves = $staff_leave['total_days'];
		}
		

		if($exist_or_not == 0){ 
			
 

			$this->db->where('staff_id',$data['staff_id']);
			$this->db->where('emp_leave_id',$leave_id);
			$this->db->update(STAFF_LEAVE,$update_array); 


			$this->db->where('s.staff_id',$data['staff_id']);
			$this->db->where('a.emp_leave_id',$leave_id);
			$this->db->from(''.STAFF_DETAILS.' as s');
			$this->db->join(' '.STAFF_LEAVE.' as a','s.staff_id = a.staff_id','INNER');
			$this->db->join(''.ROLE.' as r','s.role_id = r.role_id AND r.status = 1' ,'LEFT');
			$this->db->join(' '.COLLEGE_DETAILS.' as c','s.college_id = c.college_id','INNER');
			$user_data = $this->db->get()->row_array();

			
			$name = $user_data['firstname'].'&nbsp;'.$user_data['lastname'] ;
			$college_name = $user_data['college_name'];
			$applay_date = date('d-m-Y',strtotime($user_data['apply_date']));
			$from_date = date('d-m-Y',strtotime($user_data['from_date']));
			$to_date = date('d-m-Y',strtotime($user_data['to_date']));
			$total_days = $user_data['total_days'];
			$subject = $user_data['leave_subject'];
			$reason = $user_data['reason'];
			$email_id=  $user_data['email_id'];
			if($data['status'] == 0)
			{
				$status = '<b style="color:#db3c30;">Your Leave Request is Cancelled !</b>';
			}else{

				$status = '<b style="color:#4caf50;">Your Leave Request is Approved !</b>';
			}

			if($data['status'] == 0)
			{
				$status_title = 'Your Leave Request is Cancelled !';
			}else{

				$status_title = 'Your Leave Request is Approved !';
			}

			if($total_days > 1)
			{
				$day_title = 'Total Days';
			}else{

				$day_title = 'Total Day';
			}
			

				
					$to = $email_id;
					$subject = "".$status_title."";
					$message = '<p style="font-size: 18px;">Name : '.$name.' </p> 
								<p style="font-size: 18px;">Apply Date : '.$applay_date.' </p>
								<p style="font-size: 18px;">From Date : '.$from_date.' </p> 
								<p style="font-size: 18px;">To Date : '.$to_date.' </p>
								<p style="font-size: 18px;">'.$day_title.' : '.$total_leaves.' </p>
								<p style="font-size: 18px;">Reason : '.$reason.' </p>
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

					if(($user_data['role'] ==  'PRINCIPAL' || $user_data['role'] ==  'DEAN') && $data['status'] != 0){
						$mail->AddAddress('sivakumar@mahendra.org');	
					}

						$mail->AddAddress($to);
					
					if(!$mail->Send()){
						echo "Mailer Error: " . $mail->ErrorInfo;
					}
				



			echo "<script> alert('".$success_alert."'); window.close();</script>";
		}
		else{
			echo "<script> alert('".$alert."');  window.close();</script>";
		}	
}


	
}

?>