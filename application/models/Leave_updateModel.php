<?php
class Leave_updateModel Extends CI_Model{

		public function Leave_upate($staff_id)
		{

				$this->db->from(''.LEAVE_MANAGEMENT.' as lm');
				$this->db->select('s.firstname,s.lastname,lm.staff_id,lm.leave_id,lm.cl_total,lm.ccl_total');
				$this->db->join(''.STAFF_DETAILS.' as s','s.staff_id = lm.staff_id' ,'INNER');
				$this->db->where('lm.staff_id',$staff_id);
				$get_staff_leave = $this->db->get()->result_array(); 

			return $get_staff_leave;					

		}

	

	public function Update_leave($data,$leave_id)
	{


		$this->db->from(''.LEAVE_MANAGEMENT.' as lm');
		$this->db->select('lm.leave_id,lm.cl_total,lm.ccl_total,lm.staff_id');
		$this->db->where('lm.leave_id',$leave_id);
		$get_leave = $this->db->get()->row_array(); 

		

		

		if($data['ccl_total'] > $get_leave['ccl_total'])
		{

			$date = date('Y-m-d', strtotime('+6 months'));

			$ccl_count = $data['ccl_total'] -  $get_leave['ccl_total'];

			$leave_count = explode('.', (string) $ccl_count);

			
			
			for ($i=0; $i < $leave_count[0] ; $i++) { 
				
				$l_data = array('staff_id'=>$get_leave['staff_id'],'ccl_count'=>1,'created_date'=>$date,'status'=>1);

				$this->db->insert(CCL_COUNT,$l_data);
			}

			if(isset($leave_count[1]))
			{

				$l_data_1 = array('staff_id'=>$get_leave['staff_id'],'ccl_count'=>0.5,'created_date'=>$date,'status'=>1);

				$this->db->insert(CCL_COUNT,$l_data_1);
			}

				

		}else{

				$ccl_count = $data['ccl_total'] - $get_leave['ccl_total'];

				$count = abs($ccl_count);
				
				$leave_count_1 = explode('.', (string) $count);


				
				if($leave_count_1[0] >= 1)
				{

				$this->db->where('staff_id',$get_leave['staff_id']);
				$this->db->where('status',1);
				$this->db->order_by('created_date','ASC');
				$this->db->limit($leave_count_1[0]);
				$this->db->delete(CCL_COUNT);

				}

				

				if(isset($leave_count_1[1]))
				{
					

				$this->db->where('staff_id',$get_leave['staff_id']);
				$this->db->where('ccl_count',0.5);
				$this->db->where('status',1);
				$this->db->order_by('created_date','ASC');
				$this->db->limit(1);
				$this->db->delete(CCL_COUNT);

				}

			}

			
			
			$this->db->where('staff_id',$get_leave['staff_id']);
			$this->db->update(LEAVE_MANAGEMENT,$data);

		}

}
?>