<?php
if (!defined('e107_INIT')) { exit; }
// search module for faq.
require_once(e_PLUGIN."faq/includes/faq_class.php");
if (!is_object($faq_obj)) {
	$faq_obj=new FAQ;
}

$return_fields = 't.faq_question,t.faq_answer,t.faq_datestamp,x.faq_info_title,t.faq_id,x.faq_info_id,x.faq_info_class';
$search_fields = array('t.faq_question', 't.faq_answer', "x.faq_info_title");
$weights = array('2.0', '2.0', '1.0');
$no_results = LAN_198;
$where = " faq_approved > 0 and find_in_set(faq_info_class,'".USERCLASS_LIST."') and ";
$order = array('t.faq_question' => DESC);
$table = "faq as t left join #faq_info as x on faq_parent=faq_info_id ";
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_faq', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_faq($row)
{
    global $con,$tp;
    $datestamp = $con->convert_date($row['faq_datestamp'], "long");
    $title = "-" . $row['faq_info_title'] . "-";
    $cat_id = $row['faq_info_id'];
    $link_id = $row['faq_id'];
    $dept = $row['dept_id'];
    $res['link'] = e_PLUGIN . "faq/faq.php?0.cat." . $cat_id . "." . $link_id . "";
    $res['pre_title'] = $title ?FAQLAN_57 . " " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = "-- ".FAQLAN_55 . " " . $tp->toHTML($row['faq_question'],false) . " -- ".FAQLAN_56 . " " . $tp->toHTML($row['faq_answer'],false);
    $res['detail'] = FAQLAN_58 . " " . $datestamp . " in " . $row['faq_info_title'];
    return $res;
}

?>