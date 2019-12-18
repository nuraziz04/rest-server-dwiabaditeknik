<?php

class Submenu_model extends CI_Model
{
	public function getSubmenu()
	{
		return $this->db->get('user_sub_menu')->result_array();
	}

}