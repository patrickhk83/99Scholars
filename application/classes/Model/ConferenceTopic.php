<?php defined('SYSPATH') or die('No direct script access.');

class Model_ConferenceTopic extends ORM {

	protected $_table_name = 'conference_topic';
	protected $_belongs_to = array(
    	'author' => array(
        	'model'       => 'user',
        	'foreign_key' => 'created_by',
    	),
	);
}