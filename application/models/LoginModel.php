<?php
class LoginModel Extends CI_Model{

	public function login($login_data){



		 $this->db->where('username',$login_data['user_name']);
		 $this->db->where('status',1);
		 $this->db->where('password',md5($login_data['usr_password']));
		 $user_details = $this->db->get(USERS)->result_array();

		 return $user_details;
		  
	}
}

?>