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

	//inpput must be UNIX time
	public static function time_elapsed($tm,$rcs = 0) {
    $cur_tm = time(); 
    $dif = $cur_tm-$tm;
    $pds = array('second','minute','hour','day','week','month','year','decade');
    $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);

    for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);
        $no = floor($no);
        if($no <> 1)
            $pds[$v] .='s';
        $x = sprintf("%d %s ",$no,$pds[$v]);
        if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0))
            $x .= time_ago($_tm);
        return $x;
    }
}