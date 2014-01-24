<?php defined('SYSPATH') or die('No direct script access.');

class Model_ConferenceTag extends ORM {
	protected $_table_name = 'conference_tag';

	protected $_belongs_to = array(
    	'conference' => array(
        	'model'       => 'Conference',
        	'foreign_key' => 'id',
    	),
    	'tag' => array(
        	'model'       => 'Tag',
        	'foreign_key' => 'id',
    	),		
	);

	public function rules()
	{
		return array(
			'conference_id' => array(
				array('not_empty')
			),
			'tag_id' => array(
				array('not_empty')
			),
		);
	}


}