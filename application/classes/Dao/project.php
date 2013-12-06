<?php defined('SYSPATH') or die('No direct script access.');

class Dao_project {

	public function create($author_id, $has_coauthor, $status, $year, $title, $project_name, $start, $end)
	{
		$project = ORM::factory('project');

		$project->author = $author_id;
		$project->has_coauthor = $has_coauthor;
		$project->status = $status;
		$project->publish_year = $year;
		$project->title = $title;
		$project->project_name = $project_name;
		$project->start_page = $start;
		$project->end_page = $end;

		$project->save();

		return $project->pk();
	}

	public function get_by_user_id($user_id, $recent_first = FALSE)
	{
		$query = ORM::factory('project')
						->where('author', '=', $user_id);

		if($recent_first)
		{
			$query->order_by('publish_year', 'desc');
		}

		return $query->find_all();
	}
	
	public function get_last_user_id($user_id)
	{
		$query = ORM::factory('project')
						->where('author', '=', $user_id);

			$query->order_by('id', 'desc');

		return $query->find_all();
	}
	
	public function update_list_for_display($id, $has_coauthor, $status, $year, $title, $project_name, $start, $end)
	{
		$query = DB::update('project')
					->set(array(
						'has_coauthor' => $has_coauthor,
						'status' => $status,
						'publish_year' => $year,
						'title' => $title,
						'project_name' => $project_name,
						'start_page' => $start,
						'end_page' => $end
					))
					->where('id', '=', $id);

		$query->execute();
	}
	
	public function delete_list_for_display($id)
	{
		$query = DB::delete('project')
					->where('id', '=', $id);

		$query->execute();
	}
}