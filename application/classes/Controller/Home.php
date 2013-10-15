<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller {

	public function action_index()
	{

		$view = View::factory('home');

		//list conference
		$confService = new Service_Conference();
		$result = $confService->list_all();

		$view->total = $result['total'];
		$view->conferences = $result['conferences'];

		$this->response->body($view);
	}
}