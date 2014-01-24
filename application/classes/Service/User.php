<?php defined('SYSPATH') or die('No direct script access.');

class Service_User {

	public function create($email, $password, $first_name, $last_name)
	{
		$user = ORM::factory('User');
        $user->username = $email;
        $user->email = $email;
        $user->firstname = $first_name;
        $user->lastname = $last_name;
        $user->password = $password;

        $user->save();

        //Add right to login
        $user->add('roles', ORM::factory('role', array('name' => 'login')));

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
}