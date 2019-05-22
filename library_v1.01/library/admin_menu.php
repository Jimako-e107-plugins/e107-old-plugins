<?php
/* 
+---------------------------------------------------------------+
|     Easy-Admin-Menu v2.0 - by Cameron ( www.e107coders.org)
|     For the e107 CMS by Steve Dunstan
|     www.e107.org for e107 v0.7 only.
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/admin_menu.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:02:12 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
+---------------------------------------------------------------+
//		BEGIN CONFIGURATION AREA
//---------------------------------------------------------------
*/

	$menutitle = BIBLIO_ADMIN_6;

	$butname[] = BIBLIO_ADMIN_7;  // Admin Menu Button Name
	$butlink[] = "admin_prefs.php";  // Admin Menu Button Link.
	$butid[] = "prefs"; // unique id for the page.

	$butname[] = BIBLIO_ADMIN_7b;  // Admin Menu Button Name
	$butlink[] = "library_prefs.php";  // Admin Menu Button Link.
	$butid[] = "config"; // unique id for the page.


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
