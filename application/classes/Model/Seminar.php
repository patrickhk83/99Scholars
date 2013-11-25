<?php defined('SYSPATH') or die('No direct script access.');

class Model_Seminar extends ORM {

	protected $_table_name = 'seminar';
	public function rules()
	{
		return array(
			'speaker' => array(
				array('not_empty')
        	),
    	);
	}
	public function filters()
	{
		return array(
			'speaker' => array(
	            array('trim'),
	        ),
	        'speaker' => array(
	            array('abstract'),
	        ),
	    );
	}
}