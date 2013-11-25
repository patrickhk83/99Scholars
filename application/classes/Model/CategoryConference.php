<?php defined('SYSPATH') or die('No direct script access.');

class Model_CategoryConference extends ORM {

	protected $_table_name = 'category_conference';

	public function rules()
	{
		return array(
			'category' => array(
				array('not_empty')
        	),
    	);
	}
	public function filters()
	{
		return array(
			'category' => array(
	            array('trim'),
	        )
	    );
	}
}