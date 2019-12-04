<?php

class Menu_model extends CI_Model
{
	public function getMenu($roleId, $menuId)
	{
		if($menuId === null) {
		    $queryMenu = "select a.id, a.id_menu
		                  FROM user_menu a 
		                  JOIN user_access_menu b
		                  ON a.id = b.menu_id
		                  WHERE b.role_id = $roleId
		                  ORDER BY b.menu_id ASC
		                ";
		    return $this->db->query($queryMenu)->result_array();
		} else {
			$querySubMenu = "select * from user_sub_menu a
							 join user_menu b
							 on a.menu_id = b.id
							 where a.menu_id = $menuId and a.is_active = 1
			";
			return $this->db->query($querySubMenu)->result_array();
		}
	}
}