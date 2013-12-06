<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Conference extends Controller {

	public function action_view()
	{
		$id = $this->request->param('id');
		
		Log::instance()->add(Log::INFO, 'controller conference id: :id', array(
    		':id' => $id,
		));

		//mockup page
		$session_id = $this->request->param('session_id');

		Log::instance()->add(Log::INFO, 'controller conference id: :session_id', array(
    		':session_id' => $session_id,
		));

		if(isset($session_id))
		{
			$view = View::factory('presentation');
			$this->response->body($view);
		}
		else
		{
			$conference = ORM::factory('Conference', $id);
			
			Log::instance()->add(Log::INFO, 'controller conference type: :type', array(
    			':type' => $conference->conference_type->name,
			));
			
			if($conference->conference_type->name == 'Seminar')
			{

				$view = View::factory('seminar');
				$view->conference = $conference;
				
				$view->is_attended = FALSE;
				$user_id = Service_Login::get_user_in_session();

				foreach ($conference->attendee as $attendee) 
				{
					if($attendee->id === $user_id)
					{
						$view->is_attended = TRUE;
					}
				}
				
				$Video_dao = new Dao_Video();
				$Video = $Video_dao->get_video_list($user_id);
				if($Video){
				foreach ($Video as $result1)
				{
					echo "==".$result1->get('youtube_id')."==";
					$videoids[] = $result1->get('youtube_id');
					$eventids[] = $result1->get('event');
				}
				if(!empty($videoids)){
				$view->videos = $videoids;
				$view->event = $eventids[0];
				}
				}

				$this->response->body($view);
			}
			else
			{
				$view = View::factory('schedule');
				$view->id = $id;
				$this->response->body($view);
			}
		}
	}
	public function action_create()
	{
		if(Service_Login::is_login())
		{
			$service_conference = Service_Conference::instance();
			$id = $service_conference->create($this->request->post());
			$this->redirect('/conference/view/'.$id, 302);
		}
		else
		{
			//store conference info in session
			$session = Session::instance();
			$session->set('tmp_conf', $this->request->post());

			//redirect to signup page
			$this->redirect('/signup/after_submit', 302);
		}
	}
	public function action_submit()
	{
		$view = View::factory('conf-submit');
		$view->countries = Model_Constants_Address::$countries;
		$this->response->body($view);
	}

	public function action_search()
	{
		$category = $this->request->query('cat');
		$accept_abstract = $this->request->query('abstract');
		$start_date = $this->request->query('start_date');
		$end_date = $this->request->query('end_date');
		$type = $this->request->query('type');
		$country = $this->request->query('country');
		$page = $this->request->query('page');

		if(!empty($country))
		{
			$country = '\''.str_replace(',', '\',\'', $country).'\'';	
		}

		if(!isset($page) || $page == '' || $page == 0)
		{
			$page = 1;
		}

		$user_id = Service_Login::get_user_in_session();
		$conf_service = new Service_Conference();
		$result = $conf_service->list_by($category, $accept_abstract, $start_date, $end_date, $type, $country, $user_id, $page);
		
		$view = View::factory('conf-search-result');
		$view->conferences = $result['conferences'];
		
		if(array_key_exists('total', $result))
		{
			$view->total = $result['total'];
		}

		$this->response->body($view);
	}

	public function action_attend()
	{
		$conf_id = $this->request->param('id');
		$user_id = Service_Login::get_user_in_session();

		if(isset($user_id) && $user_id !== NULL)
		{
			$user_service = new Service_User();
			$user_service->attend_conference($user_id, $conf_id);

			$user = $user_service->get_by_id($user_id);

			$result['status'] = 'ok';
			$result['id'] = $user_id;
			$result['name'] = $user['first_name'].' '.$user['last_name'];
		}
		else
		{
			$result['status'] = 'error';
			$result['message'] = 'Please login before booking conference.';
		}

		$this->response->headers('Content-Type', 'application/json; charset=utf-8');
		$this->response->body(json_encode($result));
	}

	public function action_cancel()
	{
		$conf_id = $this->request->param('id');
		$user_id = Service_Login::get_user_in_session();

		$user_service = new Service_User();
		$user_service->cancel_booking($user_id, $conf_id);

		$result['id'] = $user_id;

		//TODO: create super controller to support ajax function
		$this->response->headers('Content-Type', 'application/json; charset=utf-8');
		$this->response->body(json_encode($result));
	}
	
	public function action_upload()
	{
		$conf_id = $this->request->param('id');
		$type = $_REQUEST['type'];
		$videoid = $_REQUEST['videoid'];
		$user_id = Service_Login::get_user_in_session();
		
		$result['id'] = $user_id;
		$result['confid'] = $conf_id;
		$result['type'] = $type;
		$result['videoid'] = $videoid;

		$user_service = new Service_User();
		$user_service->add_upload($user_id, $conf_id, $videoid, $type);

		//TODO: create super controller to support ajax function
		$this->response->headers('Content-Type', 'application/json; charset=utf-8');
		$this->response->body(json_encode($result));
	}
	
	public function action_delete()
	{
		$conf_id = $this->request->param('id');
		$videoid = $_REQUEST['videoid'];
		$user_id = Service_Login::get_user_in_session();
		
		$result['id'] = $user_id;
		$result['confid'] = $conf_id;
		$result['videoid'] = $videoid;

		$user_service = new Service_User();
		$user_service->add_delete($user_id, $conf_id, $videoid);

		//TODO: create super controller to support ajax function
		$this->response->headers('Content-Type', 'application/json; charset=utf-8');
		$this->response->body(json_encode($result));
	}

	public function action_form()
	{
		$conf_type = $this->request->param('id');

		$view = View::factory('conference/form_'.$conf_type);

		$this->response->body($view);
	}

	
}