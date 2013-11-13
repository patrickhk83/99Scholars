<?php defined('SYSPATH') or die('No direct script access.');

class Service_ConferenceComment {

	public function create($user_id, $data)
	{
		$comment_dao = new Dao_ConferenceComment();
		$comment_dao->create($user_id,
						 $data['topic_id'],
						 $data['comment']);
	}

	public function get_comment_list($topic_id)
	{
		$comment_dao = new Dao_ConferenceComment();
		$results = $comment_dao->get_comment_list_with_author($topic_id);

		$comments = array();

		foreach ($results as $result) 
		{
			$comment = array();

			$comment['id'] = $result['id'];
			$comment['content'] = $result['content'];
			$comment['author_id'] = $result['user_id'];
			$comment['author_name'] = $result['firstname'].' '.$result['lastname'];
			$comment['last_update'] = Util_Date::time_elapsed($result['created_date']).' ago';

			array_push($comments, $comment);
		}

		return $comments;
	}
}