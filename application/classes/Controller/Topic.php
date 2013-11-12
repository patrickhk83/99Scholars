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
				$topic_service->create($user_id, $this->request->post());

				$user_service = new Service_User();
				$user = $user_service->get_by_id($user_id);

				$result['status'] = 'ok';
				$result['html'] = '<tr><td><p>'
									.'<strong><a href="#" class="topic-title">'.$this->request->post('title').'</a></strong> '
									.'<br><small><a href="#">'.$user['first_name'].' '.$user['last_name'].'</a> <span class="text-muted">1 minute ago</span></small>'
									.'</p></td></tr>';
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
}