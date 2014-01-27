<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Journal {
	public function get_last_author($journal_id)
	{
		$query = DB::select('author_name')->from('co_author')
						->where('journal', '=', $journal_id)->and_where('author_id' , '=' , '1');


		return $query->execute();
	}
	
	public function get_journal_by_id($journal_id)
	{
		$query = "SELECT * FROM journal WHERE id='".$journal_id."'";
		$results = DB::query(Database::SELECT , $query)->execute();

		$view = array();
		foreach($results as $result)
		{
			$view['journal_id'] = $result['id'];
			$view['title'] = $result['title'];
			$view['journal'] = $result['journal'];
			$view['status'] = $result['status'];
			$view['year'] = $result['publish_year'];
			$view['volume'] = $result['volume'];
			$view['issue'] = $result['issue'];
			$view['start'] = $result['start_page'];
			$view['end'] = $result['end_page'];
			$view['link'] = $result['link'];
			break;
		}

		$query = "SELECT * FROM co_author WHERE journal='".$result['id']."' ORDER BY id ASC";
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

	public function delete_journal_by_id($journal_id)
	{
		
		$query = "DELETE FROM journal WHERE id='".$journal_id."'";
		$result = DB::query(Database::DELETE , $query)->execute();

		$query = "DELETE FROM co_author WHERE journal='".$journal_id."' AND author_id='1'";
		$result = DB::query(Database::DELETE , $query)->execute();		

	}
}