<?php defined('SYSPATH') or die('No direct script access.');

class Model_Activity extends ORM {

	protected $_table_name = 'activities';

	public function rules()
	{
		return array(
			'action_type' => array(
				array('not_empty')
			),
			'component_type' => array(
				array('not_empty')
			),
		);
	}

	public function filters()
	{
		return array(
			'action_type' => array(
				array('trim'),
			),
			'component_type' => array(
				array('trim')
			),
		);
	}
}