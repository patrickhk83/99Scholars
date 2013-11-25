<?php defined('SYSPATH') or die('No direct script access.');

class Model_Organization extends ORM {

	protected $_table_name = 'organization';
	
	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty')
        	),
    	);
	}
	public function filters()
	{
		return array(
			'name' => array(
	            array('trim'),
	        )
	    );
	}
}