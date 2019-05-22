<?php

// since your last visit...

if (!defined('e107_INIT')) { exit(); }

include_lan(e_PLUGIN."what/languages/".e_LANGUAGE.".php");
global $eMenuActive;

if(USER){

	$time = USERLV;

	// news items
	$new_news = $sql->db_Count("news", "(*)", "WHERE `news_datestamp` > {$time} AND news_class REGEXP '".e_CLASS_REGEXP."'");
	$pretext .= ($new_news > 0 ? ($new_news == 1 ? str_replace("{0}", $new_news, WHATSLIM_LAN03) : str_replace("{0}", $new_news, WHATSLIM_LAN04))."<br />" : "");

	// downloads
	$new_files = $sql->db_Count("download", "(*)", "WHERE `download_datestamp` > ".$time);
	$pretext .= ($new_files > 0 ? ($new_files == 1 ? str_replace("{0}", $new_files, WHATSLIM_LAN05) : str_replace("{0}", $new_files, WHATSLIM_LAN06))."<br />" : "");

	// comments
	$new_comments = $sql->db_Count('comments', '(*)', 'WHERE `comment_datestamp` > '.$time);
	$pretext .= ($new_comments > 0 ? ($new_users == 1 ? str_replace("{0}", $new_comments, WHATSLIM_LAN07) : str_replace("{0}", $new_comments, WHATSLIM_LAN08))."<br />" : "");

	// chatbox posts
	if(in_array('chatbox_menu',$eMenuActive)){
		$new_chats = $sql->db_Count('chatbox', '(*)', 'WHERE `cb_datestamp` > '.$time);
		$pretext .= ($new_chats > 0 ? ($new_chats == 1 ? str_replace("{0}", $new_chats, WHATSLIM_LAN09) : str_replace("{0}", $new_chats, WHATSLIM_LAN10))."<br />" : "");
	}

	// forum posts
	if($sql->db_Select_gen("SELECT  count(*) as count FROM #forum_t  as t LEFT JOIN #forum as f ON t.thread_forum_id = f.forum_id WHERE t.thread_datestamp > {$time} and f.forum_class IN (".USERCLASS_LIST.")"))
	{
		$row = $sql->db_Fetch();
		$new_posts = $row['count'];
		$pretext .= ($new_posts > 0 ? ($new_posts == 1 ? str_replace("{0}", $new_posts, WHATSLIM_LAN11) : str_replace("{0}", $new_posts, WHATSLIM_LAN12))."<br />" : "");
	}

	// new members
	$new_users = $sql->db_Count('user', '(user_join)', 'WHERE user_join > '.$time);
	$pretext .= ($new_users > 0 ? ($new_users == 1 ? str_replace("{0}", $new_users, WHATSLIM_LAN13) : str_replace("{0}", $new_users, WHATSLIM_LAN14))."<br />" : "");


	// recent visitors
	$new_visits = $sql->db_Count('users', '(*)', 'WHERE `user_currentvisit` > '.$time);
	$pretext .= ($new_visits > 0 ? ($new_visits == 1 ? str_replace("{0}", $new_visits, WHATSLIM_LAN15) : str_replace("{0}", $new_visits, WHATSLIM_LAN16))."<br />" : "");

	// ------
	$text = (($pretext) ? WHATSLIM_LAN01."<br /><br />\n".$pretext : WHATSLIM_LAN02);

	$ns->tablerender(WHAT_LAN01, $text, 'what_slim');

}
?>