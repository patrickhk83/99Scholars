<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Conference extends Controller {

	public function action_view()
	{
		$id = $this->request->param('id');
		
		Log::instance()->add(Log::INFO, 'controller conference id: :id', array(
    		':id' => $id,
		));

		//Create instance for Service_UserAction class.
		$conference_action_view_track = new Service_UserAction();
		//Register View Action for Conference(id, ControllerName, ActionName).
        $conference_action_view_track->register_user_action($this , 'view' , null , $id);

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
				if(!empty($conf['start_date'])){
					$view->start_date = $conf['start_date'];
				}else {
					$view->start_date = date('Y-m-d');
				}
				if(!empty($conf['end_date'])){
					$view->end_date = $conf['end_date'];
				}else {
					$view->end_date = $view->start_date;
				}
				
				$session_data = new Service_Schedule();
				$result_session = $session_data->get_session_data($id);
				
				if(!empty($result_session)){
					$i = 0;
					foreach($result_session as $value)
					{
						$session_name[$i]['name'] = $value->get('title');
						$session_name[$i]['date'] = $value->get('date');
						$session_name[$i]['id'] = $value->get('id');
						$i++;
					}
					
					if(!empty($session_name)){
						$view->session_names = $session_name;
					}
				}
				
				$room_data = new Service_Schedule();
				$result_room = $room_data->get_room_list($id);
				
				if(!empty($result_room)){
					$i = 0;
					foreach($result_room as $value)
					{
						$room_name[$i]['name'] = $value->get('room_name');
						
						$session_data = new Service_Schedule();
						$session_result = $session_data->get_session_list($value->get('conference_session'));
						$session_date = strtotime($session_result->get('date'));
						$room_name[$i]['session'] = date('d/m/Y',$session_date).' - '.$session_result->get('title');
						
						$i++;
					}
					
					if(!empty($room_name)){
						$view->room_names = $room_name;
					}
				}
				
				$time_data = new Service_Schedule();
				$result_time = $time_data->get_time_list($id);
				
				if(!empty($result_time)){
					$i = 0;
					foreach($result_time as $value)
					{
						$time_name[$i]['start_time'] = date('h:i A',$value->get('start_time'));
						$time_name[$i]['end_time'] = date('h:i A',$value->get('end_time'));
						
						$session_data = new Service_Schedule();
						$session_result = $session_data->get_session_list($value->get('conference_session'));
						$session_date = strtotime($session_result->get('date'));
						$time_name[$i]['session'] = date('d/m/Y',$session_date).' - '.$session_result->get('title');
						
						$i++;
					}
					
					if(!empty($time_name)){
						$view->time_names = $time_name;
					}
				}
				
				$presentation_data = new Service_Schedule();
				$result = $presentation_data->get_presentation_list($id);
				
				if(!empty($result)){
					$i = 0;
					foreach($result as $value)
					{
						if(is_null($value->get('end_time_table'))){
							$starttime = $value->get('time_table');
							$time_data = new Service_Schedule();
							$result_time = $time_data->get_time($starttime);
							$first_time_slot = date('h:i A',$result_time->get('start_time'));
							$last_time_slot = date('h:i A',$result_time->get('end_time'));
							
							$timeslot = $first_time_slot." - ".$last_time_slot;
						}else {
							$starttime = $value->get('time_table');
							$time_data = new Service_Schedule();
							$result_time = $time_data->get_time($starttime);
							$first_time_slot = date('h:i A',$result_time->get('start_time'));
							
							$endtime = $value->get('end_time_table');
							$end_time_data = new Service_Schedule();
							$result_end_time = $time_data->get_time($endtime);
							$last_time_slot = date('h:i A',$result_end_time->get('end_time'));
							
							$timeslot = $first_time_slot." - ".$last_time_slot;
						}
						
						$roomid = $value->get('conference_room');
						$room_data = new Service_Schedule();
						$result_room = $room_data->get_room($roomid);
						
						$roomname = $result_room->get('room_name');
						$sessionid = $result_room->get('conference_session');
						
						$session_data = new Service_Schedule();
						$session_result = $session_data->get_session_list($sessionid);
						$session_date = strtotime($session_result->get('date'));
						$session_name = date('d/m/Y',$session_date).' - '.$session_result->get('title');
						
						$presentationid = $value->get('presentation');
						$presentation_data = new Service_Schedule();
						$result_presentation = $room_data->get_presentation($presentationid);
						
						$presentationtitle = $result_presentation->get('title');
						
						$presentation_final[$i]['session'] = $session_name;
						$presentation_final[$i]['timeslot'] = $timeslot;
						$presentation_final[$i]['title'] = $presentationtitle;
						$presentation_final[$i]['room'] = $roomname;
						$i++;
					}
					
					if(!empty($presentation_final)){
						$view->presentation_final = $presentation_final;
					}
				}
				
				/*final display*/
				
				$session_all_data = new Service_Schedule();
				$resultfinal = $session_all_data->get_all_session_list($id);
				
				$i = 0;
				if(!empty($resultfinal)){
					foreach($resultfinal as $result2)
					{
						$finaldates[] = $result2['date'];
						$i++;
					}
				}
				
				$j = 0;
				if(!empty($finaldates)){
					foreach($finaldates as $value)
					{
						$session_all_ids = new Service_Schedule();
						$result = $session_all_ids->get_all_ids_session($id, $value);
						
						$session_date = strtotime($value);
						
						if(!empty($result)){
							foreach($result as $value1)
							{
								$display_data = new Service_Schedule();
								$display_result = $display_data->get_display_data($value1['id']);
								//print_r($display_result);die;
								if(!empty($display_result)){
									foreach($display_result as $result)
									{
										$session_date = strtotime($result['date']);
										$presentation_view[$j]['id'] = $result['id'];
										$presentation_view[$j]['date'] = date('d/m/Y',$session_date);
										$presentation_view[$j]['room_name'] = $result['room_name'];
										$presentation_view[$j]['title'] = $result['title'];
										
										
										
										if(is_null($result['end_time_table'])){
										$presentation_view[$j]['start_time'] = date('h:i A',$result['start_time']);
										$presentation_view[$j]['end_time'] = date('h:i A',$result['end_time']);
										}else {
										$starttime = $result['time_table'];
										$time_data = new Service_Schedule();
										$result_time = $time_data->get_time($starttime);
										$first_time_slot = date('h:i A',$result_time->get('start_time'));
										$presentation_view[$j]['start_time'] = $first_time_slot;
										
										$endtime = $result['end_time_table'];
										$end_time_data = new Service_Schedule();
										$result_end_time = $time_data->get_time($endtime);
										$last_time_slot = date('h:i A',$result_end_time->get('end_time'));
										$presentation_view[$j]['end_time'] = $last_time_slot;
										}
										
										
										$j++;
									}
								}
							}
						}
					}
				}
				
				if(!empty($presentation_view)){
					$view->presentation_front = $presentation_view;
				}
				
				
					/*
					$j = 0;
					$finalids = '';
					$finalrooms = '';
					$finaltimes = '';
					
					foreach($result as $value1)
					{
						$finalids .= $value1['id'].', ';
						$in_room_list = new Service_Schedule();
						$room_data = $in_room_list->get_all_room_list($value1['id']);
						
						foreach($room_data as $value2)
						{
							$finalrooms .= $value2['room_name'].', ';
							
							$roomids[] = $value2['id'];
							
							//$roomtitle =  new Service_Schedule();
							//$roomtitleval = $roomtitle->get_presentation_title_room($value2['id']);
							//print_r($roomtitleval);
							//die;
						}
						
						$in_time_list = new Service_Schedule();
						$time_data = $in_room_list->get_all_time_list($value1['id']);
						
						foreach($time_data as $value3)
						{
							$finaltimes .= date('h:i A',$value3['start_time']).' - '.date('h:i A',$value3['end_time']).', ';
							$timeids = $value3['id'];
						}
						
						print_r($roomids);
						die;
					}
					
					$dates[$j]['id'] = $finalids;
					$dates[$j]['room'] = $finalrooms;
					$dates[$j]['time'] = $finaltimes;
					$j++;
				}
				if(!empty($dates)){
					$view->presentation_dates = $dates;
				}
				
				echo "<pre>";
				print_r($dates);
				die;
				*/
				/*end final display*/
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

			//Create instance for Service_UserAction class.
			$conference_action_attend_track = new Service_UserAction();
			//Register Create Action for Conference(id, ControllerName, ActionName).
	        $conference_action_attend_track->register_user_action($this , 'create' , null , $id);


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

			//Create instance for Service_UserAction class.
			$conference_action_attend_track = new Service_UserAction();
			//Register Attend Action for Conference(id, ControllerName, ActionName).
	        $conference_action_attend_track->register_user_action($this , 'attend' , null , $conf_id , $user_id);

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

		//Create instance for Service_UserAction class.
		$conference_action_attend_track = new Service_UserAction();
		//Register AttendCancel Action for Conference(id, ControllerName, ActionName).
        $conference_action_attend_track->register_user_action($this , 'cancel' , null , $conf_id , $user_id);

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

				//Create instance for Service_UserAction class.
				$conference_action_upload_video_track = new Service_UserAction();
				//Register Upload Video Action for Conference(id, ControllerName, ActionName).
		        $conference_action_upload_video_track->register_user_action($this , 'uploadVideo' , $videoid , $conf_id , $user_id);

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

				//Create instance for Service_UserAction class.
				$conference_action_upload_video_track = new Service_UserAction();
				//Register Delete Uploaded Video Action for Conference(ConferenceID, ControllerName, ActionName, UserID, VideoID).
		        $conference_action_upload_video_track->register_user_action($this , 'deleteVideo' , $videoid , $conf_id , $user_id);

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

		//Create instance for Service_UserAction class.
		$conference_action_upload_file_track = new Service_UserAction();
		//Register Upload File Action for Conference(ControllerName, ActionName, ConferenceID).
        $conference_action_upload_file_track->register_user_action($this , 'uploadFile' , null , $conf_id);

			
		$this->redirect('/conference/view/'.$conf_id, 302);
	}
	
	public function action_uploadphoto()
	{
		$conf_id = $_POST["hidden1"];
		$desc = $_POST["photodesc"];		
		$user_service1 = new Service_Photo();
		$result = $user_service1->upload_multiple_photo($_FILES['file'],"conference-$conf_id",$conf_id,$desc);

		//Create instance for Service_UserAction class.
		$conference_action_upload_photo_track = new Service_UserAction();
		//Register Upload Photo Action for Conference(ControllerName, ActionName, ConferenceID).
        $conference_action_upload_photo_track->register_user_action($this , 'uploadPhoto' , null , $conf_id);
		
		$this->redirect('/conference/view/'.$conf_id, 302);
	}

	public function action_form()
	{
		$conf_type = $this->request->param('id');

		$view = View::factory('conference/form_'.$conf_type);

		$this->response->body($view);
	}
public function action_insert()
	{
		$conf_id = $this->request->param('id');
		$type = $_REQUEST['type'];
		$user_id = Service_Login::get_user_in_session();
		
		switch($type){
			case 'session':
				$text = $_REQUEST['text'];
				$date = $_REQUEST['date'];
				$session_insert = new Dao_Schedule();
				$result = $session_insert->create_session($conf_id, $user_id, $date, $text);
				
				$result['name'] = $text;
				$result['date'] = $date;
				break;
				
			case 'room':
				$roomname = $_REQUEST['room_name'];
				$session_id = $_REQUEST['session_id'];
				$room_insert = new Dao_Schedule();
				$result = $room_insert->create_room($user_id, $session_id, $roomname);
				
				$session_data = new Service_Schedule();
				$session_result = $session_data->get_session_list($session_id);
				$session_date = strtotime($session_result->get('date'));
				$session_value = date('d/m/Y',$session_date).' - '.$session_result->get('title');
				
				$result['name'] = $roomname;
				$result['session'] = $session_value;
				break;
			
			case 'time':
				$start_time = $_REQUEST['start_time'];
				$end_time = $_REQUEST['end_time'];
				$session_id = $_REQUEST['session_id'];
				$time_insert = new Dao_Schedule();
				$result = $time_insert->create_time($user_id, $session_id, $start_time, $end_time);
				
				$session_data = new Service_Schedule();
				$session_result = $session_data->get_session_list($session_id);
				$session_date = strtotime($session_result->get('date'));
				$session_value = date('d/m/Y',$session_date).' - '.$session_result->get('title');
				
				$result['start_time'] = $start_time;
				$result['end_time'] = $end_time;
				$result['session'] = $session_value;
				break;
			
			case 'presentation':
				$time_table = $_REQUEST['time_id'];
				$end_time_table = $_REQUEST['end_time_id'];
				$presentation_room = $_REQUEST['room_id'];
				$presentation_slot = $_REQUEST['presentation_slot'];
				$presentation_name = $_REQUEST['presentation_name'];
				$session_id = $_REQUEST['session_id'];
				$presentation_insert = new Dao_Schedule();
				$result = $presentation_insert->create_presentation($user_id, $session_id, $time_table, $end_time_table, $presentation_room, $presentation_slot, $presentation_name);
				
				$session_data = new Service_Schedule();
				$session_result = $session_data->get_session_list($session_id);
				$session_date = strtotime($session_result->get('date'));
				$session_value = date('d/m/Y',$session_date).' - '.$session_result->get('title');
				
				//$result['presentation_time'] = $time_table;
				//$result['name'] = $presentation_name;
				//$result['session'] = $session_value;
				break;
		}
		$this->response->headers('Content-Type', 'application/json; charset=utf-8');
		$this->response->body(json_encode($result));
	}
	
	public function action_get()
	{
		$conf_id = $this->request->param('id');
		$session_id = $_REQUEST['session_id'];
		
		$room_data = new Service_Schedule();
		$result_room = $room_data->get_room_session_list($session_id);
		
		if(!empty($result_room)){
			foreach($result_room as $value)
			{
				$result1[]['room'] = $value->get('room_name')."^^^^".$value->get('id');
			}
			if(!empty($result1)){
				$result['room'] = $result1;
			}else {
				$result['room'] = '';
			}
		}
				
		$time_data = new Service_Schedule();
		$result_time = $time_data->get_time_session_list($session_id);
		
		if(!empty($result_time)){
			foreach($result_time as $value)
			{
				$result2[]['time'] = date('h:i A',$value->get('start_time'))." - ".date('h:i A',$value->get('end_time'))."^^^^".$value->get('id');
			}
			if(!empty($result2)){
				$result['time'] = $result2;
			}else {
				$result['time'] = '';
			}
		}
		$this->response->headers('Content-Type', 'application/json; charset=utf-8');
		$this->response->body(json_encode($result));
	}

	public function action_suggest_tag()
	{
		$conf_service = new Service_Conference();
		$suggests = $conf_service->get_suggest_tag_list($this->request->post('term'));
		$nCount = 0;
		$suggested_list = "<div class='list-group'>";
		foreach ($suggests as $suggest) {
			$nCount ++;
			$suggested_list .= "<a class='list-group-item' onclick=\"addSelectedTag(".$suggest->get('id')." , '".$suggest->get('tag_name')."');\">".$suggest->get('tag_name')."</a>";

			//$suggested_list[] = $suggest->get('tag_name');	
		}

		if($nCount == 0)
		{
			$suggested_list .= "<a class='list-group-item' onclick=\"addNewTag('";
			$suggested_list	.= $this->request->post('term')."');\">Add \"";
			$suggested_list .= $this->request->post('term')."\" as a tag you need</a>";
		}

		$suggested_list .= "</div>";
		echo json_encode($suggested_list);
	}

	public function action_new_tag()
	{
		$tag_name = $this->request->post('term');
		$conf_service = new Service_Conference();
		$tag_id = $conf_service->set_new_tag($tag_name);
		echo json_encode($tag_id);
	}

	
}