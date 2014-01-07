<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Journal {

	public function create($author_id, $has_coauthor, $status, $year, $title, $journal_title, $volume, $issue, $start, $end, $link)
	{
		$journal = ORM::factory('Journal');

		$journal->author = $author_id;
		$journal->has_coauthor = $has_coauthor;
		$journal->status = $status;
		$journal->publish_year = $year;
		$journal->title = $title;
		$journal->journal = $journal_title;
		$journal->volume = $volume;
		$journal->issue = $issue;
		$journal->start_page = $start;
		$journal->end_page = $end;
		$journal->link = $link;

		$journal->save();

		return $journal->pk();
	}
	
	public function get_by_user_id($user_id, $recent_first = FALSE)
	{
		$query = ORM::factory('Journal')
						->where('author', '=', $user_id);

		if($recent_first)
		{
			$query->order_by('publish_year', 'desc');
		}

		return $query->find_all();
	}
	
	public function get_last_user_id($user_id)
	{
		$query = ORM::factory('Journal')
						->where('author', '=', $user_id);

			$query->order_by('id', 'desc')->limit(1);

		return $query->find_all();
	}
	
	public function get_last_author($user_id)
	{
		$query = DB::select('author_name')->from('co_author')
						->where('journal', '=', $user_id);


		return $query->execute();
	}
	
	public function insert_list($id,$value)
	{
		$query = DB::insert('co_author', array('journal', 'author_name'))->values(array($id, $value));

		$query->execute();
	}
}