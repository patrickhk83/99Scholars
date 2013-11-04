<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller {

	public function action_index()
	{
		$view = View::factory('user');
		$this->response->body($view);
	}
}