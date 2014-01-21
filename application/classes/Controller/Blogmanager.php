<?php

defined ( 'SYSPATH' ) or die ( 'No direct script access.' );
class Controller_Blogmanager extends Controller {
	public function action_index() {

		if(!$this->has_permission())
		{
			$this->redirect('/');
		}

		$view = View::factory ( 'category_manager' );
		
		$crud = new Crud ();
		
		$crud->table ( 'categories' );
		$crud->tableAlias ( 'Category Manager	' );
		
		$crud->addNoCol ( true );
		
		$crud->cols ( 'category_name' );
		
		$crud->alias ( 'category_name', 'Name' );
		$crud->alias ( 'category_description', 'Description' );
		
		$crud->type ( 'category_description', 'editor' );
		
		$crud->validate ( 'category_name', 'required' );
		$crud->search ( 'all' );
		
		$html = $crud->fetch ();
		
		$view->bind ( 'html', $html );
		
		$category = $view->render ();
		$this->response->body ( $category );
	}
	
	public function action_articlemanager() {
		$view = View::factory ( 'articles_manager' );
		
		$crud = new Crud ();
		
		$crud->table ( 'articles' );
		$crud->tableAlias ( 'Articles manager' );
		
		$crud->autoType ( true );
		$crud->addNoCol ( true );
		
		$crud->alias ( 'id', 'Id' )
			->alias ( 'category_id', 'Category' )
			->alias ( 'article_title', 'Title' )
			->alias ( 'article_date', 'date	' )
			->alias ( 'image', 'Image' )
			->alias ( 'article_summary', 'Summary' )
			->alias ( 'article_content', 'Content' );
		
		$crud->search ( 'all' );
		$crud->cols ( array (
				'image',
				'article_title',
				'article_date',
				'article_summary' 
		) );
		
		$crud->colWith ( 'image', 150 );
		$crud->colWith ( 'article_title', 200 );
		$crud->colWith ( 'category_id', 80 );
		$crud->colWith ( 'article_date', 80 );
		
		$crud->colAlign ( 'image', 'center' );
		$crud->colAlign ( 'category_id', 'center' );
		$crud->colAlign ( 'article_date', 'center' );
		
		$crud->type ( 'article_title', 'text', array (
				'class' => 'span6' 
		) );
		
		$crud->type ( 'image', 'image', DOCROOT . '/media/images', 'large', 500, 700 );
		$crud->type ( 'article_summary', 'editor' );
		$crud->type ( 'article_content', 'editor', array (
				'height' => '400' 
		) );
		
		$options = getCategories ();
		$crud->type ( 'category_id', 'selectbox', $options );
		
		$crud->validate ( 'article_title', 'required' );
		
		$html = $crud->fetch ();
		
		$view->bind ( 'html', $html );
		
		$article = $view->render ();
		$this->response->body ( $article );
	}

	protected function has_permission()
	{
		if(Service_Login::is_login())
		{
			if(!Auth::instance()->get_user()->is_admin())
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}
}

function getCategories() {
	$sql = 'select id,category_name from categories';
	$query = DB::query ( Database::SELECT, $sql );
	$results = $query->execute ();
	$options = array ();
	$options [''] = '';
	foreach($results as $v){
		$options [$v ['id']] = $v ['category_name'];
	}
	
	return $options;
}

