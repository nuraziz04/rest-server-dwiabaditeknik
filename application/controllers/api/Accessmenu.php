<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Accessmenu Extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Accessmenu_model', 'access');
	}

	public function index_post()
	{
		$data = [
			'role_id' => $this->post('roleId'),
			'menu_id' => $this->post('menuId')
		];

		if($this->access->addAccessMenu($data) > 0){
			$this->response([
				'status' => true,
				'message' => 'new access menu has been created'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed to created data'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_delete()
	{
		$data = [
			'role_id' => $this->delete('roleId'),
			'menu_id' => $this->delete('menuId')
		];

		if($data === null){
			$this->response([
	            'status' => false,
	            'message' => 'provide an roleId/mneuId'
	        ], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if($this->access->deleteAccess($data) > 0){
				$this->response([
		            'status' => true,
		            'id' => $data,
		            'message' => 'delete succes'
	        	], REST_Controller::HTTP_OK);
			} else {
				$this->response([
		            'status' => false,
		            'id' => $data,
		            'message' => 'roleId/menuId not found'
	        	], REST_Controller::HTTP_NOT_FOUND);
			}
		}
	}

}