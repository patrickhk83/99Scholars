<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller {

	public function action_index()
	{

		$view = View::factory('home');

		//list conference
		$confService = new Service_Conference();
		$view->conferences = $confService->list_all();

		$this->response->body($view);
	}
}