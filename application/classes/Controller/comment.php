<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comment extends Controller {
	
	public function action_post() {
		$comment = new Model_Comment();
		$comment->values($this->request->post());
		$comment->save();
		
		$this->redirect("article/view/".$comment->article_id);
	}
	public function action_delete() {
		$comment_id = $this->request->param('id');
		$comment = new Model_Comment($comment_id);
		$comment->delete();
		$this->redirect('/article', 302);
	}

}