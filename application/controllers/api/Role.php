<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Role Extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Role_model', 'role');
	}

	public function index_get()
	{
		$id = $this->get('id');

		$role = $this->role->getRole($id);

		if($role){
			$this->response([
				'status' => '00',
				'data' => $role
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => '404',
				'data' => $role
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

}