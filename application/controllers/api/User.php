<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'usr');
	}

	public function index_get()
	{
		$id = $this->get('id');
		$email = $this->get('email');

		if($id === null and $email === null){
			$user = $this->usr->getUser();
		} else if($email === null){
			$user = $this->usr->getUser($id, $email);
		} else {
			$user = $this->usr->getUser($id, $email);
		}

		if($user){
			$this->response([
	            'status' => '00',
	            'data' => $user
	        ], REST_Controller::HTTP_OK);
		} else {
			$this->response([
	            'status' => '404',
	            'data' => $user
	        ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_post()
	{
		$data = [
			'name' => $this->post('name'),
			'email' => $this->post('email'),
			'image' => 'default.jpg',
			'password' => password_hash($this->post('password'), PASSWORD_DEFAULT),
			'role_id' => 2,
			'is_active' => 1,
			'created_date' => time()
		];

		if($this->usr->createUser($data) > 0){
			$this->response([
        		'status' => true,
	            'message' => 'new user has been created'
	        ], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
	            'status' => false,
	            'message' => 'failed to created data'
        	], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

} 