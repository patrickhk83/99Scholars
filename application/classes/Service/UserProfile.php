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

		$degree_service = new Service_Degree();
		$degree_service->create($user_id,
								$data['degree_type'],
								$data['major'],
								$org_id,
								$data['year']);
	}
}