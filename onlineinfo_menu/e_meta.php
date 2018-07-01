<?php

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/English.php');
include_once(e_PLUGIN."onlineinfo_menu/functions.php");

global $pref;

if (e_PAGE == "forum_viewtopic.php") {
	echo "<!-- OIM forum view -->";
	if (file_exists(THEME.'forum_viewtopic_template.php'))
	{
	require_once(THEME."forum_viewtopic_template.php");
	}else{
	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");
	}
	

	
	$FORUMTHREADSTYLE=str_replace('{POSTER}','{OIM_POSTER}',$FORUMTHREADSTYLE);	
	$FORUMREPLYSTYLE=str_replace('{POSTER}','{OIM_POSTER}',$FORUMREPLYSTYLE);
	
	$FORUMEND=str_replace('{FORUMJUMP}','{FORUMJUMP}'.colourkey(0).'<br />',$FORUMEND);

	
	}
	

if (e_PAGE == "user.php") {	
	echo "<!-- OIM  user view -->";
	//$USER_FULL_TEMPLATE
	$USER_FULL_TEMPLATE=str_replace('{USER_NAME}','{OIM_USER_NAME}',$USER_FULL_TEMPLATE);	
	
}


?>