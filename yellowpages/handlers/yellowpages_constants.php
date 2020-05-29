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
| $Source: e:\_repository\e107_plugins/yellowpages/handlers/yellowpages_constants.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:12 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Files & Directories
define("YELP_PLUGIN_DIR",           e_PLUGIN."yellowpages/");
define("YELP_HANDLERS_DIR",         YELP_PLUGIN_DIR."handlers/");
define("YELP_LANGUAGE_DIR",         YELP_PLUGIN_DIR."languages/");
define("YELP_TEMPLATES_DIR",        YELP_PLUGIN_DIR."templates/");
define("YELP_ADMIN_LANGUAGE_DIR",   YELP_LANGUAGE_DIR."admin/");
define("YELP_SELF",                 YELP_PLUGIN_DIR."yellowpages.php");

// Load the language file
include_lan(YELP_LANGUAGE_DIR.e_LANGUAGE.".php");

// Load the admin language file if in an admin page
if (strpos(e_SELF, "admin_") !== false) {
   require_once(YELP_HANDLERS_DIR."yellowpages_constants_admin.php");
}

// URL parameter array indicies
define("YELP_MODE",              0);
define("YELP_ID",                1);
define("YELP_EXTRA",             2);

// Page modes
define("YELP_MAIN_PAGE",         0);
define("YELP_CATEGORIES_PAGE",   1);
define("YELP_ITEM_PAGE",         2);

// Database table names
define("YELP_ITEMS_TABLE",       "yellowpages");
define("YELP_CATEGORIES_TABLE",  "yellowpages_category");
define("YELP_SECTIONS_TABLE",    "yellowpages_section");
?>