<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This file is found in library section of the codeigniter application directory
 *
 */


/**
 * Useful common functions. 
 * @autoloaded YES
 * @path \system\application\libraries\Tools.php
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @copyright 2010 Prospace LLC
 * @version 1.0
 * 
 */
class Calendar {

private $CI;

   	public function __construct(){

			$this->CI =& get_instance();	

		}



function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 0, $pn = array()){



	$first_of_month = gmmktime(0,0,0,$month,1,$year);
	#remember that mktime will automatically correct if invalid dates are entered
	# for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
	# this provides a built in "rounding" feature to generate_calendar()
	
	

	$day_names = array(); #generate all the day names according to the current locale
	for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #January 4, 1970 was a Sunday
		$day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name




	list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
	$weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day
	$title   = htmlentities(ucfirst($month_name)).'&nbsp;'.$year;  #note that some locales don't capitalize month and day names





	#Begin calendar. Uses a real <caption>. See http://diveintomark.org/archives/2002/07/03
	@list($p, $pl) = each($pn); 
	@list($n, $nl) = each($pn); #previous and next links, if applicable
	if($p) $p = '<span class="calendar-prev">'.($pl ? $p : $p).'</span>&nbsp;';
	if($n) $n = '&nbsp;<span class="calendar-next">'.($nl ? $n : $n).'</span>';
	$calendar = '<table class="calendar">'."\n".
	

		'<caption class="calendar-month">'.$p.($month_href ? '<a href="'.htmlspecialchars($month_href).'">'.$title.'</a>' : "<span class='titleMonth'>".$title."</span>").$n."</caption>\n<tr>";




	if($day_name_length){ #if the day names should be shown ($day_name_length > 0)
		#if day_name_length is >3, the full name of the day will be printed
		foreach($day_names as $d)
			$calendar .= '<th abbr="'.htmlentities($d).'">'.htmlentities($day_name_length < 4 ? substr($d,0,$day_name_length) : $d).'</th>';
		$calendar .= "</tr>\n<tr>";
	}
	
	
	

	if($weekday > 0) $calendar .= '<td colspan="'.$weekday.'">&nbsp;</td>'; #initial 'empty' days
	
	for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){

		if($weekday == 7){
			$weekday   = 0; #start a new week
			$calendar .= "</tr>\n<tr>";
		}
		
		if(isset($days[$day]) && is_array($days[$day])){
			
			
			@list($link, $classes, $content) = $days[$day];
			

			
			if(is_null($content))  $content  = $day;
			
			
			$calendar .= '<td  year='.$year.' month='.$month.'  day='.$day 
		
		 .($classes ? ' >' : '>').
				($link ? '' : $content)
		
		.'</td>';
				
		}
		else $calendar .= "<td year=".$year." month=".$month." day=".$day." "
		." >$day&nbsp;&nbsp;"."</td>";
	}
	if($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>'; #remaining "empty" days

	return $calendar."</tr>\n</table>\n";
}



function isLeapYear($year)
    { return ((($year%4==0) && ($year%100)) || $year%400==0) ? (true):(false); } 
    
function IsLeapYear2($Year)
{
    $Year = ($Year >= 2300)? ($Year-543):$Year ;        // if check by B.E year (Buddhist era)
    return (date("d",mktime(0,0,0,3,0,$Year)) == 29)? TRUE:FALSE;
} 




}


/* End of file Tool.php */ 
/* Location: \system\application\libraries\Tools.php */
