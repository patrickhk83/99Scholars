<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Video {

	public function get_video_list($user_id)
	{
		$attendees = ORM::factory('Video')
						->where('created_by', '=', $user_id)
						->order_by('id', 'desc')
						->find_all();
		return $attendees;
	}

}