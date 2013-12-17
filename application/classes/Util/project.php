<?php defined('SYSPATH') or die('No direct script access.');

class Util_project {

	public static function formatnew($author_firstname, $author_lastname, $year, $title, $project_name, $status, $start, $end, $id)
	{
		$text = array();
		
		$text['last_name'] = $author_lastname;
		$text['first_name'] = $author_firstname;
		$text['title'] = $title;
		$text['year'] = $year;
		$text['project_name'] = $project_name;
		$text['status'] = $status;
		$text['start'] = $start;
		$text['end'] = $end;
		$text['id'] = $id;
		
		return $text;
	}
}