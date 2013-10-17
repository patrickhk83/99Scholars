<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller {

	public function action_index()
	{
		$login_service = new Service_Login();

		$email = $this->request->post('email');
		$password = $this->request->post('password');
		

		if($login_service->login($email, $password))
		{
			$this->redirect('/', 302);
		}
		else
		{
			echo "fail";
		}
		
	}
}