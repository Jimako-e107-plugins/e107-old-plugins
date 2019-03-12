<?php
include_lan(e_PLUGIN . "helpdesk3_menu/languages/admin/" . e_LANGUAGE . ".php");
include_lan(e_PLUGIN . "helpdesk3_menu/languages/" . e_LANGUAGE . ".php");

$return_fields = 't.hdu_id,t.hdu_description,t.hdu_datestamp,t.hdu_poster,t.hdu_summary,x.hducat_category,y.hdures_resolution';
$search_fields = array('t.hdu_poster', 't.hdu_description','t.hdu_summary', "x.hducat_category", "y.hdures_resolution");
$weights = array('1', '2', '2', '0.6','0.4');
$no_results = LAN_198;
$where = "";

$order = array('t.hdu_datestamp' => DESC);
$table = "hdunit as t left join #hdu_categories as x on hdu_category=hducat_id left join #hdu_resolve as y on hdu_resolution=hdures_id";

$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_helpdesk', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_helpdesk($row)
{
    global $con;
    $datestamp = $con->convert_date($row['hdu_datestamp'], "long");
    $title = $row['hdu_id'];

    $link_id = $row['hdu_id'];
    $dept = $row['dept_id'];
    $res['link'] = e_PLUGIN . "helpdesk3_menu/helpdesk.php?0.show." . $link_id . "";
    $res['pre_title'] = $title ?HDU_201 . " " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $hdu_post = explode(".", $row['hdu_poster']);
    $hdu_postname = $hdu_post[1];

    $res['summary'] =HDU_10 . "-" . substr($row['hducat_category'], 0, 30) . "\n" . HDU_4 . "-" . $row['hdures_resolution'];
    $res['detail'] = "<b>".HDU_12 . "</b><br />" . substr($row['hdu_summary'], 0, 30) . "<br />" . HDU_3 . " " . $hdu_postname . " " . $datestamp;
    return $res;
}

?>