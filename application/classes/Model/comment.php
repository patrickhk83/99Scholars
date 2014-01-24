<?php defined('SYSPATH') or die('No direct script access.');

class Model_Comment extends ORM {
	
	// contains many to one relation mainly
	protected $_belongs_to = array (
		// a comment is related to only one article
		'article' => array (
			'model'			=> 'article',
			'foreign_key'	=> 'article_id'
		),
		'author' => array (
			'model'			=> 'User',
			'foreign_key'	=> 'user'
		)
	);
	public function rules()	{
		return array (
			'comment' => array (		// property name to validate
				array('not_empty'),		// validation type
				),
			
		);
	}
}
