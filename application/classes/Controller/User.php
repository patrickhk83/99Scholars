<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller {

	public function action_index()
	{
		$view = View::factory('user');
		$this->response->body($view);
	}

	public function action_view()
	{
		$user_id = $this->request->param('id', NULL);

		if($user_id !== NULL)
		{
			$view = View::factory('profile/profile');

			$profile_service = new Service_UserProfile();
			$view->info = $profile_service->get_overview_info($user_id);

			//TODO: query work count
			$view->work_count = array('publication' => 0, 'project' => 0, 'presentation' => 0);

			$this->response->body($view);
		}
	}
}