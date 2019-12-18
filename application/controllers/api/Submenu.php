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
		$submenu = $this->submenu->getSubmenu();

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
}