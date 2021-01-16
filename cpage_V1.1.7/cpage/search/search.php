<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) {
    exit;
}
#error_reporting(E_ALL);
global $cpage_obj;
if (!is_object($cpage_obj)) {
    require(e_PLUGIN . "cpage/includes/cpage_class.php");
    $cpage_obj = new cpage;
}
$return_fields = 'c.user_name,t.cpage_id,t.cpage_title,t.cpage_text,t.cpage_author,t.cpage_datestamp,t.cpage_showdate_flag,t.cpage_lastdate_flag,t.cpage_lastupdate,t.cpage_showauthor_flag,t.cpage_link';
$search_fields = array('t.cpage_title', 't.cpage_text', 't.cpage_author', 't.cpage_meta_description', 't.cpage_meta_keywords', 't.cpage_meta_title', 't.cpage_link');
$weights = array('3', '5', '6', '1.0', '1', '1', '1.5');
$no_results = LAN_198;
$where = " find_in_set(cpage_class,'" . USERCLASS_LIST . "') and";
$order = array('t.cpage_title' => DESC);
$table = "cpage_page as t left join #user as c on substring_index(cpage_author,'.',1) = user_id ";

$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_cpage', $no_results, $where, $order);

$text .= $ps['text'];
$results = $ps['results'];

function search_cpage($row)
{
    global $PLUGINS_DIRECTORY, $cpage_obj, $tp;
    require_once(e_HANDLER . 'date_handler.php');
    $conv = new convert;

    $title = $row['cpage_link'];
    $link_id = $row['cpage_id'];

    $res['link'] = SITEURL .  $cpage_obj->make_url($row['cpage_link'], $link_id, 0,$row['cpage_title']);

    $res['pre_title'] = '';
    $res['title'] = $row['cpage_title'];
    $res['summary'] = $row['cpage_text'];
    if ($row['cpage_showdate_flag'] == 1) {
        // we show created
        $details = CPAGE_SEARCH02 . ' ' . $conv->convert_date($row['cpage_datestamp']) . ' - ';
    }
    if ($row['cpage_lastdate_flag'] == 1) {
        // we show created
        $details .= CPAGE_SEARCH03 . ' ' . $conv->convert_date($row['cpage_lastupdate']) . ' - ';
    }
    if ($row['cpage_showauthor_flag'] == 1) {
        // we show created
        if (!empty($row['user_name'])) {
            // we got the current name
            $details .= CPAGE_SEARCH04 . ' ' . $tp->toHTML($row['user_name']);
        } else {
            // not now a user so get the old name
            $tmp = explode('.', $tp->toFORM($row['cpage_author']), 2);
            $details .= CPAGE_SEARCH04 . ' ' . $tmp[1] . ' ';
        }
    }
    $res['detail'] = $details;

    return $res;
}

?>