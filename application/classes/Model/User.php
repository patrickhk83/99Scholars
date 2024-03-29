<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends ORM {

	protected $_table_name = 'user';

	protected $_has_many = array(
    	'attendee' => array(
        	'model'       => 'Conference',
        	'through' => 'attendee',
        	'far_key' => 'conference',
        	'foreign_key' => 'user',
    	),
    	'following' => array(
    		'model' => 'User',
    		'through' => 'follow_people',
    		'far_key' => 'follow_user',
    		'foreign_key' => 'user'
    	),
    	'follower' => array(
    		'model' => 'User',
    		'through' => 'follow_people',
    		'far_key' => 'user',
    		'foreign_key' => 'follow_user'
    	),
	);
	protected $_has_one = array(
		'position' => array(
        	'model'       => 'UserPosition',
        	'foreign_key' => 'user',
    	),
    	'degree' => array(
        	'model'       => 'UserDegree',
        	'foreign_key' => 'user',
    	),
    	'contact' => array(
        	'model'       => 'UserContact',
        	'foreign_key' => 'user',	
    	),
    	'oauth' => array(
        	'model'       => 'UserOauth',
    	),
	);
	public function get_fullname()
	{
		return $this->firstname.' '.$this->lastname;
	}

	public function get_affiliation()
	{

		$position_name = $this->position->organization->name;
		if(!empty($position_name)) return $position_name;

		$degree_name = $this->degree->organization->name;
		if(!empty($degree_name)) return $degree_name;

		return '';
	}

	public function is_oauth_user($email, $provider)
	{
		$result = $this
					->where('email', '=', $email)
					->find();

		return ($result->loaded()) ? ($result->provider == $provider) : false;
	}

	public function sign_up_oauth($info)
	{
		$user['firstname'] = $info['info']['first_name'];
		$user['lastname'] = $info['info']['last_name'];
		$user['email'] = $info['info']['email'];
		$user['provider'] = $info['provider'];
		$this->values($user)->create();

		$contact['user'] = $this->pk();
		$contact['email'] = $info['info']['email'];
		$this->contact->values($contact)->create();

		$oauth['user_id'] = $this->pk();
		$oauth['uid'] = $info['uid'];
		$oauth['token'] = $info['credentials']['token'];
		$this->oauth->values($oauth)->create();
	}

	public function is_followed_by($user)
	{
		if(!$user)
		{
			return FALSE;
		}

		$follow_people = ORM::factory('FollowPeople')
				->where('user', '=', $user)
				->and_where('follow_user', '=', $this->id)
				->find();

		if($follow_people->loaded())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}