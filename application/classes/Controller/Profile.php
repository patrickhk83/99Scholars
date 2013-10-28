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
			$user_id = $login_service->get_user_in_session();

			$user_service = new Service_User();
			$result = $user_service->get_by_id($user_id);

			$view = View::factory('profile');
			$view->first_name = $result['first_name'];
			$view->last_name = $result['last_name'];
			$this->response->body($view);
		}
	}
}