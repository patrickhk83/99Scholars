<?php defined('SYSPATH') or die('No direct script access.');

class Util_Date {

	public static function convert_date($input)
	{
		$date = date_parse_from_format("d/m/Y", $input);
		return $date['year']."-".$date['month']."-".$date['day'];
	}

	public static function convert_date_to_display($input)
	{
		$date = date_parse($input);
		return $date['day']."/".$date['month']."/".$date['year'];
	}

	public static function to_readable_date($input)
	{
		$date = date_parse($input);
		return date('j F Y', mktime(0, 0, 0, $date['month'], $date['day'], $date['year']));
	}
}