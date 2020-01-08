<?php
//ADD: function that renders a list or item info box.  this can then be called at top of edit or item entry
//     and at top of show just item or list page

if (!defined('e107_INIT')) { exit; }

$id_field = 'n.news_id';
$return_fields = 'n.news_id, n.news_title, n.news_body, n.news_extended, n.news_allow_comments, n.news_datestamp, n.news_category, c.category_name';
$search_fields = array('news_title', 'news_body', 'news_extended');
$time=time();


$where = "(news_start < ".$time.") AND (news_end=0 OR news_end > ".$time.") AND news_class IN (".USERCLASS_LIST.")";
$order = "news_datestamp DESC";
$table = "news AS n LEFT JOIN #news_category AS c ON n.news_category = c.category_id";


function search_news($row) {
	global $con;
	//$res['link'] = $row['news_allow_comments'] ? "news.php?item.".$row['news_id'] : "comment.php?comment.news.".$row['news_id'];
	$res['link'] = 	e107::getUrl()->create('news/view/item', $row, array('full' => 1));
	$res['pre_title'] = $row['category_name']." | ";
	$res['title'] = $row['news_title'];
	$res['summary'] = $row['news_body'].' '.$row['news_extended'];
	$res['detail'] = LAN_TG010 ." ".$con -> convert_date($row['news_datestamp'], "long");
	return $res;
}



?>
