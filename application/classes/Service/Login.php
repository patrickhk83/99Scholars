<?php defined('SYSPATH') or die('No direct script access.');

class Service_Login {

	public function login($email, $password)
	{
		//TODO: Do authorization using Auth module, and login info should be in session
		if($email == 'admin@99scholars.org' && $password == 'password')
		{
			Cookie::set('login', 'true');
			Cookie::set('user', '1');
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
}