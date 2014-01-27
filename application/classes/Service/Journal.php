<?php defined('SYSPATH') or die('No direct script access.');

class Service_Journal {
//2014-1-24 Modified by David Ming Start
	public function get_journal_list($user_id , $recent_first = FALSE , $bEdit = FALSE)
	{
		
		$query = "SELECT users.firstname AS first_name, users.lastname AS last_name, journal.* ";
		$query .= "FROM users, journal ";
		$query .= "WHERE journal.author='".$user_id."' AND users.id='".$user_id."' ";

		if($recent_first)
			$query .= "ORDER BY journal.publish_year DESC";

		$results = DB::query(Database::SELECT , $query)->execute();
		
		$format_text = "";
		if($bEdit)
			$format_text .= "<table class='table table-striped'><tbody>";
		else
			$format_text .= "<h4>Journals</h4><table class='table table-striped'><tbody>";

		foreach ($results as $result) 
		{
			
			$format_text .= "<tr><td>";
						
			//Print Author Name(first name and last name) 
			$format_text .= $this->get_journal_line_from_array($result);

			$format_text .= "</td>";

			if($bEdit)
			{
				$format_text .= "<td onclick='edit_journal(".$result['id'].");'><span class='glyphicon glyphicon-pencil'></span></td>";
                $format_text .= "<td onclick='delete_journal(".$result['id'].");'><span class='glyphicon glyphicon-trash'></span></td>";
            }    

			$format_text .= "</tr>";

		}

		$format_text .= "</tbody></table>";
		return $format_text;
	
	}

	public function get_journal_count($user_id)
	{
		$query = "SELECT COUNT(*) AS nCount FROM journal WHERE author='".$user_id."'";
		$results = DB::query(Database::SELECT , $query)->execute();
		return $results->get('nCount');
	}

	public function get_journal_by_id($journal_id)
	{
		$query = "SELECT users.firstname AS first_name, users.lastname AS last_name, journal.* ";
		$query .= "FROM users, journal ";
		$query .= "WHERE journal.id='".$journal_id."' AND users.id=journal.author";

		$results = DB::query(Database::SELECT , $query)->execute();
		
		foreach($results as $result)
		{
			//Print Author Name(first name and last name) 
			$format_text = $this->get_journal_line_from_array($result);
			break;
		}
		return $format_text;
	}

	public function get_journal_line_from_array($result)
	{
		$format_text = "";		
		$format_text .= $result['first_name']." ".$result['last_name'];
		$format_text .= ", ";

		$username = new Dao_Journal();
		$user = $username->get_last_author($result['id']);
		
		//Print Co-Author Name
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
		$format_text .= "<EM>".$result['journal']."</EM>, ";
		$format_text .= $result['volume'].", ";
		$format_text .= $result['issue'].", ";
		$format_text .= $result['start_page']."-".$result['end_page'];	
		return $format_text;
	}

//2014-1-24 Modified by David Ming End	
}