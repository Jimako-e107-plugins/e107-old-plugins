<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Member Status             #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

if (e_PAGE == "user.php") {

	require_once(e_THEME."/templates/user_template.php");

	$user_old = "{USER_RATING}";
	$user_new = "{USER_RATING}{MEMBERSTATUSPROFILE}";
	
$USER_FULL_TEMPLATE = str_replace($user_old, $user_new, $USER_FULL_TEMPLATE);

}

if (e_PAGE == "forum_viewtopic.php") {
	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");
	$forum_old = "{POSTS}";
	$forum_new = "{POSTS}{MEMBERSTATUSFORUM}";
	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);
}



?>