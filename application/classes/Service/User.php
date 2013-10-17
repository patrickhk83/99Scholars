<?php defined('SYSPATH') or die('No direct script access.');

class Service_User {

	public function create($email, $password)
	{
		$user = ORM::factory('user');

		$user->email = $email;
		$user->password = $this->encrypt_password($password);
		$user->save();

		return array('id' => $user->pk());
	}

	public function get_by_email($email)
	{
		$user = ORM::factory('user')
					->where('email', '=', $email)
					->find();

		if(!$user->loaded())
		{
			return null;
		}
		else
		{
			return array(
					'id' => $user->get('id'),
					'email' => $user->get('email'),
					'password' => $user->get('password')
					);
		}
	}

	public function encrypt_password($password)
	{
		return md5($password);
	}
}