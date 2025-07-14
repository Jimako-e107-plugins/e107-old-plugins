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
  global $pref;

  $pref['profile_updatedtotal'] == "" ? $profile_updatedtotal = 3 : $profile_updatedtotal = $pref['profile_updatedtotal'];
  $query = mysql_query("SELECT u.user_id, u.user_name, u.user_image, a.user_custompage, a.user_lastupdated FROM ".MPREFIX."user u, ".MPREFIX."another_profiles a WHERE a.user_lastupdated != '' AND a.user_id = u.user_id ORDER BY a.user_lastupdated DESC LIMIT ".$profile_updatedtotal."");
  $rows = mysql_num_rows($query);
  $text = "<center>";

  if ($pref['profile_updateddirection'] == "h") {
	$text .= "<table><tr>";
  }

  for ($i = 0; $i <= $rows; $i++) {
	$row = mysql_fetch_assoc($query);

	if ($row['user_id'] != "") {
		if ($row['user_image'] == '') {
			$avatar = e_PLUGIN."another_profiles/images/noavatar.png";
		} else {
			$user_image = $row['user_image'];
			require_once(e_HANDLER."avatar_handler.php");
			$avatar = avatar($user_image);
		}
		if ($pref['profile_avatarwidth'] == '') {
			$avwidth = "";
		} else {
			$avwidth = "width='".$pref['profile_avatarwidth']."' ";
		}
		if ($pref['profile_avatarheight'] == '') {
			$avheight = '';
		} else {
			$avheight = "height='".$pref['profile_avatarheight']."' ";
		}
	
		if ($row["user_custompage"] == "delete_album") $profile_mod = PROFILE_395;
		if ($row["user_custompage"] == "delete_image") $profile_mod = PROFILE_396;
		if ($row["user_custompage"] == "update_video") $profile_mod = PROFILE_397;
		if ($row["user_custompage"] == "add_video") $profile_mod = PROFILE_398;
		if ($row["user_custompage"] == "delete_video") $profile_mod = PROFILE_399;
		if ($row["user_custompage"] == "create_album") $profile_mod = PROFILE_400;
		if ($row["user_custompage"] == "delete_image_or_album") $profile_mod = PROFILE_401;
		if ($row["user_custompage"] == "rename_album") $profile_mod = PROFILE_402;
		if ($row["user_custompage"] == "rename_image") $profile_mod = PROFILE_403;
		if ($row["user_custompage"] == "update_profile_song") $profile_mod = PROFILE_404;
		if ($row["user_custompage"] == "delete_profile_song") $profile_mod = PROFILE_405;
		if ($row["user_custompage"] == "upload_profile_song") $profile_mod = PROFILE_406;
		if ($row["user_custompage"] == "upload_album_image") $profile_mod = PROFILE_407;
		if ($row["user_custompage"] == "upload_image") $profile_mod = PROFILE_408;
		if ($row["user_custompage"] == "delete_album_image") $profile_mod = PROFILE_407a;
		if ($pref['profile_updateddirection'] == "v" || $pref['profile_updateddirection'] == "") {
			$text .= "<a style=\"text-decoration: none;\" href='".e_PLUGIN."another_profiles/newuser.php?id=".$row['user_id']."'><img src='".$avatar."' ".$avwidth." ".$avheight." /><br>" . $row["user_name"] . "</a><br/>".$profile_mod."<br/> ".date("Y.m.d", $row['user_lastupdated'])."<br/><br/>";
		} else if ($pref['profile_updateddirection'] == "h") {
			$text .= "<td><center><a style=\"text-decoration: none;\" href='".e_PLUGIN."another_profiles/newuser.php?id=".$row['user_id']."'><img src='".$avatar."' ".$avwidth." ".$avheight." /><br>" . $row["user_name"] . "</a><br/>".$profile_mod."<br/> ".date("Y.m.d", $row['user_lastupdated'])."&nbsp;&nbsp;</center></td>";
		}
		$profile_mod = "";
	}
  }
  if ($pref['profile_updateddirection'] == "h") {
	$text .= "</tr></table>";
  }
  $text .= "</center><br/><div align='right'><a href='".e_PLUGIN."another_profiles/lastupdatedprofiles.php'>".PROFILE_411."</a>";
  $text .= "</div>";
  $title = PROFILE_410;
  if (!check_class($pref['profile_lastupdate_filter'])) {
	$text = PROFILE_2b;
  }
  $ns -> tablerender($title, $text);
}
?>
