<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Organization {

	public function create($name, $description)
	{
		$org = ORM::factory('Organization');

		$org->name = $name;
		$org->description = $description;

		$org->save();

		return $org->pk();
	}
}