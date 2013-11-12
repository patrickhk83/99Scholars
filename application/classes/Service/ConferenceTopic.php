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
}