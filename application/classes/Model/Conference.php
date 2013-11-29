<?php defined('SYSPATH') or die('No direct script access.');

class Model_Conference extends ORM {

	protected $_table_name = 'conference';

	protected $_has_many = array(
    	'attendee' => array(
        	'model'   => 'User',
        	'through' => 'attendee',
        	'far_key' => 'user',
        	'foreign_key' => 'conference'
    	),
    	'topic' => array(
        	'model'   => 'ConferenceTopic',
        	'foreign_key' => 'conference'
    	),
	);

	protected $_has_one = array(
		'seminar' => array(
        	'model'       => 'Seminar',
        	'foreign_key' => 'conference',
    	),
	);
	protected $_belongs_to = array(
    	'conference_type' => array(
        	'model'       => 'ConferenceType',
        	'foreign_key' => 'type',
    	),
    	'conference_venue' => array(
        	'model'       => 'Venue',
        	'foreign_key' => 'venue',
    	),
	);
	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty')
			),
			'start_date' => array(
				array('not_empty')
			),
			'end_date' => array(
				array('not_empty')
			),
			'description' => array(
				array('not_empty')
			),
			'contact_person' => array(
				array('not_empty')
			),
			'contact_email' => array(
				array('email')
			),
		);
	}

	public function filters()
	{
		return array(
			'name' => array(
				array('trim'),
			),
			'start_date' => array(
				array('trim')
			),
			'end_date' => array(
				array('trim')
			),
			'description' => array(
				array('trim')
			),
			'contact_person' => array(
				array('trim')
			),
			'contact_email' => array(
				array('trim')
			),
		);
	}

	public function get_start_date()
	{
		return Util_Date::to_readable_date($this->start_date);
	}
}