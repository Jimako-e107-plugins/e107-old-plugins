<?php
/*
+---------------------------------------------------------------+
|     Easy-Admin-Menu v2.0 - by Cameron ( www.e107coders.org)
|     For the e107 CMS by Steve Dunstan
|     www.e107.org for e107 v0.7 only.
+---------------------------------------------------------------+
//		BEGIN CONFIGURATION AREA
//---------------------------------------------------------------
*/
	if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
		require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
	} else {
		require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
	}
	
	$menutitle = "BLOG Engine";
	
	$butname[] = MACGURUBLOG_MENU_67;  // Admin Menu Button Name
	$butlink[] = "admin_config.php";  // Admin Menu Button Link.
	$butid[] = "config"; // unique id for the page.

	$butname[] = MACGURUBLOG_MENU_53;  // Admin Menu Button Name
	$butlink[] = "admin_stat.php";  // Admin Menu Button Link.
	$butid[] = "stat"; // unique id for the page.


	$butname[] = MACGURUBLOG_MENU_55;  // Admin Menu Button Name
	$butlink[] = "admin_db.php";   // Admin Menu Button Link.
	$butid[] = "db";               // unique id for the page.


//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
global $pageid;
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

    show_admin_menu($menutitle,$pageid, $var);

?>