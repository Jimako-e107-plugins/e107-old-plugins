<?php
if (!defined('e107_INIT')) { exit; }
if (e_PAGE == "forum_viewtopic.php") {
	include_lan (e_PLUGIN.'alt_rank/languages/'.e_LANGUAGE.'.php');
	require_once(THEME."forum_viewtopic_template.php");
	$forum_old = "{AVATAR}";
	$forum_new = "{AVATAR}{ALTRANK}";
	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);
}
if (e_PAGE == "user.php") {
	include_lan (e_PLUGIN.'alt_rank/languages/'.e_LANGUAGE.'.php');
	require_once(THEME."user_template.php");
	$user_old = "<td class='fcaption' style='width:20%'>".LAN_142."</td>";
	$user_new = "<td class='fcaption' style='width:20%'>".LAN_142."</td><td class='fcaption' style='width:20%'>".ZNACHKA_11."</td>";	
$USER_SHORT_TEMPLATE_START = str_replace($user_old, $user_new, $USER_SHORT_TEMPLATE_START);
}
if (e_PAGE == "user.php") {
	include_lan (e_PLUGIN.'alt_rank/languages/'.e_LANGUAGE.'.php');
	require_once(THEME."user_template.php");
	$user2_old = "<td class='forumheader' style='width:20%'>{USER_ID}: {USER_NAME_LINK}</td>";
	$user2_new = "<td class='forumheader' style='width:20%'>{USER_ID}: {USER_NAME_LINK}</td><td class='forumheader' style='width:20%'>{ALTRANK}</td>";	
$USER_SHORT_TEMPLATE = str_replace($user2_old, $user2_new, $USER_SHORT_TEMPLATE);
}
if (e_PAGE == "user.php") {
	include_lan (e_PLUGIN.'alt_rank/languages/'.e_LANGUAGE.'.php');
	require_once(THEME."user_template.php");
	$user3_old = "<td colspan='2' class='fcaption' style='text-align:center'>".LAN_142." {USER_ID} : {USER_NAME}{USER_LOGINNAME}</td>";
	$user3_new = "<td colspan='2' class='fcaption' style='text-align:center'>".LAN_142." {USER_ID} : {USER_NAME}{USER_LOGINNAME} {ALTRANK}</td>";	
$USER_FULL_TEMPLATE = str_replace($user3_old, $user3_new, $USER_FULL_TEMPLATE);
}
?>