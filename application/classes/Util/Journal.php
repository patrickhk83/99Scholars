<?php defined('SYSPATH') or die('No direct script access.');

class Util_Journal {

	public static function format($author_first,$user_first,$user_second,$year, $title, $journal, $volume, $issue, $start, $end)
	{
		$text = '';
		
		$text .= $user_second.', '.substr($user_first, 0, 1).'. ';
		
		$author_names = explode("^^^^",$author_first);
		$counter = count(array_filter($author_names));
		for($i=0;$i<=$counter;$i++)
		{
			if(!empty($author_names[$i])){
				$namebreak = explode(" ",$author_names[$i]);
				$counter = count($namebreak);
				$count = $counter-1;
				for($j=$counter;$j-->0;)
				{
					if($j == $count){
						$text .= $namebreak[$j].', ';
					}
				}
				$namebreak1 = explode(" ",$author_names[$i]);
				for($k=0;$k<$counter;$k++)
				{
					if($k!=$counter-1 && $counter>1){
						$text .= substr($namebreak[$k], 0, 1).'. ';
					}
				}
				if($counter>1){
					$text .= ', ';
				}
			}
		}
		    
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
			if($end > $start){
				$text .= $start.'-'.$end.'.';
			}
			elseif($end < $start){
				$text .= $end.'-'.$start.'.';
			}else {
				$text .= $end.'. ';
			}
			
			//$text .= $start.'-'.$end.'.';
		}

		return $text;
	}
}