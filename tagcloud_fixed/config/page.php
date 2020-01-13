<?php


if (!defined('e107_INIT')) { exit; }

$id_field = 'page_id';
$return_fields = 'page_id, page_title, page_sef, page_text, page_datestamp,page_chapter';
$search_fields = array('page_title', 'page_text');
$weights = array('1.2', '0.6');
$no_results = LAN_198;

$where = "page_class IN (".USERCLASS_LIST.") ";
$order = "page_datestamp  DESC";
$table = "page";


function search_page($row) {     
 
	$sql = e107::getDb();
	
	$books = $sql->retrieve("SELECT chapter_id,chapter_sef,chapter_parent, chapter_name, chapter_visibility FROM #page_chapters ORDER BY chapter_parent, chapter_order ASC" , true);
			
	foreach($books as $row2)
	{
		$id 						= $row2['chapter_id'];		
		$catList[$id] 		= $row2;
	}	
	
		    
	$book 	= $catList[$row['page_chapter']]['chapter_parent'];  
	$row['chapter_sef'] = $catList[$row['page_chapter']]['chapter_sef'];
	$row['book_sef']	= $catList[$book]['chapter_sef'];
 	   
	//$res['link'] = "page.php?".$row['page_id'];
	$route = ($row['page_chapter'] == 0) ? "page/view/other" : "page/view/index";     print_a($route);
	$res['link'] = e107::getUrl()->create($route, $row, array('full'=>1, 'allow' => 'page_sef,page_title,page_id, chapter_sef, book_sef'));
	$res['pre_title'] = "";
	$res['title'] = $row['page_title'];
	$res['summary'] = $row['page_text'];
	$res['detail'] = "Posted on ".e107::getDate()->convert_date($row['page_datestamp'], "long");
	return $res;
}

?>