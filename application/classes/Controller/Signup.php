<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Signup extends Controller {

	public function action_index()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			//TODO: add user

			//redirect to profile page
			$this->response->redirect('profile');
			
		}
		else
		{
			$view = View::factory('signup');
			$this->response->body($view);
		}
		
	}

	public function action_after_submit()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			//TODO: add user

			$session = Session::instance();
			$tmp_conf = $session->get('tmp_conf');

			//add conference
			$conf_service = new Service_Conference();
			$conf_service->create($tmp_conf);

			//redirect to conference page
			//TODO: get id after create conference
			$this->request->redirect('conference/1', 302);
		}
		$view = View::factory('signup');

		$view->after_submit = TRUE;
		$this->response->body($view);
	}
}