<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Conference extends Controller {

	public function action_view()
	{
		$id = $this->request->param('id');
		
		Log::instance()->add(Log::INFO, 'controller conference id: :id', array(
    		':id' => $id,
		));

		$aaa = new Service_UserAction();
        $aaa->register_user_action($this , 'view' , null , $id);

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
				
				$view->id = $id;
				$view->userid = $user_id;
				$Video_dao = new Dao_Video();
				$Video = $Video_dao->get_video_list($user_id,$id);
				
				if($Video){
					
					
					$j = 0;
					foreach ($Video as $result1)
					{
						$Video_name[$j]['videoid'] = $result1->get('youtube_id');
						$Video_name[$j]['users'] = $result1->get('created_by');
						$j++;
					}
					
					if(!empty($Video_name)){
						$view->videos = $Video_name;
					}
				}
				
				$File_dao = new Dao_File();
				$File = $File_dao->get_all_file_list($id);
				
				if($File){
					$i = 0;
					foreach ($File as $result1)
					{
						$file_name[$i]['name'] = $result1->get('file_name');
						$file_name[$i]['desc'] = $result1->get('description');
						$file_name[$i]['users'] = $result1->get('created_by');
						if($result1->get('size')/1048576 >1 ){
							$bytes = number_format($result1->get('size') / 1048576, 2) . ' MB';
							$file_name[$i]['size'] = $bytes;
						}else {
							$bytes = number_format($result1->get('size') / 1024, 2) . ' KB';
							$file_name[$i]['size'] = $bytes;
						}
						$i++;
					}
					if(!empty($file_name)){
						$view->files = $file_name;
					}
				}
				
				$Photo_dao = new Dao_Photo();
				$Photo = $Photo_dao->get_all_photo_list($id);
				
				if($Photo){
					$i = 0;
					foreach ($Photo as $result1)
					{
						$photo_name[$i]['name'] = $result1->get('photo_name');
						$photo_name[$i]['desc'] = $result1->get('caption');
						$photo_name[$i]['users'] = $result1->get('created_by');
						$bytes = number_format($result1->get('size') / 1024, 2) . ' KB';
						$photo_name[$i]['size'] = $bytes;
						$i++;
					}
					if(!empty($photo_name)){
						$view->photos = $photo_name;
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
		
		$user_id = Service_Login::get_user_in_session();
		
		switch($type) {
			case 'video': 
				$videoid = $_REQUEST['videoid'];
				$result['videoid'] = $videoid;
				
				$user_service = new Dao_Video();
				$user_service->add_upload_video($user_id, $conf_id, $videoid);
				break;
			
			/*case 'file':
				$filename = $_REQUEST['name'];
				$filename = rtrim($filename, "|");
				$filetype = $_REQUEST['filetype'];
				$filetype = rtrim($filetype, "|");
				$filesize = $_REQUEST['size'];
				$filesize = rtrim($filesize, "|");
				$result['filename'] = $filename;
				$result['filetype'] = $filetype;
				$result['filesize'] = $filesize;
				
				$user_service = new Dao_File();
				$user_service->add_upload_file($user_id, $conf_id, $filename, $filetype, $filesize);
				break;*/
		}
		
		$result['id'] = $user_id;
		$result['confid'] = $conf_id;
		$result['type'] = $type;

		//TODO: create super controller to support ajax function
		$this->response->headers('Content-Type', 'application/json; charset=utf-8');
		$this->response->body(json_encode($result));
	}
	
	public function action_delete()
	{
		$conf_id = $this->request->param('id');
		$type = $_REQUEST['type'];
		
		$user_id = Service_Login::get_user_in_session();
		
		switch($type) {
			case 'video': 
				$videoid = $_REQUEST['videoid'];
				$user_service = new Dao_Video();
				$user_service->add_delete($user_id, $conf_id, $videoid);
				$result['videoid'] = $videoid;
				break;
			
			case 'file':
				$filename = $_REQUEST['filename'];
				$user_service = new Dao_File();
				$user_service->delete_upload_file($user_id, $conf_id, $filename);
				$result['filename'] = $filename;
				break;
			
			case 'photo':
				$photoname = $_REQUEST['photoname'];
				$user_service = new Dao_Photo();
				$user_service->delete_upload_photo($user_id, $conf_id, $photoname);
				$result['filename'] = $photoname;
				break;
		}
		
		$result['id'] = $user_id;
		$result['confid'] = $conf_id;
		
		//TODO: create super controller to support ajax function
		$this->response->headers('Content-Type', 'application/json; charset=utf-8');
		$this->response->body(json_encode($result));
	}
	
	public function action_update()
	{
		$conf_id = $this->request->param('id');
		$type = $_REQUEST['type'];
		$user_id = Service_Login::get_user_in_session();
		
		switch($type) {
			case 'file':
				$filename = $_REQUEST['filename'];
				$desc = $_REQUEST['desc'];
				$user_service = new Dao_File();
				$user_service->update_file($user_id, $conf_id, $filename, $desc);
				break;
			
			case 'photo':
				$photoname = $_REQUEST['photoname'];
				$desc = $_REQUEST['desc'];
				$user_service = new Dao_Photo();
				$user_service->update_photo($user_id, $conf_id, $photoname, $desc);
				break;
		}
		
	}
	
	public function action_uploadfile()
	{
		$conf_id = $_POST["hidden"];
		$desc = $_POST["filedesc"];
		$user_service = new Service_File();
		$result = $user_service->upload_multiple_file($_FILES['file'],"$conf_id",$conf_id,$desc);
			
		$this->redirect('/conference/view/'.$conf_id, 302);
	}
	
	public function action_uploadphoto()
	{
		$conf_id = $_POST["hidden1"];
		$desc = $_POST["photodesc"];		
		$user_service1 = new Service_Photo();
		$result = $user_service1->upload_multiple_photo($_FILES['file'],"conference-$conf_id",$conf_id,$desc);
		
		$this->redirect('/conference/view/'.$conf_id, 302);
	}

	public function action_form()
	{
		$conf_type = $this->request->param('id');

		$view = View::factory('conference/form_'.$conf_type);

		$this->response->body($view);
	}

	
}