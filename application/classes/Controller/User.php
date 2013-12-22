<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller {

	public function action_index()
	{
		$view = View::factory('user');
		$this->response->body($view);
	}

	public function action_profile()
	{
		$user_id = $this->request->param('id', NULL);

		if($user_id !== NULL)
		{
			$view = View::factory('profile/profile');

			$profile_service = new Service_UserProfile();
			$view->info = $profile_service->get_overview_info($user_id);

			//TODO: query work count
			$view->work_count = array('publication' => 0, 'project' => 0, 'presentation' => 0);

			$view->user_id = $user_id;

			$this->response->body($view);
		}
	}

	public function action_follow()
	{
		$user_id = $this->request->param('id');
		$current_user_id = Service_Login::get_user_in_session();

		$follow_service = Service_UserFollow::instance();

		$follow_service->follow($current_user_id, $user_id);
	}

	public function action_unfollow()
	{
		$user_id = $this->request->param('id');
		$current_user_id = Service_Login::get_user_in_session();

		$follow_service = Service_UserFollow::instance();

		$follow_service->unfollow($current_user_id, $user_id);
	}
}