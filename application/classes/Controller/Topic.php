<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Topic extends Controller {

	public function action_create()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$user_id = Service_Login::get_user_in_session();
			$result = array();

			if(isset($user_id) && $user_id !== NULL)
			{
				$topic_service = new Service_ConferenceTopic();
				$topic_id = $topic_service->create($user_id, $this->request->post());

				$user_service = new Service_User();
				$user = $user_service->get_by_id($user_id);

				$topic = array(
							'id' => $topic_id,
							'title' => $this->request->post('title'),
							'author_id' => $user_id,
							'author_name' => $user['first_name'].' '.$user['last_name'],
							'last_update' => 'just now');

				$topic_view = View::factory('discussion/topic_title');
				$topic_view->topic = $topic;

				$result['status'] = 'ok';
				$result['id'] = $topic_id;
				$result['html'] = $topic_view->render();
			}
			else
			{
				$result['status'] = 'error';
				$result['message'] = 'Please login before posting discussion';
			}

			$this->response->headers('Content-Type', 'application/json; charset=utf-8');
			$this->response->body(json_encode($result));
		}
	}

	public function action_view()
	{
		$id = $this->request->param('id');

		if(isset($id) && $id !== NULL)
		{
			$view = View::factory('discussion/topic_detail');

			$result['status'] = 'ok';
			$result['html'] = $view->render();

			$this->response->headers('Content-Type', 'application/json; charset=utf-8');
			$this->response->body(json_encode($result));
		}
	}
}