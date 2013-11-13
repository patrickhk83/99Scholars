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

	public function get_comment_list_with_author($topic_id)
	{
		$sql = 'SELECT c.id, c.content, c.created_date, u.id AS user_id, u.firstname, u.lastname FROM conference_topic_discussion c '
				.'LEFT OUTER JOIN user u ON c.created_by = u.id '
				.'WHERE c.topic = '.$topic_id;

		return DB::query(Database::SELECT, $sql)
					->execute()
					->as_array();
	}
}