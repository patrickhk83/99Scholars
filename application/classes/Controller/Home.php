<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller {

	public function action_index()
	{

		$view = View::factory('home');
		
		$user_id = Service_Login::get_user_in_session();

		//list conference
		$confService = new Service_Conference();
		$result = $confService->list_all($user_id);

		$view->total = $result['total'];
		$view->conferences = $result['conferences'];
		$view->countries = Model_Constants_Address::$countries;

		$this->response->body($view);
	}
}