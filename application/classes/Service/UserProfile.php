<?php defined('SYSPATH') or die('No direct script access.');

class Service_UserProfile {

	public function update($type, $data)
	{
		switch($type) {
			case 'general': 
				$this->update_general_info($data);
				break;
		}
	}

	public function create($type, $user_id, $data)
	{
		switch ($type) {
			case 'degree':
				$this->create_degree($user_id, $data);
				break;
		}
	}

	protected function update_general_info($data)
	{

		$user_service = new Service_User();
		$user_service->update($data['user_id'], $data);

		$user_contact_service = new Service_UserContact();
		$user_contact_service->update($data['user_id'], $data);
	}

	protected function create_degree($user_id, $data)
	{
		$org_dao = new Dao_Organization();
		$org_id = $org_dao->create($data['university'], null);

		$degree_service = new Dao_Degree();
		$degree_service->create($user_id,
								$data['degree_type'],
								$data['major'],
								$org_id,
								$data['year']);
	}

	public function render_edit_tab($user_id, $tab_name)
	{
		$view = View::factory('profile/edit/edit_'.$tab_name);

		switch ($tab_name) {
			case 'degree':
				$degree_service = new Service_Degree();
				$view->degrees = $degree_service->get_degree_list($user_id);
				break;

			case 'position':
				
				break;
		}

		return $view;
	}

	public function get_overview_info($user_id)
	{
		$result = array();

		$user_service = new Service_User();
		$result['general'] = $user_service->get_by_id($user_id);

		$degree_service = new Service_Degree();
		$degree = $degree_service->get_degree_list($user_id, TRUE);

		if(!empty($degree))
		{
			$result['degree'] = $degree;
			$result['general']['latest_degree'] = $degree[0];
		}

		$result['contact'] = $user_service->get_contact_info($user_id);

		return $result;
	}
}