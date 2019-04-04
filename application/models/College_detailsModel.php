<?php
class College_detailsModel Extends CI_Model{


	public function Insert_college_details($college_details,$college_id,$usr_data){


		


		if($college_id == ''){



			$this->db->insert(COLLEGE_DETAILS,$college_details);

			$insert_id = $this->db->insert_id();

			$usr_data = $usr_data+ array('college_id'=>$insert_id,'user_type_id'=>0);

			$this->db->insert(USERS,$usr_data);
		}
		else{
			$this->db->where('college_id',$college_id);
			$this->db->update(COLLEGE_DETAILS,$college_details);

			$this->db->where('college_id',$college_id);
			$this->db->update(USERS,$usr_data);
   
		}	

	}

	public function getCollege_details(){

		$this->db->where('status',1);
		$college_data = $this->db->get(COLLEGE_DETAILS)->result_array();

		print_r(json_encode($college_data));
	}


	public function edit_college_details($college_id){

		$this->db->where('status',1);
		$this->db->where('college_id',$college_id);
		$college_data = $this->db->get(COLLEGE_DETAILS)->row_array();
		print_r(json_encode($college_data)); 
	}

	public function delete_college_details($college_id){



		$up_array = array('status'=>0);
 
		$this->db->where('college_id',$college_id);
		 $this->db->update(COLLEGE_DETAILS,$up_array); 
	}
}

?>