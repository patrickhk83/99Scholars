<?php defined('SYSPATH') or die('No direct script access.');

class Service_ConfProc {
//2014-1-25 Created by David Ming Start
	public function get_conference_proceeding_count($user_id)
	{
		$query = "SELECT COUNT(*) AS nCount FROM conference_proceeding WHERE author='".$user_id."'";
		$results = DB::query(Database::SELECT , $query)->execute();
		return $results->get('nCount');
	}
	

	public function get_conference_proceeding_list($user_id , 
													$recent_first = FALSE , 
													$bEdit = FALSE)
	{
		$query = "SELECT users.firstname AS first_name, users.lastname AS last_name, country.name AS country_name, conference_proceeding.* ";
		$query .= "FROM users, country, conference_proceeding ";
		$query .= "WHERE conference_proceeding.author='".$user_id."' AND users.id='".$user_id."' AND conference_proceeding.conference_country=country.code ";

		if($recent_first)
			$query .= "ORDER BY conference_proceeding.publish_year DESC";

		$results = DB::query(Database::SELECT , $query)->execute();

		$format_text = "";
		if($bEdit)
			$format_text .= "<table class='table table-striped'><tbody>";
		else
			$format_text .= "<h4>Conference proceedings</h4><table class='table table-striped'><tbody>";

		foreach ($results as $result) 
		{
			$format_text .= "<tr><td>";
						
			//Print Author Name(first name and last name) 
			$format_text .= $this->get_conference_proceeding_line_from_array($result);

			$format_text .= "</td>";

			if($bEdit)
			{
				$format_text .= "<td onclick='edit_confproc(".$result['id'].");'><span class='glyphicon glyphicon-pencil'></span></td>";
                $format_text .= "<td onclick='delete_confproc(".$result['id'].");'><span class='glyphicon glyphicon-trash'></span></td>";
            }    

			$format_text .= "</tr>";

		}
		
		$format_text .= "</tbody></table>";
		return $format_text;
	}

	private function get_last_author($confproc_id)
	{
		$query = DB::select('author_name')->from('co_author')
						->where('journal', '=', $confproc_id)->and_where('author_id' , '=' , '2');


		return $query->execute();
	}

	public function get_conference_proceeding_line_from_array($result)
	{
		$format_text = "";		
		$format_text .= $result['first_name']." ".$result['last_name'];
		$format_text .= ", ";

		$user = $this->get_last_author($result['id']);

		$nCount = 0;
		foreach ($user as $val)
		{
			if($nCount > 0)
				$format_text .= ", ";	
			$format_text .= $val['author_name'];
			$nCount ++;
		}	
		$format_text .= ", (".$result['publish_year']."). ";
		$format_text .= $result['title']." In ";
		$format_text .= "<EM>".$result['conference']."</EM>, ";
		$format_text .= $result['conference_city'].", ";
		$format_text .= $result['country_name'].", pp, ";
		$format_text .= $result['start_page']."-".$result['end_page'];	
		return $format_text;
	}

	public function get_conference_proceeding_country_list()
	{
		$format_text = "<select class='form-control' id='confproc_country' name='confproc_country'>";

		$countries = ORM::factory('Country')->find_all();

		foreach($countries as $country)
		{
			$format_text .= "<option value='".$country->get('code')."'>";
			$format_text .= $country->get('name');
			$format_text .= "</option>";
		}
		$format_text .= "</select>";
		return $format_text;
	}

	public function delete_confproc_by_id($confproc_id)
	{
		$query = "DELETE FROM conference_proceeding WHERE id='".$confproc_id."'";
		$result = DB::query(Database::DELETE , $query)->execute();

		$query = "DELETE FROM co_author WHERE journal='".$confproc_id."' AND author_id='2'";
		$result = DB::query(Database::DELETE , $query)->execute();		
	}

	public function get_confproc_by_id($confproc_id)
	{
		$query = "SELECT * FROM conference_proceeding WHERE id='".$confproc_id."'";
		$results = DB::query(Database::SELECT , $query)->execute();

		$view = array();
		foreach($results as $result)
		{
			$view['confproc_id'] = $result['id'];
			$view['confproc_title'] = $result['title'];
			$view['confproc_name'] = $result['conference'];
			$view['confproc_status'] = $result['status'];
			$view['confproc_year'] = $result['publish_year'];
			$view['confproc_start'] = $result['start_page'];
			$view['confproc_end'] = $result['end_page'];
			$view['confproc_country'] = $result['conference_country'];
			$view['confproc_city'] = $result['conference_city'];
			break;
		}

		$query = "SELECT * FROM co_author WHERE journal='".$result['id']."' AND author_id='2' ORDER BY id ASC";
		$co_author_results = DB::query(Database::SELECT , $query)->execute();

		$nCount = 0;
		$authors = "";
		foreach($co_author_results as $author)
		{
			if($nCount > 0)
				$authors .= "^^^^^";
			$authors .= $author['author_name'];
			$nCount ++;
		}
		
		$view['has_coauthor'] = $authors;
		

		return $view;
	}
//2014-1-25 Created by David Ming End
}