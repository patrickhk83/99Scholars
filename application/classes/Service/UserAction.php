<?php defined('SYSPATH') or die('No direct script access.');

class Service_UserAction {
	public function register_user_action($controller , 
											$string1 = null , 
											$string2 = null , 
											$number1 = 0 , 
											$number2 = 0
										)
	{
		$controller_name = $controller->request->controller();
		if(is_null($string1) || $string1 == '')
			$action_name = $controller->request->action();
		else
			$action_name = $string1;
		
		$activity = ORM::factory('Activity')->where_open()
			->where('action_type' , '=' , $controller_name)
			->and_where('component_type' , '=' , $action_name)
			->where_close()
			->find();
		
		if(is_null($activity->action_type) || $activity->action_type == '')
		{
			$new_activity = ORM::factory('Activity');
			$new_activity->action_type = $controller_name;
			$new_activity->component_type = $action_name;
			$new_activity->save();
			$action_id = $new_activity->id;
		}
		else
		{
			$action_id = $activity->id;
		}

		$users_actions = ORM::factory('UserAction');
		$current_user_id = Service_Login::get_user_in_session();		
		$current_time = date("H:i:s d/m/Y" , time());
		$ip_addr = $this->getRealIpAddr();

		if(!is_null($current_user_id))
			$users_actions->user_id = $current_user_id;
		else 
			$users_actions->user_id = -1;


		$users_actions->action_id = $action_id;
		$users_actions->action_time = $current_time;
		$users_actions->ip_addr = $ip_addr;
		$users_actions->string1 = $string1;
		$users_actions->string2 = $string2;
		$users_actions->number1 = $number1;
		$users_actions->number2 = $number2;

		$users_actions->save();
	}

	public function get_actions()
	{
		return ORM::factory('Activity')->find_all();
	}

	public function get_guests_actions($bCounter , $page_num , $per_page , $action_filter , $start_date)
	{
		$offset = ($page_num - 1) * $per_page;
		$from_table_str = "FROM users_actions, activities ";
		if(strcmp($action_filter , "All") != 0)
			$action_filter_query = "activities.action_type='".$action_filter."'";
		else
			$action_filter_query = '';
		if(strcmp($start_date , '1234567890') != 0)
		{
			$start_date_str = $start_date;
			$start_date_str = str_replace("-", "/" , $start_date_str);
			$start_date_query = "users_actions.action_time LIKE '%".$start_date_str."%'";
		}
		else
			$start_date_query = "";
		$order_by_query = "ORDER BY users_actions.id DESC LIMIT ".$offset.", ".$per_page;

		if($bCounter)
		{
			$query_str = "SELECT COUNT(*) AS nCount ";
		}
		else
		{
			$query_str = "SELECT users_actions.*, activities.component_type as component_type ";
		}	
		$query_str .= $from_table_str;
		$query_str .= "WHERE ";
		$query_str .= "users_actions.user_id='-1' AND ";
		$query_str .= "users_actions.action_id=activities.id";
		if($action_filter_query != "") $query_str .= " AND ".$action_filter_query;
		//if($user_filter_query != "") $query_str .= " AND ".$user_filter_query;
		if($start_date_query != "") $query_str .= " AND ".$start_date_query;

		if(!$bCounter) $query_str .= " ".$order_by_query;

		//return $query_str;
		$result = DB::query(Database::SELECT , $query_str)->execute();
		return $result;
	}

	public function get_users_actions($bCounter , $page_num , $per_page , $action_filter , $user_filter , $start_date)
	{
		$offset = ($page_num - 1) * $per_page;
		$from_table_str = "FROM users_actions, user, activities ";

		if(strcmp($action_filter , "All") != 0)
			$action_filter_query = "activities.action_type='".$action_filter."'";
		else
			$action_filter_query = '';

		if(strcmp($user_filter , "1234567890") != 0)
		{
			$user_filter_name = explode(" " , $user_filter);
			if(!isset($user_filter_name[1]))
			{
				$user_filter_query = "user.email LIKE '%".$user_filter_name[0]."%'";
			}
			else
				$user_filter_query = "user.firstname='".$user_filter_name[0]."' AND user.lastname='".$user_filter_name[1]."'";
		}
		else
			$user_filter_query = "";

		if(strcmp($start_date , '1234567890') != 0)
		{
			$start_date_str = $start_date;
			$start_date_str = str_replace("-", "/" , $start_date_str);
			$start_date_query = "users_actions.action_time LIKE '%".$start_date_str."%'";
		}
		else
			$start_date_query = "";

		$order_by_query = "ORDER BY users_actions.id DESC LIMIT ".$offset.", ".$per_page;

		if($bCounter)
		{
			$query_str = "SELECT COUNT(*) AS nCount ";
		}
		else
		{
			$query_str = "SELECT users_actions.*, user.firstname as firstname, user.lastname as lastname, user.email as email, activities.component_type as component_type ";
		}	

		$query_str .= $from_table_str;
		$query_str .= "WHERE ";
		$query_str .= "users_actions.user_id=user.id AND ";
		$query_str .= "users_actions.action_id=activities.id";
		if($action_filter_query != "") $query_str .= " AND ".$action_filter_query;
		if($user_filter_query != "") $query_str .= " AND ".$user_filter_query;
		if($start_date_query != "") $query_str .= " AND ".$start_date_query;

		if(!$bCounter) $query_str .= " ".$order_by_query;

		//return $query_str;
		$result = DB::query(Database::SELECT , $query_str)->execute();
		return $result;
	}


	public function custom_bootstrap_pagination(
												$action_name,
												$page_num , 
												$per_page , 
												$total_record_count,
												$action_filter,
												$user_filter,
												$start_date
											)
	{
		if($total_record_count % $per_page == 0) $nLoop = $total_record_count / $per_page;
		else $nLoop = floor($total_record_count / $per_page) + 1;

		if($page_num > $nLoop) return false;

		$result = "<ul class='pagination pagination-lg'>";
		if($page_num < 1) return false;

// Set Previous Button		
		if($page_num == 1)
			$result .= "<li class='disabled'><span>Prev</span></li>";
		else
		{
			$prev_page_num = $page_num - 1;
			//$prev_url = Route::get('actionstatistics')->uri(array('page_num' => $prev_page_num , 'per_page' => $per_page , 'action' => 'index'));
			$prev_url = URL::site('actionstatistics/'.$action_name.'/'.$prev_page_num."/".$per_page."/".$action_filter."/".$user_filter."/".$start_date);
			$result .= "<li><a href='".$prev_url."'>Prev</a></li>";
		}

//Set Page Number Buttons
		if($nLoop < 5)
		{
			$start_page_num = 1;
			$end_page_num = $nLoop;
		}
		else
		{
			$nEndLoop = $nLoop - 2;
			if($page_num < 3)
			{
				$start_page_num = 1;
				$end_page_num = 5;
			}
			else if($page_num > $nEndLoop)
			{
				$start_page_num = $nLoop - 4;
				$end_page_num = $nLoop;
			}
			else
			{
				$start_page_num = $page_num - 2;
				$end_page_num = $page_num + 2;
			}
		}

		for($nCount = $start_page_num ; $nCount < $end_page_num + 1 ; $nCount ++)
		{
			//$page_url = Route::get('actionstatistics')->uri(array('page_num' => $nCount , 'per_page' => $per_page , 'action' => 'index'));
			$page_url = URL::site('actionstatistics/'.$action_name.'/'.$nCount."/".$per_page."/".$action_filter."/".$user_filter."/".$start_date);
			if($nCount == $page_num)
				$result .= "<li class='active'><a href='".$page_url."'>".$nCount."</a></li>";
			else
				$result .= "<li><a href='".$page_url."'>".$nCount."</a></li>";
		}

//Set Next Button
		if($page_num == $nLoop)
			$result .= "<li class='disabled'><span>Next</span></li>";
		else
		{
			$next_page_num = $page_num + 1;
			//$next_url = Route::get('actionstatistics')->uri(array('page_num' => $next_page_num , 'per_page' => $per_page , 'action' => 'index'));
			$next_url = URL::site('actionstatistics/'.$action_name.'/'.$next_page_num."/".$per_page."/".$action_filter."/".$user_filter."/".$start_date);
			$result .= "<li><a href='".$next_url."'>Next</a></li>";
		}

		$result .= "</ul>";
		
		return $result;
	}

	public function suggest_user_list($term)
	{
		
		//if(!isset($user_filter_name[1]))
		$user_emails = ORM::factory('User');
		//$user_emails->where('email' , 'LIKE' , '%$term%')->find_all();
		$user_emails->where_open()->and_where('firstname' , 'LIKE' , '%'.$term.'%')
		->or_where('lastname' , 'LIKE' , '%'.$term.'%')->where_close();
		$limit = 20;
		$offset = 0;
		return $user_emails->find_all($limit , $offset);	
	}

	private function getRealIpAddr()
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip_address = $_SERVER['REMOTE_ADDR'];
		}
		return $ip_address;
	}


}