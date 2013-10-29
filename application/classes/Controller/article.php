<?php defined('SYSPATH') or die('No direct script access.');

// extends the Controller_Template
class Controller_Article extends Controller_Template {
	
	public $template = 'template';
		
	const INDEX_PAGE = 'article/index';
	
	public function action_index() {
		$articles = ORM::factory('article')->find_all(); // loads all article object from table
		$view = new View('article/index'); // load 'article/index.php' view file
		$view->set("articles", $articles); // set "articles" object to view
		$this->template->set('content', $view); // renders a view as a response
		
$articley = ORM::factory('article')->count_all();

// set-up the pagination
$pagination = Pagination::factory(array(
    'total_items' => $articley,
    'items_per_page' => 10, // this will override the default set in your config
));

// get users using the pagination limit/offset
$art = ORM::factory('article')->offset($pagination->offset)->limit($pagination->items_per_page)->find_all();

// pass the users & pagination to the view
$view->set('pagination', $pagination);
$view->set('art', $art);


		$this->template->set('content', $view); // renders a view as a response
}
	
	public function action_view() {
		$article_id = $this->request->param('id');
		$article = ORM::factory('article', $article_id);
		$view = new View('/article/single');
		$view->set("article", $article);
		$this->template->set('content', $view);
			}
	
	// edit the article
	public function action_edit() {
		$article_id = $this->request->param('id');
		$article = new Model_Article($article_id);
		$view = new View('/article/edit');
		$view->set("article", $article);
		$this->template->set('content', $view); // setting view as content
	}

	// delete the article
	public function action_delete() {
		$article_id = $this->request->param('id');
		$article = new Model_Article($article_id);
		$article->delete();
		$this->redirect('/article', 302);
			}
	
	// save the article
	public function action_post() {
		$article_id = $this->request->param('id');
		$article = new Model_Article($article_id);
		$article->values($this->request->post()); // populate $article object from $_POST array
		$errors = array();
		try {
			$article->save(); // saves article to database
		 $this->redirect('/article', 302);
		} catch (ORM_Validation_Exception $ex) {
			$errors = $ex->errors('validation');
		}
		$view = new View('/article/edit');
		$view->set("article", $article);
		$view->set('errors', $errors);
		$this->template->set('content', $view);
	}
	
}