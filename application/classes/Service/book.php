<?php defined('SYSPATH') or die('No direct script access.');

class Service_Book {
//2014-1-26 Modified by David Ming Start
	public function get_book_count($user_id)
	{
		$query = "SELECT COUNT(*) AS nCount FROM book WHERE author='".$user_id."'";
		$results = DB::query(Database::SELECT , $query)->execute();
		return $results->get('nCount');
	}

	public function get_book_list($user_id , $recent_first = FALSE , $bEdit = FALSE)
	{
		$query = "SELECT users.firstname AS first_name, users.lastname AS last_name, book.* ";
		$query .= "FROM users, book ";
		$query .= "WHERE book.author='".$user_id."' AND users.id='".$user_id."' ";

		if($recent_first)
			$query .= "ORDER BY book.publish_year DESC";

		$results = DB::query(Database::SELECT , $query)->execute();

		$format_text = "";
		if($bEdit)
			$format_text .= "<table class='table table-striped'><tbody>";
		else
			$format_text .= "<h4>Books</h4><table class='table table-striped'><tbody>";

		foreach ($results as $result) 
		{
			$format_text .= "<tr><td>";
						
			//Print Author Name(first name and last name) 
			$format_text .= $this->get_book_line_from_array($result);

			$format_text .= "</td>";

			if($bEdit)
			{
				$format_text .= "<td onclick='edit_book(".$result['id'].");'><span class='glyphicon glyphicon-pencil'></span></td>";
                $format_text .= "<td onclick='delete_book(".$result['id'].");'><span class='glyphicon glyphicon-trash'></span></td>";
            }    

			$format_text .= "</tr>";

		}

		$format_text .= "</tbody></table>";
		return $format_text;
	}	

	private function get_last_author($book_chapter_id)
	{
		$query = DB::select('author_name')->from('co_author')
						->where('journal', '=', $book_chapter_id)->and_where('author_id' , '=' , '4');
		return $query->execute();
	}

	public function get_book_line_from_array($result)
	{
		$format_text = "";		
		$format_text .= $result['first_name']." ".$result['last_name'];
		$format_text .= ", ";

		$user = $this->get_last_author($result['id']);

		$nCount = 0;
		foreach ($user as $val)
		{
			if($nCount > 0)
				$format_text .= "& ";	
			$format_text .= $val['author_name'];
			$nCount ++;
		}		
		$format_text .= ", (".$result['publish_year']."). ";
		$format_text .= "<EM>".$result['book_title']."</EM>, ";

		$format_text .= $result['publisher_city'].": ";
		$format_text .= $result['publisher_name']."; ";

		return $format_text;
	}	

	public function delete_book_by_id($book_id)
	{
		$query = "DELETE FROM book WHERE id='".$book_id."'";
		$result = DB::query(Database::DELETE , $query)->execute();

		$query = "DELETE FROM co_author WHERE journal='".$book_id."' AND author_id='4'";
		$result = DB::query(Database::DELETE , $query)->execute();
	}

	public function get_book_by_id($book_id)
	{
		$query = "SELECT * FROM book WHERE id='".$book_id."'";
		$results = DB::query(Database::SELECT , $query)->execute();

		$view = array();
		foreach($results as $result)
		{
			$view['book_id'] = $result['id'];
			$view['book_title'] = $result['book_title'];
			$view['book_year'] = $result['publish_year'];
			$view['book_publisher_city'] = $result['publisher_city'];
			$view['book_publisher'] = $result['publisher_name'];

			break;
		}

		$query = "SELECT * FROM co_author WHERE journal='".$result['id']."' AND author_id='4' ORDER BY id ASC";
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
//2014-1-26 Modified by David Ming End		
}