<?php


if (e_PAGE == "forum_viewtopic.php") {
require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");




if ($pref['addon_enable_msnim'] == "1"){

$forum_old = "{POSTS}";
$forum_new = "{POSTS} <br> {MSNFORUM}";

$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);}




if ($pref['addon_enable_aimim'] == "1"){

$forum_old = "{POSTS}";
$forum_new = "{POSTS} <br> {AIMFORUM}";

$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);}




if ($pref['addon_enable_yahooim'] == "1"){

$forum_old = "{POSTS}";
$forum_new = "{POSTS} <br> {YAHOOFORUM}";

$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);}




if ($pref['addon_enable_xfireim'] == "1"){

$forum_old = "{POSTS}";
$forum_new = "{POSTS} <br> {XFIREFORUM}";

$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);}




if ($pref['addon_enable_facebookim'] == "1"){

$forum_old = "{POSTS}";
$forum_new = "{POSTS} <br> {FACEBOOKFORUM}";

$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);}






}







if (e_PAGE == "user.php") {

$lan_file = e_PLUGIN."advmedsys/language/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/language/English.php");

	require_once(e_THEME."/templates/user_template.php");




if ($pref['addon_enable_msnim'] == "1"){

	$user_old = "{USER_UPDATE_LINK}";
	$user_new = "{MSNUSER} {USER_UPDATE_LINK}";
        $USER_FULL_TEMPLATE = str_replace($user_old, $user_new, $USER_FULL_TEMPLATE);}

if ($pref['addon_enable_aimim'] == "1"){

	$user_old = "{USER_UPDATE_LINK}";
	$user_new = "{AIMUSER} {USER_UPDATE_LINK}";
        $USER_FULL_TEMPLATE = str_replace($user_old, $user_new, $USER_FULL_TEMPLATE);}

if ($pref['addon_enable_yahooim'] == "1"){

	$user_old = "{USER_UPDATE_LINK}";
	$user_new = "{YAHOOUSER} {USER_UPDATE_LINK}";
        $USER_FULL_TEMPLATE = str_replace($user_old, $user_new, $USER_FULL_TEMPLATE);}

if ($pref['addon_enable_xfireim'] == "1"){

	$user_old = "{USER_UPDATE_LINK}";
	$user_new = "{XFIREUSER} {USER_UPDATE_LINK}";
        $USER_FULL_TEMPLATE = str_replace($user_old, $user_new, $USER_FULL_TEMPLATE);}


}


?>