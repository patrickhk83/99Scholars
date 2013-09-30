<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Conference extends Controller {

	public function action_view()
	{
		$id = $this->request->param('id');
		
		$view = View::factory('conf-view');

		$conf_service = new Service_Conference();
		$conf = $conf_service->get_for_view($id);

		$view->conf = $conf;

		$this->response->body($view);
	}

	public function action_submit()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			//check login, should get from session
			$login = Cookie::get('login');
			
			if($login)
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
}