<?php defined('SYSPATH') or die('No direct script access.');

class Service_chapter {

	public function get_chapter_list($user_id, $recent_first = FALSE)
	{
		$chapter_dao = new Dao_chapter();
		$results = $chapter_dao->get_by_user_id($user_id, $recent_first);

		$chapters = array();

		foreach ($results as $result) 
		{
			$chapter = array();
			
			$user_service = new Service_User();
			$user = $user_service->get_by_id($result->get('author'));

			$chapter['first_name'] = $user['first_name'];
			$chapter['last_name'] = $user['last_name'];
			$chapter['year'] = $result->get('publish_year');
			$chapter['book_chapter'] = $result->get('book_chapter');
			$chapter['title'] = $result->get('title');
			$chapter['status'] = $result->get('status');
			$chapter['start'] = $result->get('start_page');
			$chapter['end'] = $result->get('end_page');
			$chapter['id'] = $result->get('id');

			array_push($chapters, $chapter);
		}

		return $chapters;
	}

	public function get_chapter_list_for_display($user_id, $recent_first = FALSE)
	{
		$results = $this->get_chapter_list($user_id, $recent_first);

		$chapters = array();

		foreach ($results as $result) 
		{
			$chapter = Util_chapter::formatnew($result['last_name'],
											$result['first_name'],
											$result['year'],
											$result['title'],
											$result['book_chapter'],
											$result['status'],
											$result['start'],
											$result['end'],
											$result['id']);

			array_push($chapters, $chapter);
		}

		return $chapters;
	}
	
}