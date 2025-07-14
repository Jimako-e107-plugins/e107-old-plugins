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
if (!defined('e107_INIT')) { exit; }
if ($pref['plug_installed']['another_profiles']) {
  if (($pref['profile_redirect_usersettings'] == "Yes" && e_PAGE == "forum_viewtopic.php") && ($pref['profile_friends'] == "ON" || $pref['profile_friends'] == "")) {
	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");
	if(file_exists(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php")){
		require_once(e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php");
	} else {
		require_once(e_PLUGIN."another_profiles/languages/English.php");
	}
	$forum_old = "{PRIVMESSAGE}";
	$forum_new = "{PRIVMESSAGE} {FORUMADD}";
	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);
  }
}
?>