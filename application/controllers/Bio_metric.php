<?php
class Bio_metric Extends CI_Controller{


	function __construct(){

		parent:: __construct();

		$this->load->model('common/HeaderModel');
		$this->load->model('common/FooterModel');
		$this->load->model('Bio_metricModel');
	}

	public function index(){


		if(($this->session->userdata('user_type') == 'staff') || ($this->session->userdata('user_type') == 'super_admin')){

			redirect(base_url().'access_denied'); 
		}

		if(isset($_POST['college_id'])){

			if($_FILES['biometric_upload']['error'] == 0){
				$name = $_FILES['biometric_upload']['name'];

				$explode = explode(".", strtolower($name));

				$file_method  = end($explode);
 
			     
			    $type = $_FILES['biometric_upload']['type'];
			    $tmpName = $_FILES['biometric_upload']['tmp_name'];
 			 	
			      $upload_rec = array();

			     if($file_method === 'csv'){
			        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
			            // necessary if a large csv file
			            set_time_limit(0);

			            $row = 0;
			             $all_rec = array();
			            while(($data = fgetcsv($handle, 10000, ',')) !== FALSE) {

			            	$all_rec[] = $data;
 

			                $row++;
			            }

			            $bio_array = array();

			           
			            if($all_rec[3][1] != '' && $all_rec[3][1] == 'Company:'){
 
			            	$get_clg_name = $this->db->where('status',1)->where('college_short_name',strtoupper($all_rec[3][2]))->select('college_id,college_latitude,college_longitude')->get(COLLEGE_DETAILS)->row_array();
			            
			            	 $clg_id = $get_clg_name['college_id'];


			            }
			            else{
			            	$clg_id = 0;
			            }

 


			           	foreach($all_rec as $key=> $rec){ 
			           		

			           		if($rec[1] == 'Employee Code:'){

			           			if(strlen($all_rec[$key][3]) == 5){ // bio id == 5

			           				if($all_rec[$key + 2][9] != 'Absent'){

			           					$bio_id = $all_rec[$key][3];
			           					$this->db->from(''.STAFF_DETAILS.' as s');
			           					$this->db->where('s.status',1)->where('s.staff_id',$bio_id);
			           					$this->db->where('s.college_id',$clg_id)->select('s.staff_id,s.s_id,s.attadence_role,r.role');
			           					$this->db->join(''.ROLE.' as r','r.college_id = s.college_id','LEFT');
			           					$get_staff_name = $this->db->get()->row_array();

			           				 

			           					if($get_staff_name['staff_id']){
			           						$get_staff_name['staff_id'] = $get_staff_name['staff_id'];
			           						$get_staff_name['attadence_role'] = $get_staff_name['attadence_role'];
			           					} 
			           					else{
			           						$get_staff_name['staff_id'] = 0;
			           						$get_staff_name['attadence_role'] = 0;
			           					}




				           				$curr_date = date('Y-m-d', strtotime($all_rec[$key + 2][1]));



				           				$in_time = date('H:i:s', strtotime($all_rec[$key + 2][3]));
				           				$out_time = date('H:i:s', strtotime($all_rec[$key + 2][4]));
				           				$total_hrs = date('H:i:s', strtotime($all_rec[$key + 2][7]));


				           				$half_day_hrs = date('H:i:s', strtotime('03:00:00'));

				           				$full_day_hrs = date('H:i:s', strtotime('06:00:00'));

				           				$this->db->where('status',1);
									 	$this->db->where('college_id',$clg_id);
									 	$this->db->where('staff_atten_type',$get_staff_name['attadence_role']);
									 	$this->db->where('holiday_date',$curr_date);
									 	$get_leave_gl_all = $this->db->get(HOLIDAY_EVENT_FIX);
									 	$get_leave_gl = $get_leave_gl_all->num_rows();

									 	$get_leave_gl_row = $get_leave_gl_all->row_array();

										$nameOfDay = date('D', strtotime($get_leave_gl_row['holiday_date']));

							            if($get_leave_gl == 1){

									 		$select_leave_mng = $this->db->where('status',1)			  
										 	->where('staff_id',$get_staff_name['staff_id'])		
										 	->get(LEAVE_MANAGEMENT)
										 	->row_array();


										 	if(strtotime($total_hrs) >= strtotime($half_day_hrs) && strtotime($total_hrs) <= strtotime($full_day_hrs)){

					           					$add_leaves = $select_leave_mng['ccl_total'] + 0.5;

							 					$ccl_count = 0.5;
					           				}
					           				else if(strtotime($total_hrs) >= strtotime($full_day_hrs)){

					           					$add_leaves = $select_leave_mng['ccl_total'] + 1;

					           					$ccl_count = 1;
					           				}

										 	$up_array = array('ccl_total'=>$add_leaves);

										 	$ccl_expiry_date  = date('Y-m-d', strtotime($all_rec[$key + 2][1]. ' + 180 days'));

										 	if($get_staff_name['role'] == 'DEPUTY WARDEN' && ($nameOfDay !='Sat' || $nameOfDay != 'Sun')){


							 					$this->db->where('college_id',$clg_id)	
											 	->where('staff_id',$get_staff_name['staff_id'])	
											 	->update(LEAVE_MANAGEMENT,$up_array);

											 	$user_insert = array('staff_id'=>$get_staff_name['staff_id'],'ccl_count'=>$ccl_count,'created_date'=>$ccl_expiry_date,'status'=>1);
												$this->db->insert(CCL_COUNT,$user_insert); 
									 		}else{

									 			$this->db->where('college_id',$clg_id)	
											 	->where('staff_id',$get_staff_name['staff_id'])	
											 	->update(LEAVE_MANAGEMENT,$up_array);

											 	$user_insert = array('staff_id'=>$get_staff_name['staff_id'],'ccl_count'=>$ccl_count,'created_date'=>$ccl_expiry_date,'status'=>1);
												$this->db->insert(CCL_COUNT,$user_insert); 

									 		}
									 	} 

				           				$in_log = 'Present';
				           				$in_log_shot_code = 'P';

				           				$out_log = 'Logout';
				           				$out_log_shot_code = 'L';

				           				$in_attendance_type = 1;
				           				$out_attendance_type = 0;

				           				$in_created_on = date('Y-m-d H:i:s', strtotime($curr_date.' '.$in_time)); 

				           				$out_created_on = date('Y-m-d H:i:s', strtotime($curr_date.' '.$out_time));

				           				if($all_rec[$key + 2][3] != ''){
				           					$bio_array[] =  array(
									            	 	'curr_date'=>$curr_date,	
									            	 	'college_id'=>$clg_id,									            	 	 
									            	 	'staff_id'=> $get_staff_name['staff_id'],
									            	 	'log'=>$in_log,
									            	 	'log_shot_code'=>$in_log_shot_code,
									            	 	'attendance_type'=>$in_attendance_type,
									            	 	'lon'=>$get_clg_name['college_longitude'],
									            	 	'lat'=>$get_clg_name['college_latitude'],
									            	 	'place'=>'Mallasamudram West',
									            	 	'created_on'=>$in_created_on,
									            	 	/*'total_hrs'=>$total_hrs*/
									            	 	); 
				           				}


				           				if($all_rec[$key + 2][4] != ''){
				           					$bio_array[] =  array(
									            	 	'curr_date'=>$curr_date,
									            	 	'college_id'=>$clg_id,										            	 	 
									            	 	'staff_id'=> $get_staff_name['staff_id'],
									            	 	'log'=>$out_log,
									            	 	'log_shot_code'=>$out_log_shot_code,
									            	 	'attendance_type'=>$out_attendance_type,
									            	 	'lon'=>$get_clg_name['college_longitude'],
									            	 	'lat'=>$get_clg_name['college_latitude'],
									            	 	'place'=>'Mallasamudram West',
									            	 	'created_on'=>$out_created_on,
									            	 	/*'total_hrs'=>$total_hrs*/
									            	 	); 
				           				}

				           				 

				           				$this->GetAttd_permission($curr_date,$get_staff_name['staff_id'],$in_time,$out_time,$get_clg_name['college_longitude'],$get_clg_name['college_latitude']);
				           			 
			           				}
 
			           			}

			           			
			            	}
			           	}

			           $this->db->insert_batch(ATTENDANCE,$bio_array);
			           
			          
			            fclose($handle);
			        }
			    }
			}

			 // redirect(base_url().'bio_metric');
  
		}


		$data = '';
		$this->HeaderModel->header();
		$this->load->view('bio_metric');
		$this->FooterModel->footer();
	}



		public function GetAttd_permission($attd_date,$staff_id,$in,$out,$lon,$lat){



		/*echo $attd_date.'------'.$s_id.'------'.$in.'------'.$out.'------'.$lon.'------'.$lat.'<br>';		

		die();*/
		
	 	

		date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

		$get_attd = $this->db->where('status',1)->where('curr_date',$attd_date)->where('staff_id',$staff_id)->get(ATTENDANCE)->num_rows();

		 
		$get_permission = $this->db->where('status',1)->where('attd_date',$attd_date)->where('staff_id',$staff_id)->get(ATTENDANCE_PERMISSION);



		$get_permission_data = $get_permission->row_array();

		$get_permission_rows = $get_permission->num_rows();
		
	 
			$loc['lon'] = $lon;

			$loc['lat'] = $lat; 

			$loc['city'] = 'Mallasamudram West';

			$login_time = $in;
			$logout_time = $out;

			$late_entry_time_in = date('H:i:s', strtotime('09:21:00'));

		 	$late_entry_time_out = date('H:i:s', strtotime('09:35:00')); 

		 	$permis_last_time = date('H:i:s', strtotime('10:20:00'));

		 	$late_eve_in = date('H:i:s', strtotime('16:16:00')); 

		 	$permis_eve_in = date('H:i:s', strtotime('15:31:00')); 

		 	$permis_eve_out = date('H:i:s', strtotime('16:30:00')); 
 

		 	 if($get_attd == 0){  

		 		if(strtotime($login_time) >= strtotime($late_entry_time_in) && strtotime($login_time) <= strtotime($late_entry_time_out)){
	 
			 		if($get_permission_rows == 0){

			 			$attd_permim_log = array('staff_id'=>$staff_id,'attd_date'=>$attd_date,'permission'=>0,'late_entry'=>1,'permission_lon'=>$loc['lon'],'permission_lat'=>$loc['lat'],'permission_place'=>$loc['city']);

		 				$this->db->insert(ATTENDANCE_PERMISSION,$attd_permim_log);
			 		}
			 		else{
			 			$attd_permim_log = array('late_entry'=>1);

			 			$this->db->where('staff_id',$staff_id);
				 		$this->db->where('attd_date',$attd_date);
			 			$this->db->update(ATTENDANCE_PERMISSION,$attd_permim_log); 
			 		}
	 
		 		}
			 	
			 
			 	if(strtotime($login_time) >= strtotime($late_entry_time_out) && strtotime($login_time) <= strtotime($permis_last_time)){


			 			$attd_permim_log = array('staff_id'=>$staff_id,'attd_date'=>$attd_date,'permission'=>1,'late_entry'=>0,'permission_lon'=>$loc['lon'],'permission_lat'=>$loc['lat'],'permission_place'=>$loc['city']);

		 				$this->db->insert(ATTENDANCE_PERMISSION,$attd_permim_log);
			 		 
			 	}
			} 	


 
		 	if(strtotime($logout_time) >= strtotime($permis_eve_in) && strtotime($logout_time) <= strtotime($permis_eve_out) && $get_permission_rows == 0){

		 		if($get_permission_rows == 0){

		 			$attd_permim_log = array('staff_id'=>$staff_id,'attd_date'=>$attd_date,'permission'=>1,'late_entry'=>0,'permission_lon'=>$loc['lon'],'permission_lat'=>$loc['lat'],'permission_place'=>$loc['city']);

	 				$this->db->insert(ATTENDANCE_PERMISSION,$attd_permim_log);
		 		}
		 		else{
		 			$attd_permim_log = array('permission'=>1);

		 			$this->db->where('staff_id',$staff_id);
			 		$this->db->where('attd_date',$attd_date);
		 			$this->db->update(ATTENDANCE_PERMISSION,$attd_permim_log); 
		 		}
		 	}

			if(strtotime($logout_time) >= strtotime($late_eve_in) && strtotime($logout_time) <= strtotime($permis_eve_out) && $get_permission_rows == 0){ // eve permission

		 		if($get_permission_rows == 0){

		 			$attd_permim_log = array('staff_id'=>$staff_id,'attd_date'=>$attd_date,'permission'=>0,'late_entry'=>1,'permission_lon'=>$loc['lon'],'permission_lat'=>$loc['lat'],'permission_place'=>$loc['city']);

	 				$this->db->insert(ATTENDANCE_PERMISSION,$attd_permim_log);
		 		}
		 		else{
		 			$attd_permim_log = array('late_entry'=>1);

		 			$this->db->where('staff_id',$staff_id);
			 		$this->db->where('attd_date',$attd_date);
		 			$this->db->update(ATTENDANCE_PERMISSION,$attd_permim_log); 
		 		}
		 	}
			
		}
	
}


?>