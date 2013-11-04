<?php defined('SYSPATH') or die('No direct script access.');

class Service_Degree {

	public function get_degree_list($user_id, $recent_first = FALSE)
	{
		$degree_dao = new Dao_Degree();
		$results = $degree_dao->get_by_user_id($user_id, $recent_first);

		$degrees = array();

		foreach ($results->as_array() as $result) {
			$degree = array();

			$degree['type'] = $this->get_degree_name($result->get('degree'));
			$degree['major'] = $result->get('major');
			$degree['university'] = $this->get_institute_name($result->get('institute'));
			$degree['year'] = $result->get('graduate_year');

			array_push($degrees, $degree);
		}

		return $degrees;
	}

	protected function get_institute_name($id)
	{
		$org_dao = new Dao_Organization();
		$org = $org_dao->get($id);

		return $org->get('name');
	}

	//TODO: map to real table
	protected function get_degree_name($id)
	{
		switch ($id) {
			case 1:
				return 'B.A.';
			case 2:
				return 'M.A.';
			case 3:
				return 'Ph.D.';
		}
	}
}