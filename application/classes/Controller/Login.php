<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller {

	protected $loginService;

	public function before()
	{
		$this->loginService = new Service_Login();
	}

	public function action_index()
	{
		$email = $this->request->post('email');
		$password = $this->request->post('password');
		

		if($this->loginService->login($email, $password))
		{
			$this->redirect('/', 302);
		}
		else
		{
			echo "fail";
		}
		
	}
}