<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Profile extends Controller {

	public function action_index()
	{

		if(!Service_Login::is_login())
		{
			$this->redirect('/', 302);
		}
		else
		{
			$user_id = Service_Login::get_user_in_session();

			$profile_service = new Service_UserProfile();

			$view = View::factory('profile/profile');

			$view->info = $profile_service->get_overview_info($user_id);

			$view->is_owner = TRUE;

			//TODO: query work count
			$view->work_count = array('publication' => 0, 'project' => 0, 'presentation' => 0);

			$view->user_id = $user_id;


			$this->response->body($view);
		}
	}

	public function action_event()
	{
		$tab_name = 'event';
		$user_id = $this->request->param('id');
		$view = $this->render_tab($user_id, $tab_name);

		$this->response->body($view);
	}

	public function action_publication()
	{
		$tab_name = 'publication';
		$user_id = $this->request->param('id');
		$view = $this->render_tab($user_id, $tab_name);

		$this->response->body($view);
	}

	public function action_project()
	{
		$tab_name = 'project';
		$user_id = $this->request->param('id');
		$view = $this->render_tab($user_id, $tab_name);

		$this->response->body($view);
	}

	public function action_presentation()
	{
		$tab_name = 'presentation';
		$user_id = $this->request->param('id');
		$view = $this->render_tab($user_id, $tab_name);

		$this->response->body($view);
	}

	protected function render_tab($user_id, $tab_name)
	{
		$profile_service = new Service_UserProfile();
		$view = $profile_service->render_view_tab($user_id, $tab_name);

		return $view;
	}


	public function action_edit()
	{

		$tab_name = $this->request->param('id');

		if(isset($tab_name))
		{
			$user_id = Service_Login::get_user_in_session();

			$profile_service = new Service_UserProfile();
			$view = $profile_service->render_edit_tab($user_id, $tab_name);
			$this->response->body($view);
		} 
		else
		{
			$login_service = new Service_Login();
			$user_id = $login_service->get_user_in_session();

			$user_service = new Service_User();
			$user = $user_service->get_info_for_editing($user_id);

			$view = View::factory('profile/edit/profile_edit');
			$view->user = $user;
			$this->response->body($view);
		}
	}

	public function action_create()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$create_type = $this->request->param('id');

			$user_id = Service_Login::get_user_in_session();

			$profile_service = new Service_UserProfile();
			$result = $profile_service->create($create_type, $user_id, $this->request->post());

			$this->response->headers('Content-Type', 'application/json; charset=utf-8');
			$this->response->body(json_encode($result));
		}
	}

	public function action_update()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$update_type = $this->request->param('id');

			$profile_service = new Service_UserProfile();
			$profile_service->update($update_type, $this->request->post());

			//TODO: return status in json format
			echo 'ok';
		}
	}
	
	public function action_delete()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$update_type = $this->request->param('id');

			$profile_service = new Service_UserProfile();
			$profile_service->delete($update_type, $this->request->post());

			//TODO: return status in json format
			echo 'ok';
		}
	}

	public function action_select()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$update_type = $this->request->param('id');

			$profile_service = new Service_UserProfile();
			$profile_service->select($update_type, $this->request->post());

			//TODO: return status in json format
			echo 'ok';
		}
	}
}
