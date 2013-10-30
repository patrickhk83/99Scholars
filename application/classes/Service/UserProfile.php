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

	protected function update_general_info($data)
	{

		$user_service = new Service_User();
		$user_service->update($data['user_id'], $data);

		$user_contact_service = new Service_UserContact();
		$user_contact_service->update($data['user_id'], $data);
	}
}