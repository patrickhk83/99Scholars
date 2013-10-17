<?php defined('SYSPATH') or die('No direct script access.');

class Service_User {

	public function create($email, $password)
	{
		$user = ORM::factory('user');

		$user->email = $email;
		$user->password = md5($password);
		$user->save();

		return array('id' => $user->pk());
	}
}