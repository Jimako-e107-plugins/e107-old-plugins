<?php
/*
+---------------------------------------------------------------+
|        Onthisday Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');

$otd_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
// * start shortcodes
/*

SC_BEGIN OTD_DAY_TITLE
global $title;
return $title;
SC_END

SC_BEGIN OTD_YEAR
global $otd_year;
return $otd_year;
SC_END

SC_BEGIN OTD_TITLE
global $otd_title;
return $otd_title;
SC_END

SC_BEGIN OTD_BODY
global $otd_body;
return $otd_body;
SC_END

SC_BEGIN OTD_MANAGE
global $otd_obj;
if($otd_obj->otd_submit)
{
	return '<a href="'.e_PLUGIN.'onthisday_menu/manage_entries.php">'.OTD_001.'</a>';
}
else
{
	return '';
}
SC_END

SC_BEGIN OTD_CALENDAR
global $otd_obj,$otd_thisday,$otd_thismonth;

return $otd_obj->otd_calendar($otd_thismonth,$otd_thisday);
SC_END
*/