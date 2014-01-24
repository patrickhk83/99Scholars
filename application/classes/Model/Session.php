<?php defined('SYSPATH') or die('No direct script access.');

class Model_Session extends ORM {

	protected $_table_name = 'conference_session';

	protected $_has_many = array(
		'rooms' => array(
			'model' => 'Room',
			'foreign_key' => 'conference_session'
		),
		'timetables' => array(
			'model' => 'Time',
			'foreign_key' => 'conference_session'
		),

	);

	protected $_belong_to = array(
		'conference' => array(
			'model' => 'Conference',
			'foreign_key' => 'event'
		),
	);

	public function get_readable_date()
	{
		return Util_Date::to_readable_date($this->date);
	}
}