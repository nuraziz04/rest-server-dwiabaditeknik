<?php

class User_model extends CI_Model
{
	public function getUser($id = null, $email = null)
	{
		if($id === null and $email === null){
			return $this->db->get('user')->result_array();
		} else if($email === null) {
			return $this->db->get_where('user', ['id' => $id])->result_array();
		} else {
			return $this->db->get_where('user', ['email' => $email])->result_array();
		}
		
	}

	public function createUser($data)
	{
		$this->db->insert('user', $data);
		return $this->db->affected_rows();
	}

}