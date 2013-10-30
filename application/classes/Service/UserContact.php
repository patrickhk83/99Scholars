<?php defined('SYSPATH') or die('No direct script access.');

class Service_UserContact {

	public function create_with_email($user_id, $email)
	{
		$user_contact = ORM::factory('UserContact');

		$user_contact->user = $user_id;
		$user_contact->email = $email;
		$user_contact->save();
	}
}