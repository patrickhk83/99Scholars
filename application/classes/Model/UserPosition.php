<?php defined('SYSPATH') or die('No direct script access.');

class Model_UserPosition extends ORM {

	protected $_table_name = 'user_position';
	protected $_belongs_to = array(
		'organization' => array(
        	'model'       => 'Organization',
        	'foreign_key' => 'affiliation',
    	)
    );
}
