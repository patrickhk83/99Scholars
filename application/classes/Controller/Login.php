<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller {

	public function action_index()
	{
		$view = View::factory('login');
		$this->response->body($view);
	}

	public function action_email()
	{

		if(HTTP_Request::POST != $this->request->method())
		{
			$view = View::factory('login');
			$this->response->body($view);	
		}

		$validation = Validation::factory($this->request->post())
			->rule('password', 'not_empty')
			->rule('email', 'email');

		$email = $this->request->post('email');
		$password = $this->request->post('password');

		if($validation->check() AND $this->authenticate_by_email($email, $password))
		{
			$this->redirect('/profile', 302);
		}
		else
		{
			$view = View::factory('login');
			$view->error = 'Can not sign in to 99Scholars. Please check your email and password';
			$this->response->body($view);
		}
	}

	protected function authenticate_by_email($email, $password)
	{
		$user = ORM::factory('User')->where('email', '=', $email)->find();
		if($user->way !== 'email')
		{
			return false;
		}

		if($user->loaded() AND $user->password === md5($password))
		{
			$session = Session::instance();
			$session->set('login', 'true');
			$session->set('user', $user->id);
			return true;
		}

		return false;
	}
}