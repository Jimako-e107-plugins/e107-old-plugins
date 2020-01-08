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
	//$res['link'] = "page.php?".$row['page_id'];
	$route = ($row['page_chapter'] == 0) ? "page/view/other" : "page/view/index";
	$res['link'] = e107::getUrl()->create($route, $row, array('full'=>1, 'allow' => 'page_sef,page_title,page_id, chapter_sef, book_sef'));
	$res['pre_title'] = "";
	$res['title'] = $row['page_title'];
	$res['summary'] = $row['page_text'];
	$res['detail'] = "Posted on ".$con -> convert_date($row['page_datestamp'], "long");
	return $res;
}

?>