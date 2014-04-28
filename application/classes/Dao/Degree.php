<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Degree {

	public function create($user_id, $degree_type, $major, $institute, $graduate_year)
	{
		$degree = ORM::factory('Degree');

		$degree->user_id = $user_id;
		$degree->degree_id = $degree_type;
		$degree->major = $major;
		$degree->organization_id = $institute;
		$degree->graduate_year = $graduate_year;

		$degree->save();

		return $degree->pk();
	}

	public function get_by_user_id($user_id, $recent_first = FALSE)
	{
		$query = ORM::factory('Degree')
						->where('user_id', '=', $user_id);
		
		if($recent_first)
		{
			$query->order_by('graduate_year', 'desc');
		}

		return $query->find_all();
	}
}