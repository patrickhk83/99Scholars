<?php defined('SYSPATH') or die('No direct script access.');

class Model_Time extends ORM {

	protected $_table_name = 'conference_time_table';

	protected $_has_many = array(
		'timeslots' => array(
			'model' => 'Timeslot',
			'foreign_key' => 'time_table'
		),
	);

	public function get_readable_starttime()
	{
		return date('h:i A', $this->start_time);
	}
}