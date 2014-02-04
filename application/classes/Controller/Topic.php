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

//2014-02-04 Modified by David Ming Start				
				$topic = ORM::factory('ConferenceTopic' , $topic_id);

				$topic_view = "<tr><td><p><strong><a href='#' class='topic-title' onclick='showTopic(";
				$topic_view .= $topic_id.")'>";
      			$topic_view .= $topic->get('title')."</a></strong><br /><small>";
      			$topic_view .= "<a href='";
      			$topic_view .= URL::site('user/profile/'.$topic->get('created_by'));
      			$topic_view .= "'>".$topic->get('author')->get_fullname();
      			$topic_view .= "</a><span class='text-muted'>";
      			$topic_view .= $topic->get('author')->get_affiliation();
      			$topic_view .= "</span></small><br/><small class='text-muted'>";
      			$topic_view .= Util_Date::time_elapsed($topic->get('created_date')).' ago';
      			$topic_view .= "</small></p></td></tr>";

				$result['status'] = 'ok';
				$result['id'] = $topic_id;
				$result['html'] = $topic_view;
			}
			else
			{
				$result['status'] = 'error';
				$result['message'] = 'Please login before posting discussion';
			}

			echo json_encode($result);
//2014-02-04 Modified by David Ming End			
		}
	}

	public function action_view()
	{
		//$id = $this->request->param('id');
		$id = $this->request->post('term');

		if(isset($id) && $id !== NULL)
		{
			$topic_service = new Service_ConferenceTopic();
			$topic = $topic_service->get_with_comment($id);

			$view = View::factory('discussion/topic_detail');
			$view->topic = $topic;

			$result['status'] = 'ok';
			$result['html'] = $view->render();

			$this->response->headers('Content-Type', 'application/json; charset=utf-8');
			$this->response->body(json_encode($result));
		}
	}
}