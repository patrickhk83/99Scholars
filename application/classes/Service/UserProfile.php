<?php defined('SYSPATH') or die('No direct script access.');

class Service_UserProfile {
	public $errors = array();
	public function update($type, $data)
	{
		switch($type) {
			case 'general': 
				$this->update_general_info($data);
				break;
			
			case 'confproc': 
				$this->update_confproc_info($data);
				break;
			
			case 'chapter': 
				$this->update_chapter_info($data);
				break;
			
			case 'book': 
				$this->update_book_info($data);
				break;
			
			case 'project': 
				$this->update_project_info($data);
				break;
			
			case 'presentation': 
				$this->update_presentation_info($data);
				break;
		}
	}
	
	public function delete($type, $data)
	{
		switch($type) {
			case 'confproc': 
				$this->delete_confproc_info($data);
				break;
			
			case 'chapter': 
				$this->delete_chapter_info($data);
				break;
			
			case 'book': 
				$this->delete_book_info($data);
				break;
			
			case 'project': 
				$this->delete_project_info($data);
				break;
			
			case 'presentation': 
				$this->delete_presentation_info($data);
				break;
		}
	}

	public function create($type, $user_id, $data)
	{
		$result;

		switch ($type) {
			case 'degree':
				$result = $this->create_degree($user_id, $data);
				break;

			case 'position':
				$result = $this->create_position($user_id, $data);
				break;

			case 'journal':
				$result = $this->create_journal($user_id, $data);
				break;
			
			case 'confproc':
				$result = $this->create_confproc($user_id, $data);
				break;
			
			/*case 'author':
				$result = $this->create_author($user_id, $data);
				break;*/
			
			case 'chapter':
				$result = $this->create_chapter($user_id, $data);
				break;
			
			case 'book':
				$result = $this->create_book($user_id, $data);
				break;
			
			case 'project':
				$result = $this->create_project($user_id, $data);
				break;
			
			case 'presentation':
				$result = $this->create_presentation($user_id, $data);
				break;
			
		}

		return $result;
	}
	
	protected function update_general_info($data)
	{

		$user_service = new Service_User();
		$user_service->update($data['user_id'], $data);

		$user_contact_service = new Service_UserContact();
		$user_contact_service->update($data['user_id'], $data);
	}
	
	protected function update_confproc_info($data)
	{
		$confproc_service = new Dao_confproc();
		$confprocs = $confproc_service->update_list_for_display($data['id'],
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['conference'],
								$data['start'],
								$data['end']);
	}
	
	protected function delete_confproc_info($data)
	{
		$confproc_service = new Dao_confproc();
		$confprocs = $confproc_service->delete_list_for_display($data['id']);
	}
	
	protected function update_chapter_info($data)
	{
		$chapter_service = new Dao_chapter();
		$chapters = $chapter_service->update_list_for_display($data['id'],
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['book_chapter'],
								$data['start'],
								$data['end']);
	}
	
	protected function delete_chapter_info($data)
	{
		$chapter_service = new Dao_chapter();
		$chapters = $chapter_service->delete_list_for_display($data['id']);
	}
	
	protected function update_project_info($data)
	{
		$project_service = new Dao_project();
		$projects = $project_service->update_list_for_display($data['id'],
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['project_name'],
								$data['start'],
								$data['end']);
	}
	
	protected function delete_project_info($data)
	{
		$project_service = new Dao_project();
		$projects = $project_service->delete_list_for_display($data['id']);
	}
	
	protected function update_presentation_info($data)
	{
		$presentation_service = new Dao_presentation();
		$presentations = $presentation_service->update_list_for_display($data['id'],
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['presentation_name'],
								$data['start'],
								$data['end']);
	}
	
	protected function delete_presentation_info($data)
	{
		$presentation_service = new Dao_presentation();
		$presentations = $presentation_service->delete_list_for_display($data['id']);
	}
	
	protected function update_book_info($data)
	{
		$book_service = new Dao_book();
		$books = $book_service->update_list_for_display($data['id'],
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['book_name'],
								$data['start'],
								$data['end']);
	}
	
	protected function delete_book_info($data)
	{
		$book_service = new Dao_book();
		$books = $book_service->delete_list_for_display($data['id']);
	}

	protected function create_degree($user_id, $data)
	{
		$org_id = $this->create_organization($data['university']);

		$degree_dao = new Dao_Degree();
		$degree_dao->create($user_id,
								$data['degree_type'],
								$data['major'],
								$org_id,
								$data['year']);

		$result = array();
		$result['status'] = 'ok';

		return $result;
	}

	protected function create_position($user_id, $data)
	{
		$org_id = $this->create_organization($data['institute']);

		$dep_dao = new Dao_Department();
		$dep_id = $dep_dao->create($data['department'], null, $org_id);

		$position_dao = new Dao_UserPosition();
		$position_dao->create($user_id,
								$data['title'],
								$dep_id,
								$org_id,
								$data['from'],
								$data['to']);

		$result = array();
		$result['status'] = 'ok';

		return $result;
	}

	protected function create_journal($user_id, $data)
	{
//2014-1-25 Modified by David Ming Start
		$nCoAuthorCount = count(preg_grep("/^has_coauthor(\d)+$/",array_keys($_POST)));

		//Insert journal data to Journal table of DB
		if($data['journal_id'] != -1)
			$journal_orm = ORM::factory('Journal' , $data['journal_id']);
		else 
			$journal_orm = ORM::factory('Journal');

		$journal_orm->author = $user_id;
		$journal_orm->status = $data['status'];
		$journal_orm->publish_year = $data['year'];
		$journal_orm->title = $data['title'];
		$journal_orm->journal = $data['journal_name'];
		$journal_orm->volume = $data['volume'];
		$journal_orm->issue = $data['issue'];
		$journal_orm->start_page = $data['start'];
		$journal_orm->end_page = $data['end'];
		$journal_orm->link = $data['link'];

		$journal_orm->save();
		$journal_id = $journal_orm->id;
		
		//Delete all Co-author for related current journal.
		$query = "DELETE FROM co_author WHERE journal='".$journal_id."' AND author_id='1'";
		$results = DB::query(Database::DELETE , $query)->execute();
		
		$nCount1 = 0;
		$nCount = 1;

		while($nCount1 < $nCoAuthorCount)
		{
			if(!isset($data['has_coauthor'.$nCount]) || $data['has_coauthor'.$nCount] == "") 
			{
				$nCount ++;
				continue;
			}
			$co_author_orm = ORM::factory('CoAuthor');
			$co_author_orm->journal = $journal_id;
			$co_author_orm->author_name = $data['has_coauthor'.$nCount];
			$co_author_orm->author_id = 1;
			$co_author_orm->save();
			$nCount ++;
			$nCount1 ++;
		}

		//TODO: check if there is co-author
		
		$status = 'success';
		$journal_service = new Service_Journal();
		//$result_to_display = $journal_service->get_journal_by_id($journal_id);
		$result_to_display = $journal_service->get_journal_list($user_id , FALSE , TRUE);
		$message = "Journal has been registered successfully.";
		$result = array('status' => $status , 
						'result_to_display' => $result_to_display , 
						'message' => $message);
		return $result;
//2014-1-25 Modified by David Ming End		
	}
	
	protected function create_confproc($user_id, $data)
	{
//2014-1-25 Modified by David Ming Start		
		$nCoAuthorCount = count(preg_grep("/^has_confproc_coauthor(\d)+$/",array_keys($_POST)));

		if($data['confproc_id'] != -1)
			$confproc_orm = ORM::factory('ConfProc' , $data['confproc_id']);
		else 
			$confproc_orm = ORM::factory('ConfProc');

		$confproc_orm->author = $user_id;
		$confproc_orm->status = $data['confproc_status'];
		$confproc_orm->publish_year = $data['confproc_year'];
		$confproc_orm->title = $data['confproc_title'];
		$confproc_orm->conference = $data['confproc_name'];
		$confproc_orm->conference_city = $data['confproc_city'];
		$confproc_orm->conference_country = $data['confproc_country'];
		$confproc_orm->start_page = $data['confproc_start'];
		$confproc_orm->end_page = $data['confproc_end'];

		$confproc_orm->save();
		$confproc_id = $confproc_orm->id;

		//Delete all Co-author for related current ConfProc.
		$query = "DELETE FROM co_author WHERE journal='".$confproc_id."' AND author_id='2'";
		$results = DB::query(Database::DELETE , $query)->execute();

		$nCount1 = 0;
		$nCount = 1;
	
		while($nCount1 < $nCoAuthorCount)
		{
			if(!isset($data['has_confproc_coauthor'.$nCount]) || $data['has_confproc_coauthor'.$nCount] == "") 
			{
				$nCount ++;
				continue;
			}
			$co_author_orm = ORM::factory('CoAuthor');
			$co_author_orm->journal = $confproc_id;
			$co_author_orm->author_name = $data['has_confproc_coauthor'.$nCount];
			$co_author_orm->author_id = 2;
			$co_author_orm->save();
			$nCount ++;
			$nCount1 ++;
		}
	
		$status = 'success';
		$confproc_service = new Service_ConfProc();
		$result_to_display = $confproc_service->get_conference_proceeding_list($user_id , FALSE , TRUE);
		$message = "Conference Proceeding has been registered successfully.";
		$result = array('status' => $status , 
						'result_to_display' => $result_to_display , 
						'message' => $message);
		return $result;
//2014-1-25 Modified by David Ming End		
	}
	
	protected function create_chapter($user_id, $data)
	{
//2014-1-25 Modified by David Ming Start	
		$nCoAuthorCount = count(preg_grep("/^has_chapter_coauthor(\d)+$/",array_keys($_POST)));

		if($data['book_chapter_id'] != -1)
			$chapter_orm = ORM::factory('BookChapter' , $data['book_chapter_id']);
		else 
			$chapter_orm = ORM::factory('BookChapter');

		$chapter_orm->author = $user_id;
		$chapter_orm->publish_year = $data['chapter_year'];
		$chapter_orm->chapter_title = $data['chapter_title'];
		$chapter_orm->book_title = $data['chapter_book_name'];
		$chapter_orm->publisher_city = $data['chapter_publisher_city'];
		$chapter_orm->publisher_name = $data['chapter_publisher'];
		$chapter_orm->start_page = $data['chapter_start'];
		$chapter_orm->end_page = $data['chapter_end'];

		$chapter_orm->save();
		$chapter_id = $chapter_orm->id;

		//Delete all Co-author for related current BookChapter.
		$query = "DELETE FROM co_author WHERE journal='".$chapter_id."' AND author_id='3'";
		$results = DB::query(Database::DELETE , $query)->execute();

		$nCount1 = 0;
		$nCount = 1;
	
		while($nCount1 < $nCoAuthorCount)
		{
			if(!isset($data['has_chapter_coauthor'.$nCount]) || $data['has_chapter_coauthor'.$nCount] == "") 
			{
				$nCount ++;
				continue;
			}
			$co_author_orm = ORM::factory('CoAuthor');
			$co_author_orm->journal = $chapter_id;
			$co_author_orm->author_name = $data['has_chapter_coauthor'.$nCount];
			$co_author_orm->author_id = 3;
			$co_author_orm->save();
			$nCount ++;
			$nCount1 ++;
		}

		$query = "DELETE FROM editor WHERE book_chapter_id='".$chapter_id."'";
		$results = DB::query(Database::DELETE , $query)->execute();
		$editor_orm = ORM::factory('Editor');
		$editor_orm->editor_name = $data['chapter_editors'];
		$editor_orm->book_chapter_id = $chapter_id;
		$editor_orm->save();

		$status = 'success';
		$chapter_service = new Service_BookChapter();
		$result_to_display = $chapter_service->get_book_chapter_list($user_id , FALSE , TRUE);
		$message = "Book Chapter has been registered successfully.";
		$result = array('status' => $status , 
						'result_to_display' => $result_to_display , 
						'message' => $message);
		return $result;		
//2014-1-25 Modified by David Ming End					
	}
	
	protected function create_project($user_id, $data)
	{
		$project_dao = new Dao_project();
		$project_dao->create($user_id,
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['project_name'],
								$data['start'],
								$data['end']);

		//TODO: check if there is co-author

		$result = array();
		$result['status'] = 'ok';

		$user_service = new Service_User();
		$user = $user_service->get_by_id($user_id);
		
		$project_dao = new Dao_project();
		$results = $project_dao->get_last_user_id($user_id);
		
		foreach ($results as $result1) 
		{
		$result['result_to_display'] = Util_project::formatnew($user['last_name'],
															$user['first_name'],
															$data['year'],
															$data['title'],
															$data['project_name'],
															$data['status'],
															$data['start'],
															$data['end'],
															$result1->get('id'));
		return $result;
		}
	}
	
	protected function create_presentation($user_id, $data)
	{
		$presentation_dao = new Dao_presentation();
		$presentation_dao->create($user_id,
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['presentation_name'],
								$data['start'],
								$data['end']);

		//TODO: check if there is co-author

		$result = array();
		$result['status'] = 'ok';

		$user_service = new Service_User();
		$user = $user_service->get_by_id($user_id);
		
		$presentation_dao = new Dao_presentation();
		$results = $presentation_dao->get_last_user_id($user_id);
		
		foreach ($results as $result1) 
		{
		$result['result_to_display'] = Util_presentation::formatnew($user['last_name'],
															$user['first_name'],
															$data['year'],
															$data['title'],
															$data['presentation_name'],
															$data['status'],
															$data['start'],
															$data['end'],
															$result1->get('id'));
		return $result;
		}
	}
	
	protected function create_book($user_id, $data)
	{
//2014-1-25 Modified by David Ming Start	
		$nCoAuthorCount = count(preg_grep("/^has_book_coauthor(\d)+$/",array_keys($_POST)));

		if($data['book_id'] != -1)
			$book_orm = ORM::factory('Book' , $data['book_id']);
		else 
			$book_orm = ORM::factory('Book');

		$book_orm->author = $user_id;
		$book_orm->publish_year = $data['book_year'];
		$book_orm->book_title = $data['book_title'];
		$book_orm->publisher_city = $data['book_publisher_city'];
		$book_orm->publisher_name = $data['book_publisher'];

		$book_orm->save();
		$book_id = $book_orm->id;

		//Delete all Co-author for related current BookChapter.
		$query = "DELETE FROM co_author WHERE journal='".$book_id."' AND author_id='4'";
		$results = DB::query(Database::DELETE , $query)->execute();

		$nCount1 = 0;
		$nCount = 1;
	
		while($nCount1 < $nCoAuthorCount)
		{
			if(!isset($data['has_book_coauthor'.$nCount]) || $data['has_book_coauthor'.$nCount] == "") 
			{
				$nCount ++;
				continue;
			}
			$co_author_orm = ORM::factory('CoAuthor');
			$co_author_orm->journal = $book_id;
			$co_author_orm->author_name = $data['has_book_coauthor'.$nCount];
			$co_author_orm->author_id = 4;
			$co_author_orm->save();
			$nCount ++;
			$nCount1 ++;
		}

		$status = 'success';
		$book_service = new Service_Book();
		$result_to_display = $book_service->get_book_list($user_id , FALSE , TRUE);
		$message = "Book Chapter has been registered successfully.";
		$result = array('status' => $status , 
						'result_to_display' => $result_to_display , 
						'message' => $message);
		return $result;		
//2014-1-25 Modified by David Ming End	
	}

	private function create_organization($name)
	{
		$org_dao = new Dao_Organization();
		return $org_dao->create($name, null);
	}

	public function render_view_tab($user_id, $tab_name)
	{
		$view = View::factory('profile/user_'.$tab_name);

		switch ($tab_name) {
			case 'publication':
//2014-1-24 Modified by David Ming Start			
				$journal_service = new Service_Journal();
				$view->journal_count = $journal_service->get_journal_count($user_id);
				$view->journals = $journal_service->get_journal_list($user_id);
				$conference_proceeding_service = new Service_ConfProc();
				$view->confproc_count = $conference_proceeding_service->get_conference_proceeding_count($user_id);
				$view->confproc_list = $conference_proceeding_service->get_conference_proceeding_list($user_id);
				$book_chapter_service = new Service_BookChapter();
				$view->book_chapter_count = $book_chapter_service->get_book_chapter_count($user_id);
				$view->book_chapter_list = $book_chapter_service->get_book_chapter_list($user_id);
				$book_service = new Service_Book();
				$view->book_count = $book_service->get_book_count($user_id);
				$view->book_list = $book_service->get_book_list($user_id);
//2014-1-24 Modified by David Ming End
				break;

			case 'event':
				$conf_service = new Service_Conference();
				$view->events = $conf_service->get_conference_user_attend($user_id);
				
			case 'project':
				$project_service = new Service_project();
				$projectnew = $project_service->get_project_list_for_display($user_id);
				
				$projectcount['projects'] = $projectnew;
				$projectcount['count']['project'] = count($projectnew);

				$view->projectcount = $projectcount;
				
			case 'presentation':
				$presentation_service = new Service_presentation();
				$presentationnew = $presentation_service->get_presentation_list_for_display($user_id);

				$presentationcount['presentations'] = $presentationnew;
				$presentationcount['count']['presentation'] = count($presentationnew);
				
				$view->presentationcount = $presentationcount;

			case 'following':
				$user = ORM::factory('User', $user_id);
				$view->following = $user->following->find_all();

				$view->current_user = Service_Login::get_user_in_session();

			case 'follower':
				$user = ORM::factory('User', $user_id);
				$view->followers = $user->follower->find_all();

				$view->current_user = Service_Login::get_user_in_session();
		}

		return $view;
	}

	public function render_edit_tab($user_id, $tab_name)
	{
		$view = View::factory('profile/edit/edit_'.$tab_name);

		switch ($tab_name) {
			case 'degree':
				$degree_service = new Service_Degree();
				$view->degrees = $degree_service->get_degree_list($user_id);
				break;

			case 'position':
				$position_service = new Service_UserPosition();
				$view->positions = $position_service->get_position_list($user_id);
				break;

			case 'journal':
				$journal_service = new Service_Journal();
				$view->journals = $journal_service->get_journal_list($user_id , FALSE , TRUE);
				break;
			
			case 'confproc':
				$confproc_service = new Service_ConfProc();
				$view->confprocs = $confproc_service->get_conference_proceeding_list($user_id , FALSE , TRUE);
				$view->conference_proceeding_country = $confproc_service->get_conference_proceeding_country_list();
				break;
			
			case 'chapter':
				$chapter_service = new Service_BookChapter();
				$view->chapters = $chapter_service->get_book_chapter_list($user_id , FALSE , TRUE);
				break;
			
			case 'book':
				$book_service = new Service_Book();
				$view->books = $book_service->get_book_list($user_id , FALSE , TRUE);
				break;
			
			case 'project':
				$project_service = new Service_project();
				$view->projects = $project_service->get_project_list_for_display($user_id);
				break;
			
			case 'presentation':
				$presentation_service = new Service_presentation();
				$view->presentations = $presentation_service->get_presentation_list_for_display($user_id);
				break;
		}

		return $view;
	}
	
	public function get_overview_info($user_id)
	{
		$result = array();

		$user_service = new Service_User();
		$result['general'] = $user_service->get_by_id($user_id);

		$degree_service = new Service_Degree();
		$degree = $degree_service->get_degree_list($user_id, TRUE);

		if(!empty($degree))
		{
			$result['degree'] = $degree;
			$result['general']['latest_degree'] = $degree[0];
		}

		$result['contact'] = $user_service->get_contact_info($user_id);

		$position_service = new Service_UserPosition();
		$positions = $position_service->get_position_list($user_id);

		if(!empty($positions))
		{
			$result['position'] = $positions[0];
		}

		//get following/follower count
		// TODO: migrate user's info query to User's model

		$user = ORM::factory('User', $user_id);
		$result['following'] = $user->following->find_all()->count();
		$result['follower'] = $user->follower->find_all()->count();

		return $result;
	}

//2014-1-24 Added by David Ming Start
	public function get_user_id_by_url_name($url_name)
	{
		$bNumeric = is_numeric($url_name);
		if($bNumeric) return $url_name;
		//$user_profile = ORM::factory('User')->where('url_key' , '=' , $url_name)->find();

		$query_str = "SELECT COUNT(*) AS nCount FROM user WHERE url_key='".$url_name."'";
		$result = DB::query(Database::SELECT , $query_str)->execute();

		if($result->get('nCount') < 1 || $result->get('nCount') > 1)
			return false;

		$query_str = "SELECT * FROM user WHERE url_key='".$url_name."'";
		$result = DB::query(Database::SELECT , $query_str)->execute();

		return $result->get('id');
	}

	public function get_publication_count($user_id)
	{
		$nCount = 0;
		$query = "SELECT COUNT(*) as nCount FROM journal WHERE author='".$user_id."'";
		$result = DB::query(Database::SELECT , $query)->execute();		
		$nCount += $result->get('nCount');
		$query = "SELECT COUNT(*) as nCount FROM conference_proceeding WHERE author='".$user_id."'";
		$result = DB::query(Database::SELECT , $query)->execute();		
		$nCount += $result->get('nCount');
		$query = "SELECT COUNT(*) as nCount FROM book_chapter WHERE author='".$user_id."'";
		$result = DB::query(Database::SELECT , $query)->execute();		
		$nCount += $result->get('nCount');
		$query = "SELECT COUNT(*) as nCount FROM book WHERE author='".$user_id."'";
		$result = DB::query(Database::SELECT , $query)->execute();		
		$nCount += $result->get('nCount');
		return $nCount;
	}

	public function get_project_count($user_id)
	{
		$query = "SELECT COUNT(*) as nCount FROM project WHERE author='".$user_id."'";
		$result = DB::query(Database::SELECT , $query)->execute();		
		return $result->get('nCount');

	}

	public function get_presentation_count($user_id)
	{
		$query = "SELECT COUNT(*) as nCount FROM presentation WHERE author='".$user_id."'";
		$result = DB::query(Database::SELECT , $query)->execute();		
		return $result->get('nCount');

	}
//2014-1-24 Added by David Ming End

//2014-1-25 Created by David Ming Start
	public function validation_check($type , $data)
	{
		$validation = Validation::factory($data);
		switch($type)
		{
		case 'journal':
			$validation->rule('title' , 'not_empty')
			->rule('journal_name' , 'not_empty')
			->rule('status' , 'not_empty')
			->rule('volume' , 'not_empty')
			->rule('start' , 'not_empty')
			->rule('end' , 'not_empty');

			break;
		case 'confproc':
			$validation->rule('confproc_title' , 'not_empty')
			->rule('confproc_name' , 'not_empty')
			->rule('confproc_status' , 'not_empty')
			->rule('confproc_year' , 'not_empty')
			->rule('confproc_country' , 'not_empty')
			->rule('confproc_city' , 'not_empty')
			->rule('confproc_start' , 'not_empty')
			->rule('confproc_end' , 'not_empty');		
			
			break;
		case 'chapter':
			$validation->rule('chapter_title' , 'not_empty')
			->rule('chapter_editors' , 'not_empty')
			->rule('chapter_book_name' , 'not_empty')
			->rule('chapter_publisher_city' , 'not_empty')
			->rule('chapter_publisher' , 'not_empty')
			->rule('chapter_start' , 'not_empty')
			->rule('chapter_end' , 'not_empty');

			break;
		case 'book':
			$validation->rule('book_title' , 'not_empty')
			->rule('book_publisher_city' , 'not_empty')
			->rule('book_publisher' , 'not_empty');

			break;
		case 'project':
			break;
		case 'presentation':
			break;

		}

		if($validation->check())
			return true;
		else
			return false;
	}
//2014-1-25 Created by David Ming End

}
