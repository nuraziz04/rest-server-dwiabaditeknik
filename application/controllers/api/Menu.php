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

		if($menuId === null){
			$menu = $this->menu->getMenu($roleId, $menuId);
		} else {
			$menu = $this->menu->getMenu($roleId, $menuId);
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

}