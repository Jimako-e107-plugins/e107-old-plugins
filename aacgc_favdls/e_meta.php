<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Favorite Downloads        #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

if (e_PAGE == "forum_viewtopic.php") {

	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");


	$forum_old = "{JOINED}";
	$forum_new = "{JOINED}{FORUMFAVDLCOUNT}";

	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);

}


if (e_PAGE == "user.php") {

	require_once(e_THEME."/templates/user_template.php");

	$user_old = "{USER_UPDATE_LINK}";
	$user_new = "{PROFILEFAVDLLIST}{USER_UPDATE_LINK}";

$USER_FULL_TEMPLATE = str_replace($user_old, $user_new, $USER_FULL_TEMPLATE);
}


if (e_PAGE == "download.php") {

	require_once(e_THEME."/templates/download_template.php");

	$favdl_old = "{DOWNLOAD_REPORT_LINK}";
	$favdl_new = "{FAVDLADD}{DOWNLOAD_REPORT_LINK}";
	$favdl_oldb = "{DOWNLOAD_REPORT_LINK}";
	$favdl_newb = "{FAVDLCOUNT}{DOWNLOAD_REPORT_LINK}";
	
$DOWNLOAD_VIEW_TABLE = str_replace($favdl_old, $favdl_new, $DOWNLOAD_VIEW_TABLE);
$DOWNLOAD_VIEW_TABLE = str_replace($favdl_oldb, $favdl_newb, $DOWNLOAD_VIEW_TABLE);
}


?>