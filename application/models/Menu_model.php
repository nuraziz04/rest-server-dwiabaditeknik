<?php

class Menu_model extends CI_Model
{
	public function getMenu($roleId, $menuId, $namaMenu)
	{

		if($roleId === null and $menuId === null and $namaMenu === null){
			return $this->db->get('user_menu')->result_array();
		} else if($menuId === null and $namaMenu === null) {
		    $queryMenu = "select a.id, a.id_menu
		                  FROM user_menu a 
		                  JOIN user_access_menu b
		                  ON a.id = b.menu_id
		                  WHERE b.role_id = $roleId
		                  ORDER BY b.menu_id ASC
		                ";
		    return $this->db->query($queryMenu)->result_array();
		} else if($roleId === null and $namaMenu === null){
			$querySubMenu = "select * from user_sub_menu a
							 join user_menu b
							 on a.menu_id = b.id
							 where a.menu_id = $menuId and a.is_active = 1
			";
			return $this->db->query($querySubMenu)->result_array();
		} else if($roleId === null and $menuId === null) {
			return $this->db->get_where('user_menu', ['id_menu' => $namaMenu])->result_array();
		} else {
			$userAccess = $this->db->get_where('user_access_menu', [
				'role_id' => $roleId,
				'menu_id' => $menuId
			]);

			return $userAccess->result_array();
		}
	}

	public function deleteMenu($id)
	{
		$this->db->delete('user_menu', ['id' => $id]);
		return $this->db->affected_rows();
	}
}