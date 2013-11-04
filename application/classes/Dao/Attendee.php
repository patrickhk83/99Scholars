<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Attendee {

	public function create($user_id, $conference_id)
	{
		$attendee = ORM::factory('Attendee');

		$attendee->user = $user_id;
		$attendee->conference = $conference_id;

		$attendee->save();
		return $attendee->pk();
	}
}