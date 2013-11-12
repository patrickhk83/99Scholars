<?php defined('SYSPATH') or die('No direct script access.');

class Dao_ConferenceTopic {

	public function create($title, $content, $conference_id, $user_id)
	{
		$topic = ORM::factory('ConferenceTopic');

		$topic->conference = $conference_id;
		$topic->title = $title;
		$topic->content = $content;
		$topic->created_by = $user_id;
		$topic->created_date = time();

		$topic->save();
		return $topic->pk();
	}
}