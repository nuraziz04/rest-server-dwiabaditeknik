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
		$id = $this->get('id');

		if($roleId === null and $menuId === null and $namaMenu === null and $id === null){
			$menu = $this->menu->getMenu($roleId, $menuId, $namaMenu, $id);
		} else {
			$menu = $this->menu->getMenu($roleId, $menuId, $namaMenu, $id);
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

	public function index_post()
	{
		$data = [
			'id_menu' => $this->post('idMenu')
		];

		if($this->menu->addUserMenu($data) > 0){
			$this->response([
				'status' => true,
				'message' => 'new user menu has been created'
			], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed to created data'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put()
	{
		$id = $this->put('id');

		$data = [
			'id_menu' => $this->put('idMenu')
		];

		if($this->menu->editUserMenu($data, $id) > 0){
			$this->response([
				'status' => true,
				'message' => 'user menu has been updated.'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed to updated data'
			], REST_Controller::HTTP_BAD_REQUEST);
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
		            'message' => 'delete succes'
	        	], REST_Controller::HTTP_OK);
			} else {
				$this->response([
		            'status' => false,
		            'id' => $id,
		            'message' => 'id not found'
	        	], REST_Controller::HTTP_NOT_FOUND);
			}
		}
	}

}