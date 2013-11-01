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

	public function get_by_user_id($user_id, $recent_first = FALSE)
	{
		$query = ORM::factory('UserPosition')
						->where('user', '=', $user_id);

		if($recent_first)
		{
			$query->order_by('start', 'desc');
		}

		return $query->find_all();
	}
}