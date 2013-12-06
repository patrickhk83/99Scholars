<?php defined('SYSPATH') or die('No direct script access.');

class Service_User {

	public function create($email, $password, $first_name, $last_name)
	{
		$user = ORM::factory('User');

		$user->email = $email;
		$user->password = $this->encrypt_password($password);
		$user->firstname = $first_name;
		$user->lastname = $last_name;
		$user->save();

		$user_id = $user->pk();

		$user_contact_service = new Service_UserContact();
		$user_contact_service->create_with_email($user_id, $email);

		return array('id' => $user_id);
	}

	public function get_by_email($email)
	{
		$user = ORM::factory('User')
					->where('email', '=', $email)
					->find();

		if(!$user->loaded())
		{
			return null;
		}
		else
		{
			return array(
					'id' => $user->get('id'),
					'email' => $user->get('email'),
					'password' => $user->get('password')
					);
		}
	}

	public function get_by_id($id)
	{
		$user = ORM::factory('User')
					->where('id', '=', $id)
					->find();

		if(!$user->loaded())
		{
			return null;
		}
		else
		{
			return array(
					'id' => $user->get('id'),
					'email' => $user->get('email'),
					'first_name' => $user->get('firstname'),
					'last_name' => $user->get('lastname'),
					'background' => $user->get('background'),
					'birth_date' => $user->get('birth_date')
					);
		}
	}

	public function get_info_for_editing($id)
	{
		$user = $this->get_by_id($id);

		$user['birth_date'] = Util_Date::convert_date_to_display($user['birth_date']);

		$contact = $this->get_contact_info($id);

		$user['contact'] = $contact;

		return $user;
	}

	public function get_contact_info($user_id)
	{
		$contact = ORM::factory('UserContact')
						->where('user', '=', $user_id)
						->find();

		if(!$contact->loaded())
		{
			return array(
					'contact_id' => '',
					'address' => '',
					'tel' => '',
					'fax' => '',
					'email' => '',
					'website' => ''
					);
		}
		else
		{
			return array(
					'contact_id' => $contact->get('id'),
					'address' => $contact->get('address'),
					'tel' => $contact->get('tel'),
					'fax' => $contact->get('fax'),
					'email' => $contact->get('email'),
					'website' => $contact->get('website')
					);
		}
	}

	public function update($id, $data)
	{
		$query = DB::update('user')
					->set(array(
						'firstname' => $data['first_name'],
						'lastname' => $data['last_name'],
						'background' => $data['background'],
						'birth_date' => Util_Date::convert_date($data['birth_date'])
					))
					->where('id', '=', $id);

		$query->execute();
	}

	public function attend_conference($user, $conferemce)
	{
		$atten_dao = new Dao_Attendee();
		$atten_dao->create($user, $conferemce);
	}

	public function cancel_booking($user, $conferemce)
	{
		$atten_dao = new Dao_Attendee();
		$atten_dao->delete($user, $conferemce);
	}

	public function add_upload($user,$conference,$dataid,$type)
	{
		switch($type) {
			case 'video': 
				$this->update_video($user,$conference,$dataid);
				break;
		}
	}
	
	public function update_video($userid,$conf_id,$video_id)
	{
		$video = ORM::factory('Video');

		$video->created_by = $userid;
		$video->event = $conf_id;
		$video->youtube_id = $video_id;

		$video->save();
		return $video->pk();
	}
	
	public function add_delete($user_id, $conf_id, $videoid)
	{
		$query = DB::delete('event_video')
					->where('youtube_id', '=', $videoid)
					->where('event', '=', $conf_id)
					->where('created_by', '=', $user_id);

		$query->execute();
		
	}

	public function encrypt_password($password)
	{
		return md5($password);
	}
}
