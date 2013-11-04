<?php defined('SYSPATH') or die('No direct script access.');

class Util_Journal {

	public static function format($author_firstname, $author_lastname, $year, $title, $journal, $volume, $issue, $start, $end)
	{
		$text = '';

		$text .= $author_lastname.', '.substr($author_firstname, 0, 1).'. ';

		if(isset($year) && $year > 0)
		{
			$text .= '('.$year.'). ';
		}

		$text .= $title.'. ';

		if(isset($journal) && trim($journal) !== '')
		{
			$text .= '<em>'.$journal.'</em>, ';
		}

		if(isset($volume) && $volume > 0)
		{
			$text .= $volume.', ';
		}

		if(isset($issue) && $issue > 0)
		{
			$text .= $issue.', ';
		}

		if(isset($start) && isset($end) && $start > 0 && $end > 0)
		{
			$text .= $start.'-'.$end.'.';
		}

		return $text;
	}
}