<?php defined('SYSPATH') or die('No direct script access.');

class Dao_presentation {

	public function create($author_id, $has_coauthor, $status, $year, $title, $presentation_name, $start, $end)
	{
		$presentation = ORM::factory('presentation');

		$presentation->author = $author_id;
		$presentation->has_coauthor = $has_coauthor;
		$presentation->status = $status;
		$presentation->publish_year = $year;
		$presentation->title = $title;
		$presentation->presentation_name = $presentation_name;
		$presentation->start_page = $start;
		$presentation->end_page = $end;

		$presentation->save();

		return $presentation->pk();
	}

	public function get_by_user_id($user_id, $recent_first = FALSE)
	{
		$query = ORM::factory('presentation')
						->where('author', '=', $user_id);

		if($recent_first)
		{
			$query->order_by('publish_year', 'desc');
		}

		return $query->find_all();
	}
	
	public function get_last_user_id($user_id)
	{
		$query = ORM::factory('presentation')
						->where('author', '=', $user_id);

			$query->order_by('id', 'desc');

		return $query->find_all();
	}
	
	public function update_list_for_display($id, $has_coauthor, $status, $year, $title, $presentation_name, $start, $end)
	{
		$query = DB::update('presentation')
					->set(array(
						'has_coauthor' => $has_coauthor,
						'status' => $status,
						'publish_year' => $year,
						'title' => $title,
						'presentation_name' => $presentation_name,
						'start_page' => $start,
						'end_page' => $end
					))
					->where('id', '=', $id);

		$query->execute();
	}
	
	public function delete_list_for_display($id)
	{
		$query = DB::delete('presentation')
					->where('id', '=', $id);

		$query->execute();
	}
}