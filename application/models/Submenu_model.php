<?php

class Submenu_model extends CI_Model
{
	public function getSubmenu()
	{
		return $this->db->get('user_sub_menu')->result_array();
	}

	public function addSubMenu($data)
	{
		$this->db->insert('user_sub_menu', $data);
		return $this->db->affected_rows();
	}

	public function editSubMenu($data, $id)
	{
		$this->db->update('user_sub_menu', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function deleteSubMenu($id)
	{
		$this->db->delete('user_sub_menu', ['id' => $id]);
		return $this->db->affected_rows();
	}

}