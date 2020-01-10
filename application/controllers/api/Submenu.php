<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Submenu extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Submenu_model', 'submenu');
	}

	public function index_get()
	{
		$id = $this->get('id');

		$submenu = $this->submenu->getSubmenu($id);

		if($submenu){
			$this->response([
	            'status' => '00',
	            'data' => $submenu 
	        ], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => '404',
				'data' => $submenu
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_post()
	{
		$data = [
			'menu_id' => $this->post('menuId'),
			'title' => $this->post('title'),
			'url' => $this->post('url'),
			'icon' => $this->post('icon'),
			'is_active' => $this->post('isActive')
		];

		if($this->submenu->addSubMenu($data) > 0){
			$this->response([
				'status' => '00',
				'data' => 'new submenu has been created.'
			], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
				'status' => '404',
				'message' => 'failed to created data'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_put()
	{
		$id = $this->put('id');

		$data = [
			'menu_id' => $this->put('menuId'),
			'title' => $this->put('title'),
			'url' => $this->put('url'),
			'icon' => $this->put('icon'),
			'is_active' => $this->put('isActive')
		];

		if($this->submenu->editSubMenu($data, $id) > 0){
			$this->response([
				'status' => '00',
				'message' => 'submenu has been updated'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => '404',
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
				'message' => 'provide in id'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if ($this->submenu->deleteSubMenu($id) > 0) {
				$this->response([
					'status' => true,
					'id' => $id,
					'message' => 'delete success'
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => false,
					'id' => $id,
					'message' => 'id not found'
				]);
			}
		}
	}
}