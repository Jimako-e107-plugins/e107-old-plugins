<?php

/*
#######################################
#     e107 website system plguin      #
#     Advanced Medal System V1.31      #
#     by Marc Peppler                 #
#     http://www.marc-peppler.at      #
#     mail@marc-peppler.at            #
#    Updated version 1.31 by garyt  #
#				      #
#     Special Thanks to:	      #
#     Gerbrand (e107coders-user)      #
#     for the tip with		      #
#     the user-shortcode!!	      #
#######################################
*/

if (e_PAGE == "forum_viewtopic.php") {
$lan_file = e_PLUGIN."advmedsys/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/English.php");
	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");
	$forum_old = "{POSTS}";
	$forum_new = "{POSTS}{MEDFORUM}";
	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);
}


if (e_PAGE == "user.php") {

$lan_file = e_PLUGIN."advmedsys/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/English.php");

	require_once(e_THEME."/templates/user_template.php");

	$user_old = "{USER_UPDATE_LINK}";
	$user_new = "{MEDUSER} {USER_UPDATE_LINK}";
	
$USER_FULL_TEMPLATE = str_replace($user_old, $user_new, $USER_FULL_TEMPLATE);

}


?>