<?php
/*
+---------------------------------------------------------------+
| yellowpages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/handlers/yellowpages_constants_admin.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:13 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Load the admin language file
include_lan(YELP_ADMIN_LANGUAGE_DIR.e_LANGUAGE.".php");

// Files
define("YELP_ADMIN_PAGE",           "admin_prefs.php");
$yellowpages_adminmenu = array(
   "YELP_ADMIN_PAGE_10" => array("text" => YELP_ADMIN_MENU_10, "link" => YELP_ADMIN_PAGE."?10", "form" => true),
   "YELP_ADMIN_PAGE_40" => array("text" => YELP_ADMIN_MENU_40, "link" => YELP_ADMIN_PAGE."?40", "form" => true),
   "YELP_ADMIN_PAGE_30" => array("text" => YELP_ADMIN_MENU_30, "link" => YELP_ADMIN_PAGE."?30", "form" => true),
   "YELP_ADMIN_PAGE_50" => array("text" => YELP_ADMIN_MENU_50, "link" => YELP_ADMIN_PAGE."?50", "form" => true),
   "YELP_ADMIN_PAGE_15" => array("text" => YELP_ADMIN_MENU_15, "link" => YELP_ADMIN_PAGE."?15", "form" => true),
   "YELP_ADMIN_PAGE_90" => array("text" => YELP_ADMIN_MENU_90, "link" => YELP_ADMIN_PAGE."?90", "form" => false),
   "YELP_ADMIN_PAGE_99" => array("text" => YELP_ADMIN_MENU_99, "link" => YELP_ADMIN_PAGE."?99", "form" => false),
);

?>