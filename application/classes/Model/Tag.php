<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tag extends ORM {

	protected $_table_name = 'tags';
	protected $_has_many = array(
    	'conference_tag' => array(
        	'model'   => 'ConferenceTag',
        	'foreign_key' => 'tag_id'
    	),
    );
	
	public function rules()
	{
		return array(
			'tag_name' => array(
				array('not_empty')
			),
		);
	}

	public function filters()
	{
		return array(
			'tag_name' => array(
				array('trim'),
			),
		);
	}
}