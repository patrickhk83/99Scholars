<?php defined('SYSPATH') or die('No direct script access.');

class Model_Conference extends ORM {

	protected $_table_name = 'conference';

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
}