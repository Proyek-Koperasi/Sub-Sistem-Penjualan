<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function login($user, $pass, $level)
		{
			$this->db->select('*');
			$this->db->where('username', $user);
			$this->db->where('password', $pass);
			$this->db->where('level', $level);
			$data = $this->db->get('userLogin', 1);
			return $data->result();
		}	

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */