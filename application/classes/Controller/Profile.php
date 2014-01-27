<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Profile extends Controller {

	public function action_index()
	{

		if(!Service_Login::is_login())
		{
			$this->redirect('/', 302);
		}
		else
		{
			$user_id = Service_Login::get_user_in_session();

			$profile_service = new Service_UserProfile();

			$view = View::factory('profile/profile');

			$view->info = $profile_service->get_overview_info($user_id);

			$view->is_owner = TRUE;

			//TODO: query work count
//2014-1-24 Added David Ming Start
			$publication_count = $profile_service->get_publication_count($user_id);
			$project_count = $profile_service->get_project_count($user_id);
			$presentation_count = $profile_service->get_presentation_count($user_id);

			$view->work_count = array('publication' => $publication_count, 
										'project' => $project_count, 
										'presentation' => $presentation_count);
//2014-1-24 Added David Ming End
			$view->user_id = $user_id;


			$this->response->body($view);
		}
	}

	public function action_event()
	{
		$tab_name = 'event';
		$user_id = $this->request->param('id');
		$view = $this->render_tab($user_id, $tab_name);

		$this->response->body($view);
	}

	public function action_publication()
	{
		$tab_name = 'publication';
		$user_id = $this->request->param('id');
		$view = $this->render_tab($user_id, $tab_name);
		
		$this->response->body($view);
	}

	public function action_project()
	{
		$tab_name = 'project';
		$user_id = $this->request->param('id');
		$view = $this->render_tab($user_id, $tab_name);

		$this->response->body($view);
	}

	public function action_presentation()
	{
		$tab_name = 'presentation';
		$user_id = $this->request->param('id');
		$view = $this->render_tab($user_id, $tab_name);

		$this->response->body($view);
	}

	public function action_following()
	{
		$tab_name = 'following';
		$user_id = $this->request->param('id');
		$view = $this->render_tab($user_id, $tab_name);

		$this->response->body($view);
	}

	public function action_follower()
	{
		$tab_name = 'follower';
		$user_id = $this->request->param('id');
		$view = $this->render_tab($user_id, $tab_name);

		$this->response->body($view);
	}

	protected function render_tab($user_id, $tab_name)
	{
		$profile_service = new Service_UserProfile();
		$view = $profile_service->render_view_tab($user_id, $tab_name);

		return $view;
	}


	public function action_edit()
	{

		$tab_name = $this->request->param('id');

		if(isset($tab_name))
		{
			$user_id = Service_Login::get_user_in_session();

			$profile_service = new Service_UserProfile();
			$view = $profile_service->render_edit_tab($user_id, $tab_name);
			$this->response->body($view);
		} 
		else
		{
			$login_service = new Service_Login();
			$user_id = $login_service->get_user_in_session();

			$user_service = new Service_User();
			$user = $user_service->get_info_for_editing($user_id);

			$view = View::factory('profile/edit/profile_edit');
			$view->user = $user;
			$this->response->body($view);
		}
	}

	public function action_create()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$create_type = $this->request->param('id');
//2014-1-25 Modified by David Ming Start
			$profile_service = new Service_UserProfile();
			
			if(!$profile_service->validation_check($create_type , $this->request->post()))
			{
				//Validation error response
				$result = "<div class='alert alert-danger'>Fields in <span class='required'><b>red</b></span> are required.</div>";
				$message = "You must input required fields.";
				$view = array('status' => 'error' , 
								'result_to_display' => $result , 
								'message' => $message);
			}
			else
			{	
				//Validation success response
				$user_id = Service_Login::get_user_in_session();
				$view = $profile_service->create($create_type, $user_id, $this->request->post());
			}
			echo json_encode($view);
//2014-1-25 Modified by David Ming End				
		}
	}

	public function action_update()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$update_type = $this->request->param('id');

			$profile_service = new Service_UserProfile();
			$profile_service->update($update_type, $this->request->post());

			//TODO: return status in json format
			echo 'ok';
		}
	}
	
	public function action_delete()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$update_type = $this->request->param('id');

			$profile_service = new Service_UserProfile();
			$profile_service->delete($update_type, $this->request->post());

			//TODO: return status in json format
			echo 'ok';
		}
	}

	public function action_select()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$update_type = $this->request->param('id');

			$profile_service = new Service_UserProfile();
			$profile_service->select($update_type, $this->request->post());

			//TODO: return status in json format
			echo 'ok';
		}
	}

//2014-1-25 Created by David Ming Start
	public function action_edit_journal()
	{
		$journal_id = $this->request->post('term');
		$journal_dao = new Dao_Journal();
		$view = $journal_dao->get_journal_by_id($journal_id);
		echo json_encode($view);
	}

	public function action_delete_journal()
	{
		$journal_id = $this->request->post('term');
		$journal_dao = new Dao_Journal();
		$journal_dao->delete_journal_by_id($journal_id);
		
		$journal_service = new Service_Journal();
		$user_id = Service_Login::get_user_in_session();
		$result_to_display = $journal_service->get_journal_list($user_id , FALSE , TRUE);
		echo json_encode($result_to_display);
	}

	public function action_delete_confproc()
	{
		$confproc_id = $this->request->post('term');
		$confproc_service = new Service_ConfProc();
		$confproc_service->delete_confproc_by_id($confproc_id);
		$user_id = Service_Login::get_user_in_session();
		$result_to_display = $confproc_service->get_conference_proceeding_list($user_id , FALSE , TRUE);
		echo json_encode($result_to_display);
	}

	public function action_edit_confproc()
	{
		$confproc_id = $this->request->post('term');
		$confproc_service = new Service_ConfProc();
		$view = $confproc_service->get_confproc_by_id($confproc_id);
		echo json_encode($view);
	}

	public function action_delete_book_chapter()
	{
		$chapter_id = $this->request->post('term');
		$chapter_service = new Service_BookChapter();
		$chapter_service->delete_book_chapter_by_id($chapter_id);
		$user_id = Service_Login::get_user_in_session();
		$result_to_display = $chapter_service->get_book_chapter_list($user_id , FALSE , TRUE);
		echo json_encode($result_to_display);
	}

	public function action_edit_book_chapter()
	{
		$chapter_id = $this->request->post('term');
		$chapter_service = new Service_BookChapter();
		$view = $chapter_service->get_book_chapter_by_id($chapter_id);
		echo json_encode($view);
	}

	public function action_delete_book()
	{
		$book_id = $this->request->post('term');
		$book_service = new Service_Book();
		$book_service->delete_book_by_id($book_id);
		$user_id = Service_Login::get_user_in_session();
		$result_to_display = $book_service->get_book_list($user_id , FALSE , TRUE);
		echo json_encode($result_to_display);
	}

	public function action_edit_book()
	{
		$book_id = $this->request->post('term');
		$book_service = new Service_Book();
		$view = $book_service->get_book_by_id($book_id);
		echo json_encode($view);
	}
//2014-1-24 Created by David Ming End	
}
