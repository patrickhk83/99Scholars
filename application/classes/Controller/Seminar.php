<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Seminar extends Controller {

	public function action_index()
	{
		$view = View::factory('seminar');
		$this->response->body($view);
	}
}