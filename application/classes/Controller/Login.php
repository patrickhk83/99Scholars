<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller {

	public function action_index()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$login_service = new Service_Login();

			$email = $this->request->post('email');
			$password = $this->request->post('password');
			

			if($login_service->login($email, $password))
			{
				$this->redirect('/profile', 302);
			}
			else
			{
				$view = View::factory('login');

				//TODO: add type of error
				$view->error = "Can not sign in to 99Scholars. Please check your email and password";
				$this->response->body($view);
			}
		}
		else
		{
			$view = View::factory('login');
			$this->response->body($view);
		}

		
		
	}
}