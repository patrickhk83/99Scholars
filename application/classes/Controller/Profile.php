<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Profile extends Controller {

	public function action_index()
	{
		$login_service = new Service_Login();

		if(!$login_service->is_login())
		{
			$this->redirect('/', 302);
		}
		else
		{
			//TODO: get current user

			$view = View::factory('profile');
			$this->response->body($view);
		}
	}
}