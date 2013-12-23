<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Messages extends Controller {

	public function action_index()
	{
		
	}

	public function action_conversation()
	{
		$conver_id = $this->request->param('id');
	}
}