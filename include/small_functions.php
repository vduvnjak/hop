<?php

function HandleMySqlErrorFatally($message)
{
    if (mysql_errno() != 0)
    {
        print $message . mysql_error();
        db_rollback();
        exit;
    }
}

function make_time($dbtime)
{
        // mySQL timestamp -> PHP timestamp

        $yr = substr($dbtime,0,4);
        $mon = substr($dbtime,5,2);
        $day = substr($dbtime,8,2);
        $hr = substr($dbtime,11,2);
        $min = substr($dbtime,14,2);
        $sec = substr($dbtime,17,2);

        return mktime($hr,$min,$sec,$mon,$day,$yr);
}

function format_eu_date($dbtime)
{
        //  mySQL timestamp     dd.mm.yy hr:min:sec

        $yr = substr($dbtime,0,4);
        $mon = substr($dbtime,5,2);
        $day = substr($dbtime,8,2);
        $hr = substr($dbtime,11,2);
        $min = substr($dbtime,14,2);
        $sec = substr($dbtime,17,2);

        $datum =  "$day.$mon.$yr $hr:$min:$sec";
        return $datum;
}
function format_us_date($dbtime)
{
        //  mySQL timestampa      mm.dd.yy 

        $yr = substr($dbtime,0,4);
        $mon = substr($dbtime,5,2);
        $day = substr($dbtime,8,2);
		
		if (($yr=="") || ($yr=="0000"))  $datum ="";
		else $datum =  "$mon/$day/$yr";
        return $datum;
}

function format_usa_date($dbtime)
{
    // mySQL timestamp ->   mm.dd.yy hr:min:sec
    
    $yr = substr($dbtime,0,4);
    $mon = substr($dbtime,5,2);
    $day = substr($dbtime,8,2);
    $hr = substr($dbtime,11,2);
    $min = substr($dbtime,14,2);
    $sec = substr($dbtime,17,2);
	
	if (($yr=="") || ($yr=="0000"))  $datum ="";
    else $datum =  "$mon/$day/$yr $hr:$min";
    return $datum;
}

function isValidEmail($email)
{
return ereg("^[a-zA-Z._0-9\-]+@{1}[a-zA-Z._0-9\-]+\.{1}[a-z]{2,3}$", $email);
}


function isValidJustNumbers($entry)
{
return ereg("^[0-9]+$", $entry);
}

function isValidJustLetters($entry)
{
return ereg("^[a-zA-Z]+[[:space:]]?[a-zA-Z]+$", $entry);
}

function isValidPassword($password)
{
	if(ereg("[0-9]+", $password)) return ereg(".{8,15}", $password);
	else return 0;

}


function find_name_from_table ($return_var, $db_table, $var_id, $active_var)
{
        $find_sec_query = db_query ("SELECT $return_var FROM $db_table WHERE $var_id = $active_var");
        $res = db_result ($find_sec_query,0,0);
        return ($res);

}


function my_money_format($format, $number) 
{ 
    $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'. 
              '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/'; 
    if (setlocale(LC_MONETARY, 0) == 'C') { 
        setlocale(LC_MONETARY, ''); 
    } 
    $locale = localeconv(); 
    preg_match_all($regex, $format, $matches, PREG_SET_ORDER); 
    foreach ($matches as $fmatch) { 
        $value = floatval($number); 
        $flags = array( 
            'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ? 
                           $match[1] : ' ', 
            'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0, 
            'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ? 
                           $match[0] : '+', 
            'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0, 
            'isleft'    => preg_match('/\-/', $fmatch[1]) > 0 
        ); 
        $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0; 
        $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0; 
        $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits']; 
        $conversion = $fmatch[5]; 

        $positive = true; 
        if ($value < 0) { 
            $positive = false; 
            $value  *= -1; 
        } 
        $letter = $positive ? 'p' : 'n'; 

        $prefix = $suffix = $cprefix = $csuffix = $signal = ''; 

        $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign']; 
        switch (true) { 
            case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+': 
                $prefix = $signal; 
                break; 
            case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+': 
                $suffix = $signal; 
                break; 
            case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+': 
                $cprefix = $signal; 
                break; 
            case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+': 
                $csuffix = $signal; 
                break; 
            case $flags['usesignal'] == '(': 
            case $locale["{$letter}_sign_posn"] == 0: 
                $prefix = '('; 
                $suffix = ')'; 
                break; 
        } 
        if (!$flags['nosimbol']) { 
            $currency = $cprefix . 
                        ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) . 
                        $csuffix; 
        } else { 
            $currency = ''; 
        } 
        $space  = $locale["{$letter}_sep_by_space"] ? '' : ' '; 

        $value = number_format($value, $right, $locale['mon_decimal_point'], 
                 $flags['nogroup'] ? '' : $locale['mon_thousands_sep']); 
        $value = @explode($locale['mon_decimal_point'], $value); 

        $n = strlen($prefix) + strlen($currency) + strlen($value[0]); 
        if ($left > 0 && $left > $n) { 
            $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0]; 
        } 
        $value = implode($locale['mon_decimal_point'], $value); 
        if ($locale["{$letter}_cs_precedes"]) { 
            $value = $prefix . $currency . $space . $value . $suffix; 
        } else { 
            $value = $prefix . $value . $space . $currency . $suffix; 
        } 
        if ($width > 0) { 
            $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ? 
                     STR_PAD_RIGHT : STR_PAD_LEFT); 
        } 

        $format = str_replace($fmatch[0], $value, $format); 
    } 
    return $format; 
} 


function dateDiff($startDate, $endDate)
{
		// Parse dates for conversion
		$startArry = date_parse($startDate);
		$endArry = date_parse($endDate);
		
		// Convert dates to Julian Days
		$start_date = gregoriantojd($startArry["month"], $startArry["day"], $startArry["year"]);
		$end_date = gregoriantojd($endArry["month"], $endArry["day"], $endArry["year"]);
		
		// Return difference
		return round(($end_date - $start_date), 0);
} 


function get_day_of_week ($y,$m,$d)
{
	if ($m >= "3")
	{
		$mn = $m - 2;
	}
	else
	{
		$mn = $m + 10;
	}

	if ($mn >= "11")
	{
		$yn = $y - 1;
	}
	else
	{
		$yn = $y;
	}

	$rem = $d;
	$rem =  floor((13*$mn-1)/5) + $rem;
	$rem = $rem + $yn;
	$rem = floor($yn/4) + $rem;
	$rem = $rem  - 35;
	$rem = $rem % 7;

	if ($rem < 0)
	{
		$rem = $rem + 7;
	}

	return $rem;
}

function get_date_today()
{
	// format yyyy-mm-dd
	$today = getdate(time());
	$today_day = $today["mday"];
	$today_month = $today["mon"];
	$today_year = $today["year"];
	$today_date ="$today_year-$today_month-$today_day";
	return $today_date;
}

function relativeTime($time)
{
   
	// this function will calculate a friendly date difference string
	// based upon $time and how it compares to the current time
	// for example it will return "1 minute ago" if the difference
	// in seconds is between 60 and 120 seconds
	// $time is a GM-based Unix timestamp, this makes for a timezone
	// neutral comparison
	
	 define(MINUTE, 60);
	 define(HOUR, 60*60);
	 define(DAY, 60*60*24);
	 define(MONTH, 60*60*24*30); 
  
	$delta = strtotime(gmdate("Y-m-d H:i:s", time())) - $time;
	
	$delta = $delta - 28800;
     
	if ($delta < 1 * MINUTE)
	{
		return $delta == 1 ? "one second ago" : $delta . " seconds ago";
	}

	if ($delta < 2 * MINUTE)
	{
       return "a minute ago";
	}

	if ($delta < 45 * MINUTE)
	{
		return floor($delta / MINUTE) . " minutes ago";
	}
	
	if ($delta < 90 * MINUTE)
	{
		return "an hour ago";
	}
	
	if ($delta < 24 * HOUR)
	{
		return floor($delta / HOUR) . " hours ago";
	}
	
	if ($delta < 48 * HOUR)
	{
		return "yesterday";
	}
	
	if ($delta < 30 * DAY)
	{
		return floor($delta / DAY) . " days ago";
	}
	
	if ($delta < 12 * MONTH)
	{
		$months = floor($delta / DAY / 30);
		return $months <= 1 ? "one month ago" : $months . " months ago";
	}
	
	else
	{
		$years = floor($delta / DAY / 365);
		return $years <= 1 ? "one year ago" : $years . " years ago";
	}

 }

function record_activity($userId,$activity)
{
		
	$timestamp = date("Y-m-d H:i:s");

	$insert_activity_query = db_query (" INSERT INTO activity_log
	(userId, timestamp, activity)
	VALUES
	($userId, '$timestamp', '$activity')
	");
	db_free_result($insert_activity_query);
		
}

function check_active($userId)
{
	$check_active_query = db_query (" SELECT active FROM users WHERE userID =$userId ");
   	$act = db_result ($check_active_query,0,0);
   	return $act;
}

function check_if_user_exists($userId, $dbtable)
{
	$check_query = db_query (" SELECT userId FROM $dbtable WHERE userId =$userId ");
   	$result = db_result ($check_query,0,0);
   	return $result;
}

 function escape($str) 
 {
    $str = get_magic_quotes_gpc()?stripslashes($str):$str;
    $str = mysql_real_escape_string($str, $this->dbConn);
    return $str;
}
  
function randomPass($length=10, $chrs = '1234567890qwertyuiopasdfghjklzxcvbnm')
{
    for($i = 0; $i < $length; $i++) 
    {
        $pwd .= $chrs{mt_rand(0, strlen($chrs)-1)};
    }
    return $pwd;
}

function clean_colons($str)
{
  $search=array(",",";");
  $replace=array(" "," ");
  return str_replace($search,$replace,$str);
}
