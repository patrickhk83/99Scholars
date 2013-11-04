<?php defined('SYSPATH') or die('No direct script access.');

class Service_UserPosition {

	public function get_position_list($user_id, $recent_first = FALSE)
	{
		$position_dap = new Dao_UserPosition();
		$results = $position_dap->get_by_user_id($user_id, $recent_first);

		$positions = array();

		foreach ($results as $result) {
			$position = array();

			$position['title'] = $result->get('title');
			$position['department'] = $this->get_department_name($result->get('department'));
			$position['affiliation'] = $this->get_institute_name($result->get('affiliation'));

			array_push($positions, $position);
		}

		return $positions;
	}

	protected function get_department_name($id)
	{
		$dep_dao = new Dao_Department();
		$department = $dep_dao->get($id);

		return $department->get('name');
	}

	protected function get_institute_name($id)
	{
		$org_dao = new Dao_Organization();
		$org = $org_dao->get($id);

		return $org->get('name');
	}
}