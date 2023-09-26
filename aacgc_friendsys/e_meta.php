<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Friend System             #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

if (e_PAGE == "forum_viewtopic.php") {

	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");

	$forum_old = "{PROFILEIMG}";
	$forum_new = "{FORUMADD} {PROFILEIMG}";
	$forum_oldb = "{JOINED}";
	$forum_newb = "{JOINED}{FORUMCOUNT}";

	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);
	$FORUMTHREADSTYLE = str_replace($forum_oldb, $forum_newb, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace($forum_oldb, $forum_newb, $FORUMREPLYSTYLE);
}

if (e_PAGE == "user.php") {

	require_once(e_THEME."/templates/user_template.php");

	$user_old = "{USER_LOGINNAME}";
	$user_new = "{USER_LOGINNAME} {PROFILEADD}";

	$user_oldb = "{USER_SIGNATURE}";
	$user_newb = "{USER_SIGNATURE} {PROFILELIST}";

	$user_oldc = "{USER_NAME_LINK}";
	$user_newc = "{USER_NAME_LINK} {MEMBERLISTADD}";
	
$USER_FULL_TEMPLATE = str_replace($user_old, $user_new, $USER_FULL_TEMPLATE);
$USER_FULL_TEMPLATE = str_replace($user_oldb, $user_newb, $USER_FULL_TEMPLATE);
$USER_SHORT_TEMPLATE = str_replace($user_oldc, $user_newc, $USER_SHORT_TEMPLATE);
}




?>