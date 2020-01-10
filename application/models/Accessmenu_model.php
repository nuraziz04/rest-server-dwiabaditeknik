<?php

class Accessmenu_model extends CI_Model
{
	public function addAccessMenu($data)
	{
		$this->db->insert('user_access_menu', $data);
		return $this->db->affected_rows();
	}

	public function deleteAccess($data)
	{
		$this->db->delete('user_access_menu', $data);
		return $this->db->affected_rows();
	}
}