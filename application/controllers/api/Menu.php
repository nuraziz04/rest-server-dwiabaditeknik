<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Menu extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model', 'menu');
	}

	public function index_get()
	{
		$roleId = $this->get('roleId');
		$menuId = $this->get('menuId');
		$namaMenu = $this->get('namaMenu');

		if($roleId === null and $menuId === null and $namaMenu === null){
			$menu = $this->menu->getMenu($roleId, $menuId, $namaMenu);
		} else {
			$menu = $this->menu->getMenu($roleId, $menuId, $namaMenu);
		} 
		
		if($menu){
			$this->response([
	            'status' => '00',
	            'data' => $menu 
	        ], REST_Controller::HTTP_OK);
		} else {
			$this->response([
	            'status' => '404',
	            'data' => $menu
	        ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id');

		if($id === null){
			$this->response([
	            'status' => false,
	            'message' => 'provide an id'
	        ], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if($this->menu->deleteMenu($id) > 0){
				$this->response([
		            'status' => true,
		            'id' => $id,
		            'message' => 'Delete'
	        	], REST_Controller::HTTP_OK);
			} else {
				$this->response([
		            'status' => false,
		            'message' => 'id not found'
	        	], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

}