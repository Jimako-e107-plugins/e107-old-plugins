<?php
/*
+---------------------------------------------------------------+
|     Easy-Admin-Menu v1.0 - by Cameron & edited by acidfire for Category Link Menu
|     For the e107 CMS by Steve Dunstan
|     www.e107.org
+---------------------------------------------------------------+
*/
    $menutitle = categorylink_MAIN_1;

    $butname[] = categorylink_MAIN_2;  // Home Page
    $butlink[] = "admin_linkcategory.php";  // Plugin home page
  	$butid[] = "linkcategory"; // unique id for the page.

    $butname[] = categorylink_MAIN_3;  // Pool Options
    $butlink[] = "admin_categorylink.php"; // Page to edit pools
  	$butid[] = "categorylink"; // unique id for the page.

    $butname[] = categorylink_MAIN_5;  // Pool Options
    $butlink[] = "admin_menuconfig.php"; // Page to edit pools
  	$butid[] = "menuconfig"; // unique id for the page.

    $butname[] = categorylink_MAIN_4;  // Pool Options
    $butlink[] = "admin_categorylinkreadme.php"; // Page to edit pools
  	$butid[] = "categorylinkreadme"; // unique id for the page.

    $butname[] = categorylink_MAIN_6;  // Pool Options
    $butlink[] = "admin_csshelp.php"; // Page to edit pools
  	$butid[] = "csshelp"; // unique id for the page.
  	
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
