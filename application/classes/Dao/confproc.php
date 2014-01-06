<?php defined('SYSPATH') or die('No direct script access.');

class Dao_confproc {

	public function create($author_id, $has_coauthor, $status, $year, $title, $conference, $start, $end)
	{
		$confproc = ORM::factory('confproc');

		$confproc->author = $author_id;
		$confproc->has_coauthor = $has_coauthor;
		$confproc->status = $status;
		$confproc->publish_year = $year;
		$confproc->title = $title;
		$confproc->conference = $conference;
		$confproc->start_page = $start;
		$confproc->end_page = $end;

		$confproc->save();

		return $confproc->pk();
	}

	public function get_by_user_id($user_id, $recent_first = FALSE)
	{
		$query = ORM::factory('confproc')
						->where('author', '=', $user_id);

		if($recent_first)
		{
			$query->order_by('publish_year', 'desc');
		}

		return $query->find_all();
	}
	
	public function get_last_user_id($user_id)
	{
		$query = ORM::factory('confproc')
						->where('author', '=', $user_id);

			$query->order_by('id', 'desc');

		return $query->find_all();
	}
	
	public function update_list_for_display($id, $has_coauthor, $status, $year, $title, $conference, $start, $end)
	{
		$query = DB::update('conference_proceeding')
					->set(array(
						'has_coauthor' => $has_coauthor,
						'status' => $status,
						'publish_year' => $year,
						'title' => $title,
						'conference' => $conference,
						'start_page' => $start,
						'end_page' => $end
					))
					->where('id', '=', $id);

		$query->execute();
	}
	
	public function delete_list_for_display($id)
	{
		$query = DB::delete('conference_proceeding')
					->where('id', '=', $id);

		$query->execute();
	}
}