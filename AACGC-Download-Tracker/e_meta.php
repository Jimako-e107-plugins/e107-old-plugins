<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Favorite Downloads        #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


if (e_PAGE == "user.php") {

	require_once(e_THEME."/templates/user_template.php");

	$user_old = "{USER_UPDATE_LINK}";
	$user_new = "{DLTRACKERUSER}{USER_UPDATE_LINK}";
	
$USER_FULL_TEMPLATE = str_replace($user_old, $user_new, $USER_FULL_TEMPLATE);

}

if (e_PAGE == "download.php") {

	require_once(e_THEME."/templates/download_template.php");

	$dltr_old = "{DOWNLOAD_VIEW_REQUESTED}";
	$dltr_new = "{DOWNLOAD_VIEW_REQUESTED} {DLTRACKERLINK}";
	
$DOWNLOAD_VIEW_TABLE = str_replace($dltr_old, $dltr_new, $DOWNLOAD_VIEW_TABLE);

}

?>