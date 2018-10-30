<?php
/*
 * e107 website system
 *
 * Copyright (C) 2002-2010 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Event calendar - full-page calendar display
 *
 * $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/calendar_menu/calendar.php $
 * $Id: calendar.php 13092 2013-04-08 21:26:52Z e107steved $
 */


require_once('../../class2.php');



if (isset($_POST['viewallevents']))
{
    Header('Location: '.e_PLUGIN_ABS.'calendar_menu/event.php?' . $_POST['enter_new_val']);
	exit();
} 
if (isset($_POST['doit']))
{
    Header('Location: '.e_PLUGIN_ABS.'calendar_menu/event.php?ne.' . $_POST['enter_new_val']);
	exit();
}
if (isset($_POST['subs']))
{
    Header('Location: '.e_PLUGIN_ABS.'calendar_menu/subscribe.php');
	exit();
} 
if (isset($_POST['printlists']))
{
    Header('Location: '.e_PLUGIN_ABS.'calendar_menu/ec_pf_page.php');
	exit();
} 


require_once(e_PLUGIN.'calendar_menu/calendar_shortcodes.php');
include_lan(e_PLUGIN.'calendar_menu/languages/'.e_LANGUAGE.'.php');
define('PAGE_NAME', EC_LAN_121);

require_once('ecal_class.php');
$ecal_class = new ecal_class;

if (is_readable(THEME.'calendar_template.php')) 
{
	require(THEME.'calendar_template.php');
}
else 
{
	require(e_PLUGIN.'calendar_menu/calendar_template.php');
}


$cat_filter = intval(varset($_POST['event_cat_ids'],0));

require_once(HEADERF);

// get date within area to display
$qs = explode(".", e_QUERY);
if(varset($qs[0],'') == '')
{	// Show current month
	$datearray	= $ecal_class->cal_date;
} 
else
{	// Get date from query
	$datearray	= $ecal_class->gmgetdate($qs[0]);
}

// Note: A lot of the following variables are used within the shortcodes
$month		= $datearray['mon'];							// Number of month being shown
$year		= $datearray['year'];							// Number of year being shown
$monthstart	= gmmktime(0, 0, 0, $month, 1, $year);			// Start of month to be shown
$monthend	= gmmktime(0, 0, 0, $month + 1, 1, $year) - 1;	// End of month to be shown
$prevmonth		= $month-1;
$prevyear		= $year;
if ($prevmonth == 0)
{
  $prevmonth	= 12;
  $prevyear	= $year-1;
} 
$previous = gmmktime(0, 0, 0, $prevmonth, 1, $prevyear);		// Used by nav

$nextmonth		= $month + 1;
$nextyear		= $year;
if ($nextmonth == 13)
{
  $nextmonth	= 1;
  $nextyear	= $year + 1;
} 
$next			= gmmktime(0, 0, 0, $nextmonth, 1, $nextyear);
$py				= $year-1;									// Number of previous year for nav
$prevlink		= gmmktime(0, 0, 0, $month, 1, $py);
$ny				= $year + 1;								// Number of next year for nav
$nextlink		= gmmktime(0, 0, 0, $month, 1, $ny);

$prop		= gmmktime(0, 0, 0, $month, 1, $year);		// Sets start date for new event entry
$nowmonth	= $ecal_class->cal_date['mon'];
$nowyear	= $ecal_class->cal_date['year'];
$nowday		= $ecal_class->cal_date['mday'];


// set up arrays for calendar display ------------------------------------------------------------------
// $months is used in the navigator buttons. $monthabb is used for month list
$months		= Array(EC_LAN_0, EC_LAN_1, EC_LAN_2, EC_LAN_3, EC_LAN_4, EC_LAN_5, EC_LAN_6, EC_LAN_7, EC_LAN_8, EC_LAN_9, EC_LAN_10, EC_LAN_11);
$monthabb	= Array(EC_LAN_JAN, EC_LAN_FEB, EC_LAN_MAR, EC_LAN_APR, EC_LAN_MAY, EC_LAN_JUN, EC_LAN_JUL, EC_LAN_AUG, EC_LAN_SEP, EC_LAN_OCT, EC_LAN_NOV, EC_LAN_DEC);

$days = array(EC_LAN_DAY_1, EC_LAN_DAY_2, EC_LAN_DAY_3, EC_LAN_DAY_4, EC_LAN_DAY_5, EC_LAN_DAY_6, EC_LAN_DAY_7, EC_LAN_DAY_8, EC_LAN_DAY_9, EC_LAN_DAY_10, EC_LAN_DAY_11, EC_LAN_DAY_12, EC_LAN_DAY_13, EC_LAN_DAY_14, EC_LAN_DAY_15, EC_LAN_DAY_16, EC_LAN_DAY_17, EC_LAN_DAY_18, EC_LAN_DAY_19, EC_LAN_DAY_20, EC_LAN_DAY_21, EC_LAN_DAY_22, EC_LAN_DAY_23, EC_LAN_DAY_24, EC_LAN_DAY_25, EC_LAN_DAY_26, EC_LAN_DAY_27, EC_LAN_DAY_28, EC_LAN_DAY_29, EC_LAN_DAY_30, EC_LAN_DAY_31);


//-------------------------------------------------
// 		Start calculating text to display
//-------------------------------------------------

// time switch buttons
$cal_text = $tp -> parseTemplate($CALENDAR_TIME_TABLE, FALSE, $calendar_shortcodes);

// navigation buttons
$nav_text = $tp -> parseTemplate($CALENDAR_NAVIGATION_TABLE, FALSE, $calendar_shortcodes);

// We'll need virtually all of the event-related fields, so get them regardless. Just cut back on category fields
$ev_list = $ecal_class->get_events($monthstart, $monthend, FALSE, $cat_filter, TRUE, '*', 'event_cat_name,event_cat_icon');

// We create an array $events[] which has a 'primary' index of each day of the current month - 1..31 potentially
// For each day there is then a sub-array entry for each event
// Note that the new class-based retrieval adds an 'is_recent' flag to the data if changed according to the configured criteria
$events = array();
foreach ($ev_list as $row)
{
	$row['startofevent'] = TRUE;			// This sets 'large print' and so on for the first day of an event

	// check for recurring events in this month (could also use is_array($row['event_start']) as a test)
	if($row['event_recurring'] != '0')
	{  // There could be several dates for the same event, if its a daily/weekly event
		$t_start = $row['event_start'];
		foreach ($t_start as $ev_start)
		{
		// Need to save event, copy marker for date
			$row['event_start'] = $ev_start;
			$events[gmdate('j',$ev_start)][] = $row;
		}
	}
	else
	{  // Its a 'normal' event
		$tmp	= gmdate('j',$row['event_start']);		// Day of month for start
		if ($row['event_allday'])
		{
			$tmp2 = $tmp;			// Same day for start and end
		}
		else
		{
			$tmp2	= gmdate('j',$row['event_end']-1);			// Day of month for end - knock off a second to allow for BST and suchlike
		}
		if(($row['event_start']>=$monthstart) && ($row['event_start']<=$monthend))
		{	// Start within month
			$events[$tmp][] = $row;
			$tmp++;
			if ($row['event_end']>$monthend)
			{  // End outside month
				$tmp2	= gmdate("t", $monthstart); // number of days in this month
			}
		}
		else
		{	// Start before month
			$tmp = 1;
			if ($row['event_end']>$monthend)
			{  // End outside month
				$tmp2	= gmdate("t", $monthstart); // number of days in this month
			}
		}
		// Now put in markers for all 'non-start' days within current month
		$row['startofevent'] = FALSE;
		for ($c= $tmp; $c<=$tmp2; $c++) 
		{
			$events[$c][] = $row;
		}
	}
}



// ****** CAUTION - the category dropdown also used $sql object - take care to avoid interference!

$start		= $monthstart;
$numberdays	= gmdate("t", $start); // number of days in this month

$text = "";
$text .= $tp -> parseTemplate($CALENDAR_CALENDAR_START, FALSE, $calendar_shortcodes);
$text .= $tp -> parseTemplate($CALENDAR_CALENDAR_HEADER_START, FALSE, $calendar_shortcodes);

// Display the column headers
for ($i = 0; $i < 7; $i++)
{
  $day = $ecal_class->day_offset_string($i);
  $text .= $tp -> parseTemplate($CALENDAR_CALENDAR_HEADER, FALSE, $calendar_shortcodes);
} 
$text .= $tp -> parseTemplate($CALENDAR_CALENDAR_HEADER_END, FALSE, $calendar_shortcodes);


// Calculate number of days to skip before 'real' days on first line of calendar
$firstdayoffset = gmdate('w',$start) - $ecal_class->ec_first_day_of_week;
if ($firstdayoffset < 0) $firstdayoffset+= 7;

for ($c=0; $c<$firstdayoffset; $c++) 
{
  $text .= $tp -> parseTemplate($CALENDAR_CALENDAR_DAY_NON, FALSE, $calendar_shortcodes);
}

$loop = $firstdayoffset;

for ($c = 1; $c <= $numberdays; $c++)
{	// Loop through the number of days in this month
	$startt	= $start;			// Used by shortcodes - start of current day
	$stopp	= $start + 86399;	// End of current day
	$got_ev 	= array_key_exists($c, $events) && is_array($events[$c]) && count($events[$c]) > 0;		// Flag set if events today
  
   // Highlight the current day.
    if ($nowday == $c && $month == $nowmonth && $year == $nowyear)
    {      	//today
	  $text .= $tp -> parseTemplate($CALENDAR_CALENDAR_DAY_TODAY, FALSE, $calendar_shortcodes);
	}
	elseif ($got_ev)
	{	//day has events
	  $text .= $tp -> parseTemplate($CALENDAR_CALENDAR_DAY_EVENT, FALSE, $calendar_shortcodes);
    } 
    else
    {   // no events and not today
	  $text .= $tp -> parseTemplate($CALENDAR_CALENDAR_DAY_EMPTY, FALSE, $calendar_shortcodes);
    } 
	if ($got_ev)
	{
		foreach($events[$c] as $ev)
		{
			if ($ev['startofevent'])
			{
			  $ev['indicat'] = '';
			  $ev['imagesize'] = '8';
			  $ev['fulltopic'] = TRUE;
			}
			else
			{
			  $ev['indicat'] = '';
			  $ev['imagesize'] = '4';
			  $ev['fulltopic'] = FALSE;
			}
			$text .= $tp -> parseTemplate($CALENDAR_SHOWEVENT, FALSE, $calendar_shortcodes);
		} 
	}
	$text .= $tp -> parseTemplate($CALENDAR_CALENDAR_DAY_END, FALSE, $calendar_shortcodes);

	$loop++;
	if ($loop == 7)
	{
		$loop = 0;
		if($c != $numberdays)
		{
		  $text .= $tp -> parseTemplate($CALENDAR_CALENDAR_WEEKSWITCH, FALSE, $calendar_shortcodes);
		}
	}
	$start += 86400;
}

//remainder cells to end the row properly with empty cells
if($loop!=0)
{
	for ($c=$loop; $c<7; $c++) 
	{
		$text .= $tp -> parseTemplate($CALENDAR_CALENDAR_DAY_NON, FALSE, $calendar_shortcodes);
	}
}
$text .= $tp -> parseTemplate($CALENDAR_CALENDAR_END, FALSE, $calendar_shortcodes);

$ns->tablerender(EC_LAN_79, $cal_text . $nav_text . $text);

// Claim back memory from key variables
unset($ev_list);
unset($text);

require_once(FOOTERF);

?>