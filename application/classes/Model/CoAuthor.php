<?php defined('SYSPATH') or die('No direct script access.');

class Model_CoAuthor extends ORM {

	protected $_table_name = 'co_author';
	protected $_belongs_to = array(
    	'journal' => array(
        	'model'       => 'Journal',
        	'foreign_key' => 'id',
    	),
	);
}