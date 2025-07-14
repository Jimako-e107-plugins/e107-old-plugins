global $post_info, $pref;
if ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "") {
	$id = intval($post_info['user_id']);
	if (USER && $id != USERID) {
		if ($post_info['user_id']) {
			$result = mysql_query("SELECT user_settings FROM ".MPREFIX."another_profiles WHERE user_id='".intval($post_info['user_id'])."' ");
			$result = mysql_fetch_assoc($result);
			$break = explode("|", $result['user_settings']);
			if ($break[3] == 1) {
				$id = intval($post_info['user_id']);
				$friends_pic_db = new db;
				$friends_pic_db->db_Select("another_profiles", "*", "user_id='$id' LIMIT 1");
				$friends_pic = $friends_pic_db->db_Fetch();
				$friendb = explode("|", $friends_pic['user_friends']);
				$friendb1 = explode("|", $friends_pic['user_friends_request']);
				$fr_img = e_PLUGIN."another_profiles/images/pm_small_forum.png";
				if (in_array(USERID, $friendb)) $fr_img = e_PLUGIN."another_profiles/images/friend_forum.png";
				if (in_array(USERID, $friendb1)) $fr_img = e_PLUGIN."another_profiles/images/fr_checked_forum.png";
					$frimage = "<a href='".e_PLUGIN."another_profiles/newuser.php?id=".$post_info['user_id']."&add' style=\"text-decoration: none;\" title='".PROFILE_16."'><img src='".$fr_img."' style='width:25px; height:18px;' border='0' alt='' /></a>";
				if(in_array(USERID, $friendb)) {
					$frimage = "<a href='".e_PLUGIN."another_profiles/newuser.php?id=".$post_info['user_id']."' style=\"text-decoration: none;\" title='".PROFILE_424."'><img src='".$fr_img."' style='width:25px; height:18px;' border='0' alt='' /></a>";
				}
				if(in_array(USERID, $friendb1)) {
					$frimage = "<a href='".e_PLUGIN."another_profiles/newusersettings.php?page=friends' style=\"text-decoration: none;\" title='".PROFILE_425."'><img src='".$fr_img."' style='width:25px; height:18px;' border='0' alt='' /></a>";
				}
				return $frimage;
			}
		}
	}
}
