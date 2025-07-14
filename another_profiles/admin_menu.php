<?php

$eplug_admin = TRUE;
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
if(file_exists(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."another_profiles/languages/English.php");
}

if (!ADMIN || !getperms("1")) {
	header("location:".e_BASE."index.php");
	 exit() ;
}

$action = e_QUERY;

require_once(e_ADMIN."auth.php");

if($action == "") {
	$action = "main";
}

if(IsSet($_POST['main_updatesettings'])) {

	if ($action == "main_settings") {
		$pref['profile_redirect_usersettings'] = $_POST['profile_redirect_usersettings'];
		$pref['profile_allowguests'] = intval($_POST['profile_allowguests']);
		$pref['profile_memberlist'] = $_POST['profile_memberlist'];
		$pref['profile_memberlist_accept'] = intval($_POST['profile_memberlist_accept']);
		$pref['profile_friends'] = $_POST['profile_friends'];
		$pref['profile_commentson'] = $_POST['profile_commentson'];
		$pref['profile_pics'] = $_POST['profile_pics'];
		$pref['profile_videos'] = $_POST['profile_videos'];
		$pref['profile_mp3enabled'] = $_POST['profile_mp3enabled'];
		$pref['profile_stats'] = $_POST['profile_stats'];
		save_prefs();
		$message = ADMIN_PROFILE_56;
	}
}

if(IsSet($_POST['memberlist_settings'])) {

	if ($action == "memberlist_settings") {
		$pref['profile_member_info'] = $_POST['profile_member_info'];
		$pref['profile_member_ext_search'] = $_POST['profile_member_ext_search'];
		$pref['profile_memberlist_addtofriend'] = $_POST['profile_memberlist_addtofriend'];
		$pref['profile_memberlist_order'] = $_POST['profile_memberlist_order'];
		$pref['profile_memberlist_bcard'] = $_POST['profile_memberlist_bcard'];
		$pref['profile_bcard_css'] = $_POST['profile_bcard_css'];
		$pref['profile_memberlist_direction'] = $_POST['profile_memberlist_direction'];
		$pref['profile_memberlist_filter'] = intval($_POST['profile_memberlist_filter']);
		$pref['profile_memberlist_class'] = $_POST['profile_memberlist_class'];
		
		$color_pattern = '/^(([a-fA-F0-9]{3}$)|([a-fA-F0-9]{6}$))/';
		if ($_POST['profile_memberlist_color_up'] =="" || preg_match($color_pattern, $_POST['profile_memberlist_color_up'])) {
			$pref['profile_memberlist_color_up'] = $_POST['profile_memberlist_color_up'];
		} else {
			$color_error = 1;
		}
		if ($_POST['profile_memberlist_color_down'] == "" || preg_match($color_pattern, $_POST['profile_memberlist_color_down'])) {
			$pref['profile_memberlist_color_down'] = $_POST['profile_memberlist_color_down'];
		} else {
			$color_error = 1;
		}
		if (isset($_POST['profile_memberlist_forum_info'])) {
			$pref['profile_memberlist_forum_info'] = "ON";
		} else {
			$pref['profile_memberlist_forum_info'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_comment_1_info'])) {
			$pref['profile_memberlist_comment_1_info'] = "ON";
		} else {
			$pref['profile_memberlist_comment_1_info'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_comment_info'])) {
			$pref['profile_memberlist_comment_info'] = "ON";
		} else {
			$pref['profile_memberlist_comment_info'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_pic_info'])) {
			$pref['profile_memberlist_pic_info'] = "ON";
		} else {
			$pref['profile_memberlist_pic_info'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_vid_info'])) {
			$pref['profile_memberlist_vid_info'] = "ON";
		} else {
			$pref['profile_memberlist_vid_info'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_mp3_info'])) {
			$pref['profile_memberlist_mp3_info'] = "ON";
		} else {
			$pref['profile_memberlist_mp3_info'] = "OFF";
		}
		
		if (isset($_POST['profile_memberlist_column_avatar'])) {
			$pref['profile_memberlist_column_avatar'] = "ON";
		} else {
			$pref['profile_memberlist_column_avatar'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_column_online'])) {
			$pref['profile_memberlist_column_online'] = "ON";
		} else {
			$pref['profile_memberlist_column_online'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_column_email'])) {
			$pref['profile_memberlist_column_email'] = "ON";
		} else {
			$pref['profile_memberlist_column_email'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_column_join'])) {
			$pref['profile_memberlist_column_join'] = "ON";
		} else {
			$pref['profile_memberlist_column_join'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_column_lastvisit'])) {
			$pref['profile_memberlist_column_lastvisit'] = "ON";
		} else {
			$pref['profile_memberlist_column_lastvisit'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_column_visits'])) {
			$pref['profile_memberlist_column_visits'] = "ON";
		} else {
			$pref['profile_memberlist_column_visits'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_column_realname'])) {
			$pref['profile_memberlist_column_realname'] = "ON";
		} else {
			$pref['profile_memberlist_column_realname'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_column_loginname'])) {
			$pref['profile_memberlist_column_loginname'] = "ON";
		} else {
			$pref['profile_memberlist_column_loginname'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_column_timezone'])) {
			$pref['profile_memberlist_column_timezone'] = "ON";
		} else {
			$pref['profile_memberlist_column_timezone'] = "OFF";
		}
		if (isset($_POST['profile_memberlist_column_userip'])) {
			$pref['profile_memberlist_column_userip'] = "ON";
		} else {
			$pref['profile_memberlist_column_userip'] = "OFF";
		}

		if (isset($_POST['profile_top_level'])) {
			$pref['profile_top_level'] = "ON";
		} else {
			$pref['profile_top_level'] = "OFF";
		}
		if (isset($_POST['profile_top_forums'])) {
			$pref['profile_top_forums'] = "ON";
		} else {
			$pref['profile_top_forums'] = "OFF";
		}
		if (isset($_POST['profile_top_comments'])) {
			$pref['profile_top_comments'] = "ON";
		} else {
			$pref['profile_top_comments'] = "OFF";
		}
		if (isset($_POST['profile_top_chatbox'])) {
			$pref['profile_top_chatbox'] = "ON";
		} else {
			$pref['profile_top_chatbox'] = "OFF";
		}
		if (isset($_POST['profile_top_rate'])) {
			$pref['profile_top_rate'] = "ON";
		} else {
			$pref['profile_top_rate'] = "OFF";
		}
		if (isset($_POST['profile_top_profile'])) {
			$pref['profile_top_profile'] = "ON";
		} else {
			$pref['profile_top_profile'] = "OFF";
		}
		if (isset($_POST['profile_top_friends'])) {
			$pref['profile_top_friends'] = "ON";
		} else {
			$pref['profile_top_friends'] = "OFF";
		}

		$sql->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'");
		$extended_codes_src = "|";
		$extended_codes_col = "|";
		if (isset($_POST['user_search_username'])) {
			$extended_codes_src = "".$extended_codes_src."username|";
		}
		if (isset($_POST['user_search_email'])) {
			$extended_codes_src = "".$extended_codes_src."email|";
		}
		if (isset($_POST['user_search_realname'])) {
			$extended_codes_src = "".$extended_codes_src."realname|";
		}
		if (isset($_POST['user_search_loginname'])) {
			$extended_codes_src = "".$extended_codes_src."loginname|";
		}
		if (isset($_POST['user_search_ip'])) {
			$extended_codes_src = "".$extended_codes_src."ip_address|";
		}
		if (isset($_POST['user_search_groupname'])) {
			$extended_codes_src = "".$extended_codes_src."groupname|";
		}
		while($row = $sql->db_Fetch()) {
			if (isset($_POST["s_".$row['user_extended_struct_id'].""])) {
				$extended_codes_src = "".$extended_codes_src."s_".$row['user_extended_struct_id']."|";
			}
			if (isset($_POST["c_".$row['user_extended_struct_id'].""])) {
				$extended_codes_col = "".$extended_codes_col."c_".$row['user_extended_struct_id']."|";
			}
		}
		$sql -> db_Select("another_profiles_memberlist", "*");
		$count = $sql -> db_Rows();
		if ($count == 0) {
			$sql -> db_Insert("another_profiles_memberlist", "'', '".$extended_codes_src."', '' ");
			$sql -> db_Insert("another_profiles_memberlist", "'', '', '".$extended_codes_col."' ");
		} else {
			$sql -> db_Update("another_profiles_memberlist", "memberlist_search='".$extended_codes_src."'");
			$sql -> db_Update("another_profiles_memberlist", "memberlist_columns='".$extended_codes_col."'");
		}
		$pref['profile_top_class'] = $_POST['profile_top_class'];
		$n_pattern = "/^[0-9]+$/";
		if (preg_match($n_pattern, $_POST['profile_top_x'])) {
			$pref['profile_top_x'] = $_POST['profile_top_x'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_bcard_column'])) {
			$pref['profile_bcard_column'] = $_POST['profile_bcard_column'];
		} else if (($_POST['profile_bcard_column']) == ""){
			$pref['profile_bcard_column'] = 3;
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_top_bcard_column'])) {
			$pref['profile_top_bcard_column'] = $_POST['profile_top_bcard_column'];
		} else if (($_POST['profile_top_bcard_column']) == ""){
			$pref['profile_top_bcard_column'] = 1;
		} else {
			$n_error = 1;
		}
		$pref['profile_top_noadmin'] = $_POST['profile_top_noadmin'];
		save_prefs();
		if ($color_error) {
			$message = ADMIN_PROFILE_206;
		} else 	if ($n_error) {
			$message = ADMIN_PROFILE_207;
		} else {
			$message = ADMIN_PROFILE_56;
		}
	}
}
if(IsSet($_POST['updatesettings'])) {

	$n_pattern = "/^[0-9]+$/";
	if ($action == "settings") {
		if (isset($_POST['profile_youtube'])) {
			$pref['profile_youtube'] = "ON";
		} else {
			$pref['profile_youtube'] = "OFF";
		}
		if (isset($_POST['profile_vimeo'])) {
			$pref['profile_vimeo'] = "ON";
		} else {
			$pref['profile_vimeo'] = "OFF";
		}
		if (isset($_POST['profile_metacafe'])) {
			$pref['profile_metacafe'] = "ON";
		} else {
			$pref['profile_metacafe'] = "OFF";
		}
		if (isset($_POST['profile_indavideo'])) {
			$pref['profile_indavideo'] = "ON";
		} else {
			$pref['profile_indavideo'] = "OFF";
		}
		if (preg_match($n_pattern, $_POST['profile_apcomments'])) {
			$pref['profile_apcomments'] = $_POST['profile_apcomments'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_frcol'])) {
			$pref['profile_frcol'] = $_POST['profile_frcol'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_maxuploadsize'])) {
			$pref['profile_maxuploadsize'] = $_POST['profile_maxuploadsize'];
		} else {
			$n_error = 1;
		}
		if ($_POST['profile_avatarwidth'] == "" || preg_match($n_pattern, $_POST['profile_avatarwidth'])) {
			$pref['profile_avatarwidth'] = $_POST['profile_avatarwidth'];
		} else {
			$n_error = 1;
		}
		if ($_POST['profile_avatarheight'] == "" || preg_match($n_pattern, $_POST['profile_avatarheight'])) {
			$pref['profile_avatarheight'] = $_POST['profile_avatarheight'];
		} else {
			$n_error = 1;
		}
		if ($_POST['profile_imagewidth'] == "" || preg_match($n_pattern, $_POST['profile_imagewidth'])) {
			$pref['profile_imagewidth'] = $_POST['profile_imagewidth'];
		} else {
			$n_error = 1;
		}
		if ($_POST['profile_imageheight'] == "" || preg_match($n_pattern, $_POST['profile_imageheight'])) {
			$pref['profile_imageheight'] = $_POST['profile_imageheight'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_indmaxuploadsize'])) {
			$pref['profile_indmaxuploadsize'] = $_POST['profile_indmaxuploadsize'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_maxnovids'])) {
			$pref['profile_maxnovids'] = $_POST['profile_maxnovids'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_videowidth'])) {
			$pref['profile_videowidth'] = $_POST['profile_videowidth'];
		} else {
			$n_error = 1;
		}
		$pref['profile_buttontype'] = $_POST['profile_buttontype'];
		$pref['profile_lastupdate_filter'] = intval($_POST['profile_lastupdate_filter']);
		$pref['profile_updateddirection'] = $_POST['profile_updateddirection'];
		if (preg_match($n_pattern, $_POST['profile_updatedtotal'])) {
			$pref['profile_updatedtotal'] = $_POST['profile_updatedtotal'];
		} else if (($_POST['profile_updatedtotal']) == ""){
			$pref['profile_updatedtotal'] = 3;
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_updatedtotal_col'])) {
			$pref['profile_updatedtotal_col'] = $_POST['profile_updatedtotal_col'];
		} else if (($_POST['profile_updatedtotal_col']) == ""){
			$pref['profile_updatedtotal_col'] = 4;
		} else {
			$n_error = 1;
		}
		$pref['profile_redirect'] = $_POST['profile_redirect'];
		$pref['profile_mp3'] = $_POST['profile_mp3'];
		if (preg_match($n_pattern, $_POST['profile_mp3size'])) {
			$pref['profile_mp3size'] = $_POST['profile_mp3size'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_mp3_volume'])) {
			$pref['profile_mp3_volume'] = $_POST['profile_mp3_volume'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_picviewsize'])) {
			$pref['profile_picviewsize'] = $_POST['profile_picviewsize'];
		} else {
			$n_error = 1;
		}
		$pref['profile_lightbox'] = $_POST['profile_lightbox'];
		$pref['profile_lightwindowbox'] = $_POST['profile_lightwindowbox'];
		$pref['profile_lightview'] = $_POST['profile_lightview'];
		$pref['profile_clearbox'] = $_POST['profile_clearbox'];
		$pref['profile_mp3_autoplay'] = $_POST['profile_mp3_autoplay'];
		$pref['profile_mp3_loop'] = $_POST['profile_mp3_loop'];
		if (preg_match($n_pattern, $_POST['profile_maxpcomment'])) {
			$pref['profile_maxpcomment'] = $_POST['profile_maxpcomment'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_maxpiccomment'])) {
			$pref['profile_maxpiccomment'] = $_POST['profile_maxpiccomment'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_maxvidcomment'])) {
			$pref['profile_maxvidcomment'] = $_POST['profile_maxvidcomment'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_maxalbumnumber'])) {
			$pref['profile_maxalbumnumber'] = $_POST['profile_maxalbumnumber'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_maxpicnumber'])) {
			$pref['profile_maxpicnumber'] = $_POST['profile_maxpicnumber'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_piccol'])) {
			$pref['profile_piccol'] = $_POST['profile_piccol'];
		} else {
			$n_error = 1;
		}
		$pref['profile_kepekezet'] = $_POST['profile_kepekezet'];
		$pref['profile_user_image'] = $_POST['profile_user_image'];
		$pref['profile_unreg'] = $_POST['profile_unreg'];
		$pref['profile_fr_req_sendpm'] = $_POST['profile_fr_req_sendpm'];
		$pref['profile_fr_req_sendemail'] = $_POST['profile_fr_req_sendemail'];
		$pref['profile_unreg_save'] = $_POST['profile_unreg_save'];
		$pref['profile_user_warn_support'] = $_POST['profile_user_warn_support'];
		$pref['profile_imagick_support'] = $_POST['profile_imagick_support'];
		$pref['profile_private_albums'] = $_POST['profile_private_albums'];
		$pref['profile_fr_req_sendpm_all'] = $_POST['profile_fr_req_sendpm_all'];
		$pref['profile_fr_req_sendemail_all'] = $_POST['profile_fr_req_sendemail_all'];
		$pref['profile_comments_spy'] = intval($_POST['profile_comments_spy']);
		if (preg_match($n_pattern, $_POST['profile_comments_spy_num'])) {
			$pref['profile_comments_spy_num'] = $_POST['profile_comments_spy_num'];
		} else {
			$n_error = 1;
		}
		if (preg_match($n_pattern, $_POST['profile_comments_spy_pic_size'])) {
			$pref['profile_comments_spy_pic_size'] = $_POST['profile_comments_spy_pic_size'];
		} else {
			$n_error = 1;
		}
		save_prefs();
		if ($n_error) {
			$message = ADMIN_PROFILE_207;
		} else {
			$message = ADMIN_PROFILE_56;
		}
		if ($_POST['profile_user_image'] == 100 || $_POST['profile_user_image'] == 150 || $_POST['profile_user_image'] == 200) {
			mysql_query("ALTER TABLE `".MPREFIX."user` CHANGE `user_image` `user_image` VARCHAR( ".$_POST['profile_user_image']." ) NOT NULL;");
		}
	}
}

if(IsSet($_POST['updatesettings'])) {

	if ($action == "user_delete") {
		if($_POST['deluser_name_ok'] == "on" && $_POST['deluser_id_ok'] == "on") {
			$deluser_name = $_POST['deluser_name'];
			$unreg_id = intval($_POST['deluser_id']);
			//USER DELETE
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_join, user_ip FROM ".MPREFIX."user WHERE user_id=$unreg_id ");
			$new = $sql->db_Fetch();
			$unreg_db = new DB;
			if ($unreg_db->db_Delete("user", "user_id = '" . $unreg_id . "' ")) {
				//Delete User Friends
				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends FROM ".MPREFIX."another_profiles WHERE user_id='".$unreg_id."' ");
				$new = $sql->db_Fetch();
				$check = explode("|", $new['user_friends']);
				$unreg_user_friends = $new['user_friends'];
				foreach($check as $tick) {
					$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$tick."' ");
					$new = $sql->db_Fetch();
					$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$unreg_id."' ");
					$new2 = $sql->db_Fetch();
					$newfriends = str_replace("|".$unreg_id."|" , "|", $new['user_friends']);
					$newfriends = str_replace("  " , " ", $newfriends);
					if($newfriends == ' 0') {
						$newfriends = '';
					}
					$newfriends2 = str_replace("|".$tick."|" , "|", $new2['user_friends']);
					$newfriends2 = str_replace("  " , " ", $newfriends2);
					if($newfriends2 == ' 0') {
						$newfriends2 = '';
					}
					$sql -> db_Update("another_profiles", "user_friends='".$newfriends."' WHERE user_id='".$tick."' ");
					$sql -> db_Update("another_profiles", "user_friends='".$newfriends2."' WHERE user_id='".$unreg_id."' ");
				}
				//Delete Friend Requests
				$friend = "|";
				$query = "SELECT user_id, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_friends_request like '%|".$unreg_id."|%' ";
				$result = mysql_query($query);
				while($noticia = mysql_fetch_array($result)) {
					$friend = $friend.$noticia["user_id"]."|";
				}
				$friend = explode("|", $friend);
				if ($friend[1] == '') {
				} else {
					foreach ($friend as $fr) {
						if ($fr == '') {
						} else {
							$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$fr."' ");
							$new = $sql->db_Fetch();
							$newfriends = str_replace("|".$unreg_id."|" , "|", $new['user_friends_request']);
							$newfriends = str_replace("  " , " ", $newfriends);
							if($newfriends == ' 0') {
								$newfriends = '';
							}
							$sql -> db_Update("another_profiles", "user_friends_request='".$newfriends."' WHERE user_id='".$fr."' ");
						}

					}
				}
				//Delete User Tables
				$unreg_db->db_Delete("another_profiles", "user_id = '" . $unreg_id . "'");
				$unreg_db->db_Delete("another_profiles_com", "com_by = '" . $unreg_id . "'");
				$unreg_db->db_Delete("another_profiles_com", "com_to = '" . $unreg_id . "'");
				$unreg_db->db_Delete("another_profiles_vids", "vid_uid = '" . $unreg_id . "'");
				$unreg_db->db_Delete("user", "user_id = '" . $unreg_id . "'");
				$unreg_db->db_Delete("user_extended", "user_extended_id = '" . $unreg_id . "'");
				//Move Or Delete User Pictures
				$userimagedir = "userimages/".$unreg_id."";
				$rand_code = rand(100000, 999999);
				if ($pref['profile_unreg_save'] == 'Yes') {
					if (is_dir($userimagedir)) {
						$new_imagedir = "userimages/unreg_".$rand_code."_". $unreg_id ."";
						rename($userimagedir, $new_imagedir);
						function unlinkIndex($dir) {
							if (preg_match("/\/index.htm/", $dir)) {
								unlink($dir);
							}
							if(!$dh = @opendir($dir)) {
								return;
							}
							while (false !== ($obj = readdir($dh))) {
								if($obj == '.' || $obj == '..') {
									continue;
								}
							unlinkIndex($dir.'/'.$obj);
							}
							closedir($dh);
							return;
						}
						unlinkIndex($new_imagedir);
					}
				} else {
					function delete_directory($userimagedir) {
						if (is_dir($userimagedir)) $dir_handle = opendir($userimagedir);
						if (!$dir_handle) return false;
						while($file = readdir($dir_handle)) {
							if ($file != "." && $file != "..") {
								if (!is_dir($userimagedir."/".$file)) unlink($userimagedir."/".$file);
								else delete_directory($userimagedir.'/'.$file);          
							}
						}
						closedir($dir_handle);
						rmdir($userimagedir);
						return true;
					}
					delete_directory($userimagedir);
				}
				//Move Or Delete User MP3
				$usermp3file = "usermp3/".$unreg_id.".mp3";
				if (file_exists($usermp3file)) {
					if ($pref['profile_unreg_save'] == 'Yes') {
						$newusermp3file = "usermp3/unreg_".$rand_code."_".$unreg_id.".mp3";
						rename($usermp3file, $newusermp3file);
					} else {
						unlink($usermp3file);
					}
				}
				$unreg_ok = true;
			// MESSAGE
			}
			$ns->tablerender("".ADMIN_PROFILE_89."");
			$message .= "".ADMIN_PROFILE_96."<br/>".$deluser_name." ID:".$unreg_id."<br/>".ADMIN_PROFILE_97."<br/><br/><a href=".e_ADMIN."users.php>".ADMIN_PROFILE_99."</a>";
		} else {
			$message .= "".ADMIN_PROFILE_98."<br/><br/><a href=".e_ADMIN."users.php>".ADMIN_PROFILE_99."</a>";
		}
	}
}

if($message){
	$ns -> tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}

if($action == "main") {
	$ns->tablerender("".ADMIN_PROFILE_57."", show_main());
}
if($action == "settings") {
	$ns->tablerender("".ADMIN_PROFILE_58."", show_settings());
}

if($action == "main_settings") {
	$ns->tablerender("".ADMIN_PROFILE_66."", show_main_settings());
}

if($action == "memberlist_settings") {
	$ns->tablerender("".ADMIN_PROFILE_173."", memberlist_settings());
}

if($action == "phpinfo") {
	$ns->tablerender("".ADMIN_PROFILE_104."", show_php());
}

if($action == "update") {
	$ns->tablerender("".PROFILE_428."", show_update());
}	
	
if ($_GET['page'] == "deluser") {
	$deluser_id =  $_GET['deluser_id'];
	$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id='".$deluser_id."' ");
	$deluser_row = $sql->db_Fetch();
	$deluser_name = $deluser_row['user_name'];
	$ns->tablerender("".ADMIN_PROFILE_89."", show_deluser($deluser_id, $deluser_name));
}

function show_main() {
	global $pref;
	$txt = "
	
	<table class='fborder' style='width:95%'>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/ap_logo.png' border='0' alt='' /><br/>".ADMIN_PROFILE_1."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%'>".ADMIN_PROFILE_1e."</td>
		<td class='forumheader3' style='width:80%'>".ADMIN_PROFILE_1f."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%'>".ADMIN_PROFILE_1a."</td>
		<td class='forumheader3' style='width:80%'>".ADMIN_PROFILE_1b."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%'>".ADMIN_PROFILE_1c."</td>
		<td class='forumheader3' style='width:80%'>".ADMIN_PROFILE_1d."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%'>".ADMIN_PROFILE_1k."</td>
		<td class='forumheader3' style='width:80%'>".ADMIN_PROFILE_1l."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%'>".ADMIN_PROFILE_1m."</td>
		<td class='forumheader3' style='width:80%'>".ADMIN_PROFILE_60."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%'>".ADMIN_PROFILE_1i."</td>
		<td class='forumheader3' style='width:80%'>".ADMIN_PROFILE_1j."</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:20%'>".ADMIN_PROFILE_1g."</td>
		<td class='forumheader3' style='width:80%'>".ADMIN_PROFILE_1h."</td>
	</tr>	

	</table>
	<br/><br/><hr/><br/><br/>";
	return $txt;
}

function show_main_settings() {
	global $pref;
	require_once(e_HANDLER."userclass_class.php");
	$txt .= "
	<form method='post' action='".e_SELF."?main_settings'>
	<table class='fborder' style='width:95%'>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><center>".ADMIN_PROFILE_50."</center></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'><img src='".e_PLUGIN."another_profiles/images/userdel.png' style='border: 0px solid black; width: 32px; height: 32px; float: left; margin-right: 10px' />".ADMIN_PROFILE_65."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_redirect_usersettings'>".
		($pref['profile_redirect_usersettings'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_redirect_usersettings'] == 'No' || $pref['profile_redirect_usersettings'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'><img src='".e_PLUGIN."another_profiles/images/key_profile.png' style='border: 0px solid black; width: 32px; height: 32px; float: left; margin-right: 10px' />".ADMIN_PROFILE_7."</td>
		<td class='forumheader3' style='width:30%'>".r_userclass('profile_allowguests',$pref['profile_allowguests'],"off","public,member,admin,main,classes")."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'><img src='".e_PLUGIN."another_profiles/images/fr.png' style='border: 0px solid black; width: 32px; height: 32px; float: left; margin-right: 10px' />".ADMIN_PROFILE_55."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_memberlist'>".
		($pref['profile_memberlist'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_memberlist'] == 'No' || $pref['profile_memberlist'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'><img src='".e_PLUGIN."another_profiles/images/key_memberlist.png' style='border: 0px solid black; width: 32px; height: 32px; float: left; margin-right: 10px' />".ADMIN_PROFILE_172."</td>
		<td class='forumheader3' style='width:30%'>".r_userclass('profile_memberlist_accept',$pref['profile_memberlist_accept'],"off","public,member,admin,main,classes")."</td>
	</tr>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><center>".ADMIN_PROFILE_24."</center></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'><img src='".e_PLUGIN."another_profiles/images/pm_old.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_25."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_friends'>".
		($pref['profile_friends'] == 'ON' ? "<option value='ON' selected='selected'>".ADMIN_PROFILE_48a."</option>" : "<option value='ON'>".ADMIN_PROFILE_48a."</option>").
		($pref['profile_friends'] == 'OFF' || $pref['profile_friends'] == '' ? "<option value='OFF' selected='selected'>".ADMIN_PROFILE_49a."</option>" : "<option value='OFF'>".ADMIN_PROFILE_49a."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'><img src='".e_PLUGIN."another_profiles/images/post1.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_26."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_commentson'>".
		($pref['profile_commentson'] == 'ON' ? "<option value='ON' selected='selected'>".ADMIN_PROFILE_48a."</option>" : "<option value='ON'>".ADMIN_PROFILE_48a."</option>").
		($pref['profile_commentson'] == 'OFF' || $pref['profile_commentson'] == '' ? "<option value='OFF' selected='selected'>".ADMIN_PROFILE_49a."</option>" : "<option value='OFF'>".ADMIN_PROFILE_49a."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'><img src='".e_PLUGIN."another_profiles/images/pict.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_27."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_pics'>".
		($pref['profile_pics'] == 'ON' ? "<option value='ON' selected='selected'>".ADMIN_PROFILE_48a."</option>" : "<option value='ON'>".ADMIN_PROFILE_48a."</option>").
		($pref['profile_pics'] == 'OFF' || $pref['profile_pics'] == '' ? "<option value='OFF' selected='selected'>".ADMIN_PROFILE_49a."</option>" : "<option value='OFF'>".ADMIN_PROFILE_49a."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'><img src='".e_PLUGIN."another_profiles/images/vid.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_28."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_videos'>".
		($pref['profile_videos'] == 'ON' ? "<option value='ON' selected='selected'>".ADMIN_PROFILE_48a."</option>" : "<option value='ON'>".ADMIN_PROFILE_48a."</option>").
		($pref['profile_videos'] == 'OFF' || $pref['profile_videos'] == '' ? "<option value='OFF' selected='selected'>".ADMIN_PROFILE_49a."</option>" : "<option value='OFF'>".ADMIN_PROFILE_49a."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'><img src='".e_PLUGIN."another_profiles/images/mp3.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_45."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_mp3enabled'>".
		($pref['profile_mp3enabled'] == 'ON' ? "<option value='ON' selected='selected'>".ADMIN_PROFILE_48a."</option>" : "<option value='ON'>".ADMIN_PROFILE_48a."</option>").
		($pref['profile_mp3enabled'] == 'OFF' || $pref['profile_mp3enabled'] == '' ? "<option value='OFF' selected='selected'>".ADMIN_PROFILE_49a."</option>" : "<option value='OFF'>".ADMIN_PROFILE_49a."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'><img src='".e_PLUGIN."another_profiles/images/stat.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_39."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_stats'>".
		($pref['profile_stats'] == 'ON' ? "<option value='ON' selected='selected'>".ADMIN_PROFILE_48a."</option>" : "<option value='ON'>".ADMIN_PROFILE_48a."</option>").
		($pref['profile_stats'] == 'OFF' || $pref['profile_stats'] == '' ? "<option value='OFF' selected='selected'>".ADMIN_PROFILE_49a."</option>" : "<option value='OFF'>".ADMIN_PROFILE_49a."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader' colspan='2' style='text-align:center'><input type='submit' class='button' name='main_updatesettings' value='".PROFILE_222."' /></td>
	</tr>
	</table>
	</form>
	<br/><br/>";
	return $txt;
}

function memberlist_settings() {
	global $pref,$sql,$tp;

	require_once(e_HANDLER."userclass_class.php");
	if ($pref['profile_memberlist_forum_info'] == "ON" || $pref['profile_memberlist_forum_info'] == "") {
		$profile_memberlist_forum_info = "checked='yes'";
	}
	if ($pref['profile_memberlist_comment_1_info'] == "ON" || $pref['profile_memberlist_comment_1_info'] == "") {
		$profile_memberlist_comment_1_info = "checked='yes'";
	}
	if ($pref['profile_memberlist_comment_info'] == "ON" || $pref['profile_memberlist_comment_info'] == "") {
		$profile_memberlist_comment_info = "checked='yes'";
	}
	if ($pref['profile_memberlist_pic_info'] == "ON" || $pref['profile_memberlist_pic_info'] == "") {
		$profile_memberlist_pic_info = "checked='yes'";
	}
	if ($pref['profile_memberlist_vid_info'] == "ON" || $pref['profile_memberlist_vid_info'] == "") {
		$profile_memberlist_vid_info = "checked='yes'";
	}
	if ($pref['profile_memberlist_mp3_info'] == "ON" || $pref['profile_memberlist_mp3_info'] == "") {
		$profile_memberlist_mp3_info = "checked='yes'";
	}
	if ($pref['profile_memberlist_column_avatar'] == "ON" || $pref['profile_memberlist_column_avatar'] == "") {
		$profile_memberlist_column_avatar = "checked='yes'";
	}
	if ($pref['profile_memberlist_column_online'] == "ON" || $pref['profile_memberlist_column_online'] == "") {
		$profile_memberlist_column_online = "checked='yes'";
	}
	if ($pref['profile_memberlist_column_email'] == "ON" || $pref['profile_memberlist_column_email'] == "") {
		$profile_memberlist_column_email = "checked='yes'";
	}
	if ($pref['profile_memberlist_column_join'] == "ON" || $pref['profile_memberlist_column_join'] == "") {
		$profile_memberlist_column_join = "checked='yes'";
	}
	if ($pref['profile_memberlist_column_lastvisit'] == "ON" || $pref['profile_memberlist_column_lastvisit'] == "") {
		$profile_memberlist_column_lastvisit = "checked='yes'";
	}
	if ($pref['profile_memberlist_column_visits'] == "ON" || $pref['profile_memberlist_column_visits'] == "") {
		$profile_memberlist_column_visits = "checked='yes'";
	}

	if ($pref['profile_memberlist_column_realname'] == "ON") {
		$profile_memberlist_column_realname = "checked='yes'";
	}
	if ($pref['profile_memberlist_column_loginname'] == "ON") {
		$profile_memberlist_column_loginname = "checked='yes'";
	}
	if ($pref['profile_memberlist_column_timezone'] == "ON") {
		$profile_memberlist_column_timezone = "checked='yes'";
	}
	if ($pref['profile_memberlist_column_userip'] == "ON") {
		$profile_memberlist_column_userip = "checked='yes'";
	}

	if ($pref['profile_top_level'] == "ON") {
		$profile_top_level = "checked='yes'";
	}
	if ($pref['profile_top_forums'] == "ON") {
		$profile_top_forums = "checked='yes'";
	}
	if ($pref['profile_top_comments'] == "ON") {
		$profile_top_comments = "checked='yes'";
	}
	if ($pref['profile_top_chatbox'] == "ON") {
		$profile_top_chatbox = "checked='yes'";
	}
	if ($pref['profile_top_rate'] == "ON") {
		$profile_top_rate = "checked='yes'";
	}
	if ($pref['profile_top_profile'] == "ON") {
		$profile_top_profile = "checked='yes'";
	}
	if ($pref['profile_top_friends'] == "ON") {
		$profile_top_friends = "checked='yes'";
	}

	$sql->mySQLresult = @mysql_query("SELECT memberlist_search FROM ".MPREFIX."another_profiles_memberlist ");
	$search_settings = $sql->db_Fetch();
	$search_settings = $search_settings['memberlist_search'];
	$search_selected = "";

	$sql->mySQLresult = @mysql_query("SELECT memberlist_columns FROM ".MPREFIX."another_profiles_memberlist ");
	$columns_settings = $sql->db_Fetch();
	$columns_settings = $columns_settings['memberlist_columns'];
	$columns_selected = "";

	$pmatch = "/\|email\|/";
	if (preg_match($pmatch, $search_settings)) {
		$user_search_email = "checked='yes'";
	}
	$pmatch = "/\|username\|/";
	if (preg_match($pmatch, $search_settings)) {
		$user_search_username = "checked='yes'";
	}
	$pmatch = "/\|realname\|/";
	if (preg_match($pmatch, $search_settings)) {
		$user_search_realname = "checked='yes'";
	}
	$pmatch = "/\|loginname\|/";
	if (preg_match($pmatch, $search_settings)) {
		$user_search_loginname = "checked='yes'";
	}
	$pmatch = "/\|ip_address\|/";
	if (preg_match($pmatch, $search_settings)) {
		$user_search_ip = "checked='yes'";
	}
	$pmatch = "/\|groupname\|/";
	if (preg_match($pmatch, $search_settings)) {
		$user_search_groupname = "checked='yes'";
	}
	if ($pref['profile_memberlist_class']) {
		$profile_memberlist_class = $pref['profile_memberlist_class'];
	} else {
		$profile_memberlist_class = "button";
	}
	$txt .= "
	<form method='post' action='".e_SELF."?memberlist_settings'>
	<table class='fborder' style='width:95%'>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><center>".ADMIN_PROFILE_173."</center></td>
	</tr>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/logo_small.jpg' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_174."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_166."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_memberlist_direction'>".
		($pref['profile_memberlist_direction'] == 'user_name' || $pref['profile_memberlist_direction'] == '' ? "<option value='user_name' selected='selected'>".ADMIN_PROFILE_167."</option>" : "<option value='user_name'>".ADMIN_PROFILE_167."</option>").
		($pref['profile_memberlist_direction'] == 'user_email' ? "<option value='user_email' selected='selected'>".ADMIN_PROFILE_168."</option>" : "<option value='user_email'>".ADMIN_PROFILE_168."</option>").
		($pref['profile_memberlist_direction'] == 'user_id' ? "<option value='user_id' selected='selected'>".ADMIN_PROFILE_169."</option>" : "<option value='user_id'>".ADMIN_PROFILE_169."</option>").
		($pref['profile_memberlist_direction'] == 'user_currentvisit' ? "<option value='user_currentvisit' selected='selected'>".ADMIN_PROFILE_170."</option>" : "<option value='user_currentvisit'>".ADMIN_PROFILE_170."</option>").
		($pref['profile_memberlist_direction'] == 'user_visits' ? "<option value='user_visits' selected='selected'>".ADMIN_PROFILE_171."</option>" : "<option value='user_visits'>".ADMIN_PROFILE_171."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_163."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_memberlist_order'>".
		($pref['profile_memberlist_order'] == 'ASC' || $pref['profile_memberlist_order'] == '' ? "<option value='ASC' selected='selected'>".ADMIN_PROFILE_164."</option>" : "<option value='ASC'>".ADMIN_PROFILE_164."</option>").
		($pref['profile_memberlist_order'] == 'DESC' ? "<option value='DESC' selected='selected'>".ADMIN_PROFILE_165."</option>" : "<option value='DESC'>".ADMIN_PROFILE_165."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_225."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_memberlist_bcard'>".
		($pref['profile_memberlist_bcard'] == 'line' || $pref['profile_memberlist_bcard'] == '' ? "<option value='line' selected='selected'>".ADMIN_PROFILE_226."</option>" : "<option value='line'>".ADMIN_PROFILE_226."</option>").
		($pref['profile_memberlist_bcard'] == 'bcard' ? "<option value='bcard' selected='selected'>".ADMIN_PROFILE_227."</option>" : "<option value='bcard'>".ADMIN_PROFILE_227."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_229."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_bcard_css'>".
		($pref['profile_bcard_css'] == 'auto' ? "<option value='auto' selected='selected'>".ADMIN_PROFILE_237."</option>" : "<option value='auto'>".ADMIN_PROFILE_237."</option>").
		($pref['profile_bcard_css'] == 'lite' || $pref['profile_bcard_css'] == '' ? "<option value='lite' selected='selected'>".ADMIN_PROFILE_230."</option>" : "<option value='lite'>".ADMIN_PROFILE_230."</option>").
		($pref['profile_bcard_css'] == 'dark' ? "<option value='dark' selected='selected'>".ADMIN_PROFILE_231."</option>" : "<option value='dark'>".ADMIN_PROFILE_231."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_228."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_bcard_column' value='".$pref['profile_bcard_column']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_208."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_memberlist_class' value='".$profile_memberlist_class."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_204."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_memberlist_color_up' value='".$pref['profile_memberlist_color_up']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_205."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_memberlist_color_down' value='".$pref['profile_memberlist_color_down']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_205a."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_memberlist_addtofriend'>".
		($pref['profile_memberlist_addtofriend'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_memberlist_addtofriend'] == 'No' || $pref['profile_memberlist_addtofriend'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_182."</td>
		<td class='forumheader3' style='width:30%'>
		<input type='checkbox' name='profile_memberlist_column_avatar' ".$profile_memberlist_column_avatar."> ".ADMIN_PROFILE_183."<br/>
		<input type='checkbox' name='profile_memberlist_column_online' ".$profile_memberlist_column_online."> ".ADMIN_PROFILE_184."<br/>
		<input type='checkbox' name='profile_memberlist_column_realname' ".$profile_memberlist_column_realname."> ".ADMIN_PROFILE_190."<br/>
		<input type='checkbox' name='profile_memberlist_column_loginname' ".$profile_memberlist_column_loginname."> ".ADMIN_PROFILE_191."<br/>
		<input type='checkbox' name='profile_memberlist_column_email' ".$profile_memberlist_column_email."> ".ADMIN_PROFILE_185."<br/>
		<input type='checkbox' name='profile_memberlist_column_join' ".$profile_memberlist_column_join."> ".ADMIN_PROFILE_186."<br/>
		<input type='checkbox' name='profile_memberlist_column_lastvisit' ".$profile_memberlist_column_lastvisit."> ".ADMIN_PROFILE_187."<br/>
		<input type='checkbox' name='profile_memberlist_column_visits' ".$profile_memberlist_column_visits."> ".ADMIN_PROFILE_188."<br/>
		<input type='checkbox' name='profile_memberlist_column_timezone' ".$profile_memberlist_column_timezone."> ".ADMIN_PROFILE_192."<br/>
		<input type='checkbox' name='profile_memberlist_column_userip' ".$profile_memberlist_column_userip."> ".ADMIN_PROFILE_193."<br/>
		";
		if($sql->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
			require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_user_extended.php");
			while($row = $sql->db_Fetch()) {
				$user_extended_struct_text = ($tp->toHtml($row['user_extended_struct_text'],FALSE,"defs")).""; 
				$columns_selected = "";
				$pmatch = "/\|c_".$row['user_extended_struct_id']."\|/";
				if (preg_match($pmatch, $columns_settings)) {
					$columns_selected = "checked='yes'";
				}
				$txt .= "<input type='checkbox' name='c_".$row['user_extended_struct_id']."' ".$columns_selected."> ".$user_extended_struct_text."<br/>";
			}
		}

	$txt .= "</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_189."</td>
		<td class='forumheader3' style='width:30%'>".r_userclass('profile_memberlist_filter',$pref['profile_memberlist_filter'],"off","public,member,admin,main,classes")."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_82."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_member_info'>".
		($pref['profile_member_info'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_member_info'] == 'No' || $pref['profile_member_info'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_181."</td>
		<td class='forumheader3' style='width:30%'>
		<input type='checkbox' name='profile_memberlist_forum_info' ".$profile_memberlist_forum_info."> ".ADMIN_PROFILE_175."<br/>
		<input type='checkbox' name='profile_memberlist_comment_1_info' ".$profile_memberlist_comment_1_info."> ".ADMIN_PROFILE_176."<br/>
		<input type='checkbox' name='profile_memberlist_comment_info' ".$profile_memberlist_comment_info."> ".ADMIN_PROFILE_177."<br/>
		<input type='checkbox' name='profile_memberlist_pic_info' ".$profile_memberlist_pic_info."> ".ADMIN_PROFILE_178."<br/>
		<input type='checkbox' name='profile_memberlist_vid_info' ".$profile_memberlist_vid_info."> ".ADMIN_PROFILE_179."<br/>
		<input type='checkbox' name='profile_memberlist_mp3_info' ".$profile_memberlist_mp3_info."> ".ADMIN_PROFILE_180."<br/>
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_197."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_member_ext_search'>".
		($pref['profile_member_ext_search'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_member_ext_search'] == 'No' || $pref['profile_member_ext_search'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_194."</td>
		<td class='forumheader3' style='width:30%'>
		<input type='checkbox' name='user_search_username' ".$user_search_username."> ".ADMIN_PROFILE_196."<br/>
		<input type='checkbox' name='user_search_realname' ".$user_search_realname."> ".ADMIN_PROFILE_190."<br/>
		<input type='checkbox' name='user_search_loginname' ".$user_search_loginname."> ".ADMIN_PROFILE_191."<br/>
		<input type='checkbox' name='user_search_email' ".$user_search_email."> ".ADMIN_PROFILE_195."<br/>
	";
	if($sql->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
		require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_user_extended.php");
		while($row = $sql->db_Fetch()) {
			$user_extended_struct_text = ($tp->toHtml($row['user_extended_struct_text'],FALSE,"defs")).""; 
			$search_selected = "";
			$pmatch = "/\|s_".$row['user_extended_struct_id']."\|/";
			if (preg_match($pmatch, $search_settings)) {
				$search_selected = "checked='yes'";
			}
			$txt .= "<input type='checkbox' name='s_".$row['user_extended_struct_id']."' ".$search_selected."> ".$user_extended_struct_text."<br/>";
		}
	}
	$txt .= "
		<input type='checkbox' name='user_search_ip' ".$user_search_ip."> ".ADMIN_PROFILE_193."<br/>
		<input type='checkbox' name='user_search_groupname' ".$user_search_groupname."> ".ADMIN_PROFILE_238."<br/>
		</select></td>
	</tr>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/friends.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_215."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_214."</td>
		<td class='forumheader3' style='width:30%'>".r_userclass('profile_top_class',$pref['profile_top_class'],"off","public,member,admin,main,classes")."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_228a."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_top_bcard_column' value='".$pref['profile_top_bcard_column']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_212."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_top_x' value='".$pref['profile_top_x']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_216."</td>
		<td class='forumheader3' style='width:30%'>
		<input type='checkbox' name='profile_top_level' ".$profile_top_level."> ".ADMIN_PROFILE_217."<br/>
		<input type='checkbox' name='profile_top_forums' ".$profile_top_forums."> ".ADMIN_PROFILE_218."<br/>
		<input type='checkbox' name='profile_top_comments' ".$profile_top_comments."> ".ADMIN_PROFILE_219."<br/>
		<input type='checkbox' name='profile_top_chatbox' ".$profile_top_chatbox."> ".ADMIN_PROFILE_223."<br/>
		<input type='checkbox' name='profile_top_rate' ".$profile_top_rate."> ".ADMIN_PROFILE_220."<br/>
		<input type='checkbox' name='profile_top_profile' ".$profile_top_profile."> ".ADMIN_PROFILE_221."<br/>
		<input type='checkbox' name='profile_top_friends' ".$profile_top_friends."> ".ADMIN_PROFILE_222."<br/>
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_224."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_top_noadmin'>".
		($pref['profile_top_noadmin'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_top_noadmin'] == 'No' || $pref['profile_top_noadmin'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader' colspan='2' style='text-align:center'><input type='submit' class='button' name='memberlist_settings' value='".PROFILE_222."' /></td>
	</tr>
	</table>
	</form>
	<br/><br/>";
	return $txt;
}

function show_settings() {
	global $pref;
	require_once(e_HANDLER."userclass_class.php");
	$post_max_resolution = round(intval(ini_get('memory_limit')) / 1.65 / 3);
	if (intval(ini_get('post_max_size')) >= intval(ini_get('upload_max_filesize'))) {
		$post_max_info = ini_get('upload_max_filesize');
	} else {
		$post_max_info = ini_get('post_max_size');
	}

	if ($pref['profile_youtube'] == "ON") {
		$profile_youtube = "checked='yes'";
	}
	if ($pref['profile_vimeo'] == "ON") {
		$profile_vimeo = "checked='yes'";
	}
	if ($pref['profile_metacafe'] == "ON") {
		$profile_metacafe = "checked='yes'";
	}
	if ($pref['profile_indavideo'] == "ON") {
		$profile_indavideo = "checked='yes'";
	}

	$txt .= "
	<form method='post' action='".e_SELF."?settings'>
	<table class='fborder' style='width:95%'>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><center>".ADMIN_PROFILE_16."</center></td>
	</tr>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/post1.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_67."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_61."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_maxpcomment' value='".$pref['profile_maxpcomment']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_62."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_maxpiccomment' value='".$pref['profile_maxpiccomment']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_63."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_maxvidcomment' value='".$pref['profile_maxvidcomment']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_2."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='2' value='".$pref['profile_apcomments']."' name='profile_apcomments'></td></td>
	</tr>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/post1.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_101."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_84."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='4' value='".$pref['profile_comments_spy_num']."' name='profile_comments_spy_num'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_85."</td>
		<td class='forumheader3' style='width:30%'>".r_userclass('profile_comments_spy',$pref['profile_comments_spy'],"off","public,member,admin,main,classes")."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_100."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='4' value='".$pref['profile_comments_spy_pic_size']."' name='profile_comments_spy_pic_size'></td></td>
	</tr>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/pict.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_68."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_9a."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_maxalbumnumber' value='".$pref['profile_maxalbumnumber']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_9b."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_maxpicnumber' value='".$pref['profile_maxpicnumber']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_9c."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_piccol' value='".$pref['profile_piccol']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_9."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_maxuploadsize' value='".$pref['profile_maxuploadsize']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_21."<br/><i>".ADMIN_PROFILE_21a."".$post_max_info."".ADMIN_PROFILE_21b."".$post_max_resolution."".ADMIN_PROFILE_102."".ini_get('memory_limit')."".ADMIN_PROFILE_103."</i></td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_indmaxuploadsize' value='".$pref['profile_indmaxuploadsize']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_239."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_private_albums'>".
		($pref['profile_private_albums'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_private_albums'] == 'No' || $pref['profile_private_albums'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_64."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_kepekezet'>".
		($pref['profile_kepekezet'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_kepekezet'] == 'No' || $pref['profile_kepekezet'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_76."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_user_image'>".
		($pref['profile_user_image'] == '100' || $pref['profile_user_image'] == '' ? "<option value='100' selected='selected'>100</option>" : "<option value='100'>100</option>").
		($pref['profile_user_image'] == '150' ? "<option value='150' selected='selected'>150</option>" : "<option value='150'>150</option>").
		($pref['profile_user_image'] == '200' ? "<option value='200' selected='selected'>200</option>" : "<option value='200'>200</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_81."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_imagick_support'>".
		($pref['profile_imagick_support'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_imagick_support'] == 'No' || $pref['profile_imagick_support'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/pict.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_69."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_51."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='10' name='profile_picviewsize' value='".$pref['profile_picviewsize']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_52."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_lightbox'>".
		($pref['profile_lightbox'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_lightbox'] == 'No' || $pref['profile_lightbox'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_53."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_lightwindowbox'>".
		($pref['profile_lightwindowbox'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_lightwindowbox'] == 'No' || $pref['profile_lightwindowbox'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_53a."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_lightview'>".
		($pref['profile_lightview'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_lightview'] == 'No' || $pref['profile_lightview'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_53b."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_clearbox'>".
		($pref['profile_clearbox'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_clearbox'] == 'No' || $pref['profile_clearbox'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_19."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='4' name='profile_imagewidth' value='".$pref['profile_imagewidth']."'> x <input type='text' class='tbox' size='4' name='profile_imageheight' value='".$pref['profile_imageheight']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_18."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='4' name='profile_avatarwidth' value='".$pref['profile_avatarwidth']."'> x <input type='text' class='tbox' size='4' name='profile_avatarheight' value='".$pref['profile_avatarheight']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/mp3.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_70."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_43."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_mp3'>".
		($pref['profile_mp3'] == 'Remote Only' ? "<option value='Remote Only' selected='selected'>".ADMIN_PROFILE_73."</option>" : "<option value='Remote Only'>".ADMIN_PROFILE_73."</option>").
		($pref['profile_mp3'] == 'Local Only' ? "<option value='Local Only' selected='selected'>".ADMIN_PROFILE_74."</option>" : "<option value='Local Only'>".ADMIN_PROFILE_74."</option>").
		($pref['profile_mp3'] == 'Both' || $pref['profile_mp3'] == '' ? "<option value='Both' selected='selected'>".ADMIN_PROFILE_75."</option>" : "<option value='Both'>".ADMIN_PROFILE_75."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_44."<i>".ADMIN_PROFILE_21a."".$post_max_info."".ADMIN_PROFILE_44a."</i></td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' name='profile_mp3size' value='".$pref['profile_mp3size']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_209."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_mp3_autoplay'>".
		($pref['profile_mp3_autoplay'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_mp3_autoplay'] == 'No' || $pref['profile_mp3_autoplay'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_210."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_mp3_loop'>".
		($pref['profile_mp3_loop'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_mp3_loop'] == 'No' || $pref['profile_mp3_loop'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_211."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='4' name='profile_mp3_volume' value='".$pref['profile_mp3_volume']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/vid.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_71."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_22."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='4' name='profile_maxnovids' value='".$pref['profile_maxnovids']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_240."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='4' name='profile_videowidth' value='".$pref['profile_videowidth']."'></td></td>
	</tr>	
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_241."</td>
		<td class='forumheader3' style='width:30%'>
		<input type='checkbox' name='profile_youtube' ".$profile_youtube."> ".ADMIN_PROFILE_242."<br/>
		<input type='checkbox' name='profile_vimeo' ".$profile_vimeo."> ".ADMIN_PROFILE_243."<br/>
		<input type='checkbox' name='profile_metacafe' ".$profile_metacafe."> ".ADMIN_PROFILE_244."<br/>
		<input type='checkbox' name='profile_indavideo' ".$profile_indavideo."> ".ADMIN_PROFILE_245."<br/>
		</select></td>
	</tr>	
	
	
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/logo_small.jpg' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_71a."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_54."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='2' value='".$pref['profile_frcol']."' name='profile_frcol'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_79."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_fr_req_sendpm'>".
		($pref['profile_fr_req_sendpm'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_fr_req_sendpm'] == 'No' || $pref['profile_fr_req_sendpm'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select>";
		if ($pref['profile_fr_req_sendpm_all'] == 'on') {
			$profile_fr_req_sendpm_all = "checked='yes'";
		}
		$txt .="<br/><br/>
		<input type='checkbox' name='profile_fr_req_sendpm_all' ".$profile_fr_req_sendpm_all.">".ADMIN_PROFILE_83."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_79a."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_fr_req_sendemail'>".
		($pref['profile_fr_req_sendemail'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_fr_req_sendemail'] == 'No' || $pref['profile_fr_req_sendemail'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select>";
		if ($pref['profile_fr_req_sendemail_all'] == 'on') {
			$profile_fr_req_sendemail_all = "checked='yes'";
		}
		$txt .="<br/><br/>
		<input type='checkbox' name='profile_fr_req_sendemail_all' ".$profile_fr_req_sendemail_all.">".ADMIN_PROFILE_83."
		</select></td>
	</tr>
	
	
	
	
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/settings.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_71b."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_42."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_redirect'>".
		($pref['profile_redirect'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_redirect'] == 'No' || $pref['profile_redirect'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_77."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_unreg'>".
		($pref['profile_unreg'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_unreg'] == 'No' || $pref['profile_unreg'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_78."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_unreg_save'>".
		($pref['profile_unreg_save'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_unreg_save'] == 'No' || $pref['profile_unreg_save'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>

	
	
	
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><img src='".e_PLUGIN."another_profiles/images/settings.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_72."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_236."</td>
		<td class='forumheader3' style='width:30%'>".r_userclass('profile_lastupdate_filter',$pref['profile_lastupdate_filter'],"off","public,member,admin,main,classes")."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_236a."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='4' name='profile_updatedtotal_col' value='".$pref['profile_updatedtotal_col']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_232."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_updateddirection'>".
		($pref['profile_updateddirection'] == 'v' || $pref['profile_updateddirection'] == '' ? "<option value='v' selected='selected'>".ADMIN_PROFILE_234."</option>" : "<option value='v'>".ADMIN_PROFILE_234."</option>").
		($pref['profile_updateddirection'] == 'h' ? "<option value='h' selected='selected'>".ADMIN_PROFILE_233."</option>" : "<option value='h'>".ADMIN_PROFILE_233."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_235."</td>
		<td class='forumheader3' style='width:30%'><input type='text' class='tbox' size='4' name='profile_updatedtotal' value='".$pref['profile_updatedtotal']."'></td></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_40."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_buttontype'>".
		($pref['profile_buttontype'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_buttontype'] == 'No' || $pref['profile_buttontype'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:70%'>".ADMIN_PROFILE_80."</td>
		<td class='forumheader3' style='width:30%'><select size='1' class='tbox' name='profile_user_warn_support'>".
		($pref['profile_user_warn_support'] == 'Yes' ? "<option value='Yes' selected='selected'>".ADMIN_PROFILE_48."</option>" : "<option value='Yes'>".ADMIN_PROFILE_48."</option>").
		($pref['profile_user_warn_support'] == 'No' || $pref['profile_user_warn_support'] == '' ? "<option value='No' selected='selected'>".ADMIN_PROFILE_49."</option>" : "<option value='No'>".ADMIN_PROFILE_49."</option>")."
		</select></td>
	</tr>
	<tr>
		<td class='forumheader' colspan='2' style='text-align:center'><input type='submit' class='button' name='updatesettings' value='".PROFILE_222."' /></td>
	</tr>
	</table>
	</form>
	<br/><br/>";
	return $txt;
}

function show_php() {
// ------------------------------------------------------------------
	function gdVersion($user_ver = 0) {
	if (! extension_loaded('gd')) {
		return;
	}
	static $gd_ver = 0;
	if ($user_ver == 1) {
		$gd_ver = 1;
		return 1;
	}
	if ($user_ver !=2 && $gd_ver > 0 ) {
		return $gd_ver;
	}
	if (function_exists('gd_info')) {
		$ver_info = gd_info();
		preg_match('/\d/', $ver_info['GD Version'], $match);
		$gd_ver = $match[0];
		return $match[0];
	}
	if (preg_match('/phpinfo/', ini_get('disable_functions'))) {
		if ($user_ver == 2) {
		$gd_ver = 2;
		return 2;
		} else {
			$gd_ver = 1;
			return 1;
		}
	}
	ob_start();
	phpinfo(8);
	$info = ob_get_contents();
	ob_end_clean();
	$info = stristr($info, 'gd version');
	preg_match('/\d/', $info, $match);
	$gd_ver = $match[0];
	return $match[0];
	}
// ------------------------------------------------------------------
	if (function_exists('imagegif') && function_exists('imagepng') && function_exists('imagejpeg') && function_exists('imagedestroy') && function_exists('imagecreatefromjpeg') && function_exists('imagecreatefrompng') && function_exists('imagecreatefromgif') && function_exists('imageSX') && function_exists('imageSY') && function_exists('ImageCreateTrueColor') && function_exists('imagealphablending') && function_exists('imagesavealpha') && function_exists('imagecolorallocatealpha') && function_exists('imagefilledrectangle') && function_exists('imagecopyresampled')) {
		$gd_function = "OK";
	}
	if ($gdv = gdVersion() && $gd_function == "OK") {
		if ($gdv >=2) {
			$gda = gd_info();
			$gd['version'] = $gda['GD Version'];
			$gdversion = $gd['version'];
			$gd_info = ADMIN_PROFILE_116;
			$info_color_4 = "green";
		} else {
			$gda = gd_info();
			$gd['version'] = $gda['GD Version'];
			$gdversion = $gd['version'];
			$gd_info = ADMIN_PROFILE_117;
			$info_color_4 = "orange";
		}
	} else if ($gdv = gdVersion() && $gd_function != "OK") {
		if ($gdv >=2) {
			$gda = gd_info();
			$gd['version'] = $gda['GD Version'];
			$gdversion = $gd['version'];
			$gd_info = ADMIN_PROFILE_116a;
			$info_color_4 = "red";
		} else {
			$gda = gd_info();
			$gd['version'] = $gda['GD Version'];
			$gdversion = $gd['version'];
			$gd_info = ADMIN_PROFILE_117a;
			$info_color_4 = "red";
		}
	} else {
			$gdversion = ADMIN_PROFILE_115;
			$gd_info = ADMIN_PROFILE_118;
			$info_color_4 = "red";
	}
// ------------------------------------------------------------------
	if (! extension_loaded('imagick')) {
		$im_version = ADMIN_PROFILE_120;
		$im_info = ADMIN_PROFILE_121;
		$info_color_5 = "red";
	} else {
		$image = new Imagick();
		$img_ary = $image->getVersion();
		$im_version = $img_ary['versionString'];
		$im_info = ADMIN_PROFILE_122;
		$info_color_5 = "green";
	}
// ------------------------------------------------------------------
	global $pref;
	$post_max_resolution = round(intval(ini_get('memory_limit')) / 1.65 / 3);
	if (intval(ini_get('post_max_size')) >= intval(ini_get('upload_max_filesize'))) {
		$post_max_info = ini_get('upload_max_filesize');
	} else {
		$post_max_info = ini_get('post_max_size');
	}

	if (intval(ini_get('memory_limit')) > 63) {
		$memory_limit_info = "".ADMIN_PROFILE_111a."".$post_max_resolution."".ADMIN_PROFILE_111e."";
		$info_color_1 = "green";
	} else if (intval(ini_get('memory_limit')) > 47) {
		$memory_limit_info = "".ADMIN_PROFILE_111b."".$post_max_resolution."".ADMIN_PROFILE_111f."";
		$info_color_1 = "yellow";
	} else if (intval(ini_get('memory_limit')) > 31) {
		$memory_limit_info = "".ADMIN_PROFILE_111c."".$post_max_resolution."".ADMIN_PROFILE_111g."";
		$info_color_1 = "orange";
	} else {
		$memory_limit_info = "".ADMIN_PROFILE_111d."".$post_max_resolution."".ADMIN_PROFILE_111h."";
		$info_color_1 = "red";
	}

	if (intval(ini_get('post_max_size')) > 19) {
		$post_max_size_info = ADMIN_PROFILE_112a;
		$info_color_2 = "green";
	} else if (intval(ini_get('post_max_size')) > 12) {
		$post_max_size_info = ADMIN_PROFILE_112b;
		$info_color_2 = "yellow";
	} else if (intval(ini_get('post_max_size')) > 6) {
		$post_max_size_info = ADMIN_PROFILE_112c;
		$info_color_2 = "orange";
	} else {
		$post_max_size_info = ADMIN_PROFILE_112d;
		$info_color_2 = "red";
	}

	if (intval(ini_get('upload_max_filesize')) > 19) {
		$upload_max_filesize_info = ADMIN_PROFILE_113a;
		$info_color_3 = "green";
	} else if (intval(ini_get('upload_max_filesize')) > 12) {
		$upload_max_filesize_info = ADMIN_PROFILE_113b;
		$info_color_3 = "yellow";
	} else if (intval(ini_get('upload_max_filesize')) > 6) {
		$upload_max_filesize_info = ADMIN_PROFILE_113c;
		$info_color_3 = "orange";
	} else {
		$upload_max_filesize_info = ADMIN_PROFILE_113d;
		$info_color_3 = "red";
	}
	if (ini_get('file_uploads') == 1) {
		$file_uploads_info = ADMIN_PROFILE_124;
		$file_uploads_comment = ADMIN_PROFILE_124a;
		$info_color_6 = "green";
	} else {
		$file_uploads_info = ADMIN_PROFILE_125;
		if ($pref['profile_pics'] == 'ON' || $pref['profile_mp3enabled'] == 'ON') {
			$file_uploads_comment = ADMIN_PROFILE_125a;
			$info_color_6 = "red";
		} else {
			$file_uploads_comment = ADMIN_PROFILE_127b;
			$info_color_6 = "green";
		}
	}
	if (ini_get('upload_tmp_dir') == "") {
		$upload_tmp_comment = ADMIN_PROFILE_126;
		$info_color_7 = "green";
		$upload_tmp_dir = ADMIN_PROFILE_129;
	} else if (is_dir(ini_get('upload_tmp_dir'))) {
		$upload_tmp_comment = ADMIN_PROFILE_127a;
		$upload_tmp_dir = ini_get('upload_tmp_dir');
		$info_color_7 = "green";
	} else {
		if ($pref['profile_pics'] == 'ON' || $pref['profile_mp3enabled'] == 'ON') {
			$upload_tmp_comment = ADMIN_PROFILE_127;
			$upload_tmp_dir = ini_get('upload_tmp_dir');
			$info_color_7 = "red";
		} else {
			$upload_tmp_comment = ADMIN_PROFILE_127b;
			$upload_tmp_dir = ini_get('upload_tmp_dir');
			$info_color_7 = "green";
		}
	}


	include(e_ADMIN."ver.php");
	if ($e107info['e107_version'] == '0.8.0 (cvs)' || $e107info['e107_version'] == '0.7.11' || $e107info['e107_version'] == '0.7.12' || $e107info['e107_version'] == '0.7.13' || $e107info['e107_version'] == '0.7.14' || $e107info['e107_version'] == '0.7.15' || $e107info['e107_version'] == '0.7.16' || $e107info['e107_version'] == '0.7.17' || $e107info['e107_version'] == '0.7.18' || $e107info['e107_version'] == '0.7.19' || $e107info['e107_version'] == '0.7.20' || $e107info['e107_version'] == '0.7.21' || $e107info['e107_version'] == '0.7.22' || $e107info['e107_version'] == '0.7.23' || $e107info['e107_version'] == '0.7.24' || $e107info['e107_version'] == '0.7.25' || $e107info['e107_version'] == '0.7.26' || $e107info['e107_version'] == '1.0.0' || $e107info['e107_version'] == '1.0.1' || $e107info['e107_version'] == '1.0.2' || $e107info['e107_version'] == '1.0.3' || $e107info['e107_version'] == '1.0.4' || $e107info['e107_version'] == '2.0.0 (git)' || $e107info['e107_version'] == '2.1.2 (git)' || $e107info['e107_version'] == '2.1.3 (git)' || $e107info['e107_version'] == '2.1.4 (git)' || $e107info['e107_version'] == '2.1.5 (git)' || $e107info['e107_version'] == '2.1.6 (git)') {
		$e107_version_comment = ADMIN_PROFILE_146;
		$e107_version_comment_color = "green";
	} else {
		$e107_version_comment = ADMIN_PROFILE_147;
		$e107_version_comment_color = "red";
	}

	if ($pref['upload_enabled']) {
		$e107_upload_enabled = ADMIN_PROFILE_130;
		$e107_upload_comment = ADMIN_PROFILE_131;
		$e107_upload_comment_color = "green";
	} else {
		$e107_upload_enabled = ADMIN_PROFILE_132;
		if ($pref['profile_pics'] == 'ON' || $pref['profile_mp3enabled'] == 'ON') {
			$e107_upload_comment = ADMIN_PROFILE_133;
			$e107_upload_comment_color = "red";
		} else {
			$e107_upload_comment = ADMIN_PROFILE_133a;
			$e107_upload_comment_color = "green";
		}
	}

	if ($e107info['e107_version'] == '0.8.0 (cvs)') {
		if (is_file("".e_ADMIN."filetypes.xml")) {
			$e107_filetypes_enabled = ADMIN_PROFILE_137;
			$e107_filetypes_comment = ADMIN_PROFILE_138;
			$e107_filetypes_comment_color = "green";
		} else {
			$e107_filetypes_enabled = ADMIN_PROFILE_139;
			if ($pref['profile_pics'] == 'ON' || $pref['profile_mp3enabled'] == 'ON') {
				$e107_filetypes_comment = ADMIN_PROFILE_140;
				$e107_filetypes_comment_color = "red";
			} else {
				$e107_filetypes_comment = ADMIN_PROFILE_144a;
				$e107_filetypes_comment_color = "green";
			}
		}
	} else {
		if (is_file("".e_ADMIN."filetypes.php")) {
			$e107_filetypes_enabled = ADMIN_PROFILE_142;
			$e107_filetypes_comment = ADMIN_PROFILE_138;
			$e107_filetypes_comment_color = "green";
		} else {
			$e107_filetypes_enabled = ADMIN_PROFILE_143;
			if ($pref['profile_pics'] == 'ON' || $pref['profile_mp3enabled'] == 'ON') {
				$e107_filetypes_comment = ADMIN_PROFILE_144;
				$e107_filetypes_comment_color = "red";
			} else {
				$e107_filetypes_comment = ADMIN_PROFILE_144a;
				$e107_filetypes_comment_color = "green";
			}
		}
	}

	if (is_readable(e_ADMIN.'filetypes.php')) {
		$allowed_filetypes = trim(file_get_contents(e_ADMIN.'filetypes.php')); 		
			
		if(preg_match("/mp3/i", $allowed_filetypes)) {
			$upload_mp3 = "yes";
		}
		if(preg_match("/jpg/i", $allowed_filetypes)) {
			$upload_jpg = "yes";
		}
		if ($upload_mp3 == "yes" && $upload_jpg == "yes") {
			$allowed_filetypes_comment = ADMIN_PROFILE_155;
			$e107_allowed_filetypes_comment_color = "green";
		} else if (($upload_mp3 != "yes" && $pref['profile_mp3enabled'] == 'ON') || ($upload_jpg != "yes" && $pref['profile_pics'] == 'ON')) { 
			$allowed_filetypes_comment = ADMIN_PROFILE_156;
			$e107_allowed_filetypes_comment_color = "red";
		} else {
			$allowed_filetypes_comment = ADMIN_PROFILE_157;
			$e107_allowed_filetypes_comment_color = "green";
		}
	} else if (is_readable(e_ADMIN.'filetypes.xml')) {		
		
		require_once(e_HANDLER.'upload_handler.php');
		$a_filetypes = get_filetypes();
		$a_filetypes = array_keys($a_filetypes);
		$allowed_filetypes = implode(', ', $a_filetypes);
		if(preg_match("/mp3/i", $allowed_filetypes)) {
			$upload_mp3 = "yes";
		}
		if(preg_match("/jpg/i", $allowed_filetypes)) {
			$upload_jpg = "yes";
		}
		if ($upload_mp3 == "yes" && $upload_jpg == "yes") {
			$allowed_filetypes_comment = ADMIN_PROFILE_155;
			$e107_allowed_filetypes_comment_color = "green";
		} else if (($upload_mp3 != "yes" && $pref['profile_mp3enabled'] == 'ON') || ($upload_jpg != "yes" && $pref['profile_pics'] == 'ON')) { 
			$allowed_filetypes_comment = ADMIN_PROFILE_156;
			$e107_allowed_filetypes_comment_color = "red";
		} else {
			$allowed_filetypes_comment = ADMIN_PROFILE_157;
			$e107_allowed_filetypes_comment_color = "green";
		}
	} else if (($upload_mp3 != "yes" && $pref['profile_mp3enabled'] == 'ON') || ($upload_jpg != "yes" && $pref['profile_pics'] == 'ON')) { 
		$allowed_filetypes_comment = ADMIN_PROFILE_158;
		$e107_allowed_filetypes_comment_color = "red";
	} else {
		$allowed_filetypes_comment = ADMIN_PROFILE_157;
		$e107_allowed_filetypes_comment_color = "green";
	}

	if (is_writable('userimages') && is_writable('usermp3')) {
		$writable_comment = ADMIN_PROFILE_203;
		$dir_writable_color = "green";
	} else if (($pref['profile_mp3enabled'] == 'ON' || $pref['profile_pics'] == 'ON') && (!is_writable('userimages') || !is_writable('usermp3'))) { 
		$writable_comment = ADMIN_PROFILE_201;
		$dir_writable_color = "red";
	} else {
		$writable_comment = ADMIN_PROFILE_202;
		$dir_writable_color = "green";
	}

	if ($pref['post_html'] == 253 || $pref['post_html'] == 0) {
		$e107_html_enabled = ADMIN_PROFILE_149;
		$e107_html_comment = ADMIN_PROFILE_150;
		$e107_html_comment_color = "green";
	} else {
		$e107_html_enabled = ADMIN_PROFILE_151;
		if ($pref['profile_videos'] == 'ON') {
			$e107_html_comment = ADMIN_PROFILE_152;
			$e107_html_comment_color = "red";
		} else {
			$e107_html_comment = ADMIN_PROFILE_152a;
			$e107_html_comment_color = "green";
		}
	}

	if (is_writable('userimages') && is_writable('usermp3')) {
		$writable = ADMIN_PROFILE_199;
	} else {
		$writable = ADMIN_PROFILE_200;
	}


	$txt .= "
	<table class='fborder' style='width:95%'>
	<tr>
		<td class='forumheader' style='width:386' colspan='3'><center>".ADMIN_PROFILE_135."</center></td>
	</tr>
	<tr>
		<td class='forumheader'><img src='".e_PLUGIN."another_profiles/images/settings.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_136."</td>
		<td class='forumheader'><img src='".e_PLUGIN."another_profiles/images/stat.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_106."</td>
		<td class='forumheader'><img src='".e_PLUGIN."another_profiles/images/post1.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_107."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$e107_version_comment_color."'>".ADMIN_PROFILE_148."</td>
		<td class='forumheader3' style='width:20%; background-color:".$e107_version_comment_color."'>".$e107info['e107_version']."</td>
		<td class='forumheader3' style='width:60%; background-color:".$e107_version_comment_color."'>".$e107_version_comment."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$e107_upload_comment_color."'>".ADMIN_PROFILE_134."</td>
		<td class='forumheader3' style='width:20%; background-color:".$e107_upload_comment_color."'>".$e107_upload_enabled."</td>
		<td class='forumheader3' style='width:60%; background-color:".$e107_upload_comment_color."'>".$e107_upload_comment."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$e107_filetypes_comment_color."'>".ADMIN_PROFILE_141."</td>
		<td class='forumheader3' style='width:20%; background-color:".$e107_filetypes_comment_color."'>".$e107_filetypes_enabled."</td>
		<td class='forumheader3' style='width:60%; background-color:".$e107_filetypes_comment_color."'>".$e107_filetypes_comment."".$allowed_filetypes_info."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$e107_allowed_filetypes_comment_color."'>".ADMIN_PROFILE_154."</td>
		<td class='forumheader3' style='width:20%; background-color:".$e107_allowed_filetypes_comment_color."'>".$allowed_filetypes."</td>
		<td class='forumheader3' style='width:60%; background-color:".$e107_allowed_filetypes_comment_color."'>".$allowed_filetypes_comment."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$dir_writable_color."'>".ADMIN_PROFILE_198."</td>
		<td class='forumheader3' style='width:20%; background-color:".$dir_writable_color."'>".$writable."</td>
		<td class='forumheader3' style='width:60%; background-color:".$dir_writable_color."'>".$writable_comment."</td>
	</tr>

	</table>";

/*
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$e107_html_comment_color."'>".ADMIN_PROFILE_153."</td>
		<td class='forumheader3' style='width:20%; background-color:".$e107_html_comment_color."'>".$e107_html_enabled."</td>
		<td class='forumheader3' style='width:60%; background-color:".$e107_html_comment_color."'>".$e107_html_comment."</td>
	</tr>
*/

	if ($pref['profile_pics'] == 'ON' || $pref['profile_mp3enabled'] == 'ON') {
	$txt .= "
	<br/><br/>
	<table class='fborder' style='width:95%'>
	<tr>
		<td class='forumheader' style='width:386' colspan='3'><center>".ADMIN_PROFILE_104a."</center></td>
	</tr>
	<tr>
		<td class='forumheader'><img src='".e_PLUGIN."another_profiles/images/settings.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_105."</td>
		<td class='forumheader'><img src='".e_PLUGIN."another_profiles/images/stat.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_106."</td>
		<td class='forumheader'><img src='".e_PLUGIN."another_profiles/images/post1.png' border='0' alt='' width='16' height='16' />&nbsp;&nbsp;&nbsp;".ADMIN_PROFILE_107."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_6."'>".ADMIN_PROFILE_123."</td>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_6."'>".$file_uploads_info."</td>
		<td class='forumheader3' style='width:60%; background-color:".$info_color_6."'>".$file_uploads_comment."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_7."'>".ADMIN_PROFILE_128."</td>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_7."'>".$upload_tmp_dir."</td>
		<td class='forumheader3' style='width:60%; background-color:".$info_color_7."'>".$upload_tmp_comment."</td>
	</tr>";
	if ($pref['profile_pics'] == 'ON') {
	$txt .= "
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_4."'>".ADMIN_PROFILE_114."</td>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_4."'>".$gdversion."</td>
		<td class='forumheader3' style='width:60%; background-color:".$info_color_4."'>".$gd_info."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_5."'>".ADMIN_PROFILE_119."</td>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_5."'>".$im_version."</td>
		<td class='forumheader3' style='width:60%; background-color:".$info_color_5."'>".$im_info."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_1."'>".ADMIN_PROFILE_108."</td>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_1."'>".ini_get('memory_limit')."</td>
		<td class='forumheader3' style='width:60%; background-color:".$info_color_1."'>".$memory_limit_info."</td>
	</tr>";
	}
	$txt .= "
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_2."'>".ADMIN_PROFILE_109."</td>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_2."'>".ini_get('post_max_size')."</td>
		<td class='forumheader3' style='width:60%; background-color:".$info_color_2."'>".$post_max_size_info."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_3."'>".ADMIN_PROFILE_110."</td>
		<td class='forumheader3' style='width:20%; background-color:".$info_color_3."'>".ini_get('upload_max_filesize')."</td>
		<td class='forumheader3' style='width:60%; background-color:".$info_color_3."'>".$upload_max_filesize_info."</td>
	</tr>
	</table>
	";
	}
	$txt .= "
	<br/><br/>
	<table class='fborder' style='width:95%'>
	<tr>
		<td class='forumheader'><center>
		<img src='".e_PLUGIN."another_profiles/images/green_good.png' border='0' alt='' width='10' height='10' />&nbsp;".ADMIN_PROFILE_159."&nbsp;&nbsp;&nbsp;
		<img src='".e_PLUGIN."another_profiles/images/yellow_medium.png' border='0' alt='' width='10' height='10' />&nbsp;".ADMIN_PROFILE_160."&nbsp;&nbsp;&nbsp;
		<img src='".e_PLUGIN."another_profiles/images/orange_medium.png' border='0' alt='' width='10' height='10' />&nbsp;".ADMIN_PROFILE_161."&nbsp;&nbsp;&nbsp;
		<img src='".e_PLUGIN."another_profiles/images/red_bad.png' border='0' alt='' width='10' height='10' />&nbsp;".ADMIN_PROFILE_162."
		</center></td>
	</tr>
	</table>
	<br/><br/>";
return $txt;
}


function show_deluser($deluser_id, $deluser_name) {
	$txt .= "
	<form method='post' action='".e_SELF."?user_delete'>
	<table class='fborder' style='width:95%'>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><center>".ADMIN_PROFILE_90."</center></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:50%'><img src='".e_PLUGIN."another_profiles/images/userdel.png' style='border: 0px; width: 32px; height: 32px; float: left; margin-right: 10px' />".ADMIN_PROFILE_91."</td>
		<td class='forumheader3' style='width:50%'><FONT size='3' color='red'>".$deluser_name."</font>
		<br/>
		<input type='checkbox' name='deluser_name_ok' ".$deluser_name_ok.">".ADMIN_PROFILE_93."
		</td>
		</tr>
	<tr>
	<tr>
		<td class='forumheader3' style='width:50%'><img src='".e_PLUGIN."another_profiles/images/userdel_code.png' style='border: 0px; width: 32px; height: 32px; float: left; margin-right: 10px' />".ADMIN_PROFILE_92."</td>
		<td class='forumheader3' style='width:50%'><FONT size='3' color='red'>#".$deluser_id."</font>
		<br/>
		<input type='checkbox' name='deluser_id_ok' ".$deluser_id_ok.">".ADMIN_PROFILE_93."
		</td>
		</tr>
	<tr>
		<td class='forumheader' style='width:386' colspan='2'><center>".ADMIN_PROFILE_94."</center></td>
	</tr>
	<tr>
		
		<td class='forumheader' colspan='2' style='text-align:center'>
		<input type = 'hidden' name = 'deluser_name' value = ".$deluser_name."  />
		<input type = 'hidden' name = 'deluser_id' value = ".$deluser_id."  />
		<input type='submit' class='button' name='updatesettings' value='".ADMIN_PROFILE_95."' /></td>
	</tr>
	</table>
	</form>
	";
	return $txt;
}

require_once(e_ADMIN."footer.php");

function show_menu($action) {
	global $sql, $pref;
	if ($action == "") { $action = "main"; }
	$var['main']['text'] = ADMIN_PROFILE_57;
	$var['main']['link'] = e_SELF;
	$var['main_settings']['text'] = ADMIN_PROFILE_66;
	$var['main_settings']['link'] = e_SELF."?main_settings";
	$var['settings']['text'] = ADMIN_PROFILE_58;
	$var['settings']['link'] = e_SELF."?settings";
	$var['memberlist_settings']['text'] = ADMIN_PROFILE_173;
	$var['memberlist_settings']['link'] = e_SELF."?memberlist_settings";
	$var['phpinfo']['text'] = ADMIN_PROFILE_104;
	$var['phpinfo']['link'] = e_SELF."?phpinfo";
		
	show_admin_menu(PROFILE_1, $action, $var);	
}

function admin_menu_adminmenu() {
	global $action;
	show_menu($action);
}

?>
