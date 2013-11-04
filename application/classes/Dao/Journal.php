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
}