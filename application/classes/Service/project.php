<?php defined('SYSPATH') or die('No direct script access.');

class Service_project {

	public function get_project_list($user_id, $recent_first = FALSE)
	{
		$project_dao = new Dao_project();
		$results = $project_dao->get_by_user_id($user_id, $recent_first);

		$projects = array();

		foreach ($results as $result) 
		{
			$project = array();
			
			$user_service = new Service_User();
			$user = $user_service->get_by_id($result->get('author'));

			$project['first_name'] = $user['first_name'];
			$project['last_name'] = $user['last_name'];
			$project['year'] = $result->get('publish_year');
			$project['project_name'] = $result->get('project_name');
			$project['title'] = $result->get('title');
			$project['status'] = $result->get('status');
			$project['start'] = $result->get('start_page');
			$project['end'] = $result->get('end_page');
			$project['id'] = $result->get('id');

			array_push($projects, $project);
		}

		return $projects;
	}

	public function get_project_list_for_display($user_id, $recent_first = FALSE)
	{
		$results = $this->get_project_list($user_id, $recent_first);

		$projects = array();

		foreach ($results as $result) 
		{
			$project = Util_project::formatnew($result['last_name'],
											$result['first_name'],
											$result['year'],
											$result['title'],
											$result['project_name'],
											$result['status'],
											$result['start'],
											$result['end'],
											$result['id']);

			array_push($projects, $project);
		}

		return $projects;
	}
	
}