<?php


if (!defined('e107_INIT')) { exit; }

$id_field = 't.thread_id';
 
$weights = array('1.2', '0.6');
 
$no_results = LAN_198;

$where = "f.forum_class REGEXP '".e_CLASS_REGEXP."' AND fp.forum_class REGEXP '".e_CLASS_REGEXP."'";
 

$search = array(
	'name'			=> LAN_PLUGIN_FORUM_NAME,
//	'table'			=> 'forum',
	'table'			=> 'forum_thread AS t LEFT JOIN #user AS u ON t.thread_user = u.user_id
						LEFT JOIN #forum AS f ON t.thread_forum_id = f.forum_id
						LEFT JOIN #forum AS fp ON f.forum_parent = fp.forum_id
						LEFT JOIN #forum_post AS p ON p.post_thread = t.thread_id',

	'advanced' 		=> array(
						'forum'	=> array('type'	=> 'dropdown', 		'text' => FOR_SCH_LAN_2, 'list'=>$catList),
						'date'	=> array('type'	=> 'date', 		'text' => LAN_DATE_POSTED),
						'author'=> array('type'	=> 'author',	'text' => LAN_SEARCH_61),
						'match'=> array('type'	=> 'dropdown',	'text' => LAN_SEARCH_52, 'list'=>$matchList) // not functional yet.
					),

	'return_fields'	=> array('t.thread_id', 't.thread_name', 'p.post_id', 'p.post_entry', 't.thread_forum_id', 't.thread_datestamp', 't.thread_user', 'u.user_id', 'u.user_name', 'f.forum_class', 'f.forum_id', 'f.forum_name', 'f.forum_sef'),
	'search_fields'	=> array('t.thread_name'=>'1.2', 'p.post_entry'=>'0.6'), // fields and weights.

	'order'			=>  array('thread_datestamp' => DESC),
	'refpage'		=> 'forum'
);
       
$return_fields = implode(', ', $search['return_fields'] );
$return_fields = trim($return_fields);

 	
$search_fields = implode(', ', $search['search_fields'] );
$search_fields = trim($return_fields);

$table = $search['table'];	
$order = $search['order'];
		
function search_forum($row) {
 
	$datestamp = e107::getDate()->convert_date($row['thread_datestamp'], "long");
	if ($row['thread_parent']) {
		$title = $row['parent_name'];
	} else {
		$title = $row['thread_name'];
	}

	$link_id = $row['thread_id'];
	
	$uparams = array('id' => $row['user_id'], 'name' => $row['user_name']);
	$link = e107::getUrl()->create('user/profile/view', $uparams);
	$userlink = "<a href='".$link."'>".$row['user_name']."</a>";
	

	//$res['link'] = e_PLUGIN."forum/forum_viewtopic.php?".$link_id.".post";
	$res['link'] 		= e107::url('forum','topic', $row, array('query'=>array('f'=>'post','id'=>$row['post_id']))); 
	//$res['pre_title'] = $title ? "As part of Thread: " : "";
	$res['pre_title'] 	= '';
	
	$forumTitle = "<a href='".e107::url('forum','forum',$row)."'>".$row['forum_name']."</a>";
	$res['title'] = $title ? $forumTitle . " | ". $title : LAN_SEARCH_9;;
	//$res['pre_summary'] = "<div class='smalltext' style='padding: 2px 0px'><a href='".e_PLUGIN."forum/forum.php'>Forum</a> -> <a href='".e_PLUGIN."forum/forum_viewforum.php?".$row['forum_id']."'>".$row['forum_name']."</a></div>";
	$res['pre_summary'] = "";
	$res['summary'] = $row['post_entry'];
	$res['detail'] = "Posted by <a href='".$userlink."'>".$row['user_name']."</a> on ".$datestamp;
	return $res;
}

?>