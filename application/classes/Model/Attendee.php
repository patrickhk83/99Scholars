<?php defined('SYSPATH') or die('No direct script access.');

class Model_Attendee extends ORM {

	protected $_table_name = 'attendee';

	protected $_has_many = array(
    	'User' => array(
        	'model'       => 'User',
        	'foreign_key' => 'conference',
    	)
	);
}