<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
//---------------------------------------------------------------
//              BEGIN CONFIGURATION AREA
//---------------------------------------------------------------

	$helptitle = MACGURUBLOG_MENU_58;
	
	$helpcapt[] = MACGURUBLOG_MENU_67;
	$helptext[] = MACGURUBLOG_MENU_68;

	$helpcapt[] = MACGURUBLOG_MENU_53;
	$helptext[] = MACGURUBLOG_MENU_54;

	$helpcapt[] = MACGURUBLOG_MENU_55;
	$helptext[] = MACGURUBLOG_MENU_56;

//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

	$text2 = "";
	for ($i=0; $i<count($helpcapt); $i++) {
		$text2 .="<b>".$helpcapt[$i]."</b><br />";
	$text2 .=$helptext[$i]."<br /><br />";
	};

$ns -> tablerender($helptitle, $text2);
?>