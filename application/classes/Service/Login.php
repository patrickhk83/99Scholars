<?php defined('SYSPATH') or die('No direct script access.');

class Service_Login {

	public function login($email, $password)
	{

		$user = ORM::factory('User')->where('email', '=', $email)->find();
		if($user->loaded() AND $user->password === $user_service->encrypt_password($password))
		{
			$this->store_login_info($user->id);
			return true;
		}else{
			return false;
		}

		// $user_service = new Service_User();
		// $user = $user_service->get_by_email($email);

		// //TODO: throw exception instead of returning null
		// if(isset($user))
		// {
		// 	if($user['password'] === $user_service->encrypt_password($password))
		// 	{
		// 		$this->store_login_info($user['id']);
		// 		return TRUE;
		// 	}
		// 	else
		// 	{
		// 		return FALSE;
		// 	}
			
		// }
		// else
		// {
		// 	return FALSE;
		// }
		
	}

	public function store_login_info($user_id)
	{
		$session = Session::instance();
		$session->set('login', 'true');
		$session->set('user', $user_id);
	}

	public function clear_login_info()
	{
		$session = Session::instance();
		$session->delete('login');
		$session->delete('user');
	}

	public static function get_user_in_session()
	{
		$session = Session::instance();
		return $session->get('user');
	}

	public static function is_login()
	{
		$session = Session::instance();
		$login = $session->get('login');

		if($login)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}