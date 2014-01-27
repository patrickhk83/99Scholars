<?php defined('SYSPATH') or die('No direct script access.');

class Model_Journal extends ORM {

	protected $_table_name = 'journal';
	protected $_has_many = array(
    	'journal_id' => array(
        	'model'   => 'CoAuthor',
        	'foreign_key' => 'journal'
    	),
    );	
}