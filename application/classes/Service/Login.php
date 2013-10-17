<?php defined('SYSPATH') or die('No direct script access.');

class Service_Login {

	public function login($email, $password)
	{
		$user_service = new Service_User();
		$user = $user_service->get_by_email($email);

		//TODO: throw exception instead of returning null
		if(isset($user))
		{
			if($user['password'] === $user_service->encrypt_password($password))
			{
				Cookie::set('login', 'true');
				Cookie::set('user', $user['id']);
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			
		}
		else
		{
			return FALSE;
		}
		
	}
}