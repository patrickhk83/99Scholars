<?php defined('SYSPATH') or die('No direct script access.');

class Service_Degree {

	public function create($user_id, $degree_type, $major, $institute, $graduate_year)
	{
		$degree = ORM::factory('Degree');

		$degree->user = $user_id;
		$degree->degree = $degree_type;
		$degree->major = $major;
		$degree->institute = $institute;
		$degree->graduate_year = $graduate_year;

		$degree->save();

		return $degree->pk();
	}
}