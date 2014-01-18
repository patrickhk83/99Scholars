<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Logout extends Controller {

	public function action_index()
	{
		$aaa = new Service_UserAction();
        $aaa->register_user_action($this , 'logout');

		Auth::instance()->logout();

		$this->redirect('/', 302);
	}
}