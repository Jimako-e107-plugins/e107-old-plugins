<?php


if (!defined('e107_INIT')) { exit; }

$id_field = 't.thread_id';
$search_fields = array('thread_name', 'thread_thread');
$return_fields = 't.thread_id, tp.thread_name AS parent_name, t.thread_name, t.thread_thread, t.thread_forum_id, t.thread_parent, t.thread_datestamp, t.thread_user, u.user_id, u.user_name, f.forum_class, f.forum_id, f.forum_name';
$weights = array('1.2', '0.6');
$no_results = LAN_198;

$where = "f.forum_class REGEXP '".e_CLASS_REGEXP."' AND fp.forum_class REGEXP '".e_CLASS_REGEXP."'";
$order = "thread_datestamp  DESC";
$table = "forum_t AS t LEFT JOIN #user AS u ON SUBSTRING_INDEX(t.thread_user,'.',1) = u.user_id
		LEFT JOIN #forum AS f ON t.thread_forum_id = f.forum_id
		LEFT JOIN #forum AS fp ON f.forum_parent = fp.forum_id
		LEFT JOIN #forum_t AS tp ON t.thread_parent = tp.thread_id";


function search_forum($row) {
	global $con;
	$datestamp = $con -> convert_date($row['thread_datestamp'], "long");
	if ($row['thread_parent']) {
		$title = $row['parent_name'];
	} else {
		$title = $row['thread_name'];
	}

	$link_id = $row['thread_id'];

	$res['link'] = e_PLUGIN."forum/forum_viewtopic.php?".$link_id.".post";
	$res['pre_title'] = $title ? "As part of Thread: " : "";
	$res['title'] = $title ? $title : LAN_SEARCH_9;
	$res['pre_summary'] = "<div class='smalltext' style='padding: 2px 0px'><a href='".e_PLUGIN."forum/forum.php'>Forum</a> -> <a href='".e_PLUGIN."forum/forum_viewforum.php?".$row['forum_id']."'>".$row['forum_name']."</a></div>";
	$res['summary'] = $row['thread_thread'];
	$res['detail'] = "Posted by <a href='user.php?id.".$row['user_id']."'>".$row['user_name']."</a> on ".$datestamp;
	return $res;
}

?>