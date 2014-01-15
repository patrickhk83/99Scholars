<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Logout extends Controller {

	public function action_index()
	{
		$aaa = new Service_UserAction();
        $aaa->register_user_action($this , 'logout');

		$login_service = new Service_Login();
		$login_service->clear_login_info();

		$this->redirect('/', 302);
	}
}