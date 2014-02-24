<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comment extends Controller {
	
	public function action_post() {
		$comment = new Model_Comment();
		//$user_id = Service_Login::get_user_in_session();
		$comment->values($this->request->post());
		$comment->save();
		
		$this->redirect("blogarticles/view/".$comment->article_id);
	}
	public function action_delete() {
		$comment_id = $this->request->param('id');
		$comment = new Model_Comment($comment_id);
		$comment->delete();
		$this->redirect('/blogarticles', 302);
	}

}