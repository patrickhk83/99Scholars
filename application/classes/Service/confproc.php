<?php defined('SYSPATH') or die('No direct script access.');

class Service_confproc {

	public function get_confproc_list($user_id, $recent_first = FALSE)
	{
		$confproc_dao = new Dao_confproc();
		$results = $confproc_dao->get_by_user_id($user_id, $recent_first);

		$confprocs = array();

		foreach ($results as $result) 
		{
			$confproc = array();
			
			$user_service = new Service_User();
			$user = $user_service->get_by_id($result->get('author'));

			$confproc['first_name'] = $user['first_name'];
			$confproc['last_name'] = $user['last_name'];
			$confproc['year'] = $result->get('publish_year');
			$confproc['conference'] = $result->get('conference');
			$confproc['title'] = $result->get('title');
			$confproc['status'] = $result->get('status');
			$confproc['start'] = $result->get('start_page');
			$confproc['end'] = $result->get('end_page');
			$confproc['id'] = $result->get('id');

			array_push($confprocs, $confproc);
		}

		return $confprocs;
	}

	public function get_confproc_list_for_display($user_id, $recent_first = FALSE)
	{
		$results = $this->get_confproc_list($user_id, $recent_first);

		$confprocs = array();

		foreach ($results as $result) 
		{
			$confproc = Util_confproc::formatnew($result['last_name'],
											$result['first_name'],
											$result['year'],
											$result['title'],
											$result['conference'],
											$result['status'],
											$result['start'],
											$result['end'],
											$result['id']);

			array_push($confprocs, $confproc);
		}

		return $confprocs;
	}
	
}