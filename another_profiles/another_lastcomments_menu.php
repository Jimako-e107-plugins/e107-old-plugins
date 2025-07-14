<?php
/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.6
| Copyright © 2008 Istvan Csonka
| http://freedigital.hu
| support@freedigital.hu
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
| (The original program is Alternate Profiles v2.0
| boreded.co.uk)
|
| Another Profiles Plugin comes with
| ABSOLUTELY NO WARRANTY
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
if ($pref['plug_installed']['another_profiles']) {
  if(file_exists(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php");
  } else {
	require_once(e_PLUGIN."another_profiles/languages/English.php");
  }

	$sql->mySQLresult = @mysql_query("SELECT user_lastvisit FROM ".MPREFIX."user WHERE user_id='".USERID."' ");
	$lastvisit = $sql->db_Fetch();

	// PROFILE COMMENTS?
	if ($pref['profile_commentson'] == "ON" || $pref['profile_commentson'] == "") {
		$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."another_profiles_com WHERE com_date > ".$lastvisit['user_lastvisit']." AND com_type='prof' ");
		$comment = $sql->db_Rows();
		if ($comment > 0) {
			$texx .= "<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_comments'><img src='".e_PLUGIN."another_profiles/images/post1.png' border='0' alt='' width='16' height='16' title=".PROFILE_319." /></a>&nbsp;<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_comments'><b>".$comment."</b> ".($comment == 1 ? MENU_PROFILE_2 : MENU_PROFILE_2a)."</a><br/>";
		} else {
			$sql->mySQLresult = @mysql_query("SELECT com_id, com_date FROM ".MPREFIX."another_profiles_com WHERE com_type='prof' ");
			$comment_all = $sql->db_Rows();
			if ($comment_all > 0) {
				$texx .= "<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_comments'><img src='".e_PLUGIN."another_profiles/images/post1.png' border='0' alt='' width='16' height='16' title=".PROFILE_319." /></a>&nbsp;".$comment_all.PROFILE_313."<br/>";
			} else {
				$texx .= "<img src='".e_PLUGIN."another_profiles/images/post1.png' border='0' alt='' width='16' height='16' />&nbsp;".PROFILE_314."<br/>";
			}
		}
	}

	// PICS COMMENTS?
	if ($pref['profile_pics'] == "ON" || $pref['profile_pics'] == "") {
		$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."another_profiles_com WHERE com_date > ".$lastvisit['user_lastvisit']." AND com_type='pics'");
		$piccomment = $sql->db_Rows();
		if ($piccomment > 0) {
			$texx .= "<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_pic_comments'><img src='".e_PLUGIN."another_profiles/images/pict.png' border='0' alt='' width='16' height='16' title=".PROFILE_334." /></a>&nbsp;<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_pic_comments'><b>".$piccomment."</b> ".($piccomment == 1 ? MENU_PROFILE_3 : MENU_PROFILE_3a)."</a><br/>";
		} else {
			$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."another_profiles_com WHERE com_type='pics'");
			$piccomment_all = $sql->db_Rows();
			if ($piccomment_all > 0) {
				$texx .= "<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_pic_comments'><img src='".e_PLUGIN."another_profiles/images/pict.png' border='0' alt='' width='16' height='16' title=".PROFILE_334." /></a>&nbsp;".$piccomment_all.PROFILE_313a."<br/>";
			} else {
				$texx .= "<img src='".e_PLUGIN."another_profiles/images/pict.png' border='0' alt='' width='16' height='16' />&nbsp;".PROFILE_314a."<br/>";
			}
		}
	}

	// VIDEOS COMMENTS?
	if ($pref['profile_videos'] == "ON" || $pref['profile_videos'] == "") {
		$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."another_profiles_com WHERE com_date > ".$lastvisit['user_lastvisit']." AND com_type='vids'");
		$vidcomment = $sql->db_Rows();

		if ($vidcomment > 0) {
			$texx .= "<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_vid_comments'><img src='".e_PLUGIN."another_profiles/images/vid.png' border='0' alt='' width='16' height='16' title=".PROFILE_335." /></a>&nbsp;<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_vid_comments'><b>".$vidcomment."</b> ".MENU_PROFILE_4."</a><br/>";
		} else {
			$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."another_profiles_com WHERE com_type='vids'");
			$vidcomment_all = $sql->db_Rows();
			if ($vidcomment_all > 0) {
				$texx .= "<a href='".e_PLUGIN."another_profiles/lastcomments.php?page=all_vid_comments'><img src='".e_PLUGIN."another_profiles/images/vid.png' border='0' alt='' width='16' height='16' title=".PROFILE_335." /></a>&nbsp;".$vidcomment_all.PROFILE_313b."<br/>";
			} else {
				$texx .= "<img src='".e_PLUGIN."another_profiles/images/vid.png' border='0' alt='' width='16' height='16' />&nbsp;".PROFILE_314b."<br/>";
			}
		}
	}

	$ns -> tablerender("".MENU_PROFILE_6."", $texx);
}
?>