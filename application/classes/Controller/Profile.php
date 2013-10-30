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

			$view->is_owner = TRUE;

			//TODO: query work count
			$view->work_count = array('publication' => 0, 'project' => 0, 'presentation' => 0);

			$view->first_name = $result['first_name'];
			$view->last_name = $result['last_name'];

			$contact = $user_service->get_contact_info($user_id);
			$view->contact_info = $contact;

			$this->response->body($view);
		}
	}

	//for loading user's profile tab via ajax
	public function action_view()
	{
		$work_type = $this->request->param('id');

		//TODO: Add service to handle different type of work
		$view = View::factory('user_'.$work_type);
		$this->response->body($view);
	}


	public function action_edit()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$update_type = $this->request->param('id');

			$profile_service = new Service_UserProfile();
			$profile_service->update($update_type, $this->request->post());

			//TODO: return status in json format
			echo 'ok';
		}
		else
		{
			$login_service = new Service_Login();
			$user_id = $login_service->get_user_in_session();

			$user_service = new Service_User();
			$user = $user_service->get_info_for_editing($user_id);

			$view = View::factory('profile_edit');
			$view->user = $user;
			$this->response->body($view);
		}
	}
}