<?php
/*
+---------------------------------------------------------------+
|        On This Day Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!is_object($otd_obj))
{
    require_once(e_PLUGIN . 'onthisday_menu/includes/onthisday_class.php');
    $otd_obj = new onthisday;
}
// include the appropriate language file, if possible
include_lan(e_PLUGIN . "onthisday_menu/languages/" . e_LANGUAGE . ".php");
if (e_QUERY)
{
    $otd_tmp = explode('.', e_QUERY);
    $otd_thisday = intval($otd_tmp[3]);
    $otd_thismonth = intval($otd_tmp[2]);
}
if ($otd_thisday == 0 || $otd_thismonth == 0)
{
    $otd_thisday = (int)date("d");
    $otd_thismonth = (int)date("m");
}

define("e_PAGETITLE", OTD_04);
require_once(e_PLUGIN . 'onthisday_menu/includes/onthisday_shortcodes.php');
if (file_exists(THEME . 'images/otd_logo.png'))
{
    define('OTD_LOGO', THEME . 'images/otd_logo.png');
}
else
{
    define('OTD_LOGO', e_PLUGIN . 'onthisday_menu/images/otd_logo.png');
}
require_once(HEADERF);
if (file_exists(THEME . 'onthisday_template.php'))
{
    define('OTD_TEMPLATE', THEME . 'onthisday_template.php');
}
else
{
    define('OTD_TEMPLATE', e_PLUGIN . 'onthisday_menu/templates/onthisday_template.php');
}
require_once(OTD_TEMPLATE);

$otd_currentmonth = explode(',', OTD_MONTHLIST);

$captiondate = $otd_thisday . ' ' . $otd_currentmonth[$otd_thismonth] ;
$title = OTDLAN_CAP . " " . $captiondate ;
if ($otd_obj->otd_read)
{
    if ($sql->db_Select("onthisday", "*", "where otd_day = {$otd_thisday} and otd_month = {$otd_thismonth} order by otd_year", 'nowhere', false))
    {
        $text .= $tp->parsetemplate($OTD_DAY_HEAD, true, $otd_shortcodes);
        // Events occured on this day
        while ($item = $sql->db_Fetch())
        {
            extract($item);
            $otd_year = ($otd_year > 0?OTD_03 . " " . $otd_year:OTD_02) ;
            $otd_title = $tp->toHTML($otd_brief , true, "emotes_on no_replace");
            $otd_body = $tp->toHTML($otd_full, true, "emotes_on no_replace");

            $text .= $tp->parsetemplate($OTD_DAY_DETAIL, true, $otd_shortcodes);
        } // while;
        $text .= $tp->parsetemplate($OTD_DAY_FOOTER, true, $otd_shortcodes);
    }
    else
    {
        $text .= $tp->parsetemplate($OTD_DAY_NOREC, true, $otd_shortcodes);
    }
}
else
{
    // Not in correct class
    $text .= $tp->parsetemplate($OTD_DAY_NOTPERMITTED, true, $otd_shortcodes);
}

$ns->tablerender(e_PAGETITLE, $text); // Render the page

require_once(FOOTERF);
