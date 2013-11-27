<?php defined('SYSPATH') or die('No direct script access.');

class Model_UserDegree extends ORM {

	protected $_table_name = 'user_degree';
	protected $_belongs_to = array(
		'organization' => array(
        	'model'       => 'Organization',
        	'foreign_key' => 'institute',
    	)
    );
}