<?php
/*
+---------------------------------------------------------------+
|        On THis Day Menu for e107 v7xx - by Father Barry
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

global $otd_obj;
include_lan(e_PLUGIN . "onthisday_menu/languages/" . e_LANGUAGE . ".php");

if (!is_object($otd_obj))
{
    require_once(e_PLUGIN . 'onthisday_menu/includes/onthisday_class.php');
    $otd_obj = new onthisday;
}

if (!$otd_obj->otd_read || $OTD_PREF['otd_showall'] != 1)
{
    // not in read class and not in show all
    return;
}

$return_fields = '*';
$search_fields = array('otd_brief', 'otd_full');
$weights = array('2', '3');
$no_results = LAN_198;
$where = "";
$order = array('otd_brief' => DESC);
$table = "onthisday";

$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_onthisday_menu', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_onthisday_menu($row)
{
    global $otd_gen, $tp;
    $otd_months = explode(",", OTD_MONTHS);
    $datestamp = $row['otd_day'] . ' ' . $otd_months[$row['otd_month']] . " " . ($row['otd_year'] > 0?OTD_03 . " " . $row['otd_year']:OTD_02);
    $title = $tp->toHTML($row['otd_brief']);
    $link_id = '';
    $res['link'] = e_PLUGIN . "onthisday_menu/index.php?show.0." . $row['otd_month'] . "." . $row['otd_day'];
    $res['pre_title'] = $title ?OTD_010 . " " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = $tp->toHTML($row['otd_full']);
    $res['detail'] = OTD_012 . " " . $datestamp;
    return $res;
}

?>