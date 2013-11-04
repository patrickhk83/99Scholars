<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Conference extends Controller {

	public function action_view()
	{
		$id = $this->request->param('id');

		//mockup page
		$session_id = $this->request->param('session_id');
		if(isset($session_id))
		{
			$view = View::factory('presentation');
			$this->response->body($view);
		}
		else
		{
			//disable for mockup	
			//$view = View::factory('conf-view');

			$conf_service = new Service_Conference();
			$conf = $conf_service->get_for_view($id);

			//TODO: properly check conference type
			if($conf['type'] == 'Seminar')
			{
				$view = View::factory('seminar');
				$view->info = $conf;

				$attendees = $conf_service->get_attendee($id);
				$view->info['attendees'] = $attendees;

				$view->id = $id;
				$this->response->body($view);
			}
			else
			{
				$view = View::factory('schedule');
				$view->id = $id;
				$this->response->body($view);
			}
		}
	}

	public function action_submit()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			
			if(Service_Login::is_login())
			{
				//save conference data to database
				$conf_service = new Service_Conference();
				$id = $conf_service->create($this->request->post());

				//display newly created conference using id
				$this->redirect('/conference/view/'.$id, 302);
			}
			else
			{
				//store conference info in session
				$session = Session::instance();
				$session->set('tmp_conf', $this->request->post());

				//redirect to signup page
				$this->redirect('/signup/after_submit', 302);
			}
		}
		else
		{
			$view = View::factory('conf-submit');
			$this->response->body($view);
		}
	}

	public function action_search()
	{
		$category = $this->request->query('cat');
		$accept_abstract = $this->request->query('abstract');
		$start_date = $this->request->query('start_date');
		$end_date = $this->request->query('end_date');
		$type = $this->request->query('type');
		$country = $this->request->query('country');
		$page = $this->request->query('page');

		if(!isset($page) || $page == '' || $page == 0)
		{
			$page = 1;
		}

		$conf_service = new Service_Conference();
		$result = $conf_service->list_by($category, $accept_abstract, $start_date, $end_date, $type, $country, $page-1);

		$view = View::factory('conf-search-result');
		$view->conferences = $result['conferences'];

		if(array_key_exists('total', $result))
		{
			$view->total = $result['total'];
		}

		$this->response->body($view);
	}

	public function action_attend()
	{
		$conf_id = $this->request->param('id');
		$user_id = Service_Login::get_user_in_session();

		$user_service = new Service_User();
		$user_service->attend_conference($user_id, $conf_id);
	}
}