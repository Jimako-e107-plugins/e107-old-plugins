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
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}

if(file_exists(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."another_profiles/languages/English.php");
}

define("e_PAGETITLE", TITLE_PROFILE_3);
require_once(HEADERF);

$alert_icon = "<img src='images/alert.png' title='!' />";

if (!$pref['plug_installed']['another_profiles']) {
	$ns->tablerender($alert_icon,PROFILE_2a);
	require_once(FOOTERF);
	exit;
}

if (!check_class($pref['profile_lastupdate_filter'])) {
	$ns->tablerender($alert_icon,PROFILE_2b);
	require_once(FOOTERF);
	exit;
}
$numquery = mysql_query("SELECT user_id FROM ".MPREFIX."another_profiles WHERE user_lastupdated != ''  LIMIT 100 ");
$numrows = mysql_num_rows($numquery);

$count = 1;
$rowsPerPage = 20;
$pageNum = 1;
if(isset($_GET['pgnum'])) {
	$pageNum = intval($_GET['pgnum']);
}
$offset = ($pageNum - 1) * $rowsPerPage;
$query = mysql_query("SELECT u.user_id, u.user_name, u.user_image, a.user_custompage, a.user_lastupdated FROM ".MPREFIX."user u, ".MPREFIX."another_profiles a WHERE a.user_lastupdated != '' AND a.user_id = u.user_id ORDER BY a.user_lastupdated DESC LIMIT $offset,$rowsPerPage");
$rows = mysql_num_rows($query);
$maxPage = ceil($numrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
$nav  = '';
for($page = 1; $page <= $maxPage; $page++) {
	if ($page == $pageNum) {
		$nav .= " $page ";
	} else {
		$nav .= " <a href=\"$self?pgnum=".$page."\">$page</a> ";
	}
}
if ($pageNum > 1) {
	$page  = $pageNum - 1;
	$prev  = " <a href=\"$self?pgnum=".$page."\"><< </a> ";
	$first = " <a href=\"$self?pgnum=".$page."\">[First Page]</a> ";
} else {
	$prev  = '';
	$first = '&nbsp;';
}
if ($pageNum < $maxPage) {
	$page = $pageNum + 1;
	$next = " <a href=\"$self?pgnum=".$page."\"> >> </a> ";
	$last = " <a href=\"$self?pgnum=".$page."\">[Last Page]</a> ";
} else {
	$next = '';
	$last = '&nbsp;';
}
$text = "<br/><br/><table width='100%' class='fborder'><tr>";

for ($i = 0; $i <= $rows; $i++) {
	$row = mysql_fetch_assoc($query);
	if ($row['user_id'] != "") {
		if ($row['user_image'] == '') {
			$avatar = e_PLUGIN."another_profiles/images/noavatar.png";
		}else{
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
		$text .= "<td class='forumheader'><center>
			<a style=\"text-decoration: none;\" href='".e_PLUGIN."another_profiles/newuser.php?id=".$row['user_id']."'><img src='".$avatar."' ".$avwidth." ".$avheight." /><br/>".$row["user_name"]."</a><br/>".$profile_mod."<br/>".date("Y.m.d", $row['user_lastupdated'])."</center></td>";
		if ($pref['profile_updatedtotal_col'] == '') {
			$profile_updatedtotal_col = '4';
		} elseif ($pref['profile_updatedtotal_col'] > '8') {
			$profile_updatedtotal_col = '8';
		} else {
			$profile_updatedtotal_col = $profile_updatedtotal_col;
		}
		if ($count == $pref['profile_updatedtotal_col']) {
			$text .= "</tr><tr><td><br/><td></tr><tr>";
			$count = 1;
		} else {
			$count++;
		}
		$profile_mod = "";
	}
}
$text .= "</tr></table>";
if ($maxPage == 1) $nav = "";
$text .= "<br/>".$prev.$nav.$next."";
$title = PROFILE_409;
$ns -> tablerender($title, $text);
require_once(FOOTERF);
?>
