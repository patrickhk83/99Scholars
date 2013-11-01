<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Department {

	public function create($name, $description, $organization)
	{
		$department = ORM::factory('Department');

		$department->name = $name;
		$department->description = $description;
		$department->organization = $organization;
		$department->save();

		return $department->pk();
	}

	public function get($id)
	{
		$department = ORM::factory('Department', $id);
		return $department;
	}
}