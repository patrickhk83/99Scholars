<?php defined('SYSPATH') or die('No direct script access.');

class Dao_ConferenceComment {

	public function create($user_id, $topic_id, $content)
	{
		$comment = ORM::factory('ConferenceComment');

		$comment->topic = $topic_id;
		$comment->content = $content;
		$comment->created_by = $user_id;
		$comment->created_date = time();

		$comment->save();
		return $comment->pk();
	}
}