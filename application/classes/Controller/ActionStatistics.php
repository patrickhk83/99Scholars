<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ActionStatistics extends Controller {
	public function action_index()
	{
		$view = View::factory('statistics/default');
		$view->bodies = "users";

		$page_num = $this->request->param('page_num');
		$per_page = $this->request->param('per_page');
		$action_filter = $this->request->param('action_filter');
		$user_filter = $this->request->param('user_filter');
		$start_date = $this->request->param('start_date');
		

		if($page_num == '' || is_null($page_num)) $page_num = 1;
		if($per_page == '' || is_null($per_page)) $per_page = 10;
		if($action_filter == '' || is_null($action_filter)) $action_filter = "All";
		if($user_filter == '' || is_null($user_filter)) $user_filter = "1234567890"; 
		if($start_date == '' || is_null($start_date)) $start_date = "1234567890"; 
		

		$view->page_num = $page_num;
		$view->per_page = $per_page;
		$view->action_filter = $action_filter;
		if(strcmp($user_filter , '1234567890') == 0) $view->user_filter = '';
		else $view->user_filter = $user_filter;
		if(strcmp($start_date , '1234567890') == 0) $view->start_date = '';
		else $view->start_date = $start_date;


		$users_actions = new Service_UserAction();
		$actions = $users_actions->get_actions();

		$str_options = "";

		foreach($actions as $act)
		{
			$str_options .= "<option value='".$act->action_type."' ";
			if(strcmp($act->action_type , $action_filter) == 0)
				$str_options .= "selected='true'";
			$str_options .= ">".$act->action_type."</option>";
		}

		$total_record = $users_actions->get_users_actions(true , $page_num , $per_page , $action_filter , $user_filter , $start_date);
		
		
		$pagination_link = $users_actions->custom_bootstrap_pagination(
																		"index",		
																		$page_num , 
																		$per_page , 
																		$total_record->get('nCount') , 
																		$action_filter , 
																		$user_filter,
																		$start_date
																	);
		$view->link = $pagination_link;

		$users_actions_records = $users_actions->get_users_actions(false , $page_num , $per_page , $action_filter , $user_filter , $start_date);
		$str_table = "";
		$nCount = ($page_num - 1) * $per_page;
		foreach($users_actions_records as $record)
		{
			$nCount ++;
			$str_table .= "<tr><td>".$record['user_id']."</td><td>".$record['ip_addr']."</td><td>";
			$str_table .= $record['firstname']." ".$record['lastname']."</td><td>";
			$str_table .= $record['email']."</td><td>";
			$str_table .= $record['string1']."</td><td>";
			$str_table .= $record['action_time']."</td></tr>";

		}
		$view->str_options = $str_options;
		$view->str_table = $str_table;

		$this->response->body($view);
	}

	public function action_guests()
	{
		$view = View::factory('statistics/default');
		$view->bodies = "guests";

		$page_num = $this->request->param('page_num');
		$per_page = $this->request->param('per_page');
		$action_filter = $this->request->param('action_filter');
		$user_filter = $this->request->param('user_filter');
		$start_date = $this->request->param('start_date');
		

		if($page_num == '' || is_null($page_num)) $page_num = 1;
		if($per_page == '' || is_null($per_page)) $per_page = 10;
		if($action_filter == '' || is_null($action_filter)) $action_filter = "All";
		if($user_filter == '' || is_null($user_filter)) $user_filter = "Guest"; 
		if($start_date == '' || is_null($start_date)) $start_date = "1234567890"; 
		

		$view->page_num = $page_num;
		$view->per_page = $per_page;
		$view->action_filter = $action_filter;
		if(strcmp($start_date , '1234567890') == 0) $view->start_date = '';
		else $view->start_date = $start_date;


		$users_actions = new Service_UserAction();
		$actions = $users_actions->get_actions();

		$str_options = "";

		foreach($actions as $act)
		{
			$str_options .= "<option value='".$act->action_type."' ";
			if(strcmp($act->action_type , $action_filter) == 0)
				$str_options .= "selected='true'";
			$str_options .= ">".$act->action_type."</option>";
		}
		$view->str_options = $str_options;
		$total_record = $users_actions->get_guests_actions(true , $page_num , $per_page , $action_filter , $start_date);
	
		
		
		$pagination_link = $users_actions->custom_bootstrap_pagination(
																		"guests",
																		$page_num , 
																		$per_page , 
																		$total_record->get('nCount') , 
																		$action_filter , 
																		$user_filter,
																		$start_date
																	);


		$view->link = $pagination_link;
		$users_actions_records = $users_actions->get_guests_actions(false , $page_num , $per_page , $action_filter , $start_date);
		$str_table = "";
		$nCount = ($page_num - 1) * $per_page;

		foreach($users_actions_records as $record)
		{
			$nCount ++;
			$str_table .= "<tr><td>".$nCount."</td><td>".$record['ip_addr']."</td><td>Guest</td><td>";
			$str_table .= $record['string1']."</td><td>";
			$str_table .= $record['action_time']."</td></tr>";

		}

		$view->str_table = $str_table;
		$this->response->body($view);	
		
	}

	public function action_suggest_user()
	{
		$users_actions = new Service_UserAction();
		$suggests = $users_actions->suggest_user_list($this->request->post('term'));
		$suggested_list = array();
		foreach ($suggests as $suggest) {
			$suggested_list[] = $suggest->get('firstname')." ".$suggest->get('lastname');	
		}
		echo json_encode($suggested_list);
	}


}