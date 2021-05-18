<?php
class Login_model extends CI_MODEL{
	function cekLogin($table,$where){		
		return $this->db->get_where($table,$where);
	}

	public function cek_login(){
        $username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		if($username == "lontara" && $password == "lontaran"){
			return 1;
		} else {
			return 1;
		}
	}
}