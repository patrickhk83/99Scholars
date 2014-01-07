<?php defined('SYSPATH') or die('No direct script access.');

class Service_presentation {

	public function get_presentation_list($user_id, $recent_first = FALSE)
	{
		$presentation_dao = new Dao_presentation();
		$results = $presentation_dao->get_by_user_id($user_id, $recent_first);

		$presentations = array();

		foreach ($results as $result) 
		{
			$presentation = array();
			
			$user_service = new Service_User();
			$user = $user_service->get_by_id($result->get('author'));

			$presentation['first_name'] = $user['first_name'];
			$presentation['last_name'] = $user['last_name'];
			$presentation['year'] = $result->get('publish_year');
			$presentation['presentation_name'] = $result->get('presentation_name');
			$presentation['title'] = $result->get('title');
			$presentation['status'] = $result->get('status');
			$presentation['start'] = $result->get('start_page');
			$presentation['end'] = $result->get('end_page');
			$presentation['id'] = $result->get('id');

			array_push($presentations, $presentation);
		}

		return $presentations;
	}

	public function get_presentation_list_for_display($user_id, $recent_first = FALSE)
	{
		$results = $this->get_presentation_list($user_id, $recent_first);

		$presentations = array();

		foreach ($results as $result) 
		{
			$presentation = Util_presentation::formatnew($result['last_name'],
											$result['first_name'],
											$result['year'],
											$result['title'],
											$result['presentation_name'],
											$result['status'],
											$result['start'],
											$result['end'],
											$result['id']);

			array_push($presentations, $presentation);
		}

		return $presentations;
	}
	
}