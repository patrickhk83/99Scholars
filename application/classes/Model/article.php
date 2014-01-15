<?php defined('SYSPATH') or die('No direct script access.');

class Model_Article extends ORM {
	
		protected $_belongs_to = array (
		// an article is related to only one category
		'category' => array (
			'model'			=> 'categories',
			'foreign_key'	=> 'category_id'
		)
	);
	// contains many relations
	protected $_has_many = array(
		// an article has many comments
		'comments' => array(
			'model'			=> 'comment',
			'foreign_key'	=> 'article_id',
		),
		
	);
	/**
	 * Rule definitions for validation
	 *
	 * @return array
	 */
	public function rules()	{
		return array (
			'title' => array (
				array('not_empty'),
			),
			'content' => array (		// property name to validate
				array('not_empty'),		// validation type
				array(
					'min_length',		// validation type
					array(':value', 10)	// validation parameters
				),
			),
			
		);
	}
	
	public function labels() {
		return array(
			'title'         => 'Title',
			'content'       => 'Content',
			'time' => 'time',
		);
	}
	
}