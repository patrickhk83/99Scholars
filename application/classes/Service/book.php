<?php defined('SYSPATH') or die('No direct script access.');

class Service_book {

	public function get_book_list($user_id, $recent_first = FALSE)
	{
		$book_dao = new Dao_book();
		$results = $book_dao->get_by_user_id($user_id, $recent_first);

		$books = array();

		foreach ($results as $result) 
		{
			$book = array();
			
			$user_service = new Service_User();
			$user = $user_service->get_by_id($result->get('author'));

			$book['first_name'] = $user['first_name'];
			$book['last_name'] = $user['last_name'];
			$book['year'] = $result->get('publish_year');
			$book['book_name'] = $result->get('book_name');
			$book['title'] = $result->get('title');
			$book['status'] = $result->get('status');
			$book['start'] = $result->get('start_page');
			$book['end'] = $result->get('end_page');
			$book['id'] = $result->get('id');

			array_push($books, $book);
		}

		return $books;
	}

	public function get_book_list_for_display($user_id, $recent_first = FALSE)
	{
		$results = $this->get_book_list($user_id, $recent_first);

		$books = array();

		foreach ($results as $result) 
		{
			$book = Util_book::formatnew($result['last_name'],
											$result['first_name'],
											$result['year'],
											$result['title'],
											$result['book_name'],
											$result['status'],
											$result['start'],
											$result['end'],
											$result['id']);

			array_push($books, $book);
		}

		return $books;
	}
	
}