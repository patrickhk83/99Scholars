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

	public function get_short_location()
	{
		$location;

		if(isset($this->state) && trim($this->state) !== '')
		{
			$location = $this->state;
		}
		else
		{
			$location = $this->city;
		}

		return $location.", ".Model_Constants_Address::$countries[$this->country];
	}
}