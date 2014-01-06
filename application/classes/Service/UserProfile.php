<?php defined('SYSPATH') or die('No direct script access.');

class Service_UserProfile {

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
		$journal_dao = new Dao_Journal();
		$productKeyCount = count(preg_grep("/^has_coauthor(\d)+$/",array_keys($_POST)));
		$has_coauthor = '';
		for($i = 1; $i<=$productKeyCount; $i++)
		{
			if(!empty($data['has_coauthor'.$i])){
				$has_coauthor .= $data['has_coauthor'.$i]."^^^^";
			}
		}
		
		$journal_dao->create($user_id,
								$has_coauthor,
								$data['status'],
								$data['year'],
								$data['title'],
								$data['journal'],
								$data['volume'],
								$data['issue'],
								$data['start'],
								$data['end'],
								$data['link']);
		
		$author_dao = new Dao_Journal();
		$results = $author_dao->get_last_user_id($user_id);
		
		
		foreach ($results as $result1)
		{
			$author_dao1 = new Dao_Journal();
			$author_dao1->insert_list($result1->get('id'),$has_coauthor);
		}
		
		

		//TODO: check if there is co-author
		$result = array();
		$result['status'] = 'ok';

		$user_service = new Service_User();
		$user = $user_service->get_by_id($user_id);
		
		$journaldetail = new Dao_Journal();
		$journal = $journaldetail->get_last_user_id($user_id);
		
		foreach ($journal as $dataval)
		{
			$author_detail = new Dao_Journal();
			$usernames = $author_detail->get_last_author($dataval->get('id'));
			foreach ($usernames as $val)
			{
				$user_names = $val['author_name'];
			}
		}

		$result['result_to_display'] = Util_Journal::format($user_names,
															$user['first_name'],
															$user['last_name'],
															$data['year'],
															$data['title'],
															$data['journal'],
															$data['volume'],
															$data['issue'],
															$data['start'],
															$data['end']);

		return $result;
	}
	
	protected function create_confproc($user_id, $data)
	{
		$confproc_dao = new Dao_confproc();
		$confproc_dao->create($user_id,
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['conference'],
								$data['start'],
								$data['end']);

		//TODO: check if there is co-author

		$result = array();
		$result['status'] = 'ok';

		$user_service = new Service_User();
		$user = $user_service->get_by_id($user_id);
		
		$confproc_dao = new Dao_confproc();
		$results = $confproc_dao->get_last_user_id($user_id);
		
		foreach ($results as $result1) 
		{
		$result['result_to_display'] = Util_confproc::formatnew($user['last_name'],
															$user['first_name'],
															$data['year'],
															$data['title'],
															$data['conference'],
															$data['status'],
															$data['start'],
															$data['end'],
															$result1->get('id'));
		return $result;
		}
	}
	
	protected function create_chapter($user_id, $data)
	{
		$chapter_dao = new Dao_chapter();
		$chapter_dao->create($user_id,
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['book_chapter'],
								$data['start'],
								$data['end']);

		//TODO: check if there is co-author

		$result = array();
		$result['status'] = 'ok';

		$user_service = new Service_User();
		$user = $user_service->get_by_id($user_id);
		
		$chapter_dao = new Dao_chapter();
		$results = $chapter_dao->get_last_user_id($user_id);
		
		foreach ($results as $result1) 
		{
		$result['result_to_display'] = Util_chapter::formatnew($user['last_name'],
															$user['first_name'],
															$data['year'],
															$data['title'],
															$data['book_chapter'],
															$data['status'],
															$data['start'],
															$data['end'],
															$result1->get('id'));
		return $result;
		}
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
		$book_dao = new Dao_book();
		$book_dao->create($user_id,
								$data['has_coauthor'],
								$data['status'],
								$data['year'],
								$data['title'],
								$data['book_name'],
								$data['start'],
								$data['end']);

		//TODO: check if there is co-author

		$result = array();
		$result['status'] = 'ok';

		$user_service = new Service_User();
		$user = $user_service->get_by_id($user_id);
		
		$book_dao = new Dao_book();
		$results = $book_dao->get_last_user_id($user_id);
		
		foreach ($results as $result1) 
		{
		$result['result_to_display'] = Util_book::formatnew($user['last_name'],
															$user['first_name'],
															$data['year'],
															$data['title'],
															$data['book_name'],
															$data['status'],
															$data['start'],
															$data['end'],
															$result1->get('id'));
		return $result;
		}
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
				$publications = array();

				$journal_service = new Service_Journal();
				$journals = $journal_service->get_journal_list_for_display($user_id);

				$publications['journals'] = $journals;
				$publications['count']['journal'] = count($journals);
				
				$confproc_service = new Service_confproc();
				$confprocs = $confproc_service->get_confproc_list_for_display($user_id);

				$publications['confprocs'] = $confprocs;
				$publications['count']['confproc'] = count($confprocs);
				
				$chapter_service = new Service_chapter();
				$chapters = $chapter_service->get_chapter_list_for_display($user_id);

				$publications['chapters'] = $chapters;
				$publications['count']['chapter'] = count($chapters);
				
				$book_service = new Service_book();
				$books = $book_service->get_book_list_for_display($user_id);

				$publications['books'] = $books;
				$publications['count']['book'] = count($books);

				$view->publications = $publications;
				
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
				$view->journals = $journal_service->get_journal_list_for_display($user_id);
				break;
			
			case 'confproc':
				$confproc_service = new Service_confproc();
				$view->confprocs = $confproc_service->get_confproc_list_for_display($user_id);
				break;
			
			case 'chapter':
				$chapter_service = new Service_chapter();
				$view->chapters = $chapter_service->get_chapter_list_for_display($user_id);
				break;
			
			case 'book':
				$book_service = new Service_book();
				$view->books = $book_service->get_book_list_for_display($user_id);
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
}
