<?php defined('SYSPATH') or die('No direct script access.');

class Model_Address extends ORM {

	protected $_table_name = 'address';

	public function rules()
	{
		return array(
			'city' => array(
				array('not_empty')
        	),
        	'country' => array(
				array('not_empty')
        	)
    	);
	}


	public function filters()
	{
		return array(
			'city' => array(
	            array('trim'),
	        ),
	        'country' => array(
	            array('trim'),
	        ),
	    );
	}
}