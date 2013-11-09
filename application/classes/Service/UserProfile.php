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
		$result;

		switch ($type) {
			case 'degree':
				$result = $this->create_degree($user_id, $data);
				break;

			case 'position':
				$result = $this->create_position($user_id, $data);
				break;

			case 'journal':
				$result = $this->create_journal($user_id, $data);
				break;
		}

		return $result;
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
		$org_id = $this->create_organization($data['university']);

		$degree_dao = new Dao_Degree();
		$degree_dao->create($user_id,
								$data['degree_type'],
								$data['major'],
								$org_id,
								$data['year']);

		$result = array();
		$result['status'] = 'ok';

		return $result;
	}

	protected function create_position($user_id, $data)
	{
		$org_id = $this->create_organization($data['institute']);

		$dep_dao = new Dao_Department();
		$dep_id = $dep_dao->create($data['department'], null, $org_id);

		$position_dao = new Dao_UserPosition();
		$position_dao->create($user_id,
								$data['title'],
								$dep_id,
								$org_id,
								$data['from'],
								$data['to']);

		$result = array();
		$result['status'] = 'ok';

		return $result;
	}

	protected function create_journal($user_id, $data)
	{
		$journal_dao = new Dao_Journal();
		$journal_dao->create($user_id,
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['journal'],
								$data['volume'],
								$data['issue'],
								$data['start'],
								$data['end'],
								$data['link']);

		//TODO: check if there is co-author

		$result = array();
		$result['status'] = 'ok';

		$user_service = new Service_User();
		$user = $user_service->get_by_id($user_id);

		$result['result_to_display'] = Util_Journal::format($user['last_name'],
															$user['first_name'],
															$data['year'],
															$data['title'],
															$data['journal'],
															$data['volume'],
															$data['issue'],
															$data['start'],
															$data['end']);

		return $result;
	}

	private function create_organization($name)
	{
		$org_dao = new Dao_Organization();
		return $org_dao->create($name, null);
	}

	public function render_view_tab($user_id, $tab_name)
	{
		$view = View::factory('profile/user_'.$tab_name);

		switch ($tab_name) {
			case 'publication':
				$publications = array();

				$journal_service = new Service_Journal();
				$journals = $journal_service->get_journal_list_for_display($user_id);

				$publications['journals'] = $journals;
				$publications['count']['journal'] = count($journals);

				$view->publications = $publications;
				break;

			case 'event':
				$conf_service = new Service_Conference();
				$view->events = $conf_service->get_conference_user_attend($user_id);
		}

		return $view;
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
				$position_service = new Service_UserPosition();
				$view->positions = $position_service->get_position_list($user_id);
				break;

			case 'journal':
				$journal_service = new Service_Journal();
				$view->journals = $journal_service->get_journal_list_for_display($user_id);
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

		$position_service = new Service_UserPosition();
		$positions = $position_service->get_position_list($user_id);

		if(!empty($positions))
		{
			$result['position'] = $positions[0];
		}

		return $result;
	}
}