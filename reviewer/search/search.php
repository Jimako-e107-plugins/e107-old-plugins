<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
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
require_once(e_PLUGIN."reviewer/includes/reviewer_class.php");

global $reviewer_obj;
if (!is_object($reviewer_obj))
{
    $reviewer_obj = new reviewer;
}
if ($reviewer_obj->reviewer_admin || $reviewer_obj->reviewer_creator || $reviewer_obj->reviewer_read)
{
    $return_fields = 't.reviewer_reviewer_id,t.reviewer_reviewer_itemid,t.reviewer_reviewer_review,t.reviewer_reviewer_posted,x.reviewer_items_id,x.reviewer_items_name,y.reviewer_category_name';
    $search_fields = array('t.reviewer_reviewer_review', 't.reviewer_reviewer_postername', 'x.reviewer_items_name', "y.reviewer_category_name");
    $weights = array('2.5', '0.5', '1.0', '1.0');
    $no_results = LAN_198;
    $where = "";
    $order = array('t.reviewer_reviewer_id' => DESC);
    $table = "reviewer_reviewer as t
	left join #reviewer_items as x on reviewer_reviewer_itemid=reviewer_items_id
	left join #reviewer_category as y on reviewer_items_catid=reviewer_category_id";

    $ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_reviewer', $no_results, $where, $order);
    $text .= $ps['text'];
    $results = $ps['results'];
}
function search_reviewer($row)
{
    global $reviewer_obj,$con, $tp;
    $poster_temp = explode(".", $row['reviewer_reviewer_postername'],2);
    $poster_name = $poster_temp[1];
    $datestamp = $con->convert_date($row['reviewer_reviewer_posted'], "long");
    $title = $tp->toHTML($row['reviewer_items_name'], false);
    $link_id = $row['reviewer_reviewer_id'];
    $dept = $row['reviewer_items_id'];
    $res['link'] = e_PLUGIN . "reviewer/reviewer.php?0.view." . $link_id . "";
    $res['pre_title'] = $title ?REVIEWER_S03 . " " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = REVIEWER_S02 . " " . $tp->toFORM($row['reviewer_reviewer_review']);
    $res['detail'] = REVIEWER_S01 . " " . $datestamp . " - " . $poster_name;
    return $res;
}

?>