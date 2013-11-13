<?php defined('SYSPATH') or die('No direct script access.');

class Service_ConferenceTopic {

	public function create($user_id, $data)
	{
		$topic_dao = new Dao_ConferenceTopic();
		$topic_id = $topic_dao->create($data['title'],
							$data['content'],
							$data['conf_id'],
							$user_id);

		return $topic_id;
	}

	public function get_topic_list($conf_id)
	{
		$topic_dao = new Dao_ConferenceTopic();
		$results = $topic_dao->get_topic_list_with_author($conf_id);

		$topics = array();

		foreach ($results as $result) 
		{
			$topic = array();

			$topic['id'] = $result['id'];
			$topic['title'] = $result['title'];
			$topic['author_id'] = $result['user_id'];
			$topic['author_name'] = $result['firstname'].' '.$result['lastname'];
			$topic['last_update'] = Util_Date::time_elapsed($result['created_date']).' ago';

			array_push($topics, $topic);
		}

		return $topics;
	}

	public function get_with_comment($topic_id)
	{
		$topic = array();

		$topic_dao = new Dao_ConferenceTopic();
		$topic_result = $topic_dao->get_with_author($topic_id);

		$topic['id'] = $topic_result['id'];
		$topic['title'] = $topic_result['title'];
		$topic['content'] = $topic_result['content'];
		$topic['author_id'] = $topic_result['user_id'];
		$topic['author_name'] = $topic_result['firstname'].' '.$topic_result['lastname'];
		$topic['last_update'] = Util_Date::time_elapsed($topic_result['created_date']).' ago';

		//TODO: get comment
		return $topic;
	}
}