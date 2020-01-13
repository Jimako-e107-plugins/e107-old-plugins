<?php

if (!defined('e107_INIT')) { exit; }

// advanced 

$id_field ="content_id";
$search_fields = array('content_heading', 'content_subheading', 'content_summary', 'content_text');
$return_fields = 'content_id, content_heading, content_subheading, content_summary, content_text, content_datestamp, content_parent, content_author';
$time=time();

$where = "content_class IN (".USERCLASS_LIST.") AND content_parent >0";
$order = "content_datestamp  DESC";
$table = "pcontent";

function search_content($row) {
	$sql = e107::getDb();
	$res['link'] = e_PLUGIN."content/content.php?content.".$row['content_id'];
	$res['pre_title'] = "";
	$res['title'] = $row['content_heading'];
	$res['summary'] = $row['content_summary'].' '.$row['content_text'];
	
	//get category heading
	if($row['content_parent'] == '0'){
		$qry = "
		SELECT c.content_heading
		FROM #pcontent as c
		WHERE c.content_id = '".$row['content_id']."' ";
	}elseif(strpos($row['content_parent'], "0.") !== FALSE){
		$tmp = explode(".", $row['content_parent']);
		$qry = "
		SELECT c.content_heading
		FROM #pcontent as c
		WHERE c.content_id = '".intval($tmp[1])."' ";
	}else{
		$qry = "
		SELECT c.*, p.*
		FROM #pcontent as c
		LEFT JOIN #pcontent as p ON p.content_id = c.content_parent
		WHERE c.content_id = '".$row['content_id']."' ";
	}
	//echo "qry: $qry";
	$sql -> gen($qry);
	$cat = $sql -> fetch();

	$res['detail'] = "Posted on ".e107::getDate()->convert_date($row['content_datestamp'], "long")." in ".$cat['content_heading'];
	return $res;
}

?>