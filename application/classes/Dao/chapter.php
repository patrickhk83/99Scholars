<?php defined('SYSPATH') or die('No direct script access.');

class Dao_chapter {

	public function create($author_id, $has_coauthor, $status, $year, $title, $book_chapter, $start, $end)
	{
		$chapter = ORM::factory('chapter');

		$chapter->author = $author_id;
		$chapter->has_coauthor = $has_coauthor;
		$chapter->status = $status;
		$chapter->publish_year = $year;
		$chapter->title = $title;
		$chapter->book_chapter = $book_chapter;
		$chapter->start_page = $start;
		$chapter->end_page = $end;

		$chapter->save();

		return $chapter->pk();
	}

	public function get_by_user_id($user_id, $recent_first = FALSE)
	{
		$query = ORM::factory('chapter')
						->where('author', '=', $user_id);

		if($recent_first)
		{
			$query->order_by('publish_year', 'desc');
		}

		return $query->find_all();
	}
	
	public function get_last_user_id($user_id)
	{
		$query = ORM::factory('chapter')
						->where('author', '=', $user_id);

			$query->order_by('id', 'desc');

		return $query->find_all();
	}
	
	public function update_list_for_display($id, $has_coauthor, $status, $year, $title, $book_chapter, $start, $end)
	{
		$query = DB::update('book_chapter')
					->set(array(
						'has_coauthor' => $has_coauthor,
						'status' => $status,
						'publish_year' => $year,
						'title' => $title,
						'book_chapter' => $book_chapter,
						'start_page' => $start,
						'end_page' => $end
					))
					->where('id', '=', $id);

		$query->execute();
	}
	
	public function delete_list_for_display($id)
	{
		$query = DB::delete('book_chapter')
					->where('id', '=', $id);

		$query->execute();
	}
}