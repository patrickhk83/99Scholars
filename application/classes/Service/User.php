<?php defined('SYSPATH') or die('No direct script access.');

class Service_User {

	public function create($email, $password, $first_name, $last_name)
	{
		$user = ORM::factory('User');

		$user->email = $email;
		$user->password = $this->encrypt_password($password);
		$user->firstname = $first_name;
		$user->lastname = $last_name;
		$user->save();

		return array('id' => $user->pk());
	}

	public function get_by_email($email)
	{
		$user = ORM::factory('User')
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

	public function get_by_id($id)
	{
		$user = ORM::factory('User')
					->where('id', '=', $id)
					->find();

		if(!$user->loaded())
		{
			return null;
		}
		else
		{
			return array(
					'email' => $user->get('email'),
					'first_name' => $user->get('firstname'),
					'last_name' => $user->get('lastname')
					);
		}
	}

	public function encrypt_password($password)
	{
		return md5($password);
	}
}