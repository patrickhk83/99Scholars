<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Seminar {

	public function create($conf_id, $speaker, $abstract)
	{
		$seminar = ORM::factory('Seminar');

		$seminar->conference = $conf_id;
		$seminar->speaker = $speaker;
		$seminar->abstract = $abstract;

		$seminar->save();

		return $seminar->pk();
	}
}