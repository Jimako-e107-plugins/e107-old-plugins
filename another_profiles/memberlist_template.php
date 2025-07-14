<?php
/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.2
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

global $ml_shortcodes;

if ($pref['profile_memberlist_bcard'] == "line" || $pref['profile_memberlist_bcard'] == "" ) {
	$ML_SHORT_TEMPLATE = "
	<tr>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<td class='forumheader3' style='width:2%'><center>{USER_AVATAR: shape=circle}<!--{USER_AVATAR}--><br>{USER_ID}".PROFILE_4b."{USER_SET_FRIEND_PIC}</center></td>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<td class='forumheader'  style='width:20%'>{USER_ONLINE}{USER_WARN}<br>{USER_NAME_LINK}<br>{USER_LEVEL}<br>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}</td>" : "").
		($pref['profile_memberlist_column_realname'] == "ON" ? "<td class='forumheader3' style='width:20%'>{USER_REAL_NAME}</td>" : "").
		($pref['profile_memberlist_column_loginname'] == "ON" && ADMIN && getperms("4") ? "<td class='forumheader3' style='width:20%'>{USER_LOGINNAME}</td>" : "").
		($pref['profile_memberlist_column_email'] != "OFF" ? "<td class='forumheader3' style='width:20%'>{USER_EMAIL}</td>" : "").
		($pref['profile_memberlist_column_join'] != "OFF" ? "<td class='forumheader3' style='width:20%'>{USER_JOIN}</td>" : "").
		($pref['profile_memberlist_column_lastvisit'] != "OFF" ? "<td class='forumheader3' style='width:20%'>{USER_LASTVISIT}</td>" : "").
		($pref['profile_memberlist_column_visits'] != "OFF" ? "<td class='forumheader3' style='width:20%'>{USER_VISITS}</td>" : "").
		($pref['profile_memberlist_column_timezone'] == "ON" && ADMIN && getperms("4") ? "<td class='forumheader3' style='width:20%'>{USER_TIMEZONE}</td>" : "").
		($pref['profile_memberlist_column_userip'] == "ON" && ADMIN && getperms("4") ? "<td class='forumheader3' style='width:20%'>{USER_IP_ADDRESS}</td>" : "").
		("{USER_LIST}")."
	";

	$ML_TOPLIST_FORUMS = "
	<tr>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<td class='forumheader3' style='width:2%'><center>{USER_AVATAR}<br>{USER_ID}".PROFILE_4b."</center></td>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<td class='forumheader'  style='width:10%'>{USER_ONLINE}{USER_WARN}<br>{USER_NAME_LINK}<br>{USER_LEVEL}<br>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}</td>" : "").
		("<td class='forumheader3' style='width:50%'>{USER_FORUMS_TOP}</td>")."
	";

	$ML_TOPLIST_LEVEL = "
	<tr>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<td class='forumheader3' style='width:2%'><center>{USER_AVATAR}<br>{USER_ID}".PROFILE_4b."</center></td>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<td class='forumheader'  style='width:10%'>{USER_ONLINE}{USER_WARN}<br>{USER_NAME_LINK}<br>{USER_LEVEL}<br>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}</td>" : "").
		("<td class='forumheader3' style='width:50%'>{USER_LEVEL_TOP}</td>")."
	";

	$ML_TOPLIST_COMMENTS = "
	<tr>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<td class='forumheader3' style='width:2%'><center>{USER_AVATAR}<br>{USER_ID}".PROFILE_4b."</center></td>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<td class='forumheader'  style='width:10%'>{USER_ONLINE}{USER_WARN}<br>{USER_NAME_LINK}<br>{USER_LEVEL}<br>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}</td>" : "").
		("<td class='forumheader3' style='width:50%'>{USER_COMMENTS_TOP}</td>")."
	";

	$ML_TOPLIST_CHATBOX = "
	<tr>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<td class='forumheader3' style='width:2%'><center>{USER_AVATAR}<br>{USER_ID}".PROFILE_4b."</center></td>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<td class='forumheader'  style='width:10%'>{USER_ONLINE}{USER_WARN}<br>{USER_NAME_LINK}<br>{USER_LEVEL}<br>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}</td>" : "").
		("<td class='forumheader3' style='width:50%'>{USER_CHATBOX_TOP}</td>")."
	";

	$ML_TOPLIST_USER = "
	<tr>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<td class='forumheader3' style='width:2%'><center>{USER_AVATAR}<br>{USER_ID}".PROFILE_4b."</center></td>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<td class='forumheader'  style='width:10%'>{USER_ONLINE}{USER_WARN}<br>{USER_NAME_LINK}<br>{USER_LEVEL}<br>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}</td>" : "").
		("<td class='forumheader3' style='width:50%'>{USER_RATING_TOP}</td>")."
	";

	$ML_TOPLIST_PROFILES = "
	<tr>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<td class='forumheader3' style='width:2%'><center>{USER_AVATAR}<br>{USER_ID}".PROFILE_4b."</center></td>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<td class='forumheader'  style='width:10%'>{USER_ONLINE}{USER_WARN}<br>{USER_NAME_LINK}<br>{USER_LEVEL}<br>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}</td>" : "").
		("<td class='forumheader3' style='width:50%'>{USER_PROFILE_TOP}</td>")."
	";

	$ML_TOPLIST_FRIENDS = "
	<tr>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<td class='forumheader3' style='width:2%'><center>{USER_AVATAR}<br>{USER_ID}".PROFILE_4b."</center></td>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<td class='forumheader'  style='width:10%'>{USER_ONLINE}{USER_WARN}<br>{USER_NAME_LINK}<br>{USER_LEVEL}<br>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}</td>" : "").
		("<td class='forumheader3' style='width:50%'>{USER_FRIENDS_TOP}</td>")."
	";

} else {
	$ML_SHORT_TEMPLATE = "
		<td class='card_body'>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<div id='card_picture'>{USER_AVATAR}<center><div id='card_id'>{USER_ID}".PROFILE_4b."</div></center></div>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<div id='card_online'>{USER_ONLINE}</div><div id='card_online'>{USER_WARN}</div><div id='card_name'>{USER_NAME_LINK}</div><div id='card_level'>{USER_LEVEL}</div>" : "").
		($pref['profile_memberlist_column_realname'] == "ON" ? "<div id='card_real_name'>{USER_REAL_NAME}</div>" : "").
		($pref['profile_memberlist_column_email'] != "OFF" ? "<div id='card_email'>".PROFILE_417.": {USER_EMAIL}</div>" : "").
		($pref['profile_memberlist_column_loginname'] == "ON" && ADMIN && getperms("4") ? "<div id='card_login_name'>".PROFILE_394.": {USER_LOGINNAME}</div>" : "").
		($pref['profile_memberlist_column_visits'] != "OFF" ? "<div id='card_visits'>".PROFILE_9b.": {USER_VISITS}</div>" : "").
		($pref['profile_memberlist_column_join'] != "OFF" ? "<div id='card_visits'>".PROFILE_9.": {USER_JOIN_SORT}</div>" : "").
		($pref['profile_memberlist_column_lastvisit'] != "OFF" ? "<div id='card_visits'>".PROFILE_9a.": {USER_LASTVISIT_SORT}</div>" : "").
		($pref['profile_memberlist_column_timezone'] == "ON" && ADMIN && getperms("4") ? "<div id='card_visits'>".PROFILE_368.": {USER_TIMEZONE}</div>" : "").
		($pref['profile_memberlist_column_userip'] == "ON" && ADMIN && getperms("4") ? "<div id='card_visits'>".PROFILE_369.": {USER_IP_ADDRESS}</div>" : "").
		("<div id='card_visits'>{USER_LIST}</div>")."
		<div id='card_pics'>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}{USER_SET_FRIEND_PIC}</div>
		</td>
	";

	$ML_TOPLIST_FORUMS = "
		<td class='card_body_top'>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<div id='card_picture'>{USER_AVATAR}<center>{USER_ID}".PROFILE_4b."</center></div>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<div id='card_online'>{USER_ONLINE}</div><div id='card_online'>{USER_WARN}</div><div id='card_name'>{USER_NAME_LINK}</div><div id='card_level'>{USER_LEVEL}</div>" : "")."
		<div id='card_toplists'>{USER_FORUMS_TOP}</div>
		<div id='card_pics'>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}{USER_SET_FRIEND_PIC}</div>
		</td>
	";

	$ML_TOPLIST_LEVEL = "
		<td class='card_body_top'>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<div id='card_picture'>{USER_AVATAR}<center>{USER_ID}".PROFILE_4b."</center></div>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<div id='card_online'>{USER_ONLINE}</div><div id='card_online'>{USER_WARN}</div><div id='card_name'>{USER_NAME_LINK}</div><div id='card_level'>{USER_LEVEL}</div>" : "")."
		<div id='card_toplists'>{USER_LEVEL_TOP}</div>
		<div id='card_pics'>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}{USER_SET_FRIEND_PIC}</div>
		</td>
	";

	$ML_TOPLIST_COMMENTS = "
		<td class='card_body_top'>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<div id='card_picture'>{USER_AVATAR}<center>{USER_ID}".PROFILE_4b."</center></div>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<div id='card_online'>{USER_ONLINE}</div><div id='card_online'>{USER_WARN}</div><div id='card_name'>{USER_NAME_LINK}</div><div id='card_level'>{USER_LEVEL}</div>" : "")."
		<div id='card_toplists'>{USER_COMMENTS_TOP}</div>
		<div id='card_pics'>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}{USER_SET_FRIEND_PIC}</div>
		</td>
	";

	$ML_TOPLIST_CHATBOX = "
		<td class='card_body_top'>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<div id='card_picture'>{USER_AVATAR}<center>{USER_ID}".PROFILE_4b."</center></div>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<div id='card_online'>{USER_ONLINE}</div><div id='card_online'>{USER_WARN}</div><div id='card_name'>{USER_NAME_LINK}</div><div id='card_level'>{USER_LEVEL}</div>" : "")."
		<div id='card_toplists'>{USER_CHATBOX_TOP}</div>
		<div id='card_pics'>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}{USER_SET_FRIEND_PIC}</div>
		</td>
	";

	$ML_TOPLIST_USER = "
		<td class='card_body_top'>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<div id='card_picture'>{USER_AVATAR}<center>{USER_ID}".PROFILE_4b."</center></div>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<div id='card_online'>{USER_ONLINE}</div><div id='card_online'>{USER_WARN}</div><div id='card_name'>{USER_NAME_LINK}</div><div id='card_level'>{USER_LEVEL}</div>" : "")."
		<div id='card_toplists'>{USER_RATING_TOP}</div>
		<div id='card_pics'>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}{USER_SET_FRIEND_PIC}</div>
		</td>
	";

	$ML_TOPLIST_PROFILES = "
		<td class='card_body_top'>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<div id='card_picture'>{USER_AVATAR}<center>{USER_ID}".PROFILE_4b."</center></div>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<div id='card_online'>{USER_ONLINE}</div><div id='card_online'>{USER_WARN}</div><div id='card_name'>{USER_NAME_LINK}</div><div id='card_level'>{USER_LEVEL}</div>" : "")."
		<div id='card_toplists'>{USER_PROFILE_TOP}</div>
		<div id='card_pics'>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}{USER_SET_FRIEND_PIC}</div>
		</td>
	";

	$ML_TOPLIST_FRIENDS = "
		<td class='card_body_top'>".
		($pref['profile_memberlist_column_avatar'] != "OFF" ? "<div id='card_picture'>{USER_AVATAR}<center>{USER_ID}".PROFILE_4b."</center></div>" : "").
		($pref['profile_memberlist_column_online'] != "OFF" ? "<div id='card_online'>{USER_ONLINE}</div><div id='card_online'>{USER_WARN}</div><div id='card_name'>{USER_NAME_LINK}</div><div id='card_level'>{USER_LEVEL}</div>" : "")."
		<div id='card_toplists'>{USER_FRIENDS_TOP}</div>
		<div id='card_pics'>{USER_FORUMS}{USER_COMMENTS_1}{USER_COMMENTS}{USER_PIC}{USER_VID}{USER_MP3}{USER_SET_FRIEND_PIC}</div>
		</td>
	";
}
?>