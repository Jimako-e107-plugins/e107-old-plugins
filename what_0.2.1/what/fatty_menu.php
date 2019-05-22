<?php

// this is what's happened in the last N days...

if (!defined('e107_INIT')) { exit(); }

include_lan(e_PLUGIN."what/languages/".e_LANGUAGE.".php");
include_once(e_PLUGIN."what/circus.php");
global $eMenuActive;

if(check_class($pref['what_fatty_viewaccess'])){
	
	$timeframe = (($pref['what_fatty_timeframe']) ? $pref['what_fatty_timeframe'] : 432000);
	$sincewhen = (time() - $timeframe);
	$text = "";

	if($pref['what_fatty_layer'] == true){
		$text .= "<div style='height:".(($pref['what_fatty_layerheight']) ? $pref['what_fatty_layerheight'] : "150")."px; overflow:auto;'>";
	}
	
	if(strtolower($pref['what_fatty_notify']) == "date"){
		$text .= "As of ".date("F jS, Y", $sincewhen)." the following has happened:<br /><br />";
	}else if(strtolower($pref['what_fatty_notify']) == "day"){
		$text .= "This is what has happened in the last ".intval(intval($timeframe) / 86400)." day".(intval(intval($timeframe) / 86400) > 1 ? "s" : "").":<br /><br />";
	}else{
		$text .= "";
	}

	// news posts
	if($sql->db_Count("news", "(*)", "WHERE `news_datestamp` > {$sincewhen} AND news_class REGEXP '".e_CLASS_REGEXP."'") > 0){
		$text .= "<div class='forumheader'>News Posts</div><br />\n<ul>";
		$sql->db_Select("news", "*", "ORDER BY news_id DESC", "WHERE news_class REGEXP '".e_CLASS_REGEXP."'") or die(mysql_error());
		while($row = $sql->db_Fetch()){
			if($row['news_datestamp'] > $sincewhen){
				$text .= "<li><a href='".e_BASE."user.php?id.".$row['news_author']."'>".get_username($row['news_author'])."</a> posted <a href='".SITEURL."news.php?item.".$row['news_id']."'>".$row['news_title']."</a></li>";
			}
		}
		$text .= "</ul>\n<br />";
	}

	// downloads
	if($sql->db_Count("download", "(*)", "WHERE `download_datestamp` > ".$sincewhen) > 0){
		$text .= "<div class='forumheader'>Downloads</div><br />\n<ul>";
		$sql->db_Select("download", "*") or die(mysql_error());
		while($row = $sql->db_Fetch()){
			if($row['download_datestamp'] > $sincewhen){
				$text .= "<li><a href='".SITEURL."download.php?view.".$row['download_id']."'>".$row['download_name']."</a> was posted in <a href='".SITEURL."download.php?list.".$row['download_category']."'>".get_downloadcat($row['download_category'])."</a></li>";
			}
		}
		$text .= "</ul><br />";
	}

	// comments
	if($sql->db_Count("comments", "(*)", "WHERE `comment_datestamp` > ".$sincewhen) > 0){
		$text .= "<div class='forumheader'>Comments</div><br />\n<ul>";
		$sql->db_Select("comments", "*", "ORDER BY comment_id DESC", "no-where") or die(mysql_error());
		while($row = $sql->db_Fetch()){

			$author = explode(".", $row['comment_author']);

			if($row['comment_datestamp'] > $sincewhen){
				$text .= "<li><a href='".e_BASE."user.php?id.".$author[0]."'>".$author[1]."</a> commented on <a href='".SITEURL."comment.php?comment.news.".$row['comment_item_id']."'>".get_newstitle($row['comment_item_id'])."</a></li>";
			}
		}
		$text .= "</ul><br />";
	}

	// chatbox posts
	if(in_array('chatbox_menu',$eMenuActive)){
		if($sql->db_Count("chatbox", "(*)", "WHERE `cb_datestamp` > ".$sincewhen) > 0){
			$text .= "<div class='forumheader'>Chatbox Posts</div><br />\n<ul>";
			$sql->db_Select("chatbox", "*", "ORDER BY cb_id DESC", "no-where") or die(mysql_error());
			while($row = $sql->db_Fetch()){

				$author = explode(".", $row['cb_nick']);

				if($row['cb_datestamp'] > $sincewhen){
					$text .= "<li><a href='".e_BASE."user.php?id.".$author[0]."'>".$author[1]."</a> posted in the chatbox.</li>";
				}
			}
			$text .= "</ul><br />";
		}
	}

	// forum posts
	if($sql->db_Count("forum_t", "(*)", "WHERE `thread_lastpost` > ".$sincewhen) > 0){
		$text .= "<div class='forumheader'>Forum Posts</div><br />\n<ul>";
		$sql->db_Select_gen("
		SELECT t.thread_id, t.thread_name, t.thread_datestamp, t.thread_user, t.thread_lastpost, f.forum_id, f.forum_name, f.forum_class, u.user_name, fp.forum_class, lp.user_name AS lp_name, lp.user_id AS lp_id
		FROM #forum_t AS t
		LEFT JOIN #user AS u ON SUBSTRING_INDEX(t.thread_user,'.',1) = u.user_id
		LEFT JOIN #user AS lp ON SUBSTRING_INDEX(t.thread_lastuser,'.',1) = lp.user_id
		LEFT JOIN #forum AS f ON f.forum_id = t.thread_forum_id
		LEFT JOIN #forum AS fp ON f.forum_parent = fp.forum_id
		WHERE f.forum_id = t.thread_forum_id AND t.thread_parent=0 AND f.forum_class IN (".USERCLASS_LIST.")
		AND fp.forum_class IN (".USERCLASS_LIST.")
		ORDER BY t.thread_id DESC");

		while($row = $sql->db_Fetch()){
			if($row['thread_lastpost'] > $sincewhen){
				$text .= "<li><a href='".e_BASE."user.php?id.".$row['lp_id']."'>".$row['lp_name']."</a> posted in <a href='".e_PLUGIN."forum/forum_viewtopic.php?".$row['thread_id']."'>".$row['thread_name']."</a> under <a href='".e_PLUGIN."forum/forum_viewforum.php?".$row['forum_id']."'>".$row['forum_name']."</a></li>";
			}
		}
		$text .= "</ul><br />";
	}
	

	// new members
	if($sql->db_Count('user', '(user_join)', 'WHERE user_join > '.$sincewhen) > 0){
		$text .= "<div class='forumheader'>New Members</div><br />\n<ul>";
		$sql->db_Select("user", "*", "ORDER BY user_id DESC", "no-where") or die(mysql_error());
		while($row = $sql->db_Fetch()){
			if($row['user_join'] > $sincewhen){
				$text .= "<li><a href='".SITEURL."user.php?id.".$row['user_id']."'>".$row['user_name']."</a> has joined the site.</li>";
			}
		}
		$text .= "</ul><br />";
	}

	if($pref['what_fatty_layer'] == true){
		$text .= "</div>";
	}
	$text .= "</div>";

	$ns->tablerender(WHAT_LAN02, $text, 'what_fatty');
}
?>