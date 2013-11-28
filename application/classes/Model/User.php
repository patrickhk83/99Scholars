<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends ORM {

	protected $_table_name = 'user';

	protected $_has_many = array(
    	'attendee' => array(
        	'model'       => 'Conference',
        	'through' => 'attendee',
        	'far_key' => 'conference',
        	'foreign_key' => 'user',
        	// 'foreign_key' => 'user'
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
}