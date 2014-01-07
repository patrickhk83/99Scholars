<?php defined('SYSPATH') or die('No direct script access.');

class Model_categories extends ORM {

	protected $_table_name = 'categories';
	protected $_has_many = array(
		// an article has many comments
		'comments' => array(
			'model'			=> 'article',
			'foreign_key'	=> 'category_id',
		),
		
	);
}