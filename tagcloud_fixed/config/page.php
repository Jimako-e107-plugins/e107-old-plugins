<?php


if (!defined('e107_INIT')) { exit; }

$id_field = 'page_id';
$return_fields = 'page_id, page_title, page_text, page_datestamp';
$search_fields = array('page_title', 'page_text');
$weights = array('1.2', '0.6');
$no_results = LAN_198;

$where = "page_class IN (".USERCLASS_LIST.") ";
$order = "page_datestamp  DESC";
$table = "page";


function search_page($row) {
	global $con;
	$res['link'] = "page.php?".$row['page_id'];
	$res['pre_title'] = "";
	$res['title'] = $row['page_title'];
	$res['summary'] = $row['page_text'];
	$res['detail'] = "Posted on ".$con -> convert_date($row['page_datestamp'], "long");
	return $res;
}

?>