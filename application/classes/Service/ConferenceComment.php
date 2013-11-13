<?php defined('SYSPATH') or die('No direct script access.');

class Service_ConferenceComment {

	public function create($user_id, $data)
	{
		$comment_dao = new Dao_ConferenceComment();
		$comment_dao->create($user_id,
						 $data['topic_id'],
						 $data['comment']);
	}
}