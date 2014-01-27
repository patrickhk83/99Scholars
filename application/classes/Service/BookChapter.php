<?php defined('SYSPATH') or die('No direct script access.');

class Service_BookChapter {
//2014-1-25 Created by David Ming Start
	public function get_book_chapter_count($user_id)
	{
		$query = "SELECT COUNT(*) AS nCount FROM book_chapter WHERE author='".$user_id."'";
		$results = DB::query(Database::SELECT , $query)->execute();
		return $results->get('nCount');
	}

	public function get_book_chapter_list($user_id , $recent_first = FALSE , $bEdit = FALSE)
	{
		
		$query = "SELECT users.firstname AS first_name, users.lastname AS last_name, book_chapter.* ";
		$query .= "FROM users, book_chapter ";
		$query .= "WHERE book_chapter.author='".$user_id."' AND users.id='".$user_id."' ";

		if($recent_first)
			$query .= "ORDER BY book_chapter.publish_year DESC";

		$results = DB::query(Database::SELECT , $query)->execute();

		$format_text = "";
		if($bEdit)
			$format_text .= "<table class='table table-striped'><tbody>";
		else
			$format_text .= "<h4>Book Chapters</h4><table class='table table-striped'><tbody>";

		foreach ($results as $result) 
		{
			$format_text .= "<tr><td>";
						
			//Print Author Name(first name and last name) 
			$format_text .= $this->get_book_chapter_line_from_array($result);

			$format_text .= "</td>";

			if($bEdit)
			{
				$format_text .= "<td onclick='edit_book_chapter(".$result['id'].");'><span class='glyphicon glyphicon-pencil'></span></td>";
                $format_text .= "<td onclick='delete_book_chapter(".$result['id'].");'><span class='glyphicon glyphicon-trash'></span></td>";
            }    

			$format_text .= "</tr>";

		}

		$format_text .= "</tbody></table>";
		return $format_text;
		
	}

	private function get_last_author($book_chapter_id)
	{
		$query = DB::select('author_name')->from('co_author')
						->where('journal', '=', $book_chapter_id)->and_where('author_id' , '=' , '3');
		return $query->execute();
	}

	private function get_editors($book_chapter_id)
	{
		$query = DB::select('editor_name')->from('editor')
						->where('book_chapter_id' , '=' , $book_chapter_id);
		return $query->execute();				
	}

	public function get_book_chapter_line_from_array($result)
	{
		$format_text = "";		
		$format_text .= $result['first_name']." ".$result['last_name'];
		$format_text .= ", ";

		$user = $this->get_last_author($result['id']);
		$editors = $this->get_editors($result['id']);

		$nCount = 0;
		foreach ($user as $val)
		{
			if($nCount > 0)
				$format_text .= "& ";	
			$format_text .= $val['author_name'];
			$nCount ++;
		}

		$format_text .= ", (".$result['publish_year']."). ";
		$format_text .= $result['chapter_title']." In ";

		$nCount = 0;
		
		foreach($editors as $editor)
		{
			if($nCount > 0)
				$format_text .= "& ";
			$format_text .= $editor['editor_name'];
			$nCount ++;
		}
		$format_text .= "(Eds.) ";

		$format_text .= "<EM>".$result['book_title']."</EM>, ";
		$format_text .= $result['publisher_city'].": ";
		$format_text .= $result['publisher_name']."; ";
		$format_text .= $result['start_page']."-".$result['end_page'];	
		return $format_text;
	}

	public function delete_book_chapter_by_id($chapter_id)
	{
		$query = "DELETE FROM book_chapter WHERE id='".$chapter_id."'";
		$result = DB::query(Database::DELETE , $query)->execute();

		$query = "DELETE FROM co_author WHERE journal='".$chapter_id."' AND author_id='3'";
		$result = DB::query(Database::DELETE , $query)->execute();

		$query = "DELETE FROM editor WHERE book_chapter_id='".$chapter_id."'";
		$result = DB::query(Database::DELETE , $query)->execute();		

	}

	public function get_book_chapter_by_id($chapter_id)
	{
		$query = "SELECT * FROM book_chapter WHERE id='".$chapter_id."'";
		$results = DB::query(Database::SELECT , $query)->execute();

		$view = array();
		foreach($results as $result)
		{
			$view['chapter_id'] = $result['id'];
			$view['chapter_title'] = $result['chapter_title'];
			$view['chapter_year'] = $result['publish_year'];
			$view['chapter_start'] = $result['start_page'];
			$view['chapter_end'] = $result['end_page'];
			$view['chapter_book_name'] = $result['book_title'];
			$view['chapter_publisher_city'] = $result['publisher_city'];
			$view['chapter_publisher'] = $result['publisher_name'];

			break;
		}

		$query = "SELECT * FROM co_author WHERE journal='".$result['id']."' AND author_id='3' ORDER BY id ASC";
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
		
		$query = "SELECT * FROM editor WHERE book_chapter_id='".$result['id']."'";
		$editor_results = DB::query(Database::SELECT , $query)->execute();
		foreach($editor_results as $editor_result)
		{
			$view['chapter_editor'] = $editor_result['editor_name'];
		}

		return $view;
	}	
//2014-1-25 Created by David Ming End
}