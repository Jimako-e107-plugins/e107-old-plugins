<?php
/*
+---------------------------------------------------------------+
|        e_Version for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
// search module for eversion.
include_lan(e_PLUGIN."e_version/languages/".e_LANGUAGE.".php");

$return_fields = 't.eversion_id,t.eversion_name,t.eversion_title,t.eversion_author,t.eversion_revisions,t.eversion_comments,t.eversion_date';
$search_fields = array('t.eversion_name', 't.eversion_title', "t.eversion_author","t.eversion_revisions","t.eversion_comments");
$weights = array('2.0', '1.5', '0.6','1.5','1.5');
$no_results = LAN_198;
$where = "t.eversion_id>0 and " ;
$order = array('t.eversion_name' => DESC);
$table = "eversion as t";
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_eversion', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_eversion($row)
{

    global $con,$tp;
    $datestamp = $con->convert_date($row['eversion_date'], "long");
    $title = "-" . $tp->text_truncate($row['eversion_title'], 30,"[...]") . "-";
    #$link_id = $row['eversion_id'];
    $res['link'] = e_PLUGIN . "e_version/eversion.php?0.view." . $row['eversion_id'];
    $res['pre_title'] = $title ?EVERSION_21 . " " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = EVERSION_22 . " : " . $tp->text_truncate($row['eversion_title'], 30,"[...]")." " ;
    $res['detail'] = EVERSION_23 . " " . $datestamp ;
    return $res;
}

?>