<?php defined('SYSPATH') or die('No direct script access.');

class Model_Timeslot extends ORM {

	protected $_table_name = 'conference_time_slot';

	protected $_belongs_to = array(
		'slot_presentation' => array(
			'model' => 'ConfPresentation',
			'foreign_key' => 'presentation'
		),
	);

	public function is_single_slot()
	{
		return $this->slot_type == 1 ? TRUE : FALSE; 
	}

	public function is_whole_slot()
	{
		return $this->slot_type == 2 ? TRUE : FALSE; 
	}

	public function is_expand_slot()
	{
		return $this->slot_type == 3 ? TRUE : FALSE; 
	}

	public function get_row_span()
	{
		return $this->slot_span + 1;
	}
}