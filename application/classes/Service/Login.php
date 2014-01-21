<?php defined('SYSPATH') or die('No direct script access.');

class Service_Login {

	public static function get_user_in_session()
	{
		if(Auth::instance()->logged_in())
		{
			return Auth::instance()->get_user()->pk();
		}
		else
		{
			return NULL;
		}
	}

	public static function is_login()
	{
		return Auth::instance()->logged_in();
	}
}