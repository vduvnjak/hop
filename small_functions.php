<?php

function date_select ($day, $month, $year, $hour, $min, $name, $first_year=2006, $last_year=2020)
{

    // use to show select box with date
    // variables $name_day, $name_month, $name_year will be sent with the form
    // no date? use current date
    
    if (!$day || !$month || !$year || !$hour || !$min)
    {
        $today = getdate(time());
        
        $day = $today["mday"];
        $month = $today["mon"];
        $year = $today["year"];
        $hour = $today["hours"];
        $min = $today["minutes"];
    }
    
    $string = "\n<select name=".$name."_month>";
    for ($x=1; $x<=12; $x++)
    {
        if ($x < 10) $x = "0".$x;
        if ($x == $month) $string .= "\n<option selected>$x";
        else $string .= "\n<option>$x";
    }
    $string .= "\n</select> / ";
    
    $string .= "\n<select name=".$name."_day>";
    for ($x=1; $x<=31; $x++)
    {
        if ($x < 10) $x = "0".$x;
        if ($x == $day) $string .= "\n<option selected>$x";
        else $string .= "\n<option>$x";
    }
    $string .= "\n</select> / ";
    
    $string .= "\n<select name=".$name."_year>";
    for ($x=$first_year; $x<=$last_year; $x += 1)
    {
        if ($x == $year) $string .= "\n<option selected>$x";
        else $string .= "\n<option>$x";
    }
    $string .= "\n</select>&nbsp;&nbsp;&nbsp;&nbsp;";
    
    $string .= "\n<select name=".$name."_hour>";
    for ($x=0; $x<=23; $x += 1)
    {
        if ($x < 10) $x = "0".$x;
        if ($x == $hour) $string .= "\n<option selected>$x";
        else $string .= "\n<option>$x";
    }
    $string .= "\n</select>:";
    
    $string .= "\n<select name=".$name."_min>";
    for ($x=0; $x<=59; $x += 1)
    {
        if ($x < 10) $x = "0".$x;
        if ($x == $min) $string .= "\n<option selected>$x";
        else $string .= "\n<option>$x";
    }
    $string .= "\n</select>";
    
    return $string;
}

function date_short_select ($day, $month, $year, $name, $first_year=2007, $last_year=2010)
{

        // funkciju koristim za prikaz select boxa sa datumom
        // varijable $name_day, $name_month, $name_year bit ce predane sa formom
        // no date? use current date

        if (!$day || !$month || !$year)
        {
                $today = getdate(time());

                $day = $today["mday"];
                $month = $today["mon"];
                $year = $today["year"];
            
        }

        $string = "\n<select name=".$name."_day>";
        for ($x=1; $x<=31; $x++)
        {
                if ($x == $day) $string .= "\n<option selected>$x";
                else $string .= "\n<option>$x";
        }
        $string .= "\n</select> / ";

        $string .= "\n<select name=".$name."_month>";
        for ($x=1; $x<=12; $x++)
        {
                if ($x == $month) $string .= "\n<option selected>$x";
                else $string .= "\n<option>$x";
        }
        $string .= "\n</select> / ";

        $string .= "\n<select name=".$name."_year>";
        for ($x=$first_year; $x<=$last_year; $x += 1)
        {
                if ($x == $year) $string .= "\n<option selected>$x";
                else $string .= "\n<option>$x";
        }
        $string .= "\n</select>";

        
        return $string;
}
function pure_date_select ($day, $month, $year, $name, $first_year=2006, $last_year=2015)
{
    
    // no year? use current year
    
    if (!$year)
    {
        $today = getdate(time());   
        $year = $today["year"];
    }
	
	$string = "\n<select name=".$name."_month>";
	$string .= "\n<option selected value = 0> mm ";
    for ($x=1; $x<=12; $x++)
    {
        $x_name = get_month_name ($x);
		//if ($x < 10) $x = "0".$x;
		if ($x == $month) 
		{
			$string .= "\n<option selected value=$x>$x_name";
		}
        else $string .= "\n<option value=$x>$x_name";
    }
    $string .= "\n</select> / ";
    
    $string .= "\n<select name=".$name."_day>";
	$string .= "\n<option selected value = 0> dd ";
    for ($x=1; $x<=31; $x++)
    {
        if ($x < 10) $x = "0".$x;
		if ($x == $day) $string .= "\n<option selected>$x";
        else $string .= "\n<option>$x";
    }
    $string .= "\n</select> / ";
    
    $string .= "\n<select name=".$name."_year>";
	$string .= "\n<option selected value = 0> year ";
    for ($x=$first_year; $x<=$last_year; $x += 1)
    {
		if ($x == $year) $string .= "\n<option selected>$x";
        else $string .= "\n<option>$x";
    }
    $string .= "\n</select>&nbsp;&nbsp;&nbsp;&nbsp;";
    
    return $string;
}

function pure_date_select_with_zero ($day, $month, $year, $name, $first_year=2006, $last_year=2015)
{
    
    // no year? use current year
    
    /*if (!$year)
    {
        $today = getdate(time());   
        $year = $today["year"];
    }*/
	$string = "\n<select name=".$name."_month>";
	$string .= "\n<option selected value = 0> mm ";
    for ($x=1; $x<=12; $x++)
    {
        $x_name = get_month_name ($x);
		//if ($x < 10) $x = "0".$x;
		if ($x == $month) 
		{
			$string .= "\n<option selected value=$x>$x_name";
		}
        else $string .= "\n<option value=$x>$x_name";
    }
    $string .= "\n</select> / ";
    
    $string .= "\n<select name=".$name."_day>";
	$string .= "\n<option selected value = 0> dd ";
    for ($x=1; $x<=31; $x++)
    {
        if ($x < 10) $x = "0".$x;
		if ($x == $day) $string .= "\n<option selected>$x";
        else $string .= "\n<option>$x";
    }
    $string .= "\n</select> / ";
    
    $string .= "\n<select name=".$name."_year>";
	$string .= "\n<option selected value = 0> year ";
    for ($x=$first_year; $x<=$last_year; $x += 1)
    {
		if (($x == $year) && ($year !=0)) $string .= "\n<option selected>$x";
        else $string .= "\n<option>$x";
    }
    $string .= "\n</select>&nbsp;&nbsp;&nbsp;&nbsp;";
    
    return $string;
}

function get_month_name ($x)
{
	if ($x==1)  $x_string = "Jan";
	if ($x==2)  $x_string = "Feb";
	if ($x==3)  $x_string = "Mar";
	if ($x==4)  $x_string = "Apr";
	if ($x==5)  $x_string = "May";
	if ($x==6)  $x_string = "Jun";
	if ($x==7)  $x_string = "Jul";
	if ($x==8)  $x_string = "Aug";
	if ($x==9)  $x_string = "Sep";
	if ($x==10) $x_string = "Oct";
	if ($x==11) $x_string = "Nov";
	if ($x==12) $x_string = "Dec";
 
	return $x_string;

}

function PrepareCheckBox ( $BoxID , $BoxValue , $Checked )
{
    if ($Checked == 1) $Selected = "checked";
    else $Selected = $Checked ? "checked" : "";

    return "<input type='checkbox' name='$BoxID' value='$BoxValue' $Selected>";
}

function PrepareEditBox ( $BoxID , $BoxValue , $Editable = true , $size = 20 , $maxlen = 10)
{
    $Box = "<input type=text name=$BoxID  value=\"$BoxValue \" size = $size maxlength = $maxlen";
    if ( $Editable == true )
    {
        $Box .= ">";
    }
    else
    {
        $Box .= " readonly>";
    }
    return $Box;
}

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

function get_log_file()
{
return "tmp/log.txt";
}

function get_printdir_name()
{
        srand((double)microtime()*1000000);
        $randomId = rand(0,10000);
        return "tmp/print$randomId";
}


function get_day_of_the_week ($y,$m,$d)
{
        if ( $m >= "3")
        {
                $mn = $m - 2;
        }
        else
        {
                $mn = $m + 10;
        }

        if ( $mn >= "11" )
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

function dir_count($path)
{

     $handle=opendir("$path");
     while ($file = readdir($handle))
     {
        if ($file != "." and $file !="..")
        {
                $result++;
        }
     }
     closedir($handle);
     return $result;
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

function check_licence ($cookie_id_user)
{
		$cookie_query = db_query (" SELECT Permission FROM intusers WHERE IdUser = $cookie_id_user");
		$licence = db_result ($cookie_query,0,0);
		if ($licence == "")
		{
		print "<table border=0 width=100% cellspacing=0 cellpadding=0>
		<tr><td width=100% class=alert><b>You either have cookies disabled, <br>or you do not have permission to be here.<td></tr>
		
		</table></td><td></td><td></td>";
		exit;
		}
		return $licence;
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

function check_holiday ($y,$m,$d)
{
		// first check if the date is Sat or Sun
		$day = get_day_of_week ($y,$m,$d);
		if (($day == 0) || ($day == 1)) $holiday = 1;
		else
		{
			$hol_date ="$y-$m-$d";
			$check_holiday_query = db_query ("SELECT IdHoliday FROM holidays WHERE HolidayDate = '$hol_date'");
			$rows = db_numrows($check_holiday_query);
			if ($rows!=0) $holiday = 1;
		}

		return $holiday;
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



function format_usa_small_date($dbtime)
{
    // mySQL timestamp ->   mm.dd.yy hr:min:sec
    
    $yr = substr($dbtime,0,4);
    $mon = substr($dbtime,5,2);
    $day = substr($dbtime,8,2);
   
    $datum =  "$mon/$day/$yr";
    return $datum;
}

function get_highest_available_lesson_id($userId)
{
	$user_query = db_query (" SELECT signupDate FROM users WHERE UserID = $userId");
   	$startDate = db_result ($user_query,0,0);
   	
   	$nr_lessons_query = db_query (" SELECT COUNT(Id) FROM lessons WHERE Id > 0");
	$nr_lessons = db_result ($nr_lessons_query,0,0);
   
     $today_date = get_date_today();
     $dateDiff = dateDiff($startDate, $today_date);
			
	$accDays = 0;
    for ($i=1; $i<=$nr_lessons; $i++)
    {
    	$lesson_query = db_query (" SELECT name, file, completionTime FROM lessons WHERE Id = $i");
		$name = db_result ($lesson_query,0,"name");
		$file = db_result ($lesson_query,0,"file");
		$completionTime = db_result ($lesson_query,0,"completionTime");
		
		$accDays = $accDays + $completionTime;
		if ($accDays <= $dateDiff)
		{
			$highest_available_lesson = $name;
			$highest_available_lesson_id = $i;
		}
		else 
    	{
			 break;
		}
		
    }                                                
    
    return $highest_available_lesson_id;
}

function get_lesson_name($lessonId)
{
	$lesson_name_query = db_query (" SELECT name FROM lessons WHERE Id =$lessonId ");
   	$lesson_name = db_result ($lesson_name_query,0,0);     
    
    return $lesson_name;
}

function get_level_image ($lessonId)
{
	$image_name_query = db_query (" SELECT imageLevel FROM lessons WHERE Id =$lessonId ");
   	$image_name = db_result ($image_name_query,0,0);  

   	if ($image_name=="") $image_name="/categories/free_user.png";
    
    return $image_name;
}

function get_level_name ($lessonId)
{
	$level_name_query = db_query (" SELECT nameLevel FROM lessons WHERE Id =$lessonId ");
   	$level_name = db_result ($level_name_query,0,0);     
    
    return $level_name;
}

function get_file_name($lessonId)
{
	if ($lessonId == 0) $file_name = "disabled_lesson.php";
	else 
	{
		$file_name_query = db_query (" SELECT file FROM lessons WHERE Id =$lessonId ");
   		$file_name = db_result ($file_name_query,0,0);     
	}
    return $file_name;
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

function get_message($message_string)
{
	if ($message_string == "lesson_unavailable") $message = "<h2>Lesson Unavailable</h2> <p><br> Unfortunatelly, this lesson is still not available to you.<br><br></p>";
	return $message;
}
function get_lesson_avg_rating($lessonId)
{
	$lesson_avg_query = db_query (" SELECT avgRating FROM avg_ratings WHERE lessonId =$lessonId ");
   	$avg = db_result ($lesson_avg_query,0,0);
   	return $avg;
}

function show_avg_rating($avg)
{
	$star_number = ceil($avg);
	if ($star_number > 5) $star_number=5;
	
	for ($i=1; $i<=5; $i++)
	{
		if ($i == $star_number) $string_checked = "checked='checked'";
		else $string_checked = "";
		echo "<input name='star_rated' value=$i type='radio' class='star' $string_checked disabled='disabled' />";
	}
}

function show_comments($lessonId,$userId)
{
		$comments_query = db_query ("SELECT submitDate, userId, content FROM comments WHERE lessonId = $lessonId ORDER BY submitDate ASC");
		$nr_comments = db_numrows($comments_query);

		for ($i=0; $i<$nr_comments; $i++)
		{
	   		$tmp_submitDate = db_result ($comments_query,$i,"submitDate");
	   		$tmp_userId = db_result ($comments_query,$i,"userId");
	   		$tmp_user_name= find_name_from_table ("username", "users", "userID", $tmp_userId);

	   		$tmp_content = db_result ($comments_query,$i,"content");
	   		echo "<div class=comment_box><div class=comment_header><b>$tmp_user_name</b> <br><i> $tmp_submitDate</i></div><div class=comment_content> $tmp_content</div></div><div class=clear><br></div>";
		}
		
	
}

function create_table_of_comments($lessonId,$userId,$nr_of_comments=3)
{
		$comments_query = db_query ("SELECT Id, submitDate, userId, content FROM comments WHERE lessonId = $lessonId ORDER BY submitDate ASC LIMIT $nr_of_comments");
		$nr_comments = db_numrows($comments_query);
		if ($nr_comments>0)
		{

			$table_of_comments ="<table border=0 cellpading=0 cellspacing=0 width=600>";
			for ($i=0; $i<$nr_comments; $i++)
			{
		   		$tmp_commentId = db_result ($comments_query,$i,"Id");
		   		$tmp_submitDate = db_result ($comments_query,$i,"submitDate");
		   		$tmp_submitDate_f = relativeTime(strtotime($tmp_submitDate));
		   		$tmp_userId = db_result ($comments_query,$i,"userId");
		   		$tmp_user_name= find_name_from_table ("username", "users", "userID", $tmp_userId);
	
		   		$tmp_content = db_result ($comments_query,$i,"content");
		   		$tmp_content_short = substr($tmp_content,0,110);
		   		$tmp_content_short .= " ...";
		   		$table_of_comments .= "<tr class=comment_head_tr><td class=comment_table_head><b>$tmp_user_name</b>&nbsp;<i> $tmp_submitDate_f</i></tr>
		   		<tr class=comment_content_tr_s><td class=comment_table_td> $tmp_content_short &nbsp;<img src='images/expand.gif'></tr>
		   		<tr class=comment_content_tr><td class=comment_table_td> $tmp_content</tr><tr><td>&nbsp;</td></tr>";
			}
			$table_of_comments .= "</table>";
			
			return $table_of_comments;
		}
		
	
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
