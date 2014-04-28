<?php defined('SYSPATH') or die('No direct script access.');

class Model_CategoryConference extends ORM {

	protected $_table_name = 'category_conference';

	public function rules()
	{
		return array(
			'category_id' => array(
				array('not_empty')
        	),
    	);
	}
	public function filters()
	{
		return array(
			'category_id' => array(
	            array('trim'),
	        )
	    );
	}

	protected $_belongs_to = array(
    	'conference_category' => array(
        	'model'       => 'ConferenceCategory',
        	'foreign_key' => 'category_id',
    	),
	);
}