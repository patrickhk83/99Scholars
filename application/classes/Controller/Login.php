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
			//Create instance for Service_UserAction class.
			$user_action_track = new Service_UserAction();
			//Register Login Action for logged in User(ControllerName , ActionName)
            $user_action_track->register_user_action($this , 'login');
            
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

		$success = Auth::instance()->login($email, $password);
        
        if ($success)
        {
            return true;
        }
        else
        {
            return false;
        }
	}
}