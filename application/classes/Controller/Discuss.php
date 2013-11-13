<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Discuss extends Controller {

	public function action_create()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$result = array();

			if(Service_Login::is_login())
			{
				$user_id = Service_Login::get_user_in_session();

				$comment_service = new Service_ConferenceComment();
				$comment_service->create($user_id, $this->request->post());

				$user_service = new Service_User();
				$user = $user_service->get_by_id($user_id);

				$comment = array(
								'author_id' => $user_id,
								'author_name' => $user['first_name'].' '.$user['last_name'],
								'content' => $this->request->post('comment'),
								'last_update' => 'just now');

				$view = View::factory('discussion/topic_comment');
				$view->comment = $comment;

				$result['status'] = 'ok';
				$result['html'] = $view->render();
			}
			else
			{
				$result['status'] = 'error';
				$result['message'] = 'Please login before post comment';
			}

			$this->response->headers('Content-Type', 'application/json; charset=utf-8');
			$this->response->body(json_encode($result));
		}
	}
}