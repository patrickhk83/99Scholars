<?php defined('SYSPATH') or die('No direct script access.');

class Dao_UserPosition {

	public function create($user_id, $title, $department, $affiliation, $start, $end)
	{
		$position = ORM::factory('UserPosition');

		$position->user = $user_id;
		$position->title = $title;
		$position->department = $department;
		$position->affiliation = $affiliation;
		$position->start = $start;
		$position->end = $end;

		$position->save();

		return $position->pk();
	}
}