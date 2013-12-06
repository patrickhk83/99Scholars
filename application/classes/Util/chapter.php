<?php defined('SYSPATH') or die('No direct script access.');

class Util_chapter {

	public static function formatnew($author_firstname, $author_lastname, $year, $title, $book_chapter, $status, $start, $end, $id)
	{
		$text = array();
		
		$text['last_name'] = $author_lastname;
		$text['first_name'] = $author_firstname;
		$text['title'] = $title;
		$text['year'] = $year;
		$text['book_chapter'] = $book_chapter;
		$text['status'] = $status;
		$text['start'] = $start;
		$text['end'] = $end;
		$text['id'] = $id;
		
		return $text;
	}
}