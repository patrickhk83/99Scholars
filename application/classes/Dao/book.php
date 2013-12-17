<?php defined('SYSPATH') or die('No direct script access.');

class Dao_book {

	public function create($author_id, $has_coauthor, $status, $year, $title, $book_name, $start, $end)
	{
		$book = ORM::factory('book');

		$book->author = $author_id;
		$book->has_coauthor = $has_coauthor;
		$book->status = $status;
		$book->publish_year = $year;
		$book->title = $title;
		$book->book_name = $book_name;
		$book->start_page = $start;
		$book->end_page = $end;

		$book->save();

		return $book->pk();
	}

	public function get_by_user_id($user_id, $recent_first = FALSE)
	{
		$query = ORM::factory('book')
						->where('author', '=', $user_id);

		if($recent_first)
		{
			$query->order_by('publish_year', 'desc');
		}

		return $query->find_all();
	}
	
	public function get_last_user_id($user_id)
	{
		$query = ORM::factory('book')
						->where('author', '=', $user_id);

			$query->order_by('id', 'desc');

		return $query->find_all();
	}
	
	public function update_list_for_display($id, $has_coauthor, $status, $year, $title, $book_name, $start, $end)
	{
		$query = DB::update('book')
					->set(array(
						'has_coauthor' => $has_coauthor,
						'status' => $status,
						'publish_year' => $year,
						'title' => $title,
						'book_name' => $book_name,
						'start_page' => $start,
						'end_page' => $end
					))
					->where('id', '=', $id);

		$query->execute();
	}
	
	public function delete_list_for_display($id)
	{
		$query = DB::delete('book')
					->where('id', '=', $id);

		$query->execute();
	}
}