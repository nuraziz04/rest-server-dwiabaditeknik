<?php

class Role_model extends CI_Model
{
	public function getRole($id)
	{
		if($id === null){
			return $this->db->get('user_role')->result_array();
		} else {
			return $this->db->get_where('user_role', ['id' => $id])->row_array();
		}
		
	}
}